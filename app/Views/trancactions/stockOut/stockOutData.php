<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Stock Out<small class="text-muted"> Barang Keluar / Penjualan</small></h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Transactions</a></li>
                    <li class="breadcrumb-item active">Stock Out</li>
                </ol>
            </div>
        </div>
    </div>
</section>

<section class="content">
    <?php if (session()->getFlashdata('success')): ?>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
        <script>
            $(document).ready(function () {
                Swal.fire({
                    title: 'Success!',
                    text: "<?= session()->getFlashdata('success') ?>",
                    icon: 'success',
                    timer: 1500,
                    showConfirmButton: false
                });
            });
        </script>
    <?php endif; ?>
    <?php if (session()->getFlashdata('error')): ?>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
        <script>
            $(document).ready(function () {
                Swal.fire({
                    title: 'Error!',
                    text: "<?= session()->getFlashdata('error') ?>",
                    icon: 'error',
                    timer: 2000,
                    showConfirmButton: false
                });
            });
        </script>
    <?php endif; ?>

    <div class="container-fluid">
        <div class="card">
            <div class="card-header d-flex align-items-center">
                <h3 class="card-title">Stock Out Data</h3>
                <div class="ml-auto">
                    <a href="<?= site_url('trancactions/stocks/out/add') ?>" id="stockIn-form-add" class="btn btn-sm btn-info"><i class="fas fa-plus pr-1"></i> Add</a>
                </div>
            </div>
            <div class="card-body table-responsive">
                <table id="tabel1" class="table table-sm table-hover table-bordered table-striped">
                    <thead>
                        <tr>
                            <th style="width: 3%;">No</th>
                            <th>Barcode</th>
                            <th>Product Item</th>
                            <th>Qty</th>
                            <th>Date</th>
                            <th style="width: 15%;" class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($stocks) && is_array($stocks)): ?>
                            <?php $c = 1; ?>
                            <?php foreach ($stocks as $stock): ?>
                                <tr>
                                    <td><?= $c++ ?>.</td>
                                    <td><?= $stock['barcode']; ?></td>
                                    <td><?= $stock['item_name']; ?></td>
                                    <td><?= $stock['qty']; ?></td>
                                    <td><?= indo_date($stock['date']); ?></td>
                                    <td class="text-center">
                                        <a href="#" class="btn btn-sm btn-info mr-2" id="show_detail" data-toggle="modal" data-target="#modal-detail"
                                           data-barcode="<?= $stock['barcode']; ?>"
                                           data-name="<?= $stock['item_name']; ?>"
                                           data-qty="<?= $stock['qty']; ?>"
                                           data-date="<?= indo_date($stock['date']); ?>"
                                           data-suppliername="<?= $stock['supplier_name']; ?>"
                                           data-detail="<?= $stock['detail']; ?>"><i class="fas fa-eye"></i></a>
                                        <a href="#" data-url="<?= site_url('trancactions/stocks/out/delete/' . $stock['stock_id'] . '/' . $stock['item_id']); ?>"
                                           class="btn btn-sm btn-danger delete-button"><i class="fas fa-trash"></i></a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6">No stock found</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
    <script>
        $(document).ready(function () {
            // Handle delete button click
            $('.delete-button').on('click', function (e) {
                e.preventDefault(); // Prevent default link behavior
                var deleteUrl = $(this).data('url'); // Get the delete URL from data attribute

                Swal.fire({
                    title: 'Anda yakin?',
                    text: "Data yang dihapus tidak dapat dikembalikan!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, Hapus!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = deleteUrl; // Redirect to the delete URL
                    }
                });
            });

            // Handle modal detail click
            $(document).on('click', '#show_detail', function () {
                var barcode = $(this).data('barcode');
                var name = $(this).data('name');
                var qty = $(this).data('qty');
                var date = $(this).data('date');
                var supplier = $(this).data('suppliername');
                var detail = $(this).data('detail');

                $('#barcode').text(barcode);
                $('#item_name').text(name);
                $('#qty').text(qty);
                $('#date').text(date);
                $('#suppliername').text(supplier);
                $('#detail').text(detail);
            });
        });
    </script>
</section>

<div class="modal fade" id="modal-detail" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content p-2 pb-3">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLabel">Stock Out Detail</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-hover table-bordered mb-0">
                    <tbody>
                        <tr>
                            <td>Barcode</td>
                            <td><span id="barcode"></span></td>
                        </tr>
                        <tr>
                            <td>Product Name</td>
                            <td><span id="item_name"></span></td>
                        </tr>
                        <tr>
                            <td>Qty</td>
                            <td><span id="qty"></span></td>
                        </tr>
                        <tr>
                            <td>Date</td>
                            <td><span id="date"></span></td>
                        </tr>
                        <tr>
                            <td>Supplier Name</td>
                            <td><span id="suppliername"></span></td>
                        </tr>
                        <tr>
                            <td>Detail</td>
                            <td><span id="detail"></span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
