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
    let useUpdateBtn = $("#updateuser");

    /*logout menu*/
    navUserControl.click(() => {
        userControls.toggle();
    });

    /* window click */
    $(window).click((event) => {
        const target = $(event.target);
        // đóng modal khi click bên ngoài
        if (target.prop("id") == modalId && modalId !== "") {
            if (isEmojipanelOpen) {
                emojiPanel.hide();
                isEmojipanelOpen = false;
                layer.hide();
                return;
            }
            modal.hide();
            modalId = "";
        }

        if (target.prop("id") == "layer") {
            emojiPanel.hide();
            isEmojipanelOpen = false;
            target.hide();
        }

        if (
            event.target.classList.contains("modal__content") &&
            isEmojipanelOpen
        ) {
            emojiPanel.hide();
            isEmojipanelOpen = false;
            layer.hide();
        }
    });
    /* Modal */
    modalBtn.mouseup((e) => {
        // hiện modal
        modalId = e.currentTarget.getAttribute("modal");
        $(`#${modalId}`).show();
    });

    clostBtn.click(() => {
        // đóng modal khi nhấn đóng
        modal.hide();
        modalId = "";
    });
    /* Cuộn để load thêm toast */
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

    // mở emoji panel
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

    // nối emoji vừa chòn vào textarea
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

    // like and unlike bằng ajax
    $(".actions__like").submit((e) => {
        e.preventDefault();
        const target = e.currentTarget;
        const token = $(".actions__like input[name='_token']").val();
        let ok = false;
        let count = parseInt(target.nextElementSibling.innerText);
        $.ajax({
            type: "GET",
            url: "http://127.0.0.1:8000/login/check",
            beforeSend: () => {
                $(target)
                    .children("button[type='submit']")
                    .prop("disabled", true);
            },
            success: (data) => {
                ok = data["isLogin"];
                if (ok) {
                    const action = $(target).data("like");
                    let html =
                        action === "liked"
                            ? "<i class='far fa-heart'></i>"
                            : "<i class='fas fa-heart'></i>";
                    const method =
                        action === "like"
                            ? "POST"
                            : action === "liked"
                            ? "DELETE"
                            : null;
                    const route = target.getAttribute("action");
                    if (method == null) {
                        return;
                    }
                    $.ajax({
                        headers: {
                            "X-CSRF-TOKEN": token,
                        },
                        url: route,
                        type: method,
                        success: (data) => {
                            if (data["error"].length > 0) {
                                console.log(data["error"]);
                                return;
                            }
                            if (data["result"]) {
                                $(target)
                                    .children("button[type='submit']")
                                    .html(html);
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
                            $(target)
                                .children("button[type='submit']")
                                .prop("disabled", false);
                        },
                    }).fail(() => {
                        console.log("Fail");
                    });
                }
            },
        });
    });
});
