<?php
/**
 * @author runt
 */
class FormVzKdPlanFilter extends Form {

    private $elements = array(
        'persnr'=>array(
            'bezeichnung'=>'PersNr:',
            'secured'=>false,
            'type'=>'text',
            'size'=>5,
            'maxlength'=>5,
            'dbfield'=>'',
            ),
        'datumvon'=>array(
            'bezeichnung'=>'Datum von',
            'secured'=>false,
            'type'=>'text',
            'size'=>10,
            'maxlength'=>10,
            'dbfield'=>'datumvon',
            ),
        'planoe'=>array(
            'bezeichnung'=>'PlanOE',
            'secured'=>false,
            'type'=>'select',
            'size'=>10,
            'maxlength'=>10,
            'dbfield'=>'planoe',
            ),
         'wocheplus'=>array(
            'bezeichnung'=>'Woche +',
            'secured'=>false,
            'type'=>'button',
            'size'=>10,
            'maxlength'=>10,
            'dbfield'=>'',
            ),
         'wocheminus'=>array(
            'bezeichnung'=>'Woche -',
            'secured'=>false,
            'type'=>'button',
            'size'=>10,
            'maxlength'=>10,
            'dbfield'=>'',
            ),


    );

    public function __construct($name = NULL, $parent = NULL) {
        parent::__construct($name, $parent);

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
    public function setFormSecurityAttributes($sec){
        foreach($this->elements as $element=>$propertiesArray){
            if($propertiesArray['secured']==true){
                $control = $this[$element];
                $elementName = $control->getName();
                $securityIndex = $sec['form_id']."_".$elementName;
                $control->getControlPrototype()->class($sec['secclasses']['lesen'][$securityIndex]);
                if($sec['secclasses']['schreiben'][$securityIndex]=='schreiben_denied')
                    $control->getControlPrototype()->readonly='readonly';
            }
        }
    }


}
