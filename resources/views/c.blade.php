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
                                    <input type="text" class="form-control" value="ana" readonly>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td style="vertical-align:top">
                                <label for="customer_name">Customer</label>
                            </td>
                            <td>
                            <div class="form-group">
                                <div class="input-group">
                                    <input type="text" class="form-control" id="customer_name" name="customer_name" readonly>
                                    <div class="input-group-append">
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#customerModal">
                                            <i class="fa fa-search"></i>
                                        </button>
                                    </div>
                                </div>
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
                            <tr>
                                <th>#</th>
                                <th>Flowers</th>
                                <th>Price</th>
                                <th>Qty</th>
                                <th>Total</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="cart_items">
                            <tr id="no_items_row">
                                <td></td>
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
       <!-- Bagian HTML -->
<div class="col-lg-3">
    <div class="card" style="height: 80px">
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
            </table>
        </div>
    </div>
</div>

<div class="col-lg-3">
    <div class="card" style="height: 80px">
        <div class="card-body">
            <table width="100%">
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


        <div class="col-lg-3">
            <div>
                <button id="cancel_payment" class="btn btn-flat btn-warning">
                    <i class="fa fa-refresh"></i>Cancel
                </button><br><br>

                <button id="payment" class="btn btn-success">
                    <i class="fa fa-paper-plane"></i>Payment
                </button>
            </div>
        </div>


</div>
</x-layout>


<tr>
                            <td style="vertical-align:top; width:30%">
                                <label for="delivery_method">Method</label>
                            </td>
                            <td>
                                <div class="form-group">
                                    <select class="form-control" id="delivery_method">
                                        <option value="" disabled selected></option>
                                        <option value="pickup">Pickup</option>
                                        <option value="delivery">Delivery</option>
                                    </select>
                                </div>
                                <div id="delivery_details" style="display:none;">
                                    <div class="form-group">
                                        <label for="delivery_address">Address</label>
                                        <input type="text" class="form-control" id="delivery_address" name="delivery_address">
                                    </div>
                                    <div class="form-group">
                                        <label for="delivery_date">Date</label>
                                        <input type="date" class="form-control" id="delivery_date" name="delivery_date">
                                    </div>
                                    <div class="form-group">
                                        <label for="delivery_time">Time</label>
                                        <input type="time" class="form-control" id="delivery_time" name="delivery_time">
                                    </div>
                                </div>
                            </td>
                        </tr>