<x-app-layout>
    <link href="{{ asset('css/table.css') }}" rel="stylesheet">

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-auto sidebar px-0">
                @include('admin.sidebar')
            </div>
            <div class="col">
                <div class="py-12">
                    <div class="container contact-form">
                        <hr />
                        @if (session()->has('error'))
                            <div>
                                {{ session('error') }}
                            </div>
                        @endif
                        <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <span class="fs-5">Edit User</span>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" name="name" id="name" class="form-control" placeholder="Name" value="{{ $user->name }}">
                                        @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    
                                    <div class="form-group">
                                        <input type="email" name="email" class="form-control" placeholder="Email" value="{{ $user->email }}">
                                        @error('email')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <input type="password" name="password" class="form-control" placeholder="Password">
                                        <small class="form-text text-muted">Leave blank if you don't want to change the password.</small>
                                        @error('password')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <select name="usertype" id="usertype" class="form-control">
                                            <option value="">Select Role</option>
                                                <option value="admin" {{ $user->usertype === 'admin' ? 'selected' : '' }}>Admin</option>
                                                <option value="user" {{ $user->usertype === 'user' ? 'selected' : '' }}>User</option>     
                                        </select>
                                        @error('usertype')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row d-flex justify-end">
                                <div class="col-lg-3 col-md-6" style="width: 100px">
                                    <button class="btn btn-primary">Update</button>
                                </div>
                                <div class="col-lg-3 col-md-6" style="width: 100px">
                                    <button class="btn btn-danger"><a class="text-decoration-none text-white" href="{{ route('admin.users.index') }}">Cancel</a></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>