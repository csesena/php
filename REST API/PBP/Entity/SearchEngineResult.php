<?php

namespace PBP\Entity;

/**
 * This class is an Entity to store search engines results
 * It receives and stores a title, an URL and a source (Google, Yahoo,...)
 *
 * @author csesena
 */
class SearchEngineResult {
	
	 /**
     * @var string Search Engine Result Title
     */
    protected $_sTitle = null;
	
	 /**
     * @var string Search Engine Result URL
     */
    protected $_sURL = null;
	
	 /**
     * @var string Search Engine Result Source
     */
    protected $_sSource = null;
	
	/**
     * @param string $sTitle
	 * @param string $sURL
	 * @param string $sSource
     *
     */
	public function __construct($sTitle, $sURL, $sSource) {
		$this->setSearchEngineResultTitle($sTitle);
		$this->setSearchEngineResultURL($sURL);
		$this->setSearchEngineResultSource($sSource);
	}
	
	/**
     * Used when showing the results in string format
     */
	public function __toString() {
		return json_encode(
			array($this->_sURL => array('title' => $this->_sTitle, 'url' => $this->_sURL, 'source' => $this->_sSource))
			);
	}
	
	/**
     * @param string $sTitle
     *
     */
    public function setSearchEngineResultTitle($sTitle) {
		$this->_sTitle = $sTitle;
	}
	
	/**
     * @return string
     *
     */
    public function getSearchEngineResultTitle() {
		return $this->_sTitle;
	}
	
	/**
     * @param string $sURL
     *
     */
    public function setSearchEngineResultURL($sURL) {
		$this->_sURL = $sURL;
	}
	
	/**
     * @return string
     *
     */
    public function getSearchEngineResultURL() {
		return $this->_sURL;
	}
	
	/**
     * @param string $sSource
     *
     */
    public function setSearchEngineResultSource($sSource) {
		$this->_sSource = $sSource;
	}
	
	/**
     * @return string
     *
     */
    public function getSearchEngineResultSource() {
		return $this->_sSource;
	}
}

?>