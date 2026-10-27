<?php
function dropdown($name = null, $table = null, $title = null, $tblID = 0, $col_name = "name", $store = 1, $return_name = 0, $db = db)

{
  $param = "status=1";
  if ($store) {
    $param .= " AND store=" . organizationId;
  }
  if ($return_name) {
    $disabled = "disabled";
    $class = "branch_select";
    $label = "";
  } else {
    $disabled = "";
    $class = "form-control";
    $label = '';
    if (!empty($title)) {
      $label = "<label>$title</label>";
    }
  }
  $query = "SELECT * FROM $table WHERE $param GROUP by $name";
  $AssetCode = queryRun($query, 3, $db);
  echo '' . $label . '<select ' . $disabled . ' class="' . $class . '" name="' . $name . '" id="' . $name . '">';

  if ($AssetCode->num_rows > 0) {

    echo '<option value="">--' . $title . '--</option>';
    foreach ($AssetCode as $tableRow) {
      if ($tableRow[$name] == $tblID) {
        echo '<option value="' . $tableRow[$name] . '" selected>' . $tableRow[$col_name] . '</option>';
      } else {
        echo '<option value="' . $tableRow[$name] . '">' . $tableRow[$col_name] . '</option>';
      }
    }
  }

  echo '</select>';
}
function elements($key = 0, $table = "", $tblID = 0)

{

  $elements = array('role' => "User Role", 'depid' => "Department Name");

  if ($table == "roles") {
    $locData = dbAction($table, 4, '', 'id>2 AND status=1 ');
  } else {
    $locData = dbAction($table, 4, '', 'status=1 ', 0);
  }

  echo '<div class="form-group">';
  if (isset($elements[$key])) {
    echo '<label>' . $elements[$key] . '</label>';
  }
  echo '<select class="form-control select2bs4 ' . $key . '" name="' . $key . '" id="' . $key . '" required style="width:100%">';
  if ($locData->num_rows > 0) {
    echo '<option value="">--Choose Name--</option>';
    foreach ($locData as $locRow) {

      if ($locRow['id'] == $tblID) {

        echo '<option value="' . $locRow['id'] . '" selected user_id="' . $locRow['user_id'] . '">' . $locRow['name'] . '</option>';
      } else {

        echo '<option value="' . $locRow['id'] . '" user_id="' . $locRow['user_id'] . '">' . $locRow['name'] . '</option>';
      }
    }
  }

  echo '</select></div>';
}

function diffElement($name = "", $table = "", $title = "", $tblID = 0)

{

  $nameDb = $name;

  if ($table == "customers") {

    $name = "userId";

    $nameDb = "name";

?>

    <span id="assStatus"></span>

    <div id="assData"></div>

    <script>
      $(document).ready(function() {

        $("#userId").change(function() {



          var userId = $('#userId').val();

          $.ajax({

            url: 'core/dynamic-data.php',

            type: 'post',

            data: {

              userId: userId

            },

            beforeSend: function() {

              $('#tokenStatus').html('<i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i><span class="sr-only">Loading...</span>');

            },

            success: function(response) {

              $('#assStatus').empty();

              $('#assData').html(response);



              //document.getElementById("assData").innerhtml= response;

            },

            complete: function(data) {

              $("#loader").hide();

            }

          });



        });

      });
    </script>

<?php

  }

  if ($table == "users") {

    $name = "userid";

    $nameDb = "name";
  }

  if ($table == "roles") {

    $name = "roleid";

    $nameDb = "name";
  }

  if ($table == "employee") {

    $name = "empid";

    $nameDb = "name";
  }


  if ($table == "roles") {
    $AssetCode = dbAction($table, 4, '', 'status=1');
  } else {
    $AssetCode = dbAction($table, 4, '', 'status=1 ');
  }

  echo '<div class="form-group"><label>' . $title . '</label><select class="form-control select2bs4" name="' . $name . '" id="' . $name . '" required="">';

  if ($AssetCode->num_rows > 0) {

    if ($tblID == 0) {

      echo '<option value="0">--Choose--</option>';
    }

    foreach ($AssetCode as $tableRow) {
      if ($tableRow['id'] == $tblID) {

        echo '<option value="' . $tableRow['id'] . '" selected>' . $tableRow[$nameDb] . '</option>';
      }

      echo '<option value="' . $tableRow['id'] . '">' . $tableRow[$nameDb] . '</option>';
    }
  }

  echo '</select></div>';
}

function selectElement($name = "", $table = "", $title = "", $tblID = 0, $searching = 0)

{

  $nameDb = 'name';
  $select2bs4 = '';
  $AssetCode = dbAction($table, 4, '', 'status=1');
  if ($searching == 1) {
    $select2bs4 = 'select2bs4';
  }
  echo '<div class="form-group"><label>' . $title . '</label>

  <select class="form-control ' . $select2bs4 . '" name="' . $name . '" id="' . $name . '">';

  if ($AssetCode->num_rows > 0) {

    if ($tblID == 0) {

      echo '<option value="">--Select Option--</option>';
    }

    foreach ($AssetCode as $tableRow) {

      if ($tableRow['id'] == $tblID) {

        echo '<option value="' . $tableRow['id'] . '" selected>' . $tableRow[$nameDb] . '</option>';
      }

      echo '<option value="' . $tableRow['id'] . '">' . $tableRow[$nameDb] . '</option>';
    }
  }

  echo '</select></div>';
}
function userDt($name = "user_id", $table = "", $title = "", $tblID = 0)

{

  $AssetCode = dbAction("users", 4, '', 'role>3 AND status=1 ');

  echo '<div class="form-group"><label>' . $title . '</label>

  <select class="form-control select2bs4" name="' . $name . '" id="' . $name . '_pos">';

  if ($AssetCode->num_rows > 0) {

    if ($tblID == 0) {

      echo '<option value="">--Select Option--</option>';
    }

    foreach ($AssetCode as $tableRow) {

      if ($tableRow['user_id'] == $tblID) {

        echo '<option value="' . $tableRow['user_id'] . '" selected>' . $tableRow['name'] . '</option>';
      }

      echo '<option value="' . $tableRow['user_id'] . '">' . $tableRow['name'] . '</option>';
    }
  }

  echo '</select></div>';
}

function imgUpload($fileName = "", $folder = "")

{

  $fileData = $_FILES[$fileName];

  if (isset($fileData)) {

    if (!empty($fileData["name"])) {

      $allowedExts = array("jpg", "jpeg", "png");
      // $allowedExts = array("jpg", "jpeg", "png","pdf","doc","docx","","xls");
      $nameOfimg = str_replace(" ", "-", $fileData["name"]);

      $tmp = $fileData["tmp_name"];

      $orginal = $fileData["name"];



      $type = strtolower($orginal);

      $type = str_replace(" ", "-", $type);

      $extArray = explode(".", $type);

      $extension = $extArray[1];

      $name = $extArray[0] . "." . $extension;



      $target_dir = "upload/" . $folder . "/" . $extArray[0] . "/";

      if (!file_exists($target_dir)) {
        mkdir($target_dir, 0777, true);
      }
      $target_file = $target_dir . $name;

      if (in_array($extension, $allowedExts)) {

        $fileC = trim($target_file);

        move_uploaded_file($tmp, $target_file);

        return $fileC;
      }
    }
  }
}

function brandLogo($fileName = "", $folder = "")

{

  $fileData = $_FILES[$fileName];

  //print_r($fileData);

  if (isset($fileData)) {

    if (!empty($fileData["name"])) {

      $allowedExts = array("jpg", "jpeg", "png");

      // $allowedExts = array("jpg", "jpeg", "png","pdf","doc","docx","","xls");



      $nameOfimg = str_replace(" ", "-", $_POST["brandName"]);

      $nameOfimg = str_replace("_", "-", $nameOfimg);

      $nameOfimg = str_replace("®", "-", $nameOfimg);

      $tmp = $fileData["tmp_name"];

      $orginal = $fileData["name"];



      $type = strtolower($orginal);

      $type = str_replace(" ", "-", $type);

      $extArray = explode(".", $type);

      $extension = $extArray[1];

      $name = $nameOfimg . "." . $extension;



      $target_dir = "../upload/brands/";

      // if (!file_exists($target_dir)){

      //     mkdir($target_dir, 0777, true);

      //   }

      $target_file = $target_dir . strtolower($name);

      if (in_array($extension, $allowedExts)) {

        $fileC = trim($target_file);

        move_uploaded_file($tmp, $target_file);

        return $fileC;
      }
    }
  }
}

function uploadMF($fileName = "", $folder = "", $keys = "")

{

  $fileData = $_FILES[$fileName];

  if (isset($fileData)) {

    if (!empty($fileData["name"][$keys])) {

      $allowedExts = array("jpg", "jpeg", "png");

      // $allowedExts = array("jpg", "jpeg", "png","pdf","doc","docx","","xls");

      $nameOfimg = str_replace(" ", "-", $fileData["name"][$keys]);

      $tmp = $fileData["tmp_name"][$keys];

      $orginal = $fileData["name"][$keys];



      $type = strtolower($orginal);

      $type = str_replace(" ", "-", $type);

      $extArray = explode(".", $type);

      $extension = $extArray[1];

      $name = $extArray[0] . "." . $extension;



      $target_dir = "../upload/" . $folder . "/";

      if (!file_exists($target_dir)) {

        mkdir($target_dir, 0777, true);
      }



      $target_file = $target_dir . $name;

      if (in_array($extension, $allowedExts)) {

        $fileC = filter_var($target_file, FILTER_SANITIZE_STRING);

        move_uploaded_file($tmp, $target_file);

        return $fileC;
      }
    }
  } else {

    return false;
  }
}

function filesUpload($name = "")

{

  echo '<div class="form-group">

              <label>Upload Files</label>

              <div class="input-group">

                <div class="custom-file">

                  <input type="file" class="custom-file-input" id="Upload" name="' . $name . '[]" multiple>

                  <label class="custom-file-label" for="Upload">Choose file</label>

                </div>

              </div>

            </div>';
}



function input($name = "", $type = "text", $val = "", $attr = "")

{

  if (!empty($val)) {

    $value = "value='" . $val . "'";

    $date = explode(" ", $val);

    $date = "value='" . $date[0] . "'";
  } else {

    $value = "";

    $date = "";
  }

  $label = ucwords($name);

  $name = str_replace(" ", "_", $name);

  switch ($type) {

    case 'textarea':

      echo '<div class="form-group">

                    <label>' . $label . '</label>

                    <textarea row="3" name="' . $name . '" id="' . $name . '" class="form-control ' . $name . '" ' . $attr . '>' . $val . '</textarea>

                  </div>';

      break;

    case 'date':

      echo '<div class="form-group">

        <label>' . $label . '</label>

        <input type="' . $type . '" name="' . $name . '" id="' . $name . '" class="form-control ' . $name . '" ' . $date . ' ' . $attr . '>

      </div>';

      break;



    default:

      echo '<div class="form-group">

      <label>' . $label . '</label>

      <input type="' . $type . '" name="' . $name . '" id="' . $name . '" class="form-control ' . $name . '" ' . $value . ' ' . $attr . ' placeholder="' . $label . '">

    </div>';

      break;
  }
}
function orderType($org = "imaxee", $type = "sales")
{
  $imaxxe_sales = ['Sales (Cash)', 'Sales (Credit)', 'Sales (FOC)', 'Replacement (Warranty Claim)', 'Billing Expenses'];
  $imaxxe_invoice = ['Sales (Cash)', 'Sales (Credit)', 'Sales (FOC)', 'Replacement (Warranty Claim)', 'Billing Expenses'];
  $opti_sales = ['Insurance Sale - Reimbursement', 'Cash Sale', 'Insurance Sale - Cashless', 'Billing Expense',];
  $opti_invoice = ['Insurance Sale - Reimbursement', 'Cash Sale', 'Insurance Sale - Cashless', 'Billing Expense',];
  $ispexe_sales = ['Insurance Sale - Reimbursement', 'Cash Sale', 'Billing Expense', 'Online Sales'];
  $ispexe_invoice = ['Insurance Sale - Reimbursement', 'Cash Sale', 'Billing Expense', 'Online Sales'];
  if (organizationId == 704774487) {
    if ($type == "sales") {
      $options = $opti_sales;
    } else {
      $options = $opti_invoice;
    }
    foreach ($options as $row) {
      echo '<option>' . $row . '</option>';
    }
  }
  if (organizationId == 705054324) {
    if ($type == "sales") {
      $options = $imaxxe_sales;
    } else {
      $options = $imaxxe_invoice;
    }
    foreach ($options as $row) {
      echo '<option>' . $row . '</option>';
    }
  }
  if (organizationId == 772285939) {
    if ($type == "sales") {
      $options = $ispexe_sales;
    } else {
      $options = $ispexe_invoice;
    }
    foreach ($options as $row) {
      echo '<option>' . $row . '</option>';
    }
  }
}

function attachment($fileName = "", $folder = "")

{

  $fileData = $_FILES[$fileName];

  if (isset($fileData)) {

    if (!empty($fileData["name"])) {

      // $allowedExts = array("jpg", "jpeg", "png");

      $allowedExts = array("jpg", "jpeg", "png", "pdf", "doc", "docx", "", "xls", "txt");



      $nameOfimg = str_replace(" ", "-", $fileData["name"]);

      $tmp = $fileData["tmp_name"];

      $orginal = $fileData["name"];



      $type = strtolower($orginal);

      $type = str_replace(" ", "-", $type);

      $extArray = explode(".", $type);

      $extension = $extArray[1];

      $name = $extArray[0] . "." . $extension;



      $target_dir = "pages/" . $folder . "/";

      if (!file_exists($target_dir)) {

        mkdir($target_dir, 0777, true);
      }



      $target_file = $target_dir . $name;

      if (in_array($extension, $allowedExts)) {

        $fileC = filter_var($target_file, FILTER_SANITIZE_STRING);

        move_uploaded_file($tmp, $target_file);

        return $fileC;
      }
    }
  }
}
function attachments($fileName = "", $folder = "", $keys = "")

{

  $fileData = $_FILES[$fileName];

  if (isset($fileData)) {

    if (!empty($fileData["name"][$keys])) {

      // $allowedExts = array("jpg", "jpeg", "png");

      $allowedExts = array("jpg", "jpeg", "png", "pdf", "doc", "docx", "", "xls", "txt");

      $nameOfimg = str_replace(" ", "-", $fileData["name"][$keys]);

      $tmp = $fileData["tmp_name"][$keys];

      $orginal = $fileData["name"][$keys];


      $name = img_name_str($orginal);
      // $type = strtolower($orginal);
      // $type = str_replace(" ", "-", $type);
      $extArray = explode(".", $name);
      $extension = $extArray[1];

      // $name = $extArray[0] . "." . $extension;



      $target_dir = "pages/" . $folder . "/";

      if (!file_exists($target_dir)) {

        mkdir($target_dir, 0777, true);
      }



      $target_file = $target_dir . $name;

      if (in_array($extension, $allowedExts)) {

        $fileC = filter_var($target_file, FILTER_SANITIZE_STRING);

        move_uploaded_file($tmp, $target_file);

        return $fileC;
      }
    }
  } else {

    return false;
  }
}
function img_name_str($name_with_extention)
{
  $type = strtolower($name_with_extention);

  $type = str_replace(" ", "-", $type);

  $extArray = explode(".", $type);

  $extension = $extArray[1];

  $name = $extArray[0] . "." . $extension;
  return $name;
}
?>