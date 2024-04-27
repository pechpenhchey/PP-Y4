<x-app-layout>
<div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Edit User</div>

                    <div class="card-body">
                        <form action="{{ route('users.update', $user->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" name="name" id="name" class="form-control" value="{{ $user->name }}" required>
                            </div>

                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" id="email" class="form-control" value="{{ $user->email }}" required>
                            </div>

                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" name="password" id="password" class="form-control">
                                <small class="form-text text-muted">Leave blank if you don't want to change the password.</small>
                            </div>

                            <div class="form-group">
                                <label for="usertype">Role</label>
                                <select name="usertype" id="usertype" class="form-control" required>
                                    <option value="admin" {{ $user->usertype === 'admin' ? 'selected' : '' }}>Admin</option>
                                    <option value="user" {{ $user->usertype === 'user' ? 'selected' : '' }}>User</option>
                                </select>
                            </div>


                            <button type="submit" class="btn btn-primary">Update User</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>