@extends('layouts.app')

@section('content')
    <permalink url="{!! route('ajax-turf-id', $turf->id) !!}" :auth='{!! Auth::user() ?? 0 !!}' :turf='{!! $turf !!}'></permalink>
@endsection

@section('scripts')

@endsection