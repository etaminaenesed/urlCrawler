<?php
namespace Api\V2;

/**
 * Class API
 * @package Api\V2
 */
class API {

    public $url;

    /**
     * API constructor
     * @param $token Authentification token
     */
    public function __construct(\Api\V2\Client $client, \Api\V2\Crawler $crawler)
    {

        if($client->isAuthenticated === false) {
            $this->output($client->authStatus);
        }
        else {
            $this->output($crawler->searchResults);
        }

    }

    /**
     * Output
     * @param $outputData array
     */
    private function output($outputData)
    {
        header('Content-Type: application/json');
        print json_encode($outputData);
    }

}