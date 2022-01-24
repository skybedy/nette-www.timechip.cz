<?php

declare(strict_types=1);

namespace App\Presenters;

use App\Model\Zavody;
use Nette;


final class ZavodyPresenter extends Nette\Application\UI\Presenter
{

    private $zavody;
/*
public function renderShow(int $year){
    $this->template->year = $year; 
}*/

    public function __construct(Zavody $zavody)
    {
        $this->zavody = $zavody;
    }

    public function actionShow(int $year)
    {
        print_r($this->zavody->RaceList($year));
    }

}
