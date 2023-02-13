<x-admin-master>
    @section('content')
        @if (session('message'))
            <div class="alert alert-danger">{{ session('message') }}</div>
        @elseif(session('post-created-message'))
            <div class="alert alert-success">{{ session('post-created-message') }}</div>
        @endif

        @if (count($posts) >= 1)
            <h1>All Posts</h1>

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Posts</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <td>Owner</td>
                                    <th>Title</th>
                                    <th>Body</th>
                                    <th>Image</th>
                                    <th>Created At</th>
                                    <th>Updated At</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Id</th>
                                    <th>Owner</th>
                                    <th>Title</th>
                                    <th>Body</th>
                                    <th>Image</th>
                                    <th>Created At</th>
                                    <th>Updated At</th>
                                    <th>Delete</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach ($posts as $post)
                                    <tr>
                                        <td>{{ $post->id }}</td>
                                        <td>{{ $post->user->name }}</td>
                                        <td><a href="{{ route('post.edit', $post->id) }}">{{ $post->title }}</a></td>
                                        <td>{{ $post->body }}</td>
                                        <td><img src="{{ $post->post_image }}" height="100px"></td>
                                        <td>{{ $post->created_at->diffForHumans() }}</td>
                                        <td>{{ $post->updated_at->diffForHumans() }}</td>
                                        <td>
                                            {{-- //Using post policy to display delete button to avoid user deleting post that dont belong to him/her --}}
                                            @can('view', $post)
                                                <form action="{{ route('post.destroy', $post->id) }}" method="post"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                </form>
                                            @endcan
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="d-flex">
                <div class="mx-auto">
                    {{ $posts->links() }}
                </div>
            </div>
        @else
            <h1>No Posts 👀</h1>
        @endif
    @endsection
    @section('scripts')
        <!-- Page level plugins -->
        <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
        <!-- Page level custom scripts -->
        {{-- <script src="{{asset('js/demo/datatables-demo.js')}}"></script> --}}
    @endsection
</x-admin-master>
