<?php

namespace App\Presenters;
use App\Model\Homepage;
use Nette;


final class HomepagePresenter extends Nette\Application\UI\Presenter
{
    
    private $homepage;

    public function __construct(Homepage $homepage)
    {
        $this->homepage = $homepage;
    }

    public function renderDefault(): void
    {
        $this->template->nextRaces = $this->homepage->getNextRaces();

        //$this->template->bla = "blaxxx";
 
    }

}
