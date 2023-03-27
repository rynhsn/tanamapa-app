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
      <?= form_error('place', '<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><small>', '</small></div>'); ?>

      <!-- pesan berhasil -->
      <?= $this->session->flashdata('message'); ?>
      <div class="card">
         <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
               <thead>
                  <tr>
                     <th style="width: 10px">#</th>
                     <th>Wilayah</th>
                     <th class="text-center">Suhu Rata-rata</th>
                     <th class="text-center">Curah Hujan</th>
                     <th class="text-center">Kontrol</th>
                  </tr>
               </thead>
               <tbody>
                  <?php $i = 1; ?>
                  <?php foreach ($climates as $climate) : ?>
                     <tr>
                        <td><?= $i; ?></td>
                        <td><?= $climate['region']; ?></td>
                        <td class="text-center"><?= $climate['average_temp']; ?>&deg;C/th</td>
                        <td class="text-center"><?= $climate['rainfall']; ?> mm/th</td>
                        <td class="text-center">
                           <div class="btn-group">
                              <button class="btn btn-info" style="border-radius:50px 0 0 50px" data-toggle="modal" data-target="#updateClimateModal<?= $climate['id']; ?>"><i class="fas fa-fw fa-pen"></i></button>
                              <a class="btn btn-danger" style="border-radius:0 50px 50px 0" href="<?= base_url('iklim/delete/' . $climate['id']); ?>" onclick="return confirm('Yakin? data yang dihapus tidak dapat dikembalikan.')"><i class="fas fa-fw fa-trash-alt"></i></a>
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

<button class="btn btn-success btn-lg rounded-circle elevation-2" style="position: fixed;right: 20px; bottom: 80px; z-index: 999;" height="50%" data-toggle="modal" data-target="#newClimateModal">
   <i class="fas fa-plus fa-lg py-3 px-2"></i>
</button>

<!-- Add Modal -->
<div class="modal fade" id="newClimateModal">
   <div class="modal-dialog modal-sm">
      <div class="modal-content">
         <div class="modal-header">
            <h4 class="modal-title">Tambah Wilayah</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <form action="<?= base_url('iklim'); ?>" method="post">
            <div class="modal-body">
               <div class="form-group row">
                  <label for="place" class="col-form-label ml-3">Wilayah (Kota/Kab)</label>
                  <input class="form-control rounded-pill" type="text" name="place" id="place" placeholder="Masukkan Wilayah...">
               </div>
               <div class="form-group row">
                  <label for="average_temp" class="col-form-label ml-3">Suhu Rata-rata (&deg;C/th)</label>
                  <input class="form-control rounded-pill" type="number" name="average_temp" id="average_temp" placeholder="Masukkan Suhu...">
               </div>
               <div class="form-group row">
                  <label for="rainfall" class="col-form-label ml-3">Jumlah Curah Hujan (mm/th)</label>
                  <input class="form-control rounded-pill" type="number" name="rainfall" id="rainfall" placeholder="Masukkan Curah Hujan...">
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
<?php foreach ($climates as $climate) : ?>
   <div class="modal fade" id="updateClimateModal<?= $climate['id']; ?>">
      <div class="modal-dialog modal-sm">
         <div class="modal-content">
            <div class="modal-header">
               <h4 class="modal-title">Ubah Iklim</h4>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <form action="<?= base_url('iklim/update'); ?>" method="post">
               <div class="modal-body">
                  <input type="text" name="id" value="<?= $climate['id']; ?>" readonly hidden>
                  <div class="form-group row">
                     <label for="place" class="col-form-label ml-3">Wilayah (Kota/Kab)</label>
                     <input class="form-control rounded-pill" type="text" name="place" id="place" placeholder="Masukkan Wilayah..." value="<?= $climate['region']; ?>" required>
                  </div>
                  <div class="form-group row">
                     <label for="average_temp" class="col-form-label ml-3">Suhu Rata-rata (&deg;C/th)</label>
                     <input class="form-control rounded-pill" type="number" name="average_temp" id="average_temp" placeholder="Masukkan Suhu..." value="<?= $climate['average_temp']; ?>" required>
                  </div>
                  <div class="form-group row">
                     <label for="rainfall" class="col-form-label ml-3">Jumlah Curah Hujan (mm/th)</label>
                     <input class="form-control rounded-pill" type="number" name="rainfall" id="rainfall" placeholder="Masukkan Curah Hujan..." value="<?= $climate['rainfall']; ?>" required>
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