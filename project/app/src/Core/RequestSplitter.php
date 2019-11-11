<?php
namespace RudiMVC\Core;

class RequestSplitter{
    
     private static $instance = null;
     
      public static function getInstance(){
         if (null === self::$instance) {
             self::$instance = new self;
         }
         return self::$instance;
    }
    
    public function split_request($request):array {

        $requestParts = [];
        if(!empty($request)){
            $first_chr = substr($request, 0,1);
            $req = $request;
            if(preg_match("/\//",$first_chr)){
                $req = substr($request, 1);
            }
            
            $args = explode("/", $req);
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
