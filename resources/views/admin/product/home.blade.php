<x-app-layout>
    <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">
    <link href="{{ asset('css/table.css') }}" rel="stylesheet">

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
                                <div class="container-xl">
                                    <div class="table-responsive">
                                        <div class="table-wrapper">
                                            <div class="table-title">
                                                <div class="row">
                                                    <div class="col-sm-5">
                                                        <h2>Food <b>Management</b></h2>
                                                    </div>
                                                    <div class="col-sm-7">
                                                        <a href="{{ route('admin/products/create') }}"
                                                            class="btn btn-secondary">
                                                            <i class="material-icons">&#xE147;</i> <span>Add</span>
                                                        </a>
                                                        <form method="GET" action="{{ route('admin/products') }}"
                                                            class="d-inline-block">
                                                            <div class="input-group">
                                                                <input type="text" name="search"
                                                                    class="form-control" placeholder="Search foods..."
                                                                    value="{{ request('search') }}">
                                                                <div class="input-group-append">
                                                                    <button class="btn"
                                                                        style="background-color: rgb(255, 255, 255)"
                                                                        type="submit">
                                                                        <i class="fa-solid fa-magnifying-glass"></i>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr />
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
                                                            <td>
                                                                <a href="#"><img
                                                                        src="{{ asset('images/' . $product->image) }}"
                                                                        class="avatar" alt="{{ $product->title }}"
                                                                        style="width: 120px; height: 80px;"></a>
                                                            </td>
                                                            <td>{{ $product->title }}</td>
                                                            <td>{{ $product->category->name ?? 'No Category' }}</td>
                                                            <td>{!! $product->description !!}</td>
                                                            <td>$ {{ $product->price }}</td>
                                                            <td>
                                                                <a href="{{ route('admin/products/edit', ['id' => $product->id]) }}"
                                                                    class="settings" title="Settings"
                                                                    data-toggle="tooltip">
                                                                    <i class="material-icons">&#xE8B8;</i>
                                                                </a>
                                                                <a href="javascript:void(0);" class="delete"
                                                                    title="Delete" data-toggle="tooltip"
                                                                    onclick="confirmDelete('{{ route('admin/products/delete', ['id' => $product->id]) }}')">
                                                                    <i class="material-icons">&#xE5C9;</i>
                                                                </a>
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
                                                <ul class="paginations">
                                                    {{ $products->appends(['search' => request('search')])->links() }}
                                                </ul>
                                            </div>
                                        </div>
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
</x-app-layout>
