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

  <div class="container-fluid">
    <div class="card">
      <div class="card-header d-flex align-items-center">
        <h3 class="card-title"> Data Items</h3>
        <div class=" ml-auto ">
          <a href="<?= site_url('products/items/add') ?>" id="items-form-add" class="btn btn-sm btn-info"><i
              class="fas fa-plus pr-1"></i> Add</a>
        </div>
      </div>
      <!-- /.card-header -->
      <div class="card-body table-responsive">
        <table id="tabel1" class="table table-sm table-hover table-bordered table-striped">
          <thead>
            <tr>
              <th style="width: 3%;">No</th>
              <th>Barcode</th>
              <th>Name</th>
              <th>Category</th>
              <th>Unit</th>
              <th>Price</th>
              <th>Image</th>
              <th>Stock</th>
              <th style="width:15%" class="text-center">Action</th>
            </tr>
          </thead>

          <tbody>
            <?php $c = 1; ?>
            <?php if (!empty($items) && is_array($items)): ?>
              <?php foreach ($items as $item): ?>
                <tr>
                  <td><?= $c++ ?>.</td>
                  <td>
                    <?= esc($item['barcode']); ?>
                    <a href="<?= site_url('products/items/barcode_qrcode/'.$item['item_id']) ?>"
                  class="btn btn-sm btn-default mr-2"><i class="fas fa-barcode mr-1"></i> <i class="fas fa-qrcode"></i></a>
                  </td>
                  <td><?= esc($item['name']); ?></td>
                  <td><?= esc($item['category_name']); ?></td>
                  <td><?= esc($item['unit_name']); ?></td>
                  <td><?=  rupiah(esc($item['price'])); ?></td>
                  <td class="text-center">
                    <?php if (!empty($item['image'])): ?>
                      <img src="<?= base_url('uploads/images/' . $item['image']) ?>" class="img-fluid" alt="Responsive image"
                        width="50px" height="50px">
                    <?php endif; ?>
                  </td>
                  <td><?= esc($item['stock']); ?></td>
                  <td class="text-center">
                    <a href="<?= site_url('products/items/edit/' . $item['item_id']) ?>" class="btn btn-sm btn-info mr-2"><i
                        class="fas fa-edit"></i></a>
                    <a href="#" data-url="/products/items/delete/<?= $item['item_id']; ?>"
                      class="btn btn-sm btn-danger delete-button"><i class="fas fa-trash"></i></a>
                  </td>
                </tr>
              <?php endforeach; ?>
            <?php else: ?>
              <tr>
                <td colspan="5">No item found</td>
              </tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
      <!-- /.card-body -->
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
          text: "Data yang di hapus tidak dapat dikembalikan!",
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
    });
  </script>


</section>