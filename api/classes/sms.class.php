<?php 
/**
 * Sms manager or wrapper
 * If an SMS is long, it is splitted up and sent.
 */

require_once(__DIR__.'/../interfaces/smsconstants.interface.php');
#new-requirements-insert-point



class Sms implements  SmsConstantsInterface {
 
#new-traits-insert-point

  private $messages;

  /**
   * Sms
   * @param $message - The message to send.
   */
  public function __construct($message = ""){
    $this->messages = [];
    if($message != ""){
      $this->addMessage($message);
    }
  }

  /**
   * Sends and SMS
   */
  public function send($recipient){

    foreach($this->messages as $message){
      $this->sendMessage($message, $recipient);
    }

    return true;
  }

  /**
   * checks the credit balance
   */
  public function checkBalance(){

  }

  /**
   * checks the delivery status of a message
   */
  public function checkDeliveryStatus($messageId){

  }

  /**
   * splits the sms into chunk if its length is greater than
   * the length of a message.
   * @return array
   */
  private function splitMessage($message, $output = []){
    if(strlen($message) > Sms::MAX_LEN){
      if(preg_match("/\s/", $message[Sms::MAX_LEN - 1])){
         $output[] = substr($message, 0, Sms::MAX_LEN);
         return $this->splitMessage(substr($message, Sms::MAX_LEN - 1), $output);
      }

      for($i = Sms::MAX_LEN - 1; $i > 0; $i--){
        if(preg_match("/\s/", $message[$i])){
          $output[] = substr($message, 0, $i + 1);
          return $this->splitMessage(substr($message, $i), $output);
        }
      }

      $output[] = substr($message, 0, Sms::MAX_LEN);
      return $this->splitMessage(substr($message, Sms::MAX_LEN - 1), $output);
    }

    $output[] = $message;
    return $output;
  }

  /**
   * adds a message to the messages array.
   * The message is splited if it is too long
   */
  public function addMessage($message){
    $this->messages = array_merge($this->messages, $this->splitMessage($message));
  }

  /**
   * Sends an SMS
   */
  private function sendMessage($message, $recipient){
    
    $data = [
      "sender_name" => Sms::SENDER_NAME,
      "service_id" => 0,
      "response_type" => SMS::JSON,
      "message" => $message,
      "mobile" => $recipient
    ];
    
    $headers = [
      "Content-Type:application/json",
      "Accept: application/json",
      "h_api_key: ". Sms::API_KEY
    ];

    return $this->sendCurlRequest($data, $headers);
  }

  /**
   * Makes a post request
   */
  private function sendCurlRequest($data, $headers){
    $curl = curl_init(Sms::BASE_URL.Sms::ENDPNT_SENDSMS);
    $payload = json_encode($data);

    curl_setopt($curl, CURLOPT_POSTFIELDS, $payload);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

    $result = curl_exec($curl);
    curl_close($curl);
    return $result;
  }


}

?>
      