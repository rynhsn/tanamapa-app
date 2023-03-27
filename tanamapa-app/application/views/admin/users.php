<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <div class="container-fluid">
         <div class="row mb-2">
            <div class="col-sm-6">
               <h1>Kelola Pengguna</h1>
            </div>
         </div>
      </div><!-- /.container-fluid -->
   </section>

   <!-- Main content -->
   <section class="content">
      <div class="container-fluid">
         <div class="row">
            <div class="col-12">
               <!-- pesan error -->
               <?php if (validation_errors()) : ?>
                  <div class="alert alert-danger alert-dismissible" role="alert">
                     <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                     <small><?= validation_errors(); ?></small>
                  </div>
               <?php endif; ?>

               <!-- pesan berhasil -->
               <?= $this->session->flashdata('message'); ?>
               <div class="card">
                  <div class="card-body">
                     <table id="example1" class="table table-bordered table-striped">
                        <thead>
                           <tr>
                              <th style="width: 10px">#</th>
                              <th>Nama Lengkap</th>
                              <th>Email</th>
                              <th>Role</th>
                              <th class="text-center">Status</th>
                              <th>Tanggal Daftar</th>
                              <th class="text-center">Kontrol</th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php $i = 1; ?>
                           <?php foreach ($users as $user) : ?>
                              <tr>
                                 <td><?= $i; ?></td>
                                 <td><?= $user['name']; ?></td>
                                 <td><?= $user['email']; ?></td>
                                 <td>
                                    <?php foreach ($roles as $role) {
                                       if ($user['role_id'] == $role['id']) {
                                          echo $role['role'];
                                       }
                                    } ?>
                                 </td>
                                 <td class="text-center">
                                    <i class="fas fa-fw fa-circle <?= ($user['is_active'] ? 'text-success' : 'text-danger'); ?>"></i>
                                 </td>
                                 <td><?= date('d M Y', $user['date_created']); ?></td>
                                 <td class="text-center">
                                    <div class="btn-group">
                                       <button class="btn btn-warning" style="border-radius:50px 0 0 50px" data-toggle="modal" data-target="#editUserPassModal<?= $user['id']; ?>"><i class="fas fa-fw fa-key"></i></button>
                                       <button class="btn btn-info" data-toggle="modal" data-target="#editUserModal<?= $user['id']; ?>"><i class="fas fa-fw fa-pen"></i></button>
                                       <a class="btn btn-danger" style="border-radius:0 50px 50px 0" href="<?= base_url('admin/deleteuser/' . $user['email']); ?>" onclick="return confirm('Yakin? data yang dihapus tidak dapat dikembalikan.')"><i class="fas fa-fw fa-trash-alt"></i></a>
                                    </div>
                                 </td>
                              </tr>
                              <?php $i++; ?>
                           <?php endforeach; ?>
                           </tr>
                        </tbody>
                     </table>
                  </div>
                  <!-- /.card-body -->
               </div>
               <!-- /.card -->
            </div>
         </div>
      </div>
   </section>
   <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<button class="btn btn-success btn-lg rounded-circle elevation-2" style="position: fixed;right: 20px; bottom: 80px; z-index: 999;" height="50%" data-toggle="modal" data-target="#newUserModal">
   <i class="fas fa-plus fa-lg py-3 px-2"></i>
</button>

<!-- Add Modal -->
<div class="modal fade" id="newUserModal">
   <div class="modal-dialog modal-sm">
      <div class="modal-content">
         <div class="modal-header">
            <h4 class="modal-title">Tambah Pengguna</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <form action="<?= base_url('admin/users'); ?>" method="post">
            <div class="modal-body">
               <div class="form-group">
                  <input class="form-control rounded-pill" type="text" name="name" id="name" placeholder="Masukkan nama pengguna">
               </div>
               <div class="form-group">
                  <input class="form-control rounded-pill" type="email" name="email" id="email" placeholder="Masukkan email pengguna">
               </div>
               <div class="form-group">
                  <select class="form-control rounded-pill" name="role_id" id="role_id">
                     <option value="" disabled selected>Pilih Role</option>
                     <?php foreach ($roles as $role) : ?>
                        <option value="<?= $role['id']; ?>"><?= $role['role']; ?></option>
                     <?php endforeach; ?>
                  </select>
               </div>
               <div class="form-group">
                  <input class="form-control rounded-pill" type="password" name="password1" id="password1" placeholder="Masukkan password">
               </div>
               <div class="form-group">
                  <input class="form-control rounded-pill" type="password" name="password2" id="password2" placeholder="Masukkan password">
               </div>
               <div class="form-group pl-2">
                  <div class="form-check">
                     <input class="form-check-input" name="is_active" id="is_active" value="1" type="checkbox" checked>
                     <label class="form-check-label" for="is_active">Aktif?</label>
                  </div>
               </div>
               <div class="modal-footer justify-content-between">
                  <button type="button" class="btn btn-default rounded-pill" data-dismiss="modal">Batal</button>
                  <button type="submit" class="btn btn-success rounded-pill">Simpan</button>
               </div>
            </div>
         </form>
      </div>
      <!-- /.modal-content -->
   </div>
   <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!-- Edit Modal -->
<?php foreach ($users as $user) : ?>
   <div class="modal fade" id="editUserModal<?= $user['id']; ?>">
      <div class="modal-dialog modal-sm">
         <div class="modal-content">
            <div class="modal-header">
               <h4 class="modal-title">Ubah Pengguna</h4>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <form action="<?= base_url('admin/edituser'); ?>" method="post">
               <div class="modal-body">
                  <div class="form-group">
                     <input class="form-control rounded-pill" type="text" name="id" id="id" value="<?= $user['id']; ?>" hidden readonly>
                  </div>
                  <div class="form-group">
                     <input class="form-control rounded-pill" type="text" name="name" id="name" value="<?= $user['name']; ?>" placeholder="Masukkan nama pengguna" required>
                  </div>
                  <div class="form-group">
                     <input class="form-control rounded-pill" type="text" name="email" id="email" value="<?= $user['email']; ?>" placeholder="Masukkan email pengguna" required>
                  </div>
                  <div class="form-group">
                     <select class="form-control rounded-pill" name="role_id" id="role_id" required>
                        <option value="" disabled>Pilih Role</option>
                        <?php foreach ($roles as $role) : ?>
                           <option value="<?= $role['id']; ?>" <?= ($user['role_id'] == $role['id'] ? 'selected' : ''); ?>><?= $role['role']; ?></option>
                        <?php endforeach; ?>
                     </select>
                  </div>
                  <div class="form-group pl-2">
                     <div class="form-check">
                        <input class="form-check-input" name="is_active" id="is_active" value="1" type="checkbox" <?= ($user['is_active'] == '1' ? 'checked' : ''); ?>>
                        <label class="form-check-label" for="is_active">Aktif?</label>
                     </div>
                  </div>
               </div>
               <div class="modal-footer justify-content-between">
                  <button type="button" class="btn btn-default rounded-pill" data-dismiss="modal">Batal</button>
                  <button type="submit" class="btn btn-info rounded-pill">Simpan</button>
               </div>
            </form>
         </div>
         <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
   </div>
   <!-- /.modal -->
<?php endforeach; ?>

<!-- Edit Password Modal -->
<?php foreach ($users as $user) : ?>
   <div class="modal fade" id="editUserPassModal<?= $user['id']; ?>">
      <div class="modal-dialog modal-sm">
         <div class="modal-content">
            <div class="modal-header">
               <h4 class="modal-title">Ubah Password Pengguna</h4>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <form action="<?= base_url('admin/changepass'); ?>" method="post">
               <div class="modal-body">
                  <div class="form-group">
                     <input class="form-control rounded-pill" type="text" name="email" id="email" value="<?= $user['email']; ?>" readonly>
                  </div>
                  <div class="form-group">
                     <input class="form-control rounded-pill" type="password" name="password1" id="password1" placeholder="Masukkan password">
                  </div>
                  <div class="form-group">
                     <input class="form-control rounded-pill" type="password" name="password2" id="password2" placeholder="Masukkan password">
                  </div>
               </div>
               <div class="modal-footer justify-content-between">
                  <button type="button" class="btn btn-default rounded-pill" data-dismiss="modal">Batal</button>
                  <button type="submit" class="btn btn-info rounded-pill">Simpan</button>
               </div>
            </form>
         </div>
         <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
   </div>
   <!-- /.modal -->
<?php endforeach; ?>