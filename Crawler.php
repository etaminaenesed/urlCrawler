<?php
namespace Api\V2;

/**
 * Class Crawler
 * @package Api\V2
 */
class Crawler {

public $parseUrl;
public $pageContent;
public $keyword;
public $filteredKeyword;
public $numResults;
public $searchResults = array();
const SEARCH_ENGINE ='https://www.google.co.uk/search?sclient=psy-ab&site=&source=hp&q=';

    /**
     * Crawler constructor
     * @param $keyword
     * @param $numResults
     */
	public function __construct($keyword, $numResults)
	{
        $this->numResults = $numResults;
        $this->buildSearchUrl($keyword);

	}

    /**
     * @param $keyword
     * @return string Full URL that needs to be parsed
     */
    private function buildSearchUrl($keyword)
    {
        $this->parseUrl = self::SEARCH_ENGINE . $this->filteredKeyword;
    }

    /**
     * Process Keyword
     * @param $keyword
     * @return string Replaces dashes with space and encodes it
     */
    private function processKeyword($keyword)
    {
        $this->filteredKeyword = urlencode(str_replace('-', ' ', $keyword));
    }

    /**
     * Get Page
     * @return string Full scrapped page
     */
    public function getPage()
    {
        $this->pageContent = file_get_contents($this->parseUrl);
    }

    /**
     * Extract Display Url By Class Name
     * @param $className string
     * return array
     */
    public function extractDisplayUrlByClassName($className)
    {
        /** step 1. Get the result container */
        preg_match_all('/<div class=\"'.$className.'">(.*?)<\/div>/s',$this->pageContent,$matches);

        /** step 2. Get the display url */
        $i = 0;
        foreach($matches[0] as $match) {

            preg_match_all('/<cite>(.*?)<\/cite>/s',$match,$url);
            if($i<$this->numResults) {  $this->searchResults[] = strip_tags($url[1][0]); }
            ++$i;
        }
    }

}