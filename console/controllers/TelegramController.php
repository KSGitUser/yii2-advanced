<?php

use Solomenko;

class TelegrammController extends Controller
{

  private $bot;
  private $offset = 0;


  public function init()
  {
    patent::init();
    $this->bot = \Yii::$app->bot;
  }

  public function actionIndex() 
  {
      $updates = $this->bot->getUpdates($this->getOffset() + 1);
      $updCount = count($updates);
      if ($updCount > 0) {
        echo ("Новых сообщений {$updCount}\n");
        foreach ($updates as $update) {
          $message = $update->getMessage();
          if($this->pcocessCommand(
            $update->getMessage()->getText()
            ) {
            $this->updateOffset($update->getUpdate())
          })
        }
      }
  }

  private function getOffset() {
    $max = TelegramOffset::find()
      ->select("id")
      ->max("id");
    if ($max > 0) {
      $this->offset = $max;
    }
  }

  private function updateOffset(int $id) {
    (new TelegramOffset([
      'id' => $id,
      'timestamp' => date("Y-m-d h:i:s")
    ]))->save();
  }

  private function processCommand(string $message, int $fromId) {
   // "/command Param1 Param2 Param3"
   $params = explode(" ", $message);
   $command = $params[0];
   unset($params[0]);
   $response ="Uknown command";
   switch($command) {
     case '/help':

   }
  }
}