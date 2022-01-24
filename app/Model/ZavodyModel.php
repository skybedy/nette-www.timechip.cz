<?php

namespace App\Model;

use Nette;

class Zavody extends Basic{
	use Nette\SmartObject;

	private Nette\Database\Explorer $db;

	public function __construct(Nette\Database\Explorer $db){
		$this->db = $db;
	}

    public function RaceList($raceYear)
    {
        $sql1  = "SELECT zv.nove_vysledky,zv.prihlasky,zv.nazev_zavodu,DATE_FORMAT(zv.datum_zavodu,'%e. %c') AS datum,DATE_FORMAT(zv.datum_zavodu,'%e') AS den_zavodu,DATE_FORMAT(zv.datum_zavodu_konec,'%e. %c') AS datum_zavodu_konec,zv.misto_zavodu,zv.id_zavodu,zv.web,typ_zavodu.typ_zavodu,$raceYear AS year FROM zavody_{$raceYear} zv,typ_zavodu  WHERE zv.typ_zavodu = typ_zavodu.id_typ_zavodu AND zverejneni IS NOT NULL ORDER BY datum_zavodu,nazev_zavodu";
        $dbdata1 = $this->db->fetchAll($sql1);
        if(count($dbdata1) > 0){
            return $dbdata1;
        }
    }

}
