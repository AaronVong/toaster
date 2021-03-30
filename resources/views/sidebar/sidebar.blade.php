<div class="sticky top-0">
    <!-- <div class="user-search">
        <form class="search__form">
            <div class="input-group">
                <span
                    class="input-group-text bg-dark shadow-none border-end-0 border-dark d-flex justify-content-center align-items-center"
                    id="basic-addon1"><i class="fas fa-search text-secondary"></i></span>
                <input type="text"
                    class="form-control bg-dark border-dark border-start-0 text-light shadow-none"
                    placeholder="Search for user" aria-label="Username"
                    aria-describedby="basic-addon1">
            </div>
        </form>
    </div> -->
    @guest
        <div class="w-full mt-2 flex flex-col items-center">
            <a href="{{ route('login.index') }}" class="w-3/6 h-12 rounded-full bg-blue-500 mb-2 text-center py-3 hover:bg-blue-600">Đăng nhập</a>
            <a href="{{ route('register.index') }}" class="w-3/6 h-12 rounded-full bg-gray-500 mb-2 text-black text-center py-3 hover:bg-gray-600">Đăng ký</a>
        </div>
    @endguest
</div>