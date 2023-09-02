<?php 
include 'include/config.php';

?>
<!DOCTYPE html>
<html>

<head>
    <title>Supplier Invoice</title>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.1/mdb.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    

</head>

<body>

<div class="container">
    <div class="row mt-5">
        <div class="col-md-4 m-auto">
            <div class="form-group mb-4">
                <label for=""><a href="invoice_list.php" class="btn-sm btn btn-primary">Invoice List</a></label>
            </div>
        </div>
    </div>
</div>


<form id="form-data" action="include/invoice_create.php" enctype="multipart/form-data" method="POST">
        <div class="row">
            <div class="col-md-4 p-4">
                <div class="from-group">
                    <label for="">Supplier Name</label>
                    <select name="supplier_name" id="supplier_name" class="form-select">
                        <option value="">Select</option>
                        <?php 
                                    
                            if ($allSupplier=$con->query("SELECT * FROM supplier")) {
                                while ($rows=$allSupplier->fetch_array()) {
                                    echo '<option value="'.$rows['supplier_name'].'">'.$rows['supplier_name'].'</option>';
                                }
                            }
                                
                        ?>
                    </select>
                </div>
            </div>
            
            <div class="col-md-12">
                <table class="table table-bordered" >
                    <thead class="bg-success text-white">
                        <th>Product List</th>
                        <th>Product Unit</th>
                        <th>Qty</th>
                        <th>Price</th>
                        <th>Discount</th>
                        <th>Total Price</th>
                        <th>Branch</th>
                        <th>Upload File</th>
                        <th></th>
                    </thead>
                    <tbody id="tableRow">
                      
                    </tbody>
                    <tfoot class="">
                        <tr>
                            <th class="text-center" colspan="8"></th>
                            <th class="text-left" colspan="9">
                            <button type="button" id="addRow" class="btn-sm btn btn-primary">Add Row</button>
                            </th>
                        </tr>
                        <tr>
                            <th class="text-center" colspan="5"></th>
                            <th class="text-left" colspan="6">
                                Total Amount <input class="form-control grand_total" name="total_amount" type="text">
                            </th>
                        </tr>
                        <tr>
                            <th class="text-center" colspan="5"></th>
                            <th class="text-left" colspan="6">
                                Paid Amount <input  class="form-control paid_amount" name="paid_amount" type="text">
                            </th>
                        </tr>
                        <tr>
                            <th class="text-center" colspan="5"></th>
                            <th class="text-left" colspan="6">
                                Due Amount <input  class="form-control due_amount" name="due_amount"
                                    type="text">
                            </th>
                        </tr>
                    </tfoot>
                </table>
                <div class="form-group text-center">
                    <button type="submit" id="payment-btn" class="btn btn-success"><i class="fe fe-dollar"></i> Create
                        Now</button>
                </div>
            </div>
        </div>
    </form>



    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    $('tbody').sortable();
    // Add a new row
    $("#addRow").click(function() {
        var newRow = `
            <tr>
                <td>
                    <select name="product_name[]" class="form-select product_name">
                        <option value="">Select</option>
                    </select>
                </td>
                <td>
                    <select name="product_unit[]" class="form-select product_unit">
                        <option value="KG">Kg</option>
                        <option value="pice">Pice</option>
                    </select>
                </td>
                <td><input type="text" name="qty[]" class="form-control qty" value="1"></td>
                <td><input type="number" name="price[]" class="form-control price" value=""></td>
                <td><input type="text" name="discount[]" class="form-control discount" value=""></td>
                <td><input type="number" name="total_price[]" class="form-control total_price" value=""></td>
                <td>
                    <select name="branch_id[]" class="form-select branch_id">
                        <option value="">Select</option>
                    </select>
                </td>
                <td><input type="file" name="upload_file[]" class="form-control" value=""></td>
                <td><button type="button" class="btn btn-danger removeRow">Remove</button></td>
            </tr>
        `;

        $("#tableRow").append(newRow);
        // Load product names
        loadProductNames(); 
        LoadBranchNames(); 
    });

    // Remove a row
    $(document).on('click', '.removeRow', function() {
        $(this).closest('tr').remove();
    });

    // Load product names into select boxes
    function loadProductNames() {
        $.ajax({
            url: "include/get_product.php",
            method: "POST",
            data: {
                getProduct: 0,
            },
            success: function(response) {
                var jsonData = JSON.parse(response);
                $(".product_name").empty();
                for (var i = 0; i < jsonData.length; i++) {
                    $(".product_name").append('<option value="' + jsonData[i].product_name + '">' + jsonData[i].product_name + '</option>');
                }
            }
        });
    }

   //load Branch names into select boxes
   //declare a array function 
   const LoadBranchNames=()=>{
        $.ajax({
            url: "include/Branch.php",
            method: "POST",
            data: {
                get_branch_data: 0,
            },
            success: function(response) {
                var jsonData = JSON.parse(response);
                $(".branch_id").empty();
                for (var i = 0; i < jsonData.length; i++) {
                    $(".branch_id").append('<option value="' + jsonData[i].branch_name + '">' + jsonData[i].branch_name + '</option>');
                }
            }
        });
   }



            $(document).on("change", "input", function() {
                    var row = $(this).closest("tr");
                    var qty = Number(row.find(".qty").val());
                    var price = Number(row.find(".price").val());
                    var discountInput = row.find(".discount");
                    var discountValue = discountInput.val();
                    var total_price = 0;

                    if (discountValue.endsWith("%")) { 
                        var discountPercentage = parseFloat(discountValue) / 100;
                        total_price = (qty * price) * (1 - discountPercentage);
                    } else { 
                        var discountAmount = parseFloat(discountValue);
                        total_price = (qty * price) - discountAmount;
                    }
                    
                    row.find(".total_price").val(total_price.toFixed(2)); 

                    getTotalAmount();
                });

            function getTotalAmount() {
                var grandTotal = 0;
                $("table").find("input.total_price").each(function() {
                    grandTotal += $(this).val() - 0;
                });
                $(".grand_total").val(grandTotal);
            }
            $(document).on('keyup', '.paid_amount', function() {
                var paid_amount = $('.paid_amount').val();
                var grand_total = $('.grand_total').val();
                var totalDue = Number(grand_total - paid_amount);
                $(".due_amount").val(totalDue);
            });



});
</script>



</body>

</html>