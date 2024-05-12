<x-app-layout>
<link href="{{ asset('css/table.css') }}" rel="stylesheet">

<div class="container-fluid">
    <div class="row">
        <div class="col-md-auto sidebar px-0">
            @include('admin.sidebar')
        </div>
        <div class="col">
            <div class="py-12">
                <div class="container">
                    <div class="row">
                        <div class="col-12 col-sm-12 col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4><b>User list</b></h4>
                                </div>
                                <div class="card-body row justify-content-end">
                                <a href="{{ route('admin.users.create') }}" class="btn btn-primary mb-3 me-3" style="width: auto;">Add</a>
                                    <div class="table-responsive" id="proTeamScroll" tabindex="2" style="height: 400px; overflow: hidden; outline: none;">
                                        <table class="table table-striped">
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
                                                @foreach ($users as $user)
                                                <tr>
                                                    <td>{{ $user->id }}</td>
                                                    <td>{{ $user->name }}</td>
                                                    <td>{{ $user->email }}</td>
                                                    <td>{{ $user->usertype }}</td>
                                                    <td>
                                                        <div class="btn-group" role="group" aria-label="User Actions">
                                                            <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-primary btn-sm me-2"><i class="fa-regular fa-pen-to-square"></i></a>
                                                            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-danger btn-sm me-2" onclick="return confirm('Are you sure you want to delete this user?')"><i class="fa-solid fa-trash"></i></button>
                                                            </form>
                                                        </div>
                                                    </td>
                                                </tr>
                                                @endforeach
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
</div>
</x-app-layout>
