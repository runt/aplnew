<?php
/**
 * definice formulare s informacemi o pracovnikovi
 *
 * @author runt
 */
class FormBewerberInfo extends Form {

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

        'aufenthaltsort'=>array(
            'bezeichnung'=>'Aufenthaltort',
            'secured'=>false,
            'type'=>'text',
            'size'=>10,
            'maxlength'=>255,
            'dbfield'=>'aufenthalts_ort',
            ),

        'staats_angehoerigkeit_id'=>array(
            'bezeichnung'=>'Staatsangehoerigkeit',
            'secured'=>false,
            'type'=>'select',
            'dbfield'=>'staats_angehoerigkeit_id',
            ),

        'transport_id'=>array(
            'bezeichnung'=>'Eigen. Transp.',
            'secured'=>false,
            'type'=>'select',
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
            'size'=>10,
            'maxlength'=>255,
            'dbfield'=>'bewertung_bemerkung',
            ),

	'uebergang'=>array(
            'bezeichnung'=>'Uebergang',
            'secured'=>false,
            'type'=>'text',
            'size'=>10,
            'maxlength'=>255,
            'dbfield'=>'uebergang',
            ),

        'eintritt_datum'=>array(
            'bezeichnung'=>'Vorsichtl. Eintritt',
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
            'size'=>10,
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
            'size'=>10,
            'maxlength'=>255,
            'dbfield'=>'bemerkung_sonst',
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
	'vertrag'=>array(
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
	'schuhe_groesse'=>array(
            'bezeichnung'=>'Schuhengroesse',
            'secured'=>false,
            'type'=>'text',
            'size'=>10,
            'maxlength'=>255,
            'dbfield'=>'schuhe_groesse',
            ),
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
            'size'=>10,
            'maxlength'=>255,
            'dbfield'=>'ausgang_bemerkung',
            ),
    );

    public function __construct($name = NULL, $parent = NULL) {
        parent::__construct($name, $parent);

//        $this->addGroup($this->groups['grundinfo']['bezeichnung']);
        foreach ($this->elements as $element=>$propertiesArray){
            switch ($propertiesArray['type']) {
                case 'text':
                    $this->addText($element,$this->elements[$element]['bezeichnung'],$propertiesArray['size'],$propertiesArray['maxlength']);
                    break;
                case 'select':
                    $this->addSelect($element,$this->elements[$element]['bezeichnung']);
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
