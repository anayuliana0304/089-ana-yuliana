<x-layout>
    <div class="container-fluid">
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Users</h1>
        </div>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">DataTables Users</h6>
                <a href="{{ route('users.create') }}" type="button" class="btn btn-primary" style="font-size: 14px;">
                    <i class="fas fa-fw fa-solid fa-plus"></i> Add User
                </a>
            </div>
            <div class="card-body">
                @if(count($users)>0)
                <div class="table-responsive">
                    <div></div>
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Username</th>
                                <th>Name</th>
                                <th>Level</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Username</th>
                                <th>Name</th>
                                <th>Level</th>
                                <th>Actions</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach($users as $user)
                            <tr>
                                <td>{{ $user->username }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->level }}</td>
                                <td align="center">
                                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning btn-sm">
                                        <i class="fa fa-pencil" aria-hidden="true"></i> Edit
                                    </a>
                                    @if($user->level !== 'admin')
                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModalUser" data-userid="{{ $user->id }}">
                                        <i class="fas fa-trash-alt"></i> Delete
                                    </button>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                    <div class="alert alert-info">No users found.</div>
                @endif
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteModalUser" tabindex="-1" role="dialog" aria-labelledby="deleteModalUserLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalUserLabel">Confirm Delete</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this user?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <form id="deleteUserForm" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            $('#deleteModalUser').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget); 
                var userId = button.data('userid'); 
                var action = "{{ route('users.destroy', ':id') }}";
                action = action.replace(':id', userId); 

                var modal = $(this);
                modal.find('#deleteUserForm').attr('action', action); 
            });
        });
    </script>

</x-layout>
