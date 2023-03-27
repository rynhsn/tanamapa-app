<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Iklim extends CI_Controller
{
   public function __construct()
   {
      parent::__construct();
      $this->load->model('M_climate', 'climate');
      is_logged_in();
   }

   public function index()
   {
      $data['title'] = 'Curah Hujan dan Suhu';
      $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();

      $data['climates'] = $this->climate->get();

      $this->form_validation->set_rules('place', 'Wilayah', 'required|trim|is_unique[climate.region]', [
         'is_unique' => 'Penyimpanan gagal, Wilayah telah terdaftar!'
      ]);
      $this->form_validation->set_rules('average_temp', 'Suhu Rata-rata', 'required|trim');
      $this->form_validation->set_rules('rainfall', 'Curah Hujan', 'required|trim');

      if ($this->form_validation->run() == false) {
         $this->load->view('layouts/header', $data);
         $this->load->view('layouts/navbar', $data);
         $this->load->view('layouts/sidebar', $data);
         $this->load->view('climate/index', $data);
         $this->load->view('layouts/footer');
      } else {
         $value = [
            'region' => htmlspecialchars($this->input->post('place')),
            'average_temp' => htmlspecialchars($this->input->post('average_temp')),
            'rainfall' => htmlspecialchars($this->input->post('rainfall'))
         ];

         $this->climate->add($value);

         $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><small>Wilayah baru telah ditambahkan!</small></div>');
         redirect('iklim');
      }
   }

   public function update()
   {
      $id = htmlspecialchars($this->input->post('id'));

      $value = [
         'region' => htmlspecialchars($this->input->post('place')),
         'average_temp' => htmlspecialchars($this->input->post('average_temp')),
         'rainfall' => htmlspecialchars($this->input->post('rainfall'))
      ];

      $this->climate->update($value, $id);

      $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><small>Menu berhasil diubah!</small></div>');
      redirect('iklim');
   }

   public function delete($id)
   {
      $this->climate->delete($id);
      $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><small>Menu berhasil dihapus!</small></div>');
      redirect('iklim');
   }
}
