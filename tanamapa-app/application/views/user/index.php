<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <div class="container-fluid">
         <div class="row mb-2">
            <div class="col-sm-6">
               <h1>Profile</h1>
            </div>
         </div>
      </div><!-- /.container-fluid -->
   </section>

   <!-- Main content -->
   <section class="content">
      <div class="container-fluid">
         <div class="row">
            <div class="col-md-12">

               <?= $this->session->flashdata('message'); ?>

               <div class="card card-success card-outline">
                  <div class="card-body">
                     <ul class="nav nav-tabs" id="custom-content-below-tab" role="tablist">
                        <li class="nav-item">
                           <a class="nav-link text-success <?= (!$this->session->flashdata('set_profile_failed') ? 'active' : ''); ?>" id="custom-content-below-profile-tab" data-toggle="pill" href="#custom-content-below-profile" role="tab" aria-controls="custom-content-below-profile" aria-selected="false">
                              <i class="fas fa-fw fa-user"></i>
                           </a>
                        </li>
                        <li class="nav-item">
                           <a class="nav-link text-success <?= ($this->session->flashdata('set_profile_failed') ? 'active' : ''); ?>" id="custom-content-below-settings-tab" data-toggle="pill" href="#custom-content-below-settings" role="tab" aria-controls="custom-content-below-settings" aria-selected="false">
                              <i class="fas fa-fw fa-tools"></i>
                           </a>
                        </li>
                        <li class="nav-item">
                           <a class="nav-link text-success" id="custom-content-below-change-password-tab" data-toggle="pill" href="#custom-content-below-change-password" role="tab" aria-controls="custom-content-below-change-password" aria-selected="false"> <i class="fas fa-fw fa-unlock-alt"></i>
                           </a>
                        </li>
                     </ul>
                     <div class="tab-content" id="custom-content-below-tabContent">
                        <div class="tab-pane fade <?= (!$this->session->flashdata('set_profile_failed') ? 'active show' : ''); ?> mt-3" id="custom-content-below-profile" role="tabpanel" aria-labelledby="custom-content-below-profile-tab">
                           <div class="text-center">
                              <img class="profile-user-img img-fluid img-circle" src="<?= base_url('assets/dist/img/' . $user['image']); ?>" alt="User profile picture" style="height:150px;width: 150px;">
                           </div>

                           <h3 class="profile-username text-center"><?= $user['name']; ?></h3>

                           <p class="text-muted text-center">Pekerjaan</p>

                           <ul class="list-group list-group-unbordered mb-3">
                              <li class="list-group-item">
                                 <b>Email</b>
                                 <p class="text-muted">
                                    <?= $user['email']; ?>
                                 </p>
                              </li>
                              <li class="list-group-item">
                                 <b>Bergabung</b>
                                 <p class="text-muted">
                                    <?= date('d F Y', $user['date_created']); ?>
                                 </p>
                              </li>
                           </ul>
                        </div>
                        <div class="tab-pane fade mt-3 <?= ($this->session->flashdata('set_profile_failed') ? 'active show' : ''); ?>" id="custom-content-below-settings" role="tabpanel" aria-labelledby="custom-content-below-settings-tab">
                           <!-- <form class="form-horizontal"> -->
                           <?= form_open_multipart('user/edit'); ?>
                           <div class="form-group row">
                              <label for="email" class="col-sm-2 col-form-label">Email</label>
                              <div class="col-sm-10">
                                 <input type="email" class="form-control rounded-pill" id="email" name="email" placeholder="Email" value="<?= $user['email']; ?>" readonly>
                              </div>
                           </div>
                           <div class="form-group row">
                              <label for="name" class="col-sm-2 col-form-label">Nama Lengkap</label>
                              <div class="col-sm-10">
                                 <input type="text" class="form-control rounded-pill" id="name" name="name" placeholder="Nama lengkap" value="<?= $user['name']; ?>">
                              </div>
                           </div>
                           <div class="form-group row">
                              <label for="image" class="col-sm-2 col-form-label">Foto</label>
                              <div class="col-sm-10">
                                 <div class="row">
                                    <div class="col-sm-2">
                                       <img src="<?= base_url('assets/dist/img/') . $user['image']; ?>" alt="" class="img-thumbnail" width="100px">
                                    </div>
                                    <div class="input-group col-sm-10 mt-2">
                                       <div class="custom-file">
                                          <input type="file" class="custom-file-input" id="image" name="image">
                                          <label class="custom-file-label" for="image">Choose file</label>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="form-group row">
                              <div class="offset-sm-2 col-sm-10">
                                 <button type="submit" class="btn btn-success rounded-pill">Simpan</button>
                              </div>
                           </div>
                           </form>
                        </div>
                        <div class="tab-pane fade mt-3" id="custom-content-below-change-password" role="tabpanel" aria-labelledby="custom-content-below-change-password-tab">
                           <form class="form-horizontal" action="<?= base_url('user/changepass'); ?>" method="post">
                              <div class="form-group row">
                                 <label for="current_pass" class="col-sm-2 col-form-label">Password lama</label>
                                 <div class="col-sm-10">
                                    <input type="password" class="form-control rounded-pill" id="current_pass" name="current_pass" placeholder="Password lama">
                                    <?= form_error('current_pass', '<small class="text-danger pl-3">', '</small>'); ?>
                                 </div>
                              </div>
                              <div class="form-group row">
                                 <label for="new-pass1" class="col-sm-2 col-form-label">Password baru</label>
                                 <div class="col-sm-10">
                                    <input type="password" class="form-control rounded-pill" name="new_pass1" id="new-pass1" placeholder="Masukkan password baru">
                                    <?= form_error('new_pass1', '<small class="text-danger pl-3">', '</small>'); ?>
                                 </div>
                              </div>
                              <div class="form-group row">
                                 <label for="new-pass2" class="col-sm-2 col-form-label">Ulangi Password</label>
                                 <div class="col-sm-10">
                                    <input type="password" class="form-control rounded-pill" name="new_pass2" id="new-pass2" placeholder="Masukkan kembali password baru"><?= form_error('new_pass2', '<small class="text-danger pl-3">', '</small>'); ?>
                                 </div>
                              </div>
                              <div class="form-group row">
                                 <div class="offset-sm-2 col-sm-10">
                                    <button type="submit" class="btn btn-success rounded-pill">Kirim</button>
                                 </div>
                              </div>
                           </form>
                        </div>
                     </div>
                  </div>
                  <!-- /.card -->
               </div>
            </div>
         </div>
      </div><!-- /.container-fluid -->
   </section>
   <!-- /.content -->
</div>