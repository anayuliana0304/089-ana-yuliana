<x-layout>
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Transaction</h1>
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
                                <label for="discount">Kasir</label>
                            </td>
                            <td>
                                <div class="form-group">
                                    <input type="text" id="users" value="ana" class="form-control" readonly>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td style="vertical-align:top">
                                <label for="grand_total">Customers</label>
                            </td>
                            <td>
                                <div class="form-group">
                                    <select class="form-control">
                                        @foreach($customers as $customers)
                                            <option value="{{$customers['name']}}">{{$customers['name']}}</option>
                                        @endforeach
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
                                    <select class="form-control">
                                        @foreach($flowers as $flowers)
                                            <option value="{{$flowers['name']}}">{{$flowers['name']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td style="vertical-align:top">
                                <label for="qty">Qty</label>
                            </td>
                            <td>
                                <div class="form-group">
                                    <input type="number" value="1" min="1" class="form-control">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <div>
                                    <button type="button" class="btn btn-primary">
                                        <i class="fa fa-cart-plus"></i> Add
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
                <div class="card-body" style="height: 190px;">
                    <div>
                        <h5>Total <b><span id="total"></span></b></h4>
                    </div>
                    <div></div>
                    <div align="right">
                        <h1><b><span id="grand_total2">0</span></b></h1>
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
                            <tbody>
                                <tr>
                                    <td colspan="9" class="text-center">Tidak ada item</td>
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
                                    <input type="number" value="0" min="0" class="form-control">
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
            </div>
        </div>
    </div>
</div>
</x-layout>