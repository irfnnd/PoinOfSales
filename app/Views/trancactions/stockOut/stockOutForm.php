<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Stock Out<small class="breadcrumb-item active"> Barang Keluar / Penjualan</small></h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Trancactions</a></li>
                    <li class="breadcrumb-item active">Stock Out</li>
                </ol>
            </div>
        </div>
    </div>
</section>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header d-flex align-items-center">
                <h3 class="card-title">Add Stock Out</h3>
                <div class="ml-auto">
                    <a href="<?= base_url('trancactions/stocks/out') ?>" id="items" class="btn btn-sm btn-warning" style="color: white;">
                        <i class="fas fa-undo"></i> Back
                    </a>
                </div>
            </div>
            <div class="row p-4">
                <div class="col-md-10 offset-md-1">
                    <form action="<?= site_url('trancactions/stocks/out/save') ?>" method="post" autocomplete="off" enctype="multipart/form-data">
                        <?= csrf_field() ?>
                        <div class="row">
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="date">Date <span style="color: red;">*</span></label>
                                    <input type="date" class="form-control" id="date" name="date" value="<?= date('Y-m-d') ?>" required>
                                </div>
                                <div>
                                    <label for="barcode">Barcode <span style="color: red;">*</span></label>
                                </div>
                                <input type="hidden" class="form-control" id="item_id" name="item_id">
                                <div class="form-group input-group">
                                    <input type="text" class="form-control" id="barcode" name="barcode" required autofocus>
                                    <span class="input-group-append">
                                        <button type="button" class="btn btn-primary btn-flat" id="scan">
                                            <i class="fas fa-qrcode"></i>
                                        </button>
                                        <button type="button" class="btn btn-primary" id="search" data-toggle="modal" data-target="#modal">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </span>
                                </div>
                                <div class="form-group">
                                    <label for="item_name">Item Name <span style="color: red;">*</span></label>
                                    <input type="text" class="form-control" id="item_name" name="item_name" readonly>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <label for="unit">Item Unit <span style="color: red;">*</span></label>
                                            <input type="text" class="form-control" id="unit" name="unit" readonly>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="stock">Initial Stock <span style="color: red;">*</span></label>
                                            <input type="number" class="form-control" id="stock" name="stock" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="detail">Info <span style="color: red;">*</span></label>
                                    <textarea class="form-control" id="detail" name="detail" placeholder="Keterangan" required></textarea>
                                </div>
                            </div>
                            <div class="col-md-6 offset-md-1">
                                <div class="form-group">
                                    <label for="qty">Qty <span style="color: red;">*</span></label>
                                    <input type="number" class="form-control" id="qty" name="qty" required>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end pt-3">
                            <button type="reset" class="btn btn-default"><i class="fas fa-eraser"></i> Reset</button>
                            <button type="submit" name="inAdd" class="btn btn-success ml-3"><i class="fas fa-paper-plane"></i> Submit</button>
                        </div>
                    </form>
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
                                            data-name="<?= $item['name']; ?>" data-unit="<?= $item['unit_name']; ?>" data-stock="<?= $item['stock']; ?>">
                                            <i class="fas fa-check"></i> Select
                                        </button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
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
            var unit = $(this).data('unit');
            var stock = $(this).data('stock');
            $('#item_id').val(id);
            $('#barcode').val(barcode);
            $('#item_name').val(name);
            $('#unit').val(unit);
            $('#stock').val(stock);
            $('#modal').modal('hide');
        });
    });
</script>
