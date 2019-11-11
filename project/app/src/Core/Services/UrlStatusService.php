<?php


namespace RudiMVC\Core\Services;


class UrlStatusService {
    /**
     * Checks the http status of a web page
     * @param string $url
     * @param int $tmout
     * @return bool
     */
    public function check(string $url, int $tmout = 10) {
        $timeout = $tmout;
        $ch = curl_init();
        curl_setopt ( $ch, CURLOPT_URL, $url );
        curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, 1 );
        curl_setopt ( $ch, CURLOPT_TIMEOUT, $timeout );
        $http_respond = curl_exec($ch);
        $http_respond = trim( strip_tags( $http_respond ) );
        $http_code = curl_getinfo( $ch, CURLINFO_HTTP_CODE );

        if ( ( $http_code == "200" ) || ( $http_code == "302" ) || $http_code = "301") {
            return true;
        } else {
            // return $http_code;, possible too
            return false;
        }
        curl_close( $ch );
    }
}