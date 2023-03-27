<body class="hold-transition register-page">
   <div class="register-box">
      <div class="register-logo">
         <a href="<?= base_url(); ?>index2.html">
            <img src="<?= base_url(); ?>assets/dist/img/logo.svg" alt="tanamapa">
         </a>
      </div>

      <div class="card">
         <div class="card-body register-card-body">
            <p class="login-box-msg">Buat akun baru</p>

            <form action="<?= base_url(); ?>auth/register" method="post">
               <div class="form-group">
                  <input type="text" class="form-control rounded-pill" id="name" name="name" placeholder="Nama lengkap"
                     value="<?= set_value('name'); ?>">
                  <?= form_error('name', '<small class="text-danger pl-3">', '</small>'); ?>
               </div>

               <div class="form-group">
                  <input type="text" class="form-control rounded-pill" id="email" name="email" placeholder="Email"
                     value="<?= set_value('email'); ?>">
                  <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
               </div>

               <div class="form-group">
                  <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                  <input type="password" class="form-control rounded-pill" id="password1" name="password1"
                     placeholder="Password">
               </div>

               <div class="form-group">
                  <input type="password" class="form-control rounded-pill mb-2" id="password2" name="password2"
                     placeholder="Ulangi password">
               </div>

               <button type="submit" class="btn btn-success btn-block rounded-pill">Daftar</button>
            </form>
            <hr>
            <div class="text-center text-muted">
               <small>
                  Sudah punya akun?
                  <a href="<?= base_url(); ?>auth" class="text-center">Masuk</a>
               </small>
            </div>
         </div>
         <!-- /.form-box -->
      </div><!-- /.card -->
   </div>
   <!-- /.register-box -->