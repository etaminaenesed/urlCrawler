<?php

/**
 * Class ApiController
 */
class ApiController
{

    public function getDisplayUrl($url)
    {

        $authToken = $url[3];
        $keyword = $url[4];
        $numResults = $url[5];

        /** basic token url authentification */
        $client = new Api\V2\Client($authToken);
        /** initialize crawler */
        $crawler = new Api\V2\Crawler($keyword, $numResults);
        /** get the full page */
        $crawler->getPage();
        /** extract the required Urls */
        $crawler->extractDisplayUrlByClassName('s');
        /** Output results in JSON format */
        $api = new Api\V2\Api($client, $crawler);

    }
}