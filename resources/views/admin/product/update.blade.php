<x-app-layout>
    <x-bar-layout>
        @section('content')
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
                        <form action="{{ route('admin/products/update', $products->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <span class="fs-5">Edit Food</span>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" name="title" class="form-control" placeholder="Title" value="{{$products->title}}">
                                        @error('title')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <select name="category_id" class="form-control">
                                            <option value="">Select Category</option>
                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}" @if($category->id == $products->category_id) selected @endif>{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <input type="number" name="price" class="form-control" placeholder="Price" step="0.01" required value="{{$products->price}}">
                                        @error('price')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    @include('components.image-upload')
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <textarea id="task-textarea" name="description" class="form-control" placeholder="Description">{{$products->description}}</textarea>
                                        @error('description')
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
                                <a class="text-decoration-none text-white" href="{{ route('admin/products') }}">Cancel</a>
                            </button>
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
        
        @endsection
    </x-bar-layout>
</x-app-layout>
