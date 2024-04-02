<?php

require_once __DIR__ . '/../testsInit.php';
require_once __DIR__ .'/AbstractTestComponent.php';

use services\DBQuery\components\Values;

class ValuesTest extends AbstractTestComponent {
    protected $targetClass = Values::class;
    protected $toStringResult = ' (a, b, c) VALUES (1, 2, 3), (4, 5, 6), (7, 8, 9)';

    function setUp(): void {
        parent::setUp();
        $this->target = new $this->targetClass(['a', 'b', 'c']);
        $this->target[0]['a'] = 1;
        $this->target[0]['c'] = 3;
        $this->target[0]['b'] = 2;

        $this->target[1] = ['b' => 5, 'a' => 4, 'c' => 6];

        $this->target[2] = [7, 8, 9];
    }
}