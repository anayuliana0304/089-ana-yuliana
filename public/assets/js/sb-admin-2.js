(function($) {
  "use strict"; // Start of use strict

  // Toggle the side navigation
  $("#sidebarToggle, #sidebarToggleTop").on('click', function(e) {
    $("body").toggleClass("sidebar-toggled");
    $(".sidebar").toggleClass("toggled");
    if ($(".sidebar").hasClass("toggled")) {
      $('.sidebar .collapse').collapse('hide');
    };
  });

  // Close any open menu accordions when window is resized below 768px
  $(window).resize(function() {
    if ($(window).width() < 768) {
      $('.sidebar .collapse').collapse('hide');
    };
    
    // Toggle the side navigation when window is resized below 480px
    if ($(window).width() < 480 && !$(".sidebar").hasClass("toggled")) {
      $("body").addClass("sidebar-toggled");
      $(".sidebar").addClass("toggled");
      $('.sidebar .collapse').collapse('hide');
    };
  });

  // Prevent the content wrapper from scrolling when the fixed side navigation hovered over
  $('body.fixed-nav .sidebar').on('mousewheel DOMMouseScroll wheel', function(e) {
    if ($(window).width() > 768) {
      var e0 = e.originalEvent,
        delta = e0.wheelDelta || -e0.detail;
      this.scrollTop += (delta < 0 ? 1 : -1) * 30;
      e.preventDefault();
    }
  });

  // Scroll to top button appear
  $(document).on('scroll', function() {
    var scrollDistance = $(this).scrollTop();
    if (scrollDistance > 100) {
      $('.scroll-to-top').fadeIn();
    } else {
      $('.scroll-to-top').fadeOut();
    }
  });

  // Smooth scrolling using jQuery easing
  $(document).on('click', 'a.scroll-to-top', function(e) {
    var $anchor = $(this);
    $('html, body').stop().animate({
      scrollTop: ($($anchor.attr('href')).offset().top)
    }, 1000, 'easeInOutExpo');
    e.preventDefault();
  });

  $(document).ready(function() {
    // Tangani klik pada tombol Hapus
    $('.delete-btn').on('click', function(e) {
        e.preventDefault(); // Mencegah tindakan default (mengarah ke link)

        // Menangkap URL tujuan penghapusan dari atribut href tombol Hapus
        var deleteUrl = $(this).attr('href');

        // Tangani klik pada tombol Hapus di dalam modal konfirmasi
        $('#confirmDeleteBtn').off('click').on('click', function() {
            // Lakukan penghapusan dengan mengarahkan ke URL penghapusan
            window.location.href = deleteUrl;
        });
    });
  });

  document.addEventListener('DOMContentLoaded', function () {
    $('#customerTable').DataTable();
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

  document.addEventListener('DOMContentLoaded', function () {
    $('#flower_table').DataTable({
            "pageLength": 5
        });

    function updateCartVisibility() {
        var cartItems = document.querySelectorAll('#cart_items tr');
        var noItemsRow = document.getElementById('no_items_row');

        var hasItems = Array.from(cartItems).some(function(row) {
            return row.id !== 'no_items_row';
        });

        if (hasItems) {
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

            document.getElementById('flower_name').value = flowerName;
            document.getElementById('flower_name').dataset.id = flowerId;
            document.getElementById('flower_name').dataset.price = flowerPrice;

            $('#flowerModal').modal('hide');
            $('body').removeClass('modal-open');
            $('.modal-backdrop').remove();
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
        var cartItems = [];
        var rows = document.querySelectorAll('#cart_items tr');

        rows.forEach(function(row) {
            if (row.id === 'no_items_row') {
                return;
            }

            var cells = row.querySelectorAll('td');
            if (cells.length > 0) {
                var itemId = row.dataset.flowerId;
                var flowerName = cells[1].innerText;
                var flowerPrice = parseFloat(cells[2].innerText);
                var quantity = parseInt(cells[3].innerText);
                var subtotal = parseFloat(cells[4].innerText);

                cartItems.push({
                    item_id: itemId,
                    flower_name: flowerName,
                    price: flowerPrice,
                    quantity: quantity,
                    subtotal: subtotal
                });

                total += subtotal;
            }
        });

        console.log('Cart Items:', cartItems);

        total = total.toFixed(2);
        total = parseFloat(total) === parseInt(total) ? parseInt(total) : parseFloat(total);
        document.getElementById('grand_total2').innerText = total;
    }

    function generateTransactionNumber() {
        var latestTransactionNumber = Math.floor(Math.random() * 1000000);
        return 'TRX' + String(latestTransactionNumber).padStart(6, '0');
    }
});

document.addEventListener('DOMContentLoaded', function () {
    $('#transactionModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); 
        var transactionId = button.data('id'); 
  
        $.ajax({
            url: '/transactions/' + transactionId,
            method: 'GET',
            success: function (transaction) {
                // Populate modal fields
                $('#modal_transaction_number').text(transaction.no_transaction);
                $('#modal_date').text(transaction.date);
                $('#modal_customer').text(transaction.customer.name);
                $('#modal_user').text(transaction.user.name);
                $('#modal_grand_total').text(transaction.grand_total);
                $('#modal_cash').text(transaction.cash);
                $('#modal_change').text(transaction.change);
                $('#modal_method').text(transaction.delivery ? transaction.delivery.method : 'Pickup');
  
                // Show delivery details if method is delivery
                if (transaction.delivery) {
                    $('#delivery_details_modal').show();
                    $('#modal_delivery_date').text(transaction.delivery.date);
                    $('#modal_delivery_time').text(transaction.delivery.time);
                    if (transaction.delivery.method === 'delivery') {
                        $('#modal_delivery_address_row').show();
                        $('#modal_delivery_address').text(transaction.delivery.address);
                    } else {
                        $('#modal_delivery_address_row').hide();
                    }
                } else {
                    $('#delivery_details_modal').hide();
                    $('#modal_delivery_address_row').hide();
                }
  
                // Populate transaction items
                var itemsContainer = $('#modal_transaction_items');
                itemsContainer.empty(); // Clear existing items
                transaction.details.forEach(function (item, index) {
                    var row = $('<tr>').append(
                        $('<td>').text(index + 1),
                        $('<td>').text(item.flower.name),
                        $('<td>').text(item.price),
                        $('<td>').text(item.quantity),
                        $('<td>').text(item.subtotal)
                    );
                    itemsContainer.append(row);
                });
            }
        });
    });
  });

document.addEventListener('DOMContentLoaded', function () {
  function calculateChange() {
      var cashInput = parseFloat(document.getElementById('cash').value); 
      var total = parseFloat(document.getElementById('grand_total2').innerText); 

      var change = cashInput - total;

      document.getElementById('change').value = change; 
  }

  document.getElementById('cash').addEventListener('input', calculateChange);
});

function generateTransactionNumber() {
  var latestTransactionNumber = Math.floor(Math.random() * 1000000); // Generate a random number
  return 'TRX' + String(latestTransactionNumber).padStart(6, '0'); // Format the transaction number
}

document.addEventListener('DOMContentLoaded', function () {
    var deliveryMethodSelect = document.getElementById('delivery_method');
    var deliveryDetails = document.getElementById('delivery_details');
    var deliveryAddressField = document.getElementById('delivery_address_field');
    var grandTotalElement = document.getElementById('grand_total2');

    var deliveryFee = 20000;
    var isDeliveryFeeAdded = false;
    var currentTotal = parseInt(grandTotalElement.innerText);

    function updateTotal() {
        var total = 0;
        document.querySelectorAll('#cart_items tr').forEach(function(row) {
            var totalPriceCell = row.querySelector('td:nth-child(5)');
            if (totalPriceCell) {
                total += parseInt(totalPriceCell.innerText);
            }
        });

        if (isDeliveryFeeAdded) {
            total += deliveryFee;
        }

        currentTotal = total;
        grandTotalElement.innerText = total;
    }

    function updateCartVisibility() {
        var noItemsRow = document.getElementById('no_items_row');
        var cartItems = document.getElementById('cart_items');
        if (cartItems.querySelectorAll('tr').length > 1) {
            noItemsRow.style.display = 'none';
        } else {
            noItemsRow.style.display = 'table-row';
        }
    }

    deliveryMethodSelect.addEventListener('change', function() {
        if (this.value === 'delivery') {
            deliveryDetails.style.display = 'block';
            deliveryAddressField.style.display = 'block';

            if (!isDeliveryFeeAdded) {
                currentTotal += deliveryFee;
                isDeliveryFeeAdded = true;
            }
        } else if (this.value === 'pickup') {
            deliveryDetails.style.display = 'block';
            deliveryAddressField.style.display = 'none';

            if (isDeliveryFeeAdded) {
                currentTotal -= deliveryFee;
                isDeliveryFeeAdded = false;
            }
        } else {
            deliveryDetails.style.display = 'none';

            if (isDeliveryFeeAdded) {
                currentTotal -= deliveryFee;
                isDeliveryFeeAdded = false;
            }
        }
        grandTotalElement.innerText = currentTotal;
    });

    document.getElementById('add_to_cart').addEventListener('click', function () {
        var flowerName = document.getElementById('flower_name').value;
        var flowerId = document.getElementById('flower_name').dataset.id;
        var flowerPrice = document.getElementById('flower_name').dataset.price;
        var qty = document.getElementById('flower_qty').value;

        if (flowerName && flowerId && qty > 0) {
            var existingFlowerRow = document.querySelector(`#cart_items tr[data-flower-id="${flowerId}"]`);
            if (existingFlowerRow) {
                var existingQty = parseInt(existingFlowerRow.querySelector('td:nth-child(4)').innerText);
                var newQty = existingQty + parseInt(qty);
                existingFlowerRow.querySelector('td:nth-child(4)').innerText = newQty;
                existingFlowerRow.querySelector('td:nth-child(5)').innerText = flowerPrice * newQty;
            } else {
                var cartItems = document.getElementById('cart_items');
                var newRow = document.createElement('tr');
                var totalItems = cartItems.querySelectorAll('tr:not(#no_items_row)').length + 1;
                newRow.innerHTML = `
                    <td align="center">${totalItems}</td>
                    <td align="center">${flowerName}</td>
                    <td align="center">${flowerPrice}</td>
                    <td align="center">${qty}</td>
                    <td align="center">${flowerPrice * qty}</td>
                    <td align="center">
                        <button type="button" class="btn btn-danger remove-item"><i class="fas fa-trash-alt"></i></button>
                    </td>
                `;
                newRow.dataset.flowerId = flowerId;
                cartItems.appendChild(newRow);
            }

            updateTotal();
            updateCartVisibility();

            document.getElementById('flower_name').value = '';
            document.getElementById('flower_qty').value = '1';

            document.getElementById('flower_name').focus();
        }
    });

    document.addEventListener('click', function(e) {
        if (e.target && e.target.classList.contains('remove-item')) {
            var row = e.target.closest('tr');
            row.remove();
            updateTotal();
            updateCartVisibility();
        }
    });

    document.addEventListener('click', function(e) {
        if (e.target && e.target.classList.contains('select-flower')) {
            var flowerName = e.target.dataset.name;
            var flowerPrice = e.target.dataset.price;
            var flowerId = e.target.dataset.id;
            document.getElementById('flower_name').value = flowerName;
            document.getElementById('flower_name').dataset.price = flowerPrice;
            document.getElementById('flower_name').dataset.id = flowerId;
            $('#flowerModal').modal('hide');
        }
    });

    updateTotal();
    updateCartVisibility();

  // Reset all fields when cancel button is clicked
  document.getElementById('cancel_payment').addEventListener('click', function () {
      document.getElementById('cash').value = '';
      document.getElementById('change').value = '';
      $('#customer_id').val('').trigger('change');

      // Clear cart items
      var cartItems = document.getElementById('cart_items');
      cartItems.innerHTML = '<tr id="no_items_row"><td colspan="6" class="text-center"></td></tr>';
      document.getElementById('grand_total2').innerText = '0';
      
      // Generate a new transaction number
      document.getElementById('transaction_number').innerText = generateTransactionNumber();

      // Reset delivery details
      document.getElementById('delivery_method').value = '';
      deliveryDetails.style.display = 'none';
      document.getElementById('delivery_address').value = '';
      document.getElementById('delivery_date').value = '';
      document.getElementById('delivery_time').value = '';

      // Reset flower name and quantity
      document.getElementById('flower_name').value = '';
      document.getElementById('flower_name').dataset.id = '';
      document.getElementById('flower_name').dataset.price = '';
      document.getElementById('flower_qty').value = '1';
  });

  // Generate transaction number on page load
  document.getElementById('transaction_number').innerText = generateTransactionNumber();

function generateReceiptHTML(transactionDetails) {
    return `
        <!DOCTYPE html>
        <html>
        <head>
            <title>Receipt</title>
            <style>
                @media print {
                    @page {
                        margin: 0;
                    }
                    body {
                        margin: 1.6cm;
                    }
                }
                body {
                    font-family: Arial, sans-serif;
                }
                .receipt {
                    width: 300px;
                    margin: auto;
                    padding: 10px;
                    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                }
                .receipt h1, .receipt h2 {
                    text-align: center;
                    margin: 0;
                    font-size: 1em; /* Ukuran font lebih kecil */
                }
                .receipt p {
                    margin: 5px 0;
                    font-size: 0.8em; /* Ukuran font lebih kecil */
                }
                .receipt table {
                    width: 100%;
                    border-collapse: collapse;
                    margin-top: 10px; /* Jarak antara tabel */
                }
                .receipt th, .receipt td {
                    padding: 5px;
                    text-align: left;
                }
                .receipt th {
                    border-bottom: 1px solid #000;
                }
                .receipt .total, .receipt .change {
                    text-align: right;
                }
                .receipt .thanks {
                    text-align: center;
                    margin-top: 20px;
                    font-style: italic;
                }
                .receipt .left, .receipt .right {
                    display: inline-block;
                    width: 49%;
                }
                .receipt .right {
                    text-align: right;
                }
                .receipt .address {
                    border-bottom: 1px dashed #000; /* Garis putus-putus */
                    margin-bottom: 10px; /* Jarak setelah alamat */
                    padding-bottom: 5px; /* Jarak antara garis dan teks */
                }
                .receipt .totals {
                    float: right;
                }
                .receipt .total-label, .receipt .change-label {
                    float: left;
                    clear: left;
                }
                .receipt .dashed-line {
                    border-top: 1px dashed #000;
                    clear: right;
                }
            </style>
        </head>
        <body>
            <div class="receipt">
                <h1>BloomBoutique</h1>
                <h2 class="address">Jl. Merdeka Jaya No.17B</h2>
                <div class="left">
                    <p>${transactionDetails.date} ${transactionDetails.time}</p>
                    <p>${transactionDetails.no_transaction}</p>
                    <p>Method: ${transactionDetails.method}</p>
                </div>
                <div class="right">
                    <p>Cashier: ${transactionDetails.cashier}</p>
                    <p>Customer: ${transactionDetails.customer}</p>
                </div>
                <hr>
                <table>
                    <thead>
                        <tr>
                            <th>Item</th>
                            <th>Qty</th>
                            <th>Price</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        ${transactionDetails.items.map(item => `
                            <tr>
                                <td>${item.flower_name}</td>
                                <td>${item.quantity}</td>
                                <td>${item.price}</td>
                                <td>${item.subtotal}</td>
                            </tr>
                        `).join('')}
                    </tbody>
                </table>
                <hr>
                <table class="totals">
                    <tbody align="right">
                        <tr>
                            <td class="total-label">Grand Total</td>
                            <td class="total">${transactionDetails.grand_total}</td>
                        </tr>
                        <tr>
                            <td class="total-label">Cash</td>
                            <td class="total">${transactionDetails.cash}</td>
                        </tr>
                        <tr>
                            <td class="total-label">Change</td>
                            <td class="change">${transactionDetails.change}</td>
                        </tr>
                    </tbody>
                </table>
                <div class="dashed-line"></div>
                <div class="dashed-line" style="width: ${transactionDetails.grand_total.length}ch;"></div>
                <p class="thanks">~~~ Thank You ~~~</p>
            </div>
        </body>
        </html>
    `;
}

  document.getElementById('payment').addEventListener('click', function() {
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    var date = document.getElementById('date').value;
    var customerId = document.getElementById('customer_id').value;
    var cash = parseFloat(document.getElementById('cash').value);
    var grandTotal = parseFloat(document.getElementById('grand_total2').innerText);
    var deliveryMethod = document.getElementById('delivery_method').value;
    var deliveryAddress = document.getElementById('delivery_address').value;
    var deliveryDate = document.getElementById('delivery_date').value;
    var deliveryTime = document.getElementById('delivery_time').value;
    var cartItems = [];
  
    var rows = document.querySelectorAll('#cart_items tr');
    rows.forEach(function(row) {
        if (row.id !== 'no_items_row') {
            var itemId = row.dataset.flowerId;
            var flowerName = row.querySelector('td:nth-child(2)').innerText;
            var flowerPrice = parseFloat(row.querySelector('td:nth-child(3)').innerText);
            var quantity = parseInt(row.querySelector('td:nth-child(4)').innerText);
            var subtotal = parseFloat(row.querySelector('td:nth-child(5)').innerText);
  
            cartItems.push({
                item_id: itemId,
                flower_name: flowerName,
                price: flowerPrice,
                quantity: quantity,
                subtotal: subtotal
            });
        }
    });

    const transactionNumber = generateTransactionNumber();

    const transactionDetails = {
        date: document.getElementById('date').value,
        time: new Date().toLocaleTimeString(),
        cashier: document.getElementById('user_name').value, // Replace with the actual cashier's name
        customer: document.getElementById('customer_id').selectedOptions[0].text,
        method: document.getElementById('delivery_method').value,
        no_transaction: transactionNumber,
        items: cartItems, // This should be an array of items from the cart
        grand_total: grandTotal,
        cash: cash,
        change: document.getElementById('change').value
    };

    const receiptHTML = generateReceiptHTML(transactionDetails);

    const printWindow = window.open('', '_blank', 'width=600,height=400');
    printWindow.document.write(receiptHTML);
    printWindow.document.close();
    printWindow.onload = function() {
        printWindow.print();
        printWindow.close();
    };

  
    var xhr = new XMLHttpRequest();
    xhr.open('POST', '/transactions/sales/store');
    xhr.setRequestHeader('Content-Type', 'application/json');
    xhr.setRequestHeader('X-CSRF-TOKEN', csrfToken);
  
    xhr.onload = function() {
        if (xhr.status === 200) {
            var response = JSON.parse(xhr.responseText);
            window.location.href = response.redirect;
        } else {
            alert('Error occurred while processing payment. Please try again.');
            console.error(xhr.responseText);
        }
    };
  
    xhr.onerror = function() {
        alert('Error occurred while processing payment. Please try again.');
        console.error(xhr.responseText);
    };
  
    xhr.send(JSON.stringify({
        date: date,
        customer_id: customerId,
        cash: cash,
        grand_total: grandTotal,
        delivery_method: deliveryMethod,
        delivery_address: deliveryAddress,
        delivery_date: deliveryDate,
        delivery_time: deliveryTime,
        cart_items: cartItems
    }));
  });


  $(document).ready(function() {
  $('#customer_id').select2({
      placeholder: "Select Customer",
      allowClear: true
  });

});

const searchForms = document.querySelectorAll('.navbar-search form');

searchForms.forEach(function(searchForm) {
    searchForm.addEventListener('submit', function (event) {
        event.preventDefault(); 

        const searchTerm = searchForm.querySelector('input').value.trim();
        if (searchTerm !== '') {
         
            console.log('Search term:', searchTerm);
        }
    });
});
});

function generateTransactionNumber() {
  // Function to generate a new transaction number
  var latestTransactionNumber = Math.floor(Math.random() * 1000000); // Random transaction number
  return 'TRX' + String(latestTransactionNumber).padStart(6, '0'); // Format the transaction number
}

const togglePassword = document.querySelector('#togglePassword');
const password = document.querySelector('#password');

togglePassword.addEventListener('click', function (e) {
  
    const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
    password.setAttribute('type', type);
   
    this.classList.toggle('fa-eye');
    this.classList.toggle('fa-eye-slash');
});

})(jQuery); // End of use strict
