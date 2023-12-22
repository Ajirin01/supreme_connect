<?php 
require_once("Home.php"); // loading home controller

class Telegram_bot extends Home
{
    public function __construct()
    {

        parent::__construct();
        $this->load->library('telegram');
        $token = "5320890574:AAE6_MJbMWLhuM4gNbHvZhv8wyjxrQdbn4s";
        $link ="https://api.telegram.org/bot".$token;
        $server_link= "https://newrajshahi.com/telegram/telegram.php";
        $this->telegram->link = $link;
        $this->telegram->server_link = $server_link;

        
    }


    public function index()
    {
    	
		
        // $this->telegram->set_webhook();

        // first you must to get the command to your telegram 

           // $this->create_command();


          $this->telegram->load_command();
          // $this->delete_command();

         $data = $this->telegram->receive_data();

         if(isset($data['message']))
         {
               $this->telegram->msgId = $data['message']['from']['id'];
               $this->telegram->name = $data['message']['from']['first_name'];
               $this->telegram->chatId = $data['message']['chat']['id'];
               $this->telegram->text = $data['message']['text'];
               $regexEmoticons = '/[\x{1F600}-\x{1F64F}]/u';
               $this->telegram->text = preg_replace($regexEmoticons, '', $this->telegram->text);
               $this->telegram->reply_message();
         }
         elseif (isset($data['callback_query'])) {
                 // echo "callback";exit();
                $this->telegram->callback_data = $data['callback_query']['data'];
                $this->telegram->callback_id = $data['callback_query']['id'];
                $this->telegram->callback_from_id = $data['callback_query']['from']['id'];
                
                $this->telegram->callback_reply();
         }

    }

    public function create_command()
    {

        // $command_array = [

        //     [
        //         "command" => "bangla1", 
        //         "description" => "rono"
        //     ],
        //     [
        //         "command" => "bangla2", 
        //         "description" => "About Myself"
        //     ],
        //     [
        //         "command" => "bangla3",
        //         "description" => "About Ronok"
        //     ],
        // ];
        // $command_array = json_encode($command_array);

        // $parameters = array(
        //     'commands' => $command_array,
        //     'scope'=> json_encode(array('type'=>'default')),
        //     'language_code'=>'bn'
        // );
        // $this->telegram->send('setMyCommands', $parameters);


        $command_array2 = [
                    [
                        "command" => "korean",
                        "description" => "About Ronok"
                    ],
            ];
            $command_array2 = json_encode($command_array2);

            $parameters = array(
                    'commands' => $command_array2,
                    'scope'=> json_encode(array('type'=>'default')),
                    'language_code'=>'nl'
                );
         $this->telegram->send('setMyCommands', $parameters);
    }



    public function delete_command(){

        $parameters = array(
            'scope' => json_encode(array('type'=>'default')),
            'language_code'=>'bn'

        );
        $this->telegram->send('deleteMyCommands', $parameters);
    }

   
}




 ?>