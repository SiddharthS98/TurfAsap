@extends('layouts.app')

@section('content')
    <book url="{!! route('ajax-turf-id', $turf->id) !!}" :turf='{!! $turf !!}'></book>
@endsection

@section('scripts')

@endsection