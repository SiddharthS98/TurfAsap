<?php

namespace App\Http\Controllers;

use App\Http\Requests\OwnerRequest;
use App\Model\Turf;
use App\Model\TurfFacility;
use App\Model\TurfImage;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $user = request()->user();
        $data = [];
        switch ($user->role->name) {
            case "Administrator":
                $data = \App\User::where('verified', 0)->get();
                break;
            case "Owner":
                $data = \App\Model\Turf::where('user_id', request()->user()->id)->get();
                break;
            case "User":
                $data = \App\Model\Booking::with(['turf'])->where('user_id', request()->user()->id)->latest()->get();
                break;
        }
        return view('home')->with('data', $data);
    }

    public function turf()
    {
        return view('home_turf');
    }

    public function turfbookings($id)
    {
        return view('turf_bookings')->with("id", $id);
    }

    public function newTurf(OwnerRequest $request) {
        $request = request();
        $t = new Turf();
        $t->name = $request->name;
        $t->address = $request->address;
        $t->price = $request->price;
        $t->type = $request->type;
        $t->from = $request->from;
        $t->to = $request->to;
        $t->capacity = $request->capacity;
        $t->width = $request->width;
        $t->length = $request->length;
        $t->longitude = $request->longitude;
        $t->latitude = $request->latitude;
        $t->footwear = $request->footwear;
        $t->user_id = $request->user()->id;
        $t->save();

        $facilities = ['Changing Room', 'Flood Lights', 'Seating Area', 'Rent Footwears', 'Rent Jerseys', 'Free water', 'Free Balls'];

        for ($i = 0; $i < 3; $i++) {
            $index = random_int(0, count($facilities)-1);
            $facility = $facilities[$index];

            $f = new TurfFacility();
            $f->facility = $facility;
            $f->value = 2;
            $f->turf_id = $t->id;
            $f->save();

            $im = new TurfImage();
            $im->image_path = 'https://lorempixel.com/640/480/sports/';
            $im->turf_id = $t->id;

            $im->save();
            unset($facilities[$index]);
            $facilities = array_values($facilities);
        }

        return redirect('/home');
    }


}
