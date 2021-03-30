@extends('layouts.app')

@section('content')
    <div id="auth" class="flex justify-center items-center h-full text-gray-400">
        <form action="{{ route('login.create') }}" method="post"
            class="w-4/6 lg:w-2/6 border flex flex-col justify-center p-5">
            <h2 class="mb-5 text-center  py-3">Đăng nhập Toaster <i class="fas fa-bread-slice fa-2x"></i></h2>
            @csrf
            @if(@session()->has('loginStatus'))
            <div class="text-red-600">
                <span>{{@session('loginStatus')}}</span>
            </div>
            @endif
            <div class="form-floating mb-3">
                <input type="email"
                    class="w-full lg:w-full h-12 rounded-full border p-3 bg-transparent focus:outline-none focus:border focus:border-blue-500"
                    id="email" name="email" placeholder="Địa chỉ email">
                @error("email")
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-floating mb-3">
                <input type="password"
                    class="w-full lg:w-full h-12 rounded-full border p-3 bg-transparent focus:outline-none focus:border focus:border-blue-500"
                    id="password" name="password" placeholder="Mật khẩu">
                @error("password")
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-3 mx-auto">
                <button type="submit" class="bg-blue-500 w-32 h-12 rounded-full hover:bg-blue-600 text-gray-300 focus:outline-none">Đăng
                    nhập</button>
            </div>
            <div class="w-full bg-gray-300 my-3" style="height: 1px;"></div>
            <p class="text-gray-300 text-center">Không có tài khoản? <a href="{{route('register.index')}}"
                    class="text-blue-600 hover:text-blue-500">Đăng ký</a> ngay</p>
        </form>
    </div>
@endsection