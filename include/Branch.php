<?php



//include database connection file 
include 'config.php';


if (isset($_POST['get_branch_data'])) {
    $branch_data = array(); 

    if ($allBranch = $con->query("SELECT * FROM branch")) {
        while ($rows = $allBranch->fetch_assoc()) {
            $branch_data[] = $rows;
            
        }
    }

   
    echo json_encode($branch_data); 
}





?>