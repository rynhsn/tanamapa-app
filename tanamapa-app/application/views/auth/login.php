<body class="hold-transition login-page">
   <div class="login-box">
      <div class="login-logo">
         <a href="<?= base_url(); ?>">
            <img src="<?= base_url(); ?>assets/dist/img/logo.svg" alt="tanamapa">
         </a>
      </div>
      <!-- /.login-logo -->
      <div class="card">
         <div class="card-body login-card-body">
            <p class="login-box-msg">Masuk</p>

            <?= $this->session->flashdata('message'); ?>

            <form action="<?= base_url(); ?>auth" method="post">

               <div class="form-group">
                  <input type="text" class="form-control mb-2 rounded-pill" id="email" name="email" placeholder="Email" value="<?= set_value('email'); ?>">
                  <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
               </div>
               <div class="form-group">
                  <input type="password" class="form-control mb-2 rounded-pill" id="password" name="password" placeholder="Password">
                  <?= form_error('password', '<small class="text-danger pl-3">', '</small>'); ?>
               </div>
               <button type="submit" class="btn btn-success rounded-pill btn-block">Masuk</button>
            </form>
            <hr>
            <!-- <div class="text-center">
               <small>
                  <a href="forgot-password.html">Lupa password?</a>
               </small>
            </div> -->
            <div class="text-center text-muted">
               <small>
                  Belum punya akun?
                  <a href="<?= base_url(); ?>auth/register">Daftar</a>
               </small>
            </div>
         </div>
         <!-- /.login-card-body -->
      </div>
   </div>
   <!-- /.login-box -->