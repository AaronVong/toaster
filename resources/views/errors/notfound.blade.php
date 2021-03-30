@extends('layouts.app')
@section('content')
<div class="app container grid grid-cols-4 md:auto-cols-min">
    <!-- Navigator -->
    <div class="relative flex w-full justify-center grid-cols-1">
        @include("nav.nav")
    </div>
    <!-- App Contents -->
    <div class="col-span-3 lg:col-span-2 relative">
        @include("errors.notfound-text");
    </div>
    <!-- Sidebar -->
    <div id="sidebar" class="relative grid-cols-1">
        @include('sidebar.sidebar')
    </div>
</div>
@endsection