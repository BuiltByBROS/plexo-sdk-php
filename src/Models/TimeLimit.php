<?php
namespace Plexo\Sdk\Models;

class TimeLimit extends ModelsBase
{
    /**
     *
     * @var int 
     */
    public $SecondsLeft;

    /**
     *
     * @var Plexo\Sdk\Type\FieldType
     */
    public $RequirementAfterTimeLimit;

    public function __construct($secondsLeft, $requirementAfterTimeLimit) {
        $this->SecondsLeft = $secondsLeft;
        $this->RequirementAfterTimeLimit = $requirementAfterTimeLimit;
    }

    public function toArray() {
        return [
            'RequirementAfterTimeLimit' => $this->RequirementAfterTimeLimit,
            'SecondsLeft' => $this->SecondsLeft,
        ];
    }
}
