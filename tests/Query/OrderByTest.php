<?php

require_once __DIR__ . '/../testsInit.php';
require_once __DIR__ .'/AbstractTestComponent.php';

use services\DBQuery\components\OrderBy;

class OrderByTest extends AbstractTestComponent {
    protected $targetClass = OrderBy::class;
    protected $toStringResult = ' ORDER BY column ASC, column_2 DESC';

    function setUp(): void {
        parent::setUp();
        $this->target['column'] = 'ASC';
        $this->target['column_2'] = 'DESC';
    }
}