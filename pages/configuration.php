<!-- Main content -->
<div class="content">
  <div class="container-fluid">
    <?php
    if (isset($_POST['genConfig'])) {
      if (isset($_POST['chat'])) {
        $chat = 1;
      } else {
        $chat = 0;
      }
      $myForm = array("chat" => $chat);
      $myForm = array_merge($_POST, $myForm);
      unset($myForm['genConfig']);
      //print_r($myForm);
      $configQuery = dbAction('configuration',2, $myForm);
      if ($configQuery[0] == 1) {
        echo "<script>window.location.href='" . constant("BASE") . "admin.php?page=configuration'</script>";
      } else {
        mgs($configQuery[1], 0);
      }
    }
    ?>
    <form method="post" enctype="multipart/form-data">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Genral Configuration</h3>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group form-group-icon-left">
                <label>Business Name</label>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa fa-user input-icon"></i></span>
                  </div>
                  <input class="form-control" name="brand" value="<?php if (isBrand) {
                                                                    echo $Brand['brand'];
                                                                  } ?>" type="text" required />
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group form-group-icon-left">
                <label>Short Name</label>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa fa-user input-icon"></i></span>
                  </div>
                  <input class="form-control" name="short" value="<?php if (isBrand) {
                                                                    echo $Brand['short'];
                                                                  } ?>" type="text" required />
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group form-group-icon-left">
                <label>E-mail</label>

                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa fa-envelope input-icon"></i></span>
                  </div>
                  <input class="form-control" name="email" value="<?php if (isBrand) {
                                                                    echo $Brand['email'];
                                                                  } ?>" type="email" />
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group form-group-icon-left">
                <label>Phone Number</label>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa fa-phone input-icon"></i></span>
                  </div>
                  <input class="form-control" name="phone" value="<?php if (isBrand) {
                                                                    echo $Brand['phone'];
                                                                  } ?>" type="text" />
                </div>

              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <h5>Social Media</h5>
              <hr>
            </div>
            <div class="col-md-6">
              <div class="form-group form-group-icon-left">
                <label>facebook</label>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa fa-facebook input-icon"></i></span>
                  </div>
                  <input class="form-control" name="facebook" value="<?php if (isBrand) {
                                                                        echo $Brand['facebook'];
                                                                      } ?>" type="text" placeholder="https://www.facebook.com/optiecraft" />
                </div>

              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group form-group-icon-left">
                <label>Instagram</label>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa fa-instagram input-icon"></i></span>
                  </div>
                  <input class="form-control" name="instagram" value="<?php if (isBrand) {
                                                                        echo $Brand['instagram'];
                                                                      } ?>" type="text" placeholder="https://www.instagram.com/opti.craft/?r=nametag" />
                </div>

              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group form-group-icon-left">
                <label>Twitter</label>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa fa-twitter input-icon"></i></span>
                  </div>
                  <input class="form-control" name="twitter" value="<?php if (isBrand) {
                                                                      echo $Brand['twitter'];
                                                                    } ?>" type="text" placeholder="https://twitter.com/optiecraft" />
                </div>

              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group form-group-icon-left">
                <label>Linkedin</label>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa fa-linkedin input-icon"></i></span>
                  </div>
                  <input class="form-control" name="linkedin" value="<?php if (isBrand) {
                                                                        echo $Brand['linkedin'];
                                                                      } ?>" type="text" placeholder="https://linkedin.com/optiecraft" />
                </div>

              </div>
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <label>Address</label>
              <input type="text" class="form-control" name="address" value="<?php if (isBrand) {
                                                                              echo $Brand['address'];
                                                                            } ?>">
            </div>
            <div class="form-group">
              <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                <input type="checkbox" class="custom-control-input" id="chat" name="chat" <?php if (!empty($chat) AND $chat==1) {
                                                                                            echo 'checked';
                                                                                          } ?>>
                <label class="custom-control-label" for="chat"> Chat Support</label>
              </div>
            </div>
          </div>
        </div>
        <div class="card-footer">
          <input type="submit" name="genConfig" value="Update Config" class="btn btn-primary">
        </div>
      </div>
    </form>
  </div><!-- /.container-fluid -->
</div>