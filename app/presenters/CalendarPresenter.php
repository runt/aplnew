<?php
/**
 *
 * Description of CalendarPresenter
 *
 * @author runt
 */
class CalendarPresenter extends BasePresenter{

    public $mesic;
    public $rok;

    protected function startup(){
//        $this->rok = date('Y');
//        $this->mesic = date('m');
        parent::startup();
    }

    // persistentni promenne
    public static function getPersistentParams(){
        return array('mesic','rok');
    }


    public function actionDefault(){
        // nastavim do template aktualni rok a mesic

        $this->rok = date('Y');
        $this->mesic = date('m');

        $rokMesic = $this->rok."-".$this->mesic;
        $this->template->rokmesic = $rokMesic;
    }

    public function renderDefault(){
          $security = $this->fillSecClasses('calendaredit');
          $this->template->form_id = $security['form_id'];
          $this->template->secclasses = $security['secclasses'];
    }
    /**
     *
     * @param <type> $elementid
     * @param <type> $persnr
     * @param <type> $monatjahr
     */
    public function actionValidateMonatJahr($elementid,$persnr,$monatjahr){
        $this->getAjaxDriver()->elementid = $elementid;
        $this->getAjaxDriver()->monatjahr = $monatjahr;

        // rozeberu si retezec monatjahr
        // musi byt ve tvaru YYYY-MM
        $pole = split("-", $monatjahr);
        if((is_array($pole))&(count($pole)>1)){
            $rok = $pole[0];
            $mesic = $pole[1];
            $this->getAjaxDriver()->monat = $mesic;
            $this->getAjaxDriver()->jahr = $rok;
            // kontrola smysluplnosti roku a mesice
            // 1. rok nebudu planovat dozadu
            $aktualniRok = date('Y');
            if($rok<$aktualniRok){
                $this->getAjaxDriver()->calendarinfo = null;
                $this->terminate();
            }
            // 2. mesic musi byt mezi 1 a 12
            if($mesic<1 || $mesic>12){
                $this->getAjaxDriver()->calendarinfo = null;
                $this->terminate();
            }

            $this->mesic = $mesic;
            $this->rok = $rok;
            
            // kdyz dojdu az sem zkusim vytahnout info o planu pro dany datum a personalni cislo
            $aplDB = new AplModel();
            $calendarinfo = $aplDB->getCalendarInfo($rok,$mesic);
            $this->getAjaxDriver()->calendarinfo = $calendarinfo;

//
//            // a ajaxoveurl pro updatovani selectu a inputu
              $this->getAjaxDriver()->ajaxurl_svatek = $this->link('updateSvatek');
              $this->getAjaxDriver()->ajaxurl_vonbisinput = $this->link('updatevonbis');
//            $this->getAjaxDriver()->ajaxurl_newdatumbutton = $this->link('planDatumAdd');
//            $this->getAjaxDriver()->ajaxurl_deletebutton = $this->link('planDatumDelete');
        }
        else
            $this->getAjaxDriver()->planinfo = null;


        $this->terminate();
    }

    public function actionFillvonbis($elementid,$monatjahr,$value,$von,$bis){
        $this->getAjaxDriver()->elementid = $elementid;
        $this->getAjaxDriver()->value = $value;
        $this->getAjaxDriver()->monatjahr = $monatjahr;

        $element2DBFieldArray = array(
            'fill_guss_f_von'=>'von_f_guss',
            'fill_guss_f_bis'=>'bis_f_guss',
            'fill_guss_s_von'=>'von_s_guss',
            'fill_guss_s_bis'=>'bis_s_guss',
            'fill_ne_f_von'=>'von_f_ne',
            'fill_ne_f_bis'=>'bis_f_ne',
            'fill_ne_s_von'=>'von_s_ne',
            'fill_ne_s_bis'=>'bis_s_ne',
            );
        // vyrobim si nazvy policek
        // id je ve tvaru je button_fill_guss_f
        // a potrebuju ziskat dva nazvy fill_guss_f_von a fill_guss_f_bis
        // najdu prvni podtrzitko
        $prvniPodtrzitko = strpos($elementid, '_');
        $fieldvon = substr($elementid, $prvniPodtrzitko+1)."_von";
        $fieldbis = substr($elementid, $prvniPodtrzitko+1)."_bis";
        $this->getAjaxDriver()->fieldvon = $element2DBFieldArray[$fieldvon];
        $this->getAjaxDriver()->fieldbis = $element2DBFieldArray[$fieldbis];
        $this->getAjaxDriver()->vonvalue = $von;
        $this->getAjaxDriver()->bisvalue = $bis;

        $apl = new AplModel();
        // 1 = neprepisovat puvodni hodnoty
        $jahr = substr($monatjahr, 0, 4);
        $monat = substr($monatjahr, 6, 2);
        $apl->fillMonatVonBis($jahr, $monat, $element2DBFieldArray[$fieldvon], $von,1);
        $apl->fillMonatVonBis($jahr, $monat, $element2DBFieldArray[$fieldbis], $bis,1);
        $this->terminate();
    }

    public function actionUpdatevonbis($elementid,$value){
        $this->getAjaxDriver()->elementid = $elementid;
        $this->getAjaxDriver()->value = $value;
        // rozeberu elementid na jmeno pole v databazi a datum
        $datum = substr($elementid, -10);
        $field = substr($elementid, 0, strlen($elementid)-10-1);
        $this->getAjaxDriver()->datum = $datum;
        $this->getAjaxDriver()->field = $field;
        // a ted budu pracovat s value
        $obsah = trim($value);
        if(strlen($obsah)==0)
            $obsah = null;
        else{
            //zkusim najit dvojtecku
            $casArray = split(':', $obsah);
            if(count($casArray)>1){
                // cas obsahuje dvojtecku, vezmu si prvni dva prvky z pole, hodiny a minuty
                $hodiny = intval($casArray[0]);
                $minuty = intval($casArray[1]);
            }
            else{
                // nemam tam dvojtecku tak budu predpokladat tvar HHMM
                $hodiny = intval(substr($obsah, 0,2));
                $minuty = intval(substr($obsah, 2,2));
            }
            // vyrobim z toho format HH:MM
            if($hodiny>=0 && $hodiny<24 && $minuty>=0 && $minuty<60){
                $obsah = sprintf("%02d:%02d",$hodiny,$minuty);
            }
            else
                $obsah = null;
        }
        $this->getAjaxDriver()->hhmm = $obsah;

        // pokud jen kontroluju fill formular nebudu updatovat v databazi
        if(strstr($elementid, 'fill_'))
                $this->terminate();
        
        // a provedu zapis do DB
        $aplDB = new AplModel();
        $affectedRows = $aplDB->updateCalendarVonbisField($field,$datum,$obsah);
        $this->getAjaxDriver()->affectedrows = $affectedRows;

        $this->terminate();
    }


    /**
     *
     * @param string $elementid
     * @param string $value 
     */
    public function actionUpdateSvatek($elementid,$value){
        $this->getAjaxDriver()->elementid = $elementid;
        if($value=='true')
            $hodnota = 1;
        else
            $hodnota = 0;

        $field_id = split('_',$elementid);
        $datum = $field_id[1];

        $this->getAjaxDriver()->value = $value;
        $this->getAjaxDriver()->hodnota = $hodnota;
        $this->getAjaxDriver()->datum = $datum;

        $aplDB = new AplModel();
        $affectedRows = $aplDB->updateSvatekOnDatum($datum,$hodnota);
        $this->getAjaxDriver()->affectedrows = $affectedRows;

        $this->terminate();
    }


    public function actionPlanDatumDelete($elementid){
        $this->getAjaxDriver()->elementid = $elementid;
        $aplDB = new AplModel();
        // rozdelim si value na id radku a hodnotu
        $field_id = split("_", $elementid);
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
        $field_id = split("_", $elementid);
        $field = $field_id[0];
        $id = $field_id[1];
        $this->getAjaxDriver()->field = $field;
        $this->getAjaxDriver()->id = $id;

        //podle id vytvorim kopii radku v tabulce dzeitsoll
        $lastid = $aplDB->datumAddFromId($id);
        $this->getAjaxDriver()->lastid = $lastid;

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
        $field_id = split("_", $elementid);
        $field = $field_id[0];
        $id = $field_id[1];



        $this->getAjaxDriver()->field = $field;
        $this->getAjaxDriver()->id = $id;

        $affectedrows = $aplDB->updateDZeitsoll($field,$id,$value);
        $this->getAjaxDriver()->affectedrows = $affectedrows;

        // podle hodnoty v selectu musu udelat i navrh na pocet hodin
        if($field=='oe') {
            $oestatus = $aplDB->getOEStatusForOE($value);
            $stunden = 0;
            if($oestatus=='a' || $oestatus=='ap') {
            //                $stunden = 8;
                $stunden = $aplDB->getRegelarbzeit($this->persnr);
            }

            $this->getAjaxDriver()->pers = $this->persnr;
            $this->getAjaxDriver()->stunden = $stunden;
            $this->getAjaxDriver()->oestatus = $oestatus;

            // vypocet prescasovych hodin
            $plusMinusKontoA = $aplDB->getPlusMinusStunden($this->mesic, $this->rok, $this->persnr);
            $this->getAjaxDriver()->plusminusstunden = $plusMinusKontoA;

        }

        if($field=='stunden') {
        // rozeberu si retezec monatjahr
        // musi byt ve tvaru YYYY-MM
            $pole = split("-", $monatjahr);
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


}
?>
