<?php

namespace App\Model;

use Nette;

class Homepage extends Basic{
	use Nette\SmartObject;

	private Nette\Database\Explorer $db;

	public function __construct(Nette\Database\Explorer $db){
		$this->db = $db;
	}

	public function getHomepageData(){
        $sql1 = "SELECT zv.id_zavodu,zv.nazev_zavodu,zv.kod_zavodu,DATE_FORMAT(zv.datum_zavodu,'%e.%c.%Y') AS datum,tz.icon,zv.web FROM zavody_{$this->currentYear()} zv, typ_zavodu tz WHERE zv.datum_zavodu  > CURDATE() AND zv.typ_zavodu = tz.id_typ_zavodu ORDER BY zv.datum_zavodu ASC LIMIT 0,4";
        $dbdata1 =  $this->db->fetchAll($sql1);
        $rowCount = count($dbdata1);
        if($rowCount < $this->x)
        
        {
           
            echo count($dbdata1);
            echo $this->x;
            $sql2 = "SELECT zv.id_zavodu,zv.nazev_zavodu,zv.kod_zavodu,DATE_FORMAT(zv.datum_zavodu,'%e.%c.%Y') AS datum,tz.icon,zv.web FROM zavody_{$this->nextYear()} zv, typ_zavodu tz WHERE zv.datum_zavodu  > CURDATE() AND zv.typ_zavodu = tz.id_typ_zavodu ORDER BY zv.datum_zavodu ASC LIMIT 0,".(4-$rowCount);
            $dbdata2 = $this->db->fetchAll($sql2);
            echo $sql2;
            print_r($dbdata2);
   
        }
        
	}
}