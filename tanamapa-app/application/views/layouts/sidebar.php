<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-light-success elevation-2">
   <!-- Brand Logo -->
   <a href="<?= base_url(); ?>" class="brand-link">
      <img src="<?= base_url(); ?>assets/dist/img/logo-icon.svg" class="brand-image" alt=" tanamapa" width="10%">
      <span class="brand-text font-weight-light">
         <img src="<?= base_url(); ?>assets/dist/img/logo-text.svg" alt="tanamapa" width="70%">
      </span>
   </a>

   <!-- Sidebar -->
   <div class="sidebar">

      <!-- Sidebar Menu -->
      <nav class="mt-2">
         <ul class="nav nav-pills nav-sidebar flex-column nav-flat" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

            <!-- MENYIAPKAN MENU -->
            <?php
            $role_id = $this->session->userdata('role_id');
            $this->db->select(['user_menu.id', 'menu'])
               ->from('user_menu')
               ->join('user_access_menu', 'user_menu.id = user_access_menu.menu_id')
               ->where('user_access_menu.role_id', $role_id)
               ->order_by('user_access_menu.menu_id', 'ASC');
            $menus = $this->db->get()->result_array();
            ?>

            <!-- LOOPING MENU -->
            <?php foreach ($menus as $menu) : ?>
               <li class="nav-header"><?= $menu['menu']; ?></li>

               <!-- SIAPKAN SUB MENU -->
               <?php
               $menu_id = $menu['id'];
               $this->db->select('*')
                  ->from('user_sub_menu')
                  ->where('menu_id', $menu_id)
                  ->where('is_active', 1);
               $sub_menus = $this->db->get()->result_array();
               ?>

               <?php foreach ($sub_menus as $sub_menu) : ?>
                  <li class="nav-item">
                     <a href="<?= base_url($sub_menu['url']); ?>" class="nav-link <?= ($title == $sub_menu['title']) ? 'active' : ''; ?>">
                        <i class="nav-icon <?= $sub_menu['icon']; ?>"></i>
                        <p>
                           <?= $sub_menu['title']; ?>
                        </p>
                     </a>
                  </li>
               <?php endforeach; ?>

            <?php endforeach; ?>

         </ul>
      </nav>
      <!-- /.sidebar-menu -->
   </div>
   <!-- /.sidebar -->
</aside>