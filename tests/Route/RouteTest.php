<?php

require_once __DIR__ . '/../testsInit.php';

class RouteTest extends TestSetup{
    protected $targetClass = router\AbstractRouter::class;
    protected $target;

    public function test__decompose(){
        $routes = [
            'http://localhost:8080/' => [[], []],
            'http://localhost:8080/one' => [['one'], []],
            'http://localhost:8080/one/two' => [['one', 'two'], []],
            'http://localhost:8080/one/two?three=four' => [['one', 'two'], ['three' => 'four']],
            'http://localhost:8080/one/two?three=four&five=six' => [['one', 'two'], ['three' => 'four', 'five' => 'six']],
        ];

        foreach($routes as $url => $expected){
            $actual = $this->class['methods']['decompose']->invoke(null, $url);
            $this->assertEquals($expected, $actual);
        }
    }

}

class RouterExtension extends router\AbstractRouter{}
