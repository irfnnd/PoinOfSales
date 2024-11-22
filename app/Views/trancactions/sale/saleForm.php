<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Sales<small class="text-muted"> Penjualan</small></h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Transactions</a></li>
                    <li class="breadcrumb-item active">Sales</li>
                </ol>
            </div>
        </div>
    </div>
</section>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-4">
                <div class="card card-widget">
                    <div class="card-body">
                        <table>
                            <tr>
                                <td style="vertical-align:top">
                                    <label for="date">Date</label>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <input type="date" value="<?= date('Y-m-d') ?>" name="date" id="date"
                                            class="form-control">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td style="vertical-align:top; width: 30%;">
                                    <label for="user">Kasir</label>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <input type="text" name="user" id="user" class="form-control"
                                            value="<?= session()->get('name') ?>" readonly>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td style="vertical-align:top; width: 30%;">
                                    <label for="customer">Customer</label>
                                </td>
                                <td>
                                    <input type="hidden" id="custome_id">  
                                    <div class=" form-group input-group">
                                        <input type="hidden" id="customer_id">
                                        <input type="text" value="Umum" id="customer_name" class="form-control">
                                        <span class="input-group-append">
                                            <button type="button" class="btn btn-info" data-toggle="modal"
                                            data-target="#modal-cus"><i class="fas fa-search"></i></button>
                                        </span>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card card-widget">
                    <div class="card-body">
                        <form id="formItem">
                            <div class="table-responsive">
                                <table style="width: 100%;">
                                    <tr>
                                        <td style="vertical-align:top; width: 30%;">
                                            <label for="barcode">Barcode</label>
                                        </td>
                                        <td>
                                            <!-- Input Hidden Fields -->
                                            <input type="hidden" id="item_id" name="item_id">
                                            <input type="hidden" id="item_name" name="item_name">
                                            <input type="hidden" id="price" name="price">
                                            <input type="hidden" id="stock" name="stock">
                                            <input type="hidden" id="unit_name" name="unit_name">

                                            <!-- Barcode Input Group -->
                                            <div class="form-group input-group">
                                                <input type="text" id="barcode" name="barcode" class="form-control" placeholder="Barcode" required>
                                                <span class="input-group-append">
                                                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal">
                                                        <i class="fas fa-search"></i>
                                                    </button>
                                                </span>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="vertical-align:top;">
                                            <label for="qty">Qty</label>
                                        </td>
                                        <td>
                                            <!-- Quantity Input -->
                                            <div class="form-group">
                                                <input type="number" id="qty" name="qty" value="1" min="1" class="form-control" required>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td>
                                            <!-- Add to Cart Button -->
                                            <div class="d-flex justify-content-end">
                                                <button type="submit" id="add_cart" class="btn btn-primary">
                                                    <i class="fas fa-cart-plus"></i> Add
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card card-widget">
                    <div class="card-body">
                        <div class="text-right">
                            <h4>Invoice <b><span><?= $invoice; ?></span></b></h4>
                            <h1><b><span id="grand_total2" style="font-size: 45pt">0</span></b></h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-widget">
                    <div class="card-body table-responsive">
                        <table class="table table-sm table-bordered table-striped">
                            <thead class="table-bordered">
                                <tr>
                                    <th>No.</th>
                                    <th>Barcode</th>
                                    <th>Product Item</th>
                                    <th>Unit</th>
                                    <th>Price</th>
                                    <th>Qty</th>
                                    <th style="width: 10%;">Discount Item</th>
                                    <th style="width: 15%;">Total</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="cart_table">
                                <tr id="empty_row">
                                    <td colspan="9" class="text-center">Tidak ada item</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3">
                <div class="card card-widget">
                    <div class="card-body">
                        <table width="100%">
                            <tr>
                                <td style="vertical-align:top; width: 30%;">
                                    <label for="sub_total">Sub Total</label>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <input type="number" id="sub_total" class="form-control" readonly>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td style="vertical-align:top;">
                                    <label for="discount">Discount</label>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <input type="number" id="discount" value="0" min="0" class="form-control">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td style="vertical-align:top;">
                                    <label for="grand_total">Grand Total</label>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <input type="number" id="grand_total" class="form-control" readonly>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="card card-widget">
                    <div class="card-body">
                        <table width="100%">
                            <tr>
                                <td style="vertical-align:top; width: 30%;">
                                    <label for="cash">Cash</label>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <input type="number" id="cash" class="form-control" value="0" min="0">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td style="vertical-align:top;">
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
                <div class="card card-widget">
                    <div class="card-body">
                        <table width="100%">
                            <tr>
                                <td style="vertical-align:top;">
                                    <label for="note">Note</label>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <textarea id="note" rows="3" class="form-control"></textarea>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div>
                    <button class="btn btn-flat btn-warning" id="cancel_payment">
                        <i class="fas fa-sync-alt"></i>   Cancel
                    </button><br><br>
                    <button class="btn btn-flat btn-lg btn-success" id="process_payment">
                        <i class="fas fa-paper-plane"></i> Process Paymentt
                    </button>
                </div>
            </div>
        </div>
</section>
<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content p-3">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLabel">Select Product</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body table-responsive">
                <table class="table table-sm table-bordered table-striped" id="tabel1">
                    <thead>
                        <tr>
                            <th>Barcode</th>
                            <th>Name</th>
                            <th>Unit</th>
                            <th>Price</th>
                            <th>Stock</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($items) && is_array($items)): ?>
                            <?php foreach ($items as $item): ?>
                                <tr>
                                    <td><?= esc($item['barcode']); ?></td>
                                    <td><?= esc($item['name']); ?></td>
                                    <td><?= esc($item['unit_name']); ?></td>
                                    <td><?= rupiah(esc($item['price'])); ?></td>
                                    <td><?= esc($item['stock']); ?></td>
                                    <td class="text-center">
                                        <button class="btn btn-xs btn-info" id="select" data-id="<?= $item['item_id']; ?>" data-barcode="<?= $item['barcode']; ?>"
                                            data-name="<?= $item['name']; ?>" data-unit="<?= $item['unit_name']; ?>" data-stock="<?= $item['stock']; ?>" data-price="<?= $item['price']; ?>">
                                            <i class="fas fa-check"></i> Select
                                        </button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr >
                                <td colspan="6">No item found</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $(document).on('click','#select', function() {
            var id = $(this).data('id');
            var barcode = $(this).data('barcode');
            var name = $(this).data('name');
            var price = $(this).data('price');  
            var unit = $(this).data('unit');
            var stock = $(this).data('stock');
            $('#item_id').val(id);
            $('#barcode').val(barcode);
            $('#price').val(price);
            $('#item_name').val(name);
            $('#unit_name').val(unit);
            $('#stock').val(stock);
            $('#modal').modal('hide');
        });
    });
</script>
<div class="modal fade" id="modal-cus" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content p-3">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLabel">Select Product</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body table-responsive">
                <table class="table table-sm table-bordered table-striped" id="tabel1">
                    <thead>
                        <tr>
                            <th>No. </th>
                            <th>Nama Customer</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; if (!empty($customers) && is_array($customers)): ?>
                            <?php foreach ($customers as $customer): ?>
                                <tr>
                                    <td><?= $i++; ?></td>
                                    <td><?= esc($customer['name']); ?></td>
                                    <td class="text-center">
                                        <button class="btn btn-xs btn-info" id="select_c" data-id="<?= $customer['customer_id']; ?>"
                                            data-name="<?= $customer['name']; ?>" >
                                            <i class="fas fa-check"></i> Select
                                        </button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="2">No item found</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $(document).on('click','#select_c', function() {
            var id = $(this).data('id');
            var name = $(this).data('name');
            $('#customer_id').val(id);
            $('#customer_name').val(name);
            $('#modal-cus').modal('hide');
        });
    });
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.0/js/bootstrap.bundle.min.js"></script>

<script>
    $(document).ready(function() {
        // Fungsi untuk mendapatkan nomor terakhir di tabel
        function getLastNumber() {
            let lastRow = $('#cart_table tr:last-child td:first-child').text().trim();
            let lastNumber = parseInt(lastRow);
            return isNaN(lastNumber) ? 0 : lastNumber; // Jika tidak ada nomor, kembalikan 0
        }

        // Ketika tombol "Add Cart" diklik
        $('#add_cart').click(function(e) {
            e.preventDefault();

            let no = getLastNumber() + 1; // Ambil nomor terakhir dan tambahkan 1

            // Dapatkan data dari input form
            let item_id = $('#item_id').val();
            let item_name = $('#item_name').val();
            let unit_name = $('#unit_name').val();
            let barcode = $('#barcode').val();
            let price = $('#price').val();
            let qty = $('#qty').val();

            if (barcode === '') {
                alert('Barcode tidak boleh kosong');
                return; // Batalkan jika barcode kosong
            }

            let total = price * qty; // Hitung total

            // Mengirim data melalui AJAX
            $.ajax({
                url: '<?= base_url('trancactions/sales/addCart'); ?>', // Ganti dengan URL Anda
                method: 'POST',
                data: {
                    no: no,
                    item_id: item_id,
                    item_name: item_name,
                    unit_name: unit_name,
                    barcode: barcode,
                    price: price,
                    qty: qty
                },
                dataType: 'json',
                success: function(response) {
                    $('#empty_row').remove(); // Hapus baris "Tidak ada item" jika ada
                    $('#cart_table').append(response.output); // Tambah item ke tabel
                    $('#formItem')[0].reset(); // Reset form
                    calculateSubtotal(); // Hitung subtotal
                    calculateGrandTotal(); // Hitung grand total
                }
            });
        });

        // Ketika tombol delete diklik
        $(document).on('click', '.delete_cart', function() {
            let item_id = $(this).data('item-id');
            let row = $(this).closest('tr');  // Ambil baris yang akan dihapus

            $.ajax({
                url: '<?= base_url('transactions/sales/removeCart'); ?>',
                method: 'POST',
                data: { item_id: item_id },
                success: function(response) {
                    if (response.status === 'success') {
                        row.remove();  // Hapus baris dari tabel
                        resetNumbering(); // Reset nomor urut
                        if ($('#cart_table').find('tr').length === 0) {
                            $('#cart_table').append('<tr id="empty_row"><td colspan="9" class="text-center">Tidak ada item</td></tr>');
                        }
                    }
                    calculateSubtotal();
                    calculateGrandTotal();
                }
            });
        });

        // Fungsi untuk reset nomor urut setelah delete
        function resetNumbering() {
            let no = 1;
            $('#cart_table tr').each(function() {
                $(this).find('td:first-child').text(no);
                no++;
            });
        }

        // Ketika tombol edit_qty diklik
        $(document).on('click', '.edit_cart', function() {
            let row = $(this).closest('tr');
            let currentQty = row.find('.qty').text();

            row.find('.qty').html(`
                <div class="d-flex">
                    <input type="number" value="${currentQty}" class="form-control input_qty" style="width: 60px; height: 25px;" min="1">
                    <span>
                        <button class="btn btn-xs ml-1 btn-success save_qty">
                            <i class="fas fa-check"></i>
                        </button>
                    </span>
                </div>
            `);
            row.find('.edit_qty').hide(); // Sembunyikan tombol edit
        });

        // Ketika tombol save_qty diklik
        $(document).on('click', '.save_qty', function() {
            let row = $(this).closest('tr');
            let newQty = row.find('.input_qty').val();

            if (newQty <= 0) {
                alert('Qty harus lebih dari 0');
                return;
            }

            row.find('.qty').text(newQty); // Update qty di tampilan
            let price = row.find('.price').text();
            let newTotal = price * newQty;
            row.find('.total').text(newTotal.toFixed(2)); // Update total baru
            row.find('.save_qty').hide(); // Sembunyikan tombol save
            row.find('.edit_qty').show(); // Tampilkan kembali tombol edit
            calculateSubtotal(); // Hitung ulang grand total
            calculateGrandTotal();

        });

        // Fungsi untuk menghitung ulang subtotal dan grand total
        function calculateSubtotal() {
            let subtotal = 0;

            $('#cart_table tr').each(function() {
                let rowTotal = $(this).find('.total').text();
                if (rowTotal !== '') {
                    subtotal += parseFloat(rowTotal);
                }
            });

            $('#sub_total').val(subtotal.toFixed(2)); // Set subtotal
            calculateGrandTotal(); // Hitung grand total
        }
        // Fungsi untuk menghitung ulang grand total
        function calculateGrandTotal() {
            let subtotal = parseFloat($('#sub_total').val().replace(/[^0-9.-]+/g,"")); // Remove Rupiah symbol for calculation
            let discount = parseFloat($('#discount').val()) || 0; // Ambil nilai diskon, default 0 jika kosong

            let discountAmount = (discount / 100) * subtotal;
            let grandTotal = subtotal - discountAmount;

            // Format grand total dengan Rupiah dan set di input Grand Total
            $('#grand_total').val(grandTotal.toFixed(2)); // Tampilkan grand total dalam format Rupiah

            // Set grand total ke elemen dengan id grand_total2 dan tanpa format Rupiah
            $('#grand_total2').text(rupiah(grandTotal)); // Gunakan format Rupiah di tampilan besar
        }

        // Contoh fungsi rupiah untuk format
        function rupiah(number) {
            let reverse = number.toString().split('').reverse().join('');
            let ribuan = reverse.match(/\d{1,3}/g);
            return 'Rp. ' + ribuan.join('.').split('').reverse().join('');
        }
        // Ketika nilai diskon diubah, hitung ulang grand total
        $('#discount').on('input', function() {
            calculateGrandTotal();
        });
    });
</script>

<script>
    $(document).ready(function() {
        $('#process_payment').click(function(e) {
            e.preventDefault();

            // Gather the data
            let cartItems = [];
            $('#cart_table tr').each(function() {
                let item = {
                    item_id: $(this).find('.item_id').text(),
                    item_name: $(this).find('.item_name').text(),
                    unit_name: $(this).find('.unit_name').text(),
                    barcode: $(this).find('.barcode').text(),
                    price: parseFloat($(this).find('.price').text()),
                    qty: parseInt($(this).find('.qty').text()),
                    total: parseFloat($(this).find('.total').text())
                };
                cartItems.push(item); // Add each item to the cartItems array
            });

            let sub_total = parseFloat($('#sub_total').val());
            let discount = parseFloat($('#discount').val()) || 0; // Default to 0 if no discount
            let grand_total = parseFloat($('#grand_total').val());
            customer_id = $('#customer_id').val();
            // Prepare the data to send
            let transactionData = {
                customer_id: customer_id,  // Hardcoded for now (you might change this)
                sub_total: sub_total,
                discount: discount,
                grand_total: grand_total,
                payment_method: 'Cash',  // Hardcoded payment method for now
                status: 'Paid',  // Assuming payment is completed
                cart_items: cartItems
            };

            // Send the data via AJAX to the server
            $.ajax({
                url: '<?= base_url('transactions/sales/processPayment'); ?>',  // Adjust to your route
                method: 'POST',
                data: transactionData,
                dataType: 'json',
                success: function(response) {
                    if (response.status === 'success') {
                        alert('Transaction completed successfully');
                        // You may want to redirect or clear the cart here
                        window.location.reload();  // Reload the page
                    } else {
                        alert('Failed to process transaction');
                    }
                }
            });
        });
    });
</script>


