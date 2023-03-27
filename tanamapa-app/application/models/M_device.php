<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_device extends CI_Model
{
   public function get()
   {
      return $this->db->get('devices');
   }

   public function getById($id)
   {
      return $this->db->get_where('devices', ['id' => $id])->row_array();
   }

   // public function getLoc($id)
   // {
   // }
}
