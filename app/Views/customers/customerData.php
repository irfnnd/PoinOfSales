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
        <h3 class="card-title">Customers Data</h3>
        <div class=" ml-auto ">
          <a href="<?= site_url('customers/add') ?>" id="customers-form-add" class="btn btn-sm btn-info"><i
              class="fas fa-plus pr-1"></i> Add</a>
        </div>
      </div>
      <!-- /.card-header -->
      <div class="card-body table-responsive">
        <table id="tabel1" class="table table-sm table-hover table-bordered table-striped">
          <thead>
            <tr>
              <th style="width: 3%;">No</th>
              <th style="min-width: 160px; max-width: 300px;">Name</th>
              <th style="min-width: 100px; max-width: 400px;">Gender</th>
              <th style="min-width: 120px; max-width: 200px;">Phone</th>
              <th style="min-width: 200px;">Address</th>
              <th style="width: 15%; text-align: center;">Action</th>
            </tr>
          </thead>

          <tbody>
            <?php $c = 1; ?>
            <?php if (!empty($customers) && is_array($customers)): ?>
              <?php foreach ($customers as $customer): ?>
                <tr>
                  <td><?= $c++ ?>.</td>
                  <td><?= esc($customer['name']); ?></td>
                  <td><?= esc($customer['gender']); ?></td> <!-- Menampilkan peran berdasarkan level -->
                  <td><?= esc($customer['phone']); ?></td>
                  <td><?= esc($customer['address']); ?></td>
                  <td class="text-center">
                    <a href="<?= site_url('customers/edit/' . $customer['customer_id']) ?>"
                      class="btn btn-sm btn-info mr-2"><i class="fas fa-edit"></i></a>
                    <a href="#" data-url="customers/delete/<?= $customer['customer_id']; ?>"
                      class="btn btn-sm btn-danger delete-button"><i class="fas fa-trash"></i></a>
                  </td>
                </tr>
              <?php endforeach; ?>
            <?php else: ?>
              <tr>
                <td colspan="5">No customer found</td>
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