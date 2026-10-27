<div class="container">
    <div class="row">
        <div class="col-md-6 col-sm-6 mb-4">
            <div class="stats-small stats-small--1 card card-small">
                <div class="card-header">
                    <h3 class="card-title">Mail Configure</h3>
                </div>
                <div class="card-body">
                    <?php
                    //echo base64_decode('');
                    if (isset($_POST['setMail'])) {
                        $mailAr = array("host" => $_POST['host'], "port" => $_POST['port'], "user" => $_POST['user'], "pwd" => base64_encode($_POST['pwd']));
                        $mailData = dbAction('smtp', 2, $mailAr);
                        if ($mailData[0] == true) {
                            mgs('SMTP Updated successfully');
                        } else {
                            mgs($mailData[1], 0);
                        }
                    }
                    $smtpData = dbAction('smtp', 4, '', 'status=1');
                    if ($smtpData->num_rows > 0) {
                        $smtpRow = $smtpData->fetch_assoc();
                    }
                    ?>
                    <form method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label>Host</label>
                                    <input type="text" name="host" class="form-control" value="<?php if (isset($smtpRow)) {
                                                                                                    echo $smtpRow['host'];
                                                                                                } ?>" placeholder="mail.gmail.com">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Port</label>
                                    <input type="number" name="port" class="form-control" value="<?php if (isset($smtpRow)) {
                                                                                                        echo $smtpRow['port'];
                                                                                                    } ?>" placeholder="465">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>User</label>
                                    <input type="email" name="user" value="<?php if (isset($smtpRow)) {
                                                                                echo $smtpRow['user'];
                                                                            } ?>" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" name="pwd" value="<?php if (isset($smtpRow)) {
                                                                                    echo $smtpRow['pwd'];
                                                                                } ?>" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="col-md-12">
                            <input type="submit" name="setMail" class="btn btn-primary" value="Update">
                        </div>
                        <div class="gap"></div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-sm-6 mb-4">
        </div>
    </div>