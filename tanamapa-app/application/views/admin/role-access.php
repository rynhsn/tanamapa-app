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

      <!-- pesan berhasil -->
      <?= $this->session->flashdata('message'); ?>
      <div class="card">
         <div class="card-header">
            <div class="card-title">
               Role : <?= $role['role']; ?>
            </div>
         </div>
         <div class="card-body table-responsive p-0">
            <table class="table table-hover text-nowrap">
               <thead>
                  <tr>
                     <th style="width: 10px">#</th>
                     <th>Menu</th>
                     <th class="text-center">Akses</th>
                  </tr>
               </thead>
               <tbody>
                  <?php $i = 1; ?>
                  <?php foreach ($menus as $menu) : ?>
                     <tr>
                        <td><?= $i; ?></td>
                        <td><?= $menu['menu']; ?></td>
                        <td class="text-center">
                           <div class="form-check">
                              <input type="checkbox" class="form-check-input akses" id="akses" <?= check_access($role['id'], $menu['id']); ?> data-role="<?= $role['id']; ?>" data-menu="<?= $menu['id']; ?>">
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

<button class="btn btn-success btn-lg rounded-circle elevation-2" style="position: fixed;right: 20px; bottom: 80px; z-index: 999; width:70px; height:70px" onClick="history.back();">
   <i class="fas fa-angle-left fa-lg"></i>
</button>