<?php 
/** 
* FirebaseManager
* Manages connection to the firebase of Ziq
*/
 
use Kreait\Firebase\Factory;

 class FirebaseManager{
       private $factory,
                $firebaseDb;


       public function FirebaseManager(){
           $this->factory = (new Factory())->withServiceAccount(__DIR__."/../includes/".Constants::HALI_FIREBASE_JSON);
            $this->factory = $this->factory->withDatabaseUri(Constants::HALI_NOSQL_DB);
            $this->firebaseDb = $this->factory->createDatabase();
          
       }

       /**
        * Saves data to the firebase realtime database
        */
       public function set($url, $data){
           $this->firebaseDb->getReference($url)->set($data);
       }

       /**
        * Removes data from the firebase realtime database
        */
       public function remove($url){
        $this->firebaseDb->getReference($url) ->remove();
       }

       /**
        * Returns the reference object for a url from firebase
        */
       public function ref($url){
           return $this->firebaseDb->getReference($url);
       }
 }

?>
      