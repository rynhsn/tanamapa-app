<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_users extends CI_Model
{
   public function get()
   {
      return $this->db->get('users')->result_array();
   }

   public function edit($data, $id)
   {
      return $this->db->update('users', $data, ['id' => $id]);
   }

   public function delete($email)
   {
      return $this->db->delete('users', ['email' => $email]);
   }

   public function changepass($password, $email)
   {
      return $this->db->update('users', ['password' => $password], ['email' => $email]);
   }
}
