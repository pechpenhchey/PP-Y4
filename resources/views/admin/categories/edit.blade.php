<x-app-layout>
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
                    <form action="{{ route('categories.update', $category->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <span class="fs-5">Edit Category</span>
                            <div class="form-group">
                                <input type="text" name="name" class="form-control" placeholder="Name" value="{{ $category->name }}">
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>        
                        <div class="row d-flex justify-end">
                            <div class="col-lg-3 col-md-6" style="width: 100px">
                                <button class="btn btn-primary">Update</button>
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