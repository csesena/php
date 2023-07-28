<?php

namespace PBP\Service;

/**
 * This class is responsible for searching results given by Yahoo Search Engine.
 * It receives a string to search.
 *
 * @author csesena
 */
class YahooSearchEngine extends AbstractSearchEngine {
	
	/**
     * @var string Yahoo Search Engine URL
     */
    protected $_sURL = 'http://search.yahoo.com/search';
	
   /**
     * @param string $sSearchString String to search for.
     *
     * @return \PBP\Entity\SearchEngineResult[]
     */
    public function getResultsFromSearchString($sSearchString) {
		$oGuzzleClient = new \GuzzleHttp\Client();
		$sGuzzleResponse = $oGuzzleClient->request(
			'GET',
			$this->_sURL, ['query' => ['p' => $sSearchString]]
		);
		$sResponseBodyHtml = $sGuzzleResponse->getBody()->getContents();
		$aSearchResults = $this->filterResultsFromResponseBodyString($sResponseBodyHtml);
		
		return $aSearchResults;
	}
	
	/**
     * @param string $sResponseBodyHtml String containing all the body from the response body string.
     *
     * @return \PBP\Entity\SearchEngineResult[] All the results already filtered
     */
    public function filterResultsFromResponseBodyString($sResponseBodyHtml) {
		$aSearchResults = array();
		
		$oDom = new \PHPHtmlParser\Dom;
		$oDom->loadStr($sResponseBodyHtml, []);
		$aResultsInRaw = $oDom->find('h3.title a');

		foreach($aResultsInRaw as $oResult) {
			$sResultTitle = $this->getTitleFromResultHtml($oResult);
			$sResultURL = $this->getURLFromResultHtml($oResult);
			$oSearchEngineResult = new \PBP\Entity\SearchEngineResult($sResultTitle,$sResultURL, __CLASS__);
			$aSearchResults[$sResultURL] = $oSearchEngineResult;
		}
		
		return $aSearchResults;
	}
}
?>