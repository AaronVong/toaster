<div class="w-full flex border-b-4 border-gray-500 px-3">
    <div class="flex-shrink-0 flex-grow-0 max-w-xs pt-2">
        @if(auth()->user()->image !== null && auth()->user()->image !== '')
        <div class="w-16 h-16 flex items-center justify-center">
            <img src="{{ asset('storage/userimages/'.auth()->user()->image)}}" class="block w-full h-full rounded-full" />
        </div>
        @else
            <div class="w-16 h-16 flex items-center justify-center">
                <img src="https://via.placeholder.com/50" class="block w-full rounded-full" />
            </div>
        @endif
    </div>
    <div class="w-full flex-shrink-1 flex-grow-1">
        <form class="toast__form" method="post" action="{{ route('toast.create') }}" enctype="multipart/form-data">
        @csrf    
        <div class="w-full h-full">
                <textarea placeholder="Toast somethings..."
                    class="bg-transparent w-full h-full resize-none outline-none p-3" name="content"></textarea>
                @if($errors->toast->has("content"))
                    <span class="text-red-400">{{$errors->toast->first('content')}}</span>
                @endif

                @if($errors->toast->has("images.*"))
                    <span class="text-red-400">{{$errors->toast->first('images.*')}}</span>
                @endif

                @if($errors->toast->has("images"))
                    <span class="text-red-400">{{$errors->toast->first('images')}}</span>
                @endif
                <div id="toast__form__preview" class="w-full grid grid-cols-2 grid-rows-auto md:grid-cols-3 lg:grid-cols-4 gap-1 h-auto">
                </div>
                <input class="toast__form__inputfile invisible" type="file" accept="image/*" multiple="multiple" name="images[]">
            </div>
            <div class="flex items-center toast__actions w-full py-1 px-3">
                <ul class="flex">
                    <li class="mr-4">
                        <div class="focus:outline-none text-blue-600 hover:text-blue-400 cursor-pointer" name='media'>
                            <i class="fas fa-photo-video"></i>
                        </div>
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