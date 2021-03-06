<?php
/**
 *
 * Description of DpersAnwesenheitPresenter
 *
 * @author runt
 */
class DpersAnwesenheitPresenter extends BasePresenter{

    public $mesic;
    public $rok;
    public $persnr;

          /**
         * @var array
         */
    var $acturlArray;

    protected function startup() {
        parent::startup();
        $this->acturlArray = array(
            'persnr' => $this->link('validatePersnr'),
            'datumvon' => $this->link('validatePersnr'),
            'planoe' => $this->link('validatePersnr'),
            'wocheplus' => $this->link('validateWoche'),
            'wocheminus' => $this->link('validateWoche'),
        );
    }

    public function actionLogout()
    {
        Environment::getUser()->signOut();
        $this->flashMessage('Sie wurden abgemeldet.');
        $this->redirect('Auth:login');
    }

    // persistentni promenne
    public static function getPersistentParams(){
        //return array('mesic','rok','persnr');
        return array('mesic','rok');
    }

    public function actionPlanAnwesenheit(){
        // nastavim do template aktualni rok a mesic
//        $rokMesic = date('Y')."-".date('m');
        $this->rok = date('Y');
        $this->mesic = date('m');
        $this->persnr = 0;

        // obsah regeloe selectu
        $regeloeselect = Html::el('select');
        $regeloeselect->id = 'regeloeselect';
        $regeloeselect->acturl = $this->link('UpdateRegelOE');
        $regeloeselect->disabled = 'disabled';
        $aplDB = new AplModel();
        $oeinfoA = $aplDB->getOEInfo();
        foreach ($oeinfoA as $oeinfo){
            $regeloeselect->create('option')->value($oeinfo['tat'])->setText($oeinfo['tat']);
        }
        
        $this->template->regeloeselect = $regeloeselect;
        
        $rokMesic = $this->rok."-".$this->mesic;
        $this->template->rokmesic = $rokMesic;
    }

    
    function getStundenBetweenVonBis($von, $bis) {

        $hodVon = intval(substr($von, 0, 2));
        $minVon = intval(substr($von, 3, 2));
        $hodBis = intval(substr($bis, 0, 2));
        $minBis = intval(substr($bis, 3, 2));
        $stunden = ($hodBis + $minBis / 60) - ($hodVon + $minVon / 60);
        return round($stunden,2);
    }

    function roundBisAuf8Std($stunden, $von, $bis, $pause, $anwgruppe = 0) {
	$bisStr = $bis;
	// jen u skupin v podmince budu zaokrouhlovat na 8 hodin, ostatni budou mit dochazku presne podle spotrebovaneho casu
	if ($anwgruppe == 10) {
	    if (($stunden > 7.5) && ($stunden < 8)) {
		$hodVon = intval(substr($von, 0, 2));
		$minVon = intval(substr($von, 3, 2));
		$bis = ($hodVon + $minVon / 60) + 8.5;
		$bisHod = floor($bis);
		$bisMin = round(($bis - $bisHod) * 60, 0);
		$bisStr = sprintf("%02d:%02d", $bisHod, $bisMin);
	    }
	}
	return $bisStr;
    }

    function getEdataAnwTableDivString($datum, $persnr) {
        $div = "";

        $datumDB = Utility::make_DB_datum($datum);
        $persnrRows = $this->model->getPersnrRowsFromDrueckDatum($datumDB,$persnr);

        if ($persnrRows !== NULL) {

            foreach ($persnrRows as $persnrRow) {
                $persnr = $persnrRow['persnr'];
                //zjistit info o persnr podle persnr
                $persInfoArray = $this->model->getPersnrInfo($persnr);
                
                $rows = $this->model->getLeistungAnwesenheitRows($datumDB, $persnr);
                
                // pro vynechani lidi, kteri nemaji zadne radky z druecku vhodne do dochazky
                if($rows==NULL){
                    continue;
                }
                
                if($persInfoArray!==NULL){
                    $name = $persInfoArray['name'].' '.$persInfoArray['vorname']."( anwgr.:".$persInfoArray['anwgruppe']." )";
                }
                else{
                    $name='';
                }

                // pridat info z dochazkoveho systemu
                $count=0;
                $edataRows = $this->model->getAnwesenheitFromEdata($datumDB, $persnr);
                if ($edataRows !== NULL) {
                    foreach ($edataRows as $edataRow) {
                        $von = substr($edataRow['von'],11);
                        $bis = substr($edataRow['bis'],11);
                        $count = $edataRow['pocet'];
                    }
                }
                else{
                    $von='';
                    $bis='';
                }

                // pokud mam z dochazky edata jen jeden zaznam, tak ho budu brat jako prichod
                // pozdeji upravit pro vyhledani nocni
                
                if($count<2) $bis='';
                
                $div.="<table class='person_anwtable'>";
                $div.="<tr>";
                $div.="<td class='tlabel'>";
                $div.="PersNr:";
                $div.="</td>";
                $div.="<td class='tvalue_persnr'>";
                $div.="$persnr";
                $div.="</td>";
                $div.="<td class='tlabel'>";
                $div.="Name:";
                $div.="</td>";
                $div.="<td class='tvalue_name'>";
                $div.="$name";
                $div.="</td>";
                $div.="<td class='tlabel'>";
                $div.="EDataReader:";
                $div.="</td>";
                $div.="<td class='tvalue_von'>";
                $div.="$von";
                $div.="</td>";
                $div.="<td class='tvalue_von'>";
                $div.="$bis";
                $div.="</td>";
                $acturl=$this->link('insertAnwesenheitAll');
                $div.="<td class='tlabel'><input type='button' value='vlozit' acturl='$acturl' id='ins_".$persnr."' /></td>";
                $div.="</tr>";
                $div.="</table>";

                $acturl='';
                
                if ($rows !== NULL) {
                    $div.="<table class='leistung_anwtable'>";
                    
                    $oeold = $rows[0]['oe'];
                    $bisP = $rows[0]['bis'];
                    $vonP = $rows[0]['von'];
                    $datum = $rows[0]['datum'];
                    $pause = $rows[0]['sumpause']/60;
                    $sumPause = $pause;
                    $sumPauseAll = $pause;
                    $citac = 0;
                    if (count($rows) == 1) {
                        // spocitat celkovy pocet hodin z von a bis
                        $stunden = $this->getStundenBetweenVonBis($vonP, $bisP)-$pause;
                        $pauseF = number_format($sumPause, 2, ',', ' ');
			$ag = intval($persInfoArray['anwgruppe']);
                        $bisP = $this->roundBisAuf8Std($stunden, $vonP, $bisP, $pause, $ag);
                        
                        $div.="<tr id='r_".$persnr."_".$citac."'>";
                        $div.="<td acturl='$acturl' id='oe_".$persnr."_".$citac."' class='tvalue_oe'>$oeold</td>";
                        $div.="<td class='tvalue_von'><input id='von_".$persnr."_".$citac."' value='$vonP' maxlength='5' size='5' acturl='$acturl'/></td>";
                        $div.="<td class='tvalue_von'><input id='bis_".$persnr."_".$citac."' value='$bisP' maxlength='5' size='5' acturl='$acturl'/></td>";
                        $div.="<td class='tvalue_oe'><input id='pause_".$persnr."_".$citac."' value='$pauseF' maxlength='4' size='4' acturl='$acturl'/></td>";
                        $acturl = $this->link('insertAnwesenheit');
//                        $div.="<td id='tid_".$persnr."_".$citac."' acturl='$acturl' class='tvalue_stunden'><input acturl='$acturl' id='insert_".$persnr."_".$citac."' type='button' value='vlozit'/></td>";
                        $div.="<td id='tid_".$persnr."_".$citac."' acturl='$acturl' class='tvalue_stunden'></td>";
                        $div.="</tr>";
                        
                        $div.="<tr>";
                        $div.="<td class='tvalue_oe' colspan='4'>Stunden lt. Leistung</td>";
                        $stunden = number_format($stunden, 2, ',', ' ');
                        $div.="<td class='tvalue_stunden'>$stunden</td>";
                        $div.="</tr>";

                    } else {
                        $sumPause=0;
			$sumPauseAll=0;
                        $counter = 0;
                        $vonStart = $vonP;
                        
                        foreach ($rows as $row) {
                            $acturl='';
                            $oe = $row['oe'];
                            $von = $row['von'];
                            $bis = $row['bis'];
                            $datum = $row['datum'];
                            $pause = $row['sumpause']/60;
                            $div.="<tr>";
//                            $div.="<td class='tvalue_oe'>$oe</td><td style='border: solid 1px black;padding: 5px;'>$von</td><td style='border: solid 1px black;padding: 5px;'>$bis</td><td class='tvalue_oe'>$pause</td><td class='tvalue_oe'>$sumPause</td>";
//                            $div.="</tr>";
                            
                            $counter++;
                            if ($oe != $oeold) {
                                $pauseF = number_format($sumPause, 2, ',', ' ');
                                $div.="<tr id='r_".$persnr."_".$citac."'>";
                                $div.="<td acturl='$acturl' id='oe_".$persnr."_".$citac."' class='tvalue_oe'>$oeold</td>";
                                $div.="<td class='tvalue_von'><input id='von_".$persnr."_".$citac."' value='$vonP' maxlength='5' size='5' acturl='$acturl'/></td>";
                                $div.="<td class='tvalue_von'><input id='bis_".$persnr."_".$citac."' value='$bisP' maxlength='5' size='5' acturl='$acturl'/></td>";
                                $div.="<td class='tvalue_oe'><input id='pause_".$persnr."_".$citac."' value='$pauseF' maxlength='4' size='4' acturl='$acturl'/></td>";
                                $acturl = $this->link('insertAnwesenheit');
//                                $div.="<td id='tid_".$persnr."_".$citac."' class='tvalue_stunden'><input acturl='$acturl' id='insert_".$persnr."_".$citac."' type='button' value='vlozit'/></td>";
                                $div.="<td id='tid_".$persnr."_".$citac."' class='tvalue_stunden'></td>";
                                $div.="</tr>";
                                $vonP = $von;
                                $oeold = $oe;
                                // posledni
                                $bisP = $bis;
                                $sumPause=0;
                            } else {
                                $bisP = $bis;
                            }
                            if($counter>0) {
                                $sumPause+=$pause;
                                $sumPauseAll+=$pause;
                            }
//                          
                            $citac++;
                            
                        }
                        
                        // pokud bude celkova odpracovana doba <8hodin a >=7,5, tak musim bis zaokrouhlit na celkovych 8 hodin
                        $bisStart = $bis;
                        $stunden = $this->getStundenBetweenVonBis($vonStart, $bisStart)-$sumPauseAll;
                        $acturl='';
                        $pauseF = number_format($sumPause, 2, ',', ' ');
			$ag = intval($persInfoArray['anwgruppe']);
                        $bis = $this->roundBisAuf8Std($stunden, $vonStart, $bis, $sumPauseAll,$ag);
                        $div.="<tr id='r_".$persnr."_".$citac."'>";
                        $div.="<td acturl='$acturl' id='oe_".$persnr."_".$citac."' class='tvalue_oe'>$oeold</td>";
                        $div.="<td class='tvalue_von'><input id='von_".$persnr."_".$citac."' value='$vonP' maxlength='5' size='5' acturl='$acturl'/></td>";
                        $div.="<td class='tvalue_von'><input id='bis_".$persnr."_".$citac."' value='$bis' maxlength='5' size='5' acturl='$acturl'/></td>";
                        $div.="<td class='tvalue_oe'><input id='pause_".$persnr."_".$citac."' value='$pauseF' maxlength='4' size='4' acturl='$acturl'/></td>";
                        $acturl = $this->link('insertAnwesenheit');
//                        $div.="<td id='tid_".$persnr."_".$citac."' class='tvalue_stunden'><input acturl='$acturl' id='insert_".$persnr."_".$citac."' type='button' value='vlozit'/></td>";
                        $div.="<td id='tid_".$persnr."_".$citac."' class='tvalue_stunden'></td>";
                        $div.="</tr>";
                        
                        $div.="<tr>";
                        $div.="<td class='tvalue_oe' colspan='4'>Stunden lt. Leistung</td>";
                        $stunden = number_format($stunden, 2, ',', ' ');
                        $div.="<td class='tvalue_stunden'>$stunden</td>";
                        $div.="</tr>";

                    }
                    $div.="</table>";
                }
                $div.="<hr>";
            }
        }

        return $div;
    }

    public function actionInsertAnwesenheitAll($id, $datum, $restId, $likeID,$oeArray,$vonArray,$bisArray,$pauseArray,$ridArray) {
        $this->getAjaxDriver()->id = $id;
        $this->getAjaxDriver()->datum = $datum;
        
        $prvniPodtrzitko = strpos($id, '_');
        $persnr = substr($id, $prvniPodtrzitko+1);
        
        
        $this->getAjaxDriver()->persnr = $persnr;
        $this->getAjaxDriver()->restId = $restId;
        $this->getAjaxDriver()->likeId = $likeID;
        $this->getAjaxDriver()->oeArray = $oeArray;
        $this->getAjaxDriver()->vonArray = $vonArray;
        $this->getAjaxDriver()->bisArray = $bisArray;
        $this->getAjaxDriver()->pauseArray = $pauseArray;
        $this->getAjaxDriver()->ridArray = $ridArray;
        
        

        $anwarray = array();
        for($i=0;$i<count($oeArray);$i++){
            $anwarray[$i]['oe']=$oeArray[$i];
            $anwarray[$i]['von']=$vonArray[$i];
            $anwarray[$i]['bis']=$bisArray[$i];
            $pause = strtr($pauseArray[$i], ',', '.');
            $anwarray[$i]['pause']=$pause;
            $anwarray[$i]['rid']=$ridArray[$i];
        }
        $this->getAjaxDriver()->anwArray = $anwarray;
        
        $i=0;
        foreach ($anwarray as $anw){
            $schicht = $this->model->getStammSchicht($persnr);
            $iA[$i] = $this->model->insertAnwesenheit($persnr, $schicht, $datum, 
                    $anw['von'], $anw['bis'], $anw['pause'],
                    0,1,$anw['oe'], TRUE);
            $iA[$i]['stunden']=  number_format($iA[$i]['stunden'], 2, ',', ' ');
            $i++;
        }
        
        $this->getAjaxDriver()->iA = $iA;
        
        $this->terminate();
    }

    public function actionInsertAnwesenheit($id,$datum,$oe,$von,$bis,$pause,$restId){
            // persnr je ulozeno v id neco_persnr_citac
            $prvniPodtrzitko = strpos($id, '_');
            $druhePodtrzitko = strpos($id, '_',$prvniPodtrzitko+1);
            
            $persnr = substr($id, $prvniPodtrzitko+1, $druhePodtrzitko-$prvniPodtrzitko-1);
            
            $this->getAjaxDriver()->id=$id;
            $this->getAjaxDriver()->datum=$datum;
            $this->getAjaxDriver()->persnr=$persnr;
            $this->getAjaxDriver()->oe=$oe;
            $this->getAjaxDriver()->von=$von;
            $this->getAjaxDriver()->bis=$bis;
            $pause = strtr($pause, ',', '.');
            $this->getAjaxDriver()->pause=$pause;
            $this->getAjaxDriver()->restId=$restId;

            $schicht = $this->model->getStammSchicht($persnr);
            $vystup = $this->model->insertAnwesenheit($persnr, $schicht, $datum, $von, $bis, $pause, 0, 1, $oe,TRUE);
            $this->getAjaxDriver()->sql=$vystup['sql'];
            $this->getAjaxDriver()->stunden=  number_format($vystup['stunden'], 2, ',',' ');
            $this->getAjaxDriver()->result=1;
            $this->terminate();
    }
    
    /**
     * 
     */
    public function actionEdataDatumUpdate($id,$value,$persnr){
        $this->getAjaxDriver()->id=$id;
        $this->getAjaxDriver()->value=$value;
        $this->getAjaxDriver()->persnr=$persnr;
        $this->getAjaxDriver()->edataanwtableContent = $this->getEdataAnwTableDivString($value,$persnr);
        $this->terminate();
    }

    /**
     * 
     */
    public function actionEdataPersnrUpdate($id,$value,$datum){
        $this->getAjaxDriver()->id=$id;
        $this->getAjaxDriver()->value=$value;
        $this->getAjaxDriver()->datum=$datum;
        $this->getAjaxDriver()->edataanwtableContent = $this->getEdataAnwTableDivString($datum,$value);
        $this->terminate();
    }

    public function actionEdataAnw() {

        $values['datum'] = date('d.m.Y');
        $values['persnr'] = '*';

        $form = new FormEdataAnwFilter('edataanwfilter');

        $acturlArray = array(
            'persnr' => $this->link('edataPersnrUpdate'),
            'datum' => $this->link('edataDatumUpdate'),
        );
        $form->setActUrl($acturlArray);
        $form->setControlValues($values);
        $this->template->edataanwtableContent = $this->getEdataAnwTableDivString($values['datum'],$values['persnr']);
        
        $this->template->form = $form;
        $this->template->debuginfo = '';
    }

    public function actionPlanVzkd(){

        $oes = $this->model->getOEInfo();
        $keys = Utility::getArrayWithKey('tat', $oes);
        $values = Utility::getArrayWithKey('tat', $oes);
        $oeSelectItems = new SelectItemsModel('', $keys, $values);

        // pripravim si datum nasledujiciho pondeli
        $dnesTimestamp = time();
        $dnesDenVTydnu = date('w',$dnesTimestamp);
        if($dnesDenVTydnu==0)
            $plusDnu = 1;
        else
            $plusDnu = 7 - $dnesDenVTydnu;

        $pristiPondeliTimestamp = $dnesTimestamp + ($plusDnu+1) * 24 * 60 * 60;

        $values = array(
            'datumvon'=>date('d.m.Y',$pristiPondeliTimestamp),
        );

        $values['planoe'] = $oeSelectItems->getSelectItemsArray();

        $form = new FormVzKdPlanFilter('vzkdplanfilter');
        $form->setActUrl($this->acturlArray);
//        echo '<pre>'.var_dump($values).'</pre>';
        $form->setControlValues($values);
        $this->template->form = $form;
        $this->template->debuginfo = '';
    }

    public function renderPlanVzkd(){

        $sec = $this->fillSecClasses('vzkdplanfilter');
        $this->template->form_id = $sec['form_id'];
        $this->template->secclasses = $sec['secclasses'];
        $this->template->allowedarray = $sec['allowedarray'];
    }

    public function actionValidateWoche($id,$value,$planoe,$datumvon,$persnr){

        $timestampVon = strtotime(Utility::make_DB_datum($datumvon));

        switch ($id) {
            case 'frmvzkdplanfilter-wocheplus':
                $timestampVon += 60*60*24*7;
                break;
            case 'frmvzkdplanfilter-wocheminus':
                $timestampVon -= 60*60*24*7;
                break;
            default:
                break;
        }
        $datumvon = date('d.m.Y',$timestampVon);
        $this->actionValidatePersnr($id, $value, $planoe, $datumvon, $persnr);
    }

    public function actionValidatePersnr($id,$value,$planoe,$datumvon){
        $this->getAjaxDriver()->id = $id;
        $this->getAjaxDriver()->value = $value;
        $this->getAjaxDriver()->planoe = $planoe;
        $this->getAjaxDriver()->datumvon = $datumvon;
        //$this->getAjaxDriver()->persnr = $persnr;

        $persnr = '';
        $days = 7;
        $personenArray = $this->model->getPlanStundenArray($persnr,$planoe,  Utility::make_DB_datum($datumvon),$days,TRUE);
        $this->getAjaxDriver()->personenArray = $personenArray;

        $timestampVon = strtotime(Utility::make_DB_datum($datumvon));

        $infoDiv = '';
        if(count($personenArray)>0){

            $infoDiv .="<table border='1'>";

            $infoDiv .="<tr>";
            $infoDiv .="<th width='50'>";
            $infoDiv .="PersNr";
            $infoDiv .="</th>";
            $infoDiv .="<th width='150'>";
            $infoDiv .="Name";
            $infoDiv .="</th>";
            $infoDiv .="<th width='25'>";
            $infoDiv .="Regel OE";
            $infoDiv .="</th>";
//            $infoDiv .="<th width='25'>";
//            $infoDiv .="Regel ArbZeit";
//            $infoDiv .="</th>";
            $infoDiv .="<th width='25'>";
            $infoDiv .="Faktor Anw->VzKd";
            $infoDiv .="</th>";

            $timestamp = $timestampVon;
            for($i=0;$i<$days;$i++){
            $timestampIndex = date('d.m.Y',$timestamp);
            $atagClass = 'arbeitstag';
            $weekTag = date('w', $timestamp);
            if ($weekTag == 6 || $weekTag == 0)
                $atagClass = 'noarbeitstag';
            $infoDiv .="<th colspan='2' width='100' class='$atagClass'>";
            $infoDiv .= "$timestampIndex ".Utility::$weekDays[$weekTag];
            $timestamp += 60*60*24;
            $infoDiv .="</th>";
            }

            $infoDiv .="</tr>";

            $infoDiv .="<tr>";
            $infoDiv .="<th colspan='4'>";
            $infoDiv .="&nbsp;";
            $infoDiv .="</th>";

            $timestamp = $timestampVon;
            for ($i = 0; $i < $days; $i++) {
                $atagClass = 'arbeitstag';
                $weekTag = date('w', $timestamp);
                if ($weekTag == 6 || $weekTag == 0)
                    $atagClass = 'noarbeitstag';
                $infoDiv .="<td class='$atagClass floatinputbox'>";
                $infoDiv .='Anw';
                $infoDiv .="</td>";
                $infoDiv .="<td class='$atagClass floatinputbox'>";
                $infoDiv .='VzKd';
                $infoDiv .="</td>";

                $timestamp += 60 * 60 * 24;
            }

            $infoDiv .="</tr>";

            // projdu lidi
        foreach ($personenArray as $persnr=>$person){
            $infoDiv .="<tr>";
                $infoDiv .="<td class='floatinputbox'>";
                    $infoDiv .="$persnr";
                $infoDiv .="</td>";

                $infoDiv .="<td>";
                    $infoDiv .=$person['name'];
                $infoDiv .="</td>";

                $infoDiv .="<td>";
                    $infoDiv .=$person['regeloe'];
                $infoDiv .="</td>";

//                $infoDiv .="<td class='floatinputbox'>";
//                    $infoDiv .=$person['regelarbzeit'];
//                $infoDiv .="</td>";

                $infoDiv .="<td class='floatinputbox'>";
                    $infoDiv .= "<input type='button' acturl='".$this->link('fillVzkd')."' size='3' maxlength='5' id='fillvzkd_".$persnr."' value='fullen'/>";
                    $infoDiv .= "<input class='floatinputbox' type='text' acturl='".$this->link('updateAnwVzkdFaktor')."' size='3' maxlength='5' id='anwvzkd_faktor_".$persnr."' value='".number_format ($person['lfaktor'],2)."'/>";
                $infoDiv .="</td>";

                // vypsat kratky kalendar zacinajici od $datumvon a zobrazujici days dnu
                $timestamp = $timestampVon;
                for($i=0;$i<$days;$i++){
                    $timestampIndex = date('Ymd',$timestamp);
                    $atagClass = 'arbeitstag';
                    $weekTag = date('w',$timestamp);
                    if($weekTag==6 || $weekTag==0)
                        $atagClass = 'noarbeitstag';
                    $infoDiv .="<td class='floatinputbox $atagClass'>";
                    if(key_exists($timestampIndex, $person))
                        $infoDiv .= number_format ($person[$timestampIndex]['anwstunden'],1);
                    else
                        $infoDiv .= '-';
                    $infoDiv .="</td>";
                    $infoDiv .="<td class='floatinputbox $atagClass'>";
                        if(key_exists($timestampIndex, $person))
                            $infoDiv .= "<input class='floatinputbox' type='text' acturl='".$this->link('updateDatumVzkdSoll')."' size='3' maxlength='5' id='datumvzkd_".$persnr.'_'.$timestampIndex.'_'.$planoe."' value='".number_format ($person[$timestampIndex]['vzkdstunden'],1)."'/>";
                        else
                            $infoDiv .= '-';
                        $timestamp += 60*60*24;
                    $infoDiv .="</td>";
                }
            $infoDiv .="</tr>";
        }
            $infoDiv .="</table>";
        }

        $this->getAjaxDriver()->infodiv = $infoDiv;
        $this->terminate();
    }


public function actionFillVzkd($id,$value,$planoe,$datumvon){
        $this->getAjaxDriver()->id = $id;
        $this->getAjaxDriver()->value = $value;
        $days=7;
        $posledniPodtrzitkoPos = strrpos($id, '_');

        $persnr = substr($id, $posledniPodtrzitkoPos+1);

        //$affectedRows = $this->model->updateDpersFieldProPersNr($persnr, 'anwvzkd_faktor', floatval($value));
        $timestampVon = strtotime(Utility::make_DB_datum($datumvon));
        $timestampBis = $timestampVon + 6*24*60*60;
        $dbVon = Utility::make_DB_datum($datumvon);
        $dbBis = date('Y-m-d',$timestampBis);

        $this->getAjaxDriver()->von = $dbVon;
        $this->getAjaxDriver()->bis = $dbBis;
        $this->getAjaxDriver()->oe = $planoe;
        
        $this->getAjaxDriver()->persnr = $persnr;

        $affectedRows = $this->model->fillVzkdSollFromAnwSollAndFactor($persnr,$planoe,$dbVon,$dbBis);
        $this->getAjaxDriver()->affectedRows = $affectedRows;
        if($affectedRows>0){
            $personenArray = $this->model->getPlanStundenArray($persnr,$planoe,  Utility::make_DB_datum($datumvon),$days);
            $this->getAjaxDriver()->personenArray = $personenArray;
        }
        else
            $this->getAjaxDriver()->personenArray = NULL;
        $this->terminate();

}

public function actionUpdateAnwVzkdFaktor($id,$value){
        $this->getAjaxDriver()->id = $id;
        $this->getAjaxDriver()->value = $value;

        $posledniPodtrzitkoPos = strrpos($id, '_');

        $persnr = substr($id, $posledniPodtrzitkoPos+1);

        $affectedRows = $this->model->updateDpersFieldProPersNr($persnr, 'anwvzkd_faktor', $value);

        $this->getAjaxDriver()->affectedRows = $affectedRows;
        $this->getAjaxDriver()->formattedValue = number_format(floatval($value),2);
        $this->getAjaxDriver()->persnr = $persnr;
        $this->terminate();

}


    public function actionUpdateDatumVzkdSoll($id,$value){
        $this->getAjaxDriver()->id = $id;
        $this->getAjaxDriver()->value = $value;

        $podtrzitko1Pos = strpos($id, '_',0);
        $podtrzitko2Pos = strpos($id, '_',$podtrzitko1Pos+1);
        $podtrzitko3Pos = strpos($id, '_',$podtrzitko2Pos+2);

        $persnr = substr($id, $podtrzitko1Pos+1, $podtrzitko2Pos-$podtrzitko1Pos-1);
        $datumStr = substr($id, $podtrzitko2Pos+1, $podtrzitko3Pos-$podtrzitko2Pos-1);
        // datumStr = napr. 20100701
        $datumDB = substr($datumStr, 0, 4).'-'.substr($datumStr, 4, 2).'-'.substr($datumStr, 6, 2);

        $oe = substr($id, $podtrzitko3Pos+1);

        $affectedRows = $this->model->updateDatumVzKd($persnr,$oe,$datumDB,  floatval($value));

        $this->getAjaxDriver()->affectedRows = $affectedRows;
        $this->getAjaxDriver()->formattedValue = number_format(floatval($value),1);
        $this->getAjaxDriver()->persnr = $persnr;
        $this->getAjaxDriver()->datumStr = $datumStr;
        $this->getAjaxDriver()->datumDB = $datumDB;
        $this->getAjaxDriver()->oe = $oe;
        $this->terminate();
    }

    public function renderPlanAnwesenheit(){
          $security = $this->fillSecClasses('form_persplan');
          $this->template->form_id = $security['form_id'];
          $this->template->secclasses = $security['secclasses'];
    }

    public function actionUpdateRegelOE($value,$personal,$persnr) {
        $this->getAjaxDriver()->value = $value;
        $this->getAjaxDriver()->persnr = $personal;
        $aplDB = new AplModel();

        $affectedRows = $aplDB->updateRegelOE($personal,$value);
        $this->getAjaxDriver()->affectedrows = $affectedRows;

        $this->terminate();
    }

    
    public function actionUpdateRegelarbzeit($elementid,$persnr,$regelarbzeit){
        $this->getAjaxDriver()->elementid = $elementid;
        $this->getAjaxDriver()->persnr = $persnr;
        $this->getAjaxDriver()->regelarbzeit = $regelarbzeit;
        $aplDB = new AplModel();

        $affectedRows = $aplDB->updateRegelarbzeit($persnr,$regelarbzeit);
        $this->getAjaxDriver()->affectedrows = $affectedRows;

        if($affectedRows>0){
            // spocitam sollstunden pro mesic
            $sollArray = $aplDB->getSollStundenLautCalendar($this->rok, $this->mesic, $regelarbzeit);
            $sollstunden = $sollArray['sollstunden'];
            $this->getAjaxDriver()->sollstunden = $sollstunden;
        }

        $this->terminate();
    }


    public function actionUpdateStdsolldatum($elementid,$persnr,$stdsolldatum){
        $this->getAjaxDriver()->elementid = $elementid;
        $this->getAjaxDriver()->persnr = $persnr;
        $this->getAjaxDriver()->stdsolldatum = $stdsolldatum;
        $aplDB = new AplModel();

        $affectedRows = $aplDB->updateStdsolldatum($persnr,$stdsolldatum);
        $this->getAjaxDriver()->affectedrows = $affectedRows;


        $this->terminate();
    }

    /**
     *
     * @param <type> $elementid
     * @param <type> $persnr
     */
    public function actionGetPersnrInfo($elementid,$persnr){
        $this->getAjaxDriver()->elementid = $elementid;
        $this->getAjaxDriver()->persnr = $persnr;

        $aplDB = new AplModel();

        $this->persnr = $persnr;
        $this->getAjaxDriver()->db = $aplDB->getDb()->getDatabaseInfo()->getName();
        $persInfoRow = $aplDB->getPersnrInfo($persnr);
        if(strlen(trim($persInfoRow['austritt']))>0){
            $this->getAjaxDriver()->persinfo = NULL;
            $this->terminate();
        }
        else{
            $this->getAjaxDriver()->persinfo = $persInfoRow;
        }

        // get urlaub info
        if($this->mesic>1){
            $m = $this->mesic;
            $r = $this->rok;
        }
        else{
            $m = 12;
            $r = $this->rok-1;
        }

        $pocetdnu = cal_days_in_month(CAL_GREGORIAN, $m, $r);
        $bisDatumLastMonth = $r."-".$m."-".$pocetdnu;
        $this->getAjaxDriver()->urlaubinfo = $aplDB->getUrlaubBisDatum($persnr, $bisDatumLastMonth);

        $this->terminate();
    }



public function actionMonatFuellenStandard($monatjahr){
        $this->getAjaxDriver()->elementid = $monatjahr;

        $pole = explode("-", $monatjahr);
        if((is_array($pole))&(count($pole)>1)) {
            $rok = $pole[0];
            $mesic = $pole[1];
            $this->getAjaxDriver()->monat = $mesic;
            $this->getAjaxDriver()->jahr = $rok;
            // kontrola smysluplnosti roku a mesice
            // 1. rok nebudu planovat dozadu
            $aktualniRok = date('Y');
            if($rok<$aktualniRok) {
                $this->getAjaxDriver()->datumok = 0;
                $this->terminate();
            }
            // 2. mesic musi byt mezi 1 a 12
            if($mesic<1 || $mesic>12) {
                $this->getAjaxDriver()->datumok = 0;
                $this->terminate();
            }
        }
        else{
                $this->getAjaxDriver()->datumok = 0;
                $this->terminate();
        }

        $db = new AplModel();


        // vybrat vsechna persnr, kteri maji nastaveno nejake regeloe a a maji spravny austritt
        $persnrArray = $db->getArbeitendePersnrMitRegelOEArray($rok,$mesic);
        $this->getAjaxDriver()->persnrArray = $persnrArray;
        $i=0;
        foreach($persnrArray as $persnr){
            $planInfo[$i++] = $db->getPlanInfo($rok, $mesic, $persnr);
        }

        $this->getAjaxDriver()->planInfoArray = $planInfo;
        $this->getAjaxDriver()->planinfocount = $i;
        $this->terminate();
}

    public function actionSaveDzeitsoll2($monatjahr,$run,$monat=0,$jahr=0){
        $this->getAjaxDriver()->elementid = $monatjahr;
        $this->getAjaxDriver()->elementid = $run;
        $this->getAjaxDriver()->monat = $this->mesic;
        $this->getAjaxDriver()->jahr = $this->rok;
        $this->getAjaxDriver()->run = $run;

        if($run==1) {
        // zakontroluju zadany datum
            $pole = explode("-", $monatjahr);
            if((is_array($pole))&(count($pole)>1)) {
                $rok = $pole[0];
                $mesic = $pole[1];
                $this->getAjaxDriver()->monat = $mesic;
                $this->getAjaxDriver()->jahr = $rok;
                // kontrola smysluplnosti roku a mesice
                // 1. rok nebudu planovat dozadu
                $aktualniRok = date('Y');
                if($rok<$aktualniRok) {
                    $this->getAjaxDriver()->datumok = 0;
                    $this->terminate();
                }
                // 2. mesic musi byt mezi 1 a 12
                if($mesic<1 || $mesic>12) {
                    $this->getAjaxDriver()->datumok = 0;
                    $this->terminate();
                }

                $this->getAjaxDriver()->datumok = 1;
                // otestuju zda uz vybrany mesic nemam zakonzervovan
                $aplDB = new AplModel();
                $hasSavedUrsprung = $aplDB->testSavedUrsprungPlan($mesic,$rok);
                $this->getAjaxDriver()->hasdata = $hasSavedUrsprung;
                $this->getAjaxDriver()->acturl2 = $this->link($this->getAction());
            }
            else {
                $this->getAjaxDriver()->datumok = 0;
                $this->terminate();
            }
        }
        else{
            // tato vetev pobezi v pripade, ze uzivatel potvrdi smazani puvodnich dat a ulozeni novych
            $this->getAjaxDriver()->monat = $monat;
            $this->getAjaxDriver()->jahr = $jahr;
            $this->getAjaxDriver()->run = $run;
            $aplDB = new AplModel();
            $savedPositionen = $aplDB->saveUrsprung($monat,$jahr);
            $this->getAjaxDriver()->savedpositionen = $savedPositionen;
        }

        $this->terminate();
    }

    /**
     *
     * @param <type> $elementid
     * @param <type> $persnr
     * @param <type> $monatjahr
     */
    public function actionValidateMonatJahr($elementid,$persnr,$monatjahr){
        $this->getAjaxDriver()->elementid = $elementid;
        $this->getAjaxDriver()->persnr = $persnr;
        $this->getAjaxDriver()->monatjahr = $monatjahr;

        // rozeberu si retezec monatjahr
        // musi byt ve tvaru YYYY-MM
        //$pole = split("-", $monatjahr);
        $pole = explode("-", $monatjahr);

        if((is_array($pole))&(count($pole)>1)){
            $rok = $pole[0];
            $mesic = $pole[1];
            $this->getAjaxDriver()->monat = $mesic;
            $this->getAjaxDriver()->jahr = $rok;
            // kontrola smysluplnosti roku a mesice
            // 1. rok nebudu planovat dozadu
            $aktualniRok = date('Y');
            if($rok<$aktualniRok){
                $this->getAjaxDriver()->planinfo = null;
                $this->terminate();
            }
            // 2. mesic musi byt mezi 1 a 12
            if($mesic<1 || $mesic>12){
                $this->getAjaxDriver()->planinfo = null;
                $this->terminate();
            }

            $this->mesic = $mesic;
            $this->rok = $rok;


            if($persnr>0) {
            // kdyz dojdu az sem zkusim vytahnout info o planu pro dany datum a personalni cislo
                $aplDB = new AplModel();

                // kontrola na austritt, pokud ma vyplnen austritt nebudu s nim pracovat
                $persInfoRow = $aplDB->getPersnrInfo($persnr);
                if(strlen(trim($persInfoRow['austritt']))>0){
                    $this->getAjaxDriver()->persinfo = NULL;
                    $this->terminate();
                }

		$svatkyArray = $aplDB->getSvatkyArray($rok, $mesic);
		$this->getAjaxDriver()->svatkyarray = $svatkyArray;
                $planinfo = $aplDB->getPlanInfo($rok,$mesic,$persnr);
                $this->getAjaxDriver()->planinfo = $planinfo;

                // sollstunden pro dany mesic
                $regelarbeit = $aplDB->getRegelarbzeit($persnr);
                $sollStundenLautCalendar = $aplDB->getSollStundenLautCalendar($rok,$mesic,$regelarbeit);
                $this->getAjaxDriver()->sollstundenlautcalendar = $sollStundenLautCalendar;

                // istzeit pro cloveka a mesic a rok
                $istStunden = $aplDB->getIstAnwesenheitStunden($rok,$mesic,$persnr);
                $this->getAjaxDriver()->istanwesenheit = $istStunden;

                // geplante stunden for given month
                $planStunden = $aplDB->getPlanStunden($rok,$mesic,$persnr);
                $this->getAjaxDriver()->planstunden = $planStunden;

                // get urlaub info
                if($this->mesic>1) {
                    $m = $this->mesic-1;
                    $r = $this->rok;
                }
                else {
                    $m = 12;
                    $r = $this->rok-1;
                }

                $pocetdnu = cal_days_in_month(CAL_GREGORIAN, $m, $r);
                $bisDatumLastMonth = $r."-".$m."-".$pocetdnu;
                $this->getAjaxDriver()->urlaubinfo = $aplDB->getUrlaubBisDatum($persnr, $bisDatumLastMonth);
                $this->getAjaxDriver()->urlaubrestbis = $bisDatumLastMonth;


                // vypocet prescasovych hodin
                $plusMinusKontoA = $aplDB->getPlusMinusStunden($this->mesic, $this->rok, $this->persnr);
                $this->getAjaxDriver()->plusminusstunden = $plusMinusKontoA;

                // jeste budu potrebovat seznam seznam vsech oe
                $this->getAjaxDriver()->oelist = $aplDB->getOEInfo();
            }
            else{
                $this->getAjaxDriver()->setmonatjahr = 1;
            }

            
            // a ajaxoveurl pro updatovani selectu a inputu
            $this->getAjaxDriver()->ajaxurl_select = $this->link('updatePlan');
            $this->getAjaxDriver()->ajaxurl_input = $this->link('updatePlan');
            $this->getAjaxDriver()->ajaxurl_newdatumbutton = $this->link('planDatumAdd');
            $this->getAjaxDriver()->ajaxurl_deletebutton = $this->link('planDatumDelete');
        }
        else
            $this->getAjaxDriver()->planinfo = null;

        $this->terminate();
    }


    public function actionPlanDatumDelete($elementid){
        $this->getAjaxDriver()->elementid = $elementid;
        $aplDB = new AplModel();
        // rozdelim si value na id radku a hodnotu
        $field_id = explode("_", $elementid);
        $field = $field_id[0];
        $id = $field_id[1];
        $this->getAjaxDriver()->field = $field;
        $this->getAjaxDriver()->id = $id;

        //vymazu dane id, pokud je to poeldni datum v danem mesici, tak ho tam necham a nastavim mu oe = -
        $lastid = $aplDB->datumDeleteFromId($id);

        $this->terminate();
    }

    // prida pro dany datum dalsi radek
    // tj. v jeden datum muzu mit vice cinnosti
    public function actionPlanDatumAdd($elementid){
        $this->getAjaxDriver()->elementid = $elementid;
        $aplDB = new AplModel();
        // rozdelim si value na id radku a hodnotu
        $field_id = explode("_", $elementid);
        $field = $field_id[0];
        $id = $field_id[1];
        $this->getAjaxDriver()->field = $field;
        $this->getAjaxDriver()->id = $id;

        //podle id vytvorim kopii radku v tabulce dzeitsoll
        $lastid = $aplDB->datumAddFromId($id);
        $this->getAjaxDriver()->lastid = $lastid;
//        Debug::dump($this->getAjaxDriver());
        $this->terminate();
    }
    
    /**
     *
     * @param <type> $elementid
     * @param <type> $value
     */
    public function actionUpdatePlan($elementid,$value,$monatjahr,$persnr) {
        $this->getAjaxDriver()->elementid = $elementid;
        $this->getAjaxDriver()->value = $value;
        $aplDB = new AplModel();
        // rozdelim si value na id radku a hodnotu
        $field_id = explode("_", $elementid);
        $field = $field_id[0];
        $id = $field_id[1];



        $this->getAjaxDriver()->field = $field;
        $this->getAjaxDriver()->id = $id;

        $affectedrows = $aplDB->updateDZeitsoll($field,$id,$value);
        $this->getAjaxDriver()->affectedrows = $affectedrows;

        // podle hodnoty v selectu musu udelat i navrh na pocet hodin
        if($field=='oe') {
            $oestatus = $aplDB->getOEStatusForOE($value);
            $anwArray = $aplDB->getAnwArrayForOE($value);
            $stunden = 0;
            $this->persnr = $persnr;
            if(!strcmp(strtoupper($anwArray['anw_soll']),'R')) {
            //                $stunden = 8;
                //$stunden = $aplDB->getRegelarbzeit($this->persnr);
                $stunden = $aplDB->getRegelarbzeit($persnr);
            }

            $this->getAjaxDriver()->pers = $this->persnr;
            $this->getAjaxDriver()->stunden = $stunden;
            $this->getAjaxDriver()->oestatus = $oestatus;
            $this->getAjaxDriver()->anwArray = $anwArray['anw_soll'];

            // vypocet prescasovych hodin
            $plusMinusKontoA = $aplDB->getPlusMinusStunden($this->mesic, $this->rok, $this->persnr);
            $this->getAjaxDriver()->plusminusstunden = $plusMinusKontoA;

        }

        if($field=='stunden') {
        // rozeberu si retezec monatjahr
        // musi byt ve tvaru YYYY-MM
            $pole = explode("-", $monatjahr);
            $rok = $pole[0];
            $mesic = $pole[1];

            // geplante stunden
            $planStunden = $aplDB->getPlanStunden($rok,$mesic,$persnr);
            $this->getAjaxDriver()->planstunden = $planStunden;
            // vypocet prescasovych hodin
            $plusMinusKontoA = $aplDB->getPlusMinusStunden($this->mesic, $this->rok, $this->persnr);
            $this->getAjaxDriver()->plusminusstunden = $plusMinusKontoA;

        }
        $this->terminate();
    }

    protected function beforeRender(){
//         $this->template->presenterName = $this->getName();
         $this->template->viewName = $this->getView();
         $this->template->actionName = $this->getAction();
         $user = Environment::getUser();
         $rolesArray = $user->getRoles();
         $roles = join(',', $rolesArray);
         $this->template->userRoles = $roles;
         parent::beforeRender();
    }

}
?>
