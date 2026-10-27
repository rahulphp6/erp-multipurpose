
<!-- Main content -->
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-6">
        <div class="card">
            <div class="card-body">
              
              <?php
                if (isset($_POST['assignToMan'])) {

                  $assignAr=array("assignTo"=>$_POST['userid']);
                   $dataAss=dbAction('assetsentry',2,$assignAr,'LocationId='.$_POST['LocationId'].' AND manId='.$_POST['manId']);
                   if ($dataAss[0]==1) {
                     mgs('Data Assigned Successfully');
                   }else{
                      mgs($dataAss[1],0);
                   }
                }
                ?>
              <h5><i class="fa fa-exchange input-icon"></i> Assign Assets Data</h5>
              <hr>
              <form method="post" enctype="multipart/form-data">
                <div class="row">
                  <div class="col-md-12">
                    <?php 
                  if(isset($acceptanceEid)){elements("LocationId","locations",$assetRow['LocationId']);}else{elements("LocationId","locations");}
                   ?>
                  </div>
                  <div class="col-md-12">
                    <?php if(isset($assetEid)){diffElement("manId","manufacturer","Manufacturer Name",$assetRow['manId']);}else{diffElement("manId","manufacturer","Manufacturer Name");} ?>
                  </div>
                  <div class="col-md-12">
                    <?php diffElement("userid","users","Assign To"); ?>
                  </div>
                  <div class="col-md-12">
                    <input type="submit" name="assignToMan" class="btn btn-primary" value="Assign Manufacturer">
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>