<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
   // public function __construct()
   // {
   //    parent::__construct();
   //    // $this->load->library('form_validation');
   // }

   public function index()
   {
      $this->_redirect($this->session->userdata('role_id'));

      $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
      $this->form_validation->set_rules('password', 'Password', 'trim|required');

      if ($this->form_validation->run() == 0) {
         $data['title'] = 'Tanamapa - Masuk';

         $this->load->view('layouts/auth_header', $data);
         $this->load->view('auth/login');
         $this->load->view('layouts/auth_footer');
      } else {
         // validasi
         // _ method private (diakalin)
         $this->_login();
      }
   }

   private function _redirect($role_id = 0)
   {
      if ($role_id == 1) {
         redirect('admin');
      } else if ($role_id > 1) {
         redirect('member');
      }
   }

   private function _login()
   {
      $email  = $this->input->post('email');
      $password  = $this->input->post('password');

      $user = $this->db->get_where('users', ['email' => $email])->row_array();

      if ($user) {

         if ($user['is_active'] == 1) {
            if (password_verify($password, $user['password'])) {
               $data = [
                  'email' => $user['email'],
                  'role_id' => $user['role_id']
               ];

               $this->session->set_userdata($data);
               $this->_redirect($user['role_id']);
            } else {
               $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
               <small>Password salah!</small>
               </div>');

               redirect('auth');
            }
         } else {

            $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <small>Email belum aktif!</small>
            </div>');

            redirect('auth');
         }
      } else {
         $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
         <small>Email belum terdaftar!</small>
         </div>');

         redirect('auth');
      }
   }

   public function register()
   {
      $this->_redirect($this->session->userdata('role_id'));

      $this->form_validation->set_rules('name', 'Nama lengkap', 'required|trim');
      $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[users.email]', [
         'is_unique' => 'Email telah terdaftar.'
      ]);
      $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password2]');
      $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');
      if ($this->form_validation->run() == false) {
         $data['title'] = 'Tanamapa - Buat akun';

         $this->load->view('layouts/auth_header', $data);
         $this->load->view('auth/register');
         $this->load->view('layouts/auth_footer');
      } else {
         $data = [
            'name' => htmlspecialchars($this->input->post('name', true)),
            'email' => htmlspecialchars($this->input->post('email', true)),
            'image' => 'default.webp',
            'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
            'role_id' => 2,
            'is_active' => 1,
            'date_created' => time()
         ];

         $this->db->insert('users', $data);
         $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
         <small>Selamat! akun berhasil dibuat.</small>
         </div>');

         redirect('auth');
      }
   }

   public function logout()
   {
      $this->session->unset_userdata('email');
      $this->session->unset_userdata('role_id');

      $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      <small>Anda berhasil keluar.</small>
      </div>');

      redirect('auth');
   }

   public function blocked()
   {
      $data['title'] = '404';
      $this->load->view('layouts/auth_header', $data);
      $this->load->view('auth/blocked');
      $this->load->view('layouts/auth_footer');
   }
}
