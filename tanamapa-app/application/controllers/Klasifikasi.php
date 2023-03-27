<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Klasifikasi extends CI_Controller
{
   public function __construct()
   {
      parent::__construct();
      $this->load->model('M_classification', 'classification');
      is_logged_in();
   }

   public function index()
   {
      $data['title'] = 'Kesesuaian Lahan';
      $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();

      $data['classifications'] = $this->classification->get();

      $this->load->view('layouts/header', $data);
      $this->load->view('layouts/navbar', $data);
      $this->load->view('layouts/sidebar', $data);
      $this->load->view('classification/index', $data);
      $this->load->view('layouts/footer');
   }

   public function add()
   {
      $data['title'] = 'Kesesuaian Lahan';
      $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();

      $this->form_validation->set_rules('plant_name', 'Tanaman', 'required|trim|is_unique[classification.plant_name]', [
         'is_unique' => 'Tanaman telah terdaftar!'
      ]);
      $this->form_validation->set_rules('temp_min', 'Tanaman', 'required|trim');
      $this->form_validation->set_rules('temp_max', 'Tanaman', 'required|trim');
      $this->form_validation->set_rules('rf_min', 'Tanaman', 'required|trim');
      $this->form_validation->set_rules('rf_max', 'Tanaman', 'required|trim');
      $this->form_validation->set_rules('hmdt_min', 'Tanaman', 'required|trim');
      $this->form_validation->set_rules('hmdt_max', 'Tanaman', 'required|trim');
      $this->form_validation->set_rules('ph_min', 'Tanaman', 'required|trim');
      $this->form_validation->set_rules('ph_max', 'Tanaman', 'required|trim');
      $this->form_validation->set_rules('ele_min', 'Tanaman', 'required|trim');
      $this->form_validation->set_rules('ele_max', 'Tanaman', 'required|trim');

      if ($this->form_validation->run() == false) {
         $this->load->view('layouts/header', $data);
         $this->load->view('layouts/navbar', $data);
         $this->load->view('layouts/sidebar', $data);
         $this->load->view('classification/add', $data);
         $this->load->view('layouts/footer');
      } else {
         $value = [
            'plant_name' => htmlspecialchars($this->input->post('plant_name')),
            'temp_min' => htmlspecialchars($this->input->post('temp_min')),
            'temp_max' => htmlspecialchars($this->input->post('temp_max')),
            'rf_min' => htmlspecialchars($this->input->post('rf_min')),
            'rf_max' => htmlspecialchars($this->input->post('rf_max')),
            'hmdt_min' => htmlspecialchars($this->input->post('hmdt_min')),
            'hmdt_max' => htmlspecialchars($this->input->post('hmdt_max')),
            'ph_min' => htmlspecialchars($this->input->post('ph_min')),
            'ph_max' => htmlspecialchars($this->input->post('ph_max')),
            'ele_min' => htmlspecialchars($this->input->post('ele_min')),
            'ele_max' => htmlspecialchars($this->input->post('ele_max')),
         ];

         $this->classification->add($value);

         $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><small>Tanaman baru telah ditambahkan!</small></div>');
         redirect('klasifikasi');
      }
   }

   public function edit($id)
   {
      $data['title'] = 'Kesesuaian Lahan';
      $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
      $data['classification'] = $this->classification->getById($id);

      $this->form_validation->set_rules('plant_name', 'Tanaman', 'required|trim');
      $this->form_validation->set_rules('temp_min', 'Tanaman', 'required|trim');
      $this->form_validation->set_rules('temp_max', 'Tanaman', 'required|trim');
      $this->form_validation->set_rules('rf_min', 'Tanaman', 'required|trim');
      $this->form_validation->set_rules('rf_max', 'Tanaman', 'required|trim');
      $this->form_validation->set_rules('hmdt_min', 'Tanaman', 'required|trim');
      $this->form_validation->set_rules('hmdt_max', 'Tanaman', 'required|trim');
      $this->form_validation->set_rules('ph_min', 'Tanaman', 'required|trim');
      $this->form_validation->set_rules('ph_max', 'Tanaman', 'required|trim');
      $this->form_validation->set_rules('ele_min', 'Tanaman', 'required|trim');
      $this->form_validation->set_rules('ele_max', 'Tanaman', 'required|trim');

      if ($this->form_validation->run() == false) {
         $this->load->view('layouts/header', $data);
         $this->load->view('layouts/navbar', $data);
         $this->load->view('layouts/sidebar', $data);
         $this->load->view('classification/edit', $data);
         $this->load->view('layouts/footer');
      } else {
         $value = [
            'plant_name' => htmlspecialchars($this->input->post('plant_name')),
            'temp_min' => htmlspecialchars($this->input->post('temp_min')),
            'temp_max' => htmlspecialchars($this->input->post('temp_max')),
            'rf_min' => htmlspecialchars($this->input->post('rf_min')),
            'rf_max' => htmlspecialchars($this->input->post('rf_max')),
            'hmdt_min' => htmlspecialchars($this->input->post('hmdt_min')),
            'hmdt_max' => htmlspecialchars($this->input->post('hmdt_max')),
            'ph_min' => htmlspecialchars($this->input->post('ph_min')),
            'ph_max' => htmlspecialchars($this->input->post('ph_max')),
            'ele_min' => htmlspecialchars($this->input->post('ele_min')),
            'ele_max' => htmlspecialchars($this->input->post('ele_max')),
         ];

         $this->classification->update($value, $id);

         $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><small>Tanaman berhasil diperbarui!</small></div>');
         redirect('klasifikasi');
      }
   }

   public function delete($id)
   {
      $this->classification->delete($id);
      $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><small>Tanaman berhasil dihapus!</small></div>');
      redirect('klasifikasi');
   }
}
