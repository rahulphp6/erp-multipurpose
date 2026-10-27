<!-- Main content -->
<div class="content">
  <div class="container-fluid">

    <?php
    if (isset($_GET['rId'])) {
      $rId = $_GET['rId'];

      if (isset($_POST['upPerm'])) {
        for ($i = 0; $i < count($_POST['permId']); $i++) {
          $checkData = dbAction('permission_role', 4, '', 'role_id=' . $rId . ' AND permission_id=' . $_POST['permId'][$i]);
          $formData = array(
            'role_id'      => $rId,
            'permission_id' => $_POST['permId'][$i],
            'isRead'       => $_POST['read'][$i],
            'isWrite'      => $_POST['write'][$i],
            'isEdit'       => $_POST['edit'][$i],
            'isDelete'     => $_POST['delete'][$i]
          );
          //print_r($formData);
          if ($checkData->num_rows > 0) {
            $permUpdate = dbAction('permission_role', 2, $formData, 'role_id=' . $rId . ' AND permission_id=' . $_POST['permId'][$i]);
            if ($permUpdate[0] == 1) {
              $mgs = 'Permissions Has Been Updated for ' . $_POST['permId'][$i];
              //mgs($mgs,1);
              echo "<script>window.location.href='" . constant("BASE") . "admin.php?page=permission&rId=" . $rId . "'</script>";
            } else {
              mgs($permUpdate[1], 0);
            }
          } else {
            $permInsert = dbAction('permission_role', 1, $formData);
            if ($permInsert[0] == 1) {
              $mgs = 'Permissions Has Been Insert for ' . $_POST['permId'][$i];
              //mgs($mgs,1);
              echo "<script>window.location.href='" . constant("BASE") . "admin.php?page=permission&rId=" . $rId . "'</script>";
            } else {
              mgs($permInsert[1], 0);
            }
          }
        }
      }
    }
    ?>

    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Permissions Status</h3>
            <a href="?page=permission-view" class="btn btn-primary btn-xs pull-right"><i class="fa fa-edit"></i> Management</a>
          </div>
          <div class="card-body">
            <form method="post" id="form">
              <table class="table table-bordered table-striped table-sm">
                <thead>
                  <tr>
                    <th>#</th>
                    <th style="width: 50%;">Name <input type="checkbox" class="selectall" /></th>
                    <th class="text-center">isRead <input type="checkbox" id="isRead" /></th>
                    <th class="text-center">isCreate <input type="checkbox" id="isWrite" /></th>
                    <th class="text-center">isEdit <input type="checkbox" id="isEdit" /></th>
                    <th class="text-center">isDelete <input type="checkbox" id="isDelete" /></th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $permissions = dbAction('permissions', 4);
                  if ($permissions->num_rows > 0) {
                    $idkey = 0;
                    foreach ($permissions as $permRol) {
                      $idGen = $permRol['name'] . '_' . $idkey++; ?>
                      <tr>
                        <td><?php echo $permRol['id']; ?><input type="hidden" name="permId[]" value="<?php echo $permRol['id']; ?>"></td>
                        <td><?php echo ucfirst($permRol['name']); ?></td>
                        <?php
                        $displayCheck = dbAction('permission_role', 4, '', 'role_id=' . $rId . ' AND permission_id=' . $permRol['id']);
                        if ($displayCheck->num_rows > 0) {
                          $CheckRow = mysqli_fetch_assoc($displayCheck);
                          if ($CheckRow['permission_id'] == $permRol['id']) { ?>
                            <td class="text-center">
                              <div class="icheck-success d-inline">
                                <input type="checkbox" name="read[]" class="individual isRead" value="1" <?php if ($CheckRow['isRead']) {
                                                                                                    echo "checked";
                                                                                                  } ?> id="read<?php echo $idGen . "_1"; ?>">
                                <label for="read<?php echo $idGen . "_1"; ?>">
                                </label>
                              </div>
                            </td>
                            <td class="text-center">
                              <div class="icheck-success d-inline">
                                <input type="checkbox" name="write[]" class="individual isWrite" value="1" <?php if ($CheckRow['isWrite']) {
                                                                                                      echo "checked";
                                                                                                    } ?> id="write<?php echo $idGen . "_2"; ?>">
                                <label for="write<?php echo $idGen . "_2"; ?>">
                                </label>
                              </div>
                            </td>
                            <td class="text-center">
                              <div class="icheck-success d-inline">
                                <input type="checkbox" name="edit[]" class="individual isEdit" value="1" <?php if ($CheckRow['isEdit']) {
                                                                                                    echo "checked";
                                                                                                  } ?> id="edit<?php echo $idGen . "_3"; ?>">
                                <label for="edit<?php echo $idGen . "_3"; ?>">
                                </label>
                              </div>
                            </td>
                            <td class="text-center">
                              <div class="icheck-success d-inline">
                                <input type="checkbox" name="delete[]" class="individual isDelete" value="1" <?php if ($CheckRow['isDelete']) {
                                                                                                      echo "checked";
                                                                                                    } ?> id="delete<?php echo $idGen . "_4"; ?>">
                                <label for="delete<?php echo $idGen . "_4"; ?>">
                                </label>
                              </div>
                            </td>
                          <?php }
                        } else {
                          ?>
                          <td>
                            <div class="icheck-success d-inline">
                              <input type="checkbox" name="read[]" class="individual" value="1" id="read<?php echo $idGen . "_1"; ?>">
                              <label for="read<?php echo $idGen . "_1"; ?>">
                              </label>
                            </div>
                          </td>
                          <td>
                            <div class="icheck-success d-inline">
                              <input type="checkbox" name="write[]" class="individual" value="1" id="write<?php echo $idGen . "_2"; ?>">
                              <label for="write<?php echo $idGen . "_2"; ?>">
                              </label>
                            </div>
                          </td>
                          <td>
                            <div class="icheck-success d-inline">
                              <input type="checkbox" name="edit[]" class="individual" value="1" id="edit<?php echo $idGen . "_3"; ?>">
                              <label for="edit<?php echo $idGen . "_3"; ?>">
                              </label>
                            </div>
                          </td>
                          <td>
                            <div class="icheck-success d-inline">
                              <input type="checkbox" name="delete[]" class="individual" value="1" id="delete<?php echo $idGen . "_4"; ?>">
                              <label for="delete<?php echo $idGen . "_4"; ?>">
                              </label>
                            </div>
                          </td>
                        <?php
                        } ?>
                      </tr>

                  <?php  }
                  }
                  ?>
                </tbody>
              </table>
              <input type="submit" name="upPerm" class="btn btn-primary" value="Update Permission">
            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript">
  $(document).ready(function() {
    $("#form").on('submit', function() {
      // to each unchecked checkbox
      $(this).find('input[type=checkbox]:not(:checked)').prop('checked', true).val(0);
    })
  })

  $(".selectall").click(function() {
    $(".individual").prop("checked", $(this).prop("checked"));
  });
  $("#isRead").click(function() {
    $(".isRead").prop("checked", $(this).prop("checked"));
  });
  $("#isWrite").click(function() {
    $(".isWrite").prop("checked", $(this).prop("checked"));
  });
  $("#isEdit").click(function() {
    $(".isEdit").prop("checked", $(this).prop("checked"));
  });
  $("#isDelete").click(function() {
    $(".isDelete").prop("checked", $(this).prop("checked"));
  });
  
</script>