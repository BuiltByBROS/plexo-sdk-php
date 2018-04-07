<?php
namespace Plexo\Sdk\Models;

use Plexo\Sdk\Exception;

abstract class ModelsBase implements \ArrayAccess
{
    /**
     * 
     * @param array $params
     */
    public function __construct(array $params = []) {
        foreach ($params as $k => $v) {
            $this->{$k} = $v;
        }
    }

    public function offsetSet($offset, $value)
    {
        $this->{$offset} = $value;
    }

    public function offsetExists($offset) {
        return isset($this->{$offset});
    }

    public function offsetUnset($offset) {
        unset($this->{$offset});
    }

    public function offsetGet($offset) {
        return isset($this{$offset}) ? $this->{$offset} : null;
    }

    public function validate()
    {
        $scheme = call_user_func(array(get_called_class(), 'getValidationMetadata'));
        $errors = [];
        foreach ($scheme as $key => $val) {
            if ($val['required'] && is_null($this->data[$key])) {
                array_push($errors, new Exception\InvalidArgumentException(sprintf('%s cannot be empty', $key)));
            }
            switch ($val['type']) {
                case 'int':
                    if (!is_int($this->data[$key]) && is_numeric($this->data[$key])) {
                        $this->data[$key] = (int) $this->data[$key];
                    }
                    break;
                case 'string':
                    if (!is_string($this->data[$key]) && is_scalar($this->data[$key])) {
                        $this->data[$key] = (string) $this->data[$key];
                    }
                    break;
            }
            if (!is_null($this->data[$key]) && $val['type'] !== 'class' && !call_user_func('is_' . $val['type'], $this->data[$key])) {
                array_push($errors, new Exception\InvalidArgumentException(sprintf('%s must be of type %s, %s given.', $key, $val['type'], gettype($this->data[$key]))));
            }
        }
        return count($errors) ? $errors : false;
    }

    public static function fromArray($data)
    {
        $inst = new static();
        foreach ($data as $k => $v) {
            $k = ucfirst($k);
            $setter = 'set'.$k;
            if (method_exists($inst, $setter)) {
                call_user_func([$inst, $setter], $v);
            } else {
                $inst->{$k} = $v;
            }
        }
        return $inst;
    }
}
