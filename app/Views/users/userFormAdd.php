<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Add User</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Users</a></li>
                    <li class="breadcrumb-item active">Add User </li>
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
                <h3 class="card-title">Users Data</h3>
                <div class=" ml-auto ">
                    <a href="<?= base_url('users') ?>" id="users" class="btn btn-sm btn-warning " style="color: white;"><i
                            class="fas fa-undo">
                        </i> Back</a>
                </div>
            </div>
            <div class="row p-4">
                <div class="col-md-10 offset-md-1">
                    <form action="add" method="post" autocomplete="off">
                        <?= csrf_field() ?>
                        <div class="row">
                            <div class="col-md-5 offset">
                                <div class="form-group">
                                    <label for="username">Username</label>
                                    <input type="text" class="form-control" id="username" name="username"
                                        value="<?= set_value('username') ?>" autocomplete="off"
                                        placeholder="Enter username">
                                    <?php if (isset($errors['username'])): ?>
                                        <div style="color: red;">
                                            <?= $errors['username'] ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                        placeholder="Enter name" value="<?= set_value('name') ?>" autocomplete="off">
                                    <?php if (isset($errors['name'])): ?>
                                        <div style="color: red;">
                                            <?= $errors['name'] ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control" id="password" name="password"
                                        value="<?= set_value('password') ?>" autocomplete="new-password"
                                        placeholder="Enter Password">
                                    <?php if (isset($errors['password'])): ?>
                                        <div style="color: red;">
                                            <?= $errors['password'] ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div class="form-group">
                                    <label for="passconf">Password Confirmation</label>
                                    <input type="password" class="form-control" id="passconf" name="passconf"
                                        value="<?= set_value('passconf') ?>" autocomplete="new-password"
                                        placeholder="Enter Password Confirmation">
                                    <?php if (isset($errors['passconf'])): ?>
                                        <div style="color: red;">
                                            <?= $errors['passconf'] ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="col-md-6 offset-md-1">
                                <div class="form-group">
                                    <label for="address">Address</label>
                                    <textarea class="form-control" id="address" name="address"
                                        placeholder="Enter address"><?= set_value('address'); ?></textarea>
                                    <?php if (isset($errors['address'])): ?>
                                        <div style="color: red;">
                                            <?= $errors['address'] ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div class="form-group">
                                    <label for="level">Level</label>
                                    <select class="form-control" id="level" name="level">
                                        <option value="">- Pilih -</option>
                                        <option value="1" <?= set_value('level') == 1 ? 'selected' : '' ?>>Admin</option>
                                        <option value="2" <?= set_value('level') == 2 ? 'selected' : '' ?>>Kasir</option>
                                    </select>
                                    <?php if (isset($errors['level'])): ?>
                                        <div style="color: red;">
                                            <?= $errors['level'] ?>
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