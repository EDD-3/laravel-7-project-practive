<x-admin-master>
    @section('content')
        <h1>User profile for: {{ $user->name }}</h1>
        <div class="row">
            <div class="col-sm-6">
                <form method="post" action="{{ route('user.profile.update', $user) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-4">
                        <img src="{{ $user->avatar }}" class="img-profile rounded-circle" height="60px">
                    </div>

                    <div class="form-group">
                        <input type="file" name="avatar">
                    </div>

                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" name="username" id="username"
                            class="form-control @error('username') is-invalid @enderror" value="{{ $user->username }}">

                        @error('username')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name" class="form-control"
                            value="{{ $user->name }}">


                        @error('name')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" name="email" id="email" class="form-control"
                            value="{{ $user->email }}">

                        @error('email')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" class="form-control">


                        @error('password')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="password-confirmation">Confirm Password</label>
                        <input type="password" name="password-confirmation" id="password-confirmation" class="form-control">


                        @error('password-confirmation')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-sm-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Roles</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="usersTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Options</th>
                                        <th>Id</th>
                                        <td>Name</td>
                                        <th>Slug</th>
                                        <th>Attach</th>
                                        <th>Detach</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Options</th>
                                        <th>Id</th>
                                        <td>Name</td>
                                        <th>Slug</th>
                                        <th>Attach</th>
                                        <th>Detach</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @foreach ($roles as $role)
                                        <tr>
                                            <td><input type="checkbox"
                                                    @foreach ($user->roles as $user_role)
                                        @if ($user_role->slug === $role->slug)
                                            checked
                                        @endif @endforeach>
                                            </td>
                                            <td>{{ $role->id }}</td>
                                            <td>{{ $role->name }}</td>
                                            <td>{{ $role->slug }}</td>
                                            <td>
                                                <form method="post" action="{{ route('user.role.attach', $user->id) }}">
                                                    @csrf
                                                    @method('PATCH')

                                                    <input type="hidden" name="role" value="{{ $role->id }}">

                                                    <button type="submit" class="btn btn-primary"
                                                        @if ($user->roles->contains($role)) disabled @endif>Attach</button>
                                                </form>
                                            </td>
                                            <td>
                                                <form method="post" action="{{ route('user.role.detach', $user->id) }}">
                                                    @csrf
                                                    @method('PATCH')

                                                    <input type="hidden" name="role" value="{{ $role->id }}">

                                                    <button type="submit" class="btn btn-danger"
                                                        @if (!$user->roles->contains($role)) disabled @endif>Detach</button>
                                                </form>
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
    @endsection

    @section('scripts')
        <!-- Page level plugins -->
        <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

        {{-- Pagination scripts --}}
        <!-- Page level custom scripts -->
        {{-- <script src="{{asset('js/demo/datatables-demo.js')}}"></script> --}}
    @endsection
</x-admin-master>
