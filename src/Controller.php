<?php

namespace App;

use Twig\Environment;

abstract class Controller
{
    protected \PDO $db;

    protected Environment $twig;

    protected DriversRepository $driversRepository;

    public function __construct()
    {
        $this->db = DB::getInstance();
        $loader = new \Twig\Loader\FilesystemLoader('./templates');
        $this->twig = new \Twig\Environment($loader, [
            // 'cache' => './cache',
        ]);
        $this->driversRepository = new DriversRepository($this->db);
    }

    public function renderTemplate() {
        return $this->twig->render(
            $this->getTemplate(),
            [
                'scripts' => $this->getScripts(),
                'styles' => $this->getStyles(),
                'cars' => $this->getCars(),
                'drivers' => $this->driversRepository->getAll(),
                'content' => $this->getContent()
            ]
        );
    }

    public function getTemplate()
    {
        return 'base.twig';
    }

    public abstract function getContent();

    private function getScripts(): string 
    {
        return file_get_contents("assets/script.js");
    }

    private function getStyles(): string
    {
        return file_get_contents("assets/style.css");
    }

    private function getCars()
    {
        $getSamochody = "SELECT * FROM cars";
        $samochody = $this->db->query($getSamochody);
        $list = [];
        foreach ($samochody as $row) :
            $list[] = ['id' => $row['id'], 'nb' => $row['registration_nb']];
        endforeach;

        return $list;
    }
}
