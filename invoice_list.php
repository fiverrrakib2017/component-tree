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
        <div class="col-md-12 m-auto">
            <div class="card">
                <div class="card-header">
                <a class="btn-sm btn btn-success" href="index.php">Add Invoice</a>
                </div>
                <div class="card-body">
                <div class="col-md-12">
                    
                <table class="table table-bordered" >
                    <thead class="bg-primary text-white">
                        <th>Invoice ID</th>
                        <th>Supplier Name</th>
                        <th>Total Amount</th>
                        <th>Paid Amount</th>
                        <th>Due Amount</th>
                        <th>Create Date</th>
                        <th>Action</th>
                    </thead>
                    <tbody id="table_data">
                    <?php
                    //include database connection 
                    include 'include/config.php';
                    //while loop use show the invoice data
                    $allInvoice=$con->query("SELECT * FROM invoice");
                        while ($rows=$allInvoice->fetch_array()) {
                            
                        ?>

            <tr>
                
                <td>
                   <?php echo $rows['id'];?>
                </td>
                <td>
                   <?php echo $rows['supplier_name'];?>
                </td>
                <td>
                    <?php echo $rows['total_amount'];?>
                </td>
                <td>
                    <?php echo $rows['paid_amount'];?>
                </td>
                <td>
                    <?php echo $rows['due_amount'];?>
                </td>
                <td>
                    <?php echo $rows['date'];?>
                </td>
                <td>
                <a class="btn-sm btn btn-success" href="invoice_view.php?id=<?php echo $rows['id'];?> "><i class="fas fa-eye"></i></a> 
                <button type="submit" data-id="<?php echo $rows['id'];?>" id="deleteInvoice" class="btn-sm btn btn-danger"><i class="fas fa-trash"></i></button>          
                </td>
            </tr>
                    
                    <?php }?>
                    </tbody>
                   
                </table>
                
            </div>
                </div>
            </div>
        </div>
    </div>
</div>






    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script type="text/javascript">
    $(document).ready(function() {
        /* delete Invoice button click */
        $(document).on('click','#deleteInvoice',function(e){
            e.preventDefault();
            if (confirm('Are you sure')) {
                var id=$(this).data('id');
                $.ajax({
                    url: "include/delete_Invoice.php",
                    method: "POST",
                    data: {
                        delete_invoice_data: 0,
                        id:id
                    },
                    success: function(response) {
                        if (response==1) {
                           toastr.success("Invoice Delete Successfully");
                           setTimeout(() => {
                                location.reload();
                           }, 1000);
                        }else{
                            toastr.error("Something was wrong!!!");
                        }
                    }
                });
            }
        });
    });
    </script>


</body>

</html>