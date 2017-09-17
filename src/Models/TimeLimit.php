<?php
namespace Plexo\Sdk\Models;

class TimeLimit
{
    /**
     *
     * @var int 
     */
    public $SecondsLeft;

    /**
     *
     * @var FieldType 
     */
    public $RequirementAfterTimeLimit;

    public function __construct($secondsLeft, $requirementAfterTimeLimit) {
        $this->SecondsLeft = $secondsLeft;
        $this->RequirementAfterTimeLimit = $requirementAfterTimeLimit;
    }
}
