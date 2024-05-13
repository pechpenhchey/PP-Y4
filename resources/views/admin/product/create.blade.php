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
                                <h1 class="mb-0">Add Product</h1>
                                <hr />
                                @if (session()->has('error'))
                                <div>
                                    {{session('error')}}
                                </div>
                                @endif
                                <p><a href="{{ route('admin/products') }}" class="btn btn-primary">Go Back</a></p>
            
                                <form action="{{ route('admin/products/save') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row mb-3">
                                        <div class="col">
                                            <input type="text" name="title" class="form-control" placeholder="Title">
                                            @error('title')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col">
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
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col">
                                            <input type="number" name="price" class="form-control" placeholder="Price">
                                            @error('price')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col">
                                            <textarea id="task-textarea1" name="description" class="form-control" placeholder="Description"></textarea>
                                            @error('description')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col">
                                            <input type="file" name="image" class="form-control" accept="image/*">
                                            @error('image')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="d-grid">
                                            <button class="btn btn-primary">Submit</button>
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
                .create( document.querySelector( '#task-textarea1' ) )
                .catch( error => {
                    console.error( error );
                } );
        </script>
    @endsection
</x-app-layout>
