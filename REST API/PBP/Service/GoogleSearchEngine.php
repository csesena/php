<?php

namespace PBP\Service;

/**
 * This class is responsible for searching results given by Google Search Engine.
 * It receives a string to search.
 *
 * @author csesena
 */
class GoogleSearchEngine extends AbstractSearchEngine {
	
	/**
     * @var string Google Search Engine URL
     */
    protected $_sURL = 'http://www.google.es/search';
	
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
		$aResultsInRaw = $oDom->find('div.g h3.r a');
		
		foreach($aResultsInRaw as $oResult) {
			$sResultTitle = $this->getTitleFromResultHtml($oResult);
			$sResultURL = $this->getURLFromResultHtml($oResult);
			$oSearchEngineResult = new \PBP\Entity\SearchEngineResult($sResultTitle,$sResultURL, __CLASS__);
			$aSearchResults[$sResultURL] = $oSearchEngineResult;
		}
		
		return $aSearchResults;
	}
	
	/**
     * @param \PHPHtmlParser\Dom\HtmlNode $oResult Object containing result html
     *
     * @return string title from result
     */
    public function getTitleFromResultHtml($oResult) {
		$sTitle = str_replace(array('<b>', '</b>', '<strong>', '</strong>'), array('', '', '', ''), $oResult->innerHtml);
		
		return $sTitle;
	}
	
	/**
     * @param \PHPHtmlParser\Dom\HtmlNode $oResult Object containing result html
     *
     * @return string URL from result
     */
    public function getURLFromResultHtml($oResult) {
		$sURL = str_replace('/url?q=', '', $oResult->getAttribute('href'));
		$sURL = substr($sURL, 0, strpos($sURL, '&amp'));
		
		return $sURL;
	}
}
?>