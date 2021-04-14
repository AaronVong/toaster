@extends('layouts.app')
@section('content')
<div class="app container grid grid-cols-4 md:auto-cols-min">
    <!-- Navigator -->
    <div class="relative flex w-full justify-center grid-cols-1">
        @include("nav.nav")
    </div>

    <!-- App Contents -->
    <div class="col-span-3 lg:col-span-2">
        <div class="w-full flex divide-x divide-gray-500 bg-gray-900">
            <div class="flex-shrink-0 flex-grow-0 w-2/6 md:w-1/6">
                <div class="toast__left flex-grow-0 flex-shrink-0 max-w-xs pt-2 h-full flex justify-center">
                    @if($user->image !== null && $user->image !== '')
                        <div class="w-24 h-24 flex items-center justify-center">
                            <img src="{{ asset('storage/userimages/'.$user->image)}}" class="block w-full h-full rounded-full" />
                        </div>
                    @else
                        <div class="w-16 h-16 flex items-center justify-center">
                            <img src="https://via.placeholder.com/50" class="block w-full h-full rounded-full" />
                        </div>
                    @endif
                </div>
            </div>
            <div class="flex-shrink-1 flex-grow-1 w-4/6 md:w-5/6 py-2">
                <div class="card w-full">
                    <div class="w-full">
                        <ul class="list-none px-2">
                            <li><span class="font-bold text-lg">{{ $user->name }}</span></li>
                            <li><span class="font-bold">{{ $user->username }}</span></li>
                            <li><span class="text-gray-500">Tham gia: </span> <span class="font-bold">{{ $user->created_at }}</span></li>
                            <li><span class="text-gray-500">Likes nhận được: </span>  <span class="font-bold">{{$user->recivedLikes()->count() }}</span></li>
                            <li><span class="text-gray-500">Toast đã đăng: </span>  <span class="font-bold">{{$toasts->count()}} {{Str::plural('toast',$toasts->count()) }}</span></li>
                            <button type='button' class="profile__show-info"><span>Thêm...</span></button>
                            <li class="profile__hidden-info hidden">
                                <ul>
                                    <li><span class="text-gray-500">Sinh ngày: </span><span class="font-bold">{{ $user->date }}</span></li>
                                    <li><span class="text-gray-500">Liên lạc: </span><span class="font-bold">{{ $user->phone }}</span></li>
                                    <li><span class="text-gray-500">Email: </span><span class="font-bold">{{ $user->email }}</span></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    @auth
                        <div class="">
                            @can('update',$user)
                                <button type="button" class="modal__btn focus:outline-none bg-gray-500 rounded-full p-2 w-32 text-white hover:bg-gray-600" modal="editprofile">Chỉnh sửa</button>
                            @endcan
                            
                            @can('follow', $user)
                                @if(auth()->user()->followed($user->id))
                                    <button type="button" class="follow__btn focus:outline-none bg-blue-500 rounded-full p-2 w-32 h-12 text-white hover:bg-blue-600 capitalize followed" data-follow="unfollow" data-user='{{$user->id}}'>
                                        <span class="follow__state">Following</span>
                                    </button>
                                @else
                                    <button type="button" class="follow__btn focus:outline-none bg-blue-500 rounded-full p-2 w-32 h-12 text-white hover:bg-blue-600 capitalize" data-follow="follow" data-user='{{$user->id}}'>
                                        <span class="follow__state">Follow</span>
                                    </button>
                                @endif
                            @endcan
                        </div>
                    @endauth
                </div>
            </div>
        </div>
        <nav class="profile-nav h-12 border-b-4 border-blue-500">
            <ul class="list-none flex h-full">
                <li class="h-full"><a href="{{ route('user.show',$user) }}" class="block pill-hover p-5 w-full h-full flex items-center text-xl font-bold hover:text-blue-500 active-link">Toasts</a></li>
                <li class="h-full"><a href="{{ route('user.show.likedtoasts', $user) }}" class="block pill-hover p-5 w-full h-full flex items-center text-xl font-bold hover:text-blue-500">Liked Toasts</a></li>
            </ul>
        </nav>
        <section id="toast-dashboard">
            @include('toast.toasts',$toasts)
        </section>
    </div>
    <!-- Sidebar -->
    <div id="sidebar" class="relative grid-cols-1">
        @include('sidebar.sidebar')
    </div>
</div>
@endsection