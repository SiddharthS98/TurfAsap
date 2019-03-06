<?php

namespace Kyros\Utils\VueTable;


/**
 * Class VueTablePaginate
 * @package Kyros\Utils\VueTable
 */
class VueTablePaginate
{
    /**
     * @param $data
     * @param $paginationData
     * @return mixed
     */
    public function paginateData($data, $paginationData)
    {
        list($page, $perPage) = $paginationData;

        $data = $data->forPage($page,$perPage);

        return $data;
    }
}