<?php

namespace PBP\Service;

/**
 * The implementation is responsible for searching all the results of a query for a certain 
 * Search Engine. In this example, it receives the string the user wants to search.
 *
 * @author csesena
 */
interface SearchEngineInterface {
    /**
     * @param string $sSearchString String to search for.
     *
     * @return \PBP\Entity\SearchEngineResult[]
     */
    public function getResultsFromSearchString($sSearchString);
	
	/**
     * @param string $sURL
     *
     */
    public function setSearchEngineURL($sURL);
	
	/**
     * @return string
     *
     */
    public function getSearchEngineURL();
}
?>