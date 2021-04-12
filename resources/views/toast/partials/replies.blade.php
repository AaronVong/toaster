@foreach($comments as $comment)
<div class="px-3 py-2 border-l border-gray-600 ml-3 mt-2">
    <div class="flex items-center">
        <div class="flex-grow-0 flex-shrink-0 max-w-xs px-2 pt-2">
            @if($comment->user->image !== null && $comment->user->image !== '')
                <div class="w-16 h-16 flex items-center justify-center">
                    <img src="{{ asset('storage/userimages/'.$comment->user->image)}}" class="block w-full h-full rounded-full" />
                </div>
            @else
                <div class="w-16 h-16 flex items-center justify-center">
                    <img src="https://via.placeholder.com/50" class="block w-full h-full rounded-full" />
                </div>
            @endif
        </div>
        <div class="">
            <strong>
                <a href="{{ route('user.show', $comment->user->username) }}" class="mr-2 hover:underline text-white font-bold">{{ $comment->user->name }}</a>
            </strong>
            <span class='italic'>{{ $comment->user->username}}</span>
        </div>
        @auth
            @can('delete', $comment)
            <div class="ml-auto">
                <form action="{{ route('comment.destroy',$comment) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-gray-600 hover:text-red-400 focus:outline-none w-full">
                        <i class="far fa-trash-alt"></i>
                    </button>
                </form>
            </div>
            @endcan
        @endauth
    </div>
    <div class="px-5 py-3">
        <p class="">{{ $comment->comment }}</p>
    </div>
    @auth
    <div class="actions__comment mr-3">
        @csrf
        <button class="reply-btn focus:outline-none text-indigo-600" type="button">
            <i class="far fa-comment"></i>
        </button>
        <form class="hidden" action="{{ route('comment.reply') }}" method='post' class="reply-form">
            @csrf
            <input type="hidden" name="toast_id" value="{{ $toast_id }}" />
            <input type="hidden" name="comment_id" value="{{ $comment->id }}" />
            <textarea class="bg-transparent w-full h-full resize-none outline-none p-3 border border-gray-900" placeholder="Say something nice..." name='comment'></textarea>
            <button type="submit" class="rounded-full h-10 w-16 bg-blue-600 focus:outline-none ml-auto focus:ring-2 hover:bg-blue-700">
                Reply
            </button>
        </form>
    </div>
    @endauth
    @include('toast.partials.replies', ['comments' => $comment->replies])
</div>
@endforeach 
