<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <?php
                if ($isW)
                    if (isset($_GET['perEid'])) {
                        if (!$isE) {
                            echo "<script>alert('Invalid Permission Area!')</script>";
                            //echo "<script>window.location.href='" . constant("BASE") . "'</script>";
                        } else {
                            $perEid = $_GET['perEid'];
                            $perRow = dbAction('permissions', 4, '', 'id=' . $perEid,1);
                            $perRow = $perRow->fetch_assoc();
                        }
                    }
                ?>
                <?php
                if (isset($_POST['Block'])) {
                    statusChange($_POST['status'], "permissions", $_POST['id']);
                }
                ?>
                <?php
                if ($isD) {
                    if (isset($_POST['deleteRun'])) {
                        $delId = $_POST['perDid'];
                        $deleteRun = dbAction('permissions', 3, '', 'id=' . $delId);
                        if ($deleteRun[0] == 1) {
                            echo "<script>alert('Deleted Successfully!')</script>";
                            echo "<script>window.location.href='" . constant("BASE") . "admin.php?page=permission-view'</script>";
                        } else {
                            mgs($deleteRun[1], 0);
                        }
                    }
                }
                ?>
                <?php
                if (isset($_POST['addPermission'])) {
                    $date = array("date" => date("Y-m-d h:i:s"));
                    $post = array_merge($_POST, $date);
                    unset($post['addPermission']);
                    $deparment = dbAction('permissions', 1, $post);
                    if ($deparment[0] == 1) {
                        mgs('Permission Add Successfully!', 1);
                    } else {
                        mgs($deparment[1], 0);
                    }
                }
                if (isset($_POST['upPermission'])) {
                    $date = array("date" => date("Y-m-d h:i:s"));
                    $post = array_merge($_POST, $date);
                    unset($post['upPermission']);
                    $deparment = dbAction('permissions', 2, $post, 'id=' . $perEid);
                    if ($deparment[0] == 1) {
                        mgs('Permission Updated Successfully!', 1);
                        echo "<script>window.location.href='" . constant("BASE") . "admin.php?page=permission-view'</script>";
                    } else {
                        mgs($deparment[1], 0);
                    }
                }
                ?>
            </div>
        </div>
    </div>
</div>
<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Permissions Detail</h3>
                        <button type="button" class="btn btn-primary btn-xs pull-right" style="float: right;" data-toggle="modal" data-target="#module_pop"><i class="fa fa-plus"></i> Add New</button>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped" id="example1">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Action</th>
                                    <th>Name</th>
                                    <th>About</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $permissionsQ = dbAction('permissions', 4);
                                if ($permissionsQ->num_rows > 0) {
                                    foreach ($permissionsQ as $permissionsRow) { ?>
                                        <tr>
                                            <td><?php echo $permissionsRow['id']; ?></td>
                                            <td>
                                                <div class="btn-group btn-sm">
                                                    <?php
                                                    if ($isE) echo '<a href="?page=permission-view&perEid=' . $permissionsRow['id'] . '&model=1" class="btn btn-primary btn-xs"><i class="fa fa-edit nav-icon"></i></a>';
                                                    if ($isD) { ?>
                                                        <form method="post" class="btnForm">
                                                            <input type="hidden" name="perDid" value="<?php echo $permissionsRow['id']; ?>">
                                                            <button type="submit" title="Delete this record" onclick="return confirm('Are You Sure?')" name="deleteRun" class="btn btn-danger btn-xs"><i class="fa fa-trash nav-icon"></i></button>
                                                        </form>
                                                    <?php } ?>
                                                    <?php if ($permissionsRow['status'] == 1) {
                                                        $nameBlock = "danger";
                                                    } else {
                                                        $nameBlock = "success";
                                                    } ?>
                                                    <form method="post">
                                                        <input type="hidden" name="id" value="<?php echo $permissionsRow['id']; ?>">
                                                        <input type="hidden" name="status" value="<?php echo $permissionsRow['status']; ?>">
                                                        <button type="submit" class="btn btn-<?php echo $nameBlock; ?> btn-xs" name="Block"><i class="fa fa-ban nav-icon"></i></button>
                                                    </form>
                                                </div>
                                            </td>
                                            <td><?php echo $permissionsRow['name']; ?></td>
                                            <td><?php echo $permissionsRow['description']; ?></td>
                                        </tr>
                                <?php  }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</div>

<div <?php if (isset($perEid)) {
            echo 'class="modal fade in show" style="display:block" id="module_pop_"' . $perEid . ' aria-modal="true"';
        } else {
            echo 'class="modal fade in" id="module_pop"';
        } ?>>
    <form method="post">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>Add Permission</h4>
                    <?php if (isset($perEid)) {
                        echo '<a href="?page=permission-view" class="close">x</a>';
                    } else {
                        echo '<button type="button" class="close" data-dismiss="modal" aria-label="Close">x</button>';
                    } ?>

                </div>
                <div class="modal-body">
                <div class="row">
            <div class="col-md-12">
              <div class="form-group form-group-icon-left">
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa fa-tasks input-icon"></i></span>
                  </div>
                  <input class="form-control" name="name" placeholder="Module Name" type="text" required value="<?php if (isset($perEid)) {
                                        echo $perRow['name'];
                                    } ?>"/>
                </div>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group form-group-icon-left">
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa fa-file input-icon"></i></span>
                  </div>
                  <textarea class="form-control" name="description"><?php if (isset($perEid)) {
                                        echo $perRow['description'];
                                    } ?></textarea>
                </div>
              </div>
            </div>
          </div>
                </div>
                <div class="modal-footer">

                    <?php if (isset($perEid)) {
                        echo '';
                    } else {
                        echo '<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>';
                    } ?>
                    <input type="submit" <?php if (isset($perEid)) {
                                                echo 'name="upPermission" value="Update Permission"';
                                            }
                                            echo 'name="addPermission" value="Add Permission"'; ?> class="btn btn-primary">
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </form>
</div>