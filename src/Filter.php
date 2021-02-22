<?php 
namespace Main\App;

class Filter {

    private static $filtedCount =0;

    private $filtredData = [];

    public function __construct($properties, $setOfData) {
        $this->properties = $properties;
        $this->setOfData = $setOfData;
    }

    public function apply() :void  {
        foreach ($this->setOfData as $item) {
          $this->filterItem($item);
        }
        echo static::$filtedCount;
    }

    protected function filterItem($item) : void {
            echo "oferta:" . "\r\n \r\n";
            foreach ($this->properties as $nameOfField) {
               echo $item[$nameOfField] ?? '' .  "<br /><br />";
               $this->filtredData[][$nameOfField] = $item[$nameOfField];  
            }
            static::$filtedCount++;    
    }

    public function getFiltredData() : array {
        return $this->filtredData;
    }

    public static function getCountOfFiltred() {
        return static::$filtedCount;
    }


}