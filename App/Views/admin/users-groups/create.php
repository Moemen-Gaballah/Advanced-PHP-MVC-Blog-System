<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">General</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
              <i class="fas fa-minus"></i>
            </button>
          </div>
        </div>
        <div class="card-body">
          <form action="<?php echo url('/admin/users-groups/submit'); ?>" method="post">
          <!-- Show Errors -->
          <div class="form-results"></div>
          
          <div class="form-group">
            <label for="name">Users Group Name</label>
            <input type="text" required name="name" id="name" class="form-control">
          </div>
         
<!--           <div class="form-group">
            <label for="status">Status</label>
            <select required id="status" name="status" class="form-control custom-select">
              <option selected="" disabled="">Select one</option>
              <option value="enabled">Enabled</option>
              <option value="disabled">Disabled</option>
            </select>
          </div> -->

          <div class="form-group col-sm-12">
            <label for="status">Permissions</label>
            <select required id="pages" name="pages[]" multiple="multiple" class="form-control custom-select">
              <option selected="" disabled="">Select Permission</option>
              <?php foreach ($pages as $page) { ?>
                <option value="<?php echo $page; ?>"><?php echo $page; ?></option>
              <?php  } ?>

            </select>
          </div>


          <div class="form-group">
            <button class="btn btn-success btn-lg">Add Users Group</button>
          </div>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>  
  </div>
</section>