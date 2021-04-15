<nav class="flex p-3 items-center bg-gray-300">
    <ul class="flex items-center justify-evenly w-4/6">
        <li class="text-lg w-full"><a href="{{ route('admin.dashboard') }}" class="block w-full text-center py-2 hover:underline font-medium">Dashboard</a></li>
        <li class="text-lg w-full"><a href="{{ route('admin.notready') }}" class="block w-full text-center py-2 hover:underline font-medium">Toasts</a></li>
        <li class="text-lg w-full"><a href="{{ route('admin.notready') }}" class="block w-full text-center py-2 hover:underline font-medium">Người dùng</a></li>
        <li class="text-lg w-full"><a href="{{ route('admin.notready') }}" class="block w-full text-center py-2 hover:underline font-medium">Hình ảnh</a></li>
        <li class="text-lg w-full"><a href="{{ route('admin.members') }}" class="block w-full text-center py-2 hover:underline font-medium">Thành viên</a></li>
        <li class="text-lg w-full"><a href="{{ route('home.index') }}" class="block w-full text-center py-2 hover:underline font-medium text-blue-500">Đến Website</a></li>
    </ul>
    <form action="{{ route('logout.index') }}" method="post" class="ml-auto w-2/6">
        @csrf
        <div class="flex justify-center items-center">
            <div class="flex flex-col justify-center mr-2">
                <span>{{auth()->user()->name}}</span>
                <span>({{ auth()->user()->role->role_name}})</span>
            </div>
            <button type="submit" class="inline-block w-24 h-12 bg-red-400 focus:outline-none focus:ring-2 focus:ring-red-400 hover:bg-red-500">Đăng xuất</button>
        </div>
    </form>
</nav>