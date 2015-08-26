<?php

/**
 * presenter pro spravu pracovniku Abydos s.r.o.
 * 
 *
 * @author runt
 */
class PersinfoPresenter extends BasePresenter{

        /**
         * @var array
         */
    var $acturlArray;

    protected function startup(){
        parent::startup();
        $this->acturlArray = array(
            'bewerb_datum'=>$this->link('updateDBewerbDatumField'),
//            'aufenthaltsort'=>$this->link('updateDBewerbField'),
            'staats_angehoerigkeit_id'=>$this->link('updateDBewerbField'),
            'transport_id'=>$this->link('updateDBewerbField'),
            'eigen_transport_id'=>$this->link('updateDBewerbField'),
            'geeignet_id'=>$this->link('updateDBewerbField'),
            'info_vom_id'=>$this->link('updateDBewerbField'),
            'bew_geeignet_aktual_id'=>$this->link('updateDBewerbField'),
            'beendet_recht_id'=>$this->link('updateDBewerbField'),
            'beendet_real_id'=>$this->link('updateDBewerbField'),
            'nicht_eingetretten_grund_id'=>$this->link('updateDBewerbField'),
            'bewertung1'=>$this->link('updateDBewerbField'),
            'bewertung2'=>$this->link('updateDBewerbField'),
            'bewertung3'=>$this->link('updateDBewerbField'),
            'oe_voraussichtlich'=>$this->link('updateDBewerbField'),
            'bewertung_bemerkung'=>$this->link('updateDBewerbField'),
//            'uebergang'=>$this->link('updateDBewerbField'),
            'eintritt_datum'=>$this->link('updateDBewerbDatumField'),
            'aktual_info_bemerkung'=>$this->link('updateDBewerbField'),
            'nicht_eingetreten_grund'=>$this->link('updateDBewerbField'),
            'bemerkung_sonst'=>$this->link('updateDBewerbField'),
            'info_vom'=>$this->link('updateDBewerbField'),
            'erledigt'=>$this->link('updateDBewerbField'),
            'abydos_agentur'=>$this->link('updateDBewerbField'),
            'arbamt_evidenz'=>$this->link('updateDBewerbField'),
            'vom_arb_amt_gekommen'=>$this->link('updateDBewerbField'),
            'gestraft'=>$this->link('updateDBewerbField'),
            'exekution'=>$this->link('updateDBewerbField'),
            'vertragb'=>$this->link('updateDBewerbField'),
            'artzt_eingang_untersuchung'=>$this->link('updateDBewerbField'),
//            'schuhe_groesse'=>$this->link('updateDBewerbField'),
            'berufskrankheit_gefahr'=>$this->link('updateDBewerbField'),
            'lehrer'=>$this->link('updateDBewerbField'),
            'meister'=>$this->link('updateDBewerbField'),
            'bewertung_schul_schicht'=>$this->link('updateDBewerbField'),
            'wettbewerb_1000_CZK'=>$this->link('updateDBewerbField'),
            'artzt_ausgang'=>$this->link('updateDBewerbField'),
            'beendet_vom'=>$this->link('updateDBewerbField'),
            'leistung_bewertung'=>$this->link('updateDBewerbField'),
            'stunden_durchschnitt'=>$this->link('updateDBewerbField'),
            'ausgang_bemerkung'=>$this->link('updateDBewerbField'),
            'persnr'=>$this->link('validatePersnr'),
            'bt_bewerberform_show'=>$this->link('bewerberForm'),
            'bt_persnrkopieren'=>$this->link('persnrKopieren'),
            'bt_persnrdelete'=>$this->link('persnrDelete'),
            'namesuchen'=>$this->link('validateNameComplete'),
            'name'=>$this->link('updateDpersField'),
	    'gebort'=>$this->link('updateDpersField'),
            'vorname'=>$this->link('updateDpersField'),
            'abkrz'=>$this->link('updateDpersField'),
            'tf_eintrittsdatum'=>$this->link('updateDpersDatumField'),
            'tf_austritt'=>$this->link('updateDpersDatumField'),
            'tf_geboren'=>$this->link('updateDpersDatumField'),
            'dobaurcita'=>$this->link('updateDpersDetailDatumField'),
            'zkusebni_doba_dobaurcita'=>$this->link('updateDpersDetailDatumField'),
            'strasse'=>$this->link('updateDpersDetailField'),
            'strasse_op'=>$this->link('updateDpersDetailField'),
            'ort_op'=>$this->link('updateDpersDetailField'),
            'plz_op'=>$this->link('updateDpersDetailField'),
            'plz'=>$this->link('updateDpersDetailField'),
            'schrank'=>$this->link('updateDpersDetailField'),
            'kfz_rz'=>$this->link('updateDpersDetailField'),
            'umkleidenr'=>$this->link('updateDpersDetailField'),
            'schuhe'=>$this->link('updateDpersDetailField'),
            'tf_ort'=>$this->link('updateDpersField'),
            'tf_handy'=>$this->link('updateDpersDetailField'),
            'schicht'=>$this->link('updateDpersField'),
            'einsatzschicht'=>$this->link('updateDpersField'),
            'regelarbeit'=>$this->link('updateDpersField'),
            'regeltrans'=>$this->link('updateDpersDetailField'),
            'cb_regeloe'=>$this->link('updateDpersField'),
	    'cb_auto_leistung_abgnr'=>$this->link('updateDpersField'),
            'dpersstatus'=>$this->link('updateDpersField'),
            'cb_alteroe'=>$this->link('updateDpersField'),
            'autoleistung'=>$this->link('updateDpersField'),
            'kor'=>$this->link('updateDpersField'),
            'premie_za_vykon'=>$this->link('updateDpersField'),
            'qpremie_akkord'=>$this->link('updateDpersField'),
            'qpremie_zeit'=>$this->link('updateDpersField'),
            'premie_za_prasnost'=>$this->link('updateDpersField'),
            'premie_za_3_mesice'=>$this->link('updateDpersField'),
            'MAStunden'=>$this->link('updateDpersField'),
            'einarb_zuschlag'=>$this->link('updateDpersField'),
            'bewertung'=>$this->link('updateDpersField'),
            'lohnfaktor'=>$this->link('updateDpersField'),
            'leistfaktor'=>$this->link('updateDpersField'),
            'anwvzkd_faktor'=>$this->link('updateDpersField'),
            'jahranspruch'=>$this->link('updateDurlaubField'),
            'rest'=>$this->link('updateDurlaubField'),
            'gekrzt'=>$this->link('updateDurlaubField'),
            'vor_persnr'=>$this->link('vorPersnr'),
            'nach_persnr'=>$this->link('nachPersnr'),
            'dpersstempel'=>$this->link('dpersStempel'),
            'vorschuss'=>$this->link('vorschuss'),
            'sonstpremie'=>$this->link('sonstpremie'),
            'dperszuschlag'=>$this->link('dperszuschlag'),
            'abmahnung'=>$this->link('abmahnung'),
            'verletzung'=>$this->link('verletzung'),
            'faehigkeiten'=>$this->link('faehigkeiten'),
            'vertrag'=>$this->link('vertrag'),
            'essen'=>$this->link('essen'),
            'transport'=>$this->link('transport'),
            'anwesenheit'=>$this->link('anwesenheit'),
        );
    }

    public function renderDefault(){

        $sec = $this->fillSecClasses('persinfo');
        $this->template->form_id = $sec['form_id'];
        $this->template->secclasses = $sec['secclasses'];
        $this->template->allowedarray = $sec['allowedarray'];
    }


    public function actionDpersStempelDeleteId($id){
        $this->getAjaxDriver()->id = $id;

        // id radku v tabulce dpersstempel je za poslednim podtrzitkem
        $dpersstempelId = intval(substr($id, strrpos($id, '_')+1));
        $this->getAjaxDriver()->dpersstempel_id = $dpersstempelId;

        $this->model->deleteDpersStempelRow($dpersstempelId);

        $this->terminate();
    }

    public function actionFaehigkeitDeleteId($id){
        $this->getAjaxDriver()->id = $id;

        // id radku v tabulce dpersstempel je za poslednim podtrzitkem
        $Id = intval(substr($id, strrpos($id, '_')+1));
        $this->getAjaxDriver()->faehigkeit_id = $Id;

        $this->model->deleteDpersFaehigkeitRow($Id);

        $this->terminate();
    }

    public function actionSchulungDeleteId($id,$dpersschulungid){
        $this->getAjaxDriver()->id = $id;
        $this->getAjaxDriver()->schulung_id = $dpersschulungid;

        $this->model->deleteDpersSchulungRow($dpersschulungid);

        $this->terminate();
    }

    public function actionFaehigkeitSchulungen($id,$schulungid,$persnr){
        $this->getAjaxDriver()->schulungid = $schulungid;
        $this->getAjaxDriver()->id = $id;
        $this->getAjaxDriver()->persnr = $persnr;

        $schulungInfo = $this->model->getSchulungInfo($schulungid);

        $divcontent = '';
        $divcontent .= "<div id='schulungen_table'>";
        $divcontent.="<table>";
        $divcontent.="<tr><th colspan='3'>".$schulungInfo['beschreibung']." ( ".$schulungInfo['lektor']." )."."</th></tr>";

        //radek pro vlozeni noveho
        $divcontent.="<tr>";
        $divcontent.="<td><input title='format tt.mm.jjjj' style='text-align: left' size='10' maxlength='10' id='schulung_datum' type='text' value='".date('d.m.Y')."' /></td>";
        $divcontent.="<td><input title='ergebniss' style='text-align: left' size='10' maxlength='50' id='schulung_ergebniss' type='text' value='' /></td>";
        $divcontent.="<td><input type='button' value='+' id='schulung_add' acturl='".$this->link('schulungAdd',array('faehigkeit_schulungen_id'=>$id,'persnr'=>$persnr,'schulungid'=>$schulungid))."' /></td>";
        $divcontent.="</tr>";
        $divcontent.="<tr><td colspan='3'><hr></td></tr>";

        $schulungenArray = $this->model->getSchulungenInfo($persnr, $schulungid);

        if($schulungenArray!=NULL){
            foreach ($schulungenArray as $schulung){
                $sid = $schulung['id'];
                $divcontent.="<tr id='schulungrow_".$schulung['id']."'>";
                    $divcontent.="<td>".$schulung['letzte_datum']."</td>";
                    $divcontent.="<td><input size='5' maxlength='64' id='schulung_ergebniss_".$schulung['id']."' type='text' value='".$schulung['ergebniss']."' acturl='".$this->link('schulungErgebnissUpdate')."' /></td>";
//                    $divcontent.="<td>".$schulung['ergebniss']."</td>";
                    $divcontent.="<td><input type='button' value='-' id='schulung_delete_".$schulung['id']."' acturl='".$this->link('schulungDeleteId',array('dpersschulungid'=>$sid))."' /></td>";
                $divcontent.="</tr>";
            }
        }
        $divcontent.="</table>";
        $divcontent .= "</div>";

        $this->getAjaxDriver()->divcontent = $divcontent;
        $this->terminate();
    }

    public function actionVertragDeleteId($id){
        $this->getAjaxDriver()->id = $id;
        $Id = intval(substr($id, strrpos($id, '_')+1));
        $this->getAjaxDriver()->vertrag_id = $Id;
        $this->model->deleteVertragRow($Id);
        $this->terminate();
    }
    
   public function actionTransportDeleteId($id){
        $this->getAjaxDriver()->id = $id;

        $transportId = intval(substr($id, strrpos($id, '_')+1));
        $this->getAjaxDriver()->transport_id = $transportId;

        $this->model->deleteTransportRow($transportId);

        $this->terminate();
    }

   public function actionAbmahnungDeleteId($id){
        $this->getAjaxDriver()->id = $id;

        $abmahnungId = intval(substr($id, strrpos($id, '_')+1));
        $this->getAjaxDriver()->abmahnung_id = $abmahnungId;

        $this->model->deleteAbmahnungRow($abmahnungId);

        $this->terminate();
    }

   public function actionVerletzungDeleteId($id){
        $this->getAjaxDriver()->id = $id;

        $verletzungId = intval(substr($id, strrpos($id, '_')+1));
        $this->getAjaxDriver()->verletzung_id = $verletzungId;

        $this->model->deleteVerletzungRow($verletzungId);

        $this->terminate();
    }
   public function actionSonstpremieDeleteId($id){
        $this->getAjaxDriver()->id = $id;

        $transportId = intval(substr($id, strrpos($id, '_')+1));
        $this->getAjaxDriver()->sonstpremie_id = $transportId;

        $this->model->deleteSonstpremieRow($transportId);

        $this->terminate();
    }

    public function actionAnwesenheitDeleteId($id){
        $this->getAjaxDriver()->id = $id;

        $transportId = intval(substr($id, strrpos($id, '_')+1));
        $this->getAjaxDriver()->dzeit_id = $transportId;

        $this->model->deleteDzeitRow($transportId);

        $this->terminate();
    }

    public function actionVorschussDeleteId($id){
        $this->getAjaxDriver()->id = $id;

        // id radku v tabulce dpersstempel je za poslednim podtrzitkem
        $vorschussId = intval(substr($id, strrpos($id, '_')+1));
        $this->getAjaxDriver()->vorschuss_id = $vorschussId;

        $this->model->deleteVorschussRow($vorschussId);

        $this->terminate();
    }

    public function actionEssenUpdate($id,$essenId,$essen){
        $this->getAjaxDriver()->id=$id;
        $this->getAjaxDriver()->essenid=$essenId;
        $this->getAjaxDriver()->essen=$essen;
        $dzeitId = intval(substr($id, strrpos($id, '_')+1));
        $this->getAjaxDriver()->dzeitid=$dzeitId;
        $ar = $this->model->updateDzeitEssen($dzeitId,$essenId,$essen);
        $this->getAjaxDriver()->affectedRows=$ar;
        $this->terminate();
    }
    public function actionTransportKfzUpdate($id,$value){
        $this->getAjaxDriver()->id=$id;
        $this->getAjaxDriver()->kfzid=$value;
        $transportId = intval(substr($id, strrpos($id, '_')+1));
        $this->getAjaxDriver()->transportid=$transportId;
        $ar = $this->model->updateTransportKfz($transportId,$value);
        $this->getAjaxDriver()->affectedRows=$ar;
        $this->terminate();
    }
    public function actionFaehigkeitTypUpdate($id,$value){
        $this->getAjaxDriver()->id=$id;
        $this->getAjaxDriver()->value=$value;
//        $ar = $this->model->updateTransportKfz($transportId,$value);
//        $this->getAjaxDriver()->affectedRows=$ar;
        $faehigkeitenArray = $this->model->getFaehigkeitInfoArray($value);
        $this->getAjaxDriver()->faehigkeitenarray=$faehigkeitenArray;
        $this->terminate();
    }

    public function actionAbmahnungGrundUpdate($id,$value){
        $this->getAjaxDriver()->id=$id;
        $this->getAjaxDriver()->grund=$value;
        $transportId = intval(substr($id, strrpos($id, '_')+1));
        $this->getAjaxDriver()->abmahnungid=$transportId;
        $ar = $this->model->updateAbmahnungGrund($transportId,$value);
        $this->getAjaxDriver()->affectedRows=$ar;
        $this->terminate();
    }

    public function actionAbmahnungReklamationUpdate($id,$value){
        $this->getAjaxDriver()->id=$id;
        $this->getAjaxDriver()->reklamation=$value;
        $transportId = intval(substr($id, strrpos($id, '_')+1));
        $this->getAjaxDriver()->abmahnungid=$transportId;
        $ar = $this->model->updateAbmahnungReklamation($transportId,$value);
        $this->getAjaxDriver()->affectedRows=$ar;
        $this->terminate();
    }

    public function actionSonstpremiePremieUpdate($id,$value){
        $this->getAjaxDriver()->id=$id;
        $this->getAjaxDriver()->premieid=$value;
        $transportId = intval(substr($id, strrpos($id, '_')+1));
        $this->getAjaxDriver()->sonstpremieid=$transportId;
        $ar = $this->model->updateSonstpremiePremie($transportId,$value);
        $this->getAjaxDriver()->affectedRows=$ar;
        $this->terminate();
    }
    public function actionAnwesenheitOEUpdate($id,$value){
        $this->getAjaxDriver()->id=$id;
        $this->getAjaxDriver()->oe=$value;
        $dzeitId = intval(substr($id, strrpos($id, '_')+1));
        $this->getAjaxDriver()->dzeitid=$dzeitId;
        $ar = $this->model->updateDzeitOE($dzeitId, $value);
        $this->getAjaxDriver()->affectedRows=$ar;
        $this->terminate();
    }
    public function actionTransportRouteUpdate($id,$value){
        $this->getAjaxDriver()->id=$id;
        $this->getAjaxDriver()->routeid=$value;
        $transportId = intval(substr($id, strrpos($id, '_')+1));
        $this->getAjaxDriver()->transportid=$transportId;
        $ar = $this->model->updateTransportRoute($transportId,$value);
        $this->getAjaxDriver()->affectedRows=$ar;
        $this->terminate();
    }

    public function actionTransportPreisUpdate($id,$value){
        $this->getAjaxDriver()->id=$id;
        $this->getAjaxDriver()->preis=floatval($value);
        $transportId = intval(substr($id, strrpos($id, '_')+1));
        $this->getAjaxDriver()->transportid=$transportId;
        $ar = $this->model->updateTransportPreis($transportId,floatval($value));
        $this->getAjaxDriver()->affectedRows=$ar;
        $this->terminate();
    }

    public function actionAbmahnungBetragUpdate($id,$value){
        $this->getAjaxDriver()->id=$id;
        $this->getAjaxDriver()->betrag=floatval($value);
        $transportId = intval(substr($id, strrpos($id, '_')+1));
        $this->getAjaxDriver()->abmahnungid=$transportId;
        $ar = $this->model->updateAbmahnungBetrag($transportId,floatval($value));
        $this->getAjaxDriver()->affectedRows=$ar;
        $this->terminate();
    }
    
    public function actionAbmahnungUpdate($id,$value){
        $this->getAjaxDriver()->id=$id;
        $this->getAjaxDriver()->value=$value;
        $transportId = intval(substr($id, strrpos($id, '_')+1));
        $this->getAjaxDriver()->abmahnungid=$transportId;
	// parse field name
	$firstUnderscorePos = strpos($id,'_');
	$lastUnderscorePos = strrpos($id, '_');
	$fieldname = substr($id, $firstUnderscorePos+1, $lastUnderscorePos-$firstUnderscorePos-1);
	$this->getAjaxDriver()->fieldname=$fieldname;
        $ar = $this->model->updateAbmahnungField($transportId,$fieldname,$value);
        $this->getAjaxDriver()->affectedRows=$ar;
        $this->terminate();
    }
    
    public function actionFaehigkeitSollIstUpdate($id,$value,$typ){
        $this->getAjaxDriver()->id=$id;
        $this->getAjaxDriver()->value=floatval($value);
        $value = floatval($value);
        $this->getAjaxDriver()->typ=$typ;
        $transportId = intval(substr($id, strrpos($id, '_')+1));
        $this->getAjaxDriver()->faehigkeitid=$transportId;
        $ar = $this->model->updateDpersFaehigkeitFieldProId($transportId, $typ, $value);
        $this->getAjaxDriver()->affectedRows=$ar;
        $this->terminate();
    }
    public function actionFaehigkeitBemerkungUpdate($id,$value){
        $this->getAjaxDriver()->id=$id;
        $this->getAjaxDriver()->value=$value;
        $transportId = intval(substr($id, strrpos($id, '_')+1));
        $this->getAjaxDriver()->faehigkeitid=$transportId;
        $ar = $this->model->updateDpersFaehigkeitFieldProId($transportId, 'bemerkung', $value);
        $this->getAjaxDriver()->affectedRows=$ar;
        $this->terminate();
    }

    public function actionSchulungErgebnissUpdate($id,$value){
        $this->getAjaxDriver()->id=$id;
        $this->getAjaxDriver()->value=$value;
        $transportId = intval(substr($id, strrpos($id, '_')+1));
        $this->getAjaxDriver()->schulungid=$transportId;
        $ar = $this->model->updateDpersSchulungFieldProId($transportId, 'ergebniss', $value);
        $this->getAjaxDriver()->affectedRows=$ar;
        $this->terminate();
    }

    public function actionAbmahnungBemerkungUpdate($id,$value){
        $this->getAjaxDriver()->id=$id;
        $this->getAjaxDriver()->bemerkung=trim($value);
        $transportId = intval(substr($id, strrpos($id, '_')+1));
        $this->getAjaxDriver()->abmahnungid=$transportId;
        $ar = $this->model->updateAbmahnungBemerkung($transportId,trim($value));
        $this->getAjaxDriver()->affectedRows=$ar;
        $this->terminate();
    }

    public function actionAbmahnungBetragDatumUpdate($id,$value){
        $this->getAjaxDriver()->id=$id;
        $betrDatum = Utility::make_DB_datum(Utility::validateDatum($value));
        $this->getAjaxDriver()->betrdatum=trim($value);
        $transportId = intval(substr($id, strrpos($id, '_')+1));
        $this->getAjaxDriver()->abmahnungid=$transportId;
        $ar = $this->model->updateAbmahnungBetragDatum($transportId,$betrDatum);
        $this->getAjaxDriver()->affectedRows=$ar;
        $this->terminate();
    }

    /**
     * 
     */
    public function actionDperszuschlagUpdate($id,$persnr,$value){
        $this->getAjaxDriver()->id=$id;
        $this->getAjaxDriver()->persnr=$persnr;
        $this->getAjaxDriver()->value=$value;
        $pozicePoslednihoPodtrzitka = strrpos($id, '_');
        $statnr = substr($id, 3, $pozicePoslednihoPodtrzitka-3);
        $datum = substr($id,$pozicePoslednihoPodtrzitka+1);
        $this->getAjaxDriver()->statnr=$statnr;
        $this->getAjaxDriver()->datum=$datum;
        $ar = $this->model->updateDpersZuschlag($persnr,$datum,$statnr,floatval($value));
        $this->getAjaxDriver()->affectedRows=$ar;
        $this->terminate();
    }

    public function actionSonstpremieBetragUpdate($id,$value){
        $this->getAjaxDriver()->id=$id;
        $this->getAjaxDriver()->betrag=floatval($value);
        $transportId = intval(substr($id, strrpos($id, '_')+1));
        $this->getAjaxDriver()->sonstpremieid=$transportId;
        $ar = $this->model->updateSonstpremieBetrag($transportId,floatval($value));
        $this->getAjaxDriver()->affectedRows=$ar;
        $this->terminate();
    }

    public function actionVorschussAdd($id,$persnr,$vorschuss,$datum){
        $this->getAjaxDriver()->id = $id;
        $this->getAjaxDriver()->persnr = $persnr;
        $this->getAjaxDriver()->vorschuss = $vorschuss;
        $this->getAjaxDriver()->datum = $datum;

        $insertedID = 0;

        $dbDatum = Utility::validateDatum($datum);
        if($dbDatum!=NULL){
            $dbDatum = Utility::make_DB_datum($dbDatum);
            $vorschuss = floatval($vorschuss);
            $insertedID = $this->model->addVorschussRow($persnr, $vorschuss, $dbDatum);
        }

        $this->getAjaxDriver()->insertedID = $insertedID;
        $this->terminate();
    }

public function actionTransportAdd($id,$persnr,$datum,$kfz_id,$route_id=1,$preis=0,$jahr=0,$monat=0,$zurueck=0) {
    $this->getAjaxDriver()->id=$id;
    $this->getAjaxDriver()->persnr=$persnr;
    $this->getAjaxDriver()->datum=$datum;
    $this->getAjaxDriver()->kfz_id=$kfz_id;
    $this->getAjaxDriver()->route_id=$route_id;
    $this->getAjaxDriver()->preis=$preis;

    $insertedID = 0;

    $dbDatum = Utility::validateDatum($datum);
    if($dbDatum!=NULL) {
        $dbDatum = Utility::make_DB_datum($dbDatum);
        $preis = floatval($preis);
        $insertedID = $this->model->addTransportRow($persnr,$dbDatum,$kfz_id,$route_id,$preis);
        // jeste jizda zpet
        if($zurueck!=0)
            $insertedID = $this->model->addTransportRow($persnr,$dbDatum,$kfz_id,$route_id,$preis);
    }

    $this->getAjaxDriver()->insertedID = $insertedID;

    $this->actionTransport($id, $persnr, $jahr, $monat,$kfz_id);

    $this->terminate();
}


public function actionSonstpremieAdd($id,$persnr,$datum,$premie_id,$betrag=0,$jahr=0,$monat=0) {
    $this->getAjaxDriver()->id=$id;
    $this->getAjaxDriver()->persnr=$persnr;
    $this->getAjaxDriver()->datum=$datum;
    $this->getAjaxDriver()->premie_id=$premie_id;
    $this->getAjaxDriver()->betrag=$betrag;

    $insertedID = 0;

    //$this->terminate();
    
    $dbDatum = Utility::validateDatum($datum);
    if($dbDatum!=NULL) {
        $dbDatum = Utility::make_DB_datum($dbDatum);
        $betrag = floatval($betrag);
        $insertedID = $this->model->addSonstpremieRow($persnr,$dbDatum,$premie_id,$betrag);
    }

    $this->getAjaxDriver()->insertedID = $insertedID;

    $this->actionSonstpremie($id, $persnr, $jahr, $monat, $premie_id);

    $this->terminate();
}

public function actionAbmahnungAdd($id,$persnr,$datum,$grund,$vorschlag_von,$vorschlag_bemerkung,$vorschlag_betrag=0,$vorschlag=1,$reklamation=0,$betrag=0,$datumBetrag=NULL,$bemerkung='',$jahr=0,$monat=0) {
    $this->getAjaxDriver()->id=$id;
    $this->getAjaxDriver()->persnr=$persnr;
    $this->getAjaxDriver()->datum=$datum;
    $this->getAjaxDriver()->grund=$grund;
    $this->getAjaxDriver()->reklamation=$reklamation;
    $this->getAjaxDriver()->betrag=$betrag;
    $this->getAjaxDriver()->betragDatum=$datumBetrag;
    $this->getAjaxDriver()->bemerkung=$bemerkung;
    $this->getAjaxDriver()->vorschlag=$vorschlag;
    $this->getAjaxDriver()->vorschlag_von=$vorschlag_von;
    $this->getAjaxDriver()->vorschlag_betrag=$vorschlag_betrag;
    $this->getAjaxDriver()->vorschlag_bemerkung=$vorschlag_bemerkung;

    $insertedID = 0;

    //$this->terminate();

    $dbDatum = Utility::validateDatum($datum);
    $dbDatumBetrag = Utility::validateDatum($datumBetrag);

    if($dbDatum!=NULL) {
        $dbDatum = Utility::make_DB_datum($dbDatum);
        if($dbDatumBetrag!=NULL)
            $dbDatumBetrag = Utility::make_DB_datum($dbDatumBetrag);
        $betrag = floatval($betrag);
        $insertedID = $this->model->addAbmahnungRow($persnr,$dbDatum,$grund,$betrag,$dbDatumBetrag,$bemerkung,$reklamation,$vorschlag,$vorschlag_von,$vorschlag_betrag,$vorschlag_bemerkung);
    }

    $this->getAjaxDriver()->insertedID = $insertedID;

    $this->actionAbmahnung($id, $persnr, $jahr, $monat, $grund);

    $this->terminate();
}

public function actionVerletzungAdd($id,$persnr,$datum,$grund,$jahr=0,$monat=0) {
    $this->getAjaxDriver()->id=$id;
    $this->getAjaxDriver()->persnr=$persnr;
    $this->getAjaxDriver()->datum=$datum;
    $this->getAjaxDriver()->grund=$grund;

    $insertedID = 0;

    //$this->terminate();

    $dbDatum = Utility::validateDatum($datum);

    if($dbDatum!=NULL) {
        $dbDatum = Utility::make_DB_datum($dbDatum);
        $insertedID = $this->model->addVerletzungRow($persnr,$dbDatum,$grund);
    }

    $this->getAjaxDriver()->insertedID = $insertedID;

    $this->actionVerletzung($id, $persnr, $jahr, $monat, $grund);

    $this->terminate();
}
     public function actionDpersStempelAdd($id,$persnr,$oe,$qpraemie_prozent,$stempel_id,$datum_von){
        $this->getAjaxDriver()->id = $id;
        $this->getAjaxDriver()->persnr = $persnr;
        $this->getAjaxDriver()->oe = $oe;
        $this->getAjaxDriver()->qpraemie_prozent = $qpraemie_prozent;
        $this->getAjaxDriver()->stempel_id = $stempel_id;
        $this->getAjaxDriver()->datum_von = $datum_von;

        $insertedID = 0;

        $dbDatumVon = Utility::validateDatum($datum_von);
        if($dbDatumVon!=NULL){
            $dbDatumVon = Utility::make_DB_datum($dbDatumVon);
            $qpraemie_prozent = floatval($qpraemie_prozent);
            $insertedID = $this->model->addDpersStempelRow($persnr,$oe,$qpraemie_prozent,$stempel_id,$dbDatumVon);
        }

        $this->getAjaxDriver()->insertedID = $insertedID;
        $this->terminate();
    }

    public function actionVertragUpdate($id,$value){
        $this->getAjaxDriver()->id = $id;
        $this->getAjaxDriver()->value = $value;

        $dbFieldArray = array(
                'eintritt'=>'eintritt',
                'austritt'=>'austritt',
                'befristet'=>'befristet',
                'probezeit'=>'probezeit',
                'regelstunden'=>'regelarbzeit',
                'vertraganfang'=>'vertrag_anfang',
		'vertragtypid'=>'vertragtyp_id',
                );

        $idVertrag = substr($id, strrpos($id, '_')+1);
        $prvniPodtrzitkoOdzadu = strrpos($id, '_');

        $druhePodtrzitkoOdzadu = strrpos($id, '_',-(strlen($id)-$prvniPodtrzitkoOdzadu+1));
        $this->getAjaxDriver()->ppoz = $prvniPodtrzitkoOdzadu;
        $this->getAjaxDriver()->dpoz = $druhePodtrzitkoOdzadu;
        $dbFielIndex = substr($id, $druhePodtrzitkoOdzadu+1,$prvniPodtrzitkoOdzadu-$druhePodtrzitkoOdzadu-1);
        //$dbFielIndex = substr($id, strpos($id, 'i_')+2, strrpos($id, '_')-strpos($id, 'i_')-2);
        $dbField = $dbFieldArray[$dbFielIndex];
        $this->getAjaxDriver()->id_vertrag = $idVertrag;
        $this->getAjaxDriver()->dbfieldindex = $dbFielIndex;
        $this->getAjaxDriver()->dbfield = $dbField;

        $dbValue = $value;
        $validatetValue = $value;

        if($dbField=='eintritt' || $dbField=='austritt' || $dbField=='befristet' || $dbField=='probezeit'){
            $dbValue = strlen(trim($value))==0?NULL:Utility::make_DB_datum(Utility::validateDatum($value));
            $validatetValue = strlen(trim($value))==0?NULL:Utility::validateDatum($value);
        }
        if($dbField=='regelarbzeit'){
            $dbValue = strlen(trim($value))==0?0:floatval($value);
            $validatetValue = $dbValue;
        }
        $this->getAjaxDriver()->dbvalue = $dbValue;
        $this->getAjaxDriver()->validvalue = $validatetValue;

        $ar = $this->model->updateVertrag($idVertrag,$dbField,$dbValue);
        $this->getAjaxDriver()->ar = $ar;

        $this->model->refreshDpersDatumsFromVertrag(NULL, $idVertrag);

        $this->terminate();
    }
    
    
    public function actionVertragAdd($id,$persnr,$eintritt,$austritt,$probezeit,$befristet,$regelstunden,$vertrag_anfang,$verlang,$vertragtypid){
        $this->getAjaxDriver()->id = $id;
        $this->getAjaxDriver()->persnr = $persnr;

        $insertedID = 0;

        $eintritt = strlen(trim($eintritt))>0?Utility::make_DB_datum(Utility::validateDatum($eintritt)):NULL;
        $austritt = strlen(trim($austritt))>0?Utility::make_DB_datum(Utility::validateDatum($austritt)):NULL;
        $probezeit = strlen(trim($probezeit))>0?Utility::make_DB_datum(Utility::validateDatum($probezeit)):NULL;
        $befristet = strlen(trim($befristet))>0?Utility::make_DB_datum(Utility::validateDatum($befristet)):NULL;
        $regelstunden = floatval($regelstunden);

        $this->getAjaxDriver()->eintritt = $eintritt;
        $this->getAjaxDriver()->austritt = $austritt;
        $this->getAjaxDriver()->probezeit = $probezeit;
        $this->getAjaxDriver()->befristet = $befristet;
        $this->getAjaxDriver()->regelstunden = $regelstunden;
        $this->getAjaxDriver()->vertrag_anfang = $vertrag_anfang;
        $this->getAjaxDriver()->verlang = $verlang;
	$this->getAjaxDriver()->vertragtypid = $vertragtypid;

	
        $bDpersDatumsRefresh = FALSE;
        if($eintritt!==NULL){
            $insertedID = $this->model->addDpersVertragRow($persnr, $eintritt,$austritt,$probezeit,$befristet,$regelstunden,$vertrag_anfang,$verlang,$vertragtypid);
            // aktualizuju hodnoty v tabulce dpers a dpersdetail v zavislosti na vlozenem radku
            $bDpersDatumsRefresh = $this->model->refreshDpersDatumsFromVertrag($persnr,$insertedID);
            $this->actionVertrag($id, $persnr);
        }
        $this->getAjaxDriver()->insertedID = $insertedID;
        $this->getAjaxDriver()->bDpersDatumsRefresh = $bDpersDatumsRefresh;
        $this->terminate();
    }

    public function actionFaehigkeitAdd($id,$persnr,$faehigkeit_faehigkeittyp_id,$faehigkeit_id,$soll,$ist,$bemerkung){
        $this->getAjaxDriver()->id = $id;
        $this->getAjaxDriver()->persnr = $persnr;
        $this->getAjaxDriver()->soll = $soll;
        $this->getAjaxDriver()->ist = $ist;
        $this->getAjaxDriver()->faehigkeit_id = $faehigkeit_id;
        $this->getAjaxDriver()->faehigkeit_faehigkeittyp_id = $faehigkeit_faehigkeittyp_id;
        $this->getAjaxDriver()->bemerkung = $bemerkung;
        
        $insertedID = 0;

        $insertedID = $this->model->addDpersFaehigkeitRow($persnr, $faehigkeit_id, $soll, $ist, $bemerkung);
        $this->getAjaxDriver()->insertedID = $insertedID;
        $this->actionFaehigkeiten($id, $persnr,$faehigkeit_faehigkeittyp_id,$faehigkeit_id);
        $this->terminate();
    }

    public function actionSchulungAdd($persnr,$schulungid,$schulung_datum,$schulung_ergebniss,$id,$faehigkeit_schulungen_id){
        $this->getAjaxDriver()->id = $id;
        $this->getAjaxDriver()->persnr = $persnr;
        $this->getAjaxDriver()->schulungid = $schulungid;
        $dbDatum = Utility::make_DB_datum(Utility::validateDatum($schulung_datum));
        $this->getAjaxDriver()->schulung_datum = $dbDatum;
        $this->getAjaxDriver()->schulung_ergebniss = $schulung_ergebniss;
        $this->getAjaxDriver()->faehigkeit_schulungen_id = $faehigkeit_schulungen_id;

        $insertedID = 0;
        $insertedID = $this->model->addDpersSchulungRow($persnr, $schulungid, $dbDatum,$schulung_ergebniss);
        $this->getAjaxDriver()->insertedID = $insertedID;
        $this->actionFaehigkeitSchulungen($faehigkeit_schulungen_id, $schulungid,$persnr);
        $this->terminate();
    }

    public function actionDpersStempel($id,$persnr){
        $this->getAjaxDriver()->id = $id;
        $this->getAjaxDriver()->persnr = $persnr;
        $dpersStempelArray = $this->model->getDpersStempelArray($persnr);
        $this->getAjaxDriver()->stempelarray = $dpersStempelArray;
        $divcontent = '';
        $divcontent .= "<div id='dpersstempel_table'>";
        $divcontent.="<table>";
        $divcontent.="<tr><th>OE</th><th>QPraemie[%]</th><th>StempelID</th><th>Datum von</th>";

            //radek pro vlozeni noveho razitka
            $divcontent.="<tr>";
            $divcontent.="<td>";
            $oeselect = "<select id='dpersstempel_oe'>";
            $oes = $this->model->getOEInfo();
            $keys = Utility::getArrayWithKey('tat', $oes);
            foreach ($keys as $key){
                if($key=='GF51')
                    $oeselect.="<option selected='selected' value='$key'>$key</option>";
                else
                    $oeselect.="<option value='$key'>$key</option>";
            }
            $oeselect.= "</select>";
            $divcontent.=$oeselect;
            $divcontent.="</td>";

            $divcontent.="<td><input type='text' size='3' maxlength='5' id='dpersstempel_qpraemie_prozent' value='25' /></td>";
            $divcontent.="<td><input type='text' size='3' maxlength='5' id='dpersstempel_stempel_id' value='' /></td>";
            $divcontent.="<td><input type='text' size='10' maxlength='10' id='dpersstempel_datum_von' value='".date('d.m.Y')."' /></td>";
            $divcontent.="<td><input type='button' value='+' id='dpersstempel_add' acturl='".$this->link('dpersStempelAdd')."' /></td>";
            $divcontent.="</tr>";


        if($dpersStempelArray!=NULL){
            foreach ($dpersStempelArray as $stempelrow){
                $divcontent.="<tr id='dpersstempelrow_".$stempelrow['id']."'>";
                    $divcontent.="<td>".$stempelrow['oe']."</td>";
                    $divcontent.="<td>".$stempelrow['qpraemie_prozent']."</td>";
                    $divcontent.="<td>".$stempelrow['stempel_id']."</td>";
                    $divcontent.="<td>".$stempelrow['datum_von']."</td>";
                    $divcontent.="<td><input type='button' value='-' id='dpersstempel_delete_".$stempelrow['id']."' acturl='".$this->link('dpersStempelDeleteId')."' /></td>";
                $divcontent.="</tr>";
            }
            
        }
        $divcontent.="</table>";
        $divcontent.="<a href='' id='dpersstempel_table_close'>schliessen</a>";
        $divcontent .= "</div>";

        $this->getAjaxDriver()->divcontent = $divcontent;
        $this->terminate();
    }

        public function actionVorschuss($id,$persnr){
        $this->getAjaxDriver()->id = $id;
        $this->getAjaxDriver()->persnr = $persnr;
        $vorschussArray = $this->model->getVorschussArray($persnr);
        $this->getAjaxDriver()->vorschussarray = $vorschussArray;
        $divcontent = '';
        $divcontent .= "<div id='vorschuss_table'>";
        $divcontent.="<table>";
        $divcontent.="<tr><th>Datum</th><th>Vorschuss</th>";

            //radek pro vlozeni noveho
            $divcontent.="<tr>";
            $divcontent.="<td><input type='text' size='10' maxlength='10' id='vorschuss_datum' value='".date('d.m.Y')."' /></td>";
            $divcontent.="<td><input type='text' size='6' maxlength='' id='vorschuss_vorschuss' value='0' /></td>";

            $divcontent.="<td><input type='button' value='+' id='vorschuss_add' acturl='".$this->link('vorschussAdd')."' /></td>";
            $divcontent.="</tr>";


        if($vorschussArray!=NULL){
            foreach ($vorschussArray as $vorschuss){
                $divcontent.="<tr id='vorschussrow_".$vorschuss['id']."'>";
                    $divcontent.="<td>".$vorschuss['datum']."</td>";
                    $divcontent.="<td>".$vorschuss['vorschuss']."</td>";
                    $divcontent.="<td><input type='button' value='-' id='vorschuss_delete_".$vorschuss['id']."' acturl='".$this->link('vorschussDeleteId')."' /></td>";
                $divcontent.="</tr>";
            }

        }
        $divcontent.="</table>";
        $divcontent.="<a href='' id='vorschuss_table_close'>schliessen</a>";
        $divcontent .= "</div>";

        $this->getAjaxDriver()->divcontent = $divcontent;
        $this->terminate();
    }

public function actionEssenZeitraumSet($id,$persnr,$value,$jahr,$monat) {
    $this->getAjaxDriver()->id = $id;
    $this->getAjaxDriver()->persnr = $persnr;
    $this->getAjaxDriver()->value = $value;
    $this->getAjaxDriver()->jahr = $jahr;
    $this->getAjaxDriver()->monat = $monat;

    $this->actionEssen($id, $persnr, $jahr, $monat);

    $this->terminate();
}

public function actionTransportZeitraumSet($id,$persnr,$value,$jahr,$monat) {
    $this->getAjaxDriver()->id = $id;
    $this->getAjaxDriver()->persnr = $persnr;
    $this->getAjaxDriver()->value = $value;
    $this->getAjaxDriver()->jahr = $jahr;
    $this->getAjaxDriver()->monat = $monat;

    $this->actionTransport($id, $persnr, $jahr, $monat);

    $this->terminate();
}

public function actionSonstpremieZeitraumSet($id,$persnr,$value,$jahr,$monat) {
    $this->getAjaxDriver()->id = $id;
    $this->getAjaxDriver()->persnr = $persnr;
    $this->getAjaxDriver()->value = $value;
    $this->getAjaxDriver()->jahr = $jahr;
    $this->getAjaxDriver()->monat = $monat;

    $this->actionSonstpremie($id, $persnr, $jahr, $monat);

    $this->terminate();
}

public function actionAnwesenheitZeitraumSet($id,$persnr,$value,$jahr,$monat) {
    $this->getAjaxDriver()->id = $id;
    $this->getAjaxDriver()->persnr = $persnr;
    $this->getAjaxDriver()->value = $value;
    $this->getAjaxDriver()->jahr = $jahr;
    $this->getAjaxDriver()->monat = $monat;

    $this->actionAnwesenheit($id, $persnr, $jahr, $monat);

    $this->terminate();
}

        public function actionEssen($id,$persnr,$jahr=NULL,$monat=NULL){
        $this->getAjaxDriver()->id = $id;
        $this->getAjaxDriver()->persnr = $persnr;

        if($jahr==NULL || $monat==NULL) {
            $aktualMonth = date('m');
            $aktualJahr = date('Y');
            $von = sprintf("%04d-%02d-%02d",$aktualJahr,$aktualMonth,1);
            $bis = sprintf("%04d-%02d-%02d",$aktualJahr,$aktualMonth,cal_days_in_month(CAL_GREGORIAN, $aktualMonth, $aktualJahr));
        }
        else {
            $aktualMonth = $monat;
            $aktualJahr = $jahr;
            $von = sprintf("%04d-%02d-%02d",$aktualJahr,$aktualMonth,1);
            $bis = sprintf("%04d-%02d-%02d",$aktualJahr,$aktualMonth,cal_days_in_month(CAL_GREGORIAN, $aktualMonth, $aktualJahr));
        }

        $this->getAjaxDriver()->jahr = $aktualJahr;
        $this->getAjaxDriver()->monat = $aktualMonth;

        $essenArray = $this->model->getEssenArray($persnr,$von,$bis);
        $this->getAjaxDriver()->essenarray = $essenArray;
        $divcontent = '';
        $divcontent .= "<div id='essen_table'>";
        $divcontent .="<div id='essen_zeitraum'>";
        $divcontent .="Jahr <input type='text' id='essen_zeitraum_jahr' size='4' maxlength='4' acturl='".$this->link('essenZeitraumSet')."' value='".$aktualJahr."' />";
        $divcontent .="&nbsp;Monat <input type='text' id='essen_zeitraum_monat' size='2' maxlength='2' acturl='".$this->link('essenZeitraumSet')."' value='".$aktualMonth."' />";
        $divcontent .="</div>";
        $divcontent.="<table>";
        $divcontent.="<tr><th>Datum</th><th>Essen</th><th>Ja/Nein</th>";

//        Debug::dump($essenArray);
        if($essenArray!=NULL){
            foreach ($essenArray as $essen){
                $divcontent.="<tr id='essenrow_".$essen['id']."'>";
                    $divcontent.="<td>".$essen['datum']."</td>";

                    $essenSelect = "<select id='essen_id_".$essen['id']."' acturl='".$this->link('essenUpdate')."'>";
                    $essenInfoArray = $this->model->getEssenInfoArray();
                    $flag_noselected = TRUE;
                    foreach ($essenInfoArray as $essenInfo){

//                        echo "essenInfo=".$essenInfo['essen_kz']." essen=".$essen['essen_kz']."<br>";

                        if(!strcmp($essenInfo['essen_kz'],$essen['essen_kz'])){
                            $essenSelect.="<option selected='selected' value='".$essenInfo['id']."'>".$essenInfo['essen_kz']."</option>";
                            $flag_noselected = FALSE;
                        }
                        else{
                            if($essenInfo['essen_kz']=='CEL' && $flag_noselected)
                                $essenSelect.="<option selected='selected' value='".$essenInfo['id']."'>".$essenInfo['essen_kz']."</option>";
                            else
                                $essenSelect.="<option value='".$essenInfo['id']."'>".$essenInfo['essen_kz']."</option>";
                        }
                    }
                    $essenSelect.= "</select>";

                    $divcontent.="<td>".$essenSelect."</td>";
                    $checkedEssen = $essen['essen']==0?'':"checked='checked'";
                    $divcontent.="<td><input type='checkbox' value='' $checkedEssen acturl='".$this->link('essenUpdate')."' /></td>";
                $divcontent.="</tr>";
            }
        }
        $divcontent.="</table>";
        $divcontent.="<a href='' id='essen_table_close'>schliessen</a>";
        $divcontent .= "</div>";

        $this->getAjaxDriver()->divcontent = $divcontent;
        $this->terminate();
    }

    /**
     *
     * @param <type> $id
     * @param <type> $persnr
     * @param <type> $jahr
     * @param <type> $monat
     */
        public function actionTransport($id,$persnr,$jahr=NULL,$monat=NULL,$kfzid=0){
        $this->getAjaxDriver()->id = $id;
        $this->getAjaxDriver()->persnr = $persnr;

        if($jahr==NULL || $monat==NULL) {
            $aktualMonth = date('m');
            $aktualJahr = date('Y');
            $von = sprintf("%04d-%02d-%02d",$aktualJahr,$aktualMonth,1);
            $bis = sprintf("%04d-%02d-%02d",$aktualJahr,$aktualMonth,cal_days_in_month(CAL_GREGORIAN, $aktualMonth, $aktualJahr));
        }
        else {
            $aktualMonth = $monat;
            $aktualJahr = $jahr;
            $von = sprintf("%04d-%02d-%02d",$aktualJahr,$aktualMonth,1);
            $bis = sprintf("%04d-%02d-%02d",$aktualJahr,$aktualMonth,cal_days_in_month(CAL_GREGORIAN, $aktualMonth, $aktualJahr));
        }

        $this->getAjaxDriver()->jahr = $aktualJahr;
        $this->getAjaxDriver()->monat = $aktualMonth;

        $transportArray = $this->model->getTransportArray($persnr,$von,$bis);
        $this->getAjaxDriver()->transportarray = $transportArray;

        $regeltransportPreis = $this->model->getRegelTransportPreis($persnr);

        $divcontent = '';
        $divcontent .= "<div id='transport_table'>";
        $divcontent .="<div id='transport_zeitraum'>";
        $divcontent .="Jahr <input type='text' id='transport_zeitraum_jahr' size='4' maxlength='4' acturl='".$this->link('transportZeitraumSet')."' value='".$aktualJahr."' />";
        $divcontent .="&nbsp;Monat <input type='text' id='transport_zeitraum_monat' size='2' maxlength='2' acturl='".$this->link('transportZeitraumSet')."' value='".$aktualMonth."' />";
        $divcontent .="</div>";
        $divcontent.="<table>";
        $divcontent.="<tr><th>Datum</th><th>KFZ</th><th>Preis</th>";

        //radek pro vlozeni noveho
        $divcontent.="<tr>";
        $divcontent.="<td><input type='text' size='10' maxlength='10' id='transport_datum' value='".date('d.m.Y')."' /></td>";
        $kfzSelect = "<select id='transport_kfz_id'>";
        $kfzInfoArray = $this->model->getKfzInfoArray();
        foreach ($kfzInfoArray as $kfzInfo){
            if($kfzInfo['id']==$kfzid)
                $kfzSelect.="<option selected='selected' value='".$kfzInfo['id']."'>".$kfzInfo['fahrzeug']."</option>";
            else
                $kfzSelect.="<option value='".$kfzInfo['id']."'>".$kfzInfo['fahrzeug']."</option>";
        }
        $kfzSelect.= "</select>";
        $divcontent.="<td>".$kfzSelect."</td>";

//        $routeSelect = "<select id='transport_route_id'>";
//        $routeInfoArray = $this->model->getRouteInfoArray();
//        foreach ($routeInfoArray as $routeInfo){
//            if($routeInfo['id']=='1')
//                $routeSelect.="<option selected='selected' value='".$routeInfo['id']."'>".$routeInfo['name']."</option>";
//            else
//                $routeSelect.="<option value='".$routeInfo['id']."'>".$routeInfo['name']."</option>";
//        }
//        $routeSelect.= "</select>";
//        $divcontent.="<td>".$routeSelect."</td>";
        
        $divcontent.="<td><input id='transport_preis' type='text' value='$regeltransportPreis' size='3' maxlength='5' /></td>";
        $divcontent.="<td><input id='transport_zurueck' type='checkbox' checked='checked'/>2x</td>";
        $divcontent.="<td><input type='button' value='+' id='transport_add' acturl='".$this->link('transportAdd')."' /></td>";
        $divcontent.="</tr>";

        //----------------------------------------------------------------------------------------------------------------------
//        Debug::dump($essenArray);
        if($transportArray!=NULL){
            foreach ($transportArray as $transport){
                $divcontent.="<tr id='transportrow_".$transport['id']."'>";
                    $divcontent.="<td>".$transport['datum']."</td>";

                    $kfzSelect = "<select id='transport_kfz_id_".$transport['id']."' acturl='".$this->link('transportKfzUpdate')."'>";
                    $kfzInfoArray = $this->model->getKfzInfoArray();
                    $flag_noselected = TRUE;
                    foreach ($kfzInfoArray as $kfzInfo){

                        if(!strcmp($kfzInfo['id'],$transport['kfz_id'])){
                            $kfzSelect.="<option selected='selected' value='".$kfzInfo['id']."'>".$kfzInfo['fahrzeug']."</option>";
                            $flag_noselected = FALSE;
                        }
                        else{
                            if($kfzInfo['id']=='1' && $flag_noselected)
                                $kfzSelect.="<option selected='selected' value='".$kfzInfo['id']."'>".$kfzInfo['fahrzeug']."</option>";
                            else
                                $kfzSelect.="<option value='".$kfzInfo['id']."'>".$kfzInfo['fahrzeug']."</option>";
                        }
                    }
                    $kfzSelect.= "</select>";

                    $divcontent.="<td>".$kfzSelect."</td>";
//
//                    $routeSelect = "<select id='transport_route_id_".$transport['id']."' acturl='".$this->link('transportRouteUpdate')."'>";
//                    $routeInfoArray = $this->model->getRouteInfoArray();
//                    $flag_noselected = TRUE;
//                    foreach ($routeInfoArray as $routeInfo){
//
//                        if(!strcmp($routeInfo['id'],$transport['route_id'])){
//                            $routeSelect.="<option selected='selected' value='".$routeInfo['id']."'>".$routeInfo['name']."</option>";
//                            $flag_noselected = FALSE;
//                        }
//                        else{
//                            if($routeInfo['id']=='1' && $flag_noselected)
//                                $routeSelect.="<option selected='selected' value='".$routeInfo['id']."'>".$routeInfo['name']."</option>";
//                            else
//                                $routeSelect.="<option value='".$routeInfo['id']."'>".$routeInfo['name']."</option>";
//                        }
//                    }
//                    $routeSelect.= "</select>";
//
//                    $divcontent.="<td>".$routeSelect."</td>";

                    $divcontent.="<td><input size='3' maxlength='5' id='transport_preis_".$transport['id']."' type='text' value='".$transport['preis']."' acturl='".$this->link('transportPreisUpdate')."' /></td>";
                    $divcontent.="<td><input type='button' value='-' id='transport_delete_".$transport['id']."' acturl='".$this->link('transportDeleteId')."' /></td>";
                $divcontent.="</tr>";
            }
        }
        $divcontent.="</table>";
        $divcontent.="<a href='' id='transport_table_close'>schliessen</a>";
        $divcontent .= "</div>";

        $this->getAjaxDriver()->divcontent = $divcontent;
        $this->terminate();
    }

    /**
     *
     * @param <type> $id
     * @param <type> $persnr
     * @param <type> $jahr
     * @param <type> $monat
     */
        public function actionSonstpremie($id,$persnr,$jahr=NULL,$monat=NULL,$premieid=0){
        $this->getAjaxDriver()->id = $id;
        $this->getAjaxDriver()->persnr = $persnr;

        if($jahr==NULL || $monat==NULL) {
            $aktualMonth = date('m');
            $aktualJahr = date('Y');
            $von = sprintf("%04d-%02d-%02d",$aktualJahr,$aktualMonth,1);
            $bis = sprintf("%04d-%02d-%02d",$aktualJahr,$aktualMonth,cal_days_in_month(CAL_GREGORIAN, $aktualMonth, $aktualJahr));
        }
        else {
            $aktualMonth = $monat;
            $aktualJahr = $jahr;
            $von = sprintf("%04d-%02d-%02d",$aktualJahr,$aktualMonth,1);
            $bis = sprintf("%04d-%02d-%02d",$aktualJahr,$aktualMonth,cal_days_in_month(CAL_GREGORIAN, $aktualMonth, $aktualJahr));
        }

        $this->getAjaxDriver()->jahr = $aktualJahr;
        $this->getAjaxDriver()->monat = $aktualMonth;

        $premienArray = $this->model->getPremienArray($persnr,$von,$bis);
        $this->getAjaxDriver()->premienarray = $premienArray;

        $divcontent = '';
        $divcontent .= "<div id='sonstpremie_table'>";
        $divcontent .="<div id='sonstpremie_zeitraum'>";
        $divcontent .="Jahr <input type='text' id='sonstpremie_zeitraum_jahr' size='4' maxlength='4' acturl='".$this->link('sonstpremieZeitraumSet')."' value='".$aktualJahr."' />";
        $divcontent .="&nbsp;Monat <input type='text' id='sonstpremie_zeitraum_monat' size='2' maxlength='2' acturl='".$this->link('sonstpremieZeitraumSet')."' value='".$aktualMonth."' />";
        $divcontent .="</div>";
        $divcontent.="<table>";
        $divcontent.="<tr><th>Datum</th><th>Praemie</th><th>Betrag</th>";

        //radek pro vlozeni noveho
        $divcontent.="<tr>";
        $divcontent.="<td><input type='text' size='10' maxlength='10' id='sonstpremie_datum' value='".date('d.m.Y')."' /></td>";
        $kfzSelect = "<select id='sonstpremie_premie_id'>";
        $kfzInfoArray = $this->model->getPremieInfoArray();
        foreach ($kfzInfoArray as $kfzInfo){
            if($kfzInfo['id']==$premieid)
                $kfzSelect.="<option selected='selected' value='".$kfzInfo['id']."'>".$kfzInfo['beschreibung']."</option>";
            else
                $kfzSelect.="<option value='".$kfzInfo['id']."'>".$kfzInfo['beschreibung']."</option>";
        }
        $kfzSelect.= "</select>";
        $divcontent.="<td>".$kfzSelect."</td>";


        $divcontent.="<td><input id='sonstpremie_betrag' type='text' value='0' size='3' maxlength='5' /></td>";
        $divcontent.="<td><input type='button' value='+' id='sonstpremie_add' acturl='".$this->link('sonstpremieAdd')."' /></td>";
        $divcontent.="</tr>";

        //----------------------------------------------------------------------------------------------------------------------
        if($premienArray!=NULL){
            foreach ($premienArray as $transport){
                $divcontent.="<tr id='sonstpremierow_".$transport['id']."'>";
                    $divcontent.="<td>".$transport['datum']."</td>";

                    $kfzSelect = "<select id='sonstpremie_premie_id_".$transport['id']."' acturl='".$this->link('sonstpremiePremieUpdate')."'>";
                    $kfzInfoArray = $this->model->getPremieInfoArray();
                    $flag_noselected = TRUE;
                    foreach ($kfzInfoArray as $kfzInfo){

                        if($kfzInfo['id']==$transport['id_premie']){
                            $kfzSelect.="<option selected='selected' value='".$kfzInfo['id']."'>".$kfzInfo['beschreibung']."</option>";
                            $flag_noselected = FALSE;
                        }
                        else{
                            if($kfzInfo['id']=='1' && $flag_noselected)
                                $kfzSelect.="<option selected='selected' value='".$kfzInfo['id']."'>".$kfzInfo['beschreibung']."</option>";
                            else
                                $kfzSelect.="<option value='".$kfzInfo['id']."'>".$kfzInfo['beschreibung']."</option>";
                        }
                    }
                    $kfzSelect.= "</select>";

                    $divcontent.="<td>".$kfzSelect."</td>";
                    $divcontent.="<td><input size='3' maxlength='5' id='sonstpremie_betrag_".$transport['id']."' type='text' value='".$transport['betrag']."' acturl='".$this->link('sonstpremieBetragUpdate')."' /></td>";
                    $divcontent.="<td><input type='button' value='-' id='sonstpremie_delete_".$transport['id']."' acturl='".$this->link('sonstpremieDeleteId')."' /></td>";
                $divcontent.="</tr>";
            }
        }
        $divcontent.="</table>";
        $divcontent .= "</div>";

        $this->getAjaxDriver()->divcontent = $divcontent;
        $this->terminate();
    }

    /**
     *
     * @param <type> $id
     * @param <type> $persnr
     */
    public function actionDperszuschlag($id, $persnr) {
        $this->getAjaxDriver()->id = $id;
        $this->getAjaxDriver()->persnr = $persnr;

        $arbTageZuschlagArray = $this->model->getArbTageZuschlagArray($persnr);

        $priplatekDpersDatumZuschlag = $this->model->getDpersDatumZuschlagArray($persnr);

        $priplatekArray = array(
                        "S0011"=>array(100,100,50,50,50,50,50,50,30,30,30,30,30,30,20,20,20,20,20,20),
                        "S0041"=>array(50,50,30,30,20,20,20,20,20,20,0,0,0,0,0,0,0,0,0,0),
                        "S0051"=>array(100,100,50,50,50,50,50,50,30,30,30,30,30,30,20,20,20,20,20,20),
                        "S0061"=>array(50,50,30,30,20,20,20,20,20,20,0,0,0,0,0,0,0,0,0,0),
                        "X"=>array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0),
            );

        
        // 1. pro pripad, ze chci v tabulce zobrazit vsechny mozne tatnr
        $priplatekArrayKeys = array_keys($priplatekArray);
        //odeberu posledni klic, X nechci
        array_pop($priplatekArrayKeys);


        // 2. pro pripad, ze chci v tabulce zobrazit jen ty statnr, ktere dany clovek v danem obdobi delal
        if($arbTageZuschlagArray!==NULL){
            $pomocne = array();
            $maxTage = 20;
            $actualTag = 0;
            foreach ($arbTageZuschlagArray as $datum => $atag) {
                foreach($atag as $key=>$count){
                    $pomocne[$key] = $count;
                }
                if($actualTag++>=$maxTage-1) break;
            }
            $priplatekArrayKeys = array_keys($pomocne);
            sort($priplatekArrayKeys);
        }

        
        
        $priplatekDayCounter = array();
        // vynuluju citace
        foreach($priplatekArrayKeys as $statnr) $priplatekDayCounter[$statnr] = 0;

        $this->getAjaxDriver()->arbtagezuschlagarray = $arbTageZuschlagArray;
        $divcontent = '';
        $divcontent .= "<div id='dperszuschlag_table'>";
        $divcontent .= "<table border='1'>";
        $maxTage = 20;
        $actualTag = 0;
        // hlavicka tabulky
        if(is_array($arbTageZuschlagArray)){
        $divcontent .= "<tr>";
        $divcontent .= "<th>";
        $divcontent .= "StatNr/datum";
        $divcontent .= "</th>";
        foreach($arbTageZuschlagArray as $datum=>$atag){
            $divcontent .= "<th>";
            $divcontent .= substr($datum,8,2).'.'.substr($datum,5,2).'.';
            $divcontent .= "</th>";
            if($actualTag++>=$maxTage-1) break;
        }
        $divcontent .= "</tr>";
        foreach($priplatekArrayKeys as $statnr){
            $maxTage = 20;
            $actualTag = 0;
            $divcontent .= "<tr>";
            $divcontent .= "<td>";
            $divcontent .= $statnr;
            $divcontent .= "</td>";
            foreach($arbTageZuschlagArray as $datum=>$atag){
                // projit mozne priplatky
                $divcontent .= "<td>";
                if(array_key_exists($statnr, $atag)){
                    if(is_array($priplatekDpersDatumZuschlag) && array_key_exists($statnr, $priplatekDpersDatumZuschlag)){
                        if(array_key_exists($datum, $priplatekDpersDatumZuschlag[$statnr])){
                            $value = $priplatekDpersDatumZuschlag[$statnr][$datum];
                            $divcontent .= "<input acturl='".$this->link('dperszuschlagUpdate')."' style='text-align:right;' type='text' size=3 maxlenth='5' id='zs_".$statnr."_".$datum."' value='".$value."'/>";
                            $priplatekDayCounter[$statnr]++;
                        }
                        else{
                            $value = $priplatekArray[$statnr][$priplatekDayCounter[$statnr]++];
                            $divcontent .= "<input acturl='".$this->link('dperszuschlagUpdate')."' style='text-align:right;' type='text' size=3 maxlenth='5' id='zs_".$statnr."_".$datum."' value='".$value."'/>";
                        }
                    }
                    else{
                        $value = $priplatekArray[$statnr][$priplatekDayCounter[$statnr]++];
                        $divcontent .= "<input acturl='".$this->link('dperszuschlagUpdate')."' style='text-align:right;' type='text' size=3 maxlenth='5' id='zs_".$statnr."_".$datum."' value='".$value."'/>";
                    }
                }
                else
                    $divcontent .= "&nbsp;";
                $divcontent .= "</td>";
            
                if($actualTag++>=$maxTage-1) break;
            }
            $divcontent .= "</tr>";
        }
        }
        else{
            $divcontent .= "<tr><td style='color:red;font-weight:bold;font-size:large;'>Keine Leistungen in Einarbeitungsbereich !</td></tr>";
        }
        $divcontent .= "</table>";
        $divcontent .= "</div>";
        $this->getAjaxDriver()->divcontent = $divcontent;
        $this->terminate();
    }

    /**
     *
     * @param <type> $id
     * @param <type> $persnr
     * @param <type> $jahr
     * @param <type> $monat
     */
        public function actionAbmahnung($id,$persnr,$jahr=NULL,$monat=NULL,$grund=NULL){
        $this->getAjaxDriver()->id = $id;
        $this->getAjaxDriver()->persnr = $persnr;

        if($jahr==NULL || $monat==NULL) {
            $aktualMonth = date('m');
            $aktualJahr = date('Y');
            $von = sprintf("%04d-%02d-%02d",$aktualJahr,$aktualMonth,1);
            $bis = sprintf("%04d-%02d-%02d",$aktualJahr,$aktualMonth,cal_days_in_month(CAL_GREGORIAN, $aktualMonth, $aktualJahr));
        }
        else {
            $aktualMonth = $monat;
            $aktualJahr = $jahr;
            $von = sprintf("%04d-%02d-%02d",$aktualJahr,$aktualMonth,1);
            $bis = sprintf("%04d-%02d-%02d",$aktualJahr,$aktualMonth,cal_days_in_month(CAL_GREGORIAN, $aktualMonth, $aktualJahr));
        }

        $this->getAjaxDriver()->jahr = $aktualJahr;
        $this->getAjaxDriver()->monat = $aktualMonth;

        // u Abmahnung nebudu omezovat na datumy von a bis
        $abmahnungArray = $this->model->getAbmahnungArray($persnr,NULL,NULL);
        $this->getAjaxDriver()->abmahnungarray = $abmahnungArray;

        $divcontent = '';
        $divcontent .= "<div id='abmahnung_table'>";
//        $divcontent .="<div id='abmahnung_zeitraum'>";
//        $divcontent .="Jahr <input type='text' id='abmahnung_zeitraum_jahr' size='4' maxlength='4' acturl='".$this->link('abmahnungZeitraumSet')."' value='".$aktualJahr."' />";
//        $divcontent .="&nbsp;Monat <input type='text' id='abmahnung_zeitraum_monat' size='2' maxlength='2' acturl='".$this->link('abmahnungZeitraumSet')."' value='".$aktualMonth."' />";
//        $divcontent .="</div>";
        $divcontent.="<table>";
        $divcontent.="<tr><th>Datum</th><th>Grund</th><th>Betrag</th><th>Abrechn. Datum</th><th>Bemerkung</th><th>ReklNr</th><th>Vorschlag</th><th>Von</th><th>Vorschl.Betrag</th><th>Vorschl.Bemerkung</th>";

        //radek pro vlozeni noveho
        $divcontent.="<tr>";
        $divcontent.="<td><input type='text' size='10' maxlength='10' id='abmahnung_datum' value='".date('d.m.Y')."' /></td>";
        $grundSelect = "<select id='abmahnung_grund'>";
        $grundInfoArray = $this->model->getAbmahnungGrundInfoArray();
        foreach ($grundInfoArray as $grundInfo){
            if($grundInfo['beschreibung']==$grund)
                $grundSelect.="<option selected='selected' value='".$grundInfo['beschreibung']."'>".$grundInfo['beschreibung']."</option>";
            else
                $grundSelect.="<option value='".$grundInfo['beschreibung']."'>".$grundInfo['beschreibung']."</option>";
        }
        $grundSelect.= "</select>";
        $divcontent.="<td>".$grundSelect."</td>";


        $divcontent.="<td><input id='abmahnung_betrag' type='text' value='0' size='3' maxlength='5' /></td>";
        $divcontent.="<td><input type='text' size='10' maxlength='10' id='abmahnung_datum_betrag' value='".date('d.m.Y')."' /></td>";
        $divcontent.="<td><input type='text' size='20' maxlength='50' id='abmahnung_bemerkung' value='' /></td>";
	
	//reklamation
	$reklamationSelect = "<select id='abmahnung_reklamation'>";
	$reklamationInfoArray = $this->model->getReklamationInfoArray();
	$reklamationSelect.="<option selected='selected' value='0'>----------</option>";
        foreach ($reklamationInfoArray as $reklamationInfo){
                $reklamationSelect.="<option value='".$reklamationInfo['id']."'>".$reklamationInfo['rekl_nr']."</option>";
        }
        $reklamationSelect.= "</select>";
        $divcontent.="<td>".$reklamationSelect."</td>";

        $checkedVorschlag = "checked='checked'";
	$divcontent.="<td><input id='abmahnung1_vorschlag' type='checkbox' value='' $checkedVorschlag /></td>";
	$divcontent.="<td><input type='text' size='3' maxlength='5' id='abmahnung1_vorschlag_von' value='' /></td>";
	$divcontent.="<td><input type='text' size='5' maxlength='5' id='abmahnung1_vorschlag_betrag' value='0' /></td>";
	$divcontent.="<td><input type='text' size='20' maxlength='50' id='abmahnung1_vorschlag_bemerkung' value='' /></td>";
        $divcontent.="<td><input type='button' value='+' id='abmahnung_add' acturl='".$this->link('abmahnungAdd')."' /></td>";
        $divcontent.="</tr>";

        //----------------------------------------------------------------------------------------------------------------------
        if($abmahnungArray!=NULL){
            foreach ($abmahnungArray as $abmahnung){
                $divcontent.="<tr id='abmahnungrow_".$abmahnung['id']."'>";
                    $divcontent.="<td>".$abmahnung['datum']."</td>";
                    $grundSelect = "<select id='abmahnung_grund_".$abmahnung['id']."' acturl='".$this->link('abmahnungGrundUpdate')."'>";
                    $grundInfoArray = $this->model->getAbmahnungGrundInfoArray();
                    $flag_noselected = TRUE;
                    foreach ($grundInfoArray as $grundInfo){

                        if($grundInfo['beschreibung']==$abmahnung['grund']){
                            $grundSelect.="<option selected='selected' value='".$grundInfo['beschreibung']."'>".$grundInfo['beschreibung']."</option>";
                            $flag_noselected = FALSE;
                        }
                        else{
                            if($grundInfo['id']=='0' && $flag_noselected)
                                $grundSelect.="<option selected='selected' value='".$grundInfo['beschreibung']."'>".$grundInfo['beschreibung']."</option>";
                            else
                                $grundSelect.="<option value='".$grundInfo['beschreibung']."'>".$grundInfo['beschreibung']."</option>";
                        }
                    }
                    $grundSelect.= "</select>";

                    $divcontent.="<td>".$grundSelect."</td>";
                    $divcontent.="<td><input size='3' maxlength='5' id='abmahnung_betrag_".$abmahnung['id']."' type='text' value='".$abmahnung['betrag']."' acturl='".$this->link('abmahnungBetragUpdate')."' /></td>";
                    $divcontent.="<td><input size='8' maxlength='10' id='abmahnung_datum_betrag_".$abmahnung['id']."' type='text' value='".$abmahnung['betrdat']."' acturl='".$this->link('abmahnungBetragDatumUpdate')."' /></td>";
                    $divcontent.="<td><input size='20' maxlength='50' id='abmahnung_bemerkung_".$abmahnung['id']."' type='text' value='".$abmahnung['bemerkung']."' acturl='".$this->link('abmahnungBemerkungUpdate')."' /></td>";
		    
		    // reklamationen ----------------------------------------------------------------
                    $reklamationSelect = "<select id='abmahnung_reklamation_".$abmahnung['id']."' acturl='".$this->link('abmahnungReklamationUpdate')."'>";
		    $selected = FALSE;
		    $noReklAdded = FALSE;
                    foreach ($reklamationInfoArray as $reklamationInfo) {
			if (($abmahnung['dreklamation_id'] != 0)&&(!$noReklAdded)) {
			    $reklamationSelect.="<option value='0'>----------</option>";
			    $noReklAdded = TRUE;
			}
			if (($abmahnung['dreklamation_id'] == 0)&&(!$selected)) {
			    $reklamationSelect.="<option selected='selected' value='0'>----------</option>";
			    $selected = TRUE;
			}
			if (($reklamationInfo['id'] == $abmahnung['dreklamation_id']) && (!$selected)) {
			    $reklamationSelect.="<option selected='selected' value='" . $reklamationInfo['id'] . "'>" . $reklamationInfo['rekl_nr'] . "</option>";
			    $selected = TRUE;
			} else {
			    $reklamationSelect.="<option value='" . $reklamationInfo['id'] . "'>" . $reklamationInfo['rekl_nr'] . "</option>";
			}
		    }
		    $reklamationSelect.= "</select>";

                    $divcontent.="<td>".$reklamationSelect."</td>";
		    //--------------------------------------------------------------------------------
		    // vorschlag
		    $checkedVorschlag = $abmahnung['vorschlag']==0?'':"checked='checked'";		    
		    $divcontent.="<td><input id='abmahnungcb_vorschlag_".$abmahnung['id']."' type='checkbox' value='' $checkedVorschlag acturl='".$this->link('abmahnungUpdate')."' /></td>";
		    $divcontent.="<td><input id='abmahnung_vorschlag_von_".$abmahnung['id']."' type='text' size='3' maxlength='5'  acturl='".$this->link('abmahnungUpdate')."' value='".$abmahnung['vorschlag_von']."' /></td>";
		    $divcontent.="<td><input id='abmahnung_vorschlag_betrag_".$abmahnung['id']."' type='text' size='5' maxlength='5'  acturl='".$this->link('abmahnungUpdate')."' value='".$abmahnung['vorschlag_betrag']."' /></td>";
		    $divcontent.="<td><input id='abmahnung_vorschlag_bemerkung_".$abmahnung['id']."' type='text' size='20' maxlength='50'  acturl='".$this->link('abmahnungUpdate')."' value='".$abmahnung['vorschlag_bemerkung']."' /></td>";
                    $divcontent.="<td><input type='button' value='-' id='abmahnung_delete_".$abmahnung['id']."' acturl='".$this->link('abmahnungDeleteId')."' /></td>";
		    $divcontent.="<td><a href='../../abmahnunggen/abmahnunggen.php#/form/".$abmahnung['id']."' target='_blank' title='vytvořit a uložit PDF výtku'>V</a></td>";
                $divcontent.="</tr>";
            }
        }
        $divcontent.="</table>";
        $divcontent .= "</div>";

        $this->getAjaxDriver()->divcontent = $divcontent;
        $this->terminate();
    }

    /**
     *
     * @param <type> $id
     * @param <type> $persnr
     * @param <type> $jahr
     * @param <type> $monat
     */
        public function actionVerletzung($id,$persnr,$jahr=NULL,$monat=NULL,$grund=NULL){
        $this->getAjaxDriver()->id = $id;
        $this->getAjaxDriver()->persnr = $persnr;

        if($jahr==NULL || $monat==NULL) {
            $aktualMonth = date('m');
            $aktualJahr = date('Y');
            $von = sprintf("%04d-%02d-%02d",$aktualJahr,$aktualMonth,1);
            $bis = sprintf("%04d-%02d-%02d",$aktualJahr,$aktualMonth,cal_days_in_month(CAL_GREGORIAN, $aktualMonth, $aktualJahr));
        }
        else {
            $aktualMonth = $monat;
            $aktualJahr = $jahr;
            $von = sprintf("%04d-%02d-%02d",$aktualJahr,$aktualMonth,1);
            $bis = sprintf("%04d-%02d-%02d",$aktualJahr,$aktualMonth,cal_days_in_month(CAL_GREGORIAN, $aktualMonth, $aktualJahr));
        }

        $this->getAjaxDriver()->jahr = $aktualJahr;
        $this->getAjaxDriver()->monat = $aktualMonth;

        $verletzungArray = $this->model->getVerletzungArray($persnr,NULL,NULL);
        $this->getAjaxDriver()->verletzungarray = $verletzungArray;

        $divcontent = '';
        $divcontent .= "<div id='verletzung_table'>";
        $divcontent.="<table>";
        $divcontent.="<tr><th>Datum</th><th>Unfall</th>";

        //radek pro vlozeni noveho
        $divcontent.="<tr>";
        $divcontent.="<td><input type='text' size='10' maxlength='10' id='verletzung_datum' value='".date('d.m.Y')."' /></td>";
        $grundSelect = "<select id='verletzung_grund'>";
        $grundInfoArray = $this->model->getVerletzungGrundInfoArray();
        foreach ($grundInfoArray as $grundInfo){
            if($grundInfo['id']==$grund)
                $grundSelect.="<option selected='selected' value='".$grundInfo['id']."'>".$grundInfo['id'].'-'.$grundInfo['beschreibung']."</option>";
            else
                $grundSelect.="<option value='".$grundInfo['id']."'>".$grundInfo['id'].'-'.$grundInfo['beschreibung']."</option>";
        }
        $grundSelect.= "</select>";
        $divcontent.="<td>".$grundSelect."</td>";

        $divcontent.="<td><input type='button' value='+' id='verletzung_add' acturl='".$this->link('verletzungAdd')."' /></td>";
        $divcontent.="</tr>";

        //----------------------------------------------------------------------------------------------------------------------
        if($verletzungArray!=NULL){
            foreach ($verletzungArray as $verletzung){
                $divcontent.="<tr id='verletzungrow_".$verletzung['id']."'>";
                    $divcontent.="<td>".$verletzung['datum']."</td>";

                    $grundSelect = "<select id='verletzung_grund_".$verletzung['id']."' acturl='".$this->link('verletzungGrundUpdate')."'>";
                    $grundInfoArray = $this->model->getVerletzungGrundInfoArray();
                    $flag_noselected = TRUE;
                    foreach ($grundInfoArray as $grundInfo){

                        if($grundInfo['id']==$verletzung['grund']){
                            $grundSelect.="<option selected='selected' value='".$grundInfo['id']."'>".$grundInfo['id'].'-'.$grundInfo['beschreibung']."</option>";
                            $flag_noselected = FALSE;
                        }
                        else{
                            if($grundInfo['id']=='0' && $flag_noselected)
                                $grundSelect.="<option selected='selected' value='".$grundInfo['id']."'>".$grundInfo['id'].'-'.$grundInfo['beschreibung']."</option>";
                            else
                                $grundSelect.="<option value='".$grundInfo['id']."'>".$grundInfo['id'].'-'.$grundInfo['beschreibung']."</option>";
                        }
                    }
                    $grundSelect.= "</select>";

                    $divcontent.="<td>".$grundSelect."</td>";
                    $divcontent.="<td><input type='button' value='-' id='verletzung_delete_".$verletzung['id']."' acturl='".$this->link('verletzungDeleteId')."' /></td>";
                $divcontent.="</tr>";
            }
        }
        $divcontent.="</table>";
        $divcontent .= "</div>";

        $this->getAjaxDriver()->divcontent = $divcontent;
        $this->terminate();
    }

    public function actionVertrag($id,$persnr){
        $this->getAjaxDriver()->id = $id;
        $this->getAjaxDriver()->persnr = $persnr;

        $vertragArray = $this->model->getVetragArray($persnr);

        $this->getAjaxDriver()->vertragarray = $vertragArray;

        $divcontent = '';
        $divcontent .= "<div id='vertrag_table'>";
        $divcontent.="<table>";
        $divcontent.="<tr><th>Eintritt</th><th>Verlaengerung</th><th>Typ</th><th>Austritt</th><th>Befristet bis</th><th>Probezeit</th><th>Regelstunden</th><th>Vertr.Anf.</th>";

        //radek pro vlozeni noveho
        $divcontent.="<tr style='background-color:yellow;'>";
        $divcontent.="<td><input size='10' maxlength='10' id='vertrag_dat_eintritt' type='text' value=''/></td>";
        $divcontent.="<td><input id='vertrag_verlang' type='checkbox'/></td>";
	
        $kfzSelect = "<select id='vertragtypid'>";
        $kfzInfoArray = $this->model->getVertragTypInfoArray();
        foreach ($kfzInfoArray as $kfzInfo){
            if($kfzInfo['id']==1)
                $kfzSelect.="<option selected='selected' value='".$kfzInfo['id']."'>".$kfzInfo['typ_kz']."</option>";
            else
                $kfzSelect.="<option value='".$kfzInfo['id']."'>".$kfzInfo['typ_kz']."</option>";
        }
        $kfzSelect.= "</select>";
        $divcontent.="<td>".$kfzSelect."</td>";

        $divcontent.="<td><input size='10' maxlength='10' id='vertrag_dat_austritt' type='text' value=''/></td>";
        $divcontent.="<td><input size='10' maxlength='10' id='vertrag_dat_befristet' type='text' value=''/></td>";
        $divcontent.="<td><input size='10' maxlength='10' id='vertrag_dat_probezeit' type='text' value=''/></td>";
        $divcontent.="<td><input style='text-align:right;' size='3' maxlength='10' id='vertrag_regelstunden' type='text' value='8'/></td>";
        $divcontent.="<td><input title='Anfang des Vertrages' id='vertrag_vertraganfang' type='checkbox'/></td>";
        $divcontent.="<td><input type='button' value='+' id='vertrag_add' acturl='".$this->link('vertragAdd')."' /></td>";
        $divcontent.="</tr>";
        $divcontent.="<tr>";
        $divcontent.="<td colspan='8'><hr>";
        $divcontent.="</td>";
        $divcontent.="</tr>";
        if($vertragArray!==NULL){
            foreach($vertragArray as $vertrag){
                $divcontent .= "<tr id='vertragrow_".$vertrag['id']."'>";
                $vertragTyp = $vertrag['verlang']!=0?'Verlaengerung':'Neuer Vertrag';
                $vertragAnfang = $vertrag['vertrag_anfang']!=0?"checked='checked'":'';

                $vertragTypColor = $vertrag['verlang']!=0?'#aaf':'#ddd';
		
		$divcontent.="<td><input title='' style='text-align: left' size='10' maxlength='10' id='vertrag_i_eintritt_".$vertrag['id']."' type='text' value='".$vertrag['eintritt']."' acturl='".$this->link('vertragUpdate')."' /></td>";
                $divcontent.="<td><input readonly='readonly' title='' style='border:none;background-color:".$vertragTypColor.";text-align: left' size='10' maxlength='10' id='vertrag_i_verlang_".$vertrag['id']."' type='text' value='".$vertragTyp."' /></td>";

		// select
		    $kfzSelect = "<select id='vertrag_i_vertragtypid_".$vertrag['id']."' acturl='".$this->link('vertragUpdate')."'>";
                    $kfzInfoArray = $this->model->getVertragTypInfoArray();
                    $flag_noselected = TRUE;
                    foreach ($kfzInfoArray as $kfzInfo){

                        if($kfzInfo['id']==$vertrag['vertragtyp_id']){
                            $kfzSelect.="<option selected='selected' value='".$kfzInfo['id']."'>".$kfzInfo['typ_kz']."</option>";
                            $flag_noselected = FALSE;
                        }
                        else{
                            if($kfzInfo['id']=='1' && $flag_noselected)
                                $kfzSelect.="<option selected='selected' value='".$kfzInfo['id']."'>".$kfzInfo['typ_kz']."</option>";
                            else
                                $kfzSelect.="<option value='".$kfzInfo['id']."'>".$kfzInfo['typ_kz']."</option>";
                        }
                    }
                    $kfzSelect.= "</select>";

                    $divcontent.="<td>".$kfzSelect."</td>";

		// end of select
		    
                $divcontent.="<td><input title='' style='text-align: left' size='10' maxlength='10' id='vertrag_i_austritt_".$vertrag['id']."' type='text' value='".$vertrag['austritt']."' acturl='".$this->link('vertragUpdate')."' /></td>";
                $divcontent.="<td><input title='' style='text-align: left' size='10' maxlength='10' id='vertrag_i_befristet_".$vertrag['id']."' type='text' value='".$vertrag['befristet']."' acturl='".$this->link('vertragUpdate')."' /></td>";
                $divcontent.="<td><input title='' style='text-align: left' size='10' maxlength='10' id='vertrag_i_probezeit_".$vertrag['id']."' type='text' value='".$vertrag['probezeit']."' acturl='".$this->link('vertragUpdate')."' /></td>";
                $divcontent.="<td><input title='' style='text-align: right' size='3' maxlength='10' id='vertrag_i_regelstunden_".$vertrag['id']."' type='text' value='".$vertrag['regelstunden']."' acturl='".$this->link('vertragUpdate')."' /></td>";
                $divcontent.="<td><input title='' style='text-align: right' id='vertrag_cb_vertraganfang_".$vertrag['id']."' type='checkbox' $vertragAnfang acturl='".$this->link('vertragUpdate')."' /></td>";
                $divcontent.="<td><input type='button' value='-' id='vertrag_del_".$vertrag['id']."' acturl='".$this->link('vertragDeleteId',array('id'=>$vertrag['id']))."' /></td>";
                $divcontent .= "</tr>";
            }
        }
        $divcontent.="</table>";
        $divcontent .= "</div>";

        $this->getAjaxDriver()->divcontent = $divcontent;

        $this->terminate();
    }
    /**
     *
     * @param <type> $id
     * @param <type> $persnr
     * @param <type> $jahr
     * @param <type> $monat
     */
        public function actionFaehigkeiten($id,$persnr,$fah_typ_id=NULL,$fah_id=NULL){
        $this->getAjaxDriver()->id = $id;
        $this->getAjaxDriver()->persnr = $persnr;


        $faehigkeitenArray = $this->model->getFaehigkeitenArray($persnr);
        $this->getAjaxDriver()->faehigkeitenarray = $faehigkeitenArray;

        $divcontent = '';
        $divcontent .= "<div id='faehigkeiten_table'>";
        $divcontent.="<table>";
        $divcontent.="<tr><th>&nbsp;</th><th width='200'>Qualifikationstyp</th><th width='200'>Qualifikation</th><th width='80'>Ist</th><th width='80'>Soll</th><th width='200'>Bemerkung</th><th width='200'>Schulung</th><th width='100'>Schul.Datum</th>";

        //radek pro vlozeni noveho
        $divcontent.="<tr>";
        $divcontent.="<td>&nbsp;</td>";
        // selectbox pro typ lvalifikace
        $faehigkeitTypSelect = "<select id='faehigkeit_faehigkeittyp' acturl='".$this->link('faehigkeitTypUpdate')."'>";
        $faehigkeittypInfoArray = $this->model->getFaehigkeitTypInfoArray();
        $poradi = 0;
        foreach ($faehigkeittypInfoArray as $faehigkeitTypInfo){
            if($poradi==0){
                $faehigkeitTypSelect.="<option selected='selected' value='".$faehigkeitTypInfo['id']."'>".$faehigkeitTypInfo['beschreibung']."</option>";
                $selectedFaehigketiTypId = $faehigkeitTypInfo['id'];
            }
            // pro zachovani puvodni hodnoty z formulare po pridani qualifikation
            
            elseif(($fah_typ_id!==NULL) && ($fah_typ_id==$faehigkeitTypInfo['id'])){
                $faehigkeitTypSelect.="<option selected='selected' value='".$faehigkeitTypInfo['id']."'>".$faehigkeitTypInfo['beschreibung']."</option>";
                $selectedFaehigketiTypId = $faehigkeitTypInfo['id'];
            }
            else
                $faehigkeitTypSelect.="<option value='".$faehigkeitTypInfo['id']."'>".$faehigkeitTypInfo['beschreibung']."</option>";
            $poradi++;
        }
        //selectbox pro kvalifikaci
        $faehigkeitTypSelect.= "</select>";
        $divcontent.="<td>".$faehigkeitTypSelect."</td>";
        $faehigkeitSelect = "<select id='faehigkeit_faehigkeit'>";
        $faehigkeitInfoArray = $this->model->getFaehigkeitInfoArray($selectedFaehigketiTypId);
        $poradi = 0;
        foreach ($faehigkeitInfoArray as $faehigkeitInfo){
            if($poradi==0)
                $faehigkeitSelect.="<option selected='selected' value='".$faehigkeitInfo['id']."'>( ".$faehigkeitInfo['faeh_abkrz']." ) ".$faehigkeitInfo['beschreibung']."</option>";
            // pro zachovani puvodni hodnoty z formulare po pridani qualifikation
            elseif(($fah_id!==NULL) && ($fah_id==$faehigkeitInfo['id']))
                $faehigkeitSelect.="<option selected='selected' value='".$faehigkeitInfo['id']."'>( ".$faehigkeitInfo['faeh_abkrz']." ) ".$faehigkeitInfo['beschreibung']."</option>";
            else
                $faehigkeitSelect.="<option value='".$faehigkeitInfo['id']."'>( ".$faehigkeitInfo['faeh_abkrz']." ) ".$faehigkeitInfo['beschreibung']."</option>";
            $poradi++;
        }
        $faehigkeitSelect.= "</select>";
        $divcontent.="<td>".$faehigkeitSelect."</td>";
        $napoveda = '1 Arbeitsgang nicht gesehen&#xA;';
        $napoveda.= '2 Arbeitsgang gesehen - nicht gemacht&#xA;';
        $napoveda.= '3 Arbeitsgang 1 mal probiert&#xA;';
        $napoveda.= '4 arbeitet unter staendigem Aufsicht&#xA;';
        $napoveda.= '5 arbeitet unter oefterem Aufsicht&#xA;';
        $napoveda.= '6 arneitet unter oeftere Kontrolle&#xA;';
        $napoveda.= '7 arbeitet selbststaendig 100% ( Kontrolle=Stempel )&#xA;';
        $napoveda.= '8 arbeitet selbststaendig ueber 100%&#xA;';
        $napoveda.= '9 arbeitet selbststaendig ueber 125%&#xA;';
        $napoveda.= '10 Profi';
        $divcontent.="<td><input title='$napoveda' style='text-align: right' size='3' maxlength='3' id='faehigkeit_ist' type='text' value='0' /></td>";
        $divcontent.="<td><input title='$napoveda' style='text-align: right' size='3' maxlength='3' id='faehigkeit_soll' type='text' value='0' /></td>";
        
        $divcontent.="<td><input size='25' maxlength='255' id='faehigkeit_bemerkung' type='text' value=''/></td>";

        $divcontent.="<td><input type='button' value='+' id='faehigkeit_add' acturl='".$this->link('faehigkeitAdd')."' /></td>";
        
        $divcontent.="</tr>";

        $divcontent.="<tr><td colspan='9'><hr></td></tr>";

        //----------------------------------------------------------------------------------------------------------------------
        if($faehigkeitenArray!=NULL){
            foreach ($faehigkeitenArray as $faehigkeit){
                $divcontent.="<tr id='faehigkeitrow_".$faehigkeit['id']."'>";
                    $divcontent.="<td><input type='button' value='-' id='faehigkeit_delete_".$faehigkeit['id']."' acturl='".$this->link('faehigkeitDeleteId')."' /></td>";
                    $divcontent.="<td>".$faehigkeit['faehigkeittypbeschreibung']."</td>";

                    $divcontent.="<td>( ".$faehigkeit['faeh_abkrz']." ) ".$faehigkeit['faehigkeitbeschreibung']."</td>";
                    $divcontent.="<td><input title='$napoveda' style='text-align: right' size='3' maxlength='3' id='faehigkeit_sollist_ist_".$faehigkeit['id']."' type='text' value='".$faehigkeit['ist']."' acturl='".$this->link('faehigkeitSollIstUpdate',array('typ'=>'ist'))."' /></td>";
                    $divcontent.="<td><input title='$napoveda' style='text-align: right' size='3' maxlength='3' id='faehigkeit_sollist_soll_".$faehigkeit['id']."' type='text' value='".$faehigkeit['soll']."' acturl='".$this->link('faehigkeitSollIstUpdate',array('typ'=>'soll'))."' /></td>";
                    
                    $divcontent.="<td><input size='25' maxlength='255' id='faehigkeit_bemerkung_".$faehigkeit['id']."' type='text' value='".$faehigkeit['bemerkung']."' acturl='".$this->link('faehigkeitBemerkungUpdate')."' /></td>";
                    
                    if ($faehigkeit['idschulung'] != 99) {
                        $divcontent.="<td>" . $faehigkeit['schulung_beschreibung'];
//                        if (strlen($faehigkeit['schulung_lektor']) > 0)
//                            $divcontent .=" ( " . $faehigkeit['schulung_lektor'] . " )" . "</td>";
//                        else
                            $divcontent .="</td>";

                        // letzte schulung info
                        $letzteSchulungInfo = $this->model->getLetzteSchulungInfo($persnr, $faehigkeit['idschulung']);
                        if ($letzteSchulungInfo !== NULL) {
                            $letzteDatum = $letzteSchulungInfo['letzte_datum'];
                            $ergebniss = $letzteSchulungInfo['ergebniss'];
                            $divcontent.="<td>$letzteDatum ( $ergebniss )</td>";
                        }
                        else
                            $divcontent.="<td>&nbsp;</td>";

                        $divcontent.="<td><input type='button' value='Schulungen' id='faehigkeit_schulungen_".$faehigkeit['id']."' acturl='".$this->link('faehigkeitSchulungen',array('schulungid'=>$faehigkeit['idschulung'],'persnr'=>$persnr))."' /></td>";
                    }
                    else {
                        $divcontent.="<td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>";
                    }

                $divcontent.="</tr>";
                $divcontent.="<tr><td colspan='9'><hr></td></tr>";
            }
        }
        $divcontent.="</table>";
        $divcontent .= "</div>";

        $this->getAjaxDriver()->divcontent = $divcontent;
        $this->terminate();
    }
    /**
     *
     * @param <type> $id
     * @param <type> $persnr
     * @param <type> $jahr
     * @param <type> $monat
     */
        public function actionAnwesenheit($id,$persnr,$jahr=NULL,$monat=NULL){
        $this->getAjaxDriver()->id = $id;
        $this->getAjaxDriver()->persnr = $persnr;

        if($jahr==NULL || $monat==NULL) {
            $aktualMonth = date('m');
            $aktualJahr = date('Y');
            $von = sprintf("%04d-%02d-%02d",$aktualJahr,$aktualMonth,1);
            $bis = sprintf("%04d-%02d-%02d",$aktualJahr,$aktualMonth,cal_days_in_month(CAL_GREGORIAN, $aktualMonth, $aktualJahr));
        }
        else {
            $aktualMonth = $monat;
            $aktualJahr = $jahr;
            $von = sprintf("%04d-%02d-%02d",$aktualJahr,$aktualMonth,1);
            $bis = sprintf("%04d-%02d-%02d",$aktualJahr,$aktualMonth,cal_days_in_month(CAL_GREGORIAN, $aktualMonth, $aktualJahr));
        }

        $this->getAjaxDriver()->jahr = $aktualJahr;
        $this->getAjaxDriver()->monat = $aktualMonth;

        $anwesenheitArray = $this->model->getAnwesenheitArray($persnr, $von, $bis);
        $this->getAjaxDriver()->anwesenheitarray = $anwesenheitArray;


        $divcontent = '';
        $divcontent .= "<div id='anwesenheit_table'>";
        $divcontent .="<div id='anwesenheit_zeitraum'>";
        $divcontent .="Jahr <input type='text' id='anwesenheit_zeitraum_jahr' size='4' maxlength='4' acturl='".$this->link('anwesenheitZeitraumSet')."' value='".$aktualJahr."' />";
        $divcontent .="&nbsp;Monat <input type='text' id='anwesenheit_zeitraum_monat' size='2' maxlength='2' acturl='".$this->link('anwesenheitZeitraumSet')."' value='".$aktualMonth."' />";
        $divcontent .="</div>";
        $divcontent.="<table>";
        $divcontent.="<tr><th>Datum</th><th>OE</th><th>Stunden</th><th>Pause1</th><th>Pause2</th>";

        //----------------------------------------------------------------------------------------------------------------------
//        Debug::dump($essenArray);
        if($anwesenheitArray!=NULL){
            foreach ($anwesenheitArray as $anwesenheit){
                $divcontent.="<tr id='anwesenheitrow_".$anwesenheit['id']."'>";
                    $divcontent.="<td>".$anwesenheit['datum']."</td>";
                    //$divcontent.="<td><input size='4' maxlength='5' id='anwesenheit_OE_".$anwesenheit['id']."' type='text' value='".$anwesenheit['oe']."' readonly='readonly' /></td>";

                    $oeSelect = "<select id='anwesenheit_oe_".$anwesenheit['id']."' acturl='".$this->link('anwesenheitOEUpdate')."'>";
                    $oeInfoArray = $this->model->getOEInfoArray();
                    $flag_noselected = TRUE;
                    foreach ($oeInfoArray as $oeInfo){

                        if(!strcmp($oeInfo['tat'],$anwesenheit['oe'])){
                            $oeSelect.="<option selected='selected' value='".$oeInfo['tat']."'>".$oeInfo['tat']."</option>";
                            $flag_noselected = FALSE;
                        }
                        else{
                            $oeSelect.="<option value='".$oeInfo['tat']."'>".$oeInfo['tat']."</option>";
                        }
                    }
                    $oeSelect.= "</select>";
                    $divcontent.="<td>".$oeSelect."</td>";

                    $divcontent.="<td><input style='text-align: right' size='4' maxlength='5' id='anwesenheit_stunden_".$anwesenheit['id']."' type='text' value='".number_format($anwesenheit['stunden'],1)."' readonly='readonly' /></td>";
                    $divcontent.="<td><input style='text-align: right' size='4' maxlength='5' id='anwesenheit_pause1_".$anwesenheit['id']."' type='text' value='".number_format($anwesenheit['pause1'],2)."' readonly='readonly' /></td>";
                    $divcontent.="<td><input style='text-align: right' size='4' maxlength='5' id='anwesenheit_pause2_".$anwesenheit['id']."' type='text' value='".number_format($anwesenheit['pause2'],2)."' readonly='readonly' /></td>";
                    $divcontent.="<td><input type='button' value='-' id='anwesenheit_delete_".$anwesenheit['id']."' acturl='".$this->link('anwesenheitDeleteId')."' /></td>";
                $divcontent.="</tr>";
            }
        }
        $divcontent.="</table>";
        $divcontent .= "</div>";

        $this->getAjaxDriver()->divcontent = $divcontent;
        $this->terminate();
    }

    public function actionNachPersNr($id,$persnr,$nurActiveMA){
        if($nurActiveMA=='true')
            $nurActiveMA=TRUE;
        else
            $nurActiveMA=FALSE;

        $nextPersNr = $this->model->getFirstPersNrFromDpers($nurActiveMA,$persnr);
        $this->getAjaxDriver()->id = $id;
        $this->getAjaxDriver()->persnr = $persnr;
        $this->getAjaxDriver()->nextpersnr = $nextPersNr;
        $this->terminate();
    }

public function actionVorPersNr($id,$persnr,$nurActiveMA) {
        if($nurActiveMA=='true')
            $nurActiveMA=TRUE;
        else
            $nurActiveMA=FALSE;

    $nextPersNr = $this->model->getLastPersNrFromDpers($nurActiveMA,$persnr);
    $this->getAjaxDriver()->id = $id;
    $this->getAjaxDriver()->persnr = $persnr;
    $this->getAjaxDriver()->nextpersnr = $nextPersNr;
    $this->terminate();
}

public function actionUpdateDpersDetailDatumField($id,$persnr,$field,$value) {
    if(strlen(trim($value))==0) {
        // v pripade, ze chci datum vymazat
        $value = NULL;
        $datumvalue = 'null';
    }
    else{
        $datumvalue = Utility::validateDatum($value);
    }

     $this->getAjaxDriver()->persnr = $persnr;
     $this->getAjaxDriver()->id = $id;
     $this->getAjaxDriver()->value = $value;
     $this->getAjaxDriver()->field = $field;

    if($datumvalue!=NULL) {
        if($datumvalue=='null'){
            //$value = Utility::make_DB_datum($datumvalue);
            $this->getAjaxDriver()->datumvalue = '';
        }
        else{
            $value = Utility::make_DB_datum($datumvalue);
            $this->getAjaxDriver()->datumvalue = $datumvalue;
        }

        if(strlen(trim($field))==0 || $field == NULL) $this->terminate();

        $affectedRows=$this->model->updateDpersDetailFieldProPersNr($persnr, $field, $value);
        $this->getAjaxDriver()->affectedrows = $affectedRows;

    }
    else {
        $this->getAjaxDriver()->datumvalue = NULL;
    }
    $this->terminate();
}

    /**
     *
     * @param <type> $persnr
     * @param <type> $field
     * @param <type> $value
     */
public function actionUpdateDpersDatumField($id,$persnr,$field,$value) {
    if(strlen(trim($value))==0) {
        // v pripade, ze chci datum vymazat
        $value = NULL;
        $datumvalue = 'null';
    }
    else{
        $datumvalue = Utility::validateDatum($value);
    }

     $this->getAjaxDriver()->persnr = $persnr;
     $this->getAjaxDriver()->id = $id;
     $this->getAjaxDriver()->value = $value;
     $this->getAjaxDriver()->field = $field;

    if($datumvalue!=NULL) {
        if($datumvalue=='null'){
            //$value = Utility::make_DB_datum($datumvalue);
            $this->getAjaxDriver()->datumvalue = '';
        }
        else{
            $value = Utility::make_DB_datum($datumvalue);
            $this->getAjaxDriver()->datumvalue = $datumvalue;
        }

        if(strlen(trim($field))==0 || $field == NULL) $this->terminate();

        $affectedRows=$this->model->updateDpersFieldProPersNr($persnr, $field, $value);
        $this->getAjaxDriver()->affectedrows = $affectedRows;

    }
    else {
        $this->getAjaxDriver()->datumvalue = NULL;
    }
    $this->terminate();
}

public function actionUpdateDBewerbDatumField($id,$persnr,$field,$value) {
    if(strlen(trim($value))==0) {
        // v pripade, ze chci datum vymazat
        $value = NULL;
        $datumvalue = 'null';
    }
    else{
        $datumvalue = Utility::validateDatum($value);
    }

     $this->getAjaxDriver()->persnr = $persnr;
     $this->getAjaxDriver()->id = $id;
     $this->getAjaxDriver()->value = $value;
     $this->getAjaxDriver()->field = $field;

    if($datumvalue!=NULL) {
        if($datumvalue=='null'){
            //$value = Utility::make_DB_datum($datumvalue);
            $this->getAjaxDriver()->datumvalue = '';
        }
        else{
            $value = Utility::make_DB_datum($datumvalue);
            $this->getAjaxDriver()->datumvalue = $datumvalue;
        }

        if(strlen(trim($field))==0 || $field == NULL) $this->terminate();

        $affectedRows=$this->model->updateDBewerberFieldProPersNr($persnr, $field, $value);
        $this->getAjaxDriver()->affectedrows = $affectedRows;

    }
    else {
        $this->getAjaxDriver()->datumvalue = NULL;
    }
    $this->terminate();
}
    /**
     *
     * @param <type> $persnr
     * @param <type> $value
     * @return <type> 
     */
    public function actionUpdateDpersField($id,$persnr,$field,$value){

        $value = trim($value);
        $this->getAjaxDriver()->persnr = $persnr;
        $this->getAjaxDriver()->id = $id;
        $this->getAjaxDriver()->value = $value;
        $this->getAjaxDriver()->field = $field;

        if(strlen(trim($field))==0 || $field == NULL) $this->terminate();
        
        $affectedRows=$this->model->updateDpersFieldProPersNr($persnr, $field, $value);
        $this->getAjaxDriver()->affectedrows = $affectedRows;
        $this->terminate();
    }

    public function actionUpdateDBewerbField($id,$persnr,$field,$value){

        $value = trim($value);
        $this->getAjaxDriver()->persnr = $persnr;
        $this->getAjaxDriver()->id = $id;
        $this->getAjaxDriver()->value = $value;
        $this->getAjaxDriver()->field = $field;

        if(strlen(trim($field))==0 || $field == NULL) $this->terminate();

        $affectedRows=$this->model->updateDBewerberFieldProPersNr($persnr, $field, $value);
        $this->getAjaxDriver()->affectedrows = $affectedRows;
        $this->terminate();
    }
    /**
     *
     * @param <type> $persnr
     * @param <type> $value
     * @return <type>
     */
    public function actionUpdateDurlaubField($id,$persnr,$field,$value){

        $value = trim($value);
        $this->getAjaxDriver()->persnr = $persnr;
        $this->getAjaxDriver()->id = $id;
        $this->getAjaxDriver()->value = $value;
        $this->getAjaxDriver()->field = $field;

        if(strlen(trim($field))==0 || $field == NULL) $this->terminate();

        $affectedRows=$this->model->updateDurlaubFieldProPersNr($persnr, $field, $value);
        $this->getAjaxDriver()->affectedrows = $affectedRows;
        $this->terminate();
    }

    /**
     *
     * @param <type> $persnr
     * @param <type> $value
     * @return <type>
     */
    public function actionUpdateDpersDetailField($id,$persnr,$field,$value){

        $value = trim($value);
        $this->getAjaxDriver()->persnr = $persnr;
        $this->getAjaxDriver()->id = $id;
        $this->getAjaxDriver()->value = $value;
        $this->getAjaxDriver()->field = $field;

        if(strlen(trim($field))==0 || $field == NULL) $this->terminate();

        $affectedRows=$this->model->updateDpersDetailFieldProPersNr($persnr, $field, $value);
        $this->getAjaxDriver()->affectedrows = $affectedRows;
        $this->terminate();
    }

    public function actionBewerberForm($id,$persnr){
        $this->getAjaxDriver()->id = $id;
        $this->getAjaxDriver()->persnr = $persnr;

        // vytahnout informace z tabulky dbewerber o danem persnr
        $bewerbinfo = $this->model->getBewerbInfo($persnr);

        $this->getAjaxDriver()->bewerbinfo = $bewerbinfo;

        $oes = $this->model->getOEInfo();
        $keys = Utility::getArrayWithKey('tat', $oes);
        $values = Utility::getArrayWithKey('tat', $oes);

        //transport_id
        $tiArray =  $this->model->getKfzInfoArray(0);
        $tiSelectItems = new SelectItemsModel($bewerbinfo['transport_id'], Utility::getArrayWithKey('id', $tiArray),Utility::getArrayWithKey('fahrzeug', $tiArray));
        $bewerbinfo['transport_id'] = $tiSelectItems->getSelectItemsArray();
//        Debug::dump($bewerbinfo['transport_id']);

        //staat_angehoerigkeit_id
        $saArray = $this->model->getStaatenInfo();
        $saSelectItems = new SelectItemsModel($bewerbinfo['staats_angehoerigkeit_id'], Utility::getArrayWithKey('id', $saArray),Utility::getArrayWithKey('staat_abkrz', $saArray));
        $bewerbinfo['staats_angehoerigkeit_id'] = $saSelectItems->getSelectItemsArray();
//        Debug::dump($bewerbinfo['staats_angehoerigkeit_id']);

        //erledigt
        $erledigtArray = $this->model->getAplBenutzerInfo();
        $erledigtSelectItems = new SelectItemsModel($bewerbinfo['erledigt'], Utility::getArrayWithKey('name', $erledigtArray),Utility::getArrayWithKey('name', $erledigtArray));
        $bewerbinfo['erledigt'] = $erledigtSelectItems->getSelectItemsArray();
//        Debug::dump($bewerbinfo['erledigt']);

        //oe_voraussichtlich
        $oeVoraussichtlichSelectItems = new SelectItemsModel($bewerbinfo['oe_voraussichtlich'], $keys, $values);
        $bewerbinfo['oe_voraussichtlich'] = $oeVoraussichtlichSelectItems->getSelectItemsArray();
//        Debug::dump($bewerbinfo['oe_voraussichtlich']);

        //abydos_agentur
        $abydos_agenturSelectItems = new SelectItemsModel($bewerbinfo['abydos_agentur'], array('ABY','AGENT'),array('ABY','AGENT'));
        $bewerbinfo['abydos_agentur'] = $abydos_agenturSelectItems->getSelectItemsArray();
//        Debug::dump($bewerbinfo['abydos_agentur']);

        //beendet_vom
        $abydos_agenturSelectItems = new SelectItemsModel($bewerbinfo['beendet_vom'], array('ABY','MA'),array('ABY','MA'));
        $bewerbinfo['beendet_vom'] = $abydos_agenturSelectItems->getSelectItemsArray();
//        Debug::dump($bewerbinfo['abydos_agentur']);

        $form = new FormBewerberInfo('persinfo');

        $form->setControlValues($bewerbinfo);
        $form->setActUrl($this->acturlArray);

        //$form->setFormSecurityAttributes($sec);
        foreach ($form->getControls() as $name=>$control){
            $this->getAjaxDriver()->form[$name] = $control->control;
//            Debug::dump($control);
        }
        $this->terminate();
    }

    public function actionPersnrDelete($id,$persnr){
        $this->getAjaxDriver()->id = $id;
        $this->getAjaxDriver()->persnr = $persnr;
        $this->model->deletePersnr($persnr);
        $this->actionDefault();
        $this->terminate();
    }
    public function actionPersnrKopieren($id,$persnr,$persnrNeu){
        $this->getAjaxDriver()->id = $id;
        $this->getAjaxDriver()->persnr = $persnr;

        $divcontent = '';
        $divcontent .= "<div id='persnrkopieren_table'>";
        $divcontent.="<div>";
        $divcontent.="Neue Persnr :&nbsp;";
        $divcontent.="<input type='text' size='5' maxlength='5' value='' id='persnr_neu' acturl='".$this->link('validatePersnrNeu')."' />";
        $divcontent.="</div>";
        $divcontent.="<div id='persnr_neu_meldung'>";
        $divcontent.="</div>";
        $divcontent.="<hr>";
        $divcontent.="<div>";
        $divcontent.="<input type='button' value='Persnr kopieren' id='persnr_neu_run' acturl='".$this->link('persnrKopierenRun')."'/>";
        $divcontent.="</div>";
        $divcontent .= "</div>";

        $this->getAjaxDriver()->divcontent = $divcontent;
        $this->terminate();
    }

    public function actionPersnrKopierenRun($id,$persnrneu,$persnralt){
        $this->getAjaxDriver()->id = $id;
        $this->getAjaxDriver()->persnrneu = $persnrneu;
        $this->getAjaxDriver()->persnralt = $persnralt;
        $ok = $this->model->copyPersnr($persnralt,$persnrneu);
        $this->getAjaxDriver()->ok = $ok;
        $this->terminate();
    }
    
    public function actionValidatePersnrNeu($id,$persnrneu){
        $this->getAjaxDriver()->id = $id;
        $this->getAjaxDriver()->persnrneu = $persnrneu;
        // zkontroluju, zda zadane persnr neni uz obsazeno
        $persinfo = $this->model->getPersnrInfo($persnrneu,FALSE);
        if($persinfo!==NULL)
            $this->getAjaxDriver()->exists = TRUE;
        else
            $this->getAjaxDriver()->exists = FALSE;
        $this->getAjaxDriver()->persinfo = $persinfo;
        $this->terminate();
    }

    public function actionValidatePersnr($id,$persnr,$nurActiveMA,$neuMA=0,$persNrStatus='MA'){

        if($nurActiveMA=='true')
            $nurActiveMA=TRUE;
        else
            $nurActiveMA=FALSE;
        
        $this->getAjaxDriver()->persnr = $persnr;
        $this->getAjaxDriver()->nuractiveMA = $nurActiveMA;
        $this->getAjaxDriver()->neuMA = $neuMA;
        
        if($neuMA==1) $persnr = $this->model->newPersNr($persnr,$persNrStatus);

        $persinfo = $this->model->getPersnrInfo($persnr,$nurActiveMA);
        $this->getAjaxDriver()->persinfo = $persinfo;
        if($persinfo===NULL){
            $this->terminate();
        }

        $statusArray = $this->model->getDpersStatusInfo();
        $statusKeys = Utility::getArrayWithKey('status', $statusArray);
        $statusValues = Utility::getArrayWithKey('status', $statusArray);
        $dpersStatusSelectItems = new SelectItemsModel($persinfo['dpersstatus'], $statusKeys, $statusValues);
        $persinfo['dpersstatus'] = $dpersStatusSelectItems->getSelectItemsArray();


        $oes = $this->model->getOEInfo();
        $keys = Utility::getArrayWithKey('tat', $oes);
        $values = Utility::getArrayWithKey('tat', $oes);

	$abgnrArray = $this->model->getAbgnrInfo();
	$abgnrkeys = Utility::getArrayWithKey('abgnr', $abgnrArray);
        $abgnrvalues = Utility::getArrayWithKey('abgnr', $abgnrArray);

        //bewertung1
        $bewArray =  array(0,1,3,4,5,6,7,8,9,10);
        $bew1SelectItems = new SelectItemsModel($persinfo['bewertung1'], $bewArray,$bewArray);
        $persinfo['bewertung1'] = $bew1SelectItems->getSelectItemsArray();

        //bewertung2
        $bew2SelectItems = new SelectItemsModel($persinfo['bewertung2'], $bewArray,$bewArray);
        $persinfo['bewertung2'] = $bew2SelectItems->getSelectItemsArray();

        //bewertung3
        $bew3SelectItems = new SelectItemsModel($persinfo['bewertung3'], $bewArray,$bewArray);
        $persinfo['bewertung3'] = $bew3SelectItems->getSelectItemsArray();

        //geeignet_id
        $geArray =  $this->model->getTextBuchArray('bew_geeignet', 'zahl');
        $optionArray = Utility::arrayJoinString(Utility::getArrayWithKey('text_kurz', $geArray),Utility::getArrayWithKey('text_lang', $geArray),' : ');
        $geSelectItems = new SelectItemsModel($persinfo['geeignet_id'], Utility::getArrayWithKey('id', $geArray),$optionArray);
        $persinfo['geeignet_id'] = $geSelectItems->getSelectItemsArray();

        //bew_geeignet_aktual_id
        $geArray =  $this->model->getTextBuchArray('bew_geeignet_aktual', 'zahl');
        $optionArray = Utility::arrayJoinString(Utility::getArrayWithKey('text_kurz', $geArray),Utility::getArrayWithKey('text_lang', $geArray),' : ');
        $geSelectItems = new SelectItemsModel($persinfo['bew_geeignet_aktual_id'], Utility::getArrayWithKey('id', $geArray),$optionArray);
        $persinfo['bew_geeignet_aktual_id'] = $geSelectItems->getSelectItemsArray();

        //beendet_recht_id
        $geArray =  $this->model->getTextBuchArray('beendet_recht', 'zahl');
        $optionArray = Utility::arrayJoinString(Utility::getArrayWithKey('text_kurz', $geArray),Utility::getArrayWithKey('text_lang', $geArray),' : ');
        $geSelectItems = new SelectItemsModel($persinfo['beendet_recht_id'], Utility::getArrayWithKey('id', $geArray),$optionArray);
        $persinfo['beendet_recht_id'] = $geSelectItems->getSelectItemsArray();

        //beendet_real_id
        $geArray =  $this->model->getTextBuchArray('beendet_real', 'zahl');
        $optionArray = Utility::arrayJoinString(Utility::getArrayWithKey('text_kurz', $geArray),Utility::getArrayWithKey('text_lang', $geArray),' : ');
        $geSelectItems = new SelectItemsModel($persinfo['beendet_real_id'], Utility::getArrayWithKey('id', $geArray),$optionArray);
        $persinfo['beendet_real_id'] = $geSelectItems->getSelectItemsArray();

        //nicht_eingetretten_grund_id
        $geArray =  $this->model->getTextBuchArray('nicht_eingetretten_grund', 'zahl');
        $optionArray = Utility::arrayJoinString(Utility::getArrayWithKey('text_kurz', $geArray),Utility::getArrayWithKey('text_lang', $geArray),' : ');
        $geSelectItems = new SelectItemsModel($persinfo['nicht_eingetretten_grund_id'], Utility::getArrayWithKey('id', $geArray),$optionArray);
        $persinfo['nicht_eingetretten_grund_id'] = $geSelectItems->getSelectItemsArray();

        //info_vom_id
        $geArray =  $this->model->getTextBuchArray('info_vom', 'zahl');
        $optionArray = Utility::arrayJoinString(Utility::getArrayWithKey('text_kurz', $geArray),Utility::getArrayWithKey('text_lang', $geArray),' : ');
        $geSelectItems = new SelectItemsModel($persinfo['info_vom_id'], Utility::getArrayWithKey('id', $geArray),$optionArray);
        $persinfo['info_vom_id'] = $geSelectItems->getSelectItemsArray();

        //eigen_transport_id
        $geArray =  $this->model->getTextBuchArray('eigen_transport', 'zahl');
        $optionArray = Utility::arrayJoinString(Utility::getArrayWithKey('text_kurz', $geArray),Utility::getArrayWithKey('text_lang', $geArray),' : ');
        $geSelectItems = new SelectItemsModel($persinfo['eigen_transport_id'], Utility::getArrayWithKey('id', $geArray),$optionArray);
        $persinfo['eigen_transport_id'] = $geSelectItems->getSelectItemsArray();

        //transport_id
        $tiArray =  $this->model->getKfzInfoArray(0);
        $tiSelectItems = new SelectItemsModel($persinfo['transport_id'], Utility::getArrayWithKey('id', $tiArray),Utility::getArrayWithKey('fahrzeug', $tiArray));
        $persinfo['transport_id'] = $tiSelectItems->getSelectItemsArray();

        //staat_angehoerigkeit_id
        $saArray = $this->model->getStaatenInfo();
        $saSelectItems = new SelectItemsModel($persinfo['staats_angehoerigkeit_id'], Utility::getArrayWithKey('id', $saArray),Utility::getArrayWithKey('staat_abkrz', $saArray));
        $persinfo['staats_angehoerigkeit_id'] = $saSelectItems->getSelectItemsArray();

        //erledigt
        $erledigtArray = $this->model->getAplBenutzerInfo();
        $erledigtSelectItems = new SelectItemsModel($persinfo['erledigt'], Utility::getArrayWithKey('name', $erledigtArray),Utility::getArrayWithKey('name', $erledigtArray));
        $persinfo['erledigt'] = $erledigtSelectItems->getSelectItemsArray();

        //oe_voraussichtlich
        $oeVoraussichtlichSelectItems = new SelectItemsModel($persinfo['oe_voraussichtlich'], $keys, $values);
        $persinfo['oe_voraussichtlich'] = $oeVoraussichtlichSelectItems->getSelectItemsArray();

        //abydos_agentur
        $abydos_agenturSelectItems = new SelectItemsModel($persinfo['abydos_agentur'], array('ABY','AGENT'),array('ABY','AGENT'));
        $persinfo['abydos_agentur'] = $abydos_agenturSelectItems->getSelectItemsArray();

        //beendet_vom
        $abydos_agenturSelectItems = new SelectItemsModel($persinfo['beendet_vom'], array('ABY','MA'),array('ABY','MA'));
        $persinfo['beendet_vom'] = $abydos_agenturSelectItems->getSelectItemsArray();


        $oeSelectItems = new SelectItemsModel($persinfo['regeloe'], $keys, $values);
        $alteroeSelectItems = new SelectItemsModel($persinfo['alteroe'], $keys, $values);
        $persinfo['regeloe'] = $oeSelectItems->getSelectItemsArray();
        $persinfo['alteroe'] = $alteroeSelectItems->getSelectItemsArray();

        $autoleistungAbgnrSelectItems = new SelectItemsModel($persinfo['auto_leistung_abgnr'], $abgnrkeys, $abgnrvalues);
        $persinfo['auto_leistung_abgnr'] = $autoleistungAbgnrSelectItems->getSelectItemsArray();

	//tabulka se souborama k danemu persnr
	$savePath = AplModel::getGdatPath().AplModel::getMADokumentePath().'/'.$persinfo['persnr'];
	$showPath = "GDat".substr($savePath,0);
	$this->getAjaxDriver()->savePath = $savePath;
	$this->getAjaxDriver()->persnr = $persinfo['persnr'];
	//na formulari nebudu zobrazovat realnou cestu
	$this->getAjaxDriver()->showPath = "GDat".substr($savePath,0);
	$this->getAjaxDriver()->acturl=$this->link('getNewMADokumentTable');
	// pripravim si tabulku se seznamem souboru
	$this->getAjaxDriver()->dokumentyTable = $this->getFilesTable($savePath);
	// legenda k promennym v sablonach
	$varTable = $this->getVariablesTable($persnr);
	$this->getAjaxDriver()->varTable = $varTable;
	//uploadovaci container
	$upContainer='<div id="uploader">';
	$upContainer.='<a id="pickfiles" href="javascript:;">Dateien auswaehlen</a>,<span id="showPath">'.$showPath.'</span>';
	$upContainer.='<div id="filelist"></div>';
	$upContainer.='</div>';
	$this->getAjaxDriver()->uploader = $upContainer;

        
        $sec = $this->fillSecClasses('persinfo');
        // formular pro spravu personalniho cisla
        $form = new FormPersinfo('persinfo');

        if($nurActiveMA)
            $persinfo['aktive_MA']="1";
        else
            $persinfo['aktive_MA']="0";

        $form->setControlValues($persinfo);
        $form->setActUrl($this->acturlArray);
        $form->setFormSecurityAttributes($sec);
        foreach ($form->getControls() as $name=>$control){
            $this->getAjaxDriver()->form[$name] = $control->control;
        }
        $this->terminate();

    }

    public function actionValidateNameComplete($id,$name,$nurActiveMA){

        if($nurActiveMA=='true')
            $nurActiveMA=TRUE;
        else
            $nurActiveMA=FALSE;


        $this->getAjaxDriver()->nuractiveMA = $nurActiveMA;


        $persinfoArray = $this->model->getPersnrInfoFromName($name,$nurActiveMA);

        $this->getAjaxDriver()->persnrcount = count($persinfoArray);
        $infodiv = "<div id='persnrauswaehlen'>";
        if(count($persinfoArray)>0){
            $infodiv.= "<table class='namesuchen' border='0'>";
            $infodiv.= "<tr><th>PersNr</th><th>Name</th><th>Vorname</th><th>eintritt</th><th>geboren</th></tr>";
	    $i=0;
            foreach($persinfoArray as $persinfo){
		if (($i++ % 2) == 0)
		    $class = "lichy";
		else
		    $class = "";

                $infodiv .= "<tr class='$class'>";
                $infodiv.= "<td>"."<input class='gopersnrbutton' acturl='".$this->link('validatePersnr')."' type='button' id='gopersnr_".$persinfo['persnr']."' value='".$persinfo['persnr']."' />"."</td>";
                $infodiv.= "<td>".$persinfo['name']."</td>";
                $infodiv.= "<td>".$persinfo['vorname']."</td>";
                $infodiv.= "<td>".$persinfo['eintritt']."</td>";
                $infodiv.= "<td>".$persinfo['geboren']."</td>";
                $infodiv .= "</tr>";
            }
            $infodiv.= "</table>";
        }
        $infodiv.= "</div>";

        $this->getAjaxDriver()->infodiv = $infodiv;
        $this->getAjaxDriver()->id = $id;
        $this->terminate();

    }


    public function getVariablesTable($persnr){
	$promenne = $this->getTemplateVariablesArray($persnr);
	$varTable="<table class='template_var_table'>";
	$varTable.="<tr class='tableheader'>";
	$varTable.="<th>";
	$varTable.="jmeno promenne";
	$varTable.="</th>";
	$varTable.="<th>";
	$varTable.="popis promenne";
	$varTable.="</th>";
	$varTable.="<th>";
	$varTable.="obsah promenne";
	$varTable.="</th>";

        $varTable.="</tr>";
	$i=0;
	foreach($promenne as $p=>$par){
	    if (($i++ % 2) == 0)
		$class = "lichy";
	    else
		$class = "";
	    $varTable.="<tr class='$class'>";
	    $varName = "$"."{"."$p"."}";
	    $varTable.="<td id='var_$p'>";
	    $varTable.="$varName";
	    $varTable.="</td>";
	    $varTable.="<td>";
	    $varTable.=$par['label'];
	    $varTable.="</td>";
    	    $varTable.="<td>";
	    $edit=0;
	    if(array_key_exists('edit', $par)) $edit = $par['edit'];
	    if($edit==1)
		$varTable.="<input type='text' value='".$par['value']."' id='val_$p' size='100%' />";
	    else
		$varTable.=$par['value'];
	    $varTable.="</td>";
	    $varTable.="</tr>";
	}
	$varTable.="</table>";
	return $varTable;
    }

    /**
     * 
     */
    public function actionDefault(){

        $debuginfo = '';
        $persinfo  = $this->model->getPersnrInfo($this->model->getFirstPersNrFromDpers());
	$persnr = $persinfo['persnr'];
        // pripravit hodnoty do selectu

        $oes = $this->model->getOEInfo();
        $keys = Utility::getArrayWithKey('tat', $oes);
        $values = Utility::getArrayWithKey('tat', $oes);

        $statusArray = $this->model->getDpersStatusInfo();
        $statusKeys = Utility::getArrayWithKey('status', $statusArray);
        $statusValues = Utility::getArrayWithKey('status', $statusArray);

	$abgnrArray = $this->model->getAbgnrInfo();
	$abgnrkeys = Utility::getArrayWithKey('abgnr', $abgnrArray);
        $abgnrvalues = Utility::getArrayWithKey('abgnr', $abgnrArray);

        //transport_id
        $tiArray =  $this->model->getKfzInfoArray(0);
        $tiSelectItems = new SelectItemsModel($persinfo['transport_id'], Utility::getArrayWithKey('id', $tiArray),Utility::getArrayWithKey('fahrzeug', $tiArray));
        $persinfo['transport_id'] = $tiSelectItems->getSelectItemsArray();

        //bewertung1
        $bewArray =  array(0,1,3,4,5,6,7,8,9,10);
        $bew1SelectItems = new SelectItemsModel($persinfo['bewertung1'], $bewArray,$bewArray);
        $persinfo['bewertung1'] = $bew1SelectItems->getSelectItemsArray();

        //bewertung2
        $bew2SelectItems = new SelectItemsModel($persinfo['bewertung2'], $bewArray,$bewArray);
        $persinfo['bewertung2'] = $bew2SelectItems->getSelectItemsArray();

        //bewertung3
        $bew3SelectItems = new SelectItemsModel($persinfo['bewertung3'], $bewArray,$bewArray);
        $persinfo['bewertung3'] = $bew3SelectItems->getSelectItemsArray();

        //geeignet_id
        $geArray =  $this->model->getTextBuchArray('bew_geeignet', 'zahl');
        $optionArray = Utility::arrayJoinString(Utility::getArrayWithKey('text_kurz', $geArray),Utility::getArrayWithKey('text_lang', $geArray),' : ');
        $geSelectItems = new SelectItemsModel($persinfo['geeignet_id'], Utility::getArrayWithKey('id', $geArray),$optionArray);
        $persinfo['geeignet_id'] = $geSelectItems->getSelectItemsArray();

        //bew_geeignet_aktual_id
        $geArray =  $this->model->getTextBuchArray('bew_geeignet_aktual', 'zahl');
        $optionArray = Utility::arrayJoinString(Utility::getArrayWithKey('text_kurz', $geArray),Utility::getArrayWithKey('text_lang', $geArray),' : ');
        $geSelectItems = new SelectItemsModel($persinfo['bew_geeignet_aktual_id'], Utility::getArrayWithKey('id', $geArray),$optionArray);
        $persinfo['bew_geeignet_aktual_id'] = $geSelectItems->getSelectItemsArray();

        //beendet_recht_id
        $geArray =  $this->model->getTextBuchArray('beendet_recht', 'zahl');
        $optionArray = Utility::arrayJoinString(Utility::getArrayWithKey('text_kurz', $geArray),Utility::getArrayWithKey('text_lang', $geArray),' : ');
        $geSelectItems = new SelectItemsModel($persinfo['beendet_recht_id'], Utility::getArrayWithKey('id', $geArray),$optionArray);
        $persinfo['beendet_recht_id'] = $geSelectItems->getSelectItemsArray();

        //beendet_real_id
        $geArray =  $this->model->getTextBuchArray('beendet_real', 'zahl');
        $optionArray = Utility::arrayJoinString(Utility::getArrayWithKey('text_kurz', $geArray),Utility::getArrayWithKey('text_lang', $geArray),' : ');
        $geSelectItems = new SelectItemsModel($persinfo['beendet_real_id'], Utility::getArrayWithKey('id', $geArray),$optionArray);
        $persinfo['beendet_real_id'] = $geSelectItems->getSelectItemsArray();

        //nicht_eingetretten_grund_id
        $geArray =  $this->model->getTextBuchArray('nicht_eingetretten_grund', 'zahl');
        $optionArray = Utility::arrayJoinString(Utility::getArrayWithKey('text_kurz', $geArray),Utility::getArrayWithKey('text_lang', $geArray),' : ');
        $geSelectItems = new SelectItemsModel($persinfo['nicht_eingetretten_grund_id'], Utility::getArrayWithKey('id', $geArray),$optionArray);
        $persinfo['nicht_eingetretten_grund_id'] = $geSelectItems->getSelectItemsArray();

        //info_vom_id
        $geArray =  $this->model->getTextBuchArray('info_vom', 'zahl');
        $optionArray = Utility::arrayJoinString(Utility::getArrayWithKey('text_kurz', $geArray),Utility::getArrayWithKey('text_lang', $geArray),' : ');
        $geSelectItems = new SelectItemsModel($persinfo['info_vom_id'], Utility::getArrayWithKey('id', $geArray),$optionArray);
        $persinfo['info_vom_id'] = $geSelectItems->getSelectItemsArray();

        //eigen_transport_id
        $geArray =  $this->model->getTextBuchArray('eigen_transport', 'zahl');
        $optionArray = Utility::arrayJoinString(Utility::getArrayWithKey('text_kurz', $geArray),Utility::getArrayWithKey('text_lang', $geArray),' : ');
        $geSelectItems = new SelectItemsModel($persinfo['eigen_transport_id'], Utility::getArrayWithKey('id', $geArray),$optionArray);
        $persinfo['eigen_transport_id'] = $geSelectItems->getSelectItemsArray();

        //staat_angehoerigkeit_id
        $saArray = $this->model->getStaatenInfo();
        $optionArray = Utility::arrayJoinString(Utility::getArrayWithKey('staat_abkrz', $saArray),Utility::getArrayWithKey('staat_name', $saArray),' : ');
        $saSelectItems = new SelectItemsModel($persinfo['staats_angehoerigkeit_id'], Utility::getArrayWithKey('id', $saArray),$optionArray);
        $persinfo['staats_angehoerigkeit_id'] = $saSelectItems->getSelectItemsArray();

        //erledigt
        $erledigtArray = $this->model->getAplBenutzerInfo();
        $erledigtSelectItems = new SelectItemsModel($persinfo['erledigt'], Utility::getArrayWithKey('name', $erledigtArray),Utility::getArrayWithKey('name', $erledigtArray));
        $persinfo['erledigt'] = $erledigtSelectItems->getSelectItemsArray();

        //oe_voraussichtlich
        $oeVoraussichtlichSelectItems = new SelectItemsModel($persinfo['oe_voraussichtlich'], $keys, $values);
        $persinfo['oe_voraussichtlich'] = $oeVoraussichtlichSelectItems->getSelectItemsArray();

        //abydos_agentur
        $abydos_agenturSelectItems = new SelectItemsModel($persinfo['abydos_agentur'], array('ABY','AGENT'),array('ABY','AGENT'));
        $persinfo['abydos_agentur'] = $abydos_agenturSelectItems->getSelectItemsArray();

        //beendet_vom
        $abydos_agenturSelectItems = new SelectItemsModel($persinfo['beendet_vom'], array('ABY','MA'),array('ABY','MA'));
        $persinfo['beendet_vom'] = $abydos_agenturSelectItems->getSelectItemsArray();

        // regeloe
        $oeSelectItems = new SelectItemsModel($persinfo['regeloe'], $keys, $values);
        $alteroeSelectItems = new SelectItemsModel($persinfo['alteroe'], $keys, $values);
        $persinfo['regeloe'] = $oeSelectItems->getSelectItemsArray();
        $persinfo['alteroe'] = $alteroeSelectItems->getSelectItemsArray();

        //dpersstatus
        $dpersStatusSelectItems = new SelectItemsModel($persinfo['dpersstatus'], $statusKeys, $statusValues);
        $dpersStatus = $persinfo['dpersstatus'];
        $persinfo['dpersstatus'] = $dpersStatusSelectItems->getSelectItemsArray();

        $autoleistungAbgnrSelectItems = new SelectItemsModel($persinfo['auto_leistung_abgnr'], $abgnrkeys, $abgnrvalues);
        $persinfo['auto_leistung_abgnr'] = $autoleistungAbgnrSelectItems->getSelectItemsArray();

        $this->template->persinfo = $persinfo;

        // pripravim si pole s tridama podle uzivatelovo opravneni
        $sec = $this->fillSecClasses('persinfo');

        // formular pro spravu personalniho cisla
        $form = new FormPersinfo('persinfo');
        $persinfo['aktive_MA'] = "1";
        $form->setControlValues($persinfo);
        $form->setActUrl($this->acturlArray);
        $form->setFormSecurityAttributes($sec);
        $this->template->form = $form;
        $this->template->debuginfo = $debuginfo;

	//tabulka se souborama k danemu persnr
	$savePath = AplModel::getGdatPath().AplModel::getMADokumentePath().'/'.$persinfo['persnr'];
	$this->template->savePath = $savePath;
	$this->template->persnr = $persinfo['persnr'];
	//na formulari nebudu zobrazovat realnou cestu
	$showPath = "GDat".substr($savePath,0);
	$this->template->showPath = $showPath;
	$this->template->acturl=$this->link('getNewMADokumentTable');
	// pripravim si tabulku se seznamem souboru
	$this->template->dokumentyTable = $this->getFilesTable($savePath);
	
	//uploadovaci container
	$upContainer='<div id="uploader">';
	$upContainer.='<a id="pickfiles" href="javascript:;">Dateien auswaehlen</a>,<span id="showPath">'.$showPath.'</span>';
	$upContainer.='<div id="filelist"></div>';
	$upContainer.='</div>';
	$this->template->uploader = $upContainer;
	//pripravit tabulku s sablonama dokumentu
	$dokumenteTemplatesPath = AplModel::getGdatPath().AplModel::getMATemplatesPath();
	$this->template->templatespath = $dokumenteTemplatesPath;
	$this->template->templatestable = $this->getFilesTableTemplates($dokumenteTemplatesPath);
	$this->template->acturl_makePersDoku = $this->link('makePersDoku');
	// legenda k promennym v sablonach
	$varTable = $this->getVariablesTable($persnr);
	$this->template->varTable = $varTable;
    }

     /**
     *
     * @param int $persnr 
     * @return array struktura je 'jmeno promennr'=>array('pindex'=>index v persinfu,'label'=>popisek promenne,'value'=>hodnota promenne
     */

    public function getTemplateVariablesArray($persnr) {
	
	// jmeno promenne=>array(jmeno indexu z persinfo, popis promenne, hodnota promenne)
	$promenneArray = array(
	    'name' => array('pindex'=>'name', 'label'=>'prijmeni pracovnika','value'=>''),
	    'vorname' => array('pindex'=>'vorname', 'label'=>'krestni jmeno pracovnika','value'=>''),
	    'persnr' => array('pindex'=>'persnr', 'label'=>'osobni cislo pracovnika','value'=>''),
	    'eintritt' => array('pindex'=>'eintritt', 'label'=>'datum nastupu pracovnika','value'=>''),
	    'austritt' => array('pindex'=>'austritt', 'label'=>'datum ukonceni prac. pomeru pracovnika','value'=>''),
	    'geboren' => array('pindex'=>'geboren', 'label'=>'datum narozeni pracovnika','value'=>''),
	    'strasse_op' => array('pindex'=>'strasse_op', 'label'=>'trvale bydliste - ulice','value'=>''),
	    'ort_op' => array('pindex'=>'ort_op', 'label'=>'trvale bydliste - mesto','value'=>''),
	    'plz_op' => array('pindex'=>'plz_op', 'label'=>'trvale bydliste - PSC','value'=>''),
	    'strasse_aktuell' => array('pindex'=>'strasse', 'label'=>'dorucovaci bydliste - ulice','value'=>''),
	    'ort_aktuell' => array('pindex'=>'komm_ort', 'label'=>'dorucovaci bydliste - mesto','value'=>''),
	    'plz_aktuell' => array('pindex'=>'plz', 'label'=>'dorucovaci bydliste - psc','value'=>''),
	    'regeloe' => array('pindex'=>'regeloe', 'label'=>'smena = OE','value'=>''),
	    'geburtsort' => array('pindex'=>'gebort', 'label'=>'misto narozeni','value'=>''),
	);

	$persinfo  = $this->model->getPersnrInfo($persnr);
	$saArray = $this->model->getStaatenInfo($persinfo['staats_angehoerigkeit_id']);
	$user = Environment::getUser();
	// specialni promenne, kterym nastavim hodnotu uz zde
	// prihlaseny uzivatel
	$promenna = 'user';
	$popis = 'jmeno prihlaseneho uzivatele';
	$promenneArray[$promenna] = array('pindex'=>'','label'=>$popis,'value'=>$user->getIdentity()->getName(),'edit'=>0);
	// skolitel, defaultne nastavim na prihlaseneho uzivatele
	$promenna = 'skolitel';
	$popis = 'skolitel, vychozi = jmeno prihlaseneho uzivatele';
	$promenneArray[$promenna] = array('pindex'=>'','label'=>$popis,'value'=>$user->getIdentity()->getName(),'edit'=>1);
	// aktualni datum
	$promenna = 'aktdatum';
	$popis = 'aktualni datum';
	$promenneArray[$promenna] = array('pindex'=>'','label'=>$popis,'value'=>date('d.m.Y'));
	// stat
	$promenna = 'stat';
	$popis = 'stat';
	$promenneArray[$promenna] = array('pindex'=>'','label'=>$popis,'value'=>$saArray[0]['staat_name']);
	// befristet datum
	$promenna = 'befristetdatum';
	$popis = 'doba určitá datum';
	$promenneArray[$promenna] = array('pindex'=>'','label'=>$popis,'value'=>$this->model->getBefristetDatum($persnr));
	// probezeit datum
	$promenna = 'probezeitdatum';
	$popis = 'zkusebni doba datum';
	$promenneArray[$promenna] = array('pindex'=>'','label'=>$popis,'value'=>$this->model->getProbezeitDatum($persnr));

	// uzivatelska promenna
	$promenna = 'var1';
	$popis = 'uzivatelska promenna 1';
	$promenneArray[$promenna] = array('pindex'=>'','label'=>$popis,'value'=>'','edit'=>1);

	$promenna = 'var2';
	$popis = 'uzivatelska promenna 2';
	$promenneArray[$promenna] = array('pindex'=>'','label'=>$popis,'value'=>'','edit'=>1);
	
	$promenna = 'var3';
	$popis = 'uzivatelska promenna 3';
	$promenneArray[$promenna] = array('pindex'=>'','label'=>$popis,'value'=>'','edit'=>1);

	ksort($promenneArray);
	
	// prirazeni hodnot z persinfa
	foreach ($promenneArray as $promenna=>$param){
	    if(strlen($param['pindex'])>0){
		$promenneArray[$promenna]['value']=$persinfo[$param['pindex']];
	    }
	}
	return $promenneArray;
    }

    public function actionMakePersDoku($id, $persnr, $templates,$vals,$ids) {
	$this->getAjaxDriver()->id = $id;
	$this->getAjaxDriver()->persnr = $persnr;
	$persinfo  = $this->model->getPersnrInfo($persnr);
	$this->getAjaxDriver()->persinfo = $persinfo;
	$t = explode(';', $templates);
	$this->getAjaxDriver()->templates = $t;
	$this->getAjaxDriver()->vals = $vals;
	$valsArray = explode(';',$vals);
	$idsArray = explode(';',$ids);
	$this->getAjaxDriver()->valsArray = $valsArray;
	$this->getAjaxDriver()->idsArray = $idsArray;
	$this->getAjaxDriver()->valInArray = 0;
	$this->getAjaxDriver()->ids = $ids;
	//$this->terminate();
	
	
	$pw = new PHPWord();
	$this->getAjaxDriver()->dfs = $pw->getDefaultFontName();
	// jmeno promenne v sablone => array('pindex'=>index v persinfo,'label'=>popis vyznamu promenne,'value'=>hodnota promenne)
	$promenneArray = $this->getTemplateVariablesArray($persnr);
	$this->getAjaxDriver()->promenneArray = $promenneArray;
	if (is_array($t)) {
	    foreach ($t as $templ) {
		//$pw = new PHPWord();
		$templatePath = AplModel::getGdatPath() . AplModel::getMATemplatesPath() . '/' . $templ;
		$this->getAjaxDriver()->templatePath = $templatePath;
		$d = $pw->loadTemplate($templatePath);
		// prirazeni hodnot promennym
		foreach ($promenneArray as $promenna=>$param){
		    $value = $param['value'];
		    //test jestli nemam promennou zadanou rucne z tabulky
		    $index = in_array($promenna, $idsArray);
		    if($index===TRUE){
			//najit index
			$index=0;
			foreach ($idsArray as $id){
			    if($id==$promenna) break;
			    $index++;
			}
			$value = $valsArray[$index];
		    }
		    $d->setValue($promenna,$value);
		}
		
		// ulozeni noveho dokumentu
		$filename = substr($templ, 0, strrpos($templ, '.')) . '_' . $persnr . '_' . date('ymdHis') . substr($templ, strrpos($templ, '.'));
		$savePath = AplModel::getGdatPath() . AplModel::getMADokumentePath() . '/' . $persnr . '/' . $filename;
		$saveOnlyPath = AplModel::getGdatPath() . AplModel::getMADokumentePath() . '/' . $persnr;
		$this->getAjaxDriver()->savePath = $savePath;
		// pred ulozenim je potreba vytvorit slozku pro dane persnr, pokud neexistuje
		$dirExists = file_exists($saveOnlyPath);
		if (!$dirExists) {
		    // vytvorit slozku
		    if (mkdir($saveOnlyPath, 0777, TRUE)) {
			$d->save($savePath);
		    }
		}
		else{
		    $d->save($savePath);
		}
	    }
	}
	$this->actionGetNewMADokumentTable($persnr);
	//$this->terminate();
    }

    public function actionGetNewMADokumentTable($persnr){
	//tabulka se souborama k danemu persnr
	$savePath = AplModel::getGdatPath().AplModel::getMADokumentePath().'/'.$persnr;
	// pripravim si tabulku se seznamem souboru
	$this->getAjaxDriver()->dokumentyTable = $this->getFilesTable($savePath);
        $this->terminate();
    }
    
    private function getFilesTable($path) {
	$files = AplModel::getFilesForPath($path);
	$dokladyDiv = '';
	if ($files !== NULL) {
	    $dokladyDiv = "<table id='rekl_doklady_table' class='dokumenty_table'>";
	    $i = 0;
	    foreach ($files as $dokument) {
		if (($i % 2) == 0)
		    $class = "lichy";
		else
		    $class = "";
		
		$filetypeClass = $dokument['ext'];
		$i++;
		$dokladyDiv.= "<tr class='$class'>";
		$dokladyDiv.= "<td>";
		$href = $dokument['url'];
		$dokladyDiv.= "<a class='$filetypeClass' target='_blank' href='$href'>" . $dokument['filename'] . "</a>";
		$dokladyDiv.= "</td>";
		$dokladyDiv.= "<td style='width:200px;text-align: right;'>";
		$dokladyDiv.= "" . date('Y-m-d H:i:s',$dokument['mtime']);
		$dokladyDiv.= "</td>";
		$dokladyDiv.= "<td style='width:200px;text-align: right;'>";
		$dokladyDiv.= "" . $dokument['size'];
		$dokladyDiv.= "</td>";
		$dokladyDiv.= "</tr>";
	    }
	    $dokladyDiv.= "</table>";
	}
	return $dokladyDiv;
    }

    	private function getFilesTableTemplates($path) {
	$files = AplModel::getFilesForPath($path);
	$dokladyDiv = '';
	if ($files !== NULL) {
	    $dokladyDiv = "<table id='rekl_doklady_table' class='dokumenty_table'>";
	    $i = 0;
	    foreach ($files as $dokument) {
		// zobrazim jen sablony s docx
		$filetypeClass = $dokument['ext'];
		if ($filetypeClass == "DOCX") {
		    if (($i % 2) == 0)
			$class = "lichy";
		    else
			$class = "";


		    $i++;
		    $dokladyDiv.= "<tr class='$class'>";
		    $dokladyDiv.= "<td>";
		    $href = $dokument['url'];
		    $dokladyDiv.= "<a class='$filetypeClass' target='_blank' href='$href'>" . $dokument['filename'] . "</a>";
		    $dokladyDiv.= "</td>";
		    $dokladyDiv.= "<td style='width:200px;text-align: right;'>";
		    $dokladyDiv.= "" . date('Y-m-d H:i:s', $dokument['mtime']);
		    $dokladyDiv.= "</td>";
		    $dokladyDiv.= "<td style='width:200px;text-align: right;'>";
		    $dokladyDiv.= "" . $dokument['size'];
		    $dokladyDiv.= "</td>";
		    $dokladyDiv.= "<td style='width:200px;text-align: center;'>";
		    $dokladyDiv.= "<input type='checkbox' id='" . $dokument['filename'] . "' class='template_checkbox' />";
		    $dokladyDiv.= "</td>";
		    $dokladyDiv.= "</tr>";
		}
	    }
	    $dokladyDiv.= "</table>";
	}
	return $dokladyDiv;
    }

    protected function beforeRender(){
         parent::beforeRender();
    }
}
?>
