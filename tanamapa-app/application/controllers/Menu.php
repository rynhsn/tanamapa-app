<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu extends CI_Controller
{
   public function __construct()
   {
      parent::__construct();
      $this->load->model('M_menu', 'menu');
      is_logged_in();
   }

   public function index()
   {
      $data['title'] = 'Manajemen Menu';
      $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();

      $data['menus'] = $this->menu->getMenu();

      $this->form_validation->set_rules('menu', 'Menu', 'required|trim');

      if ($this->form_validation->run() == false) {
         $this->load->view('layouts/header', $data);
         $this->load->view('layouts/navbar', $data);
         $this->load->view('layouts/sidebar', $data);
         $this->load->view('menu/index', $data);
         $this->load->view('layouts/footer');
      } else {
         $menu = htmlspecialchars($this->input->post('menu'));
         $this->db->insert('user_menu', ['menu' => $menu]);

         $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><small>Menu baru telah ditambahkan!</small></div>');
         redirect('menu');
      }
   }

   public function update()
   {
      $id = htmlspecialchars($this->input->post('id'));
      $menu = htmlspecialchars($this->input->post('menu'));

      $this->db->update('user_menu', ['menu' => $menu], ['id' => $id]);

      $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><small>Menu berhasil diubah!</small></div>');
      redirect('menu');
   }

   public function delete($id)
   {
      $this->db->delete('user_menu', ['id' => $id]);
      $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><small>Menu berhasil dihapus!</small></div>');
      redirect('menu');
   }

   public function submenu()
   {
      $data['title'] = 'Manajemen Sub Menu';
      $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();

      $data['submenus'] = $this->menu->getSubMenu();
      $data['menus'] = $this->menu->getMenu();

      $this->form_validation->set_rules('title', 'Title', 'required|trim');
      $this->form_validation->set_rules('menu_id', 'Menu', 'required|trim');
      $this->form_validation->set_rules('url', 'Link', 'required|trim');
      $this->form_validation->set_rules('icon', 'Icon', 'required|trim');


      if ($this->form_validation->run() == false) {
         $this->load->view('layouts/header', $data);
         $this->load->view('layouts/navbar', $data);
         $this->load->view('layouts/sidebar', $data);
         $this->load->view('menu/submenu', $data);
         $this->load->view('layouts/footer');
      } else {
         $data = [
            'title' => htmlspecialchars($this->input->post('title')),
            'menu_id' => htmlspecialchars($this->input->post('menu_id')),
            'url' => htmlspecialchars($this->input->post('url')),
            'icon' => htmlspecialchars($this->input->post('icon')),
            'is_active' => htmlspecialchars($this->input->post('is_active'))
         ];

         $this->db->insert('user_sub_menu', $data);

         $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><small>Sub menu baru telah ditambahkan!</small></div>');
         redirect('menu/submenu');
      }
   }

   public function updatesub()
   {
      $id = $this->input->post('id');
      $data = [
         'title' => htmlspecialchars($this->input->post('title')),
         'menu_id' => htmlspecialchars($this->input->post('menu_id')),
         'url' => htmlspecialchars($this->input->post('url')),
         'icon' => htmlspecialchars($this->input->post('icon')),
         'is_active' => htmlspecialchars($this->input->post('is_active'))
      ];

      $this->db->update('user_sub_menu', $data, ['id' => $id]);

      $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><small>Sub menu berhasil diubah!</small></div>');
      redirect('menu/submenu');
   }

   public function deletesub($id)
   {
      $this->db->delete('user_sub_menu', ['id' => $id]);
      $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><small>Sub menu berhasil dihapus!</small></div>');
      redirect('menu/submenu');
   }
}
