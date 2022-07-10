<?php include_once 'config.php'; 

        $data->samochod = $_POST['samochod'];
        $data->w_ilosc_paliwa = $_POST['w_ilosc_paliwa'];
        $data->w_ilosc_adblue = $_POST['w_ilosc_adblue'];
        $data->w_ilosc_ref = $_POST['w_ilosc_ref'];
        $data->data_wydania = $_POST['data_wydania'];
        $data->rodzaj = $_POST['rodzaj'];
$query = "INSERT INTO wydania_paliwa (id_samochod, w_ilosc_paliwa, w_ilosc_adblue, w_ilosc_ref, data_wydania, rodzaj) VALUE ('$data->samochod', '$data->w_ilosc_paliwa', '$data->w_ilosc_adblue','$data->w_ilosc_ref', '$data->data_wydania', '$data->rodzaj')";

    
    $result = $conn->query($query); 
$res->code = 1;

echo json_encode($res);
?>

