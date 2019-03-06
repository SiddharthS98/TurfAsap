@extends('layouts.app')

@section('content')
    <turfs url="{{ route('ajax-turfs') }}" search_query="{{ request()->filter }}" ></turfs>
@endsection

@section('scripts')

@endsection