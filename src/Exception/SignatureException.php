<?php
namespace Plexo\Sdk\Exception;

class SignatureException extends \Exception implements PlexoException {
    
    public function __construct($message) {
        parent::__construct($message, \Plexo\Sdk\ResultCode::INVALID_SIGNATURE);
    }
}
