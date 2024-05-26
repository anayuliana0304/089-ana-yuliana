<x-layout>
<div class="container-fluid">
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Customers</h1>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">DataTables Customers</h6>
            <a href="{{ route('customers.create') }}" type="button" class="btn btn-primary" style="font-size: 14px;">
                <i class="fas fa-fw fa-solid fa-plus"></i> Add Customer
            </a>
        </div>
        <div class="card-body">
            @if(count($customers)>0)
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Gender</th>
                            <th>Phone</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Name</th>
                            <th>Gender</th>
                            <th>Phone</th>
                            <th>Actions</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach($customers as $customer)
                        <tr>
                            <td>{{$customer['name']}}</td>
                            <td>{{$customer['gender']}}</td>
                            <td>{{$customer['phone']}}</td>
                            <td align="center">
                                <a href="{{ route('customers.edit', $customer->id) }}" class="btn btn-warning btn-sm">
                                    <i class="fa fa-pencil" aria-hidden="true"></i>
                                </a> 
                                <form action="{{ route('customers.destroy', $customer->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this customer?')">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>   
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
             </table>
            </div>
            @else
                <div class="alert alert-info">No customers found.</div>
            @endif
        </div>
    </div>
</div>
</x-layout>