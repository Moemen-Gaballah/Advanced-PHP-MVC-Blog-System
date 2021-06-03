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
          <form action="<?php echo url('/admin/users-groups/save/' . $users_groups->id); ?>" method="post">
          <!-- Show Errors -->
        <!--   <?php # if($errors) { ?> 
            <div class="alert alert-danger"><?php # echo implode("<br>", $errors); ?> </div>
           <?php #} ?> -->
          <div class="form-results"></div>
          
          <div class="form-group">
            <label for="name">Category Name</label>
            <input type="text" required name="name" value="<?php echo $users_groups->name; ?>" id="name" class="form-control">
            <?php if(! empty($errors['name'])) { ?> 
              <div style="color:red;"> <?php echo $errors['name']; ?></div>
            <?php } ?>
          </div>
         
       <!--    <div class="form-group">
            <label for="status">Status</label>
            <select required id="status" name="status" class="form-control custom-select">
              <option selected="" disabled="">Select one</option>
              <option 
              <?php #if($category->status == 'enabled') echo "selected";
               ?> value="enabled">Enabled</option>
              <option <?php
               #if($category->status == 'disabled') echo "selected";
                ?> value="disabled">Disabled</option>
            </select>
          </div> -->

          <div class="form-group col-sm-12">
            <label for="status">Permissions</label>
            <select required id="pages" name="pages" multiple="multiple" class="form-control custom-select">
              <option selected="" disabled="">Select Permission</option>
              <?php foreach ($pages as $page) { ?>
                <option value="<?php echo $page; ?>" <?php echo in_array($page, $users_groups->pages) ? 'selected' : ''; ?>><?php echo $page; ?></option>
              <?php  } ?>

            </select>
          </div>
          <div class="form-group">
            <button class="btn btn-success btn-lg">Update Users Group</button>
          </div>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>  
  </div>
</section>