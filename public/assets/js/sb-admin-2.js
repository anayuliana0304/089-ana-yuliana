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
    $('#flower_table').DataTable();

    function updateCartVisibility() {
      var cartItems = document.querySelectorAll('#cart_items tr');
      var noItemsRow = document.getElementById('no_items_row');
  
      // Check if there are any rows in the cart other than the placeholder row
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
          // Check if the flower is already in the cart
          var existingFlowerRow = document.querySelector(`#cart_items tr[data-flower-id="${flowerId}"]`);
          if (existingFlowerRow) {
              // If flower already exists, update its quantity
              var existingQty = parseInt(existingFlowerRow.querySelector('td:nth-child(4)').innerText);
              var newQty = existingQty + parseInt(qty);
              existingFlowerRow.querySelector('td:nth-child(4)').innerText = newQty;
              existingFlowerRow.querySelector('td:nth-child(5)').innerText = flowerPrice * newQty;
          } else {
              // If flower doesn't exist, add a new row
              var cartItems = document.getElementById('cart_items');
              var newRow = document.createElement('tr');
              var totalItems = cartItems.querySelectorAll('tr:not(#no_items_row)').length + 1; // Get total items in cart
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
              newRow.dataset.flowerId = flowerId; // Add flower id to the row
              cartItems.appendChild(newRow);
          }
  
          // Update the total and cart visibility
          updateTotal();
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
      var cartItems = []; // Array to store cart items
      var rows = document.querySelectorAll('#cart_items tr'); // Select all rows in cart
  
      rows.forEach(function(row) {
          // Check if the row is the placeholder row
          if (row.id === 'no_items_row') {
              return; // Skip this row
          }
  
          var cells = row.querySelectorAll('td');
          if (cells.length > 0) {
              var itemId = row.dataset.flowerId; // Get item id from dataset
              var flowerName = cells[1].innerText;
              var flowerPrice = parseFloat(cells[2].innerText);
              var quantity = parseInt(cells[3].innerText);
              var subtotal = parseFloat(cells[4].innerText);
  
              // Add item information to the cartItems array
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
  
      // Log the cart items to the console
      console.log('Cart Items:', cartItems);
  
      // Update the total amount
      total = total.toFixed(2); // Round to 2 decimal places
      total = parseFloat(total) === parseInt(total) ? parseInt(total) : parseFloat(total); // Convert to integer if no decimal
      document.getElementById('grand_total2').innerText = total;
  }
  
  

    // Function to generate transaction number
    function generateTransactionNumber() {
        // Retrieve the latest transaction number from the server or database
        // For demonstration purposes, I'm generating a random transaction number here
        var latestTransactionNumber = Math.floor(Math.random() * 1000000); // Random transaction number
        return 'TRX' + String(latestTransactionNumber).padStart(6, '0'); // Format the transaction number
    }
});



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

// Generate a transaction number
function generateTransactionNumber() {
  var latestTransactionNumber = Math.floor(Math.random() * 1000000); // Generate a random number
  return 'TRX' + String(latestTransactionNumber).padStart(6, '0'); // Format the transaction number
}

document.addEventListener('DOMContentLoaded', function () {
  document.getElementById('cancel_payment').addEventListener('click', function () {
      document.getElementById('cash').value = '';
      document.getElementById('change').value = '';
      document.getElementById('packaging').value = '';
      $('#customer_id').val('').trigger('change');
      var cartItems = document.getElementById('cart_items');
      cartItems.innerHTML = '<tr id="no_items_row"><td colspan="6" class="text-center">no item found</td></tr>';
      document.getElementById('grand_total2').innerText = '0';
      document.getElementById('transaction_number').innerText = generateTransactionNumber();
  });

  // Generate transaction number on page load
  document.getElementById('transaction_number').innerText = generateTransactionNumber();

  });

  document.getElementById('payment').addEventListener('click', function() {
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    var date = document.getElementById('date').value;
    var customerId = document.getElementById('customer_id').value;
    var cash = parseFloat(document.getElementById('cash').value);
    var grandTotal = parseFloat(document.getElementById('grand_total2').innerText);
    var packaging = document.getElementById('packaging').value;
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

    var xhr = new XMLHttpRequest();
    xhr.open('POST', '/transactions/sales/store');
    xhr.setRequestHeader('Content-Type', 'application/json');
    xhr.setRequestHeader('X-CSRF-TOKEN', csrfToken);
    
    xhr.onload = function() {
        if (xhr.status === 200) {
            alert('Transaction successful!');
            window.location.href = '/transactions/sales';
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
        packaging: packaging,
        cart_items: cartItems
    }));
});

})(jQuery); // End of use strict
