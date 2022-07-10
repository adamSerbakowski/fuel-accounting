<?php include_once 'config.php'; 

        $data->dostawca = $_POST['dostawca'];
        $data->nr_dokumentu = $_POST['nr_dokumentu'];
        $data->ilosc_paliwa = $_POST['ilosc_paliwa'];
        $data->ilosc_adblue = $_POST['ilosc_adblue'];
        $data->data_zakupu = $_POST['data_zakupu'];
$query = "INSERT INTO zakupy_paliwa (dostawca, nr_dokumentu, ilosc_paliwa, ilosc_adblue, data) VALUE ('$data->dostawca', '$data->nr_dokumentu', '$data->ilosc_paliwa', '$data->ilosc_adblue', '$data->data_zakupu')";

    
    $result = $conn->query($query); 
$res->code = 1;

echo json_encode($res);
?>
