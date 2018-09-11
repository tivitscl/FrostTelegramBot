<?php

/*
* This file is part of GeeksWeb Bot (GWB).
*
* GeeksWeb Bot (GWB) is free software; you can redistribute it and/or modify
* it under the terms of the GNU General Public License version 3
* as published by the Free Software Foundation.
* 
* GeeksWeb Bot (GWB) is distributed in the hope that it will be useful,
* but WITHOUT ANY WARRANTY; without even the implied warranty of
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
* GNU General Public License for more details.  <http://www.gnu.org/licenses/>
*
* Author(s):
*
* © 2015 Kasra Madadipouya <kasra@madadipouya.com>
*
*/
require 'vendor/autoload.php';
require_once 'WeatherForecast.class.php';

$client = new Zelenin\Telegram\Bot\Api('195259989:AAEZp0NbqwDRnsS03T1_cDxf7e7e0nRcEto'); // Set your access token
$url = ''; // URL RSS feed
$update = json_decode(file_get_contents('php://input'));

//your app
try {
    
    

 if($update->message->text == '/fecha')
    {
        
    	$response = $client->sendChatAction(['chat_id' => $update->message->chat->id, 'action' => 'typing']);
    	$response = $client->sendMessage([
        	'chat_id' => $update->message->chat->id,
        	'text' => date('l jS \of F Y')
     	]);
    }
    else if($update->message->text == '/tiempo')
    {
       $weather = new WeatherForecast('3b23b02397364b97a3b153007160604');

        // Defines the name of the city, the country and the number of days of forecast (between 1 and 5)
        $weather->setRequest('New York', 'United States Of America', 5);
        
        // Defines the US unit of measurement
        $weather->setUSMetric(true);
        
        
        
        
        $response = $weather->getLocalWeather();
            
        $response = $client->sendChatAction(['chat_id' => $update->message->chat->id, 'action' => 'typing']);
    	$response = $client->sendMessage([
    		'chat_id' => $update->message->chat->id,
             if ($weather::$has_response){
                 'text' => $response->weather_now['weatherDesc']
             }esle{
                 'text' => "No he pillado que tiempo hace sorry"
             }
    		
    		]);


    }
    
     else if($update->message->text == '/help')
    {
    	$response = $client->sendChatAction(['chat_id' => $update->message->chat->id, 'action' => 'typing']);
    	$response = $client->sendMessage([
    		'chat_id' => $update->message->chat->id,
    		'text' => "List of commands :\n /email -> Get email address of the owner \n /latest -> Get latest posts of the blog 
    		/help -> Shows list of available commands"
    		]);

    }
    
    else if($update->message->text == '/insulto')
    {
    $strings = array(
    'Gilipollas',
    'Comemierda',
    'Payaso',
    'Subnormal',
        'Tonto de los cojones',
    'Mendrugo',
        'Cansalmas',
    'Imbecil',
        'Tontopolla',
    'Vete a la mierda cabrom',
        'Capullo',
    'Tontaco',
        
    );
        $key = array_rand($strings);


        
    	$response = $client->sendChatAction(['chat_id' => $update->message->chat->id, 'action' => 'typing']);
    	$response = $client->sendMessage([
        	'chat_id' => $update->message->chat->id,
        	'text' => $strings[$key]
     	]);

    }
    else
    {
    	$response = $client->sendChatAction(['chat_id' => $update->message->chat->id, 'action' => 'typing']);
    	$response = $client->sendMessage([
    		'chat_id' => $update->message->chat->id,
    		'text' => "Invalid command, please use /help to get list of available commands"
    		]);
    }

} catch (\Zelenin\Telegram\Bot\NotOkException $e) {

    //echo error message ot log it
    //echo $e->getMessage();

}