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
          <form action="<?php echo url('/admin/users/save/'.$user->id); ?>" method="post" enctype="multipart/form-data">
          <!-- Show Errors -->
          <div class="form-results"></div>
          
          <div class="form-group">
            <label for="first_name">First Name</label>
            <input type="text" required name="first_name" value="<?php echo $user->first_name ?>" id="first_name" class="form-control">
          </div>


          <div class="form-group">
            <label for="first_name">Last Name</label>
            <input type="text" required name="last_name" value="<?php echo $user->last_name ?>" id="last_name" class="form-control">
          </div>


          <div class="form-group">
            <label for="email">Email</label>
            <input type="email"  value="<?php echo $user->email ?>" required name="email" id="email" class="form-control">
          </div>

          <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" class="form-control">
          </div>

          <div class="form-group">
            <label for="confirm_password">Confirm Password</label>
            <input type="password" name="confirm_password" id="confirm_password" class="form-control">
          </div>


          <div class="form-group">
            <label for="status">Status</label>
            <select required id="status" name="status" class="form-control custom-select">
              <option selected="" disabled="">Select one</option>
              <option <?php if($user->status == 'enabled') echo 'selected';  ?> value="enabled">Enabled</option>
              <option <?php if($user->status == 'disabled') echo 'selected';  ?> value="disabled">Disabled</option>
            </select>
          </div>


          <div class="form-group">
            <label for="gender">Gender</label>
            <select required id="gender" name="gender" class="form-control custom-select">
              <option disabled="">Gender</option>
              <option <?php if($user->gender == 'male') echo 'selected';  ?> value="male">Male</option>
              <option <?php if($user->gender == 'female') echo 'selected';  ?> value="female">Female</option>
            </select>
          </div>



          <div class="form-group">
            <label for="birthday">birthday</label>
            <input type="text"  value="<?php echo date('d-m-Y', $user->birthday) ?>" required name="birthday" id="birthday" class="form-control">
          </div>
         

          <div class="form-group col-sm-12">
            <label for="users_group_id">Users Groups</label>
            <select required id="users_group_id" name="users_group_id" class="form-control custom-select">
              <option disabled="">Select Permission</option>
              <?php foreach ($users_groups as $users_group) { ?>
                <option <?php if($user->users_group_id == $users_group->id) echo 'selected';  ?> value="<?php echo $users_group->id; ?>"><?php echo $users_group->name; ?></option>
              <?php  } ?>

            </select>
          </div>

          <div class="form-group">
            <label for="image">Image</label>
            <input type="file" name="image" id="image" class="form-control">
            <img width="150px;" height="150px;" src="<?php echo assets('uploads/images/'. $user->image) ?>">
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