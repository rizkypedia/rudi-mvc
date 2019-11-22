<?php


namespace RudiMVC\Core\Services;

use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Psr7;

class UptimeCheckerService {

    public function __construct() {
    }


    /**
     * @param string $url
     * @return bool
     */
    public function isReachable(string $url):bool {
        $reachableStatusCodes = [200, 301, 302];
        $httpClient = new HttpClient();
        try {
            $response = $httpClient->get($url);
            $status = $response->getStatusCode();
            if (in_array($status, $reachableStatusCodes)) {
                return true;
            } else {
                return false;
            }
        } catch (ClientException $e) {
            return false;
        }
    }

}