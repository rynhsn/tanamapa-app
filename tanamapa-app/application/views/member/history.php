<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" id="halaman">
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
                     <th>ID Seleksi</th>
                     <th>Tanggal</th>
                     <th>Lokasi</th>
                     <th class="text-center">Kontrol</th>
                  </tr>
               </thead>
               <tbody>
                  <?php $i = 1; ?>
                  <?php foreach ($histories as $history) : ?>
                     <tr>
                        <td><?= $i; ?></td>
                        <td><?= $history['id']; ?></td>
                        <td id="timestamp"><?= date('d/m/y H:i:s', $history['timestamp']); ?></td>
                        <td id="lat"><?= $history['lat'] . ', ' . $history['lng']; ?></td>

                        <td class="text-center">
                           <div class="btn-group">
                              <a class="btn btn-warning" href="<?= base_url('member/viewmeasurement?id=' . $history['id']); ?>" style="border-radius:50px 0 0 50px" title="Lihat">Lihat</a>
                              <a class="btn btn-danger" style="border-radius:0 50px 50px 0" href="<?= base_url('member/delmeasurement?id=' . $history['id']); ?>" onclick="return confirm('Yakin? data yang dihapus tidak dapat dikembalikan.')" title="Hapus">Hapus</a>
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