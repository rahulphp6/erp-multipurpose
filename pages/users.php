<?php
    if (isset($_POST['addUser'])) {
      $email=explode('@',$_POST['email']);
      $username=array("UserName"=>$email[0],"password"=>md5('123'));
      $data=array_merge($_POST,$username);
      
      unset($data['addUser']);
      array_values($data);
      //print_r($data);
     $usersData=dbAction('users',1,$data);
     if ($usersData[0]==1) {
       mgs('User Has Been Added');
     }else{
       mgs($usersData[1],0);
     }
    }
    ?>
<!-- Main content -->
<div class="content">
  <div class="container-fluid">
    <div class="row">
      
      <div class="col-lg-8">
        <div class="card">
          <div class="card-body">
            <h5><i class="fa fa-user input-icon"></i> Add User</h5>
            <hr>
            <form method="post" enctype="multipart/form-data">
              <div class="row">
                <div class="col-md-5">
                  <div class="form-group">
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text" title="Role"><i class="fa fa-user-secret input-icon"></i></span>
                      </div>
                      <select class="form-control" name="role" id="Gender">
                        <?php
                          $usersRole=dbAction('roles',4);
                          if ($usersRole->num_rows>0) {
                             foreach ($usersRole as $Roles) { 
                              echo '<option value="'.$Roles['id'].'">'.$Roles['name'].'</option>';
                               }
                            }else{
                              echo "Add Roles First!";
                            }
                           ?>
                      </select>
                    </div>
                  </div>
                </div>
                
                <div class="col-md-5">
                  <div class="form-group">
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text" title="User Type">Type</span>
                      </div>
                      <select class="form-control" name="depid">
                      <option value="">--Department--</option>
                        <?php
                          $dep=dbAction('departments',4,"","status=1");
                          if ($dep->num_rows>0) {
                             foreach ($dep as $depRow) { 
                              echo '<option value="'.$depRow['id'].'">'.$depRow['name'].'</option>';
                               }
                            }else{
                              echo "Add Department First!";
                            }
                           ?>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-group">
                    <div class="input-group">
                      <select class="form-control" name="status" id="Gender" title="Status of this user">
                        <option value="1">Active</option>
                        <option value="0">InActive</option>
                      </select>
                    </div>
                    
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group form-group-icon-left">
                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-user input-icon"></i></span>
                      </div>
                      <input class="form-control" name="name" placeholder="First Name" type="text" required />
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group form-group-icon-left">
                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-user input-icon"></i></span>
                      </div>
                      <input class="form-control" name="LastName" placeholder="Last Name" type="text" />
                    </div>

                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group form-group-icon-left">
                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-envelope input-icon"></i></span>
                      </div>
                      <input class="form-control" name="email" placeholder="Email id" type="email" required/>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group form-group-icon-left">
                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-phone input-icon"></i></span>
                      </div>
                      <input class="form-control" name="number" placeholder="Phone Number" type="number" />
                    </div>

                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label>Gender*</label>
                    <select class="form-control" name="Gender" id="Gender">
                      <option value="0">Male</option>
                      <option value="1">Female</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Date of Birth*</label>
                    <input name="DateOfBirth" id="DateOfBirth" class="date-pick-years form-control" type="date" />
                  </div>
                </div>
                
                <div class="col-md-12">
                  <h4>Location</h4>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label>Address 1</label>
                    <input class="form-control" name="AddressLine1" id="AddressLine1" type="text" />
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label>Address 2</label>
                    <input class="form-control" name="AddressLine2" id="AddressLine2" type="text" />
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>City</label>
                    <input class="form-control" name="City"  id="City" type="text" />
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Country</label>
                    <select name="CountryName" id="CountryName" class="form-control" tabindex="10" aria-required="true" aria-invalid="false">
                      <option value="">--Select--</option>
                      <?php echo $countryData; ?>
                    </select>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Country Code</label>
                    <select name="CountryCode" id="CountryCode" class="form-control" tabindex="10" aria-required="true" aria-invalid="false">
                      <option value="">--Select--</option>
                      <?php echo $CountryCodeData; ?>
                    </select>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Nationality</label>
                    <select id="Nationality" name="Nationality" class="form-control">
                      <option value="">--Select--</option>
                      <?php echo $nationality; ?>
                    </select>
                  </div>
                </div>
              </div>
              <hr>
              <div class="col-md-12">
                <input type="submit" name="addUser" class="btn btn-primary" value="Add User">
              </div>
              <div class="gap"></div>
            </form>
          </div>
        </div>
      </div>
      <div class="col-md-4">
          <div class="card">
            <div class="card-body">
              
              <?php
                if (isset($_POST['adddep'])) {
                 $dataRole=dbAction('dep',1);
                 if ($dataRole[0]==1) {
                   mgs('Type Create Successfully');
                 }else{
                  mgs($dataRole[1],0);
                 }
                }
                ?>
              <h5>Add User Type</h5>
              <hr>
              <form method="post" enctype="multipart/form-data">
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group form-group-icon-left">
                      <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="fa fa-users input-icon"></i></span>
                        </div>
                        <input class="form-control" name="type" placeholder="user type" type="text" required />
                      </div>
                    </div>
                    <div class="form-group form-group-icon-left">
                      <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="fa fa-filter input-icon"></i></span>
                        </div>
                        <input class="form-control" name="short" placeholder="short name" type="text" />
                      </div>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group form-group-icon-left">
                      <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="fa fa-file input-icon"></i></span>
                        </div>
                        <textarea class="form-control" name="description" placeholder="Give some words to define it.."></textarea>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <input type="submit" name="adddep" class="btn btn-primary" value="Add Type">
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>