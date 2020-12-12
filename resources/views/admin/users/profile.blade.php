<x-admin-master>
    @section('content')
    <h1>User Profile for {{$user->name}}</h1>

    <div class="row">
        <div class="col-sm-6">
            <form method="POST" action="{{route('user.profile.update', $user) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <img class="img-profile rounded-circle" height="60" src="{{$user->avatar}}">
                    <!-- <img class="img-profile rounded-circle" height="60" src="https://source.unsplash.com/EaBYKGnfwdw/60x60"> -->
                </div>
                <div class="form-group">
                    <input type="file" name="avatar">
                </div>
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control
                    @error('username') 
                        is-invalid 
                    @enderror" name="username" id="username" value="{{$user->username}}">

                    @error('username')
                    <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control
                    @error('name') 
                        is-invalid 
                    @enderror" name="name" id="name" value="{{$user->name}}">

                    @error('name')
                    <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" class="form-control
                    @error('email') 
                        is-invalid 
                    @enderror" name="email" id="email" value="{{$user->email}}">
                    @error('email')
                    <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control
                    @error('password') 
                        is-invalid 
                    @enderror" name="password" id="password">
                    @error('password')
                    <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="password-confirmation">Confirm Password</label>
                    <input type="password" class="form-control
                    @error('password_confirmation') 
                        is-invalid 
                    @enderror" name="password_confirmation" id="password-confirmation">
                    @error('password_confirmation')
                    <div class="invalid-feedback">{{$message}}</div>
                    @enderror

                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
    @endsection
</x-admin-master>