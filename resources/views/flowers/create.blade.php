<x-layout>
<div class="container-fluid">

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Add New Flower</h1>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Create Flower</h6>
    </div>
    <div class="card-body">
        <form action="#" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" class="form-control" required>  
            </div>
            <div class="form-group">
                <label>Price</label>
                <input type="number" name="price" id="price" class="form-control" required>  
            </div>
            <div class="form-group">
                <label>Stock</label>
                <input type="number" name="stock" id="stock" value="0" min="0" class="form-control">
            </div>
            <div class="form-group mt-3">
                <input type="submit" name="submit" value="Submit" class="btn btn-success btn-sm">
            </div>
        </form>
    </div>
</div>
</div>
</x-layout>