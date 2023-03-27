<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
   public function __construct()
   {
      parent::__construct();
      is_logged_in();
      $this->load->model('M_users', 'users');
   }

   public function index()
   {
      $data['title'] = 'Main Dashboard';
      $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();

      $this->load->view('layouts/header', $data);
      $this->load->view('layouts/navbar', $data);
      $this->load->view('layouts/sidebar', $data);
      $this->load->view('admin/index', $data);
      $this->load->view('layouts/footer');
   }

   public function role()
   {
      $data['title'] = 'Akses Pengguna';
      $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();

      $data['roles'] = $this->db->get('user_role')->result_array();

      $this->form_validation->set_rules('role', 'Role', 'required|trim');

      if ($this->form_validation->run() == false) {
         $this->load->view('layouts/header', $data);
         $this->load->view('layouts/navbar', $data);
         $this->load->view('layouts/sidebar', $data);
         $this->load->view('admin/role', $data);
         $this->load->view('layouts/footer');
      } else {
         $role = htmlspecialchars($this->input->post('role'));
         $this->db->insert('user_role', ['role' => $role]);

         $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><small>Menu baru telah ditambahkan!</small></div>');
         redirect('admin/role');
      }
   }

   public function updaterole()
   {
      $id = htmlspecialchars($this->input->post('id'));
      $role = htmlspecialchars($this->input->post('role'));

      $this->db->update('user_role', ['role' => $role], ['id' => $id]);

      $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><small>Role berhasil diubah!</small></div>');
      redirect('admin/role');
   }

   public function deleterole($id)
   {
      $this->db->delete('user_role', ['id' => $id]);
      $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><small>Role berhasil dihapus!</small></div>');
      redirect('admin/role');
   }


   public function roleaccess($role_id)
   {
      $data['title'] = 'Akses Pengguna';
      $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();

      $data['role'] = $this->db->get_where('user_role', ['id' => $role_id])->row_array();
      $this->db->where('id !=', 1);
      $data['menus'] = $this->db->get('user_menu')->result_array();

      $this->load->view('layouts/header', $data);
      $this->load->view('layouts/navbar', $data);
      $this->load->view('layouts/sidebar', $data);
      $this->load->view('admin/role-access', $data);
      $this->load->view('layouts/footer');
   }

   public function changeaccess()
   {
      $menu_id = $this->input->post('menuid');
      $role_id = $this->input->post('roleid');

      $data = [
         'role_id' => $role_id,
         'menu_id' => $menu_id
      ];

      $result = $this->db->get_where('user_access_menu', $data);

      if ($result->num_rows() < 1) {
         $this->db->insert('user_access_menu', $data);
      } else {
         $this->db->delete('user_access_menu', $data);
      }

      $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><small>Akses berhasil diubah!</small></div>');
   }

   public function users()
   {
      $data['title'] = 'Kelola Pengguna';
      $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();

      $data['users'] = $this->users->get();
      $data['roles'] = $this->db->get('user_role')->result_array();


      $this->form_validation->set_rules('name', 'Nama Lengkap', 'trim|required');
      $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[users.email]', ['is_unique' => 'Email telah terdaftar.']);
      $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password2]');
      $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');

      if ($this->form_validation->run() == false) {
         $this->load->view('layouts/header', $data);
         $this->load->view('layouts/navbar', $data);
         $this->load->view('layouts/sidebar', $data);
         $this->load->view('admin/users', $data);
         $this->load->view('layouts/footer');
      } else {
         $data = [
            'name' => htmlspecialchars($this->input->post('name', true)),
            'email' => htmlspecialchars($this->input->post('email', true)),
            'image' => 'default.webp',
            'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
            'role_id' => $this->input->post('role_id', true),
            'is_active' => htmlspecialchars($this->input->post('is_active')),
            'date_created' => time()
         ];

         $this->db->insert('users', $data);
         $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
         <small>Pengguna berhasil ditambahkan.</small>
         </div>');

         redirect('admin/users');
      }
   }

   public function edituser()
   {
      $id = htmlspecialchars($this->input->post('id'));
      $data = [
         'name' => htmlspecialchars($this->input->post('name', true)),
         'email' => htmlspecialchars($this->input->post('email', true)),
         'role_id' => htmlspecialchars($this->input->post('role_id', true)),
         'is_active' => htmlspecialchars($this->input->post('is_active'))
      ];

      $this->users->edit($data, $id);

      $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><small>Data pengguna berhasil diubah!</small></div>');
      redirect('admin/users');
   }

   public function deleteuser($email)
   {
      $this->users->delete($email);
      $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><small>Pengguna berhasil dihapus!</small></div>');
      redirect('admin/users');
   }

   public function changepass()
   {
      $this->form_validation->set_rules('password1', 'Password lama', 'trim|required|min_length[3]|matches[password2]');
      $this->form_validation->set_rules('password2', 'Ulangi password', 'trim|required|matches[password1]');

      if ($this->form_validation->run() == false) {
         $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><small>Password gagal diubah! Silahkan coba kembali.</small></div>');
         redirect('admin/users');
      } else {
         $email = $this->input->post('email');
         $password = $this->input->post('password1');

         $password_hash = password_hash($password, PASSWORD_DEFAULT);

         $this->users->changepass($password_hash, $email);

         $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><small>Password berhasil diubah!</small></div>');
         redirect('admin/users');
      }
   }

   public function devices()
   {
      $data['title'] = 'Kelola Perangkat';
      $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();

      $data['devices'] = $this->db->get('devices')->result_array();

      $this->form_validation->set_rules('token', 'Token', 'required|trim');

      if ($this->form_validation->run() == false) {
         $this->load->view('layouts/header', $data);
         $this->load->view('layouts/navbar', $data);
         $this->load->view('layouts/sidebar', $data);
         $this->load->view('admin/devices', $data);
         $this->load->view('layouts/footer');
      } else {
         $data = [
            'id' => random_string('alnum', 7),
            'token' => $this->input->post('token')
         ];
         $this->db->insert('devices', $data);

         $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><small>Perangkat baru telah ditambahkan!</small></div>');
         redirect('admin/devices');
      }
   }

   public function updatedevice()
   {
      $data['devices'] = $this->db->get('devices')->result_array();

      $id = $this->input->post('id');
      $token = $this->input->post('token');
      $this->db->update('devices', ['token' => $token], ['id' => $id]);

      $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><small>Perangkat baru telah ditambahkan!</small></div>');
      redirect('admin/devices');
   }

   public function deletedevice($id)
   {
      $this->db->delete('devices', ['id' => $id]);
      $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><small>Perangkat telah dihapus!</small></div>');
      redirect('admin/devices');
   }
}
