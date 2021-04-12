<div class="modal w-full h-full" id="comment">
    <div class="modal__content text-gray-300 w-full h-full lg:w-2/6 lg:h-auto lg:mt-12 lg:mx-auto">
        <span class="modal__close">&times;</span>
        <h1 class='text-3xl my-3'>Reply</h1>
        <p class='my-3'>
            Reply to
            <span class="mx-1 font-bold">
                {{ $user->name}}
            </span>
            <span class="mx-2 italic">
                {{ $user->username }}
            </span>
        </p>
        <form method='post' action="{{ route('comment.store') }}">
            @csrf
            <input type="hidden" name="toast_id" value="{{ $toast_id }}" />
            <textarea class="bg-transparent w-full h-full resize-none outline-none p-3" placeholder="Say something nice..." name='comment'></textarea>
            <button type="submit" class="rounded-full h-10 w-16 bg-blue-600 focus:outline-none ml-auto focus:ring-2 hover:bg-blue-700">
                Reply
            </button>
        </form>
    </div>
</div>