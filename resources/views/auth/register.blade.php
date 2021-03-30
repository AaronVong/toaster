@extends('layouts.app')

@section('content')
    <div id="auth" class="flex justify-center items-center h-full text-gray-400">
        <form action="{{ route('register.create') }}" method="post"
            class="w-4/6 lg:w-2/6 border flex flex-col justify-center p-5">
            <h2 class="mb-5 text-center  py-3">Đăng ký Toaster <i class="fas fa-bread-slice w-auto fa-2x"></i>
            </h2>
            @csrf
            <div class="mb-3">
                <input type="text"
                    class="w-full lg:w-full h-12 rounded-full border p-3 bg-transparent focus:outline-none focus:border focus:border-blue-500"
                    id="name" name="name" placeholder="Họ tên" value="{{old('name')}}" placeholder="Họ tên">
                @error("name")
            <span class="text-red-600">
                {{$message}}
            </span>
            @enderror
            </div>
            <div class="mb-3">
                <input type="text"
                    class="w-full lg:w-full h-12 rounded-full border p-3 bg-transparent focus:outline-none focus:border focus:border-blue-500"
                    id="username" name="username" placeholder="Tên tài khoản" value="{{old('username')}}">
                @error("username")
            <span class="text-red-600">
                {{$message}}
            </span>
            @enderror
            </div>
            <div class="mb-3">
                <input type="email"
                    class="w-full lg:w-full h-12 rounded-full border p-3 bg-transparent focus:outline-none focus:border focus:border-blue-500"
                    id="email" name="email" placeholder="Địa chỉ email" value="{{old('email')}}">
                @error("email")
            <span class="text-red-600">
                {{$message}}
            </span>
            @enderror
            </div>
            <div class="mb-3">
                <input type="text"
                    class="w-full lg:w-full h-12 rounded-full border p-3 bg-transparent focus:outline-none focus:border focus:border-blue-500"
                    id="phone" name="phone" placeholder="Số điện thoại" value="{{old('phone')}}">
                @error("phone")
            <span class="text-red-600">
                {{$message}}
            </span>
            @enderror
            </div>
            <div class="mb-3">
                <input type="date"
                    class="w-full lg:w-full h-12 rounded-full border p-3 bg-transparent focus:outline-none focus:border focus:border-blue-500"
                    name="date" value="{{old('date')}}">
                @error("date")
            <span class="text-red-600">
                {{$message}}
            </span>
            @enderror
            </div>
            <div class="mb-3">
                <input type="password"
                    class="w-full lg:w-full h-12 rounded-full border p-3 bg-transparent focus:outline-none focus:border focus:border-blue-500"
                    id="password" name="password" placeholder="Mật khẩu">
                @error("password")
            <span class="text-red-600">
                {{$message}}
            </span>
            @enderror
            </div>
            <div class="mb-3">
                <input type="password"
                    class="w-full lg:w-full h-12 rounded-full border p-3 bg-transparent focus:outline-none focus:border focus:border-blue-500"
                    id="password_confirmation" name="password_confirmation" placeholder="Nhập lại mật khẩu">
            @error("password")
            <span class="text-red-600">
                {{$message}}
            </span>
            @enderror
            </div>
            <div class="mb-3 mx-auto">
                <button type="submit" class="bg-blue-500 w-32 h-12 rounded-full hover:bg-blue-600 text-gray-300 focus:outline-none">Đăng
                    ký</button>
            </div>
            <div class="w-full bg-gray-300 my-3" style="height: 1px;"></div>

            <p class="text-gray-300 text-center">Đã có tài khoản? <a href="{{ route('login.index') }}"
                    class="text-blue-600 hover:text-blue-500">Đăng nhập</a> ngay</p>
        </form>
    </div>
    @endsection