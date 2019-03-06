<?php


namespace Kyros\Utils\VueTable;


use Kyros\Utils\VueTable\Responses\VueTableResponse;

/**
 * Class VueTableProcess
 * @package Kyros\Utils\VueTable
 */
class VueTableProcess
{
    private $data;
    private $totalData;

    private $sortable;
    private $sortingData;

    private $searchable;
    private $searchingData;

    private $paginated;
    private $paginatingData;

    private $response;

    private $request;


    /**
     * VueTableProcess constructor.
     * @param null $data
     */
    public function __construct($data = null)
    {
        $this->request = request();
        $this->totalData = $data->count();
        $this->sortable = $this->isSortable();
        $this->sortingData = $this->getSortingData();
        $this->searchable = $this->isSearchable();
        $this->searchingData = $this->getSearchingData();
        $this->paginated = $this->isPaginated();
        $this->paginatingData = $this->getPaginatingData();
        $this->data = $data;
        $this->response = new VueTableResponse($this->request);
    }

    /**
     * @param $bool
     */
    public function sort($bool)
    {
        if($bool && $this->sortable) {

            $sort = new VueTableSort();
            $this->data = $sort->sortData($this->data, $this->sortingData);

            $this->response
                ->with("sort", $this->sortingData);
        }
    }

    /**
     * @param $bool
     */
    public function search($bool)
    {
        if ($bool && $this->searchable) {

            $search = new VueTableSearch();
            $this->data = $search->searchData($this->data, $this->searchingData);

            $this->totalData = $this->data->count();
            $this->response
                ->with("filter", $this->searchingData);
        }
    }

    /**
     * @param $bool
     */
    public function paginate($bool)
    {
        if($bool && $this->paginated) {

            list($page,$perPage) = $this->paginatingData;
            $page = intval($page);
            $perPage = intval($perPage);
            $lastPage = ceil($this->totalData/$perPage);
            $from = ($page - 1) * $perPage + 1;
            $to = min ( $perPage * $page - $from , $this->totalData - $from) + $from;

//            $to = min($to, $this->totalData);

            $nextPageUrl = $this->paginationUrl($page <= $lastPage-1 ? $page+1 : $page, $perPage);
            $prevPageUrl = $this->paginationUrl($page >= 2 ? $page-1 : $page , $perPage);
            $paginate = new VueTablePaginate();
            $this->data = $paginate->paginateData($this->data, $this->paginatingData);

            $this->response
                ->with("last_page", $lastPage)
                ->with("per_page",$perPage)
                ->with("current_page",$page)
                ->with("to", $to)
                ->with("from", $from)
                ->with("next_page_url", $nextPageUrl)
                ->with("prev_page_url", $prevPageUrl);
        }
    }

    /**
     * @return array
     */
    public function getResponse()
    {
        return $this->makeResponse();
    }

    /**
     * @return bool
     */
    public function isSortable()
    {
        return $this->request->has('sort');
    }

    /**
     * @return bool
     */
    public function isSearchable()
    {
        return $this->request->has('filter');
    }

    /**
     * @return bool
     */
    public function isPaginated()
    {
        return $this->request->has('page') && $this->request->has('per_page');
    }

    /**
     * @return mixed
     */
    private function getSortingData()
    {
        return $this->request->sort;
    }

    /**
     * @return mixed
     */
    private function getSearchingData()
    {
        return $this->request->filter;
    }

    /**
     * @return array
     */
    private function getPaginatingData()
    {
        return [$this->request->page,$this->request->per_page];
    }

    /**
     * @param $page
     * @param $perPage
     * @return string
     */
    private function paginationUrl($page, $perPage)
    {
        $url = $this->request->url() . '?';

        if($this->searchable) $url .= "filter=".$this->searchingData;

        if($this->sortable) $url .= "&sort=".$this->sortingData;

        return $url . '&page=' .($page). '&per_page=' .$perPage;
    }

    /**
     * @return array
     */
    private function makeResponse()
    {
        $this->response
            ->with("total", $this->totalData)
            ->with("data", array_values($this->data->toArray())); // To fix sorting issue in google chrome with vueTable

        return $this->response->get();
    }

}