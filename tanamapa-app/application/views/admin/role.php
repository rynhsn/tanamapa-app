<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <div class="container-fluid">
         <div class="row mb-2">
            <div class="col-sm-6">
               <h1>Akses Pengguna</h1>
            </div>
         </div>
      </div><!-- /.container-fluid -->
   </section>

   <!-- Main content -->
   <section class="content">
      <!-- pesan error -->
      <?= form_error('menu', '<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><small>', '</small></div>'); ?>

      <!-- pesan berhasil -->
      <?= $this->session->flashdata('message'); ?>
      <div class="card">
         <div class="card-body table-responsive p-0">
            <table class="table table-hover text-nowrap">
               <thead>
                  <tr>
                     <th style="width: 10px">#</th>
                     <th>Role</th>
                     <th class="text-center">Kontrol</th>
                  </tr>
               </thead>
               <tbody>
                  <?php $i = 1; ?>
                  <?php foreach ($roles as $role) : ?>
                     <tr>
                        <td><?= $i; ?></td>
                        <td><?= $role['role']; ?></td>
                        <td class="text-center">
                           <div class="btn-group">
                              <a class="btn btn-warning" style="border-radius:50px 0 0 50px" href="<?= base_url('admin/roleaccess/' . $role['id']); ?>"><i class="fas fa-fw fa-door-open"></i></a>
                              <button class="btn btn-info" data-toggle="modal" data-target="#updateRoleModal<?= $role['id']; ?>"><i class="fas fa-fw fa-pen"></i></button>
                              <a class="btn btn-danger" style="border-radius:0 50px 50px 0" href="<?= base_url('admin/deleterole/' . $role['id']); ?>" onclick="return confirm('Yakin? data yang dihapus tidak dapat dikembalikan.')"><i class="fas fa-fw fa-trash-alt"></i></a>
                           </div>
                        </td>
                     </tr>
                     <?php $i++; ?>
                  <?php endforeach; ?>
               </tbody>
            </table>
         </div>
         <!-- /.card-body -->
      </div>
      <!-- /.card -->
   </section>
   <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<button class="btn btn-success btn-lg rounded-circle elevation-2" style="position: fixed;right: 20px; bottom: 80px; z-index: 999;" height="50%" data-toggle="modal" data-target="#newRoleModal">
   <i class="fas fa-plus fa-lg py-3 px-2"></i>
</button>

<!-- Add Modal -->
<div class="modal fade" id="newRoleModal">
   <div class="modal-dialog modal-sm">
      <div class="modal-content">
         <div class="modal-header">
            <h4 class="modal-title">Tambah Role</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <form action="<?= base_url('admin/role'); ?>" method="post">
            <div class="modal-body">
               <div class="form-group">
                  <input class="form-control rounded-pill" type="text" name="role" id="role" placeholder="Masukkan role">
               </div>
            </div>
            <div class="modal-footer justify-content-between">
               <button type="button" class="btn btn-default rounded-pill" data-dismiss="modal">Batal</button>
               <button type="submit" class="btn btn-success rounded-pill">Simpan</button>
            </div>
         </form>
      </div>
      <!-- /.modal-content -->
   </div>
   <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!-- Update Modal -->
<?php foreach ($roles as $role) : ?>
   <div class="modal fade" id="updateRoleModal<?= $role['id']; ?>">
      <div class="modal-dialog modal-sm">
         <div class="modal-content">
            <div class="modal-header">
               <h4 class="modal-title">Ubah Role</h4>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <form action="<?= base_url('admin/updaterole'); ?>" method="post">
               <div class="modal-body">
                  <div class="form-group">
                     <input class="form-control rounded-pill" type="text" name="id" id="id" value="<?= $role['id']; ?>" placeholder="Masukkan nama menu..." hidden readonly>
                     <input class="form-control rounded-pill" type="text" name="role" id="role" value="<?= $role['role']; ?>" placeholder="Masukkan nama role" required>
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