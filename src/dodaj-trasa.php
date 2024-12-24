<?php include_once 'config.php'; 

        $data->samochod = $_POST['samochod'];
        $data->kierowca = $_POST['kierowca'];
        $data->data_poczatek = $_POST['data_poczatek'];
        $data->data_koniec = $_POST['data_koniec'];
        $data->data_koniec = $_POST['data_koniec'];
        $data->przejechane_kilometry = $_POST['przejechane_kilometry'];
        $data->poprawne_kilometry = $_POST['poprawne_kilometry'];
        $data->poprawne_spalanie = $_POST['poprawne_spalanie'];
$query = "INSERT INTO trasy (id_samochod, id_kierowca, data_poczatek, data_koniec,przejechane_kilometry,poprawne_kilometry, poprawne_spalanie) VALUE ('$data->samochod', '$data->kierowca', '$data->data_poczatek', '$data->data_koniec', '$data->przejechane_kilometry', '$data->poprawne_kilometry', '$data->poprawne_spalanie')";

    
    $result = $conn->query($query); 
$res->code = 1;

echo json_encode($res);
?>
