<?php

namespace App\Model;

class Basic {

    protected $countValuesForHomepage = 4;

    protected function currentYear()
    {
        return date("Y");
    }

    protected function nextYear()
    {
        return date("Y") + 1;
    }

    protected function lastYear()
    {
        return date("Y") - 1;
    }

}


?>