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
                                    <select class="form-control">
                                        @foreach($users as $users)
                                            <option value="{{$users['name']}}">{{$users['name']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td style="vertical-align:top">
                                <label for="grand_total">Customer</label>
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
                        <label for="qty">Qty</label>
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

<!-- Customer Modal -->
<div class="modal fade" id="customerModal" tabindex="-1" role="dialog" aria-labelledby="customerModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="customerModalLabel">Select Customer</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Gender</th>
                            <th>Phone</th>
                            <th>Select</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($customers as $customer)
                        <tr>
                            <td>{{ $customer->name }}</td>
                            <td>{{ $customer->gender }}</td>
                            <td>{{ $customer->phone }}</td>
                            <td>
                                <button type="button" class="btn btn-primary select-customer" data-id="{{ $customer->id }}" data-name="{{ $customer->name }}">Select</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal for Flowers -->
<div class="modal fade" id="flowerModal" tabindex="-1" role="dialog" aria-labelledby="flowerModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="flowerModalLabel">Select Flower</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table" id="flower_table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Stock</th>
                                <th>Select</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($flowers as $flower)
                            <tr>
                                <td>{{ $flower->name }}</td>
                                <td>{{ $flower->price }}</td>
                                <td>{{ $flower->stock }}</td>
                                <td>
                                    <button type="button" class="btn btn-primary select-flower" data-id="{{ $flower->id }}" data-name="{{ $flower->name }}" data-price="{{ $flower->price }}">Select</button>
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




<script>
document.addEventListener('DOMContentLoaded', function () {
    // Event delegation for select buttons within the modal
    document.addEventListener('click', function (event) {
        if (event.target.classList.contains('select-customer')) {
            var customerName = event.target.getAttribute('data-name');

            // Set the customer name in the input field
            document.getElementById('customer_name').value = customerName;

            // Close the modal
            $('#customerModal').modal('hide');

            // Ensure modal backdrop is removed
            $('body').removeClass('modal-open');
            $('.modal-backdrop').remove();
        }
    });

    // Bind event listener for search button to open modal
    document.querySelector('[data-target="#customerModal"]').addEventListener('click', function () {
        $('#customerModal').modal('show');
    });

    // Reset modal state when hidden
    $('#customerModal').on('hidden.bs.modal', function () {
        $('body').removeClass('modal-open');
        $('.modal-backdrop').remove();
    });
});

</script>

<script>
    
    document.addEventListener('DOMContentLoaded', function () {
    function updateCartVisibility() {
        var cartItems = document.querySelectorAll('#cart_items tr');
        var noItemsRow = document.getElementById('no_items_row');
        
        if (cartItems.length > 0) {
            noItemsRow.style.display = 'none';
        } else {
            noItemsRow.style.display = 'table-row';
        }
    }

    // Event delegation for select buttons within the modal
    document.addEventListener('click', function (event) {
        if (event.target.classList.contains('select-flower')) {
            var flowerName = event.target.getAttribute('data-name');
            var flowerPrice = event.target.getAttribute('data-price');
            var flowerId = event.target.getAttribute('data-id');

            // Set the flower name and id in the input field
            document.getElementById('flower_name').value = flowerName;
            document.getElementById('flower_name').dataset.id = flowerId;
            document.getElementById('flower_name').dataset.price = flowerPrice;

            // Close the modal
            $('#flowerModal').modal('hide');

            // Ensure modal backdrop is removed
            $('body').removeClass('modal-open');
            $('.modal-backdrop').remove();
        }
    });

    // Add flower to cart
    document.getElementById('add_to_cart').addEventListener('click', function () {
        var flowerName = document.getElementById('flower_name').value;
        var flowerId = document.getElementById('flower_name').dataset.id;
        var flowerPrice = document.getElementById('flower_name').dataset.price;
        var qty = document.getElementById('flower_qty').value;

        if (flowerName && flowerId && qty > 0) {
            var cartItems = document.getElementById('cart_items');
            var newRow = document.createElement('tr');

            newRow.innerHTML = `
                <td></td>
                <td>${flowerName}</td>
                <td>${flowerPrice}</td>
                <td>${qty}</td>
                <td>${flowerPrice * qty}</td>
                <td align="center">
                    <button type="button" class="btn btn-danger remove-item"><i class="fas fa-trash-alt"></i></button>
                </td>
            `;

            cartItems.appendChild(newRow);

            // Clear the flower input fields
            document.getElementById('flower_name').value = '';
            document.getElementById('flower_qty').value = '1';

            // Update the total
            updateTotal();

            // Update cart visibility
            updateCartVisibility();
        }
    });

    // Event delegation for remove buttons within the cart
    document.addEventListener('click', function (event) {
        if (event.target.classList.contains('remove-item')) {
            var row = event.target.closest('tr');
            row.remove();
            updateTotal();
            updateCartVisibility();
        }
    });

    function updateTotal() {
    var total = 0;
    var rows = document.querySelectorAll('#cart_items tr:not(#no_items_row)');
    rows.forEach(function (row) {
        var cells = row.querySelectorAll('td');
        if (cells.length > 0) {
            var subtotal = parseFloat(cells[3].innerText) * parseFloat(cells[2].innerText);
            total += subtotal;
        }
    });
    total = total.toFixed(2); // Round to 2 decimal places
    total = parseFloat(total) === parseInt(total) ? parseInt(total) : parseFloat(total); // Convert to integer if no decimal
    document.getElementById('grand_total2').innerText = total;
}



});

function generateTransactionNumber() {
    // Lakukan pengambilan nomor transaksi terbaru dari server atau database
    // Misalnya, Anda bisa mengirimkan permintaan AJAX untuk mendapatkan nomor transaksi terbaru
    // Di sini saya akan menggunakan nomor transaksi acak untuk tujuan demonstrasi
    var latestTransactionNumber = Math.floor(Math.random() * 1000000); // Nomor transaksi acak
    return 'TRX' + String(latestTransactionNumber).padStart(6, '0'); // Format nomor transaksi
}

document.addEventListener('DOMContentLoaded', function () {
    // Fungsi untuk menampilkan nomor transaksi
    function displayTransactionNumber() {
        // Panggil fungsi generateTransactionNumber() untuk mendapatkan nomor transaksi baru
        var transactionNumber = generateTransactionNumber();

        // Tampilkan nomor transaksi di dalam elemen dengan id "transaction_number"
        document.getElementById('transaction_number').innerText = transactionNumber;
    }

    // Panggil fungsi displayTransactionNumber() ketika halaman dimuat
    displayTransactionNumber();
});

// Bagian JavaScript
document.addEventListener('DOMContentLoaded', function () {
    // Fungsi untuk menghitung kembalian
    function calculateChange() {
        var cashInput = parseFloat(document.getElementById('cash').value); // Ambil nilai uang tunai yang dimasukkan
        var total = parseFloat(document.getElementById('grand_total2').innerText); // Ambil total belanja

        // Hitung kembalian
        var change = cashInput - total;

        // Tampilkan kembalian di dalam elemen dengan id "change"
        document.getElementById('change').value = change; // Format kembalian dengan dua angka di belakang koma
    }

    // Panggil fungsi calculateChange() saat nilai uang tunai berubah
    document.getElementById('cash').addEventListener('input', calculateChange);
});

document.addEventListener('DOMContentLoaded', function () {
    // Event listener untuk tombol "Cancel"
    document.getElementById('cancel_payment').addEventListener('click', function () {
        // Menghapus nilai uang tunai yang dimasukkan
        document.getElementById('cash').value = '';

        // Menghapus kembalian yang dihitung
        document.getElementById('change').value = '';

        // Membersihkan keranjang belanja
        var cartItems = document.getElementById('cart_items');
        cartItems.innerHTML = '<tr id="no_items_row"><td></td></tr>';

        // Mengatur kembali total belanja ke 0
        document.getElementById('grand_total2').innerText = '0';

        document.getElementById('customer_name').value = '';
    });
});


</script>



</x-layout>
document.addEventListener('DOMContentLoaded', function () {
    // Fungsi untuk menampilkan nomor transaksi
    function displayTransactionNumber() {
        // Panggil fungsi generateTransactionNumber() untuk mendapatkan nomor transaksi baru
        var transactionNumber = generateTransactionNumber();

        // Tampilkan nomor transaksi di dalam elemen dengan id "transaction_number"
        document.getElementById('transaction_number').innerText = transactionNumber;
    }

    // Panggil fungsi displayTransactionNumber() ketika halaman dimuat
    displayTransactionNumber();
});

document.addEventListener('DOMContentLoaded', function () {
    // Fungsi untuk menampilkan nomor transaksi
    function displayTransactionNumber() {
        // Panggil fungsi generateTransactionNumber() untuk mendapatkan nomor transaksi baru
        var transactionNumber = generateTransactionNumber();

        // Tampilkan nomor transaksi di dalam elemen dengan id "transaction_number"
        document.getElementById('transaction_number').innerText = transactionNumber;
    }

    // Panggil fungsi displayTransactionNumber() ketika halaman dimuat
    displayTransactionNumber();
});