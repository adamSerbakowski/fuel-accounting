<?php include_once 'config.php'; 


$data->nr_rejestracyjny = $_POST['nr_rejestracyjny'];
 $data->bak_paliwo = $_POST['bak_paliwo'];
 $data->bak_adblue = $_POST['bak_adblue'];
        
$query = "INSERT INTO samochody (nr_rejestracyjny, bak_paliwo, bak_adblue) VALUE ('$data->nr_rejestracyjny', '$data->bak_paliwo', '$data->bak_adblue')";

    
    $result = $conn->query($query); 
$res->code = 1;

echo json_encode($res);
?>

