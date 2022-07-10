<?php include_once 'config.php'; 

        $data->nazwisko = $_POST['nazwisko'];
        
$query = "INSERT INTO kierowcy (nazwisko) VALUE ('$data->nazwisko')";

    
    $result = $conn->query($query); 
$res->code = 1;

echo json_encode($res);
?>

