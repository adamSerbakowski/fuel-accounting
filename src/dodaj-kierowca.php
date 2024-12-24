<?php include_once 'src/config.php'; 

if ($_POST['nazwisko'] && is_string($_POST['nazwisko'])) {
    $qry = $db->prepare("INSERT INTO truck_drivers (name) VALUES (?)");
    $qry->execute(array($_POST['nazwisko']));
}
