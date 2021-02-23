<?php declare(strict_types=1);
namespace Main\App;
class App { 
    private static $config = [
        'url' => 'https://goldmanrecruitment.pl/wp-json/appmanager/v1/ads',
        'fieldsToShow' => ['title','intro', 'refNumber', 'description', 'url']
    ];

    public static function run():void {
        $client = new HttpClient();
        $responseHandler = new ResponseHandler($client->send(static::$config['url'], 1, 50));
        
        $offers = $responseHandler->getAds();
        for ($i = 2; $i <= $responseHandler->getPages(); $i++) {
         
          $responseHandler = new ResponseHandler($client->send(static::$config['url'],$i, 50));
          foreach ($responseHandler->getAds() as $offer) {
              array_push($offers, $offer);
          } 
          echo "odczyt ofert " . count($offers)  .' na ' . $responseHandler->getTotal() . "\r\n";
        }
        $filter = new Filter(static::$config['fieldsToShow'], $offers);
        $filter->apply();
        $filtredData = $filter->getFiltredData();        
        
        $mask = "%20s %s\n";
        foreach($filtredData as $item)
        {   
            foreach($item as $k => $v) {
              echo sprintf($mask, $k, $v);
            }
        }

        echo " Odczytanych ofert: " . Filter::getCountOfFiltred();
        
    }
    

    public static function getUrl(): string {
        return static::$config['url'];
    }

    public static function getFieldsToShow() {
        return static::$config['fieldsToShow'];

    }
}