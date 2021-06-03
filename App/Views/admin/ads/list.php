<div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Responsive Hover Table</h3>

                <div class="card-tools">
                  <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                    
                      <a href="<?php echo url('/admin/ads/add') ?>" class="btn btn-default">
                       Add New Ad
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
                      <th>#</th>
                      <th>Name</th>
                      <th>Start at</th> 
                      <th>end at</th> 
                      <th>Status</th> 
                      <th>created</th> 
                      <th>Action</th> 
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($ads as $ad) {?>
                    <tr>
                      <td><?php echo $ad->id; ?></td>
                      <td><?php echo $ad->name; ?></td>
                      <td><?php echo date('d-m-Y', $ad->start_at); ?></td>
                      <td><?php echo date('d-m-Y', $ad->end_at); ?></td>
                      <td><?php echo ucfirst($ad->status); ?></td>
                      <td><?php echo date('d-m-Y', $ad->created); ?></td>
                      <td>
                        <a href="<?php echo url('admin/ads/edit/'.$ad->id);?>" class="btn btn-primary">
                        Edit
                        <i class="fa fa-pencil-alt"></i>
                        </a>
                        <a onclick="return confirmDelete()" href="<?php echo url('admin/ads/delete/'.$ad->id);?>" class="btn btn-danger">
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