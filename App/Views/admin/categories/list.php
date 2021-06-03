<div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Responsive Hover Table</h3>

                <div class="card-tools">
                  <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                    
                      <a href="<?php echo url('/admin/categories/add') ?>" class="btn btn-default">
                       Add Category
                      </a>

                     <div class="input-group-append">
                      <button type="submit" class="btn btn-default">
                        <i class="fas fa-search"></i>
                      </button>

                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">

                <?php if($success) { ?> <div class="alert alert-success"> 
                  <?php echo $success;?>
                  </div>
                <?php } ?>

                <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Name</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($categories as $category) {?>
                    <tr>
                      <td><?php echo $category->id; ?></td>
                      <td><?php echo $category->name; ?></td>
                      <td><?php echo ucfirst($category->status); ?></td>
                      <td>
                        <a href="<?php echo url('admin/categories/edit/'.$category->id);?>" class="btn btn-primary">
                        Edit
                        <i class="fa fa-pencil-alt"></i>
                        </a>
                        <a href="<?php echo url('admin/categories/delete/'.$category->id);?>" class="btn btn-danger">
                        Delete
                        <i class="fa fa-trash"></i>
                      </a>
                      </td>
                    </tr>
                  <? } ?>
                  
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>