<x-layout>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Edit User</h6>
                    </div>
                    <div class="card-body">
                         @if ($errors->any())
                            <div class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    {{ $error }}
                                @endforeach
                            </div>
                        @endif
                        <form action="{{ route('users.update', $user->id) }}" method="POST">
                            @csrf
                            @method("PUT")
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" id="username" name="username" class="form-control" value="{{ $user->username }}" autocomplete="off" required>  
                            </div>
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" id="name" name="name" class="form-control" value="{{ $user->name }}" autocomplete="off" required>  
                            </div>
                            <div class="form-group position-relative">
                                <label for="password">Password</label>
                                <input type="password" class="form-control form-control-user" id="password" name="password" minlength="8">
                                <i class="fas fa-eye position-absolute" id="togglePassword" style="top: 50%; right: 10px; transform: translateY(-50%); cursor: pointer;"></i>  
                                <small class="form-text text-muted">Leave blank if you don't want to change the password</small>
                            </div>
                            <div class="form-group">
                                <label for="level">Level</label>
                                <input type="text" id="level" name="level" class="form-control" value="{{ $user->level }}" readonly>  
                            </div>
                            <div class="form-group mt-3">
                                <input type="submit" name="submit" value="Save" class="btn btn-primary">
                            </div>
                        </form>
                    </div>
                </div>
            </div>  
        </div>
    </div>
</x-layout>
