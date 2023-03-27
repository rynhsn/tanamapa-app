<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_climate extends CI_Model
{
   public function get()
   {
      $query = $this->db->get('climate')->result_array();
      return $query;
   }

   public function add($data)
   {
      return $this->db->insert('climate', $data);
   }

   public function update($data, $id)
   {
      return $this->db->update('climate', $data, ['id' => $id]);
   }

   public function delete($id)
   {
      return $this->db->delete('climate', ['id' => $id]);
   }
}
