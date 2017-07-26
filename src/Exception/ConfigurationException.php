<?php

namespace Plexo\Client\Exceptions;

class ConfigurationException extends \Plexo\Sdk\Exception\PlexoException
{
    public function __construct($message)
    {
        parent::__construct($message, ResultCodes::SystemError);
    }
}
