<?php
require_once './Picasa.php';

/**
 * vraci text jmeno mesice rok
 * @param $rokMesic RRRR-MM
 * @return string
 */
function getDatumPopis($rokMesic){
   $mesice = array('leden','únor','březen','duben','květen','červen','červenec','srpen','září','říjen','listopad','prosinec');
   $cisloMesice = intval(substr($rokMesic, 5));
   $rok = substr($rokMesic, 0, 4);
   return $mesice[$cisloMesice-1].' '.$rok;
}

function getTextMnozneCislo($pocet,$text){
    if(!strcasecmp($text, 'fotografie')){
        if($pocet==0) return 'fotografii';
        if($pocet<5)
            return 'fotografie';
        else {
            return 'fotografii';
        }
    }
}



$p = new Picasa('babycentrum.slunecnice',FALSE);
$p->setProjection('api');


//echo "<pre>";
//var_dump($p->getUser());
//echo "</pre>";
//echo "<pre>";
//var_dump($p->getPath());
//echo "</pre>";
//echo "<pre>";
//var_dump($p->getUrl());
//echo "</pre>";

$feed = $p->getAlbumsFeed();
$albumsArray = $p->getAlbumsArrayFromFeed($feed);
$pocetAlb = count($albumsArray);
//echo "<pre>".var_dump($albumsArray)."</pre>";
$nahledy = FALSE;
$maxColumns = 2;
$column = 0;
$zobrazenoAlb = 0;
$lastDatum = 0;
echo "<table border='0'>";
    echo "<tr>";

foreach($albumsArray as $album){
    // zajima me jen rok a mesic
    $albumDatm = substr($album['datum'], 0,7);
    // pokud doslo ke zmene datumu, zobrazim nadpis pro datum
    if(strcmp($lastDatum, $albumDatm)){
        // pokud dane datum nema alespon maxColumns alb, musim doplnit pocet bunek na maxcolumns a vyrobit novy radek
        if($column<$maxColumns && $zobrazenoAlb>0 && $column>0) {
            while($column<$maxColumns) {
                // prazdna bunka misto alba
                echo "<td>&nbsp</td>";
                $column++;
            }
            $column = 0;
            echo "</tr><tr>";
        }
        echo "<td bgcolor='lightblue' colspan='$maxColumns'>";
            echo getDatumPopis($albumDatm);
        echo "</td>";
        echo "</tr><tr>";
        $lastDatum = $albumDatm;
    }

    $sirkaBunky = 100 / $maxColumns;
    echo "<td width='$sirkaTabuky%' valign='top'>";
    
    echo "<table width='100%' border='0'>";
    echo "<tr>";
        echo "<td width='30%' valign='top'>";
            $img = sprintf("<img border='0' src='%s'>",$album['thumbnail']);
            echo "<div>";
                echo "<a href='".$album['albumlink']."'>".$img."</a>";
            echo "</div>";
            if($nahledy) {
                echo "<div>";
                $photoFeed = $p->getPhotosFeedFromAlbumId($album['id'],20,48);
                $photosArray = $p->getPhotosArrayFromFeed($photoFeed);
                foreach ($photosArray as $photo) {
                    $img = sprintf("<img border='0' src='%s'>",$photo['thumbnail']);
                    echo "<a href='".$photo['photolink']."'>".$img."</a>";
                }
                echo "</div>";
            }
            echo "</td>";

        echo "<td valign='top'>";

            echo "<div>";
                echo $album['title'];
            echo "</div>";

            echo "<div>";
                echo '<em>'.$album['description'].'</em>';
            echo "</div>";

            echo "<div>";
                echo $album['datum'];
            echo "</div>";

            echo "<div>";
                echo $album['numphotos'].' '.getTextMnozneCislo($album['numphotos'], 'fotografie');
            echo "</div>";
            
        echo "</td>";

    echo "</tr>";
    echo "</table>";
    echo "</td>";
    $column++;
    $zobrazenoAlb++;
    if($column>=$maxColumns){
        // ukoncim radek
        echo "</tr>";
        $column = 0;
        // pokud jeste mam nejaka alba k zobrazeni, tak zacnu dalsi radek
        if($zobrazenoAlb<$pocetAlb)
            echo "<tr>";
    }
}
if($column<$maxColumns)
    echo "</tr>";

echo "</table>";

?>
