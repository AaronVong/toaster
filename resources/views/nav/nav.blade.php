<nav class="sticky top-0 app__nav flex flex-col items-center py-4 lg:w-full h-4/6">
    <div class="nav__brand mb-6">
        <i class="fas fa-bread-slice fa-3x"></i>
    </div>
    <ul class="nav__navbar flex flex-col items-center lg:w-full">
        <li class="navbar__items relative mb-6 lg:w-4/6 h-12">
            <a href="{{ route('home.index') }}" class="flex items-center w-full h-full pill-hover">
                <i class="fas fa-home fa-2x lg:w-2/6"></i>
                <span class="font-bold hidden lg:inline-block">Home</span>
            </a>
        </li>
        <li class="navbar__items relative mb-6 lg:w-4/6 h-12">
            <a href="{{route('home.explore')}}" class="flex items-center w-full h-full pill-hover">
                <i class="fab fa-slack fa-2x lg:w-2/6"></i>
                <span class="font-bold hidden lg:inline-block">Explore</span>
            </a>
        </li>
        @auth
        <li class="navbar__items mb-6 lg:w-4/6 h-12">
            <a href="{{ route('error.notready') }}" class="flex items-center w-full h-full pill-hover">
                <i class="far fa-envelope fa-2x lg:w-2/6"></i>
                <span class="font-bold hidden lg:inline-block">Messages</span>
            </a>
        </li>
        <li class="navbar__items relative mb-6 lg:w-4/6 h-12">
            <a href="{{ route('user.show', auth()->user()) }}" class="flex items-center w-full h-full pill-hover">
                <i class="far fa-user fa-2x lg:w-2/6"></i>
                <span class="font-bold hidden lg:inline-block">Profile</span>
            </a>
        </li>
        <li class="navbar__items relative mb-6 lg:w-4/6 h-12 cursor-pointer lg:hidden" >
            <div class="flex items-center w-full h-full pill-hover modal__btn" modal="search">
                <i class="fas fa-search fa-2x lg:w-2/6"></i>
                <span class="font-bold hidden lg:inline-block">Search</span>
            </div>
        </li>
        <li class="relative lg:h-32 lg:w-4/6">
            <button type="button"
                class="modal__btn rounded-full h-12 w-12 flex items-center bg-blue-600 justify-center lg:w-full lg:h-12 focus:outline-none focus:ring-2 hover:bg-blue-700" modal="quicktoast">
                <i class="fas fa-feather-alt fa-2x lg:hidden"></i>
                <span class="font-bold hidden">Toast</span>
            </button>
        </li>
        @endauth
    </ul>
    @auth
    <div class="nav__user-control flex items-center cursor-pointer mt-auto lg:w-4/6 px-4 pill-hover">
        <div class="user-control__img flex justify-center items-center lg:mr-5">
            <i class="fas fa-user-circle fa-2x"></i>
        </div>
        <div class="user-control__info hidden lg:block">
            <span class="block">{{auth()->user()->name}}</span>
            <span class="block">{{auth()->user()->username}}</span>
        </div>
        <div class="user-control__dots ml-auto hidden lg:block lg:self-start">
            <button class="focus:outline-none" type="button">
                <i class="fas fa-ellipsis-h"></i>
            </button>
        </div>
        <div class="user-control__controls z-20">
            <form action="{{ route('logout.index') }}" method="post" class="w-full h-full">
                @csrf
                <button id="logout" class="w-full h-full px-2 py-3 z-50" type="submit">Logout <span>{{auth()->user()->username}}</span></button>
            </form>
        </div>
    </div>
    @endauth
</nav>