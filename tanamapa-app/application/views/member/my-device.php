<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <div class="container-fluid">
         <div class="row mb-2 justify-content-sm-center">
            <div class="col-sm-3">
               <h1 class="text-center"><?= $title; ?></h1>
            </div>
         </div>
         <div class="row mb-2 justify-content-sm-center">
            <div class="col-sm-3">
               <?= $this->session->flashdata('message'); ?>
            </div>
         </div>
      </div><!-- /.container-fluid -->
   </section>

   <!-- Main content -->
   <section class="content">
      <div class="container-fluid">
         <div class="row justify-content-center">
            <div class="col-11">
               <?php if ($device) : ?>
                  <div class="row">
                     <div class="col-sm-6">
                        <div class="form-group">
                           <label for="id"><code><i class="fas fa-fingerprint mr-1"></i></code> ID Perangkat</label>
                           <input type="text" class="form-control bg-transparent border-0" id="id" name="id" value="<?= $device['id']; ?>" readonly>
                        </div>
                     </div>
                     <div class="col-sm-6">
                        <div class="form-group">
                           <label for="status"><code><i class="fas fa-toggle-on mr-1"></i></code> Status</label>
                           <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                 <span class="input-group-text border-0 bg-transparent rounded-0"><i class="fas fa-circle" id="statusInd"></i></span>
                              </div>
                              <input type="text" class="form-control bg-transparent border-0" id="status" name="status" readonly>
                           </div>
                        </div>
                     </div>
                  </div>
                  <hr>
                  <div id="resource" hidden>
                     <div class="row">
                        <div class="col-sm-3">
                           <strong><code><i class="fas fa-map-marker-alt mr-1"></i></code> Posisi anda saat ini</strong>
                        </div>
                     </div>
                     <div class="row mt-3">
                        <div class="col-sm-6">
                           <div id="map" style="height:300px;"></div>
                        </div>
                        <div class="col-sm-6">
                           <div class="form-group row text-muted">
                              <label for="lat" class="col-5 col-form-label">Lintang</label>
                              <div class="col-7">
                                 <input type="text" class="form-control bg-transparent border-0" id="lat" name="lat" readonly>
                              </div>
                              <label for="lon" class="col-5 col-form-label">Bujur</label>
                              <div class="col-7">
                                 <input type="text" class="form-control bg-transparent border-0" id="lon" name="lon" readonly>
                              </div>
                              <label for="ele" class="col-5 col-form-label">Ketinggian (mdpl)</label>
                              <div class="col-7">
                                 <input type="text" class="form-control bg-transparent border-0" id="ele" name="ele" readonly>
                              </div>
                              <label for="place_name" class="col-5 col-form-label">Lokasi</label>
                              <div class="col-7">
                                 <textarea class="form-control bg-transparent border-0" name="place_name" id="place_name" rows="3" readonly></textarea>
                              </div>
                           </div>
                        </div>
                     </div>
                     <hr>
                  </div>

                  <button class="btn btn-info rounded-pill mb-3" data-toggle="modal" data-target="#newDeviceModal">Ganti Perangkat</button>

               <?php else : ?>
                  <!-- <h3 class="text-center text-danger">Anda belum terhubung dengan perangkat apapun!</h3> -->
                  <div class="alert alert-danger alert-dismissible" role="alert">
                     <p class="text-center">Anda belum terhubung dengan perangkat apapun! silahkan hubungkan perangkat.</p>
                  </div>
               <?php endif; ?>
            </div>
         </div>
      </div>
   </section>
   <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php if (!$device) : ?>
   <button class="btn btn-success btn-lg rounded-circle elevation-2" style="position: fixed;right: 20px; bottom: 80px; z-index: 999;" data-toggle="modal" data-target="#newDeviceModal">
      <i class="fas fa-link fa-lg py-3 px-2"></i>
   </button>
<?php endif; ?>


<!-- Add Modal -->
<div class="modal fade" id="newDeviceModal">
   <div class="modal-dialog modal-sm">
      <div class="modal-content">
         <div class="modal-header">
            <h4 class="modal-title">Hubungkan Perangkat</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <form action="<?= base_url('member/mydevice'); ?>" method="post">
            <div class="modal-body">
               <div class="form-group">
                  <input class="form-control rounded-pill" type="text" name="id" id="id" placeholder="Masukkan ID Perangkat..." required>
               </div>
            </div>
            <div class="modal-footer justify-content-between">
               <button type="button" class="btn btn-default rounded-pill" data-dismiss="modal">Batal</button>
               <button type="submit" class="btn btn-success rounded-pill">Hubungkan</button>
            </div>
         </form>
      </div>
      <!-- /.modal-content -->
   </div>
   <!-- /.modal-dialog -->
</div>
<!-- /.modal -->