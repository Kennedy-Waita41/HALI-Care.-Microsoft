<?php

    class Response{

        private function __construct()
        {
            
        }

        /**
         * Make a new response
         * @param string $status - Status code
         * @param string $message - The message to send
         * @return string
         */
        public static function makeResponse($status, $message){
            $response = [
                "status" => $status, 
                "message" => $message
            ];
            return json_encode($response);
        }
    }

?>