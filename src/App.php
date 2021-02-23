<?php declare(strict_types=1);
namespace Main\App;
class App { 
    private static $config = [
        'url' => 'https://goldmanrecruitment.pl/wp-json/appmanager/v1/ads',
        'fieldsToShow' => ['title','intro', 'refNumber', 'description', 'url']
    ];

    public static function run():void {
        $offers  = self::readOffers();  
        $filter = new Filter(static::$config['fieldsToShow'], $offers);
        $filter->apply();
        $filtredData = $filter->getFiltredData();        
        self::printOffers($filtredData);
        echo " Odczytanych ofert: " . Filter::getCountOfFiltred();
        
    }
    
    protected static function readOffers():array {
        $client = new HttpClient();
        $responseHandler = new ResponseHandler($client->send(static::$config['url'], 1));
        
        $offers = $responseHandler->getAds();
        for ($i = 22; $i <= $responseHandler->getPages(); $i++) {    
          $responseHandler = new ResponseHandler($client->send(static::$config['url'],$i));
          foreach ($responseHandler->getAds() as $offer) {
              array_push($offers, $offer);
          } 
          echo "odczyt ofert " . count($offers)  .' na ' . $responseHandler->getTotal() . "\r\n";
        }
        return $offers;
    }
    
    protected static function printOffers($filtredData):void {
        foreach ($filtredData as $item) {        
            echo $item['title'] . ' | ' . $item['intro'] . ' | ' . $item['refNumber'] . ' | ' 
                                . $item['url'] . "\r\n\r\n" 
                                . trim(strip_tags($item['description'])) . "\r\n" . '----------------------';
        }
    } 

    public static function getUrl(): string {
        return static::$config['url'];
    }

    public static function getFieldsToShow() : array {
        return static::$config['fieldsToShow'];

    }
}