<?php
namespace Kyros\Responses;

/**
 * Class JSONResponse
 * @package Kyros\Responses
 */
class JSONResponse
{
    private $successArray = [];

    private $failedArray = [];

    private $response = [];

    /**
     * JSONResponse constructor.
     */
    public function __construct()
    {
        $this->successArray = ['success' => true];
        $this->failedArray = ['success' => false];

    }

    /**
     * @return JSONResponse
     */
    public static function init() {

        return new JSONResponse();

    }

    /**
     * @return $this
     */
    public function success()
    {
        $this->response($this->successArray);
        return $this;
    }

    /**
     * @return $this
     */
    public function failed()
    {
        $this->response($this->failedArray);
        return $this;
    }

    /**
     * @param $argument
     * @return $this
     */
    public function error($argument)
    {
//        $response = !is_array($argument) ? array('error'=>$argument) : $argument;

        $error = collect($argument)->values()->first();
        $error = is_array($error) ? collect($error)->values()->first() : $error;

        $response = ['error' => $error];
        $this->response($response);

        return $this;
    }

    /**
     * @param $argument
     * @return $this
     */
    public function with($argument)
    {
        $response = !is_array($argument) ? array('message'=>$argument) : $argument;
        $this->response($response);
        return $this;
    }

    /**
     * @return array
     */
    public function make()
    {

        return $this->response;
    }

    /**
     * @param $array
     */
    private function response($array)
    {
        $this->response = array_merge($this->response,$array);
    }

}