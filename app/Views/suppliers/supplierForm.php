<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Suppliers <small class="breadcrumb-item active"><small>  Pemasok Barang</small></small></h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Suppliers</a></li>
          <li class="breadcrumb-item active">Suppliers Data </li>
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
                <h3 class="card-title"><?= $page ?> Suplier</h3>
                <div class=" ml-auto ">
                    <a href="<?=base_url('suppliers')?>" id="suppliers" class="btn btn-sm btn-warning " style="color: white;"><i class="fas fa-undo">
                        </i> Back</a>
                </div>
            </div>
            <div class="row p-4">
                <div class="col-md-6 offset-md-3">
                    <form action="<?=base_url('suppliers/save')?>" method="post" autocomplete="off">
                        <?= csrf_field() ?>
                        <input type="hidden" name="supplier_id" value="<?= set_value('supplier_id', $supplier->supplier_id) ?>">
                        <div class="form-group">
                            <label for="name">Nama Supplier</label>
                            <input type="text" class="form-control" id="name" name="name" value="<?= set_value('name', $supplier->name) ?>" autocomplete="off" placeholder="Masukkan Nama Supplier" required>
                        </div>
                        <div class="form-group">
                            <label for="phone">No. Telepon</label>
                            <input type="text" class="form-control" id="phone" name="phone" value="<?= set_value('phone', $supplier->phone) ?>" autocomplete="off" placeholder="Masukkan No. Telepon" required>
                        </div>
                        <div class="form-group">
                            <label for="address">Alamat</label>
                            <input type="text" class="form-control" id="address" name="address" value="<?= set_value('address', $supplier->address) ?>" autocomplete="off" placeholder="Masukkan Alamat" required>
                        </div>
                        <div class="form-group">
                            <label for="description">Deskripsi</label>
                            <textarea class="form-control" id="description" name="description" autocomplete="off" ><?= set_value('description', $supplier->description) ?></textarea>
                        </div>
                        <div class="d-flex justify-content-end pt-3">
                            <button type="reset" class="btn btn-default"><i class="fas fa-eraser"></i> Reset</button>
                            <button type="submit" class="btn btn-success ml-3"><i class="fas fa-paper-plane" name="<?=$page?>"></i>
                                Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

</section>