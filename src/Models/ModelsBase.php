<?php
namespace Plexo\Sdk\Models;

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

    public static function fromArray($data)
    {
        $inst = new static();
        foreach ($data as $k => $v) {
            $k = ucfirst($k);
            $setter = 'set'.$k;
var_dump($setter);
            if (method_exists($inst, $setter)) {
                call_user_func([$inst, $setter], $v);
            } else {
                $inst->{$k} = $v;
            }
        }
        return $inst;
    }
}
