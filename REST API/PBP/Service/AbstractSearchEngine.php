<?php

namespace PBP\Service;

/**
 * The extensions of this abstract class are responsible for searching results given by defined Search Engine.
 * It receives a string to search.
 *
 * @author csesena
 */
abstract class AbstractSearchEngine implements SearchEngineInterface {

	 /**
     * @var string Search Engine URL
     */
    protected $_sURL = null;
	
	/**
     * @param string $sURL
     *
     */
    public function setSearchEngineURL($sURL) {
		$this->_sURL = $sURL;
	}
	
	/**
     * @return string
     *
     */
    public function getSearchEngineURL() {
		return $this->_sURL;
	}
	
    /**
     * @param string $sSearchString String to search for.
     *
     * @return \PBP\Entity\SearchEngineResult[]
     */
    abstract public function getResultsFromSearchString($sSearchString);
	
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
		return $oResult->getAttribute('href');
	}
}
?>