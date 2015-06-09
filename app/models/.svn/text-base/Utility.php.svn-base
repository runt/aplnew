<?php

/**
 * ruzne pomocne funkce vesmes staticke
 *
 * @author runt
 */
class Utility {

    public static $weekDays = array('So/Ne','Mo/Po','Di/Ut','Mi/St','Do/Ct','Fr/Pa','Sa/So');
    
    /**
     * vrati prvky pole, ktere maji klic = $key
     * @param mixed $key 
     * @param array $pole
     */
    public static function getArrayWithKey($key,$pole){
        $a = array();
        foreach ($pole as $assocArray)
            array_push($a, $assocArray[$key]);
        return $a;
    }

    public static function arrayJoinString($a1,$a2,$separator=' - '){
        if(count($a1)!=count($a2)) return NULL;
        $a3 = array();
        $i = 0;
        foreach($a1 as $a1Element){
            $a2Element = $a2[$i];
            $element = $a1Element.$separator.$a2Element;
            $i++;
            array_push($a3, $element);
        }
        return $a3;
    }

        /**
     * vytvori datetime pro databazi ze zadaneho datumu a casu
     * @param <type> $time HH:MM
     * @param <type> $datum ve tvaru DD.MM.RRRR
     * @return <type>
     */
    public static function make_DB_datetime($time,$datum)
    {
        $vonHod = substr($time,0,2); // roz�e�eme p��chod na �daje
        $vonMin = substr($time,3,2); // roz�e�eme p��chod na �daje
        $datumRoz = explode(".",$datum); // Roz�e�eme datum na jednotliv� �daje

        $von = date("Y-m-d H:i:s",mktime($vonHod, $vonMin, 0, $datumRoz[1], $datumRoz[0], $datumRoz[2])); // sestav�me nov� p��chod i s datumem

        return $von;
    }


    public static function get_user_pc() {
        $pocitac = "PHP_" . $_SERVER["REMOTE_ADDR"];
        $ident = $pocitac . "/" . $_SESSION["user"];
        return $ident;
    }

    /**
     * vytvoru datum vhodne pro databazi z datumu ve tvaru DD.MM.RRRR
     * @param <type> $datum
     * @return <type>
     */
    public static function make_DB_datum($datum)
    {
        if($datum==NULL || strlen($datum)==0) return NULL;
        $datumRoz = explode(".",$datum); // Roz�e�eme datum na jednotliv� �daje
        $datum = $datumRoz[2]."-".$datumRoz[1]."-".$datumRoz[0]; // Op�t ho spoj�me
        return $datum;
    }

        /**
     * overi platnost zadaneho datumu ve tvaru den mesic [rok]
     * oddelovace muzou byt , . - mezera
     * pokud nelze vyrobit platne datum vratim null
     *
     * @param string $value datum ve tvaru d,m,rok
     * @return string datum ve formatu DD.MM.RRRR nebo null pokud nemuzu vyrobit platne datum
     */
    public static function validateDatum($value){

		// casti datumu povolim oddelovat znaky : ,.- a mezera
		$vymenit=array(",",".","-"," ");
		if(strlen($value)>=3)
		{
			// datum byl zadan i s rokem
			// sjednotim si oddelovaci znak
			$novy_datum=str_replace($vymenit,"/",$value);
			// rozkouskuju na jednotlivy casti
			$dily=explode("/",$novy_datum);
			$pocetDilu = count($dily);

			// trochu otestuju jednotlivy dily,jestli tam neni uplnej nesmysl
			if(($dily[1]<13)&&($dily[1]>0)&&($dily[0]>0)&&($dily[0]<32))
			{
				if($pocetDilu==2)
				{
					// nezadal rok
					$dily[2]=date('Y');
				}
				if(($pocetDilu==3)&&(strlen($dily[2])==0))
				{
					// nezadal rok
					$dily[2]=date('Y');
				}

				$timestamp=mktime(0,0,0,$dily[1],$dily[0],$dily[2]);
				$rok=date("Y",$timestamp);
				$mesic=date("m",$timestamp);
				$den=date("d",$timestamp);
				// provedena jen mala kontrola datumu
				return "$den.$mesic.$rok";
			}
			else
				return null;
		}
        else
            return null;
    }

}
?>
