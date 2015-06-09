<?php

/**
 * udrzuje informaci o polozkach pro selectbox
 *
 * @author runt
 */
class SelectItemsModel extends Object {
    protected $items = array();
    protected $selected;
    protected $keys = array();
    protected $values = array();

    function __construct($selected, $keys, $values) {
        $this->selected = $selected;
        $this->keys = $keys;
        $this->values = $values;

        if(count($keys)!=count($values)) throw new ApplicationException('Key and Valyes Array not same size');
        $i=0;
        foreach ($this->keys as $key){
            $this->items[$key] = $this->values[$i++];
        }
    }

    public function getSelectItemsArray(){
        $selectArray = array();
        $selectArray['selected'] = $this->selected;
        $selectArray['items'] = $this->items;
        return $selectArray;
    }
}
?>
