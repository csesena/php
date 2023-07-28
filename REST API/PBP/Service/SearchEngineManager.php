<?php

namespace PBP\Service;

/**
 * This class is responsible for loading all the available search engines and to perform the searches.
 * It receives an array of strings with the name of every Search engine.
 *
 * @author csesena
 */
class SearchEngineManager {
	 
	 /**
     * @var array Search engine names
     */
    private $_aSENames;
	 
	 /**
     * @var array Search engines
     */
    private $_aSearchEngines;
	 
	/**
     * @param array $aSENames Array of names of the Search Engines
     *
     * @throws \InvalidArgumentException if there is not any search engine within the array of search engine names ($aSENames)
     */
	public function loadSearchEnginesByNamesArray($aSENames) {
		$this->_aSENames = $aSENames;
		foreach ($this->_aSENames as $sSEName) {
			$sSEClassName = __NAMESPACE__ . '\\' . ucfirst($sSEName);
			
			if (class_exists($sSEClassName)) {
				$oSearchEngine = new $sSEClassName();
				$this->_aSearchEngines[$sSEName] = $oSearchEngine;
			} else {
				throw new \InvalidArgumentException($sSEName . ' does not exist');
			}
		}
	}
	
	/**
     * @param AbstractSearchEngine $oSearchEngine Search engine to add
     *
     * @throws \InvalidArgumentException if the parameter is not an AbstractSearchEngine object
     */
	public function loadSearchEngine($oSearchEngine) {
		$sSEName = get_class($oSearchEngine);
		$this->_aSENames[] = $sSEName;

		if (__NAMESPACE__ . '\\AbstractSearchEngine' == get_parent_class($oSearchEngine)) {
			$this->_aSearchEngines[$sSEName] = $oSearchEngine;
		} else {
			throw new \InvalidArgumentException($sSEName . ' is not an AbstractSearchEngine');
		}
	}
	
	/**
     * @return \PBP\Entity\AbstractSearchEngine[]
	 *
     */
	public function getLoadedSearchEngines() {
		return $this->_aSearchEngines;
	}
	
	/**
	 * @param string $sSENameToSearch String to search for.
	 *
     * @return \PBP\Entity\AbstractSearchEngine
     * @throws \InvalidArgumentException if there is not any search engine loaded with the provided name ($sSENameToSearch)
     */
	public function getLoadedSearchEngineByName($sSENameToSearch) {
		if (isset($this->_aSearchEngines[$sSENameToSearch])) {
			return $this->_aSearchEngines[$sSENameToSearch];
		} else {
			throw new \InvalidArgumentException($sSENameToSearch . ' is not loaded');
		}
	}
	
	/**
     * @param string $sSearchString String to search for
     *
     * @return \PBP\Entity\SearchEngineResult[]
	 * @throws \RuntimeException if there are no search engines defined
     */
	public function performSearch($sSearchString) {
		
		if (isset($this->_aSearchEngines) && !empty($this->_aSearchEngines)) {
			$aResults = array();
			
			foreach ($this->_aSearchEngines as $oSE) {
				$aResults += $oSE->getResultsFromSearchString($sSearchString);
			}
		} else {
			throw new \RuntimeException('There are no search engines included');
		}
		
		return $aResults;
	}
	 
}
?>