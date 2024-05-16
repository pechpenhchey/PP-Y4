<x-app-layout>
<link href="{{ asset('css/table.css') }}" rel="stylesheet">
<link href="{{ asset('css/searchBtn.css') }}" rel="stylesheet">

<div class="container-fluid">
    <div class="row">
        <div class="col-md-auto sidebar px-0">
            @include('admin.sidebar')
        </div>
            <div class="col">
                <div class="py-12">
                    <div class="container-xl">
                        <div class="table-responsive">
                            <div class="table-wrapper">
                                <div class="table-title">
                                    <div class="row">
                                        <div class="col-sm-5">
                                            <h2>Food <b>Management</b></h2>
                                        </div>
                                        <div class="col-sm-7">
                                            <a href="{{ route('admin/products/create') }}" class="btn btn-secondary"><i class="material-icons">&#xE147;</i> <span>Add</span></a>
                                            <form method="GET" action="{{ route('admin/products') }}" class="d-inline-block">
                                                <div class="input-group">
                                                    <input type="text" name="search" class="form-control" placeholder="Search foods..." value="{{ request('search') }}">
                                                    <div class="input-group-append">
                                                        <button class="btn" style="background-color: rgb(255, 255, 255)" type="submit">
                                                            <i class="fa-solid fa-magnifying-glass"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>	                                        </div>
                                    </div>                                   
                                </div>
                                <hr />
                                    @if(Session::has('success'))
                                        <div class="alert alert-success" role="alert">
                                            {{ Session::get('success') }}
                                        </div>
                                    @endif
                                <table class="table table-striped table-hover">
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
                                            <td><a href="#"><img src="{{ asset('images/' . $product->image) }}" class="avatar" alt="{{ $product->title }}"></a></td>
                                            <td>{{ $product->title }}</td>
                                            <td>{{ $product->category->name }}</td>
                                            <td>{!! $product->description !!}</td>
                                            <td>{{ $product->price }}</td>
                                            <td>
                                                <a href="{{ route('admin/products/edit', ['id'=>$product->id]) }}" class="settings" title="Settings" data-toggle="tooltip"><i class="material-icons">&#xE8B8;</i></a>
                                                <a href="{{ route('admin/products/delete', ['id'=>$product->id]) }}" class="delete" title="Delete" data-toggle="tooltip"><i class="material-icons">&#xE5C9;</i></a>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                        <td class="text-center" colspan="7">Food not found</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                                <div class="clearfix">
                                    <div class="hint-text">Showing <b>{{ $products->perPage() }}</b> entries per page</div>
                                    <ul class="pagination">
                                        {{ $products->appends(['search' => request('search')])->links() }}
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>     
                </div>
            </div>
        </div>
    </div>
</x-app-layout>


