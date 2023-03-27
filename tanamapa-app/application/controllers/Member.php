<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Member extends CI_Controller
{
   public function __construct()
   {
      parent::__construct();
      is_logged_in();
      $this->load->model('M_device', 'device');
      $this->load->model('M_measurement', 'measurement');
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
      $data['device'] = $this->device->getById($data['user']['device_id']);
      // var_dump($data['device']);
      // die;

      $this->load->view('layouts/header', $data);
      $this->load->view('layouts/navbar', $data);
      $this->load->view('layouts/sidebar', $data);
      $this->load->view('member/plant-selection', $data);
      $this->load->view('layouts/footer', $data);
   }

   public function histories()
   {
      $data['title'] = 'Riwayat Seleksi';
      $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
      $data['histories'] = $this->measurement->getByUser($data['user']['id']);
      // $data['device'] = $this->db->get_where('devices', ['id' => $data['user']['device_id']])->row_array();
      // var_dump($data['device']);
      // die;

      $this->load->view('layouts/header', $data);
      $this->load->view('layouts/navbar', $data);
      $this->load->view('layouts/sidebar', $data);
      $this->load->view('member/history', $data);
      $this->load->view('layouts/footer', $data);
   }

   public function saveMeasurement()
   {
      header('Content-Type: application/json; charset=UTF-8');
      $exist = $this->db->get_where('measurement_history', ['id' => $this->input->post('id')])->row_array();
      if (!$exist) {
         $data = [
            'id' => $this->input->post('id'),
            'user_id' => $this->input->post('user_id'),
            'device_id' => $this->input->post('device_id'),
            'average_temp' => $this->input->post('average_temp'),
            'rainfall' => $this->input->post('rainfall'),
            'humidity' => $this->input->post('humidity'),
            'ph' => $this->input->post('ph'),
            'elevation' => $this->input->post('ele'),
            'lat' => $this->input->post('lat'),
            'lng' => $this->input->post('lng'),
            'place_name' => $this->input->post('place'),
            'timestamp' => time()
         ];
         $this->db->insert('measurement_history', $data);
         $results = [
            'error' => false,
            'error_msg' => 'Hasil pengukuran berhasil disimpan!'
         ];
      } else {
         $results = [
            'error' => true,
            'error_msg' => 'Gagal, hasil pengukuran sudah disimpan sebelumnya'
         ];
      }


      echo json_encode($results);
   }

   public function viewmeasurement()
   {
      $id = $this->input->get('id');

      $data['title'] = 'Riwayat Seleksi';
      $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
      $data['history'] = $this->measurement->getById($id);

      $this->load->view('layouts/header', $data);
      $this->load->view('layouts/navbar', $data);
      $this->load->view('layouts/sidebar', $data);
      $this->load->view('member/detail-history', $data);
      $this->load->view('layouts/footer', $data);
   }

   public function delmeasurement()
   {
      $id = $this->input->get('id');
      $this->measurement->delete($id);
      $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><small>Riwayat berhasil dihapus!</small></div>');
      redirect('member/histories');
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

   public function euclidean()
   {
      $data['title'] = 'Perangkat Saya';
      $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
      $data['device'] = $this->db->get_where('devices', ['id' => $data['user']['device_id']])->row_array();

      $data = [
         'id' => $this->input->post('id'),
         'device_id' => $this->input->post('did'),
         'user_id' => $this->input->post('uid'),
         'average_temp' => $this->input->post('t'),
         'rainfall' => $this->input->post('r'),
         'humidity' => $this->input->post('h'),
         'ph' => $this->input->post('p'),
         'elevation' => $this->input->post('e'),
         'place_name' => $this->input->post('place'),
         'timestamp' => time()
      ];

      $training = $this->_training($data);

      // Melakukan perulangan untuk memperoleh jarak dari setiap data training
      for ($i = 1; $i <= count($training); $i++) {
         $a = [1, 1, 1, 1, 1];
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
         $training[$i]['s'] =
            ($training[$i]['t'] +
               $training[$i]['r'] +
               $training[$i]['h'] +
               $training[$i]['p'] +
               $training[$i]['e']) / 5 * 100;
      }

      // $result = [$training];

      // echo json_encode($training_result);
      header('Content-Type: application/json; charset=utf-8');
      echo json_encode($training);
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
