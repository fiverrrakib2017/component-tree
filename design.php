
<?php 

include 'include/config.php';




?>
<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        <title>Welcome Our Website</title>
		
		<!-- Font Awesome -->
<link
  href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
  rel="stylesheet"
/>
<!-- Google Fonts -->
<link
  href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap"
  rel="stylesheet"
/>
<!-- MDB -->
<link
  href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.1/mdb.min.css"
  rel="stylesheet"
/>
    </head>
    <body>
	
		<!-- Main Wrapper -->
        <div class="main-wrapper">
		
			
			
			<!-- Page Wrapper -->
            <div class="page-wrapper">
                <div class="content container-fluid">
					
					 <div class="row d-flex">
                    <div class="col-md-12 m-auto">
                        <div class="row ">
                            <div class="col-md-12  ">
                                <div class="card card-body">
                                    <form id="form-data" action="include/invoice_create.php">
                                        
                                        <div class="form-group mb-2">
                                            <label>Product Name</label>
                                            <select type="text" id="product_name" class="form-control select2" style="width:100%">
                                            	<option>Select</option>
                                                <?php
                                                
                                                if ($allProducts=$con->query("SELECT * FROM products")) {
                                                    while ($rows=$allProducts->fetch_array()) {
                                                        echo '<option value="'.$rows['id'].'">'.$rows['product_name'].'</option>';
                                                    }
                                                }
                                                
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group mb-2">
                                            <label>Customer Name</label>
                                            <select type="text" id="customer_name" name="customer_name" class="form-control select2" style="width:100%">

                                                <option value="">Select</option>
                                                <option value="Rakib">Rakib</option>
                                                <option value="Shakib">Shakib</option>
                                                <option value="Jihad">Jihad</option>
                                                <option value="Mahid">Mahid</option>
                                               
                                            </select>

                                        </div>
                                        <div class="form-group mb-2">
                                            <label>Phone Number</label>
                                            <input type="text" id="phone_number" name="phone_number" class="form-control " style="width:100%" placeholder="Enter Phone Number" />

                                        </div>
                                        <div class="form-group mb-2">
                                            <label>Address</label>
                                            <input type="text" id="customer_address" name="customer_address" class="form-control " style="width:100%"  placeholder="Enter Address"/>

                                        </div>
                                   
	                                    <div class="row">
	                                        <div class="col-md-12">
	                                            <table class="table table-bordered">
	                                                <thead class="bg-primary text-white">
	                                                    <th>Product List</th>
	                                                    <th>Qty</th>
	                                                    <th>Price</th>
	                                                    <th>Total</th>
	                                                    <th></th>
	                                                </thead>
	                                                <tbody id="tableRow">
	                                                </tbody>
	                                                <tfoot class="">
	                                                    <tr>
	                                                        <th class="text-center" colspan="2"></th>
	                                                        <th class="text-left" colspan="3">
	                                                            Total Amount <input class="form-control grand_total" name="grand_total" type="text">
	                                                        </th>
	                                                    </tr>
	                                                    <tr>
	                                                        <th class="text-center" colspan="2"></th>
	                                                        <th class="text-left" colspan="3">
	                                                            Paid Amount <input class="form-control paid_amount" name="paid_amount" type="text">
	                                                        </th>
	                                                    </tr>
	                                                    <tr>
	                                                        <th class="text-center" colspan="2"></th>
	                                                        <th class="text-left" colspan="3">
	                                                            Due Amount <input disabled class="form-control due_amount" name="due_amount" type="text" >
	                                                        </th>
	                                                    </tr>
	                                                </tfoot>
	                                            </table>
	                                             <div class="form-group text-center">
	                                                <button type="submit" id="payment-btn" class="btn btn-success"><i class="fe fe-dollar"></i> Create Now</button>
	                                            </div>  
	                                        </div>
	                                    </div>
                                     </form>
                                </div>
                            </div>
                           
                        </div>
                    </div>
                </div>
				
				</div>			
			</div>
			<!-- /Main Wrapper -->
		
        </div>
		<!-- /Main Wrapper -->
		<!--------------->
		
        <!-- MDB -->
<script  type="text/javascript"  src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.1/mdb.min.js"></script>



<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
	
		<script type="text/javascript">
           $(document).ready(function() {
            $('#product_name').on('change', function() {
                var product_name = $("#product_name").val();
                $.ajax({
                    url: "include/get_product.php",
                    method: "POST",
                    data: {
                        getProductName:0,
                        product_name: product_name,
                    },
                    success: function(response) {
                        var jsonData = JSON.parse(response);
                        var html_code='';
                          var html = '<tr><td><input type="text" name="name[]" class="form-control" value="'+jsonData.product_name+'"></td><td ><input type="number" min="1" name="qty[]" id="qty" value="1" class="form-control qty"/></td><td ><input type="number" id="price" name=price[] class="form-control price" value="' + jsonData.price + '"></td><td ><input type="number" name=total_price[] id="total_price" class="form-control total_price" value="' + jsonData.price + '"/></td><td><a type="button" id="itemRow"><i class="fe fe-close" ></i></a></td></tr>';

                         $("#tableRow").append(html);
                         getTotalAmount();
                    }
                });
            });




            $(document).on('click', '#itemRow', function() {
                $(this).closest('td').parent().remove();
                getTotalAmount();
            });


            $(document).on("change", "input", function() {
                var row = $(this).closest("tr");
                var qty = Number(row.find("#qty").val());
                var price = Number(row.find("#price").val());
                var total_price = (Number(qty) * Number(price));
                row.find("#total_price").val(total_price);
                //row.find("#total_price").val();

                getTotalAmount()

            });

            function getTotalAmount() {
                var grandTotal = 0;
                $("table").find("input.total_price").each(function() {
                    grandTotal += $(this).val() - 0;
                });
                $(".grand_total").val(grandTotal);
            }
            $(document).on('keyup','.paid_amount',function(){
                var paid_amount=$('.paid_amount').val();
                var grand_total=$('.grand_total').val();
                var totalDue=Number(grand_total-paid_amount);
                $(".due_amount").val(totalDue);
                
            });

            // $("#payment-btn").click(function(){
            //    var formData= $("#form-data").serialize();
            //    var addInvoice="0";
            //    //console.log(formData);
            //    $.ajax({
            //         url: "include/invoice_create.php",
            //         method:"POST",
            //         data: {
            //             formData: formData,
            //             addInvoice:addInvoice
            //         },
            //         success: function(response) {
            //            if (response==1) {
            //                 alert('data has been submitted');
            //            }
            //         }
            //     });
            // });


        });

    </script>
		
    </body>
</html>