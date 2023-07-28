<?php

/*
 * Including vendor libraries
 */
include(__DIR__ . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php');

/*
 * Including all the created classes this way cause I do not want to use any Third-party Library to do it
 */

// Including Search Engine Manager and Interface within Service files
include(__DIR__ . DIRECTORY_SEPARATOR . 'Service' . DIRECTORY_SEPARATOR . 'SearchEngineManager.php');
include(__DIR__ . DIRECTORY_SEPARATOR . 'Service' . DIRECTORY_SEPARATOR . 'SearchEngineInterface.php');

// Including Search Engines within Service files
foreach (glob(__DIR__ . DIRECTORY_SEPARATOR . 'Service' . DIRECTORY_SEPARATOR . '*SearchEngine.php') as $sFileName) {
    include $sFileName;
}

// Including Entity files
foreach (glob(__DIR__ . DIRECTORY_SEPARATOR . 'Entity' . DIRECTORY_SEPARATOR . '*.php') as $sFileName) {
    include $sFileName;
}

/*
 * Here we go...
 */

 // Defining search string if not defined (from HTTP Request)
$sSearch = !isset($sSearch) ? 'pointer brand protection' : $sSearch;
 
// Intantiating Search Engine Manager
$oSearchEngineManager = new \PBP\Service\SearchEngineManager();

// Load Google Search Engine
$oGoogleSearchEngine = new \PBP\Service\GoogleSearchEngine();
$oSearchEngineManager->loadSearchEngine($oGoogleSearchEngine);

// Load Yahoo Search Engine
$oYahooSearchEngine = new \PBP\Service\YahooSearchEngine();
$oSearchEngineManager->loadSearchEngine($oYahooSearchEngine);

// Load Bing Search Engine
$oBingSearchEngine = new \PBP\Service\BingSearchEngine();
$oSearchEngineManager->loadSearchEngine($oBingSearchEngine);

// Getting results for every Search Engine
$aResults = $oSearchEngineManager->performSearch($sSearch);

//print_r($aResults);

?>