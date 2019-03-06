<?php

namespace Kyros\Utils\VueTable;


/**
 * Class VueTable
 * @package Kyros\Utils\VueTable
 */
class VueTable
{

    private $processor;

    /**
     * VueTable constructor.
     * @param null $data
     */
    public function __construct($data = null)
    {
        $this->processor = new VueTableProcess($data);
    }

    /**
     * @param $data
     * @return VueTable
     */
    public static function with($data)
    {
        return new VueTable($data);
    }

    /**
     * @param $bool
     * @return $this
     */
    public function sort($bool = true)
    {
        $this->processor->sort($bool);
        return $this;
    }

    /**
     * @param $bool
     * @return $this
     */
    public function search($bool = true)
    {
        $this->processor->search($bool);
        return $this;
    }

    /**
     * @param $bool
     * @return $this
     */
    public function paginate($bool = true)
    {
        $this->processor->paginate($bool);
        return $this;
    }

    /**
     * @return mixed
     */
    public function make()
    {
        return $this->processor->getResponse();
    }

}