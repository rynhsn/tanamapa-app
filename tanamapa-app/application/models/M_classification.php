<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_Classification extends CI_Model
{
   public function get()
   {
      $this->db->order_by('plant_name', 'ASC');
      $query = $this->db->get('classification')->result_array();
      return $query;
   }

   public function getById($id)
   {
      return $this->db->get_where('classification', ['id' => $id])->row_array();
   }

   public function add($data)
   {
      return $this->db->insert('classification', $data);
   }

   public function update($data, $id)
   {
      return $this->db->update('classification', $data, ['id' => $id]);
   }

   public function delete($id)
   {
      return $this->db->delete('classification', ['id' => $id]);
   }
}
