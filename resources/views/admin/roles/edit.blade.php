<x-admin-master>
    @section('content')

    @if(session()->has('role-updated'))
    <div class="alert alert-success">
        {{session('role-updated')}}
    </div>
    @endif


    <div class="col-sm-6">
        <h1>Edit Role: {{$role->name}}</h1>

        <form method="POST" action="{{route('roles.update', $role->id)}}">
            @csrf
            @method('put')
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" name="name" id="name" value="{{$role->name}}">
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
        </form>

    </div>

    @endsection
</x-admin-master>