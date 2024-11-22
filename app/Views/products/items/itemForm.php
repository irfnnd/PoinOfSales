<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Items <small class="breadcrumb-item active"> Barang</small></h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Items</a></li>
                    <li class="breadcrumb-item active">Data Items </li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header d-flex align-items-center">
                <h3 class="card-title"><?= $page ?> Item</h3>
                <div class=" ml-auto ">
                    <a href="<?= base_url('products/items') ?>" id="items" class="btn btn-sm btn-warning "
                        style="color: white;"><i class="fas fa-undo">
                        </i> Back</a>
                </div>
            </div>
            <div class="row p-4">
                <div class="col-md-10 offset-md-1">
                    <form action="<?= base_url('products/items/save') ?>" method="post" autocomplete="off" enctype="multipart/form-data">
                        <?= csrf_field() ?>
                        <input type="hidden" name="item_id" value="<?= set_value('item_id', $item->item_id) ?>">
                        <div class="row">
                            <div class="col-md-5 offset">
                                <div class="form-group">
                                    <label for="name">Barcode</label>
                                    <input type="text" class="form-control" id="barcode" name="barcode"
                                        value="<?= set_value('barcode', $item->barcode) ?>" autocomplete="off"
                                        placeholder="Masukkan barcode item" required>
                                    <?php if (isset($validation) && $validation->hasError('barcode')): ?>
                                        <div class="text-danger">
                                            <?= $validation->getError('barcode') ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div class="form-group">
                                    <label for="name">Nama Item</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                        value="<?= set_value('name', $item->name) ?>" autocomplete="off"
                                        placeholder="Masukkan nama item" required>
                                </div>
                                <div class="form-group">
                                    <label for="category">Category</label>
                                    <select class="form-control" id="category" name="category" required>
                                        <option value="">- Pilih -</option>
                                        <<?php foreach ($category as $c): ?>
                                                <option value="<?= $c['category_id'] ?>" <?= isset($item->category_id) && $item->category_id == $c['category_id'] ? 'selected' : '' ?>>
                                                    <?= $c['name'] ?></option>
                                            <?php endforeach; ?>
                                    </select>
                                </div>
                                <div>
                                    <label for="unit">Unit</label>
                                    <select class="form-control" id="unit" name="unit" required>
                                        <option value="">- Pilih -</option>
                                        <<?php foreach ($unit as $u): ?>
                                                <option value="<?= $u['unit_id'] ?>" <?= isset($item->category_id) && $item->unit_id == $u['unit_id'] ? 'selected' : '' ?>>
                                                    <?= $u['name'] ?></option>
                                            <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 offset-md-1">
                                <div class="form-group">
                                    <label for="price">Harga</label>
                                    <input type="number" class="form-control" id="price" name="price"
                                        value="<?= set_value('price', $item->price) ?>" autocomplete="off"
                                        placeholder="Masukkan harga item" required>
                                </div>
                                <div class="form-group">
                                    <label for="image">Image</label>
                                    <?php if (!empty($item->image)): ?>
                                        <div class="mb-2">
                                            <img src="<?= base_url('uploads/images/' . $item->image) ?>"
                                                class="img-fluid" alt="Responsive image" width="170px">
                                        </div>
                                    <?php endif; ?>

                                    <input type="file" class="form-control" id="image" name="image"
                                        value="<?= set_value('image', $item->image) ?>" >
                                    <small>* Kosongkan jika tidak<?= $page == 'Edit' ? ' ingin mengubah' : ' ada'?> </small>
                                    <?php if (isset($validation) && $validation->hasError('image')): ?>
                                        <div class="text-danger">
                                            <?= $validation->getError('image') ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end pt-3">
                            <button type="reset" class="btn btn-default"><i class="fas fa-eraser"></i> Reset</button>
                            <button type="submit" class="btn btn-success ml-3"><i class="fas fa-paper-plane"></i>
                                Submit</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>

</section>