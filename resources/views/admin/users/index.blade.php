<x-app-layout>
<link href="{{ asset('css/table.css') }}" rel="stylesheet">

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
                                        <h2>User <b>Management</b></h2>
                                    </div>
                                    <div class="col-sm-7">
                                        <a href="{{ route('admin.users.create') }}" class="btn btn-primary mb-3 me-3" style="width: auto;"><i class="material-icons">&#xE147;</i> Add</a>
                                        <a href="#" class="btn btn-secondary"><i class="material-icons">&#xE24D;</i> <span>Export to Excel</span></a>						
                                    </div>
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
                                                <a href="{{ route('admin.users.edit', $user->id) }}" class="settings" title="Settings" data-toggle="tooltip"><i class="material-icons">&#xE8B8;</i></a>
                                                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="delete text-danger" title="Delete" data-toggle="tooltip" style="border:none; background:none;">
                                                        <i class="material-icons">&#xE5C9;</i>
                                                    </button>
                                                </form>                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td class="text-center" colspan="5">User not found</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            <div class="clearfix">
                                <div class="hint-text">Showing <b>5</b> per entries</div>
                                <ul class="pagination">
                                    <li class="page-item disabled"><a href="#">Previous</a></li>
                                    <li class="page-item"><a href="#" class="page-link">1</a></li>
                                    <li class="page-item"><a href="#" class="page-link">2</a></li>
                                    <li class="page-item active"><a href="#" class="page-link">3</a></li>
                                    <li class="page-item"><a href="#" class="page-link">4</a></li>
                                    <li class="page-item"><a href="#" class="page-link">5</a></li>
                                    <li class="page-item"><a href="#" class="page-link">Next</a></li>
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
