<?php

    require_once LIBS_DIR . '/Nette/loader.php';

    Debug::enable();

    $loader = new RobotLoader();
    $loader->addDirectory(APP_DIR);
    $loader->register();

    date_default_timezone_set("Europe/Prague");

    Environment::loadConfig();
    $application = Environment::getApplication();
    $application->run();
    