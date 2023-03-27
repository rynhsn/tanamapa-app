<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
   <!-- Left navbar links -->
   <ul class="navbar-nav">
      <li class="nav-item">
         <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
         <a href="<?= base_url(); ?>" class="nav-link">Home</a>
      </li>
   </ul>
   <!-- Right navbar links -->
   <ul class="navbar-nav ml-auto">
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
         <a class="nav-link mb-2" data-toggle="dropdown" href="#">
            <img src="<?= base_url('assets/dist/img/' . $user['image']); ?>" class="img-circle mr-2" width="32px" alt="User Image"> <?= $user['name']; ?>
         </a>
         <div class="dropdown-menu dropdown-menu-md dropdown-menu-right">
            <a href="<?= base_url(); ?>user" class="dropdown-item">
               <i class="fas fa-user mr-2 text-success"></i> Profile
            </a>
            <div class="dropdown-divider"></div>
            <a href="<?= base_url(); ?>auth/logout" class="dropdown-item">
               <i class="fas fa-sign-out-alt mr-2 text-danger"></i> Keluar
            </a>
         </div>
      </li>
   </ul>
</nav>
<!-- /.navbar -->