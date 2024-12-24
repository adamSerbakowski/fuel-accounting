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


if ($_POST['data_wydania1'] != '') {
                    $data->w_ilosc_paliwa1 = $_POST['w_ilosc_paliwa1'];
                    $data->w_ilosc_adblue1 = $_POST['w_ilosc_adblue1'];
                    $data->w_ilosc_ref1 = $_POST['w_ilosc_ref1'];
                    $data->data_wydania1 = $_POST['data_wydania1'];
                   $data->rodzaj1 = $_POST['rodzaj1'];
                    
                        $query1 = "INSERT INTO wydania_paliwa (id_samochod, w_ilosc_paliwa, w_ilosc_adblue, w_ilosc_ref, data_wydania, rodzaj) VALUE ('$data->samochod', '$data->w_ilosc_paliwa1', '$data->w_ilosc_adblue1','$data->w_ilosc_ref1', '$data->data_wydania1', '$data->rodzaj1')";
$result1 = $conn->query($query1); 
                    }
if ($_POST['data_wydania2'] != '') {                   
                                       $data->w_ilosc_paliwa2 = $_POST['w_ilosc_paliwa2'];
                    $data->w_ilosc_adblue2 = $_POST['w_ilosc_adblue2'];
                    $data->w_ilosc_ref2 = $_POST['w_ilosc_ref2'];
                    $data->data_wydania2 = $_POST['data_wydania2'];
                   $data->rodzaj2 = $_POST['rodzaj2'];
                         $query2 = "INSERT INTO wydania_paliwa (id_samochod, w_ilosc_paliwa, w_ilosc_adblue, w_ilosc_ref, data_wydania, rodzaj) VALUE ('$data->samochod', '$data->w_ilosc_paliwa2', '$data->w_ilosc_adblue2','$data->w_ilosc_ref2', '$data->data_wydania2', '$data->rodzaj2')";
$result2 = $conn->query($query2); 
                    }
 
                    if ($_POST['data_wydania3'] != '') {    
                                       $data->w_ilosc_paliwa3 = $_POST['w_ilosc_paliwa3'];
                    $data->w_ilosc_adblue3 = $_POST['w_ilosc_adblue3'];
                    $data->w_ilosc_ref3 = $_POST['w_ilosc_ref3'];
                    $data->data_wydania3 = $_POST['data_wydania3'];
                   $data->rodzaj3 = $_POST['rodzaj3'];
                                            $query3 = "INSERT INTO wydania_paliwa (id_samochod, w_ilosc_paliwa, w_ilosc_adblue, w_ilosc_ref, data_wydania, rodzaj) VALUE ('$data->samochod', '$data->w_ilosc_paliwa3', '$data->w_ilosc_adblue3','$data->w_ilosc_ref3', '$data->data_wydania3', '$data->rodzaj3')";
$result3 = $conn->query($query3); 
                    }
 
                                        if ($_POST['data_wydania4'] != '') {    
                                       $data->w_ilosc_paliwa4 = $_POST['w_ilosc_paliwa4'];
                    $data->w_ilosc_adblue4 = $_POST['w_ilosc_adblue4'];
                    $data->w_ilosc_ref4 = $_POST['w_ilosc_ref4'];
                    $data->data_wydania4 = $_POST['data_wydania4'];
                   $data->rodzaj4 = $_POST['rodzaj4'];
                                                               $query4 = "INSERT INTO wydania_paliwa (id_samochod, w_ilosc_paliwa, w_ilosc_adblue, w_ilosc_ref, data_wydania, rodzaj) VALUE ('$data->samochod', '$data->w_ilosc_paliwa4', '$data->w_ilosc_adblue4','$data->w_ilosc_ref4', '$data->data_wydania4', '$data->rodzaj4')";
$result4 = $conn->query($query4); 
                    }
                   if ($_POST['data_wydania5'] != '') {  
                                       $data->w_ilosc_paliwa5 = $_POST['w_ilosc_paliwa5'];
                    $data->w_ilosc_adblue5 = $_POST['w_ilosc_adblue5'];
                    $data->w_ilosc_ref5 = $_POST['w_ilosc_ref5'];
                    $data->data_wydania5 = $_POST['data_wydania5'];
                   $data->rodzaj5 = $_POST['rodzaj5'];

                                            $query5 = "INSERT INTO wydania_paliwa (id_samochod, w_ilosc_paliwa, w_ilosc_adblue, w_ilosc_ref, data_wydania, rodzaj) VALUE ('$data->samochod', '$data->w_ilosc_paliwa5', '$data->w_ilosc_adblue5','$data->w_ilosc_ref5', '$data->data_wydania5', '$data->rodzaj5')";
$result5 = $conn->query($query5); 
                    }

    
    $result = $conn->query($query); 
$res->code = 1;

echo json_encode($res);
?>
