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
                        <form action="{{ route('admin/products/save') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <span class="fs-5">Add Food</span>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" name="title" class="form-control" placeholder="Title">
                                        @error('title')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <select name="category_id" class="form-control">
                                            <option value="">Select Category</option>
                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <input type="number" name="price" class="form-control" placeholder="Price">
                                        @error('price')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <input type="file" name="image" class="form-control" accept="image/*">
                                        @error('image')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <textarea id="task-textarea1" name="description" class="form-control" placeholder="Description"></textarea>
                                        @error('description')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row d-flex justify-end">
                                <div class="col-lg-3 col-md-6" style="width: 100px">
                                    <button class="btn btn-primary">Submit</button>
                                </div>
                                <div class="col-lg-3 col-md-6" style="width: 100px">
                                    <button class="btn btn-danger"><a class="text-decoration-none text-white" href="{{ route('admin/products') }}">Cancel</a></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @section('scripts')
        <script>
            ClassicEditor
                .create(document.querySelector('#task-textarea1'))
                .catch(error => {
                    console.error(error);
                });
        </script>
    @endsection
</x-app-layout>
