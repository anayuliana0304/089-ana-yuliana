<x-layout>
<div class="container-fluid">

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Customers</h1>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">DataTables Customers</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
        <a href="#" type="button" class="btn btn-primary mb-3"><i class="fas fa-fw fa-solid fa-plus"></i> Add Customers</a>
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Gender</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Name</th>
                        <th>Gender</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th>Actions</th>
                    </tr>
                </tfoot>
                @foreach($customers as $customers)
                <tbody>
                    <tr>
                        <td>{{$customers['name']}}</td>
                        <td>{{$customers['gender']}}</td>
                        <td>{{$customers['phone']}}</td>
                        <td>{{$customers['address']}}</td>
                        <td align="center">
                            <a href="#" class="btn btn-warning btn-sm"><i class="fa fa-pencil" aria-hidden="true"></i></a>  
                            <a href="#" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></a>                   
                        </td>
                    </tr>
                </tbody>
                @endforeach
            </table>
        </div>
    </div>
</div>

</div>
</x-layout>