<x-app-layout>
    <x-slot name="header">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>User Management</h3>
                <p class="text-subtitle text-muted">Fitur CRUD dengan Soft Delete</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                    </ol>
                </nav>
            </div>
        </div>
    </x-slot>


    <section class="section">
        @if (session('message'))
        <div class="alert alert-success">{{ session('message') }}</div>
        @endif
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Users Data
                    <a class="btn btn-sm btn-primary float-end" data-bs-toggle="modal" data-bs-target="#AddDataModal">Add User</a>
                </h4>
            </div>
            <div class="card-body">
                @if (session()->has('success'))
                <div class="alert mt-1 alert-success text-center alert-dismissible fade show" role="alert">
                    <i class="fa-solid fa-circle-check text-success"></i>
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $item)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$item->name}}</td>
                            <td>{{$item->username}}</td>
                            <td>{{$item->email}}</td>
                            <td>{{$item->name}}</td>
                            <td class="d-flex">
                                @if (Auth::user()->id == $item->id)
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#EditDataModal{{ $item->id }}">
                                    <i class="bi bi-pencil-square"></i>
                                </button>
                                <form action="{{ url('/user/' . $item->id) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button type="submit" class="btn btn-danger" disabled><i class="bi bi-trash-fill"></i></button>
                                </form>
                                @else
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#EditDataModal{{ $item->id }}">
                                    <i class="bi bi-pencil-square"></i>
                                </button>
                                <form action="{{ url('/user/' . $item->id) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button type="submit" class="btn btn-danger"><i class="bi bi-trash-fill"></i></button>
                                </form>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <a href="{{ route('user.trash') }}"><button class="btn btn-danger btn-sm"><i class="bi bi-trash-fill me-2"></i>View Trash</button></a>
            </div>
        </div>
    </section>

    <!-- Modal Add User-->
    <div class="modal fade" id="AddDataModal" tabindex="-1" aria-labelledby="AddDataModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('user.create') }}" method="post">
                    @csrf
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="AddDataModal">Add User</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <label for="name" class="form-label">Full Name</label>
                        <input type="text" name="name" class="form-control mb-2" placeholder="Your Name" required>
                        <label for="username" class="form-label">Username</label>
                        <input type="text" name="username" class="form-control mb-2" placeholder="Username" required>
                        <label for="email" class="form-label">Email address</label>
                        <input type="email" name="email" class="form-control mb-2" placeholder="Email" required>
                        <label for="select" class="form-label">Password</label>
                        <input type="password" name="password" class="form-control mb-2" placeholder="Password" required>
                        <label for="select" class="form-label">Role User</label>
                        <select class="form-select" aria-label="Default select example" name="role">
                            <option value="admin">Admin</option>
                            <option value="user">User</option>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Edit User-->
    <div class="modal fade" id="EditDataModal{{ $item->id }}" tabindex="-1" aria-labelledby="EditDataModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ url('/user/' . $item->id) }}" method="post">
                    @csrf
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="EditDataModal">Edit User</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <label for="name" class="form-label">Full Name</label>
                        <input type="text" name="name" class="form-control mb-2" placeholder="Your Name" required value="{{ $item->name }}">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" name="username" class="form-control mb-2" placeholder="Username" required value="{{ $item->username }}">
                        <label for="email" class="form-label">Email address</label>
                        <input type="email" name="email" class="form-control mb-2" placeholder="Email" required value="{{ $item->email }}">
                        <label for="select" class="form-label">Password</label>
                        <input type="password" name="password" class="form-control mb-2" placeholder="Password" required value="{{ $item->password }}">
                        <label for="select" class="form-label">Role User</label>
                        <select class="form-select" aria-label="Default select example" name="role">
                            <option value="admin" {{ $item->role == 'admin' ? 'Selected' : '' }}>
                                Admin
                            </option>
                            <option value="user" {{ $item->role == 'user' ? 'Selected' : '' }}>
                                User
                            </option>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>