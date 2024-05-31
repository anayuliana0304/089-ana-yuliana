<x-layout>
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Categories</h1>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-8">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">DataTables Categories</h6>
                        <a href="{{ route('flowers.categories.create') }}" type="button" class="btn btn-primary" style="font-size: 14px;">
                            <i class="fas fa-fw fa-solid fa-plus"></i> Add Category
                        </a>
                    </div>
                    <div class="card-body">
                        @if(count($categories) > 0)
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th style="width: 150px;">Actions</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Name</th>
                                            <th style="width: 150px;">Actions</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach($categories as $category)
                                            <tr>
                                                <td>{{ $category['name'] }}</td>
                                                <td align="center">
                                                    <a href="{{ route('flowers.categories.edit', $category->id) }}" class="btn btn-warning btn-sm">
                                                        <i class="fa fa-pencil" aria-hidden="true"></i> Edit
                                                    </a>
                                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModalCategory" data-categoryid="{{ $category->id }}">
                                                        <i class="fas fa-trash-alt"></i> Delete
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="alert alert-info">No categories found.</div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="deleteModalCategory" tabindex="-1" role="dialog" aria-labelledby="deleteModalCategoryLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalCategoryLabel">Confirm Delete</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this category?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <form id="deleteCategoryForm" method="POST" style="display:inline;">
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
            $('#deleteModalCategory').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget); 
                var categoryId = button.data('categoryid'); 
                var action = "{{ route('flowers.categories.destroy', ':id') }}";
                action = action.replace(':id', categoryId); 

                var modal = $(this);
                modal.find('#deleteCategoryForm').attr('action', action); 
            });
        });
    </script>
    
</x-layout>
