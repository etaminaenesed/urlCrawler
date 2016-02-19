<?php
namespace Api\V2;

/**
 * Class Client
 * @package Api\V2
 */
class Client {

    private $authToken;
    public $isAuthenticated;

    /**
     * Client construct
     * @param $authToken string
     */
    public function __construct($authToken)
    {
        try {
            $this->authToken = $authToken;
            $this->verifyToken();
        }
        catch(\Exception $e) {
            $this->authStatus = $e->getMessage();
        }
    }

    /**
     * Verify Token
     * @throws \Exception
     */
    private function verifyToken()
    {
        // check token
        if($this->authToken == 'abc') { $this->isAuthenticated = true; } else { $this->isAuthenticated = false; }
        if($this->isAuthenticated === false) { throw new \Exception('Authentication failed'); }
    }

}