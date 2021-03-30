<div class="w-full flex border-b-4 border-gray-500">
    <div class="flex-shrink-0 flex-grow-0 max-w-xs px-2 pt-2">
        <img src="https://via.placeholder.com/50" class="block w-full rounded-full" />
    </div>
    <div class="w-full flex-shrink-1 flex-grow-1">
        <form class="toast__form" method="post" action="{{ route('toast.create') }}">
            @csrf
            <div class="w-full h-full">
                <textarea placeholder="Toast somethings..."
                    class="bg-transparent w-full h-full resize-none outline-none p-3" name="content"></textarea>
            </div>
            <div class="flex items-center toast__actions w-full py-1 px-3">
                <ul class="flex">
                    <li class="mr-4">
                        <button type="button" class="focus:outline-none text-blue-600 hover:text-blue-400">
                            <i class="fas fa-photo-video"></i>
                        </button>
                    </li>
                    <li class="mr-4 relative">
                        <button type="button" class="focus:outline-none text-blue-600 emoji-picker-btn hover:text-blue-400">
                            <i class="far fa-smile-wink"></i>
                        </button>
                        <div class="emoji-picker-panel hidden">
                            <emoji-picker></emoji-picker>
                        </div>
                    </li>
                </ul>
                <div class="flex ml-auto">
                    <button
                    class="actions__toast rounded-full h-10 w-16 bg-blue-600 focus:outline-none ml-auto disabled-btn focus:ring-2 hover:bg-blue-700" type="submit" disabled>
                        Toast
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>