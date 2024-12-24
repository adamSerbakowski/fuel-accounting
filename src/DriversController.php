<?php 

namespace App;

use App\Controller;

class DriversController extends Controller
{
    public function renderContent()
    {
        return '<div class="kierowcy">
            <div>
                Odśwież stronę aby zobaczyć aktualne dane.
            </div>
                <h2>Kierowcy</h2>
                    <div class="tabela col-12">
                        <div class="row table-head">
                            <span>ID</span>
                            <span>Nazwisko</span>
                            <span>Aktywny (wpisz archiwalny)</span>
                            <span>Data ostatniego rozliczenia</span>
                        </div>
                    <div class="row dodaj-kierowca">
                        <form onsubmit="dodajKierowca(event)">
                            <input type="submit" value="DODAJ">
                            <input type="text" id="nazwisko" name="nazwisko">
                        </form>
                    </div>'.$this->renderKierowcy().'</div></div>';
    }

    private function renderKierowcy()
    {
        $kierowcy = $this->db->query("SELECT * FROM truck_drivers;");

        $html = '';

        foreach ($kierowcy as $row) : 
            if ($row['active'] !== 0) :
                $html .= "<div class='row'>
                    <span>
                        {$row['id']}
                    </span>

                    <span data-field='nazwisko' data-id='{$row['id']}' onclick='edit(`nazwisko`,`{$row['id']}`,`kierowcy`)'>{$row['name']}</span>
                <span data-field='aktywny' data-id='{$row['id']}' onclick='edit(`aktywny`,`{$row['id']}`,`kierowcy`)'>{$row['active']}</span>
                <span data-field='data_rozliczenia' data-id='{$row['id']}' onclick='edit(`data_rozliczenia`,`{$row['id']}`,`kierowcy`)'>{$row['settlement_date']}</span>
                </div>";
            endif;
        endforeach;
    $html .= "<p>Kierowcy archiwalni</p>";
    
    foreach ($kierowcy as $row) : 
            if ($row['aktywny'] === 'archiwalny') :
            

                $html .= "<div class='row'>
                <span>
                    {$row['id_kierowca']}
                </span>

                <span data-field='nazwisko' data-id='{$row['id_kierowca']}' onclick='edit(`nazwisko`,`{$row['id_kierowca']}`,`kierowcy`)'>{$row['nazwisko']}</span>
            <span data-field='aktywny' data-id='{$row['aktywny']}' onclick='edit(`aktywny`,`{$row['id_kierowca']}`,`kierowcy`)'>{$row['aktywny']}</span>
            <span data-field='data_rozliczenia' data-id='{$row['data_rozliczenia']}' onclick='edit(`data_rozliczenia`,`{$row['id_kierowca']}`,'kierowcy')'>{$row['data_rozliczenia']}</span>
            </div>";
        endif;
        endforeach;

        return $html;
    }
}
