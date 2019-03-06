<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Model\Booking;
use App\Model\Card;
use App\Notifications\NewTurfBooking;
use App\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Kyros\Responses\JSONResponse;
use Turfasap\ModelRepository\TurfRepository;

class BookingController extends Controller
{
    private $repo;

    private $response;

    public function __construct(TurfRepository $repository, JSONResponse $response)
    {
        $this->repo = $repository;
        $this->response = $response;
    }

    public function validateBooking (UserRequest $request, $id)
    {
        try {

            $starttime = Carbon::parse($request->startdate);
            $endtime = Carbon::parse($request->startdate);
            $starttime->setTime($request->starttime, 0);
            $endtime->setTime($request->starttime + $request->totaltime, 0);

            $data = Booking::with(['turf'])->where('turf_id', $id)->get()->filter(
                function ($booking) use ($starttime, $endtime, $request) {
                    $starttime1 = Carbon::parse($booking->date);
                    $endtime1 = Carbon::parse($booking->date);
                    $starttime1->setTime($booking->from, 0);
                    $endtime1->setTime($booking->from + $booking->hours, 0);

                    $date1 = Carbon::parse($request->startdate);
                    $date2 = Carbon::parse($booking->date);



                    if ($date1 == $date2) {
                        if ($starttime->greaterThanOrEqualTo($endtime1)) {
                            return false;
                        } else if ($endtime->greaterThanOrEqualTo($starttime1)) {
                            return true;
                        } else {
                            return true;
                        }
                    } else {
                        return false;
                    }
                }
            );

            if (count($data) > 0 ) {
                $data = $data->first();
                $starttime1 = Carbon::parse($data->date);
                $endtime1 = Carbon::parse($data->date);
                $starttime1->setTime($data->from, 0);
                $endtime1->setTime($data->from + $data->hours, 0);
                throw new Exception("Booking already existing between " . $starttime1->toDayDateTimeString() . " and " . $endtime1->toDayDateTimeString());
            }

            session(["turf_id" => $id]);
            session(["date" => $request->startdate]);
            session(["from" => $request->starttime]);
            session(["hours" => $request->totaltime]);
            session(["amount" => $request->amount]);

            return $this->response->success()->make();


        } catch (Exception $exception) {
            return $this->response->failed()->error($exception->getMessage())->make();
        }

    }

    public function bookTurfById(UserRequest $request)
    {
        $tid = session("turf_id");
        if ($tid != "") {
            $user_id = $request->user()->id;

            $c = new Card();
            $c->card_number = $request->card_number;
            $c->expiry_month = $request->expiry_month;
            $c->expiry_year = $request->expiry_year;
            $c->cvv = $request->cvv;
            $c->user_id = $user_id;
            $c->save();

            $b = new Booking();
            $b->user_id = $user_id;
            $b->turf_id = $tid;
            $b->card_id = $c->id;
            $b->date = session('date');
            $b->from = session('from');
            $b->amount = session('amount');
            $b->hours = session('hours');
            $b->save();


            User::find($user_id)->notify(new NewTurfBooking($b));
            User::find($b->turf->user->id)->notify(new NewTurfBooking($b));
            return $this->response->success()->make();
        } else {
            return $this->response->failed()->error("Sorry, it did not work")->make();

        }
    }
}
