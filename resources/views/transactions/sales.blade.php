<x-layout>
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Sales</h1>
    </div>

    <div class="row">
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body" style="height: 190px;">
                    <table width="100%">
                        <tr>
                            <td style="vertical-align:top; width:30%">
                                <label for="date">Date</label>
                            </td>
                            <td>
                                <div class="form-group">
                                    <input type="date" id="date" value="{{date('Y-m-d')}}" class="form-control">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td style="vertical-align:top">
                                <label for="cashier">Kasir</label>
                            </td>
                            <td>
                                <div class="form-group">
                                    <input type="text" class="form-control" value="{{ session('name') }}" readonly>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td style="vertical-align:top">
                                <label for="customer_id">Customer</label>
                            </td>
                            <td>
                                <div class="form-group">
                                    <select class="form-control" id="customer_id" name="customer_id">
                                        <option value="" selected disabled>Select Customer</option>
                                        @foreach($customers as $customer)
                                            <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                                        @endforeach
                                        <option value="custom">Othe</option>
                                    </select>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card">
                <div class="card-body" style="height: 190px;">
                    <table width="100%">
                        <tr>
                            <td style="vertical-align:top; width:30%">
                                <label for="flowers">Flowers</label>
                            </td>
                            <td>
                                <div class="form-group">
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="flower_name" name="flower_name" readonly>
                                        <div class="input-group-append">
                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#flowerModal">
                                                <i class="fa fa-search"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td style="vertical-align:top">
                                <label for="flower_qty">Quantity</label>
                            </td>
                            <td>
                                <div class="form-group">
                                    <input type="number" id="flower_qty" value="1" min="1" class="form-control">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <div>
                                    <button type="button" class="btn btn-primary" id="add_to_cart">
                                        <i class="fa fa-cart-plus"></i> Add to Cart
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card">
                <div class="card-body d-flex flex-column justify-content-between align-items-end" style="height: 190px;">
                    <div>
                        <h5>Transaction Number: <b><span id="transaction_number"></span></b></h5>
                    </div>
                    <div>
                        <h1 class="font-weight-bold"><b><span id="grand_total2">0</span></b></h1>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <br>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table" width="100%" cellspacing="0">
                        <thead>
                                <tr align="center">
                                    <th>#</th>
                                    <th>Flowers</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody id="cart_items">
                                <tr id="no_items_row" style="display: none;">
                                    <td colspan="9" class="text-center"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <br>

    <div class="row">
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <table width="100%">
                        <tr>
                            <td style="vertical-align:top">
                                <label for="packaging">Packaging</label>
                            </td>
                            <td>
                                <div class="form-group">
                                    <select id="packaging" class="form-control">
                                        <option value="" disabled selected></option>
                                        <option value="Box">Box</option>
                                        <option value="Bag">Bag</option>
                                        <option value="Wrap">Wrap</option>
                                    </select>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <table width="100%">
                        <tr>
                            <td style="vertical-align:top; width:30%">
                                <label for="cash">Cash</label>
                            </td>
                            <td>
                                <div class="form-group">
                                    <input type="number" id="cash" class="form-control">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td style="vertical-align:top">
                                <label for="change">Change</label>
                            </td>
                            <td>
                                <div class="form-group">
                                    <input type="number" id="change" class="form-control" readonly>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div>
                <button id="cancel_payment" class="btn btn-flat btn-warning">
                    <i class="fa fa-refresh"></i> Cancel
                </button>
                <br><br>
                    <button id="payment" class="btn btn-success">
                        <i class="fa fa-paper-plane"></i> Payment
                    </button>
            </div>
        </div>
    </div>
</div>

    <!-- Modal for Flowers -->
    <div class="modal fade" id="flowerModal" tabindex="-1" role="dialog" aria-labelledby="flowerModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="flowerModalLabel">Select Flower</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <table id="flower_table" class="table table-bordered" width="100%" cellspacing="0">
                            <thead>
                                <tr align="center">
                                    <th>Name</th>
                                    <th>Price</th>
                                    <th>Stock</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($flowers as $flower)
                                <tr align="center">
                                    <td>{{ $flower->name }}</td>
                                    <td>{{ $flower->price }}</td>
                                    <td>{{ $flower->stock }}</td>
                                    <td>
                                    <button type="button" class="btn btn-primary select-flower" data-id="{{ $flower->id }}" data-name="{{ $flower->name }}" data-price="{{ $flower->price }}" data-id-flower="{{ $flower->id }}"><i class="fa-solid fa-check"></i> Select</button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>