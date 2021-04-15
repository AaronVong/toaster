<div class="toast max-w-full flex border-b border-gray-500 p-2">
    <div class="toast__left flex-grow-0 flex-shrink-0 max-w-xs px-2 pt-2">
        @if($toast->user->image !== null && $toast->user->image !== '')
            <div class="w-16 h-16 flex items-center justify-center">
                <img src="{{ asset('storage/userimages/'.$toast->user->image)}}" class="block w-full h-full rounded-full" />
            </div>
        @else
            <div class="w-16 h-16 flex items-center justify-center">
                <img src="https://via.placeholder.com/50" class="block w-full h-full rounded-full" />
            </div>
        @endif
    </div>
    <div class="toast__right w-full flex-shrink-1 flex-grow-1">
        <div class="toast__header order-2 py-2 px-1">
            <div class="header__heading flex">
                <a href="{{ route('user.show', $toast->user) }}" class="mr-2 hover:underline text-white font-bold"><span class="">{{$toast->user->name}}</span></a>
                <span class='italic mr-2'>{{$toast->user->username}}</span>
                <span class="text-gray-700 time">{{$toast->created_at->diffForHumans()}}</span>
                <div class="inline-block relative ml-auto">
                    <span class="cursor-pointer hover:text-gray-400 toast__dots"><i class="fas fa-ellipsis-h"></i></span>
                    <div class="absolute flex flex-col top-full right-0 items-center w-64 bg-gray-900 rounded-lg z-10 hidden toast__tools">
                        @auth
                            @can('delete', $toast)
                                <form action="{{ route('toast.delete', $toast) }}" method="post" class="block my-3 text-center">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-gray-600 hover:text-red-400 focus:outline-none w-full">
                                        <i class="far fa-trash-alt"></i>
                                        Xóa toast
                                    </button>
                                </form>
                            @endcan
                            <!-- <div class="my-3 text-center">
                                <div class="cursor-pointer text-gray-600 hover:text-blue-400 focus:outline-none" data-route="{{route('toast.update',$toast)}}" data-action='toast.update'>
                                    <i class="far fa-edit"></i>
                                    Chỉnh sửa toast
                                </div>
                            </div> -->
                        @endauth
                        <div class="my-3 text-center">
                            <div class="cursor-pointer">
                                <a href="{{ route('toast.show', $toast) }}" class="text-gray-600 hover:text-gray-400 focus:outline-none">
                                    <i class="far fa-eye"></i> Xem toast
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="header__content">
                <a class="block w-full h-full py-4" href="{{ route('toast.show',$toast) }}">
                    {{$toast->content}}
                </a>
                <div class="grid grid-cols-12 py-2 gap-2">
                    @php $count = count($toast->toastImages()->get()) @endphp
                    @if($count > 2)
                        <div class="header__images col-start-3 col-span-8 md:col-start-4 md:col-span-6 rounded-3xl ">
                            @foreach($toast->toastImages()->get() as $image)
                                <img src="{{asset('storage/toastimages/'.$image->imagename)}}" class="block max-w-full h-auto rounded-3xl">
                            @endforeach
                        </div>
                    @else
                        @foreach($toast->toastImages()->get() as $image)
                            <img src="{{asset('storage/toastimages/'.$image->imagename)}}" class="block max-w-full h-auto rounded-3xl col-span-6">
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
        <div class="toast__body order-1">
            <div class="body__actions flex py-2">
                @auth
                    <div class="flex mr-6">
                        @if(!$toast->likedBy(auth()->user()))
                        <div class="actions__like mr-3 cursor-pointer focus:outline-none text-pink-600" role="submit" data-route="{{ route('like.create',$toast) }}" data-like="like">
                            <i class="far fa-heart"></i>
                        </div>
                        @else
                            <div class="actions__like mr-3 cursor-pointer focus:outline-none text-pink-600" role="submit" data-route="{{ route('like.destroy',$toast) }}" data-like="liked">
                                <i class="fas fa-heart"></i>
                            </div>
                        @endif
                        <span style="font-size: 10px" class="p-0 m-0 count">{{ $toast->likes->count()  }} {{ Str::plural('', $toast->likes->count()) }}</span>
                    </div>
                    <div class="actions__comment mr-3 flex mr-6">
                        <button class="modal__btn focus:outline-none text-indigo-600  mr-3" type="button" modal='comment'>
                            <i class="fas fa-comment"></i>
                        </button>
                        <span style="font-size: 10px" class="p-0 m-0 count">{{ App\Models\Toast::receivedComments($toast)  }} {{ Str::plural('', App\Models\Toast::receivedComments($toast)) }}</span>
                    </div>
                    @include('modals.comment', ['toast_id'=>$toast->id, "user" => $toast->user, 'comment_id' => null])
                @endauth
                @guest
                    <div class="inline-block mr-3">
                        <button type="button" class="modal__btn focus:outline-none text-pink-600" modal="auth"><i class="fas fa-heart"></i></button>
                        <span style="font-size: 10px" class="p-0 m-0 count">{{ $toast->likes->count()  }} {{ Str::plural('', $toast->likes->count()) }}</span>
                    </div>
                    <div class="inline-block mr-3">
                      <button class="modal__btn focus:outline-none text-indigo-600" type="button" modal="auth">
                            <i class="fas fa-comment"></i>
                        </button>
                        <span style="font-size: 10px" class="p-0 m-0 count">{{ App\Models\Toast::receivedComments($toast)  }} {{ Str::plural('', App\Models\Toast::receivedComments($toast)) }}</span>
                    </div>     
                @endguest
            </div>
        </div>
    </div>
</div>