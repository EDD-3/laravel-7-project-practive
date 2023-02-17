<x-admin-master>
    @section('content')

        <h1>Edit Role: {{ $role->name }}</h1>

        <form action="{{ route('roles.update', $role->id) }}" method="post">
            @csrf
            @method('patch')
            <div class="col-sm-6">
                <div class="form-group ">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ $role->name }}">
                </div>

                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
    @endsection
</x-admin-master>
