<?php

namespace App;

use Twig\Environment;
use App\Repositories\DriversRepository;
use App\Repositories\CarsRepository;

abstract class Controller
{
    public const URL = '';

    protected \PDO $db;

    protected Environment $twig;

    protected DriversRepository $driversRepository;

    protected CarsRepository $carsRepository;

    public function __construct()
    {
        $this->db = DB::getInstance();
        $loader = new \Twig\Loader\FilesystemLoader('./templates');
        $this->twig = new \Twig\Environment($loader, [
            // 'cache' => './cache',
        ]);
        $this->driversRepository = new DriversRepository($this->db);
        $this->carsRepository = new CarsRepository($this->db);
    }

    public function renderTemplate() {
        return $this->twig->render(
            $this->getTemplate(),
            [
                'scripts' => $this->getScripts(),
                'styles' => $this->getStyles(),
                'url' => static::URL,
                'cars' => $this->carsRepository->getAllShortened(),
                'drivers' => $this->driversRepository->getAll(),
                'content' => $this->getContent(),
            ]
        );
    }

    public function getTemplate(): string
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
}
