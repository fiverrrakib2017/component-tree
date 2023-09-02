<?php

//include database connection file 
include 'config.php';


if (isset($_POST['delete_invoice_data'])) {
    /* Store Data id  */
    $id=$_POST['id'];

    if ($result = $con->query("DELETE FROM `invoice` WHERE id=$id ")) {
        if ($result==true) {
            $con->query("DELETE FROM `invoice_details` WHERE invoice_id= $id ");
            echo 1;
        }
    }else{
        echo 0;
    }
   
}





?>