<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <div class="container-fluid">
         <div class="row mb-2">
            <div class="col-sm-6">
               <h1>Manajemen Sub Menu</h1>
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
                              <th>Sub Menu</th>
                              <th>Menu</th>
                              <th>Link</th>
                              <th class="text-center">Icon</th>
                              <th class="text-center">Status</th>
                              <th class="text-center">Kontrol</th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php $i = 1; ?>
                           <?php foreach ($submenus as $submenu) : ?>
                              <tr>
                                 <td><?= $i; ?></td>
                                 <td><?= $submenu['title']; ?></td>
                                 <td><?= $submenu['menu']; ?></td>
                                 <td><?= $submenu['url']; ?></td>
                                 <td class="text-center"><i class="<?= $submenu['icon']; ?> text-success"></i></td>
                                 <td class="text-center">
                                    <i class="fas fa-fw fa-circle <?= ($submenu['is_active'] ? 'text-success' : 'text-danger'); ?>"></i>
                                 </td>
                                 <td class="text-center">
                                    <div class="btn-group">
                                       <button class="btn btn-info" style="border-radius:50px 0 0 50px" data-toggle="modal" data-target="#updateSubMenuModal<?= $submenu['id']; ?>"><i class="fas fa-fw fa-pen"></i></button>
                                       <a class="btn btn-danger" style="border-radius:0 50px 50px 0" href="<?= base_url('menu/deletesub/' . $submenu['id']); ?>" onclick="return confirm('Yakin? data yang dihapus tidak dapat dikembalikan.')"><i class="fas fa-fw fa-trash-alt"></i></a>
                                    </div>
                                 </td>
                              </tr>
                              <?php $i++; ?>
                           <?php endforeach; ?>
                        </tbody>
                     </table>
                  </div>
               </div>
            </div>
            <!-- /.card-body -->
         </div>
         <!-- /.card -->
      </div>
   </section>
   <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<button class="btn btn-success btn-lg rounded-circle elevation-2" style="position: fixed;right: 20px; bottom: 80px; z-index: 999;" height="50%" data-toggle="modal" data-target="#newSubMenuModal">
   <i class="fas fa-plus fa-lg py-3 px-2"></i>
</button>

<!-- Add Modal -->
<div class="modal fade" id="newSubMenuModal">
   <div class="modal-dialog modal-sm">
      <div class="modal-content">
         <div class="modal-header">
            <h4 class="modal-title">Tambah Sub Menu</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <form action="<?= base_url('menu/submenu'); ?>" method="post">
            <div class="modal-body">
               <div class="form-group">
                  <input class="form-control rounded-pill" type="text" name="title" id="title" placeholder="Masukkan nama sub menu...">
               </div>
               <div class="form-group">
                  <select class="form-control rounded-pill" name="menu_id" id="menu_id">
                     <option value="" disabled>Pilih Menu</option>
                     <?php foreach ($menus as $menu) : ?>
                        <option value="<?= $menu['id']; ?>"><?= $menu['menu']; ?></option>
                     <?php endforeach; ?>
                  </select>
               </div>
               <div class="form-group">
                  <input class="form-control rounded-pill" type="text" name="url" id="url" placeholder="Link sub menu">
               </div>
               <div class="form-group">
                  <input class="form-control rounded-pill" type="text" name="icon" id="icon" placeholder="Icon sub menu dari fontawesome">
               </div>
               <div class="form-group pl-2">
                  <div class="form-check">
                     <input class="form-check-input" name="is_active" id="is_active" value="1" type="checkbox" checked>
                     <label class="form-check-label">Aktif?</label>
                  </div>
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
<?php foreach ($submenus as $submenu) : ?>
   <div class="modal fade" id="updateSubMenuModal<?= $submenu['id']; ?>">
      <div class="modal-dialog modal-sm">
         <div class="modal-content">
            <div class="modal-header">
               <h4 class="modal-title">Ubah Menu</h4>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <form action="<?= base_url('menu/updatesub'); ?>" method="post">
               <div class="modal-body">
                  <div class="form-group">
                     <input class="form-control rounded-pill" type="text" name="id" id="id" value="<?= $submenu['id']; ?>" placeholder="Masukkan nama menu..." hidden readonly>
                  </div>
                  <div class="form-group">
                     <input class="form-control rounded-pill" type="text" name="title" id="title" value="<?= $submenu['title']; ?>" placeholder="Masukkan nama sub menu..." required>
                  </div>
                  <div class="form-group">
                     <select class="form-control rounded-pill" name="menu_id" id="menu_id">
                        <option value="" disabled>Pilih Menu</option>
                        <?php foreach ($menus as $menu) : ?>
                           <option value="<?= $menu['id']; ?>" <?= ($submenu['menu_id'] == $menu['id'] ? 'selected' : ''); ?>><?= $menu['menu']; ?></option>
                        <?php endforeach; ?>
                     </select>
                  </div>
                  <div class="form-group">
                     <input class="form-control rounded-pill" type="text" name="url" id="url" value="<?= $submenu['url']; ?>" placeholder="Link sub menu" required>
                  </div>
                  <div class="form-group">
                     <input class="form-control rounded-pill" type="text" name="icon" id="icon" value="<?= $submenu['icon']; ?>" placeholder="Icon sub menu dari fontawesome" required>
                  </div>
                  <div class="form-group pl-2">
                     <div class="form-check">
                        <input class="form-check-input" name="is_active" id="is_active" value="1" type="checkbox" <?= ($submenu['is_active'] == '1' ? 'checked' : ''); ?>>
                        <label class="form-check-label">Aktif?</label>
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