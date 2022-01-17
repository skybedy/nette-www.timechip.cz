<?php

namespace App\Model;

use Nette;

class Homepage extends Basic{
	use Nette\SmartObject;

	private Nette\Database\Explorer $db;

	public function __construct(Nette\Database\Explorer $db){
		$this->db = $db;
	}

	public function getNextRaces(){
        $sql1 = "SELECT zv.id_zavodu,zv.nazev_zavodu,zv.kod_zavodu,DATE_FORMAT(zv.datum_zavodu,'%e.%c.%Y') AS datum,tz.icon,zv.web FROM zavody_{$this->currentYear()} zv, typ_zavodu tz WHERE zv.datum_zavodu  > CURDATE() AND zv.typ_zavodu = tz.id_typ_zavodu ORDER BY zv.datum_zavodu ASC LIMIT 0,".$this->countValuesForHomepage;
        $dbdata1 =  $this->db->fetchAll($sql1);
        $rowCount = count($dbdata1);
        if($rowCount < $this->countValuesForHomepage)
        {
            $sql2 = "SELECT zv.id_zavodu,zv.nazev_zavodu,zv.kod_zavodu,DATE_FORMAT(zv.datum_zavodu,'%e.%c.%Y') AS datum,tz.icon,zv.web FROM zavody_{$this->nextYear()} zv, typ_zavodu tz WHERE zv.datum_zavodu  > CURDATE() AND zv.typ_zavodu = tz.id_typ_zavodu ORDER BY zv.datum_zavodu ASC LIMIT 0,".($this->countValuesForHomepage-$rowCount);
            $dbdata2 = $this->db->fetchAll($sql2);
            $dbdata = array_merge($dbdata1,$dbdata2);
        }else
        {
            $dbdata = $dbdata1;
        }
        return $dbdata;
	}

    public function getLastResults(){
        $sql1 = "SELECT zv.id_zavodu,zv.nazev_zavodu,zv.kod_zavodu,DATE_FORMAT(zv.datum_zavodu,'%e.%c.%Y') AS datum,tz.icon,zv.web FROM zavody_{$this->currentYear()} zv,typ_zavodu tz WHERE zv.typ_zavodu = tz.id_typ_zavodu AND zv.zverejneni > 0 AND  zv.datum_zavodu  <= CURDATE() AND zv.nove_vysledky  < 1 ORDER BY zv.datum_zavodu DESC LIMIT 0,".$this->countValuesForHomepage;
        $dbdata1 =  $this->db->fetchAll($sql1);
        $rowCount = count($dbdata1);
        if($rowCount < $this->countValuesForHomepage)
        {
            $sql2 = "SELECT zv.id_zavodu,zv.nazev_zavodu,zv.kod_zavodu,DATE_FORMAT(zv.datum_zavodu,'%e.%c.%Y') AS datum,tz.icon,zv.web FROM zavody_{$this->lastYear()} zv,typ_zavodu tz WHERE zv.typ_zavodu = tz.id_typ_zavodu AND zv.zverejneni > 0 AND  zv.datum_zavodu  <= CURDATE() AND zv.nove_vysledky  < 1 ORDER BY zv.datum_zavodu DESC LIMIT 0,".($this->countValuesForHomepage-$rowCount);
            $dbdata2 = $this->db->fetchAll($sql2);
            $dbdata = array_merge($dbdata1,$dbdata2);
        }else
        {
            $dbdata = $dbdata1;
        }
        return $dbdata;
    }

}