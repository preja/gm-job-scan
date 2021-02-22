<?php 
namespace Main\App;
class App {

    private static $config = [
        'url' => 'https://goldmanrecruitment.pl/wp-json/appmanager/v1/ads',
        'fieldsToShow' => ['title','intro', 'refNumber', 'description', 'url']
    ];

    public static function run() {
        $client = new HttpClient();
        $responseHandler = new ResponseHandler($client->send(static::$config['url']));
        $filter = new Filter(static::$config['fieldsToShow'], $responseHandler->getAds());
        $filter->apply();
        for ($i = 2; $i < $responseHandler->getPages(); $i++) {
             $filter = new Filter(static::$config['fieldsToShow'], $responseHandler->getAds());
             $filter->apply();
             $responseHandler = new ResponseHandler($client->send(static::$config['url'],$i));

         }
        
    }
}