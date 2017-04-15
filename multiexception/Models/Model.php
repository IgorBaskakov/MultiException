<?php

namespace Multiexception\Models;

use Multiexception\Exceptions\Errors;
use Multiexception\IteratorTrait;
use Multiexception\MagicTrait;

/**
 * Class Model
 * @package App\Models
 * @property int $id
 */
abstract class Model implements \Iterator
{

    use MagicTrait;
    use IteratorTrait;

    /** @var array Should contain a data */
    protected $data = [];

    /**
     * setter, value set in object through method setName
     * or through array data
     * @param string $name
     * @param $value
     */
    public function __set($name, $value)
    {
        $method = 'set' . ucfirst($name);

        if (method_exists($this, $method)) {
            $this->$method($value);
        } else {
            $this->data[$name] = $value;
        }
    }

    /**
     * fill errors object, where contains exceptions
     * @param array $data
     * @throws Errors
     * @return void
     */
    public function fill(array $data)
    {
        $errors = new Errors;
        foreach ($data as $key => $val) {
            try {
                $this->$key = $val;
            } catch (\Exception $e) {
                $errors->add($e);
            }
        }
        if (!empty($errors->getErrors())) {
            throw $errors;
        }
    }

}