<x-admin-master>
    @section('content')
        <div class="row">
            <div class="col-sm-6 mb-2">
                <h1>Edit Role: {{ $role->name }}</h1>

                <form action="{{ route('roles.update', $role->id) }}" method="post">
                    @csrf
                    @method('patch')

                    <div class="form-group ">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ $role->name }}">
                    </div>

                    <button type="submit" class="btn btn-primary">Update</button>

                </form>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                @if($permissions->isNotEmpty())
                <!-- DataTales Example -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Permissions</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Options</th>
                                        <th>Id</th>
                                        <th>Name</th>
                                        <th>Slug</th>
                                        <th>Attach</th>
                                        <th>Detach</th>
                                        <th>Created at</th>
                                        <th>Updated at</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Options</th>
                                        <th>Id</th>
                                        <th>Name</th>
                                        <th>Slug</th>
                                        <th>Attach</th>
                                        <th>Detach</th>
                                        <th>Created at</th>
                                        <th>Updated at</th>
                                        <th>Deletes</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                   @foreach($permissions as $permission)
                                        <tr>
                                            <td><input type="checkbox"
                                                @foreach($role->permissions as $role_permission)
                                                
                                                @if($role_permission->slug===$permission->slug)
                                                checked
                                                @endif
                                                @endforeach></td>
                                            <td>{{$permission->id}}</td>
                                            <td>{{$permission->name}}</td>
                                            <td>{{$permission->slug}}</a></td>
                                                <td>
                                                    <form method="post" action="{{ route('roles.permissions.attach', $role->id) }}">
                                                        @csrf
                                                        @method('PATCH')
    
                                                        <input type="hidden" name="permission" value="{{ $permission->id }}">
    
                                                        <button type="submit" class="btn btn-primary"
                                                            @if ($role->permissions->contains($permission)) disabled @endif>Attach</button>
                                                    </form>
                                                </td>
                                                <td>
                                                    <form method="post" action="{{ route('roles.permissions.detach', $role->id) }}">
                                                        @csrf
                                                        @method('PATCH')
    
                                                        <input type="hidden" name="permission" value="{{ $permission->id }}">
    
                                                        <button type="submit" class="btn btn-warning"
                                                            @if (!$role->permissions->contains($permission)) disabled @endif>Detach</button>
                                                    </form>
                                                </td>
                                            <td>{{$permission->created_at->diffForHumans()}}</td>
                                            <td>{{$permission->updated_at->diffForHumans()}}</td>
                                            <td><button type="button" class="btn btn-danger">Delete</button></td>
                                        </tr>
                                        @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    @endsection
</x-admin-master>
