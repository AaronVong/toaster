<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toaster</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/myapp.css') }}">
    <link rel="stylesheet" href="{{ asset('css/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('css/slick-theme.css') }}">
    <script type="text/javascript" src="{{ asset('js/jquery-3.5.1.min.js') }}"></script>
    <script type="text/javascript" src="https://kit.fontawesome.com/d210984464.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="{{ asset('js/myapp.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/infinite-scroll.pkgd.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/slick.min.js') }}"></script>
    <script type="module" src="{{ asset('js/index.js') }}"></script>
</head>
<body class="bg-black">

    <div id="layer" class="absolute w-full h-full z-10 bg-red top-0 left-0 hidden"></div>
    <div class="container lg:container xl:container mx-auto text-gray-300 h-full">
        @yield('content')
    </div>

    
    @guest
    <!-- Modal Đăng nhập đăng ký -->
    <div class="modal w-full h-full" id="auth">
        <div class="modal__content text-gray-300 w-full h-full lg:w-2/6 lg:h-auto lg:mt-12 lg:mx-auto">
            <span class="modal__close">&times;</span>
            <h1 class="text-3xl text-center">Hãy tham gia Toast ngay bây giờ</h1>
            <div class="w-full mt-2 flex flex-col items-center">
                <a href="{{ route('login.index') }}" class="w-3/6 h-12 rounded-full bg-blue-500 mb-2 text-center py-3 hover:bg-blue-600">Đăng nhập</a>
                <a href="{{ route('register.index') }}" class="w-3/6 h-12 rounded-full bg-gray-500 mb-2 text-black text-center py-3 hover:bg-gray-600">Đăng ký</a>
            </div>
        </div>
    </div>
    @endguest

    @auth
    <!-- Modal Toast Form -->
    <div class="modal w-full h-full" id="quicktoast">
        <div class="modal__content text-gray-300 w-full h-full lg:w-2/6 lg:h-auto lg:mt-12 lg:mx-auto">
            <span class="modal__close">&times;</span>
            <h1>Toast somethings</h1>
        @include("forms.form_toast")
        </div>
    </div>
    <!-- Modal Search -->
    <div class="modal" id="search">
        <form action="{{ route('user.search') }}" method="GET" autocomplete='off' class="usersearch">
            @csrf
            <div class="flex items-center w-full justify-center py-3">
                <span
                    class="bg-gray-900 shadow-none border-end-0 border-dark flex justify-center items-center w-12 h-12 rounded-l-xl">
                        <i class="fas fa-search text-white"></i>
                    </span>
                <input type="text"
                    class="bg-gray-900 rounded-r-xl text-light shadow-none focus:outline-none text-white h-12 w-4/6"
                    placeholder="Search for user" name='username' autocomplete='off'>
            </div>
        </form>
    </div>
    <!-- Modal chỉnh sửa người dùng -->
    @if($errors->profile->any())
        <script>
            $(document).ready(()=>{
                $(window).on("load",()=>{
                    console.log($("button[modal='editprofile']").first());
                    $("button[modal='editprofile']").first().trigger('click');
                });
            })
        </script>
    @endif
    <div class="modal w-full h-full" id="editprofile">
        <div class="modal__content text-gray-300 w-full h-full lg:w-2/6 lg:h-auto lg:mt-12 lg:mx-auto">
            <span class="modal__close">&times;</span>
            <h1 class="text-3xl text-center">Chỉnh sửa thông tin cá nhân</h1>
            <form class="block w-full flex flex-col justify-center" id="updateuser-form" action="{{ route('user.update',auth()->user()) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method("PUT")
                <div class="mb-3">
                    <label>Họ tên:</label>
                    <input type="text"
                        class="w-full lg:w-full h-12 rounded-full border p-3 bg-transparent focus:outline-none focus:border focus:border-blue-500"
                        id="name" name="name" placeholder="Họ tên" value="{{auth()->user()->name}}" placeholder="Họ tên">
                    <span class="text-red-600" name='error-name'>
                        @if($errors->profile->has('name'))
                            {{$errors->profile->first('name')}}
                        @endif
                    </span>
                </div>
                <div class="mb-3">
                    <label>Số điện thoại:</label>
                    <input type="text"
                        class="w-full lg:w-full h-12 rounded-full border p-3 bg-transparent focus:outline-none focus:border focus:border-blue-500"
                        id="phone" name="phone" placeholder="Số điện thoại" value="{{auth()->user()->phone}}">
                    <span class="text-red-600" name='error-phone'>
                        @if($errors->profile->has('phone'))
                            {{$errors->profile->first('phone')}}
                        @endif
                    </span>
                </div>
                <div class="mb-3">
                    <label>Ngày sinh:</label>
                    <input type="date"
                        class="w-full lg:w-full h-12 rounded-full border p-3 bg-transparent focus:outline-none focus:border focus:border-blue-500"
                        name="date" value="{{auth()->user()->date}}">
                    <span class="text-red-600" name='error-date'>
                        @if($errors->profile->has('date'))
                            {{$errors->profile->first('date')}}
                        @endif
                    </span>
                </div>
                <div class="mb-3">
                    <label>Mật khẩu:</label>
                    <input type="password"
                        class="w-full lg:w-full h-12 rounded-full border p-3 bg-transparent focus:outline-none focus:border focus:border-blue-500"
                        id="password" name="password" placeholder="Để trống để giữ nguyên Password">
                    <span class="text-red-600" name='error-password'>
                        @if($errors->profile->has('password'))
                            {{$errors->profile->first('password')}}
                        @endif
                    </span>
                </div>
                <div class="mb-3">
                    <label>Ảnh đại diện:</label>
                    <input type="file" name="image" class="w-full lg:w-full h-12 p-3 bg-transparent" accept="image/*">
                    <span class="text-red-600" name='error-image'>
                        @if($errors->profile->has('image'))
                            {{$errors->profile->first('image')}}
                        @endif
                    </span>
                </div>
                <div class="mb-3 mx-auto">
                    <button type="submit" class="bg-blue-500 w-32 h-12 rounded-full hover:bg-blue-600 text-gray-300 focus:outline-none" id="updateuser">
                        <span>Cập nhật</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
    @endauth
</body>
</html>