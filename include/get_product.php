<?php



//include database connection file 
include 'config.php';


if (isset($_POST['getProduct'])) {
    $products = array(); 

    if ($allProducts = $con->query("SELECT * FROM products")) {
        while ($rows = $allProducts->fetch_assoc()) {
            $products[] = $rows;
            
        }
    }

   
    echo json_encode($products); 
}





?>