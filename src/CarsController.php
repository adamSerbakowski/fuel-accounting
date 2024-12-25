<?php 

namespace App;

use App\Controller;

class CarsController extends Controller
{
    public function renderContent()
    {
        return '<div class="col-12 col-md-12">
            <div>
                Odśwież stronę aby zobaczyć aktualne dane.
            </div>
                <div class="samochody">
                    <h2>Samochody</h2>
                <div class="tabela col-12">
                    <div class="row table-head">
                        <span>ID</span>
                        <span>Nr rejestracyjny</span>
                        <span>Wielkość zbiornika paliwa</span>
                        <span>Wielkość zbiornika adblue</span>
                    </div>
                    <div class="row dodaj-samochod">
                        <form onsubmit="dodajSamochod(event)">
                            <input type="submit" value="DODAJ">
                            <input type="text" id="nr_rejestracyjny" name="nazwisko">
                            <input type="text" id="bak_paliwo" name="nazwisko">
                            <input type="text" id="bak_adblue" name="nazwisko">
                        </form>
                    </div>'.$this->renderCars().
                '</div>
            </div>
        </div>';
    }

    private function renderCars()
    {
        $getSamochody3 = "SELECT * FROM cars";
        $samochody3 = $this->db->query($getSamochody3);

        $html = '';
        foreach ($samochody3 as $row) :
           $html .= "<div class='row'>
                <span>
                    {$row['id']}
                </span>
                     <span data-field='nr_rejestracyjny' data-id='{$row['id']}' 
                           onclick='edit(`nr_rejestracyjny`,`{$row['id']}`,`samochody`)'
                           >{$row['registration_nb']}</span>

                <span data-field='bak_paliwo' data-id='{$row['id']}' 
                           onclick='edit(`bak_paliwo`,`{$row['id']}`,`samochody`)'
                    >{$row['fuel_tank']}</span>
                <span data-field='bak_adblue' data-id='{$row['id']}' 
                           onclick='edit(`bak_adblue`,`{$row['id']}`,`samochody`)'
                    >{$row['adblue_tank']}</span>
            </div>";
        endforeach;

        return $html;
    }
}