<?php
/**
 * definice formulare s informacemi o pracovnikovi
 *
 * @author runt
 */
class FormPersinfo extends Form {

    private $elements = array(

                // bewerber elements

        'bewerb_datum'=>array(
            'bezeichnung'=>'Bewerbdatum',
            'secured'=>false,
            'type'=>'text',
            'size'=>10,
            'maxlength'=>10,
            'dbfield'=>'bewerbe_datumF',
            ),

//        'aufenthaltsort'=>array(
//            'bezeichnung'=>'Aufenthaltsort',
//            'secured'=>false,
//            'type'=>'text',
//            'size'=>10,
//            'maxlength'=>255,
//            'dbfield'=>'aufenthalts_ort',
//            ),

        'staats_angehoerigkeit_id'=>array(
            'bezeichnung'=>'Staatsangehoerigkeit',
            'secured'=>true,
            'type'=>'select',
            'dbfield'=>'staats_angehoerigkeit_id',
            ),
        'geeignet_id'=>array(
            'bezeichnung'=>'fur Aby geeignet',
            'secured'=>false,
            'type'=>'select',
            'dbfield'=>'geeignet_id',
            ),
        'bew_geeignet_aktual_id'=>array(
            'bezeichnung'=>'fur Aby geeignet aktuell',
            'secured'=>false,
            'type'=>'select',
            'dbfield'=>'bew_geeignet_aktual_id',
            ),
        'beendet_recht_id'=>array(
            'bezeichnung'=>'beendet Grund rechtl.',
            'secured'=>false,
            'type'=>'select',
            'dbfield'=>'beendet_recht_id',
            ),
        'beendet_real_id'=>array(
            'bezeichnung'=>'beendet Grund real',
            'secured'=>false,
            'type'=>'select',
            'dbfield'=>'beendet_real_id',
            ),
        'nicht_eingetretten_grund_id'=>array(
            'bezeichnung'=>'nicht eingetr. Grund',
            'secured'=>false,
            'type'=>'select',
            'dbfield'=>'nicht_eingetretten_grund_id',
            ),
        'info_vom_id'=>array(
            'bezeichnung'=>'Info vom',
            'secured'=>false,
            'type'=>'select',
            'dbfield'=>'info_vom_id',
            ),
        'eigen_transport_id'=>array(
            'bezeichnung'=>'Transport',
            'secured'=>false,
            'type'=>'select',
            'dbfield'=>'eigen_transport_id',
            ),
        'bewertung1'=>array(
            'bezeichnung'=>'Bewertung1',
            'secured'=>false,
            'type'=>'select',
            'dbfield'=>'bewertung1',
            ),
        'bewertung2'=>array(
            'bezeichnung'=>'Bewertung2',
            'secured'=>false,
            'type'=>'select',
            'dbfield'=>'bewertung2',
            ),
        'bewertung3'=>array(
            'bezeichnung'=>'Bewertung3',
            'secured'=>false,
            'type'=>'select',
            'dbfield'=>'bewertung3',
            ),

        'transport_id'=>array(
            'bezeichnung'=>'Eigen. Transp.',
            'secured'=>false,
            'type'=>'select',
            'readonly'=>'readonly',
            'dbfield'=>'transport_id',
            ),

        'oe_voraussichtlich'=>array(
            'bezeichnung'=>'OE voraussichtl.',
            'secured'=>false,
            'type'=>'select',
            'dbfield'=>'oe_voraussichtlich',
            ),

        'bewertung_bemerkung'=>array(
            'bezeichnung'=>'Bewertung Bemerkung',
            'secured'=>false,
            'type'=>'text',
            'size'=>30,
            'maxlength'=>255,
            'dbfield'=>'bewertung_bemerkung',
            ),

//	'uebergang'=>array(
//            'bezeichnung'=>'Uebergang',
//            'secured'=>false,
//            'type'=>'text',
//            'size'=>10,
//            'maxlength'=>255,
//            'dbfield'=>'uebergang',
//            ),

        'eintritt_datum'=>array(
            'bezeichnung'=>'voraussichtl. Eintritt',
            'secured'=>false,
            'type'=>'text',
            'size'=>10,
            'maxlength'=>255,
            'dbfield'=>'eintritt_datumF',
            ),
	'aktual_info_bemerkung'=>array(
            'bezeichnung'=>'Aktual Info',
            'secured'=>false,
            'type'=>'text',
            'size'=>40,
            'maxlength'=>255,
            'dbfield'=>'aktual_info_bemerkung',
            ),

	'nicht_eingetreten_grund'=>array(
            'bezeichnung'=>'nicht eingetretten Grund',
            'secured'=>false,
            'type'=>'text',
            'size'=>10,
            'maxlength'=>255,
            'dbfield'=>'nicht_eingetreten_grund',
            ),
	'bemerkung_sonst'=>array(
            'bezeichnung'=>'Bemerkung sonst.',
            'secured'=>false,
            'type'=>'text',
            'size'=>40,
            'maxlength'=>255,
            'dbfield'=>'bemerkung_sonst',
            ),
	'gebort'=>array(
            'bezeichnung'=>'Geb. Ort',
            'secured'=>false,
            'type'=>'text',
            'size'=>20,
            'maxlength'=>255,
            'dbfield'=>'gebort',
            ),

        'info_vom'=>array(
            'bezeichnung'=>'Info vom',
            'secured'=>false,
            'type'=>'text',
            'size'=>10,
            'maxlength'=>32,
            'dbfield'=>'info_vom',
            ),

	'erledigt'=>array(
            'bezeichnung'=>'erledigt',
            'secured'=>false,
            'type'=>'select',
            'size'=>10,
            'maxlength'=>255,
            'dbfield'=>'erledigt',
            ),
	'abydos_agentur'=>array(
            'bezeichnung'=>'Abydos/Agentur',
            'secured'=>false,
            'type'=>'select',
            'size'=>10,
            'maxlength'=>255,
            'dbfield'=>'abydos_agentur',
            ),
	'arbamt_evidenz'=>array(
            'bezeichnung'=>'Arbamtevidenz',
            'secured'=>false,
            'type'=>'checkbox',
            'dbfield'=>'arbamt_evidenz',
            ),
	'vom_arb_amt_gekommen'=>array(
            'bezeichnung'=>'vom Arbamt gekommen',
            'secured'=>false,
            'type'=>'checkbox',
            'dbfield'=>'vom_arb_amt_gekommen',
            ),
	'gestraft'=>array(
            'bezeichnung'=>'bestraft',
            'secured'=>false,
            'type'=>'checkbox',
            'dbfield'=>'gestraft',
            ),
	'exekution'=>array(
            'bezeichnung'=>'Exekution',
            'secured'=>false,
            'type'=>'checkbox',
            'dbfield'=>'exekution',
            ),
	'vertragb'=>array(
            'bezeichnung'=>'Vertrag',
            'secured'=>false,
            'type'=>'checkbox',
            'dbfield'=>'vertrag',
            ),
	'artzt_eingang_untersuchung'=>array(
            'bezeichnung'=>'Artzuntersuchung Eingang',
            'secured'=>false,
            'type'=>'checkbox',
            'dbfield'=>'artzt_eingang_untersuchung',
            ),
//	'schuhe_groesse'=>array(
//            'bezeichnung'=>'Schuhengroesse',
//            'secured'=>false,
//            'type'=>'text',
//            'size'=>10,
//            'maxlength'=>255,
//            'dbfield'=>'schuhe_groesse',
//            ),


	'berufskrankheit_gefahr'=>array(
            'bezeichnung'=>'Berufskrankheitgefahr',
            'secured'=>false,
            'type'=>'text',
            'size'=>10,
            'maxlength'=>255,
            'dbfield'=>'berufskrankheit_gefahr',
            ),
	'lehrer'=>array(
            'bezeichnung'=>'Lehrer/Skolitel (PersNr)',
            'secured'=>false,
            'type'=>'text',
            'size'=>10,
            'maxlength'=>255,
            'dbfield'=>'lehrer',
            ),
	'meister'=>array(
            'bezeichnung'=>'Meister (PersNr)',
            'secured'=>false,
            'type'=>'text',
            'size'=>10,
            'maxlength'=>255,
            'dbfield'=>'meister',
            ),
	'bewertung_schul_schicht'=>array(
            'bezeichnung'=>'Bewertung Schulschicht',
            'secured'=>false,
            'type'=>'text',
            'size'=>10,
            'maxlength'=>255,
            'dbfield'=>'bewertung_schul_schicht',
            ),
	'wettbewerb_1000_CZK'=>array(
            'bezeichnung'=>'Wettbewerb 1000CZK (PersNr)',
            'secured'=>false,
            'type'=>'text',
            'size'=>5,
            'maxlength'=>6,
            'dbfield'=>'wettbewerb_1000_CZK',
            ),
	'artzt_ausgang'=>array(
            'bezeichnung'=>'Artzuntersuchung Ausgang',
            'secured'=>false,
            'type'=>'checkbox',
            'dbfield'=>'artzt_ausgang',
            ),
	'beendet_vom'=>array(
            'bezeichnung'=>'beendet vom',
            'secured'=>false,
            'type'=>'select',
            'size'=>10,
            'maxlength'=>255,
            'dbfield'=>'beendet_vom',
            ),
	'leistung_bewertung'=>array(
            'bezeichnung'=>'Leistungbewertung',
            'secured'=>false,
            'type'=>'text',
            'size'=>2,
            'maxlength'=>3,
            'dbfield'=>'leistung_bewertung',
            ),
	'stunden_durchschnitt'=>array(
            'bezeichnung'=>'Stundendurchschnitt',
            'secured'=>false,
            'type'=>'text',
            'size'=>10,
            'maxlength'=>255,
            'dbfield'=>'stunden_durchschnitt',
            ),
	'ausgang_bemerkung'=>array(
            'bezeichnung'=>'Ausgangsbemerkung',
            'secured'=>false,
            'type'=>'text',
            'size'=>40,
            'maxlength'=>255,
            'dbfield'=>'ausgang_bemerkung',
            ),

        // personalinfo elements
        'namesuchen'=>array(
            'bezeichnung'=>'Name ( suchen ) :',
            'secured'=>false,
            'type'=>'text',
            'size'=>10,
            'maxlength'=>50,
            'dbfield'=>'',
            ),
        'persnr'=>array(
            'bezeichnung'=>'PersNr:',
            'secured'=>false,
            'type'=>'text',
            'size'=>5,
            'maxlength'=>5,
            'dbfield'=>'persnr',
            ),
        'aktive_MA'=>array(
            'bezeichnung'=>'nur aktive MA',
            'secured'=>TRUE,
            'type'=>'checkbox',
            'dbfield'=>'aktive_MA',
            ),


        'name'=>array(
            'bezeichnung'=>'Name',
            'secured'=>true,
            'type'=>'text',
            'size'=>20,
            'maxlength'=>50,
            'dbfield'=>'name',
            ),

        'vorname'=>array(
            'bezeichnung'=>'Vorname',
            'secured'=>true,
            'type'=>'text',
            'size'=>20,
            'maxlength'=>50,
            'dbfield'=>'vorname',
            ),

        'abkrz'=>array(
            'bezeichnung'=>'Abkuerzung:',
            'secured'=>true,
            'type'=>'text',
            'size'=>4,
            'maxlength'=>10,
            'dbfield'=>'abkrz',
            ),

        'tf_eintrittsdatum'=>array(
            'bezeichnung'=>'Eintritt',
            'secured'=>true,
            'type'=>'text',
            'size'=>10,
            'readonly'=>'readonly',
            'maxlength'=>10,
            'dbfield'=>'eintritt',
            ),

        'tf_austritt'=>array(
            'bezeichnung'=>'Austritt',
            'secured'=>true,
            'readonly'=>'readonly',
            'type'=>'text',
            'size'=>10,
            'maxlength'=>10,
            'dbfield'=>'austritt',
            ),

        'dobaurcita'=>array(
            'bezeichnung'=>'Befristet',
            'secured'=>TRUE,
            'readonly'=>'readonly',
            'type'=>'text',
            'size'=>10,
            'maxlength'=>10,
            'dbfield'=>'dobaurcita',
            ),

        'zkusebni_doba_dobaurcita'=>array(
            'bezeichnung'=>'Probezeit',
            'secured'=>TRUE,
            'readonly'=>'readonly',
            'type'=>'text',
            'size'=>10,
            'maxlength'=>10,
            'dbfield'=>'zkusebni_doba_dobaurcita',
            ),

        'tf_geboren'=>array(
            'bezeichnung'=>'geboren',
            'secured'=>true,
            'size'=>10,
            'maxlength'=>10,
            'type'=>'text',
            'dbfield'=>'geboren',
            ),

        'tf_handy'=>array(
            'bezeichnung'=>'Handy',
            'secured'=>true,
            'size'=>16,
            'maxlength'=>50,
            'type'=>'text',
            'dbfield'=>'kom7',
            ),
	'tf_email'=>array(
            'bezeichnung'=>'Email',
            'secured'=>false,
            'size'=>32,
            'maxlength'=>255,
            'type'=>'text',
            'dbfield'=>'email',
            ),
        'strasse'=>array(
            'bezeichnung'=>'Strasse aktuell',
            'secured'=>TRUE,
            'size'=>16,
            'maxlength'=>255,
            'type'=>'text',
            'dbfield'=>'strasse',
            ),

        'strasse_op'=>array(
            'bezeichnung'=>'Strasse PA',
            'secured'=>TRUE,
            'size'=>16,
            'maxlength'=>255,
            'type'=>'text',
            'dbfield'=>'strasse_op',
            ),

        'ort_op'=>array(
            'bezeichnung'=>'Ort PA',
            'secured'=>TRUE,
            'size'=>16,
            'maxlength'=>255,
            'type'=>'text',
            'dbfield'=>'ort_op',
            ),

        'plz_op'=>array(
            'bezeichnung'=>'PLZ PA',
            'secured'=>TRUE,
            'size'=>6,
            'maxlength'=>10,
            'type'=>'text',
            'dbfield'=>'plz_op',
            ),

        'plz'=>array(
            'bezeichnung'=>'PLZ aktuell',
            'secured'=>FALSE,
            'size'=>6,
            'maxlength'=>10,
            'type'=>'text',
            'dbfield'=>'plz',
            ),
        'schrank'=>array(
            'bezeichnung'=>'SchrankNr.',
            'secured'=>FALSE,
            'size'=>5,
            'maxlength'=>10,
            'type'=>'text',
            'dbfield'=>'kasten',
            ),

        'kfz_rz'=>array(
            'bezeichnung'=>'KFZ (SchildNr)',
            'secured'=>FALSE,
            'size'=>6,
            'maxlength'=>10,
            'type'=>'text',
            'dbfield'=>'kfz_rz',
            ),
        'umkleidenr'=>array(
            'bezeichnung'=>'UmkleideNr.',
            'secured'=>FALSE,
            'size'=>3,
            'maxlength'=>10,
            'type'=>'text',
            'dbfield'=>'umkleidenr',
            ),

        'schuhe'=>array(
            'bezeichnung'=>'SchuheGr.',
            'secured'=>FALSE,
            'size'=>5,
            'maxlength'=>10,
            'type'=>'text',
            'dbfield'=>'schuhegroesse',
            ),

        'schicht'=>array(
            'bezeichnung'=>'Schicht',
            'secured'=>TRUE,
            'size'=>5,
            'maxlength'=>5,
            'type'=>'text',
            'dbfield'=>'schicht',
            ),

        'einsatzschicht'=>array(
            'bezeichnung'=>'Einsatzschicht',
            'secured'=>false,
            'size'=>5,
            'maxlength'=>5,
            'type'=>'text',
            'dbfield'=>'einsatzschicht',
            ),

        'regelarbeit'=>array(
            'bezeichnung'=>'Regelarbeitstunden',
            'secured'=>TRUE,
            'size'=>3,
            'maxlength'=>5,
            'type'=>'text',
            'dbfield'=>'regelarbzeit',
            ),
        'regeltrans'=>array(
            'bezeichnung'=>'Regeltransport Preis',
            'secured'=>TRUE,
            'size'=>3,
            'maxlength'=>5,
            'type'=>'text',
            'dbfield'=>'regeltrans',
            ),

        'autoleistung'=>array(
            'bezeichnung'=>'Autoleistung',
            'secured'=>TRUE,
            'type'=>'checkbox',
            'dbfield'=>'auto_leistung',
            ),

         'kor'=>array(
            'bezeichnung'=>'PersNr=KORREKTUR',
            'secured'=>TRUE,
            'type'=>'checkbox',
            'dbfield'=>'kor',
            ),

        'premie_za_vykon'=>array(
            'bezeichnung'=>'Leistungspraemie',
            'secured'=>false,
            'type'=>'checkbox',
            'dbfield'=>'premie_za_vykon',
            ),

        'qpremie_akkord'=>array(
            'bezeichnung'=>'QPraemie-Akkord',
            'secured'=>false,
            'type'=>'checkbox',
            'dbfield'=>'qpremie_akkord',
            ),
        'qpremie_zeit'=>array(
            'bezeichnung'=>'QPraemie-Zeit',
            'secured'=>false,
            'type'=>'checkbox',
            'dbfield'=>'qpremie_zeit',
            ),
        'premie_za_prasnost'=>array(
            'bezeichnung'=>'Erschwerniss',
            'secured'=>false,
            'type'=>'checkbox',
            'dbfield'=>'premie_za_prasnost',
            ),
        'premie_za_3_mesice'=>array(
            'bezeichnung'=>'QuartPraemie',
            'secured'=>false,
            'type'=>'checkbox',
            'dbfield'=>'premie_za_3_mesice',
            ),


        'MAStunden'=>array(
            'bezeichnung'=>'MAStunden zaehlen',
            'secured'=>false,
            'type'=>'checkbox',
            'dbfield'=>'MAStunden',
            ),
	
        'a_praemie'=>array(
            'bezeichnung'=>'A-Praemie',
            'secured'=>false,
            'type'=>'checkbox',
            'dbfield'=>'a_praemie',
            ),
	'a_praemie_st'=>array(
            'bezeichnung'=>'A-Praemie-St',
            'secured'=>false,
            'type'=>'checkbox',
            'dbfield'=>'a_praemie_st',
            ),

        'einarb_zuschlag'=>array(
            'bezeichnung'=>'Einarb. Zuschlag berechnen',
            'secured'=>false,
            'type'=>'checkbox',
            'dbfield'=>'einarb_zuschlag',
            ),

        'bewertung'=>array(
            'bezeichnung'=>'Bewertung',
            'secured'=>false,
            'type'=>'checkbox',
            'dbfield'=>'bewertung',
            ),
        'lohnfaktor'=>array(
            'bezeichnung'=>'Zeitlohn [Kc/Std]',
            'secured'=>false,
            'size'=>5,
            'maxlength'=>5,
            'type'=>'text',
            'dbfield'=>'lohnfaktor',
            ),
        'leistfaktor'=>array(
            'bezeichnung'=>'Leist.faktor',
            'secured'=>false,
            'size'=>5,
            'maxlength'=>5,
            'type'=>'text',
            'dbfield'=>'leistfaktor',
            ),

         'leistungAktMonat'=>array(
            'bezeichnung'=>'Leistung akt. Monat',
            'secured'=>false,
            'size'=>5,
            'maxlength'=>5,
            'type'=>'text',
            'dbfield'=>'leistaktmonat',
            ),

         'leistungVorMonat'=>array(
            'bezeichnung'=>'Leistung akt. Monat',
            'secured'=>false,
            'size'=>5,
            'maxlength'=>5,
            'type'=>'text',
            'dbfield'=>'leistvormonat',
            ),

        'anwvzkd_faktor'=>array(
            'bezeichnung'=>'Anw.->VzKd',
            'secured'=>TRUE,
            'size'=>5,
            'maxlength'=>5,
            'type'=>'text',
            'dbfield'=>'anwvzkd_faktor',
            ),
        'tf_ort'=>array(
            'bezeichnung'=>'Ort aktuell',
            'secured'=>true,
            'size'=>16,
            'maxlength'=>50,
            'type'=>'text',
            'dbfield'=>'komm_ort',
            ),

        'jahranspruch'=>array(
            'bezeichnung'=>'Jahranspruch',
            'secured'=>false,
            'size'=>3,
            'maxlength'=>5,
            'type'=>'text',
            'dbfield'=>'jahranspruch',
            ),

        'rest'=>array(
            'bezeichnung'=>'VJRest',
            'secured'=>false,
            'size'=>3,
            'maxlength'=>5,
            'type'=>'text',
            'dbfield'=>'rest',
            ),
        'gekrzt'=>array(
            'bezeichnung'=>'Korrektur',
            'secured'=>false,
            'size'=>3,
            'maxlength'=>5,
            'type'=>'text',
            'dbfield'=>'gekrzt',
            ),
        'vor_persnr'=>array(
            'bezeichnung'=>'<-',
            'secured'=>false,
            'size'=>3,
            'maxlength'=>5,
            'type'=>'button',
            'dbfield'=>'',
            ),
        'nach_persnr'=>array(
            'bezeichnung'=>'->',
            'secured'=>false,
            'size'=>3,
            'maxlength'=>5,
            'type'=>'button',
            'dbfield'=>'',
            ),

        'dpersstempel'=>array(
            'bezeichnung'=>'Stempel',
            'secured'=>TRUE,
            'size'=>3,
            'maxlength'=>5,
            'type'=>'button',
            'dbfield'=>'',
            ),

        'vorschuss'=>array(
            'bezeichnung'=>'Vorschuss',
            'secured'=>TRUE,
            'size'=>3,
            'maxlength'=>5,
            'type'=>'button',
            'dbfield'=>'',
            ),

         'sonstpremie'=>array(
            'bezeichnung'=>'Sonst.Praemien',
            'secured'=>TRUE,
            'size'=>3,
            'maxlength'=>5,
            'type'=>'button',
            'dbfield'=>'',
            ),

         'dperszuschlag'=>array(
            'bezeichnung'=>'Zuschlag Einarb.',
            'secured'=>TRUE,
            'size'=>3,
            'maxlength'=>5,
            'type'=>'button',
            'dbfield'=>'',
            ),

         'dperszuschlag'=>array(
            'bezeichnung'=>'Zuschlag Einarb.',
            'secured'=>TRUE,
            'size'=>3,
            'maxlength'=>5,
            'type'=>'button',
            'dbfield'=>'',
            ),

         'vertrag'=>array(
            'bezeichnung'=>'Vertrag Archiv',
            'secured'=>TRUE,
            'size'=>3,
            'maxlength'=>5,
            'type'=>'button',
            'dbfield'=>'',
            ),

         'abmahnung'=>array(
            'bezeichnung'=>'Abmahnung',
            'secured'=>TRUE,
            'size'=>3,
            'maxlength'=>5,
            'type'=>'button',
            'dbfield'=>'',
            ),

         'verletzung'=>array(
            'bezeichnung'=>'Arbeitsunfälle',
            'secured'=>TRUE,
            'size'=>3,
            'maxlength'=>5,
            'type'=>'button',
            'dbfield'=>'',
            ),

        'faehigkeiten'=>array(
            'bezeichnung'=>'Qualifikationen',
            'secured'=>TRUE,
            'size'=>3,
            'maxlength'=>5,
            'type'=>'button',
            'dbfield'=>'',
            ),

        'essen'=>array(
            'bezeichnung'=>'Essen',
            'secured'=>TRUE,
            'size'=>3,
            'maxlength'=>5,
            'type'=>'button',
            'dbfield'=>'',
            ),

        'transport'=>array(
            'bezeichnung'=>'Transport',
            'secured'=>TRUE,
            'size'=>3,
            'maxlength'=>5,
            'type'=>'button',
            'dbfield'=>'',
            ),

        'anwesenheit'=>array(
            'bezeichnung'=>'Anwesenheit',
            'secured'=>TRUE,
            'size'=>3,
            'maxlength'=>5,
            'type'=>'button',
            'dbfield'=>'',
            ),

//         'bewerberformularbutton'=>array(
//            'bezeichnung'=>'Bewerberform',
//            'secured'=>TRUE,
//            'size'=>3,
//            'maxlength'=>5,
//            'type'=>'button',
//            'dbfield'=>'',
//            ),

        'cb_regeloe'=>array(
            'bezeichnung'=>'RegelOE',
            'secured'=>TRUE,
            'type'=>'select',
            'dbfield'=>'regeloe',
        ),

        'cb_auto_leistung_abgnr'=>array(
            'bezeichnung'=>'auto Leistung Abgnr',
            'secured'=>FALSE,
            'type'=>'select',
            'dbfield'=>'auto_leistung_abgnr',
        ),

        'dpersstatus'=>array(
            'bezeichnung'=>'Status',
            'secured'=>TRUE,
            'type'=>'select',
            'dbfield'=>'dpersstatus',
        ),

        'cb_alteroe'=>array(
            'bezeichnung'=>' Alternativ OE',
            'secured'=>TRUE,
            'type'=>'select',
            'dbfield'=>'alteroe',
        ),

        'bt_bewerberform_show'=>array(
            'bezeichnung'=>'Bewerberform zeigen',
            'secured'=>FALSE,
            'type'=>'button',
            'dbfield'=>'',
            ),

        'bt_persnrkopieren'=>array(
            'bezeichnung'=>'PersNr kopieren',
            'secured'=>TRUE,
            'type'=>'button',
            'dbfield'=>'',
            ),

        'bt_persnrdelete'=>array(
            'bezeichnung'=>'PersNr loeschen',
            'secured'=>TRUE,
            'type'=>'button',
            'dbfield'=>'',
            ),

    );

    public function __construct($name = NULL, $parent = NULL) {
        parent::__construct($name, $parent);

//        $this->addGroup($this->groups['grundinfo']['bezeichnung']);
        foreach ($this->elements as $element=>$propertiesArray){
            switch ($propertiesArray['type']) {
                case 'text':
                    $this->addText($element,$this->elements[$element]['bezeichnung'],$propertiesArray['size'],$propertiesArray['maxlength']);
                    if(key_exists('readonly', $propertiesArray)){
                        $this[$element]->getControlPrototype()->readonly = $propertiesArray['readonly'];
                    }
                    break;
                case 'select':
                    $this->addSelect($element,$this->elements[$element]['bezeichnung']);
                    if(key_exists('readonly', $propertiesArray)){
                        $this[$element]->setDisabled();
                    }
                    break;
                case 'checkbox':
                    $this->addCheckbox($element,$this->elements[$element]['bezeichnung']);
                    break;
                case 'button':
                    $this->addButton($element, $this->elements[$element]['bezeichnung']);
                default:
                    break;
            }
        }
    }


    public function setActUrl($urlArray){

        foreach ($urlArray as $elementid=>$acturl){
           if(key_exists($elementid, $this->elements)){
               $this[$elementid]->getControlPrototype()->acturl = $acturl;
           }
        }
    }

    public function setControlValues($valuesArray){
//        Debug::dump($valuesArray);
        foreach ($this->elements as $element=>$propertiesArray){
            if(key_exists($propertiesArray['dbfield'],$valuesArray)){
                $dbfield = $propertiesArray['dbfield'];
                $value = $valuesArray[$dbfield];

                // podle typu controlu budu plnit hodnotama
                switch ($propertiesArray['type']) {
                    case 'text':
                                $this[$element]->setValue($value);
                                break;
                    case 'checkbox':
                                $this[$element]->setValue($value);
                                break;
                    case 'select':
                                $this[$element]->setItems($value['items']);
                                $this[$element]->setValue($value['selected']);
                                break;

                    default:
                                break;
                }

            }
        }
    }


    public function getElementsArray(){
        return $this->elements;
    }
    /**
     *
     */
    public function getElements(){
       return join(',', array_keys($this->elements));
    }
        /**
     * @param FormControl $control
     * @param array security array
     */
    public function setFormSecurityAttributes($sec) {
        foreach ($this->elements as $element => $propertiesArray) {
            if ($propertiesArray['secured'] == true) {
                $control = $this[$element];
                $elementName = $control->getName();
                $securityIndex = $sec['form_id'] . "_" . $elementName;
                $control->getControlPrototype()->class($sec['secclasses']['lesen'][$securityIndex]);
                if ($propertiesArray['type'] == 'text') {
                    if ($sec['secclasses']['schreiben'][$securityIndex] == 'schreiben_denied')
                        $control->getControlPrototype()->readonly = 'readonly';
                        
                }
                if ($propertiesArray['type'] == 'select') {
                    if ($sec['secclasses']['schreiben'][$securityIndex] == 'schreiben_denied')
                        $control->setDisabled();
                }
                if ($propertiesArray['type'] == 'checkbox') {
                    if ($sec['secclasses']['schreiben'][$securityIndex] == 'schreiben_denied')
                        $control->setDisabled();
                }
            }
        }
    }


}
