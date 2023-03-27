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

      <!-- pesan berhasil -->
      <?= $this->session->flashdata('message'); ?>
      <div class="card card-default">
         <div class="card-header">
            <h3 class="card-title">Ubah Klasifikasi Tanaman</h3>
         </div>
         <!-- /.card-header -->
         <form action="<?= base_url('klasifikasi/edit/' . $classification['id']); ?>" method="POST" class="form-horizontal">
            <div class="card-body">
               <div class="row">
                  <div class="col-sm-9">
                     <label for="plant_name" class="ml-2">Nama Tanaman Buah <code>*</code></label>
                     <div class="form-group row">
                        <div class="col-sm">
                           <input type="text" class="form-control rounded-pill" id="plant_name" name="plant_name" value="<?= $classification['plant_name']; ?>" placeholder="Masukkan nama tanaman buah...">
                           <?= form_error('plant_name', '<small class="text-danger pl-3">', '</small>'); ?>

                        </div>
                     </div>
                  </div>
                  <div class="col-sm-3">
                     <label class="ml-2">Suhu udara rata-rata (&deg;C/th)</label>
                     <div class="form-group row">
                        <div class="col-sm-6">
                           <input type="number" id="temp_min" name="temp_min" class="form-control rounded-pill" placeholder="Min" value="<?= $classification['temp_min']; ?>" required>
                        </div>
                     </div>
                     <div class="form-group row">
                        <div class="col-sm-6">
                           <input type="number" id="temp_max" name="temp_max" class="form-control rounded-pill" placeholder="Max" value="<?= $classification['temp_max']; ?>" required>
                        </div>
                     </div>
                  </div>
                  <div class="col-sm-3">
                     <label class="ml-2">Curah hujan (mm/th)</label>
                     <div class="form-group row">
                        <div class="col-sm-6">
                           <input type="number" id="rf_min" name="rf_min" class="form-control rounded-pill" placeholder="Min" value="<?= $classification['rf_min']; ?>" required>
                        </div>
                     </div>
                     <div class="form-group row">
                        <div class="col-sm-6">
                           <input type="number" id="rf_max" name="rf_max" class="form-control rounded-pill" placeholder="Max" value="<?= $classification['rf_max']; ?>" required>
                        </div>
                     </div>
                  </div>
                  <div class="col-sm-3">
                     <label class="ml-2">Kelembaban (%)</label>
                     <div class="form-group row">
                        <div class="col-sm-6">
                           <input type="number" id="hmdt_min" name="hmdt_min" class="form-control rounded-pill" placeholder="Min" value="<?= $classification['hmdt_min']; ?>" required>
                        </div>
                     </div>
                     <div class="form-group row">
                        <div class="col-sm-6">
                           <input type="number" id="hmdt_max" name="hmdt_max" class="form-control rounded-pill" placeholder="Max" value="<?= $classification['hmdt_max']; ?>" required>
                        </div>
                     </div>
                  </div>
                  <div class="col-sm-3">
                     <label class="ml-2">Nilai pH</label>
                     <div class="form-group row">
                        <div class="col-sm-6">
                           <input type="number" id="ph_min" name="ph_min" class="form-control rounded-pill" placeholder="Min" value="<?= $classification['ph_min']; ?>" required>
                        </div>
                     </div>
                     <div class="form-group row">
                        <div class="col-sm-6">
                           <input type="number" id="ph_max" name="ph_max" class="form-control rounded-pill" placeholder="Max" value="<?= $classification['ph_max']; ?>" required>
                        </div>
                     </div>
                  </div>
                  <div class="col-sm-3">
                     <label class="ml-2">Ketinggian tempat</label>
                     <div class="form-group row">
                        <div class="col-sm-6">
                           <input type="number" id="ele_min" name="ele_min" class="form-control rounded-pill" placeholder="Min" value="<?= $classification['ele_min']; ?>" required>
                        </div>
                     </div>
                     <div class="form-group row">
                        <div class="col-sm-6">
                           <input type="number" id="ele_max" name="ele_max" class="form-control rounded-pill" placeholder="Max" value="<?= $classification['ele_max']; ?>" required>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="card-footer">
               <button type="submit" class="btn btn-success rounded-pill float-right">Simpan</button>
               <button type="button" id="clear" class="btn btn-default rounded-pill float-right mr-2">Kosongkan</button>
            </div>
         </form>
      </div>
   </section>
   <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<button class="btn btn-info btn-lg rounded-circle elevation-2" style="position: fixed;right: 20px; bottom: 80px; z-index: 999; width:70px; height:70px" onClick="history.back();">
   <i class="fas fa-angle-left fa-lg"></i>
</button>