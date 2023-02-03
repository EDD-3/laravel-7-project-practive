<x-admin-master>
    @section('content')
        <h1>User profile for: {{$user->name}}</h1>
        <div class="row">
            <div class="col-sm-6">
                <form action="post" action="" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-4">
                        <img src="https://source.unsplash.com/QAB-WJcbgJk/60x60" class="img-profile rounded-circle" height="60px">
                    </div>

                    <div class="form-group">
                        <input type="file">
                    </div>
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" 
                               name="username" 
                               id="username" 
                               class="form-control"
                               value="{{$user->username}}">
                    </div>
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" 
                               name="name" 
                               id="name" 
                               class="form-control"
                               value="{{$user->name}}">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" 
                               name="email" 
                               id="email" 
                               class="form-control" 
                               value="{{$user->email}}">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" 
                               name="password" 
                               id="password" 
                               class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="password-confirmation">Confirm Password</label>
                        <input type="password" 
                               name="password-confirmation" 
                               id="password-confirmation" 
                               class="form-control">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    @endsection
</x-admin-master>