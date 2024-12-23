<?php include_once 'config.php'; 


if ($_REQUEST['field'] != '') :
    $tabela = $_REQUEST['naprawa'];
    $value = $_REQUEST['value']; 
    $field = $_REQUEST['field'];
    $id = $_REQUEST['id'];

if ($tabela === 'kierowcy') :
        $query = "UPDATE $tabela SET $field='$value' WHERE id_kierowca=$id";
elseif ($tabela === 'wydania_paliwa') :
$query = "UPDATE $tabela SET $field='$value' WHERE id_wydanie=$id";
elseif ($tabela === 'zakupy_paliwa') :
$query = "UPDATE $tabela SET $field='$value' WHERE id_zakup=$id";
elseif ($tabela === 'trasy') :
$query = "UPDATE $tabela SET $field='$value' WHERE id_trasa=$id";
else :
    $query = "UPDATE $tabela SET $field='$value' WHERE id_samochod=$id";

    endif;
    
    $result = $conn->query($query); 
$res->code = 1;

endif;
echo json_encode($res);
?>
