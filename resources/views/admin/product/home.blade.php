<x-app-layout>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-auto sidebar px-0">
            @include('admin.sidebar')
        </div>
            <div class="col">
                <div class="py-12">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                                    <div class="p-6 text-gray-900">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <h1 class="mb-0">Food list</h1>
                                            <a href="{{ route('admin/products/create') }}" class="btn btn-primary mb-3">Add Product</a>
                                        </div>
                                        <hr />
                                        @if(Session::has('success'))
                                            <div class="alert alert-success" role="alert">
                                                {{ Session::get('success') }}
                                            </div>
                                        @endif
                                        <table class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Image</th>
                                                    <th>Title</th>
                                                    <th>Category</th>
                                                    <th>Description</th>
                                                    <th>Price</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($products as $product)
                                                    <tr>
                                                        <td>{{ $product->id }}</td>
                                                        <td style="width: 100px; height: 100px;">
                                                            <img src="{{ asset('images/' . $product->image) }}" alt="{{ $product->title }}" style="max-width: 100%; max-height: 100%;">
                                                        </td>
                                                        <td>{{ $product->title }}</td>
                                                        <td>{{ $product->category->name }}</td>
                                                        <td>{!! $product->description !!}</td>
                                                        <td>{{ $product->price }}</td>
                                                        <td>
                                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                                <a href="{{ route('admin/products/edit', ['id'=>$product->id]) }}" type="button" class="btn btn-primary">Edit</a>
                                                                <a href="{{ route('admin/products/delete', ['id'=>$product->id]) }}" type="button" class="btn btn-danger">Delete</a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td class="text-center" colspan="7">Product not found</td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>


