<?php

namespace Multiexception\Exceptions;

use Multiexception\IteratorTrait;

/**
 * Class Errors
 * @package App
 */
class Errors extends \Exception implements \Iterator
{
    use IteratorTrait;

    /** @var array Should contain a data */
    protected $data = [];

    /**
     * add object Exception in array data
     * @param \Exception $e
     * @return void
     */
    public function add(\Exception $e)
    {
        $this->data[] = $e;
    }

    /**
     * get data array of exceptions
     * @return array
     */
    public function getErrors()
    {
        return $this->data;
    }

}