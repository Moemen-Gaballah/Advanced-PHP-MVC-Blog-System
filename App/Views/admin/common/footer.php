  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.1.0
    </div>
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="<?php echo assets('/admin/plugins/jquery/jquery.min.js') ?>"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo assets('/admin/plugins/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
<!-- AdminLTE App -->
<script src="<?php echo assets('/admin/dist/js/adminlte.min.js') ?>"></script>
<!-- CKEDITOR -->
<script src="<?php echo assets('admin/js/ckeditor/ckeditor.js') ?>"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo assets('/admin/dist/js/demo.js') ?>"></script>
<!-- CKEDITOR run -->
<script>

  // body...
$(function () {
  CKEDITOR.replace('details');
});


// $(function () {
  // Steps to set the active sidepar link
  // 1- Get the current url
  var currentUrl = window.location.href;
  // 2- Get the last segment of the url
  var segment = currentUrl.split('/').pop();
  // 3- Add the "active" class to the id in sidebar of the current
  $('#' + segment + '-link').addClass('active');


// });

// Confirm delete
function confirmDelete() {
  // confirm("are you sure do you want delete item!");
   if (confirm("Are you sure?")) {
       return true;
    } else {
      return false;
    }

}
</script>

</script>


</body>
</html>
