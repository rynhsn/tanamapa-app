<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_measurement extends CI_Model
{
   public function get()
   {
      $this->db->order_by('timestamp', 'ASC');
      $query = $this->db->get('measurement_history')->result_array();
      return $query;
   }

   public function getById($id)
   {
      return $this->db->get_where('measurement_history', ['id' => $id])->row_array();
   }

   public function getByUser($id)
   {
      return $this->db->get_where('measurement_history', ['user_id' => $id])->result_array();
   }

   public function add($data)
   {
      return $this->db->insert('measurement_history', $data);
   }

   public function delete($id)
   {
      return $this->db->delete('measurement_history', ['id' => $id]);
   }
}
