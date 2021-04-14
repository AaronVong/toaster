<div class="fixed bottom-0 left-0  bg-gray-900 w-full lg:sticky lg:top-0 lg:bg-transparent">
    @auth
    <div class="lg:block hidden">
        <form action="{{ route('user.search') }}" method="GET" autocomplete='off' class="usersearch">
            @csrf
            <div class="flex items-center w-full justify-center py-3">
                <span
                    class="bg-gray-900 shadow-none border-end-0 border-dark flex justify-center items-center w-12 h-12 rounded-l-xl">
                        <i class="fas fa-search"></i>
                    </span>
                <input type="text"
                    class="bg-gray-900 rounded-r-xl text-light shadow-none focus:outline-none text-white h-12 w-4/6"
                    placeholder="Search for user" name='username' autocomplete='off'>
            </div>
        </form>
    </div>
    @endauth
    @guest
        <div class="w-full mt-2 flex flex-col items-center">
            <a href="{{ route('login.index') }}" class="w-3/6 h-12 rounded-full bg-blue-500 mb-2 text-center py-3 hover:bg-blue-600">Đăng nhập</a>
            <a href="{{ route('register.index') }}" class="w-3/6 h-12 rounded-full bg-gray-500 mb-2 text-black text-center py-3 hover:bg-gray-600">Đăng ký</a>
        </div>
    @endguest
</div>