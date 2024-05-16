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
                    <form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <span class="fs-5">Add Category</span>
                            <div class="form-group">
                                <input type="text" name="name" class="form-control" placeholder="Name">
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>        
                        <div class="row d-flex justify-end">
                            <div class="col-lg-3 col-md-6" style="width: 100px">
                                <button class="btn btn-primary">Submit</button>
                            </div>
                            <div class="col-lg-3 col-md-6" style="width: 100px">
                                <button class="btn btn-danger"><a class="text-decoration-none text-white" href="{{ route('admin.categories.index') }}">Cancel</a></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        </div>
</x-app-layout>
