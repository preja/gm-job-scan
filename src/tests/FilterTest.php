<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;
final class FilterTest extends TestCase
{ 
    private $properties = [];
    private $filter; 
    private $rhMock;

    protected function setUp(): void {
        $this->rhMock= $this->createMock(Main\App\ResponseHandler::class);
        $this->rhMock->method('getAds')->willReturn(

            [
                [
                
                'title' => 'oferta 1',
                'intro' => 'intro', 
                'refNumber' => '11111', 
                'description' => 'long desc', 
                'url' => 'https://test.pl/ads/1'
                ]
            ]);
            
        $this->properties = Main\App\App::getFieldsToShow();
        $this->filter = new Main\App\Filter($this->properties,  $this->rhMock->getAds());

    }
    

    public function testApply(): void {
        
        $this->filter->apply();
        $this->assertTrue($this->rhMock->getAds() === $this->filter->getFiltredData());
    }

    public function testCountOfFiltred(): void
    {    
         Main\App\Filter::resetCounter();
         $this->filter->apply();
         $this->assertEquals(Main\App\Filter::getCountOfFiltred(), count( $this->rhMock->getAds()));
        
    }
}