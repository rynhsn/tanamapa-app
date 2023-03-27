<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Member extends CI_Controller
{
   public function __construct()
   {
      parent::__construct();
      is_logged_in();
   }

   public function index()
   {
      $data['title'] = 'Beranda';
      $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();

      $this->load->view('layouts/header', $data);
      $this->load->view('layouts/navbar', $data);
      $this->load->view('layouts/sidebar', $data);
      $this->load->view('member/index', $data);
      $this->load->view('layouts/footer');
   }

   public function selection()
   {
      $data['title'] = 'Seleksi Tanaman';
      $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
      $data['device'] = $this->db->get_where('devices', ['id' => $data['user']['device_id']])->row_array();
      // var_dump($data['device']);
      // die;

      $this->load->view('layouts/header', $data);
      $this->load->view('layouts/navbar', $data);
      $this->load->view('layouts/sidebar', $data);
      $this->load->view('member/plant-selection', $data);
      $this->load->view('layouts/footer', $data);
   }

   public function getdataloc()
   {
      header('Content-Type: application/json; charset=UTF-8');

      $place = $this->input->post('place');
      $ele = $this->input->post('ele');

      $data['region'] = $this->db->get_where('climate', ['region' => $place])->result_array();
      // Rumus suhu berdasarkan ketinggian (100 adalah ketinggian lokasi stasiun)
      $data['region'][0]['tempByEle'] = $data['region'][0]['average_temp'] + (0.006 * (100 - $ele) * 1);

      $results = [
         'error' => false,
         'error_msg' => 'Everything A-OK',
         'data' => $data
      ];

      echo json_encode($results);
   }

   public function mydevice()
   {
      $data['title'] = 'Perangkat Saya';
      $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
      $data['device'] = $this->db->get_where('devices', ['id' => $data['user']['device_id']])->row_array();

      $this->form_validation->set_rules('id', 'ID', 'required|trim');

      if ($this->form_validation->run() == false) {
         $this->load->view('layouts/header', $data);
         $this->load->view('layouts/navbar', $data);
         $this->load->view('layouts/sidebar', $data);
         $this->load->view('member/my-device', $data);
         $this->load->view('layouts/footer', $data);
      } else {
         $id = htmlspecialchars($this->input->post('id'));
         $verify = $this->db->get_where('devices', ['id' => $id]);
         // var_dump($verify->num_rows());
         // die;
         if ($verify->num_rows() == 0) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><small>Perangkat tidak dikenali, pastikan ID sudah sesuai!</small></div>');
            redirect('member/mydevice');
         } else {
            $this->db->update('users', ['device_id' => $id], ['id' => $data['user']['id']]);

            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><small>Perangkat berhasil dihubungkan!</small></div>');
            redirect('member/mydevice');
         }
      }
   }

   public function history()
   {
   }

   public function euclidean()
   {
      header('Content-Type: application/json; charset=utf-8');

      $data['title'] = 'Perangkat Saya';
      $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
      $data['device'] = $this->db->get_where('devices', ['id' => $data['user']['device_id']])->row_array();

      $data = [
         'id' => $this->input->post('id'),
         'device_id' => $this->input->post('did'),
         'user_id' => $this->input->post('uid'),
         'average_temp' => (float)$this->input->post('t'),
         'rainfall' => (float)$this->input->post('r'),
         'humidity' => (float)$this->input->post('h'),
         'ph' => (float)$this->input->post('p'),
         'elevation' => (float)$this->input->post('e'),
         'place_name' => $this->input->post('place'),
         'timestamp' => time()
      ];

      $training = $this->_raining($data);

      // Melakukan perulangan untuk memperoleh jarak dari setiap data training
      for ($i = 0; $i < count($training); $i++) {
         $a = [$data['average_temp'], $data['rainfall'], $data['humidity'], $data['ph'], $data['elevation']];
         // $a = [1, 1, 1, 1, 1];
         $b = [
            $training[$i]['t'],
            $training[$i]['r'],
            $training[$i]['h'],
            $training[$i]['p'],
            $training[$i]['e']
         ];

         // nilai yang dihasilkan dari algoritma ini adalah jarak kesamaan, dimasukkan ke dalam array
         $training[$i]['d'] = $this->_euclideanDistance($a, $b);
         // menghitung skor
         // $training[$i]['s'] =
         //    ($training[$i]['t'] +
         //       $training[$i]['r'] +
         //       $training[$i]['h'] +
         //       $training[$i]['p'] +
         //       $training[$i]['e']) / 5 * 100;
      }

      // echo $training;
      // var_dump($training);
      // $result = [$training];
      // echo json_encode($a);
      echo json_encode($training);
   }

   private function _raining($data)
   {
      $classifications = $this->db->get('classification')->result_array();
      $lahan = [$data['average_temp'], $data['rainfall'], $data['humidity'], $data['ph'], $data['elevation']];
      // $lahan = [15, 1726.98, 89, 14.39, 15];

      // var_dump(count($classifications));
      // die;
      $i = 0;
      foreach ($classifications as $class) {
         $tn = $class['temp_min'];
         $tx = $class['temp_max'];
         $rn = $class['rf_min'];
         $rx = $class['rf_max'];
         $hn = $class['hmdt_min'];
         $hx = $class['hmdt_max'];
         $pn = $class['ph_min'];
         $px = $class['ph_max'];
         $en = $class['ele_min'];
         $ex = $class['ele_max'];
         $acuan = [$tn, $tx, $rn, $rx, $hn, $hx, $pn, $px, $en, $ex];
         $result[$i] = ['t' => $lahan[0], 'r' => $lahan[1], 'h' => $lahan[2], 'p' => $lahan[3], 'e' => $lahan[4]];
         $result[$i] += ['id' => $class['id']];
         $result[$i] += ['plant_name' => $class['plant_name']];
         $result[$i] += ['acuan' => $acuan];
         if ($lahan[0] < $acuan[0]) {
            $result[$i]['t'] = $acuan[0];
         } elseif ($lahan[0] > $acuan[1]) {
            $result[$i]['t'] = $acuan[1];
         } else {
         }
         if ($lahan[1] < $acuan[2]) {
            $result[$i]['r'] = $acuan[2];
         } elseif ($lahan[1] > $acuan[3]) {
            $result[$i]['r'] = $acuan[3];
         }
         if ($lahan[2] < $acuan[4]) {
            $result[$i]['h'] = $acuan[4];
         } elseif ($lahan[2] > $acuan[5]) {
            $result[$i]['h'] = $acuan[5];
         }
         if ($lahan[3] < $acuan[6]) {
            $result[$i]['p'] = $acuan[6];
         } elseif ($lahan[3] > $acuan[7]) {
            $result[$i]['p'] = $acuan[7];
         }
         if ($lahan[4] < $acuan[8]) {
            $result[$i]['e'] = $acuan[8];
         } elseif ($lahan[4] > $acuan[9]) {
            $result[$i]['e'] = $acuan[9];
         }
         // var_dump($result);
         // die;
         $i++;
      }
      // var_dump($result);
      // die;
      return $result;
   }

   private function _training($data)
   {
      // Mengambil data klasifikasi 
      $classifications = $this->db->get('classification')->result_array();

      // Deklarasi kondisi lahan yang diambil ke variabel tersingkat/data testing
      $_t = $data['average_temp'];
      $_r = $data['rainfall'];
      $_h = $data['humidity'];
      $_p = $data['ph'];
      $_e = $data['elevation'];

      // Melakukan perulangan untuk mendapatkan nilai 
      // apakah kondisi lahan sesuai dengan data training
      // ya = 1, tidak = 0
      $i = 1;
      foreach ($classifications as $class) {
         // deklarasi data kasifikasi ke variabel singkat
         // untuk mempermudah pemrograman
         $tn = $class['temp_min'];
         $tx = $class['temp_max'];
         $rn = $class['rf_min'];
         $rx = $class['rf_max'];
         $hn = $class['hmdt_min'];
         $hx = $class['hmdt_max'];
         $pn = $class['ph_min'];
         $px = $class['ph_max'];
         $en = $class['ele_min'];
         $ex = $class['ele_max'];

         $result[$i] = ['id' => $class['id']];
         $result[$i] += ['plant_name' => $class['plant_name']];
         $result[$i] += ['t' => 0];
         $result[$i] += ['r' => 0];
         $result[$i] += ['h' => 0];
         $result[$i] += ['p' => 0];
         $result[$i] += ['e' => 0];
         if ($_t >= $tn && $_t <= $tx) {
            $result[$i]['t'] = 1;
         }
         if ($_r >= $rn && $_r <= $rx) {
            $result[$i]['r'] = 1;
         }
         if ($_h >= $hn && $_h <= $hx) {
            $result[$i]['h'] = 1;
         }
         if ($_p >= $pn && $_p <= $px) {
            $result[$i]['p'] = 1;
         }
         if ($_e >= $en && $_e <= $ex) {
            $result[$i]['e'] = 1;
         }
         $i++;
      }

      return $result;
   }

   private function _euclideanDistance($a, $b)
   {
      // Data testing diberikan nilai true setiap indikator
      return
         array_sum(
            array_map(
               function ($x, $y) {
                  return abs($x - $y) ** 2;
               },
               $a,
               $b
            )
         ) ** (1 / 2);
   }
}
