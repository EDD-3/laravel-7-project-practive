<x-admin-master>
    @section('content')
        <h1>Create</h1>
        <form action="{{route('post.store')}}" method="post">
            @csrf
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" 
                name="title" id="title" 
                class="form-control" 
                id="title" 
                aria-describedby="" 
                placeholder="Enter title">
            </div>
            <div class="form-group">
                <label for="file">File</label>
                <input type="file" 
                name="post_image" id="post_image" 
                class="form-control-file" 
                placeholder="Upload image">
            </div>
            <div class="form-group">
                <label for="body">Body</label>
                <textarea name="body" id="body" class="form-control" cols="30" rows="10"></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    @endsection
</x-admin-master>