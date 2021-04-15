@extends("admin.admin")

@section("content")
    <h1 class="text-3xl text-center font-bold py-3">Danh sách thành viên quản trị</h1>
    {{$members->links()}}
    @if(session()->has('isAdded'))
        <span class="text-red-500 text-lg text-center">{{session()->get('isAdded')}}</span>
    @endif
    <table class="w-4/6 m-auto border border-black my-5">
        <thead>
            <tr class="border border-black border-collapse bg-gray-300">
                <th class="border border-black border-collapse p-3">Mã</th>
                <th class="border border-black border-collapse p-3">Họ tên</th>
                <th class="border border-black border-collapse p-3">Địa chỉ email</th>
                <th class="border border-black border-collapse p-3">Số điện thoại</th>
                <th class="border border-black border-collapse p-3">Quyền truy cập</th>
            </tr>
        </thead>
        <tbody>
            @foreach($members as $member)
                <tr class="border border-black border-collapse text-center">
                    <td class="border border-black border-collapse p-3">{{$member->id}}</td>
                    <td class="border border-black border-collapse p-3">{{$member->name}}</td>
                    <td class="border border-black border-collapse p-3">{{$member->email}}</td>
                    <td class="border border-black border-collapse p-3">{{$member->phone}}</td>
                    <td class="border border-black border-collapse p-3">{{$member->role->role_name}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="hidden">
       <button class="bg-green-400 h-12 px-3 focus:outline-none hover:bg-green-500 hover:text-white focus:ring-2 focus:ring-green-400" type="button" id="add-member">Thêm thành viên</button> 
    </div>
    <form action="{{ route('admin.members.add') }}" method="post" class="w-4/6 lg:w-2/6 border border-black flex flex-col justify-center p-5 bg-white-500" id="add-memeber-form" autocomplete="off">
        <h2 class="mb-5 text-center py-3 text-2xl font-medium">Thêm thành viên quản trị
            <i class="fas fa-bread-slice w-auto fa-2x"></i>
        </h2>
        @csrf
        <div class="mb-3">
            <input type="text"
                class="w-full lg:w-full h-12 rounded-full border border-black p-3 bg-transparent focus:outline-none focus:border focus:border-blue-500"
                id="name" name="name" placeholder="Họ tên" value="{{old('name')}}" placeholder="Họ tên" autocomplete="off">
            @error("name")
        <span class="text-red-600">
            {{$message}}
        </span>
        @enderror
        </div>
        <div class="mb-3">
            <input type="text"
                class="w-full lg:w-full h-12 rounded-full border border-black p-3 bg-transparent focus:outline-none focus:border focus:border-blue-500"
                id="username" name="username" placeholder="Tên tài khoản" value="{{old('username')}}" autocomplete="off">
            @error("username")
        <span class="text-red-600">
            {{$message}}
        </span>
        @enderror
        </div>
        <div class="mb-3">
            <input type="email"
                class="w-full lg:w-full h-12 rounded-full border border-black p-3 bg-transparent focus:outline-none focus:border focus:border-blue-500"
                id="email" name="email" placeholder="Địa chỉ email" value="{{old('email')}}" autocomplete="off">
            @error("email")
        <span class="text-red-600">
            {{$message}}
        </span>
        @enderror
        </div>
        <div class="mb-3">
            <input type="text"
                class="w-full lg:w-full h-12 rounded-full border border-black p-3 bg-transparent focus:outline-none focus:border focus:border-blue-500"
                id="phone" name="phone" placeholder="Số điện thoại" value="{{old('phone')}}" autocomplete='off'>
            @error("phone")
        <span class="text-red-600">
            {{$message}}
        </span>
        @enderror
        </div>
        <div class="mb-3">
            <input type="date"
                class="w-full lg:w-full h-12 rounded-full border border-black p-3 bg-transparent focus:outline-none focus:border focus:border-blue-500"
                name="date" value="{{old('date')}}">
            @error("date")
        <span class="text-red-600">
            {{$message}}
        </span>
        @enderror
        </div>
        <div class="mb-3">
            <input type="password"
                class="w-full lg:w-full h-12 rounded-full border border-black p-3 bg-transparent focus:outline-none focus:border focus:border-blue-500"
                id="password" name="password" placeholder="Mật khẩu">
            @error("password")
        <span class="text-red-600">
            {{$message}}
        </span>
        @enderror
        </div>

        <div class="mb-3">
            <input type="password"
                class="w-full lg:w-full h-12 rounded-full border border-black p-3 bg-transparent focus:outline-none focus:border focus:border-blue-500"
                id="password_confirmation" name="password_confirmation" placeholder="Nhập lại mật khẩu">
        @error("password")
        <span class="text-red-600">
            {{$message}}
        </span>
        @enderror
        </div>

        <div class="mb-3">
            <label class="font-bold text-xl">Quyền truy cập: </label>
           <select class="border border-black" name='role'>
                @foreach(App\Models\Role::where('id','!=','1')->get() as $role)
                <option value="{{ $role->id }}">{{$role->role_name}}</option>
                @endforeach
           </select>
        @error("role")
        <span class="text-red-600">
            {{$message}}
        </span>
        @enderror
        </div>
        <div class="w-auto mb-3 mx-auto">
            <button type="submit" class="bg-blue-500 h-12 px-2 rounded-full hover:bg-blue-600 text-white focus:outline-none">
                Thêm thành viên
            </button>
        </div>
    </form>
    <script>
        $("#add-member").click(()=>{
            $("#add-memeber-form").slideToggle();
        })
    </script>
@endsection
