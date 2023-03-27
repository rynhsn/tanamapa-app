<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <div class="container-fluid">
         <div class="row mb-2">
            <div class="col-sm-6">
               <h1><?= $title; ?></h1>
            </div>
         </div>
      </div><!-- /.container-fluid -->
   </section>

   <!-- Main content -->
   <section class="content">
      <!-- pesan error -->
      <?= form_error('auth', '<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><small>', '</small></div>'); ?>

      <!-- pesan berhasil -->
      <?= $this->session->flashdata('message'); ?>
      <div class="card">
         <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
               <thead>
                  <tr>
                     <th style="width: 10px">#</th>
                     <th>ID</th>
                     <th>Token</th>
                     <th class="text-center">Kontrol</th>
                  </tr>
               </thead>
               <tbody>
                  <?php $i = 1; ?>
                  <?php foreach ($devices as $device) : ?>
                     <tr>
                        <td><?= $i; ?></td>
                        <td><?= $device['id']; ?></td>
                        <td><?= $device['token']; ?></td>
                        <td class="text-center">
                           <div class="btn-group">
                              <button class="btn btn-info" style="border-radius:50px 0 0 50px" data-toggle="modal" data-target="#updateDeviceModal<?= $device['id']; ?>"><i class="fas fa-fw fa-pen"></i></button>
                              <a class="btn btn-danger" style="border-radius:0 50px 50px 0" href="<?= base_url('admin/deletedevice/' . $device['id']); ?>" onclick="return confirm('Yakin? data yang dihapus tidak dapat dikembalikan.')"><i class="fas fa-fw fa-trash-alt"></i></a>
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

<button class="btn btn-success btn-lg rounded-circle elevation-2" style="position: fixed;right: 20px; bottom: 80px; z-index: 999;" height="50%" data-toggle="modal" data-target="#newDeviceModal">
   <i class="fas fa-plus fa-lg py-3 px-2"></i>
</button>

<!-- Add Modal -->
<div class="modal fade" id="newDeviceModal">
   <div class="modal-dialog modal-md">
      <div class="modal-content">
         <div class="modal-header">
            <h4 class="modal-title">Tambah Perangkat</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <form action="<?= base_url('admin/devices'); ?>" method="post">
            <div class="modal-body">
               <div class="form-group">
                  <input class="form-control rounded-pill" type="text" name="token" id="token" placeholder="Masukkan client token blynk...">
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
<?php foreach ($devices as $device) : ?>
   <div class="modal fade" id="updateDeviceModal<?= $device['id']; ?>">
      <div class="modal-dialog modal-md">
         <div class="modal-content">
            <div class="modal-header">
               <h4 class="modal-title">Ubah Token Perangkat</h4>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <form action="<?= base_url('admin/updatedevice'); ?>" method="post">
               <div class="modal-body">
                  <div class="form-group">
                     <input class="form-control rounded-pill" type="text" name="id" id="id" value="<?= $device['id']; ?>" readonly>
                  </div>
                  <div class="form-group">
                     <input class="form-control rounded-pill" type="text" name="token" id="token" value="<?= $device['token']; ?>" placeholder="Masukkan token baru..." required>
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