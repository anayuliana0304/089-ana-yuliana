<x-layout>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Add Flower</h6>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('flowers.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" id="name" name="name" class="form-control"  autocomplete="off" required>  
                            </div>
                            <div class="form-group">
                                <label>Price</label>
                                <input type="number" name="price" id="price" class="form-control"  autocomplete="off" required>  
                            </div>
                            <div class="form-group">
                                <label>Stock</label>
                                <input type="number" name="stock" id="stock" value="0" min="0" class="form-control"  autocomplete="off" required>
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