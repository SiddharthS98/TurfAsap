@extends('layouts.app')

@section('content')

    <payment url="{!! route('ajax-turf-id', $turf->id) !!}" :turf='{!! $turf !!}'></payment>
@endsection

@section('scripts')

@endsection