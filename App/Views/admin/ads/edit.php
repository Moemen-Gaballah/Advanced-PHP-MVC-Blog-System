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
          <form action="<?php echo url('/admin/ads/save/'.$ad->id); ?>" method="post" enctype="multipart/form-data">
          <!-- Show Errors -->
          <div class="form-results"></div>
          
          <div class="form-group">
            <label for="name">Ad name</label>
            <input type="text" required name="name" value="<?php echo $ad->name ?>" id="name" class="form-control">
          </div>

          <div class="form-group">
            <label for="link">Ad url</label>
            <input type="text" required name="link" value="<?php echo $ad->link ?>" id="link" class="form-control">
          </div>


          <div class="form-group">
            <label for="url">Start At</label>
            <input type="text" value="<?php echo date('d-m-Y', $ad->start_at) ?>" required name="start_at" id="start_at" class="form-control">
          </div>


          <div class="form-group">
            <label for="url">End At</label>
            <input type="text"  value="<?php echo date('d-m-Y', $ad->end_at) ?>" required name="end_at" id="end_at" class="form-control">
          </div>


          <div class="form-group">
            <label for="status">Status</label>
            <select required id="status" name="status" class="form-control custom-select">
              <option disabled="">Select one</option>
              <option <?php if($ad->status == 'enabled') echo 'selected';  ?> value="enabled">Enabled</option>
              <option <?php if($ad->status == 'disabled') echo 'selected';  ?> value="disabled">Disabled</option>
            </select>
          </div>


 
          <div class="form-group col-sm-12">
            <label for="page">Choose Page</label>
            <select required id="page" name="page" class="form-control custom-select">
              <option selected="" disabled="">Select Page</option>
              <?php foreach ($pages as $page) {?>

                <option <?php  echo ($page == $ad->page) ? 'selected ' : ''; ?> value="<?php echo $page; ?>"><?php echo $page; ?></option>
              <?php  } ?>

            </select>
          </div>


          <div class="form-group">
            <label for="image">Image</label>
            <input type="file" name="image" id="image" class="form-control">
            <img width="150px;" height="150px;" src="<?php echo assets('uploads/images/'. $ad->image) ?>">
          </div>


          <div class="form-group">
            <button class="btn btn-success btn-lg">Update Ad</button>
          </div>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>  
  </div>
</section>