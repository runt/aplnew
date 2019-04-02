<?php

/**
 * DB Utility functions
 *
 * @author runt
 */
class AplModel extends Object{
        const TABLE_USERROLES = 'dbenutzerroles';
        const TABLE_ROLES = 'roles';
        const TABLE_RESOURCES = 'resources';
        const TABLE_PRIVILEGES = 'privileges';
        const TABLE_DPERS = 'dpers';
        const TABLE_DPERSDETAIL = 'dpersdetail1';
        const TABLE_URLAUB = 'durlaub1';
        const TABLE_DPERSSTEMPEL = 'dpersstempel';
        const TABLE_VORSCHUSS = 'dvorschuss';
        const TABLE_DZEIT = 'dzeit';
        const TABLE_DESSEN = 'dessen';
        const TABLE_TRANSPORT = 'dperstransport';
        const TABLE_KFZ = 'dkfz';
        const TABLE_ROUTE = 'dtransportroute';
        const TABLE_TATTYPEN = 'dtattypen';
        const TABLE_DPERSPREMIE = 'dperspremie';
        const TABLE_PREMIETYPEN = 'dpremietypen';
	const TABLE_VERTRAGTYPEN = 'dvertragtyp';
        const TABLE_DPERSABMAHNUNG = 'dabmahnung';
        const TABLE_ABMAHNUNGTYPEN = 'dabmahnpplan';
        const TABLE_UNFALLTYPEN = 'unfalltyp';
        const TABLE_DZEITSOLL = 'dzeitsoll';
        const TABLE_DPERSUNFALL = 'persunfall';
        const TABLE_DPERSFAEHIGKEIT = 'dpersfaehigkeit';
        const TABLE_FAEHIGKEITEN = 'dfaehigkeiten';
        const TABLE_FAEHIGKEITTYP = 'dfaehigkeittyp';
        const TABLE_DRUECK = 'drueck';
        const TABLE_DSCHULUNG = 'dschulung';
        const TABLE_DPERSSCHULUNG = 'dpersschulung';
        const TABLE_DPERSBEWERBER = 'dpersbewerber';
        const TABLE_DPERSUNTERSUCHUNGDATUM = 'dpersuntersuchungdatum';
        const TABLE_DSTDDIF = 'dstddif';
        const TABLE_DPERSVERTRAG = 'dpersvertrag';
        const TABLE_DTEXTBUCH = 'dtextbuch';
	const TABLE_DREKLAMATION = 'dreklamation';


	/** @var DibiConnection */
	public $db;

        public function __construct()
	{
//            parent::__construct();
            require_once LIBS_DIR . '/dibi/dibi.php';
            $this->db = new DibiConnection(array(
                'driver'=>'mysql',
                'database'=>'apl',
//                'host'=>'172.16.1.100',
                'host'=>'172.16.1.111',
                'user'=>'root',
                'password'=>'nuredv'));
                $this->db->query('set names utf8');
        }


public function getPrivilegesArray(){
    $resourcesArray = array();
    $sql = "select name from ".self::TABLE_PRIVILEGES."";
    $result = $this->db->query($sql);
    if(count($result)>0){
        while($row = $result->fetch()){
            array_push($resourcesArray, $row['name']);
        }
    }
    return $resourcesArray;
}

/**
 *
 * @return string 
 */
public static function getMADokumentePath() {
	//return 'Aby 99 Nezarazene/test_MA_docs/ma_dokumente';
	return 'Aby 18 Mitarbeiter -/02 Arbeitsverhaltnis - Pr.smlouvy,dodatky,skonceni PP/08 Slozky_novych_MA';
    }
    
public static function getMATemplatesPath() {
	//return 'Aby 99 Nezarazene/test_MA_docs/templates';
	return 'Aby 18 Mitarbeiter -/09 Nove nastupy/APL_sablony_slozkaMA';
    }
    
/**
 *
 * @return string 
 */
public static function getGdatPath() {
	return '/mnt/gdat/Dat/';
    }

        public static function getFilesForPath($path, $filter = NULL) {
	$docsArray = array();
	$fileArray = array();
	//test zda cesta existuje
	if (file_exists($path)) {
	    if ($filter == NULL)
		$iterator = new \DirectoryIterator($path);
	    else {
		//$iterator = new GlobIterator($path, FilesystemIterator::CURRENT_AS_FILEINFO|FilesystemIterator::SKIP_DOTS);
		$iterator = new FilesystemIterator($path, FilesystemIterator::CURRENT_AS_FILEINFO | FilesystemIterator::SKIP_DOTS);
		$iterator = new RegexIterator($iterator, $filter);
	    }


	    //if($iterator->count()==0) return NULL;
	    foreach ($iterator as $file) {
		// if the file is not this file, and does not start with a '.' or '..',
		// then store it for later display
		//if ((!$file->isDot()) && ($file->getFilename() != basename($_SERVER['PHP_SELF']))) {
		if (($file->getFilename() != basename($_SERVER['PHP_SELF']))) {
		    // if the element is a directory add to the file name "(Dir)"
		    //echo ($file->isDir()) ? "(Dir) ".$file->getFilename() : $file->getFilename()."<br>";
		    if (!$file->isDir()) {
			$fileArray['filename'] = utf8_encode($file->getFilename());
			$fileArray['mtime'] = $file->getMTime();
			$fileArray['size'] = $file->getSize();
			$fileArray['type'] = $file->getType();
			$fileName = $file->getFilename();
			$ext = substr($fileName, strrpos($fileName, '.')+1);
			$fileArray['ext'] = strtoupper($ext);
			$fileArray['url'] = "/gdat" . substr($file->getPath(), 13) . "/" . $fileArray['filename'];
			if ($fileArray['filename'] !== null)
			    array_push($docsArray, $fileArray);
		    }
		}
	    }
	}
	if (count($docsArray) == 0)
	    return NULL;
	return $docsArray;
    }

public function getElementsIDForFormID($form_id){
    $resourcesArray = array();
    $sql = "select element_id from ".self::TABLE_RESOURCES." where form_id=%s";
    $result = $this->db->query($sql,$form_id);
    if(count($result)>0){
        while($row = $result->fetch()){
            array_push($resourcesArray, $row['element_id']);
        }
    }
    return $resourcesArray;
}

public function getRolesArray($username){
    $rolesArray = array();

    $sql = "select ".self::TABLE_ROLES.".name as role from ".self::TABLE_ROLES." join ".self::TABLE_USERROLES." on ".self::TABLE_USERROLES.".role_id=".self::TABLE_ROLES.".id where ".self::TABLE_USERROLES.".benutzername=%s";
    $result = $this->db->query($sql,$username);
    if(count($result)>0){
        while($row = $result->fetch()){
            array_push($rolesArray, $row['role']);
        }
    }
    return $rolesArray;
}

public function updateVertrag($idVertrag,$dbField,$dbValue){
    $this->db->query("update dpersvertrag set $dbField=%s where id=%i",$dbValue,$idVertrag);
    return $this->db->affectedRows();
}
public function updateDpersZuschlag($persnr,$datum,$statnr,$value){
    // zjistim, zda uz takovou pozici mam, podle toho provedu insert nebo update
    $result = $this->db->query("select datum from dpersdatumzuschlag where persnr='$persnr' and datum='$datum' and stat_nr='$statnr'");
    if($this->db->affectedRows()>0){
        // update
        $sql = "update dpersdatumzuschlag set zuschlag=$value where persnr=$persnr and datum='$datum' and stat_nr='$statnr'";
        $this->db->query($sql);
    }
    else{
        // insert
        $sql = "insert into dpersdatumzuschlag (persnr,datum,stat_nr,zuschlag) values($persnr,'$datum','$statnr',$value)";
        $this->db->query($sql);
    }

    return $this->db->affectedRows();
}

public function fillVzkdSollFromAnwSollAndFactor($persnr,$planoe,$dbVon,$dbBis){
    // zjistit anwvzkd_faktor
    $result = $this->db->query("select anwvzkd_faktor from ".self::TABLE_DPERS." where persnr='$persnr'");
    $anwvzkd_faktor = floatval($result->fetchSingle());
    $updateSQL = "update ".self::TABLE_DZEITSOLL." set stunden_vzkd = stunden*$anwvzkd_faktor where persnr='$persnr' and oe='$planoe' and datum between '$dbVon' and '$dbBis'";
    $this->db->query($updateSQL);
    return $this->db->affectedRows();
}

public function getDpersDatumZuschlagArray($persnr) {
        $zuschlagArray = array();
        $sql = "select persnr,stat_nr,DATE_FORMAT(datum,'%Y-%m-%d') as datum,zuschlag from dpersdatumzuschlag where persnr='$persnr'";
        $res = $this->db->query($sql);
        if ($this->db->affectedRows() > 0) {
            while ($row = $res->fetch()) {
                $zuschlagArray[$row['stat_nr']][$row['datum']] = $row['zuschlag'];
            }
            return $zuschlagArray;
        }
        else
            return NULL;
    }

    /**
 *
 * @param <type> $persnr
 */
public function getArbTageZuschlagArray($persnr) {
        $sql = "select";
        $sql.=" DATE_FORMAT(drueck.`Datum`,'%Y-%m-%d') as datum,";
        $sql.=" `dtaetkz-abg`.`Stat_Nr` as stat_nr";
        $sql.=" from drueck";
        $sql.=" join dpers on dpers.persnr=drueck.`PersNr`";
        $sql.=" join `dtaetkz-abg` on `dtaetkz-abg`.`abg-nr`=drueck.`TaetNr`";
        $sql.=" where";
        $sql.=" drueck.`PersNr`='$persnr'";
        $sql.=" and";
        $sql.=" datum>=dpers.eintritt and drueck.`Datum`<=DATE_ADD(dpers.eintritt,INTERVAL 62 DAY)";
        $sql.=" and";
        $sql.=" `dtaetkz-abg`.stat_nr<>'X'";
        $sql.=" group by";
        $sql.=" drueck.`Datum`,";
        $sql.=" `dtaetkz-abg`.`Stat_Nr`";

//        $maxTage = 24;
//        $actualTag = 0;

        $result = $this->db->query($sql);
        if($this->db->affectedRows()>0){
            $tage = array();
            while($row = $result->fetch()){
                $tage[$row['datum']][$row['stat_nr']] = 1;
//                if($actualTag++ > $maxTage) break;
            }
            return $tage;
        }
        else
            return NULL;
    }

    public function getPlanStundenArray($persnr,$planoe,$datumvon,$days,$nurMA=FALSE){

    if(strlen(trim($planoe))==0 || strlen(trim($datumvon))==0) return NULL;

    $days -= 1;
    $planoe = strtr($planoe, '*', '%');
    $sql = '';
    $sql .=" select ".self::TABLE_DZEITSOLL.".persnr,CONCAT(".self::TABLE_DPERS.".name,' ',".self::TABLE_DPERS.".vorname) as name,DATE_FORMAT(".self::TABLE_DZEITSOLL.".datum,'%Y%m%d') as datum,sum(".self::TABLE_DZEITSOLL.".stunden) as anwstunden,sum(".self::TABLE_DZEITSOLL.".stunden_vzkd) as vzkdstunden,".self::TABLE_DPERS.".regeloe,".self::TABLE_DPERS.".regelarbzeit,".self::TABLE_DPERS.".anwvzkd_faktor as lfaktor";
    $sql .=" from ".self::TABLE_DZEITSOLL." ";
    $sql .=" join ".self::TABLE_DPERS." on ".self::TABLE_DPERS.".`PersNr`=".self::TABLE_DZEITSOLL.".persnr";
    $sql .=" where ".self::TABLE_DZEITSOLL.".datum between '$datumvon' and ADDDATE('$datumvon',$days) and ".self::TABLE_DZEITSOLL.".oe like '$planoe'";
    if(strlen(trim($persnr))>0)
        $sql .=" and ".self::TABLE_DPERS.".persnr='$persnr'";
    if($nurMA===TRUE){
	$sql .=" and ".self::TABLE_DPERS.".dpersstatus='MA'";
    }
    
    $sql .=" group by ".self::TABLE_DZEITSOLL.".persnr,".self::TABLE_DZEITSOLL.".datum;";

    //echo $sql;
    $result = $this->db->query($sql);

    if($this->db->affectedRows()>0){
        $personen = array();
        while($row = $result->fetch()){
            $personen[$row['persnr']][$row['datum']]['anwstunden'] = number_format($row['anwstunden'],1);
            $personen[$row['persnr']][$row['datum']]['vzkdstunden'] = number_format($row['vzkdstunden'],1);
            $personen[$row['persnr']]['regeloe'] = $row['regeloe'];
            $personen[$row['persnr']]['regelarbzeit'] = $row['regelarbzeit'];
            $personen[$row['persnr']]['lfaktor'] = $row['lfaktor'];
            $personen[$row['persnr']]['name'] = $row['name'];
        }
        return $personen;
    }
    else
            return NULL;
}

        /**
         *
         * @param int $persnr
         * @param string $field
         * @param string $value
         */
        public function updateDpersFieldProPersNr($persnr,$field,$value){
            if($value==NULL)
                $sql = "update ".self::TABLE_DPERS." set $field=null where persnr='$persnr' limit 1";
            else
                $sql = "update ".self::TABLE_DPERS." set $field='$value' where persnr='$persnr' limit 1";
            $this->db->query($sql);
            return $this->db->affectedRows();
        }

        public function updateDBewerberFieldProPersNr($persnr,$field,$value){
            if($value==NULL)
                $sql = "update ".self::TABLE_DPERSBEWERBER." set $field=null where persnr='$persnr' limit 1";
            else
                $sql = "update ".self::TABLE_DPERSBEWERBER." set $field='$value' where persnr='$persnr' limit 1";
            $this->db->query($sql);
            return $this->db->affectedRows();
        }

         public function updateDpersFaehigkeitFieldProId($id,$field,$value){
            if($value==NULL){
                if($field=='bemerkung')
                    $sql = "update ".self::TABLE_DPERSFAEHIGKEIT." set $field=null where id='$id' limit 1";
                else
                    $sql = "update ".self::TABLE_DPERSFAEHIGKEIT." set $field=0 where id='$id' limit 1";
            }
            else
                $sql = "update ".self::TABLE_DPERSFAEHIGKEIT." set $field='$value' where id='$id' limit 1";
            $this->db->query($sql);
            return $this->db->affectedRows();
        }

       public function updateDpersSchulungFieldProId($id,$field,$value){
            if($value==NULL){
                    $sql = "update ".self::TABLE_DPERSSCHULUNG." set $field=null where id='$id' limit 1";
            }
            else
                $sql = "update ".self::TABLE_DPERSSCHULUNG." set $field='$value' where id='$id' limit 1";
            $this->db->query($sql);
            return $this->db->affectedRows();
        }

        /**
         *
         * @param int $persnr
         * @param string $field
         * @param string $value
         */
        public function updateDurlaubFieldProPersNr($persnr,$field,$value) {
            // zkusit, jestli mam pro persnr vytvoreny radek
            $result = $this->db->query("select persnr from ".self::TABLE_URLAUB." where persnr='$persnr'");
            if(count($result)==0) {
                $sql = "insert into ".self::TABLE_URLAUB." (persnr) values('$persnr')";
                $this->db->query($sql);
            }

            if($value==NULL)
                $sql = "update ".self::TABLE_URLAUB." set $field=null where persnr='$persnr' limit 1";
            else
                $sql = "update ".self::TABLE_URLAUB." set $field='$value' where persnr='$persnr' limit 1";
            $this->db->query($sql);
            return $this->db->affectedRows();
        }

        /**
         *
         * @param int $persnr
         * @param string $field
         * @param string $value
         */
        public function updateDpersDetailFieldProPersNr($persnr,$field,$value){
            if($value==NULL)
                $sql = "update ".self::TABLE_DPERSDETAIL." set $field=null where persnr='$persnr' limit 1";
            else
                $sql = "update ".self::TABLE_DPERSDETAIL." set $field='$value' where persnr='$persnr' limit 1";
            $this->db->query($sql);
            return $this->db->affectedRows();
        }

        /**
         *
         *  vytvorim zaznamy pro noveho zamestnance
         * 
         * @param int $persnr
         * @return int vraci osobni cislo, pokud se nepovede, tak vratim 0 
         */
        public function newPersNr($persnr,$dpersStatus='MA'){
            // pro jistotu zkusim zda opravdu toto cislo uz neexistuje
            $sql = "select persnr from ".self::TABLE_DPERS." where persnr='$persnr'";
            $result=$this->db->query($sql);
            if(count($result)==0){
                $this->db->query("delete from ".self::TABLE_DPERS." where persnr='$persnr' limit 1");
                $this->db->query("delete from ".self::TABLE_DPERSDETAIL." where persnr='$persnr' limit 1");
                $this->db->query("delete from ".self::TABLE_URLAUB." where persnr='$persnr' limit 1");

                //$eintrittsdatum = date('Y-m-d');
                $sql_dpers = "insert into ".self::TABLE_DPERS." (persnr,name,vorname,dpersstatus,premie_za_vykon,premie_za_kvalitu,premie_za_prasnost,premie_za_3_mesice,regelarbzeit,regeloe)";
                $sql_dpers.=" values(".$persnr.",'Name eingeben','Vorname eingeben','".$dpersStatus."',0,0,0,0,8,'-')";
                $this->db->query($sql_dpers);

                $sql_dpers = "insert into ".self::TABLE_DPERSDETAIL." (persnr)";
                $sql_dpers.=" values(".$persnr.")";
                $this->db->query($sql_dpers);

                $sql_dpers = "insert into ".self::TABLE_URLAUB." (persnr)";
                $sql_dpers.=" values(".$persnr.")";
                $this->db->query($sql_dpers);

                //bewerber table
                $sql_dpers = "insert into ".self::TABLE_DPERSBEWERBER." (persnr)";
                $sql_dpers.=" values(".$persnr.")";
                $this->db->query($sql_dpers);

                return $persnr;
            }

            else
                return 0;
        }

        /**
         * gets array with info about persnr
         *
         * @param integer $persnr
         * @return array array from dperstable or null if persnr is not found
         *
         */
        public function getPersnrInfoFromName($name,$nurActiveMA=TRUE){
            $sql = "select dpers.persnr";
            $sql.=" ,dpers.name";
            $sql.=" ,dpers.vorname";
            $sql.=" ,DATE_FORMAT(dpers.eintritt,'%d.%m.%Y') as eintritt";
            $sql.=" ,DATE_FORMAT(dpers.austritt,'%d.%m.%Y') as austritt";
            $sql.=" ,DATE_FORMAT(dpers.geboren,'%d.%m.%Y') as geboren";
            $sql.=" ,dpers.schicht";
	    $sql.=" ,dpers.gebort";
            $sql.=" ,dpers.einsatzschicht";
            $sql.=" ,dpers.regelarbzeit";
            $sql.=" ,dpers.auto_leistung";
            $sql.=" ,dpers.komm_ort";
	    $sql.=" ,dpers.email";
            $sql.=" ,dpers.regeloe";
            $sql.=" ,dpers.alteroe";
            $sql.=" ,dpers.premie_za_vykon";
            $sql.=" ,dpers.qpremie_akkord";
            $sql.=" ,dpers.qpremie_zeit";
            $sql.=" ,dpers.premie_za_prasnost";
            $sql.=" ,dpers.premie_za_3_mesice";
            $sql.=" ,dpers.bewertung";
            $sql.=" ,dpers.lohnfaktor";
            $sql.=" ,dpers.leistfaktor";
            $sql.=" ,dpers.anwvzkd_faktor";
            $sql.=" ,DATE_FORMAT(".self::TABLE_DPERSDETAIL.".dobaurcita,'%d.%m.%Y') as dobaurcita";
            $sql.=" ,DATE_FORMAT(".self::TABLE_DPERSDETAIL.".zkusebni_doba_dobaurcita,'%d.%m.%Y') as zkusebni_doba_dobaurcita";
            $sql.=" ,".self::TABLE_DPERSDETAIL.".strasse";
            $sql.=" ,".self::TABLE_URLAUB.".jahranspruch";
            $sql.=" ,".self::TABLE_URLAUB.".rest";
            $sql.=" ,".self::TABLE_URLAUB.".gekrzt";
            $sql.=" ,".self::TABLE_DPERSDETAIL.".kom7"; //handy
            $sql.=" from ".self::TABLE_DPERS;
            $sql.=" left join ".self::TABLE_DPERSDETAIL." on ".self::TABLE_DPERS.".persnr=".self::TABLE_DPERSDETAIL.".persnr";
            $sql.=" left join ".self::TABLE_URLAUB." on ".self::TABLE_DPERS.".persnr=".self::TABLE_URLAUB.".persnr";
            $sql.=" where UPPER(".self::TABLE_DPERS.".name) like UCASE('%$name%') ";
            // mozno zadat jakoukoliv velikost pisma, ty prevexu na velke a teprve potom porovnam.
            if($nurActiveMA)
                $sql.=" and (".self::TABLE_DPERS.".austritt is null or ".self::TABLE_DPERS.".eintritt>".self::TABLE_DPERS.".austritt) and (".self::TABLE_DPERS.".dpersstatus='MA')";
            $sql.=" order by dpers.persnr";
            $result = $this->db->query($sql);
            if(count($result)>0){
                $rows = $result->fetchAll();
                //return $rows[0];
                return $rows;
            }
            else{
                return NULL;
            }
        }


        public function getBewerbInfo($persnr){
            $sql = "select *";
            $sql.=",DATE_FORMAT(".self::TABLE_DPERSBEWERBER.".bewerbe_datum,'%d.%m.%Y') as bewerbe_datumF";
            $sql.=",DATE_FORMAT(".self::TABLE_DPERSBEWERBER.".eintritt_datum,'%d.%m.%Y') as eintritt_datumF";
            $sql.= " from ".self::TABLE_DPERSBEWERBER." ";
            $sql.=" where persnr=%i";
            $result = $this->db->query($sql,$persnr);
            if(count($result)>0){
                $rows = $result->fetchAll();
                return $rows[0];
            }
            else{
                // pokud dane persnr nema v tabulce jeste zadny zaznam, tak mu vytvorim novy
                $dateNowDB = NULL;
                // pokud uz ma datum nastupu, je to stary zamestnanec a bewerbedatum mu nastavim na datum nastupu
                $sql_eintritt = "select eintritt from dpers where persnr='$persnr'";
                $result = $this->db->query($sql_eintritt);
                if(count($result)>0){
                    $eintrittDB = $result->fetchSingle();
                    if($eintrittDB!=NULL)  $dateNowDB = $eintrittDB;
                }
                if($dateNowDB===NULL) $dateNowDB = date('Y-m-d');
                $sql_insert = "insert into ".self::TABLE_DPERSBEWERBER." ";
                $sql_insert.= "(persnr,bewerbe_datum)";
                $sql_insert.= "values($persnr,'$dateNowDB')";
                $this->db->query($sql_insert);
                // a jeste jednou zopakuju vyber z DB
                $result = $this->db->query($sql,$persnr);
                $rows = $result->fetchAll();
                return $rows[0];
            }
        }

	/**
	 * 
	 */
    	public function getBefristetDatum($persnr){
	    $retValue = '';
	    $sql="select DATE_FORMAT(befristet,'%d.%m.%Y') as befristet from dpersvertrag where persnr=$persnr order by eintritt desc";
	    $result = $this->db->query($sql);
            if(count($result)>0) $retValue = $result->fetchSingle();
            return $retValue;
	}

	/**
	 *
	 * @param type $persnr
	 * @return type 
	 */
   	public function getProbezeitDatum($persnr){
	    $retValue = '';
	    $sql="select DATE_FORMAT(probezeit,'%d.%m.%Y') as probezeit from dpersvertrag where persnr=$persnr order by eintritt desc";
	    $result = $this->db->query($sql);
            if(count($result)>0) $retValue = $result->fetchSingle();
            return $retValue;
	}

        /**
         * gets array with info about persnr
         * 
         * @param integer $persnr
         * @return array array from dperstable or null if persnr is not found
         * 
         */
        public function getPersnrInfo($persnr,$nurActiveMA=TRUE){

            // vytvorim si rozsah datumu pro aktualni mesic
            $aktMonat = date('m');
            $aktJahr = date('Y');
            $aktmonatVon = sprintf("%04d-%02d-%02d",$aktJahr,$aktMonat,1);
            $pocetDnuVMesici = cal_days_in_month(CAL_GREGORIAN, $aktMonat, $aktJahr);
            $aktmonatBis = sprintf("%04d-%02d-%02d",$aktJahr,$aktMonat,$pocetDnuVMesici);

            //select sum(if(drueck.auss_typ=4,(drueck.`Stück`+drueck.`Auss-Stück`)*drueck.`VZ-IST`,drueck.`Stück`*drueck.`VZ-IST`)) as vzaby from drueck where drueck.`Datum` between '2010-10-01' and '2010-10-31' and drueck.`PersNr`=2
            $sql = "select dpers.persnr";
            $sql.=" ,dpers.name";
            $sql.=" ,dpers.vorname";
            $sql.=" ,dpers.abkrz";
            $sql.=" ,DATE_FORMAT(dpers.eintritt,'%d.%m.%Y') as eintritt";
            $sql.=" ,DATE_FORMAT(dpers.austritt,'%d.%m.%Y') as austritt";
            $sql.=" ,DATE_FORMAT(dpers.geboren,'%d.%m.%Y') as geboren";
            $sql.=" ,dpers.schicht";
	    $sql.=" ,dpers.gebort";
            $sql.=" ,dpers.einsatzschicht";
            $sql.=" ,dpers.dpersstatus";
            $sql.=" ,dpers.regelarbzeit";
            $sql.=" ,dpers.auto_leistung";
	    $sql.=" ,dpers.auto_leistung_abgnr";
            $sql.=" ,dpers.kor";
	    $sql.=" ,dpers.email";
            $sql.=" ,dpers.komm_ort";
            $sql.=" ,dpers.regeloe";
            $sql.=" ,dpers.alteroe";
            $sql.=" ,dpers.premie_za_vykon";
            $sql.=" ,dpers.qpremie_akkord";
            $sql.=" ,dpers.qpremie_zeit";
            $sql.=" ,dpers.premie_za_prasnost";
            $sql.=" ,dpers.premie_za_3_mesice";
	    $sql.=" ,dpers.a_praemie";
	    $sql.=" ,dpers.a_praemie_st";
            $sql.=" ,dpers.bewertung";
            $sql.=" ,dpers.MAStunden";
            $sql.=" ,dpers.einarb_zuschlag";
            $sql.=" ,dpers.lohnfaktor";
            $sql.=" ,dpers.leistfaktor";
            $sql.=" ,dpers.anwvzkd_faktor";
	    $sql.=" ,dpers.anwgruppe";
            $sql.=" ,DATE_FORMAT(".self::TABLE_DPERSDETAIL.".dobaurcita,'%d.%m.%Y') as dobaurcita";
            $sql.=" ,DATE_FORMAT(".self::TABLE_DPERSDETAIL.".zkusebni_doba_dobaurcita,'%d.%m.%Y') as zkusebni_doba_dobaurcita";
            $sql.=" ,".self::TABLE_DPERSDETAIL.".strasse";
            $sql.=" ,".self::TABLE_DPERSDETAIL.".regeltrans";
            $sql.=" ,".self::TABLE_DPERSDETAIL.".kasten";
            $sql.=" ,".self::TABLE_DPERSDETAIL.".schuhegroesse";
            $sql.=" ,".self::TABLE_DPERSDETAIL.".strasse_op";
            $sql.=" ,".self::TABLE_DPERSDETAIL.".ort_op";
            $sql.=" ,".self::TABLE_DPERSDETAIL.".plz_op";
            $sql.=" ,".self::TABLE_DPERSDETAIL.".plz";
            $sql.=" ,".self::TABLE_DPERSDETAIL.".kfz_rz";
            $sql.=" ,".self::TABLE_DPERSDETAIL.".umkleidenr";
            $sql.=" ,".self::TABLE_URLAUB.".jahranspruch";
            $sql.=" ,".self::TABLE_URLAUB.".rest";
            $sql.=" ,".self::TABLE_URLAUB.".gekrzt";
            $sql.=" ,".self::TABLE_DPERSDETAIL.".kom7"; //handy
            //$sql.=" ,".self::TABLE_DPERSBEWERBER.".*";
            $sql.=" from ".self::TABLE_DPERS;
            $sql.=" left join ".self::TABLE_DPERSDETAIL." on ".self::TABLE_DPERS.".persnr=".self::TABLE_DPERSDETAIL.".persnr";
            $sql.=" left join ".self::TABLE_URLAUB." on ".self::TABLE_DPERS.".persnr=".self::TABLE_URLAUB.".persnr";
            //$sql.=" left join ".self::TABLE_DPERSBEWERBER." on ".self::TABLE_DPERS.".persnr=".self::TABLE_DPERSBEWERBER.".persnr";
            $sql.=" where ".self::TABLE_DPERS.".persnr=%i";
            if($nurActiveMA)
                $sql.=" and (".self::TABLE_DPERS.".austritt is null or ".self::TABLE_DPERS.".eintritt>".self::TABLE_DPERS.".austritt) and (".self::TABLE_DPERS.".dpersstatus='MA')";
            $result = $this->db->query($sql,$persnr);
            if(count($result)>0){
                $rows = $result->fetchAll();
//                // zjistit jeho mesicni vykon
//                $sql = "select sum(if(drueck.auss_typ=4,(drueck.`Stück`+drueck.`Auss-Stück`)*drueck.`VZ-IST`,drueck.`Stück`*drueck.`VZ-IST`)) as vzaby from drueck where drueck.`Datum` between '$aktmonatVon' and '$aktmonatBis' and drueck.`PersNr`='$persnr'";
//                $result = $this->db->query($sql);
//                if(count($result)>0)
//                    $vzaby = $result->fetchSingle ();
//                else
//                    $vzaby = 0;
//                $rows[0]['leistaktmonat'] = round($vzaby);

                // zjistim si bewerberinfo
                $bewerberInfo = $this->getBewerbInfo($persnr);
                $persinfoArray = $rows[0];
                // pridam polozky z bewerberinfo do persinfo
                foreach ($bewerberInfo as $key => $value) {
                    $persinfoArray[$key] = $value;
                }
                Debug::fireDump($persinfoArray,'persinfo');
                return $persinfoArray;
            }
            else{
                return NULL;
            }
        }

/**
 *
 * @param <type> $id
 */
public function deleteVorschussRow($id) {
    $sql = "delete from ".self::TABLE_VORSCHUSS." where id_vorschuss=%i limit 1";
    $this->db->query($sql,$id);
}
public function addVorschussRow($persnr,$vorschuss,$datum){
    $sql = "insert into ".self::TABLE_VORSCHUSS." (persnr,vorschuss,datum) values('$persnr','$vorschuss','$datum')";
    $this->db->query($sql);
    $insertedID = $this->db->insertId();
    return $insertedID;
}

public function copyPersnr($persnralt,$persnrneu){
    
    // 1.dpers
    $table = self::TABLE_DPERS;
    $sql = "select * from dpers where `PersNr`=$persnralt";
    $result = $this->db->query($sql);
    if(count($result)>0){
        $row = $result->fetch();
        $row['PersNr'] = $persnrneu;
        $row['persnr_alt'] = $persnralt;
        unset($row['stamp']);
        $this->db->query("insert into dpers",$row);
    }

    // 2. dpersbewerber
    $table = self::TABLE_DPERSBEWERBER;
    $sql = "select * from $table where `persnr`=$persnralt";
    $result = $this->db->query($sql);
    if(count($result)>0){
        $row = $result->fetch();
        $row['persnr'] = $persnrneu;
        unset($row['stamp']);
        $this->db->query("insert into $table",$row);
    }

    // 3. dpersdetail1
    $table = self::TABLE_DPERSDETAIL;
    $sql = "select * from $table where `persnr`=$persnralt";
    $result = $this->db->query($sql);
    if(count($result)>0){
        $row = $result->fetch();
        $row['persnr'] = $persnrneu;
        unset($row['stamp']);
        $this->db->query("insert into $table",$row);
    }

    // 4. dpersfaehigkeit
    $table = self::TABLE_DPERSFAEHIGKEIT;
    $sql = "select * from $table where `persnr`=$persnralt";
    $result = $this->db->query($sql);
    if(count($result)>0){
        while($row = $result->fetch()){
            $row['persnr'] = $persnrneu;
            unset($row['stamp']);
            unset($row['id']);
            $this->db->query("insert into $table",$row);
        }
    }

    //durlaub1
    $table = 'durlaub1';
    $sql = "select * from $table where `persnr`=$persnralt";
    $result = $this->db->query($sql);
    if(count($result)>0){
        while($row = $result->fetch()){
            $row['PersNr'] = $persnrneu;
            unset($row['stamp']);
            unset($row['ID']);
            $this->db->query("insert into $table",$row);
        }
    }

    //dpersuntersuchungdatum
    $table = self::TABLE_DPERSUNTERSUCHUNGDATUM;
    $sql = "select * from $table where `persnr`=$persnralt";
    $result = $this->db->query($sql);
    if(count($result)>0){
        while($row = $result->fetch()){
            $row['persnr'] = $persnrneu;
            unset($row['stamp']);
            unset($row['id']);
            $this->db->query("insert into $table",$row);
        }
    }

    //dstddif
    $table = self::TABLE_DSTDDIF;
    $sql = "select * from $table where `persnr`=$persnralt";
    $result = $this->db->query($sql);
    if(count($result)>0){
        while($row = $result->fetch()){
            $row['persnr'] = $persnrneu;
            unset($row['stamp']);
            unset($row['id']);
            $this->db->query("insert into $table",$row);
        }
    }

    // dpersschulung
    $table = self::TABLE_DPERSSCHULUNG;
    $sql = "select * from $table where `persnr`=$persnralt";
    $result = $this->db->query($sql);
    if(count($result)>0){
        while($row = $result->fetch()){
            $row['persnr'] = $persnrneu;
            unset($row['stamp']);
            unset($row['id']);
            $this->db->query("insert into $table",$row);
        }
    }

    //dpersstempel
    $table = self::TABLE_DPERSSTEMPEL;
    $sql = "select * from $table where `persnr`=$persnralt";
    $result = $this->db->query($sql);
    if(count($result)>0){
        while($row = $result->fetch()){
            $row['persnr'] = $persnrneu;
            unset($row['stamp']);
            unset($row['id']);
            $this->db->query("insert into $table",$row);
        }
    }

// dperspremie
//    $table = self::TABLE_DPERSPREMIE;
//    $sql = "select * from $table where `persnr`=$persnralt";
//    $result = $this->db->query($sql);
//    if(count($result)>0){
//        while($row = $result->fetch()){
//            $row['persnr'] = $persnrneu;
//            unset($row['stamp']);
//            $this->db->query("insert into $table",$row);
//        }
//    }

//dunterkunft
//    $table = 'dunterkunft';
//    $sql = "select * from $table where `persnr`=$persnralt";
//    $result = $this->db->query($sql);
//    if(count($result)>0){
//        while($row = $result->fetch()){
//            $row['persnr'] = $persnrneu;
//            //unset($row['stamp']);
//            $this->db->query("insert into $table",$row);
//        }
//    }


  //persunfall
//    $table = 'persunfall';
//    $sql = "select * from $table where `persnr`=$persnralt";
//    $result = $this->db->query($sql);
//    if(count($result)>0){
//        while($row = $result->fetch()){
//            $row['persnr'] = $persnrneu;
//            unset($row['stamp']);
//            $this->db->query("insert into $table",$row);
//        }
//    }

    //dabmahnung
//    $table = 'dabmahnung';
//    $sql = "select * from $table where `persnr`=$persnralt";
//    $result = $this->db->query($sql);
//    if(count($result)>0){
//        while($row = $result->fetch()){
//            $row['persnr'] = $persnrneu;
//            unset($row['stamp']);
//            $this->db->query("insert into $table",$row);
//        }
//    }

    return $this->db->affectedRows();
}


public function addDatumToVertragArchiv(){
$sql='';
$sql.=" select";
$sql.=" dpers.`PersNr` as persnr,";
$sql.=" dpers.eintritt,";
$sql.=" dpers.austritt,";
$sql.=" dpersdetail1.dobaurcita as befristet,";
$sql.=" dpersdetail1.zkusebni_doba_dobaurcita as probezeit,";
$sql.=" dpers.regelarbzeit";
$sql.=" from";
$sql.=" dpers";
$sql.=" join dpersdetail1 on dpersdetail1.persnr=dpers.`PersNr`";
$sql.=" order by";
$sql.=" dpers.`PersNr`";

$result = $this->db->query($sql);
while($row = $result->fetch()){
    $this->db->query("insert into dpersvertrag",$row);
}

}
public function addAbgNrToAuftrag($vzkd,$vzaby,$abgnrToAdd,$abgnrIst,$kunde,$exportvon,$exportbis,$teil,$nichtEX=TRUE){

    if($nichtEX==TRUE){
        $sql = "select daufkopf.minpreis,dauftr.* from dauftr join daufkopf on daufkopf.auftragsnr=dauftr.auftragsnr where daufkopf.kunde=%i and dauftr.abgnr=%i and (`auftragsnr-exp` between %i and %i or `auftragsnr-exp` is null) and dauftr.teil=%s";
    }
    else{
        $sql = "select daufkopf.minpreis,dauftr.* from dauftr join daufkopf on daufkopf.auftragsnr=dauftr.auftragsnr where daufkopf.kunde=%i and dauftr.abgnr=%i and (`auftragsnr-exp` between %i and %i) and dauftr.teil=%s";
    }

    $result = $this->db->query($sql,$kunde,$abgnrIst,$exportvon,$exportbis,$teil);
    while($row = $result->fetch()){
        unset($row['id_dauftr']);
        $minpreis = floatval($row['minpreis']);
        unset($row['minpreis']);
        $row['mehrarb-kz']='Mp';
        $row['abgnr'] = $abgnrToAdd;
        $row['VzKd'] = $vzkd;
        $row['VzAby'] = $vzaby;
        $row['preis'] = round($vzkd*$minpreis,4);
        Debug::dump($row);
        $this->db->query("insert into dauftr",$row);
    }
}

public function addAbgNrToDrueck($vzkd,$vzaby,$abgnrToAdd,$abgnrIst,$kunde,$exportvon,$exportbis,$teil,$nichtEX=TRUE){

    if($nichtEX==TRUE){
        $sql = "select drueck.* from drueck join dauftr on dauftr.auftragsnr=drueck.auftragsnr and dauftr.teil=drueck.teil and dauftr.`pos-pal-nr`=drueck.`pos-pal-nr` and dauftr.abgnr=drueck.taetnr join daufkopf on daufkopf.auftragsnr=dauftr.auftragsnr where daufkopf.kunde=%i and dauftr.abgnr=%i and (`auftragsnr-exp` between %i and %i or `auftragsnr-exp` is null) and dauftr.teil=%s";
    }
    else{
        $sql = "select daufkopf.minpreis,dauftr.* from dauftr join daufkopf on daufkopf.auftragsnr=dauftr.auftragsnr where daufkopf.kunde=%i and dauftr.abgnr=%i and (`auftragsnr-exp` between %i and %i) and dauftr.teil=%s";
    }

    $result = $this->db->query($sql,$kunde,$abgnrIst,$exportvon,$exportbis,$teil);
    while($row = $result->fetch()){
        unset($row['drueck_id']);
        //$row['mehrarb-kz']='Mp';
        $row['TaetNr'] = $abgnrToAdd;
        $row['VZ-SOLL'] = $vzkd;
        $row['VZ-IST'] = $vzaby;
        $row['Verb-Zeit']=0;
        $row['verb-von']='2011-03-03 00:00:00';
        $row['verb-bis']='2011-03-03 00:00:00';
        $row['verb-pause']=0;
        $row['marke-aufteilung']='';
        $row['Auss-Stück']=0;
        $row['auss_typ']=0;
        unset($row['stamp']);
//        $row['preis'] = round($vzkd*$minpreis,4);
        Debug::dump($row);
        $this->db->query("insert into drueck",$row);
    }
}

public function deletePersnr($persnr){
    $this->db->query("delete from dpers where persnr='$persnr'");
    $this->db->query("delete from dpersbewerber where persnr='$persnr'");
    $this->db->query("delete from dpersdetail1 where persnr='$persnr'");
    $this->db->query("delete from dpersfaehigkeit where persnr='$persnr'");
    $this->db->query("delete from durlaub1 where persnr='$persnr'");
    $this->db->query("delete from dpersuntersuchungdatum where persnr='$persnr'");
    $this->db->query("delete from dstddif where persnr='$persnr'");
    $this->db->query("delete from dpersschulung where persnr='$persnr'");
    $this->db->query("delete from dpersstempel where persnr='$persnr'");
}
public function addSonstpremieRow($persnr,$dbDatum,$premie_id,$betrag){
    $sql = "insert into ".self::TABLE_DPERSPREMIE." (persnr,datum,id_premie,betrag) values('$persnr','$dbDatum','$premie_id','$betrag')";
    $this->db->query($sql);
    $insertedID = $this->db->insertId();
    return $insertedID;
}
public function addTransportRow($persnr,$dbDatum,$kfz_id,$route_id,$preis){
    $sql = "insert into ".self::TABLE_TRANSPORT." (persnr,datum,route_id,preis,kfz) values('$persnr','$dbDatum','$route_id','$preis','$kfz_id')";
    $this->db->query($sql);
    $insertedID = $this->db->insertId();
    return $insertedID;
}

public function addAbmahnungRow($persnr,$dbDatum,$grund,$betrag,$dbDatumBetrag,$bemerkung,$reklamation,$vorschlag,$vorschlag_von,$vorschlag_betrag,$vorschlag_bemerkung){
    if(strlen($dbDatumBetrag)>0)
        $sql = "insert into ".self::TABLE_DPERSABMAHNUNG." (persnr,datum,grund,betr,betrdat,bemerk,dreklamation_id,vorschlag,vorschlag_von,vorschlag_betrag,vorschlag_bemerkung) values('$persnr','$dbDatum','$grund','$betrag','$dbDatumBetrag','$bemerkung','$reklamation','$vorschlag','$vorschlag_von','$vorschlag_betrag','$vorschlag_bemerkung')";
    else
        $sql = "insert into ".self::TABLE_DPERSABMAHNUNG." (persnr,datum,grund,betr,bemerk,dreklamation_id,vorschlag,vorschlag_von,vorschlag_betrag,vorschlag_bemerkung) values('$persnr','$dbDatum','$grund','$betrag','$bemerkung',$reklamation,'$vorschlag','$vorschlag_von','$vorschlag_betrag','$vorschlag_bemerkung')";
    $this->db->query($sql);
    $insertedID = $this->db->insertId();
    return $insertedID;
}

public function addVerletzungRow($persnr,$dbDatum,$grund){
    $sql = "insert into ".self::TABLE_DPERSUNFALL." (pernr,datum,typ) values('$persnr','$dbDatum','$grund')";
    $this->db->query($sql);
    $insertedID = $this->db->insertId();
    return $insertedID;
}
public function addDpersStempelRow($persnr,$oe,$qpraemie_prozent,$stempel_id,$dbDatumVon){
    $sql = "insert into ".self::TABLE_DPERSSTEMPEL." (persnr,oe,qpraemie_prozent,stempel_id,datum_von) values('$persnr','$oe','$qpraemie_prozent','$stempel_id','$dbDatumVon')";
    $this->db->query($sql);
    $insertedID = $this->db->insertId();
    return $insertedID;
}
public function addDpersFaehigkeitRow($persnr,$faehigkeit_id,$soll,$ist,$bemerkung){
    $sql = "insert into ".self::TABLE_DPERSFAEHIGKEIT." (persnr,faehigkeit_id,soll,ist,bemerkung) values('$persnr','$faehigkeit_id','$soll','$ist','$bemerkung')";
    $this->db->query($sql);
    $insertedID = $this->db->insertId();
    return $insertedID;
}

public function refreshDpersDatumsFromVertrag($persnr,$vertragID){
    // pokud dostanu persnr = NULL, tak si ho zjistimz archivu smluv
    //Debug::fireLog("refreshDpersDatumsFromVertrag persnr=".$persnr.",vertragID=".$vertragID);

    $refreshDpersDatums = FALSE;

    if($persnr===NULL){
        $sql = "select persnr from ".self::TABLE_DPERSVERTRAG." where id=$vertragID";
        $res = $this->db->query($sql);
        $row = $res->fetch();
        $persnr = $row['persnr'];
    }
    
    // zjistim aktualni hodnotu eintritt
    $sql = "select ".self::TABLE_DPERS.".eintritt,".self::TABLE_DPERS.".austritt";
    $sql.= " ,dobaurcita,zkusebni_doba_dobaurcita";
    $sql.= " from ".self::TABLE_DPERS;
    $sql.= " join ".self::TABLE_DPERSDETAIL." on ".self::TABLE_DPERSDETAIL.".persnr=".self::TABLE_DPERS.".persnr";
    $sql.= " where ".self::TABLE_DPERS.".persnr='$persnr'";
    $res = $this->db->query($sql);
    if(count($res)>0){
        $row = $res->fetch();
        $dpersEintritt = $row['eintritt'];
        $dpersAustritt = $row['austritt'];
        $dpersBefristet = $row['dobaurcita'];
        $dpersProbezeit = $row['zkusebni_doba_dobaurcita'];
        Debug::fireLog("refreshDpersDatumsFromVertrag dperseintritt=".$dpersEintritt.",dpersaustritt=".$dpersAustritt.",dpersbefristet=".$dpersBefristet.",dpersprobezeit=".$dpersProbezeit);
    }
    else
        return $refreshDpersDatums;

    // vyberu radek s poslednim eintrittem ktery znaci pocatek smlouvy z archivu
    $sql = "select max(eintritt) as eintritt from ".self::TABLE_DPERSVERTRAG." where persnr='$persnr' and vertrag_anfang<>0";
    $res = $this->db->query($sql);
    if(count($res)>0){
        // porovnam s aktualni hodnotou v eintritt v dpers
        $row = $res->fetch();
        $vertragEintritt = $row['eintritt'];
        if($dpersEintritt!=$vertragEintritt){
            $this->updateDpersFieldProPersNr($persnr, 'eintritt', $vertragEintritt);
            $refreshDpersDatums = TRUE;
        }
    }

    // a jeste jednou vyberu radek s poslednim eintrittem z archivu, tentokrat i hodnoty pro austritt, befristet a probezeit
    $sql = "select eintritt,austritt,befristet,probezeit,vertrag_anfang from ".self::TABLE_DPERSVERTRAG." where persnr='$persnr' order by eintritt desc";
    $res = $this->db->query($sql);
    if(count($res)>0){
        // porovnam s aktualni hodnotou v eintritt v dpers
        $row = $res->fetch();
        $vertragEintritt = $row['eintritt'];
        $vertragAustritt = $row['austritt'];
        $vertragBefristet = $row['befristet'];
        $vertragProbezeit = $row['probezeit'];
        $vertragAnfang = $row['vertrag_anfang'];

        if(($dpersEintritt!=$vertragEintritt)&&($vertragAnfang!=0)){
            $this->updateDpersFieldProPersNr($persnr, 'eintritt', $vertragEintritt);
            $refreshDpersDatums = TRUE;
        }

        if($dpersAustritt!=$vertragAustritt){
            $this->updateDpersFieldProPersNr($persnr, 'austritt', $vertragAustritt);
            $refreshDpersDatums = TRUE;
        }

        if($dpersProbezeit!=$vertragProbezeit){
            $this->updateDpersDetailFieldProPersNr($persnr, 'zkusebni_doba_dobaurcita', $vertragProbezeit);
            $refreshDpersDatums = TRUE;
        }

        if($dpersBefristet!=$vertragBefristet){
            $this->updateDpersDetailFieldProPersNr($persnr, 'dobaurcita', $vertragBefristet);
            $refreshDpersDatums = TRUE;
        }
    }

    return $refreshDpersDatums;
    //
}

public function addDpersVertragRow($persnr, $eintritt,$austritt,$probezeit,$befristet,$regelstunden,$vertrag_anfang,$verlang,$vertragtypid){
    $sql = "insert into ".self::TABLE_DPERSVERTRAG;
    $arr = array(
        'persnr'=>$persnr,
        'eintritt'=>$eintritt,
        'austritt'=>$austritt,
        'probezeit'=>$probezeit,
        'befristet'=>$befristet,
        'regelarbzeit'=>$regelstunden,
        'vertrag_anfang'=>$vertrag_anfang,
        'verlang'=>$verlang,
	'vertragtyp_id'=>$vertragtypid
    );
    $this->db->query($sql,$arr);
    $insertedID = $this->db->insertId();
    return $insertedID;
}

public function addDpersSchulungRow($persnr, $schulungid, $dbDatum,$schulung_ergebniss){
    $sql = "insert into dpersschulung (persnr,schulung_id,letzte_datum,ergebniss) values('$persnr','$schulungid','$dbDatum','$schulung_ergebniss')";
    $this->db->query($sql);
    $insertedID = $this->db->insertId();
    return $insertedID;
}

/**
 *
 * @param <type> $id
 */
public function deleteDpersStempelRow($id) {
    $sql = "delete from ".self::TABLE_DPERSSTEMPEL." where id=%i limit 1";
    $this->db->query($sql,$id);
}

public function deleteDpersFaehigkeitRow($id) {
    $sql = "delete from ".self::TABLE_DPERSFAEHIGKEIT." where id=%i limit 1";
    $this->db->query($sql,$id);
}

/**
 *
 * @param <type> $dpersschulungid
 */
public function deleteDpersSchulungRow($dpersschulungid){
    $sql = "delete from ".self::TABLE_DPERSSCHULUNG." where id=%i limit 1";
    $this->db->query($sql,$dpersschulungid);
}

/**
 *
 * @param integer $id
 * @param boolean $autoleistung
 */
public function deleteDzeitRow($id,$autoleistung=TRUE) {
    if($autoleistung==TRUE) {
        // pokud chci mazat i autoleistung
        $sql = "select persnr,`Schicht` as schicht,`Datum` as datum,tat as oe from dzeit where id=%i";
        $result = $this->db->query($sql,$id);
        $row = $result->fetch();
        if($row!=FALSE) {
            $persnr = $row['persnr'];
            $schicht = $row['schicht'];
            $datum = $row['datum'];
            $oe = $row['oe'];
            // zjistim abgnr, ktere by melo byt zadano pro zadanou smenu
            $sql = "select dschicht.auto_leistung,dschicht.auto_abgnr from dschicht where dschicht.`Schichtnr`=%i";
            $result = $this->db->query($sql,$schicht);
            $row = $result->fetch();
            if($row!=FALSE){
                $schichtAuto = $row['auto_leistung'];
                $autoAbgnr = $row['auto_abgnr'];
                // zjistit, zda ma clovek nastaven autoleistung priznak
                $sql = "select dpers.auto_leistung from dpers where persnr='$persnr'";
                $result = $this->db->query($sql);
                $row = $result->fetch();
                if($row!==FALSE){
                    if($row['auto_leistung']!=0){
                        // pro tohoto cloveka se zadava i autoleistung, budu ho tedy chtit i smazat
                        $sql_delete = "delete from drueck where persnr='$persnr' and datum='$datum' and auftragsnr=999999 and teil='9999' and oe='$oe' and drueck.`TaetNr`=$autoAbgnr limit 1";
                        $this->db->query($sql_delete);
                    }
                }
            }
        }
    }
    $sql = "delete from ".self::TABLE_DZEIT." where id=%i limit 1";
    $this->db->query($sql,$id);
}

public function deleteTransportRow($id) {
    $sql = "delete from ".self::TABLE_TRANSPORT." where id=%i limit 1";
    $this->db->query($sql,$id);
}

public function deleteVertragRow($id){
    $sql = "delete from ".self::TABLE_DPERSVERTRAG." where id=%i limit 1";
    $this->db->query($sql,$id);
}
public function deleteAbmahnungRow($id) {
    $sql = "delete from ".self::TABLE_DPERSABMAHNUNG." where id=%i limit 1";
    $this->db->query($sql,$id);
}

public function deleteVerletzungRow($id) {
    $sql = "delete from ".self::TABLE_DPERSUNFALL." where idun=%i limit 1";
    $this->db->query($sql,$id);
}
public function deleteSonstpremieRow($id) {
    $sql = "delete from ".self::TABLE_DPERSPREMIE." where id=%i limit 1";
    $this->db->query($sql,$id);
}

/**
 *
 * @param <type> $persnr
 */
public function getDpersStempelArray($persnr) {
    $sql = "select id,persnr,oe,qpraemie_prozent,stempel_id,DATE_FORMAT(datum_von,'%d.%m.%Y') as datum_von from ".self::TABLE_DPERSSTEMPEL." where persnr='$persnr' order by oe";
    $result = $this->db->query($sql);
    if(count($result)==0)
        return NULL;
    else {
        return $result->fetchAll();
    }
}

public function getTextBuchArray($kategorie=NULL,$orderby=NULL){
    $sql = "select * from ".self::TABLE_DTEXTBUCH;
    if($kategorie!==NULL)
        $sql.=" where kategorie='$kategorie'";
    if($orderby!==NULL)
        $sql.=" order by $orderby";
    $result = $this->db->query($sql);
    if(count($result)==0)
        return NULL;
    else
        return $result->fetchAll();
}

public function getKfzInfoArray($dienstwagen=1) {
    if($dienstwagen==1)
        $sql = "select id,CONCAT(rz,' ',marke) as fahrzeug from ".self::TABLE_KFZ." where aby_dienstwagen<>0 order by rz";
    else
        $sql = "select id,CONCAT(rz,' ',marke) as fahrzeug from ".self::TABLE_KFZ." order by rz";
    $result = $this->db->query($sql);
    if(count($result)==0)
        return NULL;
    else {
        return $result->fetchAll();
    }
}


public function getPremieInfoArray() {
    $sql = "select id,premiebeschreibung as beschreibung from ".self::TABLE_PREMIETYPEN." order by id";
    $result = $this->db->query($sql);
    if(count($result)==0)
        return NULL;
    else {
        return $result->fetchAll();
    }
}

public function getVertragTypInfoArray() {
    $sql = "select id,typ_kz from ".self::TABLE_VERTRAGTYPEN." order by id";
    $result = $this->db->query($sql);
    if(count($result)==0)
        return NULL;
    else {
        return $result->fetchAll();
    }
}


public function getReklamationInfoArray(){
    $sql = "select id,rekl_nr from ".self::TABLE_DREKLAMATION." order by rekl_nr";
    $result = $this->db->query($sql);
    if(count($result)==0)
        return NULL;
    else {
        return $result->fetchAll();
    }
}

public function getAbmahnungGrundInfoArray(){
    $sql = "select id,bezeichnung as beschreibung from ".self::TABLE_ABMAHNUNGTYPEN." order by id";
    $result = $this->db->query($sql);
    if(count($result)==0)
        return NULL;
    else {
        return $result->fetchAll();
    }
}

public function getVerletzungGrundInfoArray(){
    $sql = "select idunfall as id,unfalltyp as beschreibung from ".self::TABLE_UNFALLTYPEN." order by idunfall";
    $result = $this->db->query($sql);
    if(count($result)==0)
        return NULL;
    else {
        return $result->fetchAll();
    }
}
public function getFaehigkeitTypInfoArray(){
    $sql = "select id,beschreibung,stat_nr from ".self::TABLE_FAEHIGKEITTYP." order by stat_nr";
    $result = $this->db->query($sql);
    if(count($result)==0)
        return NULL;
    else {
        return $result->fetchAll();
    }
}
public function getFaehigkeitInfoArray($typ=NULL){
    if($typ===NULL)
        $sql = "select id,beschreibung,faehigkeit_typ,faeh_abkrz from ".self::TABLE_FAEHIGKEITEN." order by id";
    else
        $sql = "select id,beschreibung,faehigkeit_typ,faeh_abkrz from ".self::TABLE_FAEHIGKEITEN." where faehigkeit_typ='$typ' order by id";
    $result = $this->db->query($sql);
    if(count($result)==0)
        return NULL;
    else {
        return $result->fetchAll();
    }
}

public function getOEInfoArray() {
    $sql = "select tat,og from ".self::TABLE_TATTYPEN." order by tat";
    $result = $this->db->query($sql);
    if(count($result)==0)
        return NULL;
    else {
        return $result->fetchAll();
    }
}

public function getRouteInfoArray() {
    $sql = "select id,von_ort as name from ".self::TABLE_ROUTE." order by id";
    $result = $this->db->query($sql);
    if(count($result)==0)
        return NULL;
    else {
        return $result->fetchAll();
    }
}

/**
 *
 */
public function getEssenInfoArray() {
    $sql = "select id_essen as id,essen_kz from ".self::TABLE_DESSEN." order by id_essen";
    $result = $this->db->query($sql);
    if(count($result)==0)
        return NULL;
    else {
        return $result->fetchAll();
    }
}

public function updateDzeitEssen($dzeitId,$essenId,$essen){
    $sql = "update ".self::TABLE_DZEIT." set id_essen='$essenId',essen='$essen' where id='$dzeitId' limit 1";
    $this->db->query($sql);
    return $this->db->affectedRows();
}

public function updateDzeitOE($dzeitId,$oe){
    $sql = "update ".self::TABLE_DZEIT." set tat='$oe' where id='$dzeitId' limit 1";
    $this->db->query($sql);
    return $this->db->affectedRows();
}

public function updateTransportKfz($id,$value){
    $sql = "update ".self::TABLE_TRANSPORT." set kfz='$value' where id='$id' limit 1";
    $this->db->query($sql);
    return $this->db->affectedRows();
}

public function updateAbmahnungReklamation($id,$value){
    $sql = "update ".self::TABLE_DPERSABMAHNUNG." set dreklamation_id='$value' where id='$id' limit 1";
    $this->db->query($sql);
    return $this->db->affectedRows();
}

public function updateAbmahnungGrund($id,$value){
    $sql = "update ".self::TABLE_DPERSABMAHNUNG." set grund='$value' where id='$id' limit 1";
    $this->db->query($sql);
    return $this->db->affectedRows();
}

public function updateSonstpremiePremie($id,$value){
    $sql = "update ".self::TABLE_DPERSPREMIE." set id_premie='$value' where id='$id' limit 1";
    $this->db->query($sql);
    return $this->db->affectedRows();
}

public function updateTransportRoute($id,$value){
    $sql = "update ".self::TABLE_TRANSPORT." set route_id='$value' where id='$id' limit 1";
    $this->db->query($sql);
    return $this->db->affectedRows();
}


public function updateDatumVzKd($persnr,$oe,$datumDB,$value){
    $sql = "update ".self::TABLE_DZEITSOLL." set stunden_vzkd='$value' where persnr='$persnr' and oe='$oe' and datum='$datumDB' limit 1";
    $this->db->query($sql);
    return $this->db->affectedRows();
}

public function updateTransportPreis($id,$value){
    $sql = "update ".self::TABLE_TRANSPORT." set preis='$value' where id='$id' limit 1";
    $this->db->query($sql);
    return $this->db->affectedRows();
}

public function updateAbmahnungField($id,$field,$value){
    $sql = "update ".self::TABLE_DPERSABMAHNUNG." set `$field`='$value' where id='$id' limit 1";
    $this->db->query($sql);
    return $this->db->affectedRows();
}
	
public function updateAbmahnungBetrag($id,$value){
    $sql = "update ".self::TABLE_DPERSABMAHNUNG." set betr='$value' where id='$id' limit 1";
    $this->db->query($sql);
    return $this->db->affectedRows();
}
public function updateAbmahnungBetragDatum($id,$value){
    if($value==NULL || strlen($value)==0)
        $sql = "update ".self::TABLE_DPERSABMAHNUNG." set betrdat=null where id='$id' limit 1";
    else
        $sql = "update ".self::TABLE_DPERSABMAHNUNG." set betrdat='$value' where id='$id' limit 1";
    
    $this->db->query($sql);
    return $this->db->affectedRows();
}
public function updateAbmahnungBemerkung($id,$value){
    $sql = "update ".self::TABLE_DPERSABMAHNUNG." set bemerk='$value' where id='$id' limit 1";
    $this->db->query($sql);
    return $this->db->affectedRows();
}

public function updateSonstpremieBetrag($id,$value){
    $sql = "update ".self::TABLE_DPERSPREMIE." set betrag='$value' where id='$id' limit 1";
    $this->db->query($sql);
    return $this->db->affectedRows();
}



    public function getAnwesenheitFromEdata($datumDB, $persnr) {
        $sql = "";
        $sql.=" select ";
        $sql.=" edata_access_events.persnr,";
        $sql.=" min(edata_access_events.dt) as von,";
        $sql.=" max(edata_access_events.dt) as bis,";
        $sql.=" count(edata_access_events.persnr) as pocet";
        $sql.=" from edata_access_events";
        $sql.=" where";
        $sql.=" DATE_FORMAT(edata_access_events.dt,'%Y-%m-%d')='$datumDB'";
        $sql.=" and persnr<>0";
        $sql.=" and persnr=$persnr";
        $sql.=" group by";
        $sql.=" edata_access_events.persnr";
        $sql.=" order by";
        $sql.=" edata_access_events.persnr,";
        $sql.=" edata_access_events.dt";

        $result = $this->db->query($sql);
        if (count($result) == 0)
            return NULL;
        else {
            return $result->fetchAll();
        }
    }

    public function getLeistungAnwesenheitRows($datumDB, $persnr) {
        $sql = "";
        $sql.= " select";
        $sql.= " PersNr,";
        $sql.= " DATE_FORMAT(Datum,'%Y-%m-%d') as datum,";
        $sql.= " DATE_FORMAT(`verb-von`,'%H:%i') as von,";
        $sql.= " DATE_FORMAT(`verb-bis`,'%H:%i') as bis,";
        $sql.= " oe,";
        $sql.= " sum(`Verb-Zeit`) as sumverb,";
        $sql.= " max(`verb-pause`) as sumpause";
        $sql.= " from drueck";
        $sql.= " where ";
        $sql.= " datum='$datumDB'";
        $sql.= " and PersNr='$persnr'";
        $sql.= " and DATE_FORMAT(`verb-von`,'%H:%i')<>'00:00'";
        $sql.= " and DATE_FORMAT(`verb-bis`,'%H:%i')<>'00:00'";
        $sql.= " group by";
        $sql.= " PersNr,";
        $sql.= " oe,";
        $sql.= " DATE_FORMAT(Datum,'%Y-%m-%d'),";
        $sql.= " DATE_FORMAT(`verb-von`,'%H:%i'),";
        $sql.= " DATE_FORMAT(`verb-bis`,'%H:%i')";
        $sql.= " having sumverb<>0";
        $sql.= " order by PersNr,`verb-von`";
        $result = $this->db->query($sql);
        if (count($result) == 0)
            return NULL;
        else {
            return $result->fetchAll();
        }
    }

    public function getPersnrRowsFromDrueckDatum($datumDB, $persnr,$ohneStornoRows = TRUE) {
        
        // nebudu vytahovat persnr lidi, kteri uz maji na zadany datum nejakou dochazku
        
        if ($persnr == '*' || strlen($persnr)==0) {
            $sql = "";
            $sql.=" select distinct drueck.persnr";
            $sql.=" from drueck";
            $sql.=" left join dzeit on dzeit.PersNr=drueck.PersNr and dzeit.Datum=drueck.Datum";
            $sql.=" where";
            $sql.=" drueck.datum='$datumDB'";
            $sql.=" and dzeit.PersNr is null";
            $sql.=" order by drueck.persnr";
        } else {
            $sql = "";
            $sql.=" select distinct drueck.persnr";
            $sql.=" from drueck";
            $sql.=" left join dzeit on dzeit.PersNr=drueck.PersNr and dzeit.Datum=drueck.Datum";
            $sql.=" where";
            $sql.=" drueck.datum='$datumDB'";
            $sql.=" and drueck.persnr='$persnr'";
            $sql.=" and dzeit.PersNr is null";
            $sql.=" order by drueck.persnr";
        }
        $result = $this->db->query($sql);
        if (count($result) == 0)
            return NULL;
        else {
            return $result->fetchAll();
        }
    }

        public function insertAnwesenheit($persnr, $schicht, $datum, $von, $bis, $pause1, $pause2, $stunden, $tatigkeit,$insertToDB=TRUE) {

        $vystup = array(
            "verb" => 0,
            "noaduplicita" => 0,
            'stunden'=>0,
        );

        $user = Utility::get_user_pc();
        $datumOriginal = $datum;
        $datumRoz = explode(".", $datum);
        $datum = Utility::make_DB_datum($datum);

        // pro tatigkeit si zjistim oestatus
        $oestatus = $this->getOEStatusForOE($tatigkeit);
        // zjistim si obsah anw_ist a anw_soll
        $anwArray = $this->getAnwArrayForOE($tatigkeit);
        // zjistim i regelstunden pro persnr
        $regelstunden = $this->getRegelarbzeit($persnr);


        if ($pause2 == "")
            $pause2 = 0;

        if ($oestatus != "a") {
            $stunden = 0;
        } // Pokud neni �innost nastavena na "a" pak nastav�me po�et hodin na '0'!
        // podle hodnoty $anwArray['anw_ist'] upravim stunden
        // pokud je hodnota = 'R' nastavim stunden na regelarbstunden

        $bPrepocitat = TRUE;
        if (!strcmp($anwArray['anw_ist'], 'R')) {
            $stunden = $regelstunden;
            $bPrepocitat = FALSE;
        }
        //---------------------------------------------------------------------------------------------------------------------
        // u vybranych oe , ktere se zadavaji i pres vikend a svatky nastavim stunden = 0 pokud jde o svatek nebo vikend
        $oeNulove = $this->getOESForOEStatus('n');

        if (in_array($tatigkeit, $oeNulove) && $this->isDatumVikendSvatek($this->make_DB_datum($datumOriginal)))
            $stunden = 0;
        //---------------------------------------------------------------------------------------------------------------------

        $vonHod = substr($von, 0, 2); // roz�e�eme p��chod na �daje
        $vonMin = substr($von, 3, 2); // roz�e�eme p��chod na �daje

        $vonOriginal = $von;
        $bisOriginal = $bis;

        $bisHod = substr($bis, 0, 2); // roz�e�eme odchod na �daje
        $bisMin = substr($bis, 3, 2); // roz�e�eme odchod na �daje
//        $vonStamp = mktime($vonHod, $vonMin, 0, $datumRoz[1], $datumRoz[0], $datumRoz[2],0);
        $vonStamp = mktime($vonHod, $vonMin, 0, $datumRoz[1], $datumRoz[0], $datumRoz[2]);
        // kvuli prechodu na stredoevropsky cas
//        $vonStamp1 = mktime($vonHod, $vonMin, 0, $datumRoz[1], $datumRoz[0], $datumRoz[2],1);
        $vonStamp1 = mktime($vonHod, $vonMin, 0, $datumRoz[1], $datumRoz[0], $datumRoz[2]);
//        $bisStamp = mktime($bisHod, $bisMin, 0, $datumRoz[1], $datumRoz[0], $datumRoz[2],1);
        $bisStamp = mktime($bisHod, $bisMin, 0, $datumRoz[1], $datumRoz[0], $datumRoz[2]);
        $von = date("y-m-d H:i:s", $vonStamp1); // sestav�me nov� p��chod i s datumem
        $bis = date("y-m-d H:i:s", $bisStamp); // sestav�me nov� odchod i s datumem

        if ($stunden != 0 && $bPrepocitat) {
            // jeste jednou si prepocitam stunden
            $hodin = ($bisStamp - $vonStamp1) / 60 / 60;
            $stunden = round($hodin, 2);
        }

        $stundenNetto = $stunden - $pause1 - $pause2;

        $sql = "insert into dzeit";
        $sql.=" (Persnr, Datum, Stunden, Schicht, tat, anw_von, anw_bis, pause1, pause2,comp_user_accessuser)";
        $sql.=" values ('$persnr', '$datum', '$stundenNetto', '$schicht', '$tatigkeit', '$von', '$bis', $pause1, $pause2,'$user')";
        
        if($insertToDB===TRUE){
            $res = $this->db->query($sql);
        }

        $vystup['sql']=$sql;
        $vystup['stunden']=$stundenNetto;
        return $vystup;
    }

        /**
     *
     * @param string $datum ve formatu YYYY-MM-DD
     * @return boolean true pokud je datum sobota, nedele nebo svatek
     *                  false jinak nebo v pripade, ze datum nenajdu v kalendari
     */
    public function isDatumVikendSvatek($datum) {
        $sql = "select calendar.cislodne,calendar.svatek from calendar where datum = '$datum'";
        $res = $this->db->query($sql);
        if (count($res) > 0) {
            $row = $res->fetch();
            if ($row['cislodne'] == 6 || $row['cislodne'] == 7 || $row['svatek'] != 0)
                return true;
            else
                return false;
        }
        else
            return false;
    }

    
        /**
     * vrati pole oe, ktere maji oestaus = $oestatus
     * @param string $oestatus
     * @param boolean $gleich = TRUE (default) vrati pole s OE jejich status je roven oestatus, pri $gleich = FALSE vrati pole oe jejichz status neni roven oestatus
     * @return array
     */
    public function getOESForOEStatus($oestatus, $gleich = TRUE) {
        if ($gleich == TRUE)
            $query = "select dtattypen.tat from dtattypen where oestatus='$oestatus'";
        else
            $query = "select dtattypen.tat from dtattypen where oestatus<>'$oestatus'";

        //echo $query;
        $result = $this->db->query($query);
        $oeArray = array();
        while ($row = $result->fetch()) {
            array_push($oeArray, $row['tat']);
        }
        return $oeArray;
    }

    /**
 *
 * @param <type> $persnr
 */
public function getEssenArray($persnr,$von,$bis) {
    $sql = "select datum as datumorder,DATE_FORMAT(datum,'%d.%m.%Y') as datum,min(id) as id,persnr,essen,".self::TABLE_DZEIT.".id_essen,essen_kz from ".self::TABLE_DZEIT." ";
    $sql.= "left join ".self::TABLE_DESSEN." on ".self::TABLE_DZEIT.".id_essen=".self::TABLE_DESSEN.".id_essen where persnr='$persnr' and datum between '$von' and '$bis' group by datum order by datumorder desc";
    $result = $this->db->query($sql);
    if(count($result)==0)
        return NULL;
    else {
        return $result->fetchAll();
    }
}

public function getRegelTransportPreis($persnr){
    $sql = "select ".self::TABLE_DPERSDETAIL.".regeltrans from ".self::TABLE_DPERSDETAIL." where persnr='$persnr'";
    $result = $this->db->query($sql);
    if(count($result)==0)
        return 0;
    else {
        return $result->fetchSingle();
    }
}

public function getTransportArray($persnr,$von,$bis) {

    $sql = "select id,datum as datumorder,DATE_FORMAT(datum,'%d.%m.%Y') as datum,persnr,route_id,preis,kfz as kfz_id from ".self::TABLE_TRANSPORT." ";
    $sql.= " where persnr='$persnr' and datum between '$von' and '$bis' order by datumorder desc";
    $result = $this->db->query($sql);
    if(count($result)==0)
        return NULL;
    else {
        return $result->fetchAll();
    }
}

public function getPremienArray($persnr,$von,$bis) {

    $sql = "select id,datum as datumorder,DATE_FORMAT(datum,'%d.%m.%Y') as datum,persnr,id_premie,betrag from ".self::TABLE_DPERSPREMIE." ";
    $sql.= " where persnr='$persnr' and datum between '$von' and '$bis' order by datumorder desc";
    $result = $this->db->query($sql);
    if(count($result)==0)
        return NULL;
    else {
        return $result->fetchAll();
    }
}

public function getVetragArray($persnr){
  $sql = "select id,persnr,dpersvertrag.eintritt as eintrittraw,DATE_FORMAT(eintritt,'%d.%m.%Y') as eintritt,verlang,vertrag_anfang,DATE_FORMAT(austritt,'%d.%m.%Y') as austritt,DATE_FORMAT(befristet,'%d.%m.%Y') as befristet,DATE_FORMAT(probezeit,'%d.%m.%Y') as probezeit,regelarbzeit as regelstunden,vertragtyp_id from dpersvertrag where persnr='$persnr' order by eintrittraw desc";
  $result = $this->db->query($sql);
    if(count($result)==0)
        return NULL;
    else {
        return $result->fetchAll();
    }
}

public function getAbmahnungArray($persnr,$von,$bis) {


    $sql = "select id,vorschlag,vorschlag_von,vorschlag_betrag,vorschlag_bemerkung,datum as datumorder,DATE_FORMAT(datum,'%d.%m.%Y') as datum,persnr,grund,betr as betrag,DATE_FORMAT(betrdat,'%d.%m.%Y') as betrdat,bemerk as bemerkung,dreklamation_id from ".self::TABLE_DPERSABMAHNUNG." ";
    if($von==NULL && $bis==NULL)
        $sql.= " where persnr='$persnr' order by datumorder desc";
    else
        $sql.= " where persnr='$persnr' and datum between '$von' and '$bis' order by datumorder desc";
    $result = $this->db->query($sql);
    if(count($result)==0)
        return NULL;
    else {
        return $result->fetchAll();
    }
}

public function getVerletzungArray($persnr,$von,$bis) {


    $sql = "select idun as id,datum as datumorder,DATE_FORMAT(datum,'%d.%m.%Y') as datum,pernr as persnr,typ as grund from ".self::TABLE_DPERSUNFALL." ";
    if($von==NULL && $bis==NULL)
        $sql.= " where pernr='$persnr' order by datumorder desc";
    else
        $sql.= " where pernr='$persnr' and datum between '$von' and '$bis' order by datumorder desc";
    $result = $this->db->query($sql);
    if(count($result)==0)
        return NULL;
    else {
        return $result->fetchAll();
    }
}

/**
 *
 * @param <type> $persnr
 * @param <type> $schulungid 
 */
public function getLetzteSchulungInfo($persnr,$schulungid){
    if($schulungid!=99){
        $sql = "select DATE_FORMAT(dpersschulung.letzte_datum,'%d.%m.%Y') as letzte_datum,dpersschulung.ergebniss from dpersschulung where persnr='$persnr' and schulung_id='$schulungid' order by letzte_datum desc limit 1";
        $result = $this->db->query($sql);
        if(count($result)>0){
            $row = $result->fetch();
            return array('letzte_datum'=>$row['letzte_datum'],'ergebniss'=>$row['ergebniss']);
        }
        else
            return NULL;
    }
    return NULL;
}

/**
 *
 * @param <type> $persnr
 * @param <type> $schulungid
 * @return <type> 
 */
public function getSchulungenInfo($persnr,$schulungid){
    if($schulungid!=99){
        $sql = "select id,DATE_FORMAT(dpersschulung.letzte_datum,'%d.%m.%Y') as letzte_datum,dpersschulung.ergebniss from dpersschulung where persnr='$persnr' and schulung_id='$schulungid' order by letzte_datum desc";
        $result = $this->db->query($sql);
        if(count($result)>0){
            $rows = $result->fetchAll();
            return $rows;
        }
        else
            return NULL;
    }
    return NULL;
}

public function getSchulungInfo($schulungid){
    $sql = "select dschulung.beschreibung,interval_monate,lektor from dschulung where id='$schulungid'";
    $result = $this->db->query($sql);
    if(count($result)>0){
        $row = $result->fetch();
        return $row;
    }
    else
        return NULL;
}
/**
 *
 * @param <type> $persnr
 * @return <type>
 */
public function getFaehigkeitenArray($persnr) {


    $sql = "select ".self::TABLE_DPERSFAEHIGKEIT.".id,".self::TABLE_DPERSFAEHIGKEIT.".persnr,".self::TABLE_DPERSFAEHIGKEIT.".faehigkeit_id,".self::TABLE_DPERSFAEHIGKEIT.".soll,".self::TABLE_DPERSFAEHIGKEIT.".ist,".self::TABLE_DPERSFAEHIGKEIT.".bemerkung,".self::TABLE_FAEHIGKEITEN.".beschreibung as faehigkeitbeschreibung,".self::TABLE_FAEHIGKEITTYP.".stat_nr,".self::TABLE_FAEHIGKEITTYP.".beschreibung as faehigkeittypbeschreibung";
    $sql.=",".self::TABLE_FAEHIGKEITEN.".faeh_abkrz";
    $sql.=",".self::TABLE_DSCHULUNG.".id as idschulung";
    $sql.=",".self::TABLE_DSCHULUNG.".beschreibung as schulung_beschreibung";
    $sql.=",".self::TABLE_DSCHULUNG.".lektor as schulung_lektor";
    $sql.=" from ".self::TABLE_DPERSFAEHIGKEIT." ";
    $sql.=" join ".self::TABLE_FAEHIGKEITEN." on ".self::TABLE_DPERSFAEHIGKEIT.".faehigkeit_id=".self::TABLE_FAEHIGKEITEN.".id";
    $sql.=" join ".self::TABLE_FAEHIGKEITTYP." on ".self::TABLE_FAEHIGKEITEN.".faehigkeit_typ=".self::TABLE_FAEHIGKEITTYP.".id";
    $sql.=" left join ".self::TABLE_DSCHULUNG." on ".self::TABLE_FAEHIGKEITEN.".schulung_id=".self::TABLE_DSCHULUNG.".id";
    $sql.=" where ".self::TABLE_DPERSFAEHIGKEIT.".persnr='$persnr'";
    $sql.=" order by ".self::TABLE_FAEHIGKEITTYP.".stat_nr";
    $result = $this->db->query($sql);
    if(count($result)==0)
        return NULL;
    else {
        return $result->fetchAll();
    }
}
public function getAnwesenheitArray($persnr,$von,$bis) {

    $sql = "select dzeit.id,`Datum` as datumorder,DATE_FORMAT(datum,'%d.%m.%Y') as datum,persnr,tat as oe,`Stunden` as stunden,pause1,pause2 from ".self::TABLE_DZEIT;
    //$sql = "select id,datum as datumorder,DATE_FORMAT(datum,'%d.%m.%Y') as datum,persnr,route_id,preis,kfz as kfz_id from ".self::TABLE_TRANSPORT." ";
    $sql.= " where persnr='$persnr' and datum between '$von' and '$bis' order by datumorder desc";
    $result = $this->db->query($sql);
    if(count($result)==0)
        return NULL;
    else {
        return $result->fetchAll();
    }
}

/**
 *
 * @param <type> $persnr
 */
public function getVorschussArray($persnr) {
    $sql = "select id_vorschuss as id,persnr,vorschuss,datum as datumorder,DATE_FORMAT(datum,'%d.%m.%Y') as datum from ".self::TABLE_VORSCHUSS." where persnr='$persnr' order by datumorder desc";
    $result = $this->db->query($sql);
    if(count($result)==0)
        return NULL;
    else {
        return $result->fetchAll();
    }
}
/**
 * vrati prvni osobni cislo ulozene v tabulce dpers
 * @param boolean $active
 * @param int $vonPersNr   od ktereho cisla se ma zacit hledat
 * @return int
 */
public function getFirstPersNrFromDpers($active=TRUE,$vonPersNr=0) {
    if($active==TRUE) {
        $sql = "select persnr from ".self::TABLE_DPERS." where (".self::TABLE_DPERS.".austritt is null or ".self::TABLE_DPERS.".eintritt>".self::TABLE_DPERS.".austritt) and (persnr>'$vonPersNr') and (dpers.dpersstatus='MA') order by persnr limit 1";
    }
    else {
        $sql = "select persnr from ".self::TABLE_DPERS." where  (persnr>'$vonPersNr') order by persnr limit 1";
    }

    $result = $this->db->query($sql);
    if(count($result)>0) {
        $persnr = $result->fetchSingle();
    }
    else
        $persnr = null;

    return $persnr;
}

        /**
         * vrati posledni osobni cislo ulozene v tabulce dpers
         * @param boolean $active
         * @param int $vonPersNr   od ktereho cisla se ma zacit hledat
         * @return int
         */
        public function getLastPersNrFromDpers($active=TRUE,$vorPersNr=100000){
            if($active==TRUE){
                $sql = "select persnr from ".self::TABLE_DPERS." where (".self::TABLE_DPERS.".austritt is null or ".self::TABLE_DPERS.".eintritt>".self::TABLE_DPERS.".austritt) and (persnr<'$vorPersNr') and (dpers.dpersstatus='MA') order by persnr desc limit 1";
            }
            else{
                $sql = "select persnr from ".self::TABLE_DPERS." where  (persnr<'$vorPersNr') order by persnr desc limit 1";
            }

            $result = $this->db->query($sql);
            if(count($result)>0){
                $persnr = $result->fetchSingle();
            }
            else
                $persnr = null;

            return $persnr;
        }

        /**
         *
         * @param <type> $name
         * @param <type> $pass
         * @return <type> 
         */
        public function getBenutzerRow($name,$pass){
            $sql = "select * from dbenutzer where name=%s and password=%s";
            $result = $this->db->query($sql,$name,$pass);
            if(count($result)>0){
                $rows = $result->fetchAll();
                return $rows[0];
            }
            else
            return null;
        }


        /**
         *
         * @param string $oe
         * @return array array($anw_ist,$anw_soll)
         */
        public function getAnwArrayForOE($oe) {
            $sql = "select dtattypen.anw_ist,anw_soll from dtattypen where tat='$oe'";
            $result = $this->db->query($sql);
            if(count($result)>0) {
                $rows = $result->fetchAll();
                $row = $rows[0];
                $anw_ist = $row['anw_ist']==null?0:strtoupper($row['anw_ist']);
                $anw_soll = $row['anw_soll']==null?0:strtoupper($row['anw_soll']);
                return array('anw_ist'=>$anw_ist,'anw_soll'=>$anw_soll);
            }
            else {
                return array('anw_ist'=>0,'anw_soll'=>0);
            }
        }
       
       /**
        * otestuje zda uz mam pro zvoleny rok a mesic jiz nejaka ulozena data v tabulce dzeitsoll2
        * @param integer $mesic
        * @param integer $rok 
        */
       public function testSavedUrsprungPlan($mesic,$rok){
           $hasData = 0;
           $sql = "select persnr from dzeitsoll2 where MONTH(datum)='$mesic' and YEAR(datum)='$rok'";
            $result = $this->db->query($sql);
            if(count($result)>0)
                $hasData = 1;
            return $hasData;
       }

       /**
        * ulozi data pro dany mesic a rok z tabulky dzeitsoll do dzeitsoll2
        * @param integer $monat
        * @param integer $jahr
        * @return poced ulozeny radku z tabulky dzeitsoll do dzeitsoll2
        *
        */
       public function saveUrsprung($monat,$jahr){
          $this->db->query("delete from dzeitsoll2 where MONTH(datum)='$monat' and YEAR(datum)='$jahr'");
          $sql_select = "select * from dzeitsoll where MONTH(datum)='$monat' and YEAR(datum)='$jahr'";
          $result = $this->db->query($sql_select);
          $vlozeno =0;
          $user = "PHP_".$_SERVER["REMOTE_ADDR"];//."/".$_SESSION["user"];
          while($row = $result->fetch()){
              $sql_insert = "insert into dzeitsoll2 (persnr,datum,oe,stunden,user) values('".$row['persnr']."','".$row['datum']."','".$row['oe']."','".$row['stunden']."','".$user."')";
              $this->db->query($sql_insert);
              $vlozeno++;
          }

          return $vlozeno;
       }



        public function getArbTageBetweenDatums($dbDatumVon,$dbDatumBis){
            $sql = "select count(calendar.datum) as worktage from calendar where svatek=0 and datum>%s and datum<=%s and cislodne<>6 and cislodne<>7";
            $result = $this->db->query($sql,$dbDatumVon,$dbDatumBis);
            return $result->fetchSingle();
        }


        /**
         *
         * @param <type> $dbDatumVon
         * @param <type> $dbDatumBis
         * @param <type> $persnr
         * @return <type>
         */
        public function getNoArbTagePlanBetweenDatums($dbDatumVon,$dbDatumBis,$persnr) {
            $sql = "select count(dzeitsoll.datum) as noworktage from dzeitsoll where datum>%s and datum<=%s and persnr=%i and (oe='d' or oe='nv')";
            $result = $this->db->query($sql,$dbDatumVon,$dbDatumBis,$persnr);
            if(count($result)>0)
                return $result->fetchSingle();
            else
                return 0;
        }

        /**
         *
         * @param <type> $dbDatumVon
         * @param <type> $dbDatumBis
         * @param <type> $persnr
         * @param <type> $oe
         * @return integer
         */
        public function getPlanOEStundenBetweenDatums($dbDatumVon,$dbDatumBis,$persnr,$oe) {
            $sql = "select sum(dzeitsoll.stunden) as sumstunden from dzeitsoll where datum>%s and datum<=%s and persnr=%i and oe=%s";
            //            $result = $this->db->query($sql,$dbDatumVon,$dbDatumBis,$persnr,$oe);
            $result = $this->db->query($sql,$dbDatumVon,$dbDatumBis,$persnr,$oe);
            if(count($result)>0) {
                $v = $result->fetchSingle();
                if($v==null)
                    return 0;
                else
                    return $v;
            }
            else
                return 0;
        }
        
        
        /**
         *
         * @param <type> $dbDatumVon
         * @param <type> $dbDatumBis
         * @param integer $persnr
         * @return <type>
         */
        public function getNoArbTageBetweenDatums($dbDatumVon,$dbDatumBis,$persnr) {
            $sql = "select count(dzeit.datum) as noworktage from dzeit where datum>%s and datum<=%s and persnr=%i and (tat='d' or tat='n' or tat='nv')";
            $result = $this->db->query($sql,$dbDatumVon,$dbDatumBis,$persnr);
            return $result->fetchSingle();
        }

        /**
         *
         * @param <type> $monat
         * @param <type> $jahr
         * @param <type> $persnr
         * @return array
         */
        public function getPlusMinusStunden($monat, $jahr, $persnr){

            $returnArray = array();
            $stddifA = $this->getStdDiff($monat, $jahr, $persnr);
            if($stddifA==null)
                $returnArray['soll_datumvon']=null;
            else{
                $returnArray['soll_datumvon']=$stddifA['datum'];
                $returnArray['soll_stddifstunden']=$stddifA['stunden'];
                $stddifStunden = $stddifA['stunden'];
                $dbDatumVon = '20'.substr($stddifA['datum'], 0, 2).'-'.substr($stddifA['datum'], 2, 2).'-'.substr($stddifA['datum'], 4, 2);
                $returnArray['soll_dbdatumvon']=$dbDatumVon;

                $pocetDnuVMesici = cal_days_in_month(CAL_GREGORIAN, $monat, $jahr);
                $dbDatumBis = sprintf("%s-%02d-%02d",$jahr,$monat,$pocetDnuVMesici);
                $returnArray['soll_dbdatumbis']=$dbDatumBis;

                // z kalendare si zjistim pocet pracovnich dnu v tomto obdobi
                $arbTage = $this->getArbTageBetweenDatums($dbDatumVon,$dbDatumBis);
                $returnArray['soll_arbtagebetweendatums']=$arbTage;
                $regelStunden = $this->getRegelarbzeit($persnr);
                
                // odectu dny, ktere mel v tomto obdobi oe = d,n,nv
                $noArbeitTage = $this->getNoArbTageBetweenDatums($dbDatumVon, $dbDatumBis,$persnr);
                $returnArray['soll_noarbtagebetweendatums']=$noArbeitTage;
                $noarbStunden = $regelStunden * $noArbeitTage;
                $returnArray['soll_noarbstunden']=$noarbStunden;

                // pocet odpracovanych hodin mezi datumama a posledni datum prace
                $istStundenA = $this->getIstAnwesenheitStundenBetweenDatums($dbDatumVon, $dbDatumBis, $persnr);
                $letzte_datum = $istStundenA['letztedatum'];
                $istStunden = $istStundenA['stunden'];
                $returnArray['soll_iststunden']=$istStunden;
                $returnArray['soll_letztedatum']=substr($letzte_datum, 0,10);

                // pocet zbyvajicich pracovnich dnu od posledni dochazky do konce mesice
                $arbTageBisEndeMonat = $this->getArbTageBetweenDatums($letzte_datum, $dbDatumBis);
                $returnArray['soll_arbtagebisendemonat']=$arbTageBisEndeMonat;

                // ponizim fond
                $stundenBisEndeMonat = $arbTageBisEndeMonat * $regelStunden;
                $stundenFond = $arbTage * $regelStunden - $stundenBisEndeMonat - $noarbStunden;
                $returnArray['soll_stundenfond']=$stundenFond;

                // pocet naplanovanych dovolenych a nv
                $noarbTagePlan = $this->getNoArbTagePlanBetweenDatums($letzte_datum,$dbDatumBis,$persnr);


                // pocet naplanovanych hodin s oe = "nw" do do konce mesice
                $oeStunden = $this->getPlanOEStundenBetweenDatums($letzte_datum,$dbDatumBis,$persnr,"nw");
                $returnArray['soll_plannwstundenbisendemonat']=$oeStunden;

                // a konecne vysledek
                $plusMinusStunden = $stddifStunden + ($istStunden - $stundenFond) - $oeStunden;
                $returnArray['plusminusstunden']=$plusMinusStunden;
            }


            return $returnArray;
        }

        /**
         *
         * @param <type> $monat
         * @param <type> $jahr
         * @param <type> $persnr
         * @return array "datum"=>$row['datum'],"stunden"=>$row['stunden']
         */
        public function getStdDiff($monat,$jahr,$persnr) {
            if($monat==1) {
                $vormonat = 12;
                $vorjahr = $jahr - 1;
            }
            else {
                $vormonat = $monat - 1;
                $vorjahr = $jahr;
            }

            $sql = "select DATE_FORMAT(datum,'%y%m%d') as datum,stunden from dstddif where persnr=%i and MONTH(datum)<=%i and YEAR(datum)<=%i order by datum desc";
            $result = $this->db->query($sql,$persnr,$vormonat,$vorjahr);
            if(count($result)>0) {
                $rows = $result->fetchAll(0, 1);
                $row = $rows[0];
                return array("datum"=>$row['datum'],"stunden"=>$row['stunden']);
            }
            else
                return null;
        }


        /**
         * returns sum of plan stunden for jahr,monat and persnr
         * @param integer $jahr
         * @param integer $monat
         * @param integer $persnr
         * @return double
         */
        public function getPlanStunden($jahr,$monat,$persnr){
            $datvon = $jahr."-".$monat."-01";
            // get number of day in month
            $pocetDnuVMesici = cal_days_in_month(CAL_GREGORIAN, $monat, $jahr);
            $datbis = $jahr."-".$monat."-".$pocetDnuVMesici;

//            $sql = "select sum(stunden) as sumstunden from dzeitsoll join dtattypen on dzeitsoll.oe=dtattypen.tat";
//            $sql.= " where dtattypen.oestatus='a' and dzeitsoll.persnr=%i and datum between %s and %s";
            $sql = "select sum(stunden) as sumstunden from dzeitsoll join dtattypen on dzeitsoll.oe=dtattypen.tat";
            $sql.= " where dzeitsoll.persnr=%i and datum between %s and %s";

            $res = $this->db->query($sql,$persnr,$datvon,$datbis);
            return $res->fetchSingle();

        }

        /**
         * return sum of anwesenheitstunden for monat,jahr and persnr, only day with oestatus='a'
         *
         * @param integer $jahr
         * @param integer $monat
         * @param integer $persnr
         * @return double
         */
        public function getIstAnwesenheitStunden($jahr,$monat,$persnr){
            $datvon = $jahr."-".$monat."-01";
            // get number of days in month
            $pocetDnuVMesici = cal_days_in_month(CAL_GREGORIAN, $monat, $jahr);
            $datbis = $jahr."-".$monat."-".$pocetDnuVMesici;

            $sql = "select sum(stunden) as sumstunden from dzeit join dtattypen on dzeit.tat=dtattypen.tat";
            $sql.= " where dtattypen.oestatus='a' and dzeit.persnr=%i and datum between %s and %s";
            $res = $this->db->query($sql,$persnr,$datvon,$datbis);
            return $res->fetchSingle();
        }


        /**
         *
         * @param <type> $datvon
         * @param <type> $datbis
         * @param <type> $persnr
         * @return array "stunden"=>$row['sumstunden'],"letztedatum"=>$row['letzte_datum']
         */
        public function getIstAnwesenheitStundenBetweenDatums($datvon,$datbis,$persnr) {

            $sql = "select persnr,sum(stunden) as sumstunden,max(datum) as letzte_datum from dzeit";
            $sql.= " where dzeit.persnr=%i and datum>%s and datum<=%s group by persnr";
            $res = $this->db->query($sql,$persnr,$datvon,$datbis);
            if(count($res)>0) {
                $rows = $res->fetchAll();
                $row = $rows[0];
                return array("stunden"=>$row['sumstunden'],"letztedatum"=>$row['letzte_datum']);
            }
            else {
                return array("stunden"=>0,"letztedatum"=>"2000-01-01");
            }
        }

        /**
         * gives info about holiday for persnr
         * @param integer $persnr
         * @param string $bisDatum in form of YYYY-MM-DD
         * 
         * @return array('rest'=>$rest,'anspruch'=>$anspruch,'alt'=>$alt,'gekrzt'=>$gekrzt,'genommen'=>$genommenBis)
         */
        public function getUrlaubBisDatum($persnr,$bisDatum){
            $sql = "select durlaub1.jahranspruch,durlaub1.rest,durlaub1.gekrzt from durlaub1 where `PersNr`=%i";
            $res = $this->db->query($sql,$persnr);
            if(count($res)>0){
                // should be only 1 row
                $row = $res->fetch();
                $anspruch = $row['jahranspruch'];
                $alt = $row['rest'];
                $gekrzt = $row['gekrzt'];
            }
            else{
                $anspruch = 0;
                $rest = 0;
                $alt = 0;
                $gekrzt = 0;
            }

            // holiday day from begin of years to $bisDatum
            // 1. January
            $datvon = substr($bisDatum, 0, 4)."-"."01-01";
            $sql = "select count(datum) as hd from dzeit where dzeit.`Datum` between %s and %s and persnr=%i and dzeit.tat='d'";
            $res = $this->db->query($sql,$datvon,$bisDatum,$persnr);
            $row = $res->fetch();
            $genommenBis = $row['hd'];
            $rest = $anspruch + $alt - $gekrzt - $genommenBis;

            return array('rest'=>$rest,'anspruch'=>$anspruch,'alt'=>$alt,'gekrzt'=>$gekrzt,'genommen'=>$genommenBis);
        }
        /**
         * return an array with info about workday in month
         *
         * @param integer $rok
         * @param integer $mesic
         * @param double $stundenProTag
         * @return array("arbtage"=>0,"sollstunden"=>0)
         */
        public function getSollStundenLautCalendar($rok,$mesic,$stundenProTag){
            //1. get number of workday in month
            $jahr = $rok;
            $monat = $mesic;
            $datvon = $jahr."-".$monat."-01";
            // get number of days in month
            $pocetDnuVMesici = cal_days_in_month(CAL_GREGORIAN, $monat, $jahr);
            $datbis = $jahr."-".$monat."-".$pocetDnuVMesici;

            $sql = "select count(datum) as workdays from calendar where calendar.cislodne<6 and calendar.svatek=0 and datum between %s and %s";
            $res = $this->db->query($sql,$datvon,$datbis);
            $workDays = $res->fetchSingle();
            $sollStunden = $workDays * $stundenProTag;
            return array("arbtage"=>$workDays,"sollstunden"=>$sollStunden);
        }

        /**
         *
         * @param <type> $jahr
         * @param <type> $monat
         * @return array
         */
        public function getSvatkyArray($jahr,$monat) {
            $datvon = $jahr."-".$monat."-01";
            // get number of days in month
            $pocetDnuVMesici = cal_days_in_month(CAL_GREGORIAN, $monat, $jahr);
            $datbis = $jahr."-".$monat."-".$pocetDnuVMesici;

            $sql = "select calendar.datum from calendar where calendar.svatek<>0 and calendar.datum between '$datvon' and '$datbis'";
            //    echo $sql;
            $result = $this->db->query($sql);
            $i=0;
            $pole = array();
            while($row = $result->fetch()) {
                $pole[$i++] = trim(substr($row['datum'],8,2));
            }
            return $pole;
        }

        /**
         *
         * @return array Mitarbeiterarray for use on Accesssystem
         */
        public function getAccessMitarbeiterArray(){
            $mitarbeiterArray = array();
            $sql = "select `PersNr`,CONCAT(name,' ',vorname) as name from ".self::TABLE_DPERS." where ((dpers.austritt is null) or (dpers.eintritt>dpers.austritt)) order by persnr";
            $result = $this->db->query($sql);
            while($row = $result->fetch()){
                    array_push($mitarbeiterArray, array('persnr'=>$row['PersNr'],'name'=>$row['name']));
            }
            return $mitarbeiterArray;
        }

        public function getArbeitendePersnrMitRegelOEArray(){
            $persnrArray = array();
            $sql = "select dpers.`PersNr` as persnr,regeloe from dpers where ((dpers.austritt is null) or (dpers.eintritt>dpers.austritt)) order by persnr";
            $result = $this->db->query($sql);
            while($row = $result->fetch()){
                $regeloe = trim($row['regeloe']);
                if((strcmp($regeloe, '-')) && (strlen($regeloe)>0))
                    array_push($persnrArray, $row['persnr']);
            }

            return $persnrArray;
        }

        /**
         * zjisti zda je zadany datum pracovnim dne, tj. neni to svatek, sobota nebo nedele
         * @param string $datum in format YYYY-MM-DD
         * @return boolean true pokud je datum pracovnim dnem, jinak false
         */
        public function isWorkingDay($datum){
            $jahr = substr($datum, 0, 4);
            $monat = substr($datum, 5, 2);
            $day = substr($datum, 8, 2);
            $svatkyArray = $this->getSvatkyArray($jahr, $monat);
            
            $cislodne = sprintf("%02d",date('w',mktime(0, 1, 1, $monat, $day, $jahr)));


            $svatek = array_search($day, $svatkyArray);

//            Debug::fireLog("svatek=$svatek,cislodne=$cislodne"."svatkyArray=".join(',', $svatkyArray));

            if($cislodne==0 || $cislodne==6 || $svatek!==false)
                return false;
            else
                return true;

        }

        /**
         *
         * @param int $jahr
         * @param int $monat
         * @param string $VonBisField jmeno sloupce ktery budu nastavovat
         * @param string $VonBisValue hodnota, kterou vlozim do db
         * @param int $overwrite 1 - prepsat puvodni hodnotu, 0 - neprepisovat puvodni hodnotu
         */
        public function fillMonatVonBis($jahr,$monat,$VonBisField,$VonBisValue,$overwrite=0){
            $pocetDnuVMesici = cal_days_in_month(CAL_GREGORIAN, $monat, $jahr);
//            Debug::fireLog("pocetDnuVMesici=$pocetDnuVMesici,jahr=$jahr,monat=$monat,VonBisField=$VonBisField,VonBisValue=$VonBisValue,overwrite=$overwrite");
            for($den = 1;$den<=$pocetDnuVMesici;$den++){
                $datum = sprintf("%04d-%02d-%02d",$jahr,$monat,$den);
//                Debug::fireLog("datum=$datum");
                if($this->isWorkingDay($datum)){
//                    Debug::fireLog("datum=$datum,VonBisField=$VonBisField,VonBisValue=$VonBisValue,overwrite=$overwrite");
                    $this->updateCalendarVonbisField($VonBisField, $datum, $VonBisValue,$overwrite);
                }
            }
        }

        /**
         *
         * @param <type> $jahr
         * @param <type> $monat
         * @param <type> $persnr
         * @return array
         */
        public function getPlanInfo($jahr,$monat,$persnr){
            //1. have i some rows in dzeitsoll for given $jahr and $month
            // 
            $datvon = $jahr."-".$monat."-01";
            // get number of days in month
            $pocetDnuVMesici = cal_days_in_month(CAL_GREGORIAN, $monat, $jahr);
            $datbis = $jahr."-".$monat."-".$pocetDnuVMesici;
            $svatkyArray = $this->getSvatkyArray($jahr, $monat);

            $sql = "select dzeitsoll.id,dzeitsoll.persnr,DATE_FORMAT(dzeitsoll.datum,'%Y-%m-%d') as datum,dzeitsoll.oe,dzeitsoll.stunden,calendar.cislodne from dzeitsoll join calendar on calendar.datum=dzeitsoll.datum where ((persnr=%i) and (dzeitsoll.datum between '$datvon' and '$datbis')) order by dzeitsoll.datum,dzeitsoll.id";
            $res = $this->db->query($sql,$persnr);
            if(count($res)>0){
                // mam zaznamy

            }
            else{
                // don't have any, so make some
                $denOd = 1;
                $denDo = $pocetDnuVMesici;
                // jaky ma standardni oe
                $regeloe = $this->getRegelOE($persnr);
                if($regeloe==null) $regeloe = '-';

                $alteroe = $this->getAlternativOE($persnr);
                if($alteroe==null) $alteroe = $regeloe;

                //2010-07-23 povoleno plneni alternativnim OE
                //nasledujicim radkem funkci alternovani zatim vypnu
                //$alteroe = $regeloe;
                // po shvaleni odkomentovat
                // jaky ma standardni prac. dobu
                $regelarbzeit = $this->getRegelarbzeit($persnr);

                //datum nastupu cloveka, abych planoval az od data nastupu
                $eintrittDatum = $this->getEintrittsDatum($persnr);
                $eintrittStamp = strtotime($eintrittDatum);

                for($i=$denOd;$i<=$denDo;$i++){
                    $datumStr = $jahr."-".$monat."-".$i;
                    $datumStamp = strtotime($datumStr);

                    // zjistit jaky je to den v tydnu

                    $cislodne = date('w',mktime(0, 1, 1, $monat, $i, $jahr));
                    $svatek = array_search($i, $svatkyArray);
                    // zjistim cislo tydne, rozlisim sudy a lichy tyden
                    // v lichem tydnu pouziju regeloe v sudem pouziju alteroe
                    $cislotydne = date('W',mktime(0, 1, 1, $monat, $i, $jahr));
                    $lichyTyden = $cislotydne%2==0?FALSE:TRUE;

		    if($cislodne==0 || $cislodne==6 || $svatek!==FALSE){
			$sqlinsert = "insert into dzeitsoll (persnr,datum,oe,stunden) values('$persnr','$datumStr','-',0)";
		    }
                    else{
                        // kontrola na datum nastupu
                        // pred datumem nastupu vlozim jen '-'

                        if($datumStamp<$eintrittStamp)
                            $sqlinsert = "insert into dzeitsoll (persnr,datum,oe,stunden) values('$persnr','$datumStr','-',0)";
                        else{
                            if($lichyTyden==TRUE)
                                $sqlinsert = "insert into dzeitsoll (persnr,datum,oe,stunden) values('$persnr','$datumStr','$regeloe','$regelarbzeit')";
                            else
                                $sqlinsert = "insert into dzeitsoll (persnr,datum,oe,stunden) values('$persnr','$datumStr','$alteroe','$regelarbzeit')";
                        }
                    }
                    $this->db->query($sqlinsert);
                }
                $sql = "select dzeitsoll.id,dzeitsoll.persnr,DATE_FORMAT(dzeitsoll.datum,'%Y-%m-%d') as datum,dzeitsoll.oe,dzeitsoll.stunden,calendar.cislodne from dzeitsoll join calendar on calendar.datum=dzeitsoll.datum where ((persnr=%i) and (dzeitsoll.datum between '$datvon' and '$datbis')) order by dzeitsoll.datum,dzeitsoll.id";
                $res = $this->db->query($sql,$persnr);
            }

            $rows = $res->fetchAll();
            return $rows;
        }

        /**
         *
         * @param integer $jahr
         * @param integer $monat
         * @return array 
         */
        public function getCalendarInfo($jahr,$monat){
            //1. have i some rows in dzeitsoll for given $jahr and $month
            //
            $datvon = $jahr."-".$monat."-01";
            // get number of days in month
            $pocetDnuVMesici = cal_days_in_month(CAL_GREGORIAN, $monat, $jahr);
            $datbis = $jahr."-".$monat."-".$pocetDnuVMesici;

            $sql = "select DATE_FORMAT(calendar.datum,'%Y-%m-%d') as datum,calendar.cislodne,calendar.svatek,calendar.von_f_guss,calendar.von_s_guss,von_f_ne,von_s_ne,bis_f_guss,bis_s_guss,bis_f_ne,bis_s_ne from calendar where (calendar.datum between '$datvon' and '$datbis') order by datum";
            $res = $this->db->query($sql);
            if(count($res)>0){
                // mam zaznamy

            }
            else{
            }

            $rows = $res->fetchAll();
            return $rows;
        }

	/**
	 * 
	 * @return type
	 */
	public function getAbgnrInfo(){
            $sql = "select `abg-nr` as abgnr,name from `dtaetkz-abg` order by `abg-nr`";
            $res = $this->db->query($sql);
            $rows = $res->fetchAll();
            return $rows;
        }
		
        /**
         * get array of dtattypen rows
         *
         * @return DibiRow
         */
        public function getOEInfo(){
            $sql = "select * from dtattypen order by tat";
            $res = $this->db->query($sql);
            $rows = $res->fetchAll();
            return $rows;
        }

        public function getDpersStatusInfo(){
            $sql = "select * from dpersstatus order by status";
            $res = $this->db->query($sql);
            $rows = $res->fetchAll();
            return $rows;
        }

        public function getStaatenInfo($alle=0){
            if($alle==0)
                $sql = "select * from dstaaten where anzeigen<>0 order by staat_abkrz";
	    else
		$sql = "select * from dstaaten where (anzeigen<>0) and id=$alle order by staat_abkrz";
            $res = $this->db->query($sql);
            $rows = $res->fetchAll();
            return $rows;
        }
        public function getAplBenutzerInfo(){
            $sql = "select * from dbenutzer order by name";
            $res = $this->db->query($sql);
            $rows = $res->fetchAll();
            return $rows;
        }
        /**
         *
         * @param <type> $persnr
         * @return <type> 
         */
        public function getStdsolldatum($persnr){
            $sql = "select dpers.stdsoll_datum from dpers where persnr=%i";
            $res = $this->db->query($sql,$persnr);
            return $res->fetchSingle();
        }

        /**
         *
         * @param <type> $persnr
         * @param <type> $val
         * @return <type> 
         */
        public function updateRegelOE($persnr,$val) {
            if($val=='-')
                $sqlUpdate = "update dpers set regeloe=null where persnr=%i limit 1";
            else
                $sqlUpdate = "update dpers set regeloe='$val' where persnr=%i limit 1";

            $this->db->query($sqlUpdate,$persnr);
            $affectedRows = $this->db->affectedRows();
            return $affectedRows;
        }

        /**
         *
         * @param <type> $persnr
         * @param <type> $regelarbzeit
         * @return <type> 
         */
        public function updateRegelarbzeit($persnr,$regelarbzeit){
            $sqlUpdate = "update dpers set regelarbzeit='$regelarbzeit' where persnr=%i limit 1";
            $this->db->query($sqlUpdate,$persnr);
            $affectedRows = $this->db->affectedRows();
            return $affectedRows;
        }

        /**
         *
         * @param <type> $persnr
         * @param <type> $stdsolldatum
         * @return <type> 
         */
        public function updateStdsolldatum($persnr,$stdsolldatum){
            $sqlUpdate = "update dpers set stdsoll_datum='$stdsolldatum' where persnr=%i limit 1";
            $this->db->query($sqlUpdate,$persnr);
            $affectedRows = $this->db->affectedRows();
            return $affectedRows;
        }

        /**
         *
         * @param <type> $field
         * @param <type> $datum
         * @param <type> $obsah
         * @param int $overwrite 1 - overwrite old value, 0 do not overwrite old value, 1 is default
         * @return int
         */
        public function updateCalendarVonbisField($field,$datum,$obsah,$overwrite=1){

            $overwriteCondition = '';
            if($overwrite==0)
                $overwriteCondition = " and $field is null";
            if($obsah)
                $sqlUpdate = "update calendar set $field='$obsah' where datum='$datum' $overwriteCondition limit 1";
            else
                $sqlUpdate = "update calendar set $field=null where datum='$datum' $overwriteCondition limit 1";

//            Debug::fireLog("sqlUpdate=$sqlUpdate");
            $this->db->query($sqlUpdate);
            return $this->db->affectedRows();
        }

        /**
         *
         * @param <type> $datum
         * @param <type> $hodnota
         * @return <type> 
         */
        public function updateSvatekOnDatum($datum,$hodnota) {
            $sqlUpdate = "update calendar set svatek='$hodnota' where datum='$datum' limit 1";
            $this->db->query($sqlUpdate);
            return $this->db->affectedRows();
        }

        /**
         *
         * @param <type> $field
         * @param <type> $id
         * @param <type> $value
         * @return <type>
         */
        public function updateDZeitsoll($field,$id,$value){
            $sqlUpdate = "update dzeitsoll set $field='$value' where id='$id' limit 1";
            $this->db->query($sqlUpdate);
            return $this->db->affectedRows();
        }

        public function getEintrittsDatum($persnr){
            $sql = "select DATE_FORMAT(dpers.eintritt,'%Y-%m-%d') as eintritt from dpers where persnr=%i";
            $res = $this->db->query($sql,$persnr);
            return $res->fetchSingle();
        }

        /**
         *
         * @param <type> $persnr
         * @return <type>
         */
        public function getRegelarbzeit($persnr){
            $sql = "select dpers.regelarbzeit from dpers where persnr=%i";
            $res = $this->db->query($sql,$persnr);
            return $res->fetchSingle();
        }

        /**
         *
         * @param <type> $persnr
         * @return string
         */
        public function getStammSchicht($persnr){
            $sql = "select dpers.schicht from dpers where persnr=%i";
            $res = $this->db->query($sql,$persnr);
            return $res->fetchSingle();
        }

        /**
         *
         * @param <type> $persnr
         * @return string
         */
        public function getRegelOE($persnr){
            $sql = "select dpers.regeloe from dpers where persnr=%i";
            $res = $this->db->query($sql,$persnr);
            return $res->fetchSingle();
        }

        /**
         *
         * @param <type> $persnr
         * @return string
         */
        public function getAlternativOE($persnr){
            $sql = "select dpers.alteroe from dpers where persnr=%i";
            $res = $this->db->query($sql,$persnr);
            return $res->fetchSingle();
        }
        /**
         * returns oestatus for oe
         * @param string $field
         * @return string
         */
        public function getOEStatusForOE($field){
            $sql = "select dtattypen.oestatus from dtattypen where tat='$field'";
            $res = $this->db->query($sql);
            return $res->fetchSingle();
        }

        /**
         * vytvorii kopii radku v tabulce dzeitsoll podle zadaneho id
         * zkopiruju pouze persnr,datum
         * @param integer $id
         * @return int last inserted id
         */
        public function datumAddFromId($id){
            $sql = "select persnr,datum from dzeitsoll where id='$id'";
            $res = $this->db->query($sql);
            $rows = $res->fetchAll();
            $row = $rows[0];
            $datum = $row['datum'];
            $persnr = $row['persnr'];
            $sqlinsert = "insert into dzeitsoll (persnr,datum,oe) values('$persnr','$datum','-')";
            $this->db->query($sqlinsert);
            return $this->db->insertId();
        }


        /**
         * deletes row from dzeitsoll identified by $id
         * if $id is the last row for given day then it sets stunden=0 and oe=- and does not delete the row
         *
         * @param integer $id
         */
        public function datumDeleteFromId($id){
            $sql = "select persnr,datum from dzeitsoll where id='$id'";
            $res = $this->db->query($sql);
            $rows = $res->fetchAll();
            $row = $rows[0];
            $datum = $row['datum'];
            $persnr = $row['persnr'];
            // zjistim kolik takovych datumu pro daneho cloveka jeste mam
            $sql = "select count(datum) as pocetdatumu from dzeitsoll where persnr='$persnr' and datum='$datum'";
            $res = $this->db->query($sql);
            $pocetDatumu = $res->fetchSingle();
            if($pocetDatumu>1){
                // muzu dane id smazat
                $this->db->query("delete from dzeitsoll where id='$id' limit 1");
            }
            else{
                // nebudu mazat ale nastavim stunden = 0, oe = -
                $sql = "update dzeitsoll set stunden=0,oe='-' where id='$id'";
                $this->db->query($sql);
            }
        }
        
        /**
         *
         * @return DibiConnection
         */
        public function getDb() {
            return $this->db;
        }

    
}
?>
