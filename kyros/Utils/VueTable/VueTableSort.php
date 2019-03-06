<?php

namespace Kyros\Utils\VueTable;

/**
 * Class VueTableSort
 * @package Kyros\Utils\VueTable
 */
class VueTableSort
{

    /**
     * @param $data
     * @param $sortingData
     * @return mixed
     */
    public function sortData($data, $sortingData)
    {
        $sorts = explode(',', $sortingData);

        foreach ($sorts as $sort) {
            list($sortCol, $sortDir) = explode('|', $sort);
            $data = $sortDir == "asc" ? $data->sortBy($sortCol) : $data->sortByDesc($sortCol);
        }

        return $data;
    }
}