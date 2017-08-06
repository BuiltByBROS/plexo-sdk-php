<?php
namespace Plexo\Sdk\Type;

abstract class ActionType
{
    const SELECT_INSTRUMENT = 1;
    const REGISTER_INSTRUMENT = 2;
    const DELETE_INSTRUMENT = 4;
    const SESSION_EXTEND_AMOUNT = 8;
    const CLIENT_EXTEND_AMOUNT = 16;
}
