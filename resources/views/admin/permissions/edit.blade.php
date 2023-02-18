<x-admin-master>
    @section('content')


        <div class="row">
            <div class="col-sm-6">
                <h1>Edit Permission: {{$permission->name}}</h1>
                <form action="{{route('permissions.update')}}" method="post">
                    @csrf
                    @method('PATCH')

                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="Name" class="form-control" id="name" value="{{$permission->name}}">
                        <button class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    @endsection
</x-admin-master>