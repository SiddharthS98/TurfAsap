@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col l12 m12 s12">

                <div class="card grey darken-3">
                    <div class="card-content">
                        <h3>Dashboard</h3>
                    </div>
                    @if(request()->user()->role->name == "Owner")
                        <div class="card-content">

                            <h5>Turf Bookings</h5>


                            <table class="responsive-table centered highlight">
                                <thead>
                                <tr>
                                    <th>User Name</th>
                                    <th>Phone</th>
                                    <th>From</th>
                                    <th>To</th>
                                    <th>Money</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach(\App\Model\Booking::with(['user'])->where('turf_id', $id)->latest()->get() as $row)
                                    <tr>
                                        <td>{{ $row->user->name }}</td>
                                        <td>{{ $row->user->phone }}</td>
                                        <td>{{ \Carbon\Carbon::parse($row->date)->setTime($row->from,0)->toDayDateTimeString() }}</td>
                                        <td>{{ \Carbon\Carbon::parse($row->date)->setTime($row->from + $row->hours,0)->toDayDateTimeString() }}</td>
                                        <td>₹{{ $row->amount }}</td>
                                    </tr>

                                @endforeach
                                </tbody>
                            </table>

                        </div>
                    @endif


                </div>
            </div>
        </div>
    </div>
@endsection
