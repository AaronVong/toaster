$(document).ready(() => {
    let modal = $(".modal");
    let modalId = "";
    let modalBtn = $(".modal__btn");
    let clostBtn = $(".modal__close");
    let navUserControl = $(".nav__user-control");
    let userControls = $(".user-control__controls");
    let formToastBtn = $(".actions__toast");
    let toastsDashboard = $("#toast-dashboard");
    let toastFormTextarea = $("textarea[name='content']");
    let profileShowMoreBtn = $(".profile__show-info");
    let emojiOpenBtn = $(".emoji-picker-btn");
    let emojiPanel = $(".emoji-picker-panel");
    let layer = $("#layer");
    let userUpdateBtn = $("#updateuser");
    let toastDots = $(".toast__dots");
    let toastTools = $(".toast__tools");

    $(".reply-btn").click((e) => {
        $(e.currentTarget).next().toggle();
    });
    /*logout menu*/
    navUserControl.click(() => {
        userControls.toggle();
    });

    // đóng modal đang được mở khi click bên ngoài
    let closeModal = (event) => {
        // đóng modal khi click bên ngoài
        if ($(event.target).prop("id") == modalId && modalId !== "") {
            if (isEmojipanelOpen) {
                emojiPanel.hide();
                isEmojipanelOpen = false;
                layer.hide();
                return;
            }
            modal.hide();
            modalId = "";
        }

        if ($(event.target).prop("id") == "layer") {
            emojiPanel.hide();
            isEmojipanelOpen = false;
            $(event.target).hide();
            $(".toast__tools").hide();
        }

        if ($(event.target).hasClass("modal__content") && isEmojipanelOpen) {
            emojiPanel.hide();
            isEmojipanelOpen = false;
            layer.hide();
        }
    };

    /* khi click bên ngoài thực thi fnc đóng modal */
    $(window).click(closeModal);

    /* hiện thị modal dựa trên attr cho cho trước */
    modalBtn.click((e) => {
        modalId = e.currentTarget.getAttribute("modal");
        $(`#${modalId}`).show();
    });

    // đóng modal khi nhấn x
    clostBtn.click(() => {
        modal.hide();
        modalId = "";
    });

    /* Cuộn để load thêm toast */
    $("nav[role='navigation']").hide();
    toastsDashboard.infiniteScroll({
        path: "a[rel='next']",
        append: ".toast",
        history: false,
        hideNav: "nav[role='navigation']",
        status: ".page-load-status",
    });

    /* kích hoạt nút toast khi nhập nội dung*/
    toastFormTextarea.keyup((e) => {
        let value = e.target.value;
        if (value !== "") {
            formToastBtn.prop("disabled", false);
            formToastBtn.removeClass("disabled-btn");
        } else {
            formToastBtn.prop("disabled", true);
            formToastBtn.addClass("disabled-btn");
        }
    });

    // hiện thêm thông tin ở trang cá nhân
    let showinfoClicked = false;
    profileShowMoreBtn.click((e) => {
        showinfoClicked = !showinfoClicked;
        if (showinfoClicked) {
            e.currentTarget.innerText = "Ẩn bớt";
        } else {
            e.currentTarget.innerText = "Thêm...";
        }
        $(".profile__hidden-info").slideToggle();
    });

    // Mở Emoji pane
    let isEmojipanelOpen = false;
    emojiOpenBtn.click((e) => {
        let target = e.currentTarget;
        if (isEmojipanelOpen) {
            $(target.nextElementSibling).hide();
            layer.hide();
            return;
        }
        $(target.nextElementSibling).show();
        isEmojipanelOpen = true;
        $("#layer").show();
        toastFormTextarea.focus();
    });

    // nối emoji vừa chọn vào chuỗi
    $("emoji-picker").on("emoji-click", (e) => {
        let emoji = e.detail["unicode"];
        let value = toastFormTextarea.val();
        if (
            toastFormTextarea.selectionStart ||
            toastFormTextarea.selectionStart !== "0"
        ) {
            var startPos = toastFormTextarea.prop("selectionStart");
            var endPos = toastFormTextarea.prop("selectionEnd");
            let newvalue =
                value.substring(0, startPos) +
                emoji +
                value.substring(endPos, value.length);
            toastFormTextarea.val(newvalue);
        } else {
            value += emoji;
            toastFormTextarea.val(value);
        }
    });

    // điều hướng tab user profile bằng ajax
    $(".profile-nav>ul li>a").click((e) => {
        e.preventDefault();
        const target = e.currentTarget;
        const token = $("meta[name='csrf-token']").attr("content");
        const route = $(target).attr("href");
        $(".profile-nav>ul li>a").removeClass("active-link");
        $(target).addClass("active-link");
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": token,
            },
            type: "GET",
            url: route,
            success: (data) => {
                if (data["error"].length > 0) {
                    console.log(data["error"]);
                }
                $("#toast-dashboard").html(data["html"]);
            },
        });
    });

    // hàm xử lý like và unlike bằng ajax
    let likeAndUnlike = (e) => {
        e.preventDefault();
        const target = e.currentTarget;
        const token = $("meta[name='csrf-token']").attr("content");
        let ok = false;
        let count = parseInt(target.nextElementSibling.innerText);
        const action = $(target).data("like");
        let html =
            action === "liked"
                ? "<i class='far fa-heart'></i>"
                : "<i class='fas fa-heart'></i>";
        const method =
            action === "like" ? "POST" : action === "liked" ? "DELETE" : null;
        console.log(method);
        const route = $(target).data("route");
        if (method == null) {
            return;
        }
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": token,
            },
            url: route,
            type: "POST",
            data: { _method: method, _token: token },
            success: (data) => {
                if (data["error"].length > 0) {
                    console.log(data["error"]);
                    return;
                }
                if (data["result"]) {
                    $(target).html(html);
                    $(target).data("like", data["result"]);
                    if (data["result"] == "like") {
                        count -= 1;
                    }
                    if (data["result"] == "liked") {
                        count += 1;
                    }
                    $(target.nextElementSibling).text(count);
                    if (count == 0) {
                        $(target.nextElementSibling).hide();
                    } else {
                        $(target.nextElementSibling).show();
                    }
                }
            },
            complete: () => {
                $(target).prop("disabled", false);
            },
        }).fail(() => {
            console.log("Fail");
        });
    };

    // bắt sự kiện like và unlike
    $("#toast-dashboard").on("click", ".actions__like", likeAndUnlike);

    // mở menu tools cửa một toast
    const openTools = (e) => {
        e.preventDefault();
        $(e.currentTarget.nextElementSibling).toggle();
        layer.toggle();
    };

    // bắt sự kiện mở tools cảu một toast
    $("#toast-dashboard").on("click", ".toast__dots", openTools);

    // cập nhật thông tin cá nhân bằng ajax (không dùng)
    userUpdateBtn.click((e) => {
        return;
        e.preventDefault();
        const action = $("#updateuser-form").attr("action");
        const token = $("meta[name='csrf-token']").attr("content");
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": token,
            },
            type: "POST",
            url: action,
            data: $("#updateuser-form").serialize(),
            success: (data) => {
                if (data["isFailed"]) {
                    console.log(data["error"]);
                    const errors = data["error"];
                    let x;
                    for (x in errors) {
                        $(`#updateuser-form span[name='error-${x}']`).text(
                            errors[x]
                        );
                    }
                } else {
                    alert("Cập nhật thành công");
                    window.location.reload();
                }
            },
            error: (xhr, status) => {
                console.log("status: " + status);
                console.log("request failed");
            },
        });
    });

    // hàm hiện thị hình ảnh vừa upload lên
    function previewFiles(files) {
        var preview = document.querySelector("#toast__form__preview");
        function readAndPreview(file) {
            if (/\.(jpe?g|png|gif)$/i.test(file.name)) {
                var reader = new FileReader();
                reader.addEventListener(
                    "load",
                    function () {
                        var image = new Image();
                        let div = document.createElement("div");
                        let span = document.createElement("span");
                        span.innerHTML = "&#10006;";
                        span.classList.add("preview__item__remove");
                        div.classList.add("relative", "preview__item");
                        image.title = file.name;
                        image.src = this.result;
                        image.classList.add("w-full", "h-auto", "block");
                        div.appendChild(image);
                        div.appendChild(span);
                        preview.appendChild(div);
                    },
                    false
                );

                reader.readAsDataURL(file);
            }
        }
        if (files) {
            [].forEach.call(files, readAndPreview);
        }
    }

    // bắt sự kiện khi click upload file
    $("div[name='media']").mouseup((e) => {
        $(".toast__form__inputfile").first().trigger("click");
    });

    // bắt kiện khi sau khi file được upload
    $(".toast__form__inputfile").change((e) => {
        const files = e.currentTarget.files;
        previewFiles(files);
    });

    // slick carousel
    $(".header__images").slick({
        infinite: false,
        adaptiveHeight: true,
        adaptiveWidth: true,
        dots: true,
        arrows: true,
        mobileFirst: true,
        speed: 200,
    });

    // sự kiện nút follow và unfollow
    $(".follow__btn").click((e) => {
        e.preventDefault();
        const followid = $(e.currentTarget).data("user");
        const token = $("meta[name='csrf-token']").attr("content");
        const method =
            $(e.currentTarget).data("follow") === "follow"
                ? "POST"
                : $(e.currentTarget).data("follow") === "unfollow"
                ? "DELETE"
                : null;
        if (method === null) return;
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": token,
            },
            type: "POST",
            data: {
                _method: method,
                _token: token,
            },
            url: `/user/follow/${followid}`,
            success: (data) => {
                if (data["errors"] === null) {
                    $(e.currentTarget)
                        .children(".follow__state")
                        .text(data["status"]);
                    $(e.currentTarget).data("follow", data["nextAction"]);
                    if (data["nextAction"] == "unfollow") {
                        setTimeout(() => {
                            $(e.currentTarget).addClass("followed");
                        }, 500);
                    } else {
                        $(e.currentTarget).removeClass("followed");
                    }
                }
            },
            error: () => {
                console.log("Error");
            },
        });
    });
});
