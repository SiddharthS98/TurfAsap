<?php

namespace Kyros\Utils\VueTable\Responses;

use Illuminate\Support\Facades\Response;

/**
 * Class VueTableResponse
 * @package Kyros\Utils\VueTable\Responses
 */
class VueTableResponse
{
    private $response = [];

    /**
     * @param $key
     * @param $value
     * @return $this
     */
    public function with($key, $value)
    {
        $this->response = array_merge($this->response, [
            $key => $value
        ]);

        return $this;
    }
    /**
     * @return array
     */
    public function get(): array
    {
        return $this->response;
    }


    /**
     * @param $data
     * @param $request
     * @return mixed
     */
    public function makeResponse($data, $request)
    {

        $response = [
            "total" => $data->count(),
            "per_page" => $request->per_page,
            "current_page"=> $request->page,
            'sort' => $request->sort,
            'filter' => $request->filter,
            "last_page" => ceil($data->count()/10),
            "next_page_url" => $request->url(),
            "prev_page_url" => $request->url(),
            "from" => $request->page*$request->per_page + 1,
            "to" => ($request->page+1)*$request->per_page,
            "data" => $data
        ];

        return Response::json($response);
    }
}