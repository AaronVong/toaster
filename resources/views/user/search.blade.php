@extends('layouts.app')
@section('content')
<div class="app container grid grid-cols-4 md:auto-cols-min">
    <!-- Navigator -->
    <div class="relative flex w-full justify-center grid-cols-1">
        @include("nav.nav")
    </div>

    <!-- App Contents -->
    <div class="col-span-3 lg:col-span-2">
        <h1 class="fz-6 border-b border-gray-500 font-bold text-3xl p-2">Tìm kiếm người dùng '{{$key}}'</h1>
        <section id="users">
            @foreach($users as $user)
                <div class='w-full flex items-center p-3'>
                    <div class="flex-grow-0 flex-shrink-0 max-w-xs px-2 pt-2">
                        @if($user->image !== null && $user->image !== '')
                            <div class="w-16 h-16 flex items-center justify-center">
                                <img src="{{ asset('storage/userimages/'.$user->image)}}" class="block w-full h-full rounded-full" />
                            </div>
                        @else
                            <div class="w-16 h-16 flex items-center justify-center">
                                <img src="https://via.placeholder.com/50" class="block w-full h-full rounded-full" />
                            </div>
                        @endif
                    </div>
                    <div class='flex flex-col'>
                        <a href="{{ route('user.show', $user) }}" class="mr-2 hover:underline text-white font-bold"><span class="">{{$user->name}}</span></a>
                        <span class='italic mr-2'>{{$user->username}}</span>
                    </div>
                </div>
            @endforeach
        </section>
    </div>
    <!-- Sidebar -->
    <div id="sidebar" class="relative grid-cols-1">
        @include('sidebar.sidebar')
    </div>
</div>
@endsection