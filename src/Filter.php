<?php declare(strict_types=1);
namespace Main\App;

class Filter {

    private static $filtredCount = 0;

    private $filtredData = [];

    public function __construct($properties, $setOfData) {
        $this->properties = $properties;
        $this->setOfData = $setOfData;
    }

    public function apply() :void  {
        foreach ($this->setOfData as $item) {
          $this->filterItem($item);
        }
    }

    protected function filterItem($item) : void {
            $filtredItem = [];
            foreach ($this->properties as  $nameOfField) {
               $filtredItem[$nameOfField] = $item[$nameOfField] ?? ''; 
               if (!isset($item[$nameOfField])) {
                   echo 'brak pola dla oferty' . var_export($item,true);
               }
            }
            
            $this->filtredData[]= $filtredItem;  
            static::$filtredCount++;    
    }

    public function getFiltredData() : array {
        return $this->filtredData;
    }

    public static function getCountOfFiltred(): int {
        return static::$filtredCount;
    }

    public static function resetCounter() : void {
        static::$filtredCount = 0;
    }


}