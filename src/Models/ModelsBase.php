<?php
namespace Plexo\Sdk\Models;

use Plexo\Sdk\Exception;

abstract class ModelsBase implements \ArrayAccess
{

    protected $data = [];

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
        $this->__set($offset, $value);
    }

    public function offsetExists($offset)
    {
        return array_key_exists($offset, $this->data);
    }

    public function offsetUnset($offset)
    {
        if (array_key_exists($offset, $this->data)) {
            $this->data[$offset] = null;
        }
    }

    public function offsetGet($offset)
    {
        return $this->__get($offset);
    }

    public function __set($key, $value)
    {
        $setter = 'set'.$key;
var_dump($setter);
        if (method_exists($this, $setter)) {
            call_user_func([$this, $setter], $value);
        }
        if (array_key_exists($key, $this->data)) {
            $this->data[$key] = $value;
        }
    }

    public function __get($offset)
    {
        return array_key_exists($offset, $this->data) ? $this->data[$offset] : null;
    }

    public function validate(&$errors = array())
    {
        $scheme = call_user_func(array(get_called_class(), 'getValidationMetadata'));
//        $errors = [];
        foreach ($scheme as $key => $val) {
            if ($val['required'] && is_null($this->data[$key])) {
                array_push($errors, [
                    'class' => get_called_class(),
                    'error' => sprintf('%s cannot be empty', $key)
                ]);
                continue;
            }
            switch ($val['type']) {
                case 'int':
                    if (!is_int($this->data[$key]) && is_numeric($this->data[$key])) {
                        $this->data[$key] = (int) $this->data[$key];
                    }
                    break;
                case 'float':
                    if (!is_float($this->data[$key]) && is_numeric($this->data[$key])) {
                        $this->data[$key] = (float) $this->data[$key];
                    }
                    break;
                case 'string':
                    if (!is_string($this->data[$key]) && is_scalar($this->data[$key])) {
                        $this->data[$key] = (string) $this->data[$key];
                    }
                    break;
            }
            if (!is_null($this->data[$key]) && $val['type'] !== 'class' && !call_user_func('is_' . $val['type'], $this->data[$key])) {
                array_push($errors, [
                    'class' => get_called_class(),
                    'error' => sprintf('%s must be of type %s, %s given.', $key, $val['type'], gettype($this->data[$key])),
                ]);
            }
            if ($this->data[$key] instanceof self) {
                $this->data[$key]->validate($errors);
            }
        }
        return $errors;
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
                $inst->__set($k, $v);
            }
        }
        return $inst;
    }

    public function toArray($canonize = false)
    {
        return array_filter($this->data);
    }
}
