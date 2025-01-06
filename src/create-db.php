<?php include_once 'config.php';

// ADD Dates validation


//kierowcy
// nazwisko, name
// $db->query(
//     "DROP TABLE `truck_drivers`"
// );
$db->query(
    "CREATE TABLE IF NOT EXISTS `truck_drivers` (
        `id` INTEGER,
        `name` TEXT,
        `active` BOOLEAN DEFAULT TRUE,
        `settlement_date` DATE DEFAULT NULL,
        PRIMARY KEY(`id` AUTOINCREMENT)
    )"
);

//zakupy_paliwa
// dostawca, supplier
// nr_dokumentu, document_number
// ilosc_paliwa, fuel_qty
// ilosc_adblue, adblue_qty
// data, date
// aktywny, active
// data_rozliczenia, settlement_date
$db->query(
    "CREATE TABLE IF NOT EXISTS `fuel_purchases` (
        `id` INTEGER,
        `supplier` TEXT,
        `document_number` TEXT,
        `fuel_qty` REAL,
        `adblue_qty` REAL,
        `date` DATE,
        PRIMARY KEY(`id` AUTOINCREMENT)
    )"
);

//wydania_paliwa
// id_samochod, id_car
// w_ilosc_paliwa, released_fuel_qty
// w_ilosc_adblue, released_adblue_qty
// w_ilosc_ref, released_ref_qty
// data_wydania, date
// rodzaj, type
$db->query(
    "CREATE TABLE IF NOT EXISTS `fuel_releases` (
        `id` INTEGER,
        `id_car` INTEGER,
        `released_fuel_qty` REAL,
        `released_adblue_qty` REAL,
        `released_ref_qty` REAL,
        `date` DATE,
        `type` TEXT,
        PRIMARY KEY(`id` AUTOINCREMENT)
    )"
);

//samochody
// nr_rejestracyjny, registration_nb
// bak_paliwo, fuel_tank
// bak_adblue, adblue_tank
$db->query(
    "CREATE TABLE IF NOT EXISTS `cars` (
        `id` INTEGER,
        `registration_nb` TEXT,
        `fuel_tank` REAL,
        `adblue_tank` REAL,
        PRIMARY KEY(`id` AUTOINCREMENT)
    )"
);

//trasy
// id_samochod, id_car
// id_kierowca, id_driver
// data_poczatek, start_date
// data_koniec, end_date
// przejechane_kilometry, route_length
// poprawne_kilometry, optimal_route_length
// poprawne_spalanie, optimal_fuel_consumption
$db->query(
    "CREATE TABLE IF NOT EXISTS `deliveries` (
        `id` INTEGER,
        `id_car` INTEGER,
        `id_driver` INTEGER,
        `start_date` DATE,
        `end_date` DATE,
        `route_length` INTEGER,
        `optimal_route_length` INTEGER,
        `optimal_fuel_consumption` REAL,
        PRIMARY KEY(`id` AUTOINCREMENT)
    )"
);
