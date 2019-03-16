<?php
namespace console\components;

use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

class Chat implements MessageComponentInterface {
  protected $clients;

  public function __construct() {
      echo "Server started";
  }

  public function onOpen(ConnectionInterface $conn) {
       
      $queryString = $conn->httpRequest->getUri()->getQuery();
      $channel = explode("=", $queryString)[1]; 
      $this->clients[$channel][$conn->resourceId] = $conn;
      echo "New connection: ({$conn->resourceId})\n";
  }

  public function onMessage(ConnectionInterface $from, $msg) {        
       
        $data = json_decode($msg, true);
        echo "{$from->resourceId} : {$data['message']}\n";
        try{
            (new \common\models\tables\Chat($data))->save();
        }catch (\Exception $e) {
            var_dump($e->getMessage());
        }
      
      foreach ($this->clients[$data['channel']] as $client) {
              // The sender is not the receiver, send to each client connected
             
              $client->send($data['message']);
          
      }
  }

  public function onClose(ConnectionInterface $conn) {
      // The connection is closed, remove it, as we can no longer send it messages
      unset($this->clients[$conn->resourceId]);
      echo "Connection {$conn->resourceId} closed\n";
  }

  public function onError(ConnectionInterface $conn, \Exception $e) {
      echo "Error: {$e->getMessage()}\n";

      $conn->close();
  }
}