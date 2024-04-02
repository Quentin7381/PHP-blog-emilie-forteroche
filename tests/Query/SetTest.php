<?php

require_once __DIR__ . '/../testsInit.php';
require_once __DIR__ .'/AbstractTestComponent.php';

use Utils\DBQuery\components\Set;

class SetTest extends AbstractTestComponent {
    protected $targetClass = Set::class;
    protected $toStringResult = ' SET name = John, age = 30';

    function setUp(): void {
        parent::setUp();
        $this->target['name'] = 'John';
        $this->target['age'] = 30;
    }
}
