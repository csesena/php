<?php

namespace PBP\Service;

/**
 * This class is responsible for searching results given by Bing Search Engine.
 * It receives a string to search.
 *
 * @author csesena
 */
class BingSearchEngine extends AbstractSearchEngine {
	
	/**
     * @var string Bing Search Engine URL
     */
    protected $_sURL = 'http://www.bing.com/search';
	
    /**
     * @param string $sSearchString String to search for.
     *
     * @return \PBP\Entity\SearchEngineResult[]
     */
    public function getResultsFromSearchString($sSearchString) {
		$oGuzzleClient = new \GuzzleHttp\Client();
		$sGuzzleResponse = $oGuzzleClient->request(
			'GET',
			$this->_sURL, ['query' => ['q' => $sSearchString]]
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
		$aResultsInRaw = $oDom->find('div.b_title h2 a');
		
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