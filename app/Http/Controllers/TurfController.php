<?php

namespace App\Http\Controllers;

use App\Http\Requests\OwnerRequest;
use App\Http\Requests\UserRequest;
use App\Model\Rating;
use App\Model\Turf;
use Illuminate\Http\Request;
use Kyros\Responses\JSONResponse;
use Kyros\Utils\VueTable\VueTable;
use Swis\LaravelFulltext\Search;
use Turfasap\Exception\ImageException;
use Turfasap\ModelRepository\TurfRepository;

class TurfController extends Controller
{
    private $repo;
    private $search;

    public function __construct(TurfRepository $repository, Search $search)
    {
        $this->repo = $repository;
        $this->search = $search;
    }

    public function index () {
        return view('turfs');
    }

    public function permalink ($id) {
        $turf = $this->repo->getTurfById($id);
        return view('permalink')->with('turf', $turf);
    }

    public function book ($id) {
        if (!request()->user()) {
            return redirect('login');

        }
        $turf = $this->repo->getTurfById($id);
        return view('book')->with('turf', $turf);
    }

    public function deleteTurfById(OwnerRequest $request, JSONResponse $response, $id)
    {
        Turf::find($id)->delete();

        return $response->success()->make();
    }

    public function rateTurfById(UserRequest $request, JSONResponse $response, $id)
    {
        try {
            $r = new Rating();
            $r->stars = request()->stars;
            $r->comment = request()->comment;
            $r->turf_id = $id;
            $r->user_id = auth()->user()->id;

            $r->save();
            return $response->success()->make();

        } catch (\Exception $exception) {
            return $response->failed()->error($exception->getMessage())->make();
        }

    }

    public function payment ($id) {
        if (!session('turf_id')) {
            return redirect('login');
        }
        $turf = $this->repo->getTurfById($id);
        return view('payment')->with('turf', $turf);
    }

    public function getAllTurfs (Request $request) {
        $dataSource = null;

        if ($request->filter) {
            $dataSource = $this->search
                                ->runForClass(request()->filter, Turf::class)
                                ->map(function ($data) {
                                   return $this->repo->getTurfById($data->indexable->id);
                                });
        } else {
            $dataSource = $this->repo->getAllTurfs();
        }

        return VueTable::with($dataSource)
                        ->sort()
                        ->paginate()
                        ->make();
    }

    public function getTurfById ($id) {
        return $this->repo->getTurfById($id);
    }

    public function getTurfImage ($id) {
        return $this->repo->retrieveTurfImage($id);
    }


}
