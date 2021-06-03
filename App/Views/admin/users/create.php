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
          <form action="<?php echo url('/admin/users/submit'); ?>" method="post" enctype="multipart/form-data">
          <!-- Show Errors -->
          <div class="form-results"></div>
          
          <div class="form-group">
            <label for="first_name">First Name</label>
            <input type="text" required name="first_name" id="first_name" class="form-control">
          </div>


          <div class="form-group">
            <label for="first_name">Last Name</label>
            <input type="text" required name="last_name" id="last_name" class="form-control">
          </div>


          <div class="form-group">
            <label for="email">Email</label>
            <input type="email" required name="email" id="email" class="form-control">
          </div>

          <div class="form-group">
            <label for="password">Password</label>
            <input type="password" required name="password" id="password" class="form-control">
          </div>

          <div class="form-group">
            <label for="confirm_password">Confirm Password</label>
            <input type="password" required name="confirm_password" id="confirm_password" class="form-control">
          </div>


          <div class="form-group">
            <label for="status">Status</label>
            <select required id="status" name="status" class="form-control custom-select">
              <option selected="" disabled="">Select one</option>
              <option value="enabled">Enabled</option>
              <option value="disabled">Disabled</option>
            </select>
          </div>


          <div class="form-group">
            <label for="gender">Gender</label>
            <select required id="gender" name="gender" class="form-control custom-select">
              <option selected="" disabled="">Gender</option>
              <option value="male">Male</option>
              <option value="female">Female</option>
            </select>
          </div>



          <div class="form-group">
            <label for="birthday">birthday</label>
            <input type="text" required name="birthday" id="birthday" class="form-control">
          </div>
         

          <div class="form-group col-sm-12">
            <label for="users_group_id">Users Groups</label>
            <select required id="users_group_id" name="users_group_id" class="form-control custom-select">
              <option selected="" disabled="">Select Permission</option>
              <?php foreach ($users_groups as $users_group) { ?>
                <option value="<?php echo $users_group->id; ?>"><?php echo $users_group->name; ?></option>
              <?php  } ?>

            </select>
          </div>

          <div class="form-group">
            <label for="image">Image</label>
            <input type="file" required name="image" id="image" class="form-control">
          </div>


          <div class="form-group">
            <button class="btn btn-success btn-lg">Add Users</button>
          </div>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>  
  </div>
</section>