<?php

define('WWW_DIR',dirname(__FILE__));
define('APP_DIR',WWW_DIR.'/../app');
define('LIBS_DIR',WWW_DIR.'/../libs');

require_once LIBS_DIR .'/Nette/loader.php';
require_once APP_DIR.'/models/AplModel.php';
Debug::enable();

echo "start";
$apl = new AplModel();

$apl->addDatumToVertragArchiv();

//$zs = $apl->getArbTageZuschlagArray(2609);
//
//var_dump($zs);
//$r = $apl->addAbgNrToAuftrag(0.75,0.75,2030, 40, 130, 130440, 130445, '1126054629');
//$r = $apl->addAbgNrToDrueck(0.75,0.75,2030, 40, 130, 130440, 130445, '1126054629');


