<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Customers <small class="breadcrumb-item active"> Konsumen</small></h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Customers</a></li>
                    <li class="breadcrumb-item active">Customers Data </li>
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
                <h3 class="card-title"><?= $page ?> Customer</h3>
                <div class=" ml-auto ">
                    <a href="<?= base_url('customers') ?>" id="customers" class="btn btn-sm btn-warning "
                        style="color: white;"><i class="fas fa-undo">
                        </i> Back</a>
                </div>
            </div>
            <div class="row p-4">
                <div class="col-md-6 offset-md-3">
                    <form action="<?= base_url('customers/save') ?>" method="post" autocomplete="off">
                        <?= csrf_field() ?>
                        <input type="hidden" name="customer_id"
                            value="<?= set_value('customer_id', $customer->customer_id) ?>">
                        <div class="form-group">
                            <label for="name">Nama Konsumen</label>
                            <input type="text" class="form-control" id="name" name="name"
                                value="<?= set_value('name', $customer->name) ?>" autocomplete="off"
                                placeholder="Masukkan nama customer" required>
                        </div>
                        <div class="form-group">
                            <label for="gender">Jenis Kelamin</label>
                            <select class="form-control" id="gender" name="gender">
                                <option value="">- Pilih -</option>
                                <option value="Laki-laki" <?= set_value('gender', $customer->gender) == 'Laki-laki' ? 'selected' : '' ?>>Laki-laki</option>
                                <option value="Perempuan" <?= set_value('gender', $customer->gender) == 'Perempuan' ? 'selected' : '' ?>>Perempuan</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="phone">No. Telepon</label>
                            <input type="text" class="form-control" id="phone" name="phone"
                                value="<?= set_value('phone', $customer->phone) ?>" autocomplete="off"
                                placeholder="Masukkan No. Telepon" required>
                        </div>
                        <div class="form-group">
                            <label for="address">Alamat</label>
                            <textarea class="form-control" id="address" name="address"
                                autocomplete="off"><?= set_value('address', $customer->address) ?></textarea>
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