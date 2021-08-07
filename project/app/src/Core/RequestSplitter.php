<?php
namespace RudiMVC\Core;

class RequestSplitter{
    
     private static $instance = null;

    /**
     * @return RequestSplitter|null
     */
    public static function getInstance(){
         if (null === self::$instance) {
             self::$instance = new self;
         }
         return self::$instance;
    }

    /**
     * @param string $requestUri
     * @return array
     */
    public function split_request(string $requestUri):array {

        $requestParts = [];
        if(!empty($requestUri)){
            $first_chr = substr($requestUri, 0,1);
            $req = $requestUri;
           
            if(preg_match("/\//", $first_chr)){
               $req = substr($requestUri, 1);
            }

            
            $args = explode("/", $req);
            $requestParts['api'] = false;      
            if($args[0]==="api"){
                $requestParts['api'] = true;
                array_shift($args);
            }
            $requestParts['controller'] = ucfirst($args[0]);
            $requestParts['action'] = (empty($args[1]) ? DEFAULT_CONTROLLER_ACTION . ACTION_SUFFIX : $args[1] . ACTION_SUFFIX);

            $params = [];
    
            if(!empty($args[2])){

                for($i = 2; $i < sizeof($args); $i++){
                    if(!empty($args[$i])){
                        $params[] = $args[$i];
                    }
                }
            }

            $requestParts['parameters'] = $params;
            
            return $requestParts;
        }
        
    }
    
}

?>
