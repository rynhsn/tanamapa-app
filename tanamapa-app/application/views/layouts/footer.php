<footer class="main-footer">
   <div class="float-right d-none d-sm-block">
      <b>Alpha</b> version
   </div>
   <strong>Copyright &copy; <?= date('Y'); ?> <a href="https://github.com/rynhsn">Riyan Husen</a>.</strong> All rights reserved.
</footer>

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
   <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="<?= base_url(); ?>assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?= base_url(); ?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="<?= base_url(); ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url(); ?>assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url(); ?>assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?= base_url(); ?>assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="<?= base_url(); ?>assets/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?= base_url(); ?>assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="<?= base_url(); ?>assets/plugins/jszip/jszip.min.js"></script>
<script src="<?= base_url(); ?>assets/plugins/pdfmake/pdfmake.min.js"></script>
<script src="<?= base_url(); ?>assets/plugins/pdfmake/vfs_fonts.js"></script>
<script src="<?= base_url(); ?>assets/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="<?= base_url(); ?>assets/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="<?= base_url(); ?>assets/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<script src="<?= base_url(); ?>assets/plugins/chart.js/Chart.min.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url(); ?>assets/dist/js/adminlte.min.js"></script>
<!-- My -->
<script src="<?= base_url(); ?>assets/dist/js/req.js"></script>

<script type="text/javascript">
   <?php if ($this->uri->segment(2) == 'selection' || $this->uri->segment(2) == 'mydevice') : ?>
      getLocation("<?= $device['token']; ?>");
   <?php endif; ?>
   <?php if ($this->uri->segment(2) == 'viewmeasurement') : ?>
      getMaps(<?= $history['lat']; ?>, <?= $history['lng']; ?>);
      getAddress(<?= $history['lat']; ?>, <?= $history['lng']; ?>, <?= $history['elevation']; ?>)
   <?php endif; ?>
</script>

<script>
   $('.custom-file-input').on('change', function() {
      let fileName = $(this).val().split('\\').pop();
      $(this).next('.custom-file-label').addClass("selected").html(fileName);
   });

   $('.akses').on('click', function() {
      const menuid = $(this).data('menu');
      const roleid = $(this).data('role');

      $.ajax({
         url: "<?= base_url('admin/changeaccess'); ?>",
         type: 'post',
         data: {
            menuid: menuid,
            roleid: roleid
         },
         success: function() {
            document.location.href = "<?= base_url('admin/roleaccess/'); ?>" + roleid
         }
      });
   });

   $('#clear').on('click', function() {
      $('input').val('');
   })

   $('#save-result').click(function() {
      // alert("Hasil pengukuran berhasil disimpan!");
      var id = $('#id').val();
      var user_id = "<?= $user['id']; ?>"
      var device_id = $('#device_id').val();
      var ph = $('#ph').val();
      var humidity = $('#humidity').val();
      var ele = $('#ele').val();
      var rainfall = $('#rainfall').val();
      var average_temp = $('#average_temp').val();
      var place = $('#place').val();
      var lat = $('#lat').val();
      var lng = $('#lon').val();

      // return confirm(user_id);
      $.ajax({
         url: "<?= base_url('member/saveMeasurement'); ?>",
         type: 'post',
         data: {
            id: id,
            user_id: user_id,
            device_id: device_id,
            ph: ph,
            humidity: humidity,
            ele: ele,
            rainfall: rainfall,
            average_temp: average_temp,
            place: place,
            lat: lat,
            lng: lng
         },
         success: function(result) {
            alert(result.error_msg);
         },
         error: function() {
            alert("Kesalahan tidak diketahui!");
         }
      });
   })

   // Seleksi
   $("#readyForSelection").on("click", function() {
      $(this).hide();
      $("#kembali").show();
      var val;
      // Mengukur jarak euclidean distance
      $.ajax({
         url: "<?= base_url('member/euclidean'); ?>",
         type: 'post',
         data: {
            id: (randomId(7), randomtextnumber),
            did: $("#device_id").val(),
            uid: "<?= $user['email']; ?>",
            lat: $("#lat").val(),
            lon: $("#lon").val(),
            t: $("#average_temp").val(),
            r: $("#rainfall").val(),
            h: $("#humidity").val(),
            p: $("#ph").val(),
            e: $("#ele").val(),
            place: $("#place_name").val(),
         },
         success: function(r) {
            var arr = Object.entries(r);
            var total = [0, 0, 0, 0, 0, 0];
            arr.sort(sortFunction);
            $("#plant").html('');
            for (var i = 0; i < Object.keys(r).length; i++) {
               var insert_row = "<tr><td>" + (i + 1) + "</td><td>" + arr[i][1]['plant_name'] + "</td>";

               var k = 0;
               var bg_bar = ["#d2d6de", "#f56954", "#f39c12", "#00a65a", "#00c0ef", "#3c8dbc"];
               for (var j = 0; j < 6; j++) {
                  if (arr[i][1]['s'] == k) {
                     insert_row += "<td><div class='progress progress-xs'><div class='progress-bar' style='width:" + arr[i][1]['s'] + "%;background-color:" + bg_bar[j] + ";'></div></div></td>";
                     total[j]++;
                  }
                  k += 20;
               }

               insert_row += "<td class='text-center'>" + arr[i][1]['d'] + "</td>";

               var similarity = [arr[i][1]['t'], arr[i][1]['r'], arr[i][1]['h'], arr[i][1]['p'], arr[i][1]['e']];

               for (var j = 0; j < similarity.length; j++) {
                  similarity[j] == 1 ? insert_row += "<td class='text-center'>Sesuai</td>" : insert_row += "<td class='text-center'>Tidak Sesuai</td>";
               }

               $("#plant").append(insert_row);
            }
            arr.sort(sortFunction);
            $("#recomendation").removeAttr("hidden");
            getChart(total);
         }
      });
   });

   function sortFunction(a, b) {
      if (a[1]['s'] === b[1]['s']) {
         return 0;
      } else {
         return (a[1]['s'] < b[1]['s']) ? 1 : -1;
      }
   }

   // Datatable
   $(function() {
      $("#example1").DataTable({
         "responsive": true,
         "lengthChange": false,
         "autoWidth": false,
         "buttons": ["copy", "csv", "excel", "pdf", "print"]
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
      $('#example2').DataTable({
         "paging": true,
         "lengthChange": false,
         "searching": false,
         "ordering": true,
         "info": true,
         "autoWidth": false,
         "responsive": true,
      });
   });
</script>
</body>

</html>