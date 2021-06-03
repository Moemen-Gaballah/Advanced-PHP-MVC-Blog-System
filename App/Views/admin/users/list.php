<div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Responsive Hover Table</h3>

                <div class="card-tools">
                  <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                    
                      <a href="<?php echo url('/admin/users/add') ?>" class="btn btn-default">
                       Add Users
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
                      <th>Group Name</th> 
                      <th>Email</th> 
                      <th>Status</th> 
                      <th>Join</th> 
                      <th>Action</th> 
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($users as $user) {?>
                    <tr>
                      <td><?php echo $user->id; ?></td>
                      <td><?php echo $user->first_name . ' ' . $user->last_name; ?></td>
                      <td><?php echo $user->group; ?></td>
                      <td><?php echo $user->email; ?></td>
                      <td><?php echo ucfirst($user->status); ?></td>
                      <td><?php echo date('d-m-Y', $user->created); ?></td>
                      <td>
                        <a href="<?php echo url('admin/users/edit/'.$user->id);?>" class="btn btn-primary">
                        Edit
                        <i class="fa fa-pencil-alt"></i>
                        </a>
                        <?php if($user->id != 1) { ?> 
                        <a onclick="return confirmDelete()" href="<?php echo url('admin/users/delete/'.$user->id);?>" class="btn btn-danger">
                        Delete
                        <i class="fa fa-trash"></i>
                      </a>
                      <?php } ?>
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