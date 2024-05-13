<x-app-layout>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-auto sidebar px-0">
                @include('admin.sidebar')
            </div>
            <div class="col">
                <div class="py-12">
                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="p-6 text-gray-900">
                                <h1 class="mb-3">Edit Product</h1>
                                <a href="{{ route('admin/products') }}" class="btn btn-primary mb-3">Back</a>
                                <hr />
                                <form action="{{ route('admin/products/update', $products->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="row mb-3">
                                        <div class="col">
                                            <label class="form-label">Product Name</label>
                                            <input type="text" name="title" class="form-control" placeholder="Title" value="{{$products->title}}">
                                            @error('title')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col">
                                            <label class="form-label">Category</label>
                                            <select name="category_id" class="form-control">
                                                <option value="">Select Category</option>
                                                @foreach($categories as $category)
                                                    <option value="{{ $category->id }}" @if($category->id == $products->category_id) selected @endif>{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('category_id')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col">
                                            <label class="form-label">Price</label>
                                            <input type="text" name="price" class="form-control" placeholder="Product Price" value="{{$products->price}}">
                                            @error('price')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col">
                                            <label class="form-label">Description</label>
                                            <textarea id="task-textarea" name="description" class="form-control" placeholder="Product Description">{{$products->description}}</textarea>
                                            @error('description')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col">
                                            <label class="form-label">Image</label>
                                            <input type="file" name="image" class="form-control">
                                            @error('image')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="d-grid">
                                            <button class="btn btn-warning">Update</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @section('scripts')
        <script>
            ClassicEditor
                .create( document.querySelector( '#task-textarea' ) )
                .catch( error => {
                    console.error( error );
                } );
        </script>
    @endsection
</x-app-layout>
