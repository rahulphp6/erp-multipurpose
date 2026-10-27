
<!-- Main content -->
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-6">
        <div class="card">
            <div class="card-body">
              <h5><i class="fa fa-globe input-icon"></i> Search Asset</h5>
              <hr>
              <form method="post" enctype="multipart/form-data" action="?page=search">
                <div class="row">
                  <div class="col-md-12">
                     <?php
                      if(isset($assetEid)){diffElement("assetId","assetsentry","Asset Name",$assetRow['assetId']);}else{diffElement("assetId","assetsentry","Asset Name");}
                      ?>
                  </div>
                  <div class="col-md-12">
                    <input type="submit" name="searchAsset" class="btn btn-primary" value="Search Asset">
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>