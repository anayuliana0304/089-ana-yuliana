<x-layout>
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="container-fluid">

        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Flowers</h1>
        </div>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">DataTables Flowers</h6>
                <a href="{{ route('flowers.create') }}" type="button" class="btn btn-primary" style="font-size: 14px;">
                    <i class="fas fa-fw fa-solid fa-plus"></i> Add Flower
                </a>
            </div>
            <div class="card-body">
                @if(count($flowers) > 0)
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Category</th>
                                <th>Stock</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Category</th>
                                <th>Stock</th>
                                <th>Actions</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach($flowers as $flower)
                            <tr>
                                <td>{{ $flower['name'] }}</td>
                                <td>{{ $flower['price'] }}</td>
                                <td>{{ optional($flower->category)->name }}</td>
                                <td>{{ $flower['stock'] }}</td>
                                <td align="center">
                                    <a href="{{ route('flowers.edit', $flower->id) }}" class="btn btn-warning btn-sm">
                                        <i class="fa fa-pencil" aria-hidden="true"></i> Edit
                                    </a>
                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModalFlower" data-flowerid="{{ $flower->id }}">
                                        <i class="fas fa-trash-alt"></i> Delete
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                    <div class="alert alert-info">No flowers found.</div>
                @endif
            </div>
        </div>
    </div>

    <div class="modal fade" id="deleteModalFlower" tabindex="-1" role="dialog" aria-labelledby="deleteModalFlowerLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalFlowerLabel">Confirm Delete</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this flower?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <form id="deleteFlowerForm" method="POST" style="display:inline;">
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
            $('#deleteModalFlower').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget);
                var flowerId = button.data('flowerid'); 
                var action = "{{ route('flowers.destroy', ':id') }}"; 
                action = action.replace(':id', flowerId); 

                var modal = $(this);
                modal.find('#deleteFlowerForm').attr('action', action); 
            });

            $(document).ready(function() {
                var tbody = $('#dataTable tbody');
                var rows = tbody.find('tr');
                var stockZeroRows = rows.filter(function() {
                    return $(this).find('td:eq(3)').text() === '0';
                });
                tbody.append(stockZeroRows);
            });
        });
    </script>
</x-layout>