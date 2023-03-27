<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_menu extends CI_Model
{
   public function getMenu()
   {
      $query = $this->db->get('user_menu')->result_array();
      return $query;
   }

   public function getSubMenu()
   {
      $this->db->select(['user_sub_menu.*', 'user_menu.menu'])
         ->from('user_sub_menu')
         ->join('user_menu', 'user_sub_menu.menu_id = user_menu.id');
      $query = $this->db->get()->result_array();
      return $query;
   }
}
