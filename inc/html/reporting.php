<form method="post" action="?page=report">
    <div class="form-group">
        <select class="form-control form-control-sm rounded-0" name="reporttable" id="reporttable">
            <option value="salesorders">Sales Orders</option>
            <option value="bills">Bills</option>
            <option value="invoices">invoices</option>
            <option value="vendorpayments">Vendor Payment</option>
            <option value="payments">Customer Payment</option>
            <option value="purchaseorders">Purchase Order</option>
            <option value="expenses">Expenses</option>
            <option value="banktransactions">Bank Transactions</option>
        </select>
    </div>
    <div class="form-group">
        <select class="select2bs4" multiple name="fields[]" id="table_fields">
            <option></option>
        </select>
    </div>
    <div class="form-group mb-0">
        <div class="input-group">
            <input type="date" class="form-control form-control-sm rounded-0" name="from" <?php if (isset($_POST['genreport'])) {
                                                                                                echo "value='" . $from . "'";
                                                                                            }else{echo "value='" .date('Y-m-01'). "'";} ?>>
            <input type="date" class="form-control form-control-sm rounded-0" name="to" <?php if (isset($_POST['genreport'])) {
                                                                                            echo "value='" . $to . "'";
                                                                                        }else{echo "value='" .date('Y-m-d'). "'";} ?>>
            <span class="input-group-append">
                <button type="submit" name="genreport" class="btn btn-sm btn-default btn-flat"><i class="fa fa-print"></i> Generate Report</button>
            </span>
        </div>

    </div>
</form>
<script>
    $(document).ready(function() {
        $("#reporttable").change(function() {
            var table = $(this).val();
            $.ajax({
                url: 'core/report.php',
                type: 'post',
                data: {
                    table_name: table
                },
                beforeSend: function() {
                    // $('#table_fields').html('<i class="fa fa-refresh fa-pulse fa-1x fa-fw"></i><span class="sr-only">Loading...</span>');
                },
                success: function(response) {
                    $('#table_fields').html(response);
                }
            });
        });
    });
</script>