<?php
//database connection file 
include 'config.php';



// echo '<pre>';

// var_dump($_POST);


// echo '</pre>';

/* check the Request */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $supplier_name = $_POST['supplier_name'];
    $product_names = $_POST['product_name'];
    $product_units = $_POST['product_unit'];
    $qtys = $_POST['qty'];
    $prices = $_POST['price'];
    $discounts = $_POST['discount'];
    $total_prices = $_POST['total_price'];
    $branch_ids = $_POST['branch_id'];
    $upload_file = $_FILES['upload_file']['name'];



    $total_amount = $_POST['total_amount'];
    $paid_amount = $_POST['paid_amount'];
    $due_amount = $_POST['due_amount'];
    
$today_date=date('Y-m-d');

  $result= $con->query("INSERT INTO `invoice` (`supplier_name`, `total_amount`, `paid_amount`, `due_amount`, `date`) VALUES ('$supplier_name', '$total_amount', '$paid_amount', '$due_amount', '$today_date')");
    if ($result==true) {
        $last_insert_id=$con->insert_id;
        for ($i = 0; $i < count($product_names); $i++) {
            $product_name = $product_names[$i];
            $product_unit = $product_units[$i]; 
            $qty = $qtys[$i]; 
            $price = $prices[$i];
            $discount = $discounts[$i];
            $total_price = $total_prices[$i]; 
            $branch_id = $branch_ids[$i];
            $upload_file = $_FILES['upload_file']['name'][$i];
    
    
            //file upload 
            $file_name= $_FILES['upload_file']['name'][$i];
            $file_size= $_FILES['upload_file']['size'][$i];
    
            $extension=pathinfo($file_name,PATHINFO_EXTENSION);
            $valid_extension=array("jpg","jped","gif","png");
            $maxSize=2*1024*1024;
            if($file_size >$maxSize){
                echo "File is So Large";
            }else{
                if (in_array($extension,$valid_extension)) {
                    $new_name=rand().".".$extension;
                    $path="../image/".$new_name;
                    $result=move_uploaded_file($_FILES['upload_file']['tmp_name'][$i],$path);
                    $con->query("INSERT INTO invoice_details(invoice_id,product_name,product_unit,qty,price,discount,total_price,branch_name,invoice_file)VALUES('$last_insert_id','$product_name', '$product_unit','$qty','$price','$discount','$total_price','$branch_id','$path')");
                }
            }
    
        }
     echo "<b>Invoice create successfully</b>";
     header('location:../invoice_list.php');
    }else{
        echo "<b>Invoice data not insert</b>";
    }
  

    
       
}


?>