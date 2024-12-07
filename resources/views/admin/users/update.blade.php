<x-app-layout>
    <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">
    
    <body id="page-top">
    
        <!-- Page Wrapper -->
        <div id="wrapper">
    
            <!-- Sidebar -->
            @include('admin.sidebar')
            <!-- End of Sidebar -->
    
            <!-- Content Wrapper -->
            <div id="content-wrapper" class="d-flex flex-column">
    
                <!-- Main Content -->
                <div id="content">
    
                    <!-- Topbar -->
                    @include('admin.topbar')
                    <!-- End of Topbar -->
    
                    <!-- Begin Page Content -->
                    <div class="container-fluid">
                        <!-- Content Row -->
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
                            <div class="row d-flex">
                                <div class="col-lg-1 col-md-3" style="width: 100px">
                                    <button class="btn btn-primary">Update</button>
                                </div>
                            </div>
                        </form>
                        <div class="col-lg-1 col-md-3" style="width: 100px; margin-top: -38px; margin-left: 80px;">
                            <button class="btn btn-danger">
                                <a class="text-decoration-none text-white" href="{{ route('admin.users.index') }}">Cancel</a>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
                <!-- End of Main Content -->
            </div>
            <!-- End of Content Wrapper -->
    
        </div>
        <!-- End of Page Wrapper -->
    
    </body>
    
    </html>
    </x-app-layout>
    