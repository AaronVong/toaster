@foreach($toasts as $toast)
    @include('toast.toast',$toast)
@endforeach
{{ $toasts->links() }}