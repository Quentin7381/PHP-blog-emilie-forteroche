<?php

abstract class TestSetup extends PHPUnit\Framework\TestCase{

    protected $targetClass = '';

    public function setUp(): void{
        if(!empty($this->targetClass)){
            $this->setReflexionClassUp('class', $this->targetClass);
        }
    }

    public function tearDown(): void{
    }

    function testSetUp(){
        $this->assertTrue(true);
    }

    function setReflexionClassUp($classKey = 'class', $className = null){
        if(empty($className)){
            $className = static::$className;
        }
        
        $this->$classKey = [
            'class' => null,
            'properties' => [],
            'methods' => [],
            'instance' => null
        ];

        $this->$classKey['class'] = new ReflectionClass($className);

        // set private/protected properties accessible
        foreach($this->$classKey['class']->getProperties() as $property){
            $property->setAccessible(true);
            $this->$classKey['properties'][$property->getName()] = $property;
        }

        // set private/protected methods accessible
        foreach($this->$classKey['class']->getMethods() as $method){
            $method->setAccessible(true);
            $this->$classKey['methods'][$method->getName()] = $method;
        }

        // create an instance of the class
        $this->$classKey['instance'] = $this->$classKey['class']->newInstanceWithoutConstructor();
    }
}