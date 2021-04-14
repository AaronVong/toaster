@extends('layouts.app')
@section('content')
<div class="app container grid grid-cols-4 md:auto-cols-min">
    <!-- Navigator -->
    <div class="relative flex w-full justify-center grid-cols-1">
        @include("nav.nav")
    </div>
    <!-- App Contents -->
    <div class="col-span-3 lg:col-span-2">
        <h1 class="fz-6 border-b border-gray-500 font-bold text-3xl p-2">Home</h1>
        <section id="toast-dashboard">
            @include("toast.toast",$toast)
        </section>
        <section id="comments">
             @include('toast.partials.replies', ['comments' => $toast->comments, 'toast_id'=>$toast->id])
        </section>
    </div>
    <!-- Sidebar -->
    <div id="sidebar" class="relative grid-cols-1">
        @include('sidebar.sidebar')
    </div>
</div>
@endsection