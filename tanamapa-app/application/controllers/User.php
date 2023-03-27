<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
   public function __construct()
   {
      parent::__construct();
      if (!$this->session->userdata('email')) redirect('auth');
   }

   public function index()
   {
      $data['title'] = 'Tanamapa - Profile';
      $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();

      $this->load->view('layouts/header', $data);
      $this->load->view('layouts/navbar', $data);
      $this->load->view('layouts/sidebar', $data);
      $this->load->view('user/index', $data);
      $this->load->view('layouts/footer');
   }

   public function edit()
   {
      $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();

      $this->form_validation->set_rules('name', 'Nama Lengkap', 'trim|required');

      if ($this->form_validation->run() == false) {
         $this->session->set_flashdata('set_profile_failed', 1);
         $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><small>' . form_error('name') . '</small></div>');
         redirect('user');
      } else {
         $email = $this->input->post('email');
         $name = htmlspecialchars($this->input->post('name'));

         // Cek jika ada gambar yang akan diupload
         $upload_image = $_FILES['image']['name'];

         if ($upload_image) {
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = '2048';
            $config['upload_path'] = './assets/dist/img/';

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('image')) {
               $old_image = $data['user']['image'];
               if ($old_image != 'default.webp') {
                  unlink(FCPATH . 'assets/dist/img/' . $old_image);
               }
               $new_image = $this->upload->data('file_name');
               $this->db->set('image', $new_image);
            } else {
               echo $this->upload->display_errors();
            }
         }

         $this->db->set('name', $name);
         $this->db->where('email', $email);
         $this->db->update('users');

         $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><small>Data berhasil diubah!</small></div>');
         redirect('user');
      }
   }

   public function changepass()
   {
      $data['title'] = 'Tanamapa - Profile';
      $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();

      $this->form_validation->set_rules('current_pass', 'Password lama', 'trim|required');
      $this->form_validation->set_rules('new_pass1', 'Password baru', 'trim|required|min_length[3]|matches[new_pass2]');
      $this->form_validation->set_rules('new_pass2', 'Ulangi password', 'trim|required|matches[new_pass1]');

      if ($this->form_validation->run() == false) {
         $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><small>Password gagal diubah! Silahkan coba kembali.</small></div>');
         $this->load->view('layouts/header', $data);
         $this->load->view('layouts/navbar', $data);
         $this->load->view('layouts/sidebar', $data);
         $this->load->view('user/index', $data);
         $this->load->view('layouts/footer');
      } else {
         $current_pass = $this->input->post('current_pass');
         $new_pass = $this->input->post('new_pass1');

         if (!password_verify($current_pass, $data['user']['password'])) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><small>Password salah!</small></div>');
            redirect('user');
         } else {
            if ($current_pass == $new_pass) {
               $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><small>Password tidak boleh sama dengan password sebelumnya!</small></div>');
               redirect('user');
            } else {
               $password_hash = password_hash($new_pass, PASSWORD_DEFAULT);

               $this->db->set('password', $password_hash);
               $this->db->where('email', $data['user']['email']);
               $this->db->update('users');

               $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><small>Password berhasil diubah!</small></div>');
               redirect('user');
            }
         }
      }
   }
}
