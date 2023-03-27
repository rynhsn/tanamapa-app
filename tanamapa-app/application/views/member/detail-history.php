<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <div class="container-fluid">
         <div class="row mb-2">
            <div class="col-sm">
               <h1 class="text-center"><?= $title; ?></h1>
            </div>
         </div>
      </div><!-- /.container-fluid -->
   </section>

   <!-- Main content -->
   <section class="content">

      <div class="container-fluid">
         <div class="row justify-content-center">
            <div class="col-11">
               <div class="row">
                  <div class="col-sm-6">
                     <div class="form-group">
                        <label for="device_id"><code><i class="fas fa-fingerprint mr-1"></i></code> ID Perangkat</label>
                        <input type="text" class="form-control bg-transparent border-0" id="device_id" name="device_id" value="<?= $history['device_id']; ?>" readonly>
                     </div>
                  </div>
                  <div class="col-sm-6">
                     <div class="form-group">
                        <label for="id"><code><i class="fas fa-toggle-on mr-1"></i></code> ID Seleksi</label>
                        <div class="input-group">
                           <input type="text" class="form-control bg-transparent border-0" id="id" name="id" value="<?= $history['id']; ?>" readonly>
                        </div>
                     </div>
                  </div>
               </div>
               <hr>
               <div id="resource">
                  <div class="row">
                     <div class="col-sm-3">
                        <strong><code><i class="fas fa-map-marker-alt mr-1"></i></code> Posisi </strong>
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
                              <input type="text" class="form-control bg-transparent border-0" id="lat" name="lat" value="<?= $history['lat']; ?>" readonly>
                           </div>
                           <label for="lon" class="col-5 col-form-label">Bujur</label>
                           <div class="col-7">
                              <input type="text" class="form-control bg-transparent border-0" id="lon" name="lon" value="<?= $history['lng']; ?>" readonly>
                           </div>
                           <label for="place" class="col-5 col-form-label">Kab/Kota</label>
                           <div class="col-7">
                              <input type="text" class="form-control bg-transparent border-0" id="place" name="place" value="<?= $history['place_name']; ?>" readonly>
                           </div>
                           <label for="place_name" class="col-5 col-form-label">Lokasi</label>
                           <div class="col-7">
                              <textarea class="form-control bg-transparent border-0" name="place_name" id="place_name" rows="3" readonly></textarea>
                           </div>
                        </div>
                     </div>
                  </div>
                  <hr>
                  <div class="row">
                     <div class="col-sm-3">
                        <strong><code><i class="fas fa-temperature-low mr-1"></i></code> Kondisi Lahan</strong>
                     </div>
                  </div>
                  <div class="row mt-3">
                     <div class="col-sm-6">
                        <div class="form-group row text-muted">
                           <label for="ph" class="col-6 col-form-label">Nilai pH</label>
                           <div class="col-6">
                              <input type="text" class="form-control bg-transparent border-0" id="ph" name="ph" value="<?= $history['ph']; ?>" readonly>
                           </div>
                           <label for="humidity" class="col-6 col-form-label">Kelembaban Udara (%)</label>
                           <div class="col-6">
                              <input type="text" class="form-control bg-transparent border-0" id="humidity" name="humidity" value="<?= $history['humidity']; ?>" readonly>
                           </div>
                           <label for="ele" class="col-6 col-form-label">Ketinggian (mdpl)</label>
                           <div class="col-6">
                              <input type="text" class="form-control bg-transparent border-0" id="ele" name="ele" value="<?= $history['elevation']; ?>" readonly>
                           </div>
                        </div>
                     </div>
                     <div class="col-sm-6">
                        <div class="form-group row text-muted">
                           <label for="rainfall" class="col-6 col-form-label">Curah Hujan (mm/th)</label>
                           <div class="col-6">
                              <input type="text" class="form-control bg-transparent border-0" id="rainfall" name="rainfall" value="<?= $history['rainfall']; ?>" readonly>
                           </div>
                           <label for="average_temp" class="col-6 col-form-label">Suhu Rata-rata (&deg;C/th)</label>
                           <div class="col-6">
                              <input type="text" class="form-control bg-transparent border-0" id="average_temp" name="average_temp" value="<?= $history['average_temp']; ?>" readonly>
                           </div>
                        </div>
                     </div>
                  </div>
                  <hr>
                  <!-- DONUT CHART -->
                  <div id="recomendation" class="mb-5" hidden>
                     <div class="row">
                        <div class="col-sm-3">
                           <strong><code><i class="far fa-thumbs-up mr-1"></i></code> Rekomendasi</strong>
                        </div>
                     </div>
                     <canvas id="donutChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                     <div class="card-body table-responsive p-0 mt-3 mb-3" style="height: 300px;">
                        <table class="table table-head-fixed text-nowrap">
                           <thead>
                              <tr>
                                 <th style="width: 10px">#</th>
                                 <th>Tanaman Buah</th>
                                 <th class='text-center'>Kesesuaian</th>
                                 <th class='text-center'>Jarak Euclidean</th>
                                 <th class='text-center'>Suhu Rata-rata</th>
                                 <th class='text-center'>Curah Hujan</th>
                                 <th class='text-center'>Kelembaban</th>
                                 <th class='text-center'>pH</th>
                                 <th class='text-center'>Ketinggian</th>
                              </tr>
                           </thead>
                           <tbody id="plant">
                           </tbody>
                        </table>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </section>
   <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<!-- kirim data -->
<button class="btn btn-success btn-lg rounded-circle elevation-2 p-4" id="readyForSelection" style="position: fixed;right: 20px; bottom: 80px; z-index: 999;" title="Seleksi">
   <i class="fas fa-square-root-alt fa-lg"></i>
</button>

<button class="btn btn-success btn-lg rounded-circle elevation-2" id="kembali" style="position: fixed;right: 20px; bottom: 80px; z-index: 999; width:70px; height:70px; display:none;" onClick="history.back();">
   <i class="fas fa-angle-left fa-lg"></i>
</button>
<!-- batas tombol -->