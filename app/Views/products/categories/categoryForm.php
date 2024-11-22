<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Categories <small class="breadcrumb-item active"> Kategory</small></h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Categories</a></li>
                    <li class="breadcrumb-item active">Data Categories </li>
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
                <h3 class="card-title"><?= $page ?> Category</h3>
                <div class=" ml-auto ">
                    <a href="<?= base_url('products/categories') ?>" id="categories" class="btn btn-sm btn-warning "
                        style="color: white;"><i class="fas fa-undo">
                        </i> Back</a>
                </div>
            </div>
            <div class="row p-4">
                <div class="col-md-6 offset-md-3">
                    <form action="<?= base_url('products/categories/save') ?>" method="post" autocomplete="off">
                        <?= csrf_field() ?>
                        <input type="hidden" name="category_id"
                            value="<?= set_value('category_id', $category->category_id) ?>">
                        <div class="form-group">
                            <label for="name">Nama Category</label>
                            <input type="text" class="form-control" id="name" name="name"
                                value="<?= set_value('name', $category->name) ?>" autocomplete="off"
                                placeholder="Masukkan nama category" required>
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