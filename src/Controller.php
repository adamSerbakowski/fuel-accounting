<?php

namespace App;

use App\Header;

abstract class Controller
{
    protected \PDO $db;

    public function renderTemplate() {
        $this->db = new \PDO('sqlite:fuel.db');
        return $this->renderHeader() . $this->renderContent() . $this->renderFooter();
    }

    public abstract function renderContent();

    public function renderHeader()
    {
            return '<!DOCTYPE html>
    <html>
        <head>
            <title>Rozliczanie paliwa</title>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
            <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" ></script>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">  
            <meta name="robots" content="noindex, nofollow" />
            <script>
                '.file_get_contents("assets/script.js").'
            </script>
            <style>
                '.file_get_contents("assets/style.css").'            
            </style>
        </head>
        <body>
            <div class="container-fluid" id="nav">
                <div class="row">
                    <ul class="menu">
                        <li><a href="/">Strona główna</a></li>
                        <li><a href="/trasy">Trasy</a></li>
                        <li><a href="/zakupy">Zakupy</a></li>
                        <li><a href="/wydania">Wydania</a></li>
                        
                        <li><a href="/samochody">Samochody</a></li>
                        <li><a href="/kierowcy">Kierowcy</a></li>
                        <li><a href="/wgraj-trase">Dodaj całą trasę</a></li>
                    </ul>
                </div>
            </div>';
    }

    public function renderFooter() 
    {
       return '<div class="stopka">
    
</div>


<div id="editPopUp">
    <div class="popUp__inner">
        <div class="closeBtn"><i class="fas fa-times"></i></div>
        <p class="popup__header"></p>
        <div>
            <form onsubmit="submitEdit(event)">
                <input type="text" name="var" id="var" />
                <input onclick="sendEditForm()" type="submit" class="form-control mt-3" value="Zapisz" />
                <input type="button" onclick="exitEditForm()" class="form-control mt-3" value="Anuluj" />
            </form>
        </div>
    </div>
</div>

<div id="przypiszPopUp">
    <div class="popUp__inner">
        <div class="closeBtn"><i class="fas fa-times"></i></div>
        <p class="popup__header"></p>
        <div>
            <form onsubmit="submitPrzypisz(event)">
                <input type="text" name="var" id="varP" list="numeryrejEdit"/>
                <datalist id="numeryrejEdit">'. $this->getCars() . '</datalist>
                <input onclick="sendPrzypiszForm()" type="submit" class="form-control mt-3" value="Zapisz"/>
                
                <input type="button" onclick="exitPrzypiszForm()" class="form-control mt-3" value="Anuluj" />
            </form>
        </div>
    </div>
</div>


<div id="przypiszKierPopUp">
    <div class="popUp__inner">
        <div class="closeBtn"><i class="fas fa-times"></i></div>
        <p class="popup__header"></p>
        <div>
            <form onsubmit="submitPrzypisz(event)">
                <input type="text" name="var" id="varK" list="nazwiskoEdit"/>
                <datalist id="nazwiskoEdit">' . $this->getDrivers() . '</datalist>
                <input onclick="sendPrzypiszFormKier()" type="submit" class="form-control mt-3" value="Zapisz"/>
                
                <input type="button" onclick="exitPrzypiszForm()" class="form-control mt-3" value="Anuluj" />
            </form>
        </div>
    </div>
</div>


    </body>
    
    
</html>';
    }

    private function getCars()
    {
        $getSamochody = "SELECT * FROM cars";
        $samochody = $this->db->query($getSamochody);
        $html = '';
        foreach ($samochody as $row) :
            $idSamochod = $row['id_samochod'];
            $nrRej = $row['nr_rejestracyjny'];
            $html .= "<option data-id='{}' value='{$idSamochod}'>{$nrRej}</option>";
        endforeach;

        return $html;
    }

    private function getDrivers()
    {
        $getKierowcy = "SELECT * FROM truck_drivers";
        $kierowcy = $this->db->query($getKierowcy);
        $html = '';
        foreach ($kierowcy as $row) :
            $idKierowca = $row['id'];
            $nazwisko = $row['name'];
            $html .= "<option data-id='{$idKierowca}' value='{$idKierowca}'>{$nazwisko}</option>";
        endforeach;

        return $html;
    }
}
