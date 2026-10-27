<?php
function isAdmin()
{
    if (isset($_SESSION['role'])) {
        if ($_SESSION['role'] >= 0 and $_SESSION['role'] <= 3) {
            return true;
        } else {
            return false;
        }
    }
}
function isUser()
{
    if (isset($_SESSION['role'])) {
        if ($_SESSION['role'] > 3) {
            return true;
        } else {
            return false;
        }
    }
}
function checkUser()
{
    if (isset($_SESSION['role'])) {
        if ($_SESSION['role'] > 7) {
            return true;
        } else {
            return false;
        }
    }
}
function isSuper()
{
    if (isset($_SESSION['role'])) {
        if ($_SESSION['role'] == 1) {
            return true;
        } else {
            return false;
        }
    }
}
function getName($table, $id, $type = 0, $name = 'name', $id_name = '', $db = db)
{
    $conn = OpenCon($db);
    $query = "SELECT * FROM $table where id=" . $id;
    if ($table == 'groups') {
        $query = "SELECT * FROM $table where group_id=" . $id;
    }
    if ($table == 'customers') {
        $query = "SELECT * FROM $table where contact_id='" . $id . "'";
    }
    if (!empty($id_name)) {
        $query = "SELECT * FROM $table where $id_name='" . $id . "'";
    }
    $name_result = $conn->query($query);

    if ($name_result->num_rows > 0) {
        $row = $name_result->fetch_assoc();
        if ($type == 0) {
            echo $row[$name];
        }
        if ($type == 1) {
            return $row[$name];
        }
        if ($type == 2) {
            return $row;
        }
    }

    mysqli_close($conn);
}
function getRow($table, $id, $name = '', $where_clause = '', $type = 0, $db = db)
{
    $conn = OpenCon($db);

    if ($table == 'profile') {
        $query = "SELECT * FROM $table where u_id=" . $id;
    } else {
        $query = "SELECT * FROM $table where id=" . $id;
    }

    $whereSQL = '';
    if (!empty($where_clause)) {
        $whereSQL = " " . trim($where_clause);
        $query = "SELECT * FROM $table $whereSQL";
        // echo"<br>";
        // $name_result = $conn->query($query);
        // return $name_result;
    }
    if ($table == 'users') {
        // echo $query;
    }
    $name_result = $conn->query($query);
    if (isset($name_result->num_rows)) {
        if ($name_result->num_rows > 0) {
            $row = $name_result->fetch_assoc();
            if ($type == 0) {
                echo $row[$name];
            }
            if ($type == 1) {
                return $row[$name];
            }
            if ($type == 2) {
                return $row;
            }
        }
    }
    mysqli_close($conn);
}
function lastId($table_name, $db = db)
{
    $conn = OpenCon($db);
    $query = "SELECT id FROM $table_name ORDER BY id DESC LIMIT 1";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        die('Could not query:' . mysqli_error($conn));
    }
    $id = mysqli_fetch_assoc($result);
    return $id;
    mysqli_close($conn);
}

function table_sum($table, $col, $limits = '', $db = db)
{
    $conn = OpenCon($db);
    $sum_q = "SELECT *, SUM($col) AS Total FROM $table WHERE MONTH(date) = MONTH(CURDATE()) AND status=1 ORDER BY Total DESC";
    if ($limits != "") {
        $sum_q .= " LIMIT " . $limits;
    }
    $sum_run = mysqli_query($conn, $sum_q);
    return $sum_run;
    mysqli_close($conn);
}
function progress($value, $max, $type = 0)
{
    $max = $max;

    $value = $value;

    $scale = 1.0;

    if (!empty($max)) {
        $percent = ($value * 100) / $max;
    } else {
        $percent = 0;
    }

    // Limit to 100 percent (if more than the max is allowed)

    if ($percent > 100) {
        $percent = 100;
    }
    if ($type) {
        return number_format($percent, 2);
    } else {
        echo number_format($percent, 2);
    }
}
function colSum($table, $col, $where_clause = '', $db = db)
{
    $conn = OpenCon($db);
    $sum_q = "SELECT SUM($col) AS Total FROM $table";
    if ($where_clause != "") {
        $sum_q .= " WHERE " . $where_clause;
    }
    if ($table == "report") {
        // echo $sum_q."<br>";
    }
    $sum_run = mysqli_query($conn, $sum_q);
    return $sum_run;
    mysqli_close($conn);
}
function getTotal($table, $col, $where_clause = '', $db = db)
{
    $Total = 0;
    $query = "SELECT SUM($col) AS Total FROM $table";
    if ($where_clause != "") {
        $query .= " WHERE " . $where_clause;
    }
    $excute = queryRun($query, 3, $db);
    if ($excute->num_rows > 0) {
        $tot = $excute->fetch_assoc();
        if (isset($tot['Total'])) {
            $Total = $tot['Total'];
        }
    }
    return $Total;
}
// permissions
function isPermMode($role, $ModuleKey)
{
    $perFetch = dbAction('permission_role', 4, '', 'role_id=' . $role);
    if ($perFetch->num_rows > 0) {
        $isPerm = array();
        foreach ($perFetch as $permData) {
            $permName = getRow('permissions', $permData['permission_id'], 'name', '', 1);
            // print_r($permName);
            if (!empty($permName)) {
                $fileName = strtolower($permName);
                $first_name = explode("-", $fileName);
                if (isset($first_name[0])) {
                    $fileName = $first_name[0];
                }
                // echo strtolower($fileName) . "=" . strtolower($ModuleKey) . "<br>";
                if (strtolower($fileName) == strtolower($ModuleKey)) {
                    if ($permData['isRead'] == 1) {
                        //echo $permData['isRead'];
                        $isPerm[] = "1";
                    } else {
                        $isPerm[] = "0";
                    }
                    if ($permData['isWrite'] == 1) {
                        $isPerm[] = "1";
                    } else {
                        $isPerm[] = "0";
                    }

                    if ($permData['isEdit'] == 1) {
                        $isPerm[] = "1";
                    } else {
                        $isPerm[] = "0";
                    }

                    if ($permData['isDelete'] == 1) {
                        $isPerm[] = "1";
                    } else {
                        $isPerm[] = "0";
                    }
                }
            }
        }
        return $isPerm;
        //print_r($isPerm);
    }
}
function mgs($mgs = 'Action Permormed Successfully!', $key = 1)
{
    if ($key) {
        echo '<div class="alert alert-success alert-dismissible text-sm"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="icon fa fa-check"></i> ' . $mgs . '</div>';
    } else {
        echo '<div class="alert alert-danger alert-dismissible text-sm"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="icon fa fa-ban"></i> ' . $mgs . '</div>';
    }
}
function alert($mgs = 'Action Permormed Successfully!', $key = 1)
{
    if ($key) {
        $icon = "success";
    } else {
        $icon = "error";
    } ?>
    <script>
        $(function() {
            const Toast = Swal.mixin({
                toast: true,
                position: 'top',
                showConfirmButton: false,
                timer: 3000
            });

            $('.swalDefaultSuccess').click(function() {
                Toast.fire({
                    icon: <?php echo $icon; ?>,
                    title: <?php echo $mgs; ?>
                })
            });
        });
    </script>
    <?php
}
function isModCheck($name)
{
    $name = strtolower($name);
    $first_name = explode("-", $name);
    if (isset($first_name[0])) {
        $name = $first_name[0];
    }
    if ($name != 'permissions') {
        $query = "SELECT * from permissions where name='" . $name . "' AND status=1";
        // echo $query;
        $check_mod = queryRun($query, 3);
        if ($check_mod->num_rows > 0) {
            $row = $check_mod->fetch_assoc();
            return true;
        } else {
            return false;
        }
    } else {
        return true;
    }
}
function getModal($page = "", $editId = "", $row = [])
{
    $page = str_replace("_", "-", $page);
    if (!empty($editId)) {
        $action_name = "Edit";
        echo '<div class="modal fade in show" style="display:block" id="module_pop_"' . $editId . ' aria-modal="true">';
    } else {
        $action_name = "Add New";
        echo '<div class="modal fade in" id="module_pop">';
    }
    echo '<div class="modal-dialog modal-lg modal-dialog-scrollable">';
    echo '<div class="modal-content">';
    echo '<div class="modal-header">';
    echo "<h4 class='card-title'>" . $action_name . " " . ucfirst($page) . "</h4>";
    if (!empty($editId)) {
        echo '<a href="?page=' . $page . '" class="close">x</a>';
    } else {
        echo '<button type="button" class="close" data-dismiss="modal" aria-label="Close">x</button>';
    }
    echo '</div>';
    echo '<div class="modal-body">';
    // update
    if (!empty($editId)) {
        cred($page, @$_POST, $editId);
    }
    echo '<form method="post">';
    if (!empty($page)) {
        require_once('pages/forms/' . $page . '.php');
    }
    echo '</div>';
    echo '<div class="modal-footer">';
    if (!empty($editId)) {
        echo '<input type="submit" name="update" value="Update ' . ucfirst($page) . '" class="btn btn-info">';
    } else {
        echo '<input type="submit" name="addNew" value="Add ' . ucfirst($page) . '" class="btn btn-primary">';
    }
    echo '</div>';
    echo '</form>';
    echo '</div>';
    //modal-content
    echo '</div>';
    // .modal-dialog
    echo '</div>';
}
function cred($table, $data, $upid = "")
{
    // echo $table;
    if (count($data) > 0) {
        $redirect = BASE . "admin.php?page=" . @$_GET['page'];
        if (isset($data['addNew'])) {
            if (isset($_POST['addNew'])) {
                $extra = array("date" => date("Y-m-d h:i:s"));
                $data = array_merge($data, $extra);
                unset($data['addNew']);
                // only for report table
                // echo $smsbody = "Sales Report as on " . $data['report_date'] . ", Total Sale Collections. AED00, Total Sale Orders. AED" . $_POST['so'] . ", Submitted by " . $data['user_name'] . "\n" . store;
                if ($table == "report") {
                    if (!empty($data['report_date']) and $data['report_date'] <= date('Y-m-d')) {
                        $checkReport = dbAction($table, 4, "", "report_date='" . $data['report_date'] . "' AND uid=" . $data['uid']);
                        if ($checkReport->num_rows > 0) {
                            mgs("Report Already Submitted!", 0);
                        } else {
                            $maintSt = dbAction($table, 1, $data, "");
                            if ($maintSt[0]) {
                                $total_sales = $_POST['sale_cash'] + $_POST['sale_card'] + $_POST['sale_online'];
                                $sub = "Sales Report submitted by " . $_POST['user_name'] . "-" . $_POST['uid'];
                                $titleSub = 'Report submitted by' . $_POST['user_name'] . '-' . $_POST['uid'] . '<br>Date: ' . $_POST['report_date'];
                                $htmlcontent = '<table border="1" cellspacing="collapse" cellpadding="4" style="border-collapse: collapse;width:100%">
                                <thead>
                                    <tr style="background: #eee;">
                                        <th >Sale Cash</th>
                                        <th >Sale Card</th>
                                        <th >Sale Online</th>
                                        <th >Expenses</th>
                                        <th >Total Sales</th>
                                        <th >Total SO</th>
                                        <th >Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                    <td>' . $_POST['sale_cash'] . '</td>
                                    <td>' . $_POST['sale_card'] . '</td>
                                    <td>' . $_POST['sale_online'] . '</td>
                                    <td>' . $_POST['expenses'] . '</td>
                                    <td>' . $total_sales . '</td>
                                    <td>' . $_POST['so'] . '</td>
                                    <td>' . $_POST['report_date'] . '</td>
                                    </tr>
                                </tbody>
                            </table>';
                                // echo $htmlcontent;
                                $htmlbody = email_template($htmlcontent, $titleSub);
                                $mailcheck = sendmail(adminEmail, $sub, $htmlbody, '', "");
                                // @sendmail('rahulphp6@gmail.com', $sub, $htmlbody, '', "");
                                if (!$mailcheck) {
                                    mgs("Email didn't sent!", 0);
                                }
                                // sms
                                $smsbody = "Sales Report as on " . $data['report_date'] . ", Total Sale Collections. AED" . $total_sales . ", Total Sale Orders. AED" . $_POST['so'] . ", Submitted by " . $data['user_name'] . "\n" . store;
                                $wpbody = "Sales Report as on " . $data['report_date'] . ", Total Sale Amount. AED" . $total_sales . ", Total Sale Orders. AED" . $_POST['so'] . ", Submitted by " . $data['user_name'] . " " . store;
                                if (!empty(adminPhone)) {
                                    $smsCheck = smsApi(adminPhone, $smsbody);
                                    $smsCheck = json_decode($smsCheck);
                                    if (isset($smsCheck->message)) {
                                        mgs($smsCheck->message, 0);
                                    }
                                }
                                multiSms(multi_ph, $smsbody);
                                if (!empty(multi_ph)) {
                                    $phonsAr = explode(",", multi_ph);
                                    foreach ($phonsAr as $phm) {
                                        $smsCheck = smsApi($phm, $smsbody);
                                        $smsCheck = json_decode($smsCheck);
                                        if (isset($smsCheck->message)) {
                                            mgs($smsCheck->message, 0);
                                        }
                                    }
                                }
                                // end
                                mgs("Submitted Successfully!");
                                echo "<div class='whatsapp_box'><a href='https://wa.me/" . adminPhone . "?text=" . urlencode($wpbody) . "' class='btn btn-primary btn-lg'><i class='fa fa-whatsapp'></i> Submit Report on WhatsApp</a>";
                                echo " <a href='' class='btn btn-secondary btn-lg'>Go Back</a></div>";
                                // echo "<script>alert('Submitted Successfully!')</script>";
                                //echo "<script>window.location.href=''</script>";
                            } else {
                                mgs($maintSt[1], 0);
                            }
                        }
                    } else {
                        mgs("Report date must be less than from future date or shouldn't be empty!", 0);
                    }
                } else {
                    $maintSt = dbAction($table, 1, $data, "");
                    if ($maintSt[0]) {
                        echo "<script>alert('Submitted Successfully!')</script>";
                        echo "<script>window.location.href='$redirect'</script>";
                    } else {
                        mgs($maintSt[1], 0);
                    }
                }
            }
        }
        if (isset($_POST['update'])) {
            $extra = array("date" => date("Y-m-d h:i:s"));
            $data = array_merge($data, $extra);
            unset($data['update']);
            $maintSt = dbAction($table, 2, $data, 'id=' . $upid);
            if ($maintSt[0]) {
                if ($table == "report") {
                    // sms
                    if (!empty(adminPhone)) {
                        $upsms = "Report Updated by " . $data['user_name'] . "-" . $data['uid'] . "\nSales report editing date as on " . date("Y-m-d h:i:s") . ", Total updated Sale Amount of AED." . $data['total_cash'] . "\n" . store;
                        // $upsms = "Report Updated by " . $data['user_name'] . "-" . $data['uid'] . " Report id:" . $upid . "\nTotal Sale:" . $data['total_cash'] . "\n" . store;
                        $smsCheck = smsApi(adminPhone, $upsms);
                        $smsCheck = json_decode($smsCheck);
                        if (isset($smsCheck->message)) {
                            mgs($smsCheck->message, 0);
                        }
                    }
                    multiSms(multi_ph, $smsCheck);
                    // end
                }
                // mgs('Updated Successfully!');
                echo "<script>alert('Updated Successfully!')</script>";
                echo "<script>window.location.href='$redirect'</script>";
            } else {
                mgs($maintSt[1], 0);
            }
        }
        if (isset($_POST['deleteRun'])) {
            if ($table == 'sales') {
                $table = 'salesorders';
            }
            if ($table == 'invoice') {
                $table = 'invoices';
            }
            $deleteRun = dbAction($table, 3, '', 'id=' . $data['did']);
            if ($deleteRun[0] == 1) {
                echo "<script>alert('Deleted Successfully!')</script>";
                echo "<script>window.location.href='" . $redirect . "'</script>";
            } else {
                mgs($deleteRun[1], 0);
            }
        }
    }
}
function getActions($id, $isE = 1, $isD = 1, $isB = 1, $status = 1)
{
    echo '<div class="btn-group">';
    if ($isE) {
        if (checkUser()) {
            echo '<a href="?page=report&pro_id=' . $id . '&model=1" class="btn btn-primary btn-xs"><i class="fa fa-edit nav-icon"></i></a>';
        } else {
            echo '<a href="?page=' . $_GET['page'] . '&pro_id=' . $id . '&model=1" class="btn btn-primary btn-xs"><i class="fa fa-edit nav-icon"></i></a>';
        }
    }
    if ($isD) { ?>
        <form method="post" class="btnForm">
            <input type="hidden" name="did" value="<?php echo $id; ?>">
            <button type="submit" title="Delete this record" onclick="return confirm('Are You Sure?')" name="deleteRun" class="btn btn-danger btn-xs"><i class="fa fa-trash nav-icon"></i></button>
        </form>
    <?php } ?>

    <?php
    if ($status == 1) {
        $block = "name='Block' value='Block' class='btn btn-danger btn-xs' title='you can block this'";
    } else {
        $block = "name='Block' value='UnBlock' class='btn btn-success btn-xs' title='you can unblock this'";
    }
    if ($isB) {
    ?>
        <form method="post" class="btnForm">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <input type="hidden" name="status" value="<?php echo $status; ?>">
            <button type="submit" <?php echo $block; ?>><i class="fa fa-ban nav-icon"></i></button>
        </form>
    <?php } ?>
    </div>
<?php
}
function is_write($isW = 0)
{
    if (!$isW) {
        echo "<script>window.location.href='?page=404&error=permission'</script>";
    }
}
// added new
function dateFormate($date = "", $format = "d-M-Y", $type = 0)
{

    if (!empty($date)) {
        $source = $date;
        $date = new DateTime($source);
        $date = $date->format($format);
        if ($type == 1) {
            return $date;
        } else {
            echo $date;
        }
    }
}