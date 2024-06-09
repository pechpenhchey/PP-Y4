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
                                                        <h2>User <b>Management</b></h2>
                                                    </div>
                                                    <div class="col-sm-7">
                                                        <a href="{{ route('admin.users.create') }}"
                                                            class="btn btn-primary mb-3 me-3" style="width: auto;"><i
                                                                class="material-icons">&#xE147;</i> Add</a>
                                                        <form method="GET" action="{{ route('admin.users.index') }}"
                                                            class="d-inline-block">
                                                            <div class="input-group">
                                                                <input type="text" name="search"
                                                                    class="form-control" placeholder="Search users..."
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
                                                        <th>Name</th>
                                                        <th>Email</th>
                                                        <th>Role</th>
                                                        <th>Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse ($users as $user)
                                                        <tr>
                                                            <td>{{ $user->id }}</td>
                                                            <td>{{ $user->name }}</td>
                                                            <td>{{ $user->email }}</td>
                                                            <td>{{ $user->usertype }}</td>
                                                            <td>
                                                                <a href="{{ route('admin.users.edit', $user->id) }}"
                                                                    class="settings" title="Settings"
                                                                    data-toggle="tooltip"><i
                                                                        class="material-icons">&#xE8B8;</i></a>
                                                                <form
                                                                    action="{{ route('admin.users.destroy', $user->id) }}"
                                                                    method="POST" style="display:inline;">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <a href="javascript:void(0);" class="delete"
                                                                        title="Delete" data-toggle="tooltip"
                                                                        onclick="confirmDelete('{{ route('admin.users.destroy', $user->id) }}')">
                                                                        <i class="material-icons">&#xE5C9;</i>
                                                                    </a>
                                                                </form>
                                                            </td>
                                                        </tr>
                                                    @empty
                                                        <tr>
                                                            <td class="text-center" colspan="5">User not found</td>
                                                        </tr>
                                                    @endforelse
                                                </tbody>
                                            </table>
                                            <div class="clearfix">
                                                <ul class="paginations">
                                                    {{ $users->appends(['search' => request('search')])->links() }}
                                                </ul>
                                            </div>
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

    </html>
</x-app-layout>
