<x-admin-master>
    @section('content')

    @if(session()->has('permission-updated'))
    <div class="alert alert-success">
        {{session('permission-updated')}}
    </div>
    @endif

    <div class="row">
        <div class="col-sm-6">
            <h1>Edit Permission: {{$permission->name}}</h1>

            <form method="POST" action="{{route('permissions.update', $permission->id)}}">
                @csrf
                @method('put')
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" name="name" id="name" value="{{$permission->name}}">
                </div>

                <button type="submit" class="btn btn-primary">Update</button>
            </form>

        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            @if($roles->isNotEmpty())
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Roles</h6>
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
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach($roles as $role)
                                <tr>
                                    <td><input type="checkbox" @foreach($permission->roles as $permission_role)
                                        @if($permission_role->slug ==$role->slug)
                                        checked
                                        @endif
                                        @endforeach
                                        ></td>
                                    <td>{{$role->id}}</td>
                                    <td>{{$role->name}}</td>
                                    <td>{{$role->slug}}</td>
                                    <td>
                                        <form method="post" action="{{route('permission.role.attach', $permission) }}">
                                            @method('PUT')
                                            @csrf
                                            <input type="hidden" name="role" value="{{$role->id}}">
                                            <button type="submit" class="btn btn-primary" @if($permission->roles->contains($role))
                                                disabled
                                                @endif
                                                >Attach</button>
                                        </form>
                                    </td>
                                    <td>
                                        <form method="post" action="{{route('permission.role.detach', $permission) }}">
                                            @method('PUT')
                                            @csrf
                                            <input type="hidden" name="role" value="{{$role->id}}">
                                            <button type="submit" class="btn btn-danger" @if(!$permission->roles->contains($role))
                                                disabled
                                                @endif
                                                >Detach</button>
                                        </form>
                                    </td>
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