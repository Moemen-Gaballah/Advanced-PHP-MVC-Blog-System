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
          <form action="<?php echo url('/admin/posts/save/'.$post->id); ?>" method="post" enctype="multipart/form-data">
          <!-- Show Errors -->
          <div class="form-results"></div>
          
          <div class="form-group">
            <label for="title">Title Post</label>
            <input type="text" required name="title" value="<?php echo $post->title ?>"  id="title" class="form-control">
          </div>

          <div class="form-group">
            <label for="details">Details</label>
            <textarea name="details" id="details" cols="30" rows="10">
              <?php echo $post->details ?>
            </textarea>
          </div>

          <div class="form-group">
            <label for="tags">Tags</label>
            <input type="text" required name="tags" value="<?php echo $post->tags ?>"  id="tags" class="form-control">
          </div>


          <div class="form-group">
            <label for="status">Status</label>
            <select required id="status" name="status" class="form-control custom-select">
              <option disabled="">Select one</option>
              <option <?php if($post->status == 'enabled') echo 'selected';  ?> value="enabled">Enabled</option>
              <option <?php if($post->status == 'disabled') echo 'selected';  ?> value="disabled">Disabled</option>
            </select>
          </div>


          <div class="form-group col-sm-12">
            <label for="category_id">Category</label>
            <select required id="category_id" name="category_id" class="form-control custom-select">
              <option selected="" disabled="">Select Category</option>
              <?php foreach ($categories as $category) { ?>
                <option <?php if($post->category_id == $category->id) echo 'selected';  ?> value="<?php echo $category->id; ?>"><?php echo $category->name; ?></option>
              <?php  } ?>

            </select>
          </div>


         <div class="form-group col-sm-12">
            <label for="related_posts">Related Posts</label>
            <select required id="related_posts" multiple="multiple" name="related_posts[]" class="form-control custom-select">
              <option disabled="">Select Category</option>
              <?php $related_posts = explode(',', $post->related_posts); ?>
              <?php foreach ($posts as $item) { if($post->id == $item->id) continue;?>
                <option <?php echo in_array($item->id, $related_posts) ? 'selected' : '';  ?> value="<?php echo $item->id; ?>"><?php echo $item->title; ?></option>
              <?php  } ?>
            </select>
          </div>

          <div class="form-group">
            <label for="image">Image</label>
            <input type="file" name="image" id="image" class="form-control">
             <img width="150px;" height="150px;" src="<?php echo assets('uploads/images/'. $post->image) ?>">
          </div>


          <div class="form-group">
            <button class="btn btn-success btn-lg">Update Post</button>
          </div>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>  
  </div>
</section>