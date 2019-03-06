<?php


namespace Kyros\Utils\VueTable;

/**
 * Class VueTableSearch
 * @package Kyros\Utils\VueTable
 */
class VueTableSearch
{
    /**
     * @param $data
     * @param $searchingData
     * @return mixed
     */
    public function searchData ($data, $searchingData)
    {

        $data = $data->map( function ($x) { return collect($x->toArray()); });
        //@TODO Replace with recursion
        $data = $data->filter( function ($v) use ($searchingData) {
            return $v->contains(function ($x) use ($searchingData) {

                if(is_array($x)) {

                    return collect($x)->contains(function ($z)  use ($searchingData) {

                        if(is_array($z)) {

                            return collect($z)->contains(function ($a) use ($searchingData) {

                                if (is_array($a)) {

                                    return collect($a)->contains(function ($b) use ($searchingData) {

                                        return $this->searchInString($b,$searchingData);

                                    });

                                }

                                return $this->searchInString($a,$searchingData);

                            });

                        }

                        return $this->searchInString($z,$searchingData);

                    });

                }

                return $this->searchInString($x,$searchingData);
//                return strpos(strtolower(str_replace(".", "", $x)), strtolower(str_replace(".", "", $searchingData))) > -1 || $x == $searchingData;
            });
        });

        return $data;
    }

    /**
     * @param $key
     * @param $subject
     * @return bool
     */
    private function searchInString($key, $subject)
    {
        return strpos(strtolower(str_replace(".", "", $key)), strtolower(str_replace(".", "", $subject))) > -1;
    }
}