<x-layout>
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="container-fluid">

        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Transactions</h1>
        </div>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">DataTables Transaction</h6>
            </div>
            <div class="card-body">
                @if(count($transactions) > 0)
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr align="center">
                                <th>No</th>
                                <th>Transaction Number</th>
                                <th>Date</th>
                                <th>Customer</th>
                                <th>Subtotal</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr align="center">
                                <th>No</th>
                                <th>Transaction Number</th>
                                <th>Date</th>
                                <th>Customer</th>
                                <th>Subtotal</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach($transactions as $transaction)
                                <tr align="center">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $transaction->no_transaction }}</td>
                                    <td>{{ $transaction->date }}</td>
                                    <td>{{ optional($transaction->customer)->name }}</td>
                                    <td>{{ $transaction->grand_total }}</td>
                                    <td>
                                        @if($transaction->status === 'process')
                                            <span class="badge badge-warning">Process</span>
                                        @elseif($transaction->status === 'finished')
                                            <span class="badge badge-success">Finished</span>
                                        @endif
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-custom-outline btn-sm" style="background-color:  #e2e6ea;" data-toggle="modal" data-target="#transactionModal" data-id="{{ $transaction->id }}">
                                            <i class="fa-solid fa-eye"></i> Details
                                        </button>
                                        @if($transaction->status === 'process')
                                            <form action="{{ route('transactions.change_status', $transaction->id) }}" method="POST" style="display: inline;">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" class="btn btn-success btn-sm">Mark as Finished</button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                    <div class="alert alert-info">No transactions found.</div>
                @endif
            </div>
        </div>
    </div>

    <!-- Modal for Transaction Details -->
    <div class="modal fade" id="transactionModal" tabindex="-1" role="dialog" aria-labelledby="transactionModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="transactionModalLabel">Transaction Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="card">
                            <div class="card-header">
                                <strong>Transaction Number:</strong> <span id="modal_transaction_number"></span>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <td><strong>Date</strong></td>
                                                    <td><strong>:</strong></td>
                                                    <td><span id="modal_date"></span></td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Cashier</strong></td>
                                                    <td><strong>:</strong></td>
                                                    <td><span id="modal_user"></span></td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Subtotal</strong></td>
                                                    <td><strong>:</strong></td>
                                                    <td><span id="modal_grand_total"></span></td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Cash</strong></td>
                                                    <td><strong>:</strong></td>
                                                    <td><span id="modal_cash"></span></td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Change</strong></td>
                                                    <td><strong>:</strong></td>
                                                    <td><span id="modal_change"></span></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-md-6">
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <td><strong>Customer</strong></td>
                                                    <td><strong>:</strong></td>
                                                    <td><span id="modal_customer"></span></td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Method</strong></td>
                                                    <td><strong>:</strong></td>
                                                    <td><span id="modal_method"></span></td>
                                                </tr>
                                                    <div id="delivery_details_modal" style="display:none;">
                                                    <tr>
                                                        <td></td>
                                                        <td><strong>Date</strong></td>
                                                        <td><span id="modal_delivery_date"></td>
                                                    </tr>
                                                    <tr>
                                                        <td></td>
                                                        <td><strong>Time</strong></td>
                                                        <td><span id="modal_delivery_time"></td>
                                                    </tr>
                                                    <tr id="modal_delivery_address_row" style="display: none;">
                                                        <td></td>
                                                        <td><strong>Address</strong></td>
                                                        <td><span id="modal_delivery_address"></span></td>
                                                    </tr>
                                                </div>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <hr>
                                <h5>Transaction Items</h5>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Flower</th>
                                            <th>Price</th>
                                            <th>Quantity</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody id="modal_transaction_items">
                                        <!-- Items will be populated here by JavaScript -->
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>
