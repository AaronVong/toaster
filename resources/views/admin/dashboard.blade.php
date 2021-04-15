@extends("admin.admin")

@section("content")
    <div class="border">
        <h1 class="text-3xl text-center py-4"> Toaster Admin Panel</h1>
        <section class="border">
            <h3 class="text-2xl p-3 font-bold text-center">Sơ lượt</h3>
            <div class="flex flex-wrap w-full justify-evenly">
                <div class="border rounded-lg w-64 h-24 bg-blue-400 hover:bg-blue-500 hover:text-gray-50">
                    <a href="{{ route('admin.notready') }}" class="flex flex-col items-center justify-center h-full">
                        <span class="text-5xl">{{ $users->count() }}</span>
                        <span>Tổng người dùng</span>
                    </a>
                </div>
                <div class="border rounded-lg w-64 h-24 bg-green-400 hover:bg-green-500 hover:text-gray-50">
                    <a href="{{ route('admin.notready') }}" class="flex flex-col items-center justify-center h-full">
                        <span class="text-5xl">{{ $images->count() }}</span>
                        <span>Tổng hình ảnh lưu trữ</span>
                    </a>
                </div>
                <div class="border rounded-lg w-64 h-24 bg-red-400 hover:bg-red-500 hover:text-gray-50">
                    <a href="{{ route('admin.notready') }}" class="flex flex-col items-center justify-center h-full">
                        <span class="text-5xl">{{ $toasts->count() }}</span>
                        <span>Tổng bài đằng</span>
                    </a>
                </div>
                <div class="border rounded-lg w-64 h-24 bg-purple-400 hover:bg-purple-500 hover:text-gray-50">
                    <a href="{{ route('admin.members') }}" class="flex flex-col items-center justify-center h-full">
                        <span class="text-5xl">{{ $members->count() }}</span>
                        <span>Tổng thành viên quản trị</span>
                    </a>
                </div>
            </div>
        </section>
    </div>
@endsection