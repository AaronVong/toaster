@extends('layouts.app')
@section('content')
<div class="app container grid grid-cols-4 md:auto-cols-min">
    <!-- Navigator -->
    <div class="relative flex w-full justify-center grid-cols-1">
        @include("nav.nav")
    </div>

    <!-- App Contents -->
    <div class="col-span-3 lg:col-span-2 relative">
        <h1 class="text-4xl text-center py-4">Comming Soon...</h1>
    </div>
    <!-- Sidebar -->
    <div id="sidebar" class="relative grid-cols-1 lg:block hidden">
        @include('sidebar.sidebar')
    </div>
</div>
@endsection