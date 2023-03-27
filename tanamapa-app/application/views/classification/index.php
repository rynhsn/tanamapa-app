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
                     <th>Tanaman Buah</th>
                     <th class="text-center">Suhu Rata-rata (&deg;C/th)</th>
                     <th class="text-center">Curah Hujan (mm/th)</th>
                     <th class="text-center">Kelembaban Udara (%)</th>
                     <th class="text-center">Nilai pH</th>
                     <th class="text-center">Ketinggian (mdpl)</th>
                     <?php if ($user['role_id'] == 1) : ?>
                        <th class="text-center">Kontrol</th>
                     <?php endif; ?>
                  </tr>
               </thead>
               <tbody>
                  <?php $i = 1; ?>
                  <?php foreach ($classifications as $classification) : ?>
                     <tr>
                        <td><?= $i; ?></td>
                        <td><?= $classification['plant_name']; ?></td>
                        <td class="text-center"><?= $classification['temp_min']; ?>-<?= $classification['temp_max']; ?></td>
                        <td class="text-center"><?= $classification['rf_min']; ?>-<?= $classification['rf_max']; ?></td>
                        <td class="text-center"><?= $classification['hmdt_min']; ?>-<?= $classification['hmdt_max']; ?></td>
                        <td class="text-center"><?= $classification['ph_min']; ?>-<?= $classification['ph_max']; ?></td>
                        <td class="text-center"><?= $classification['ele_min']; ?>-<?= $classification['ele_max']; ?></td>

                        <?php if ($user['role_id'] == 1) : ?>
                           <td class="text-center">
                              <div class="btn-group">
                                 <a class="btn btn-info" href="<?= base_url('klasifikasi/edit/' . $classification['id']); ?>" style="border-radius:50px 0 0 50px"><i class="fas fa-fw fa-pen"></i></a>
                                 <a class="btn btn-danger" style="border-radius:0 50px 50px 0" href="<?= base_url('klasifikasi/delete/' . $classification['id']); ?>" onclick="return confirm('Yakin? data yang dihapus tidak dapat dikembalikan.')"><i class="fas fa-fw fa-trash-alt"></i></a>
                              </div>
                           </td>
                        <?php endif; ?>

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

<?php if ($user['role_id'] == 1) : ?>
   <a href="<?= base_url('klasifikasi/add'); ?>" class="btn btn-success btn-lg rounded-circle elevation-2" style="position: fixed;right: 20px; bottom: 80px; z-index: 999;" height="50%">
      <i class="fas fa-plus fa-lg py-3 px-2"></i>
   </a>
<?php endif; ?>