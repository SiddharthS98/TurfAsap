@extends('layouts.app')

@section('content')

    @if(request()->user()->role->name == "Owner")
        <div class="container">
            <div class="row">
                <div class="col l12 m12 s12">

                    <div class="card grey darken-3">
                        <div class="card-content">
                            <h3>Add new turf</h3>

                        <div class="row">
                            <form action="/home/turf" method="post">
                                {{ csrf_field() }}

                                <div class="row" style="margin-bottom: 0">
                                    <div class="input-field col s12">
                                        <input name="name" id="name" type="text" class="validate" placeholder="Enter turf name">
                                    </div>
                                </div>

                                <div class="row" style="margin-bottom: 0">
                                    <div class="input-field col s12">
                                        <input name="address" id="address" type="text" class="validate" placeholder="Enter turf address" onfocus="initAutocomplete()">
                                    </div>
                                </div>

                                <div class="row" style="margin-bottom: 0">
                                    <div class="input-field col s12 register">
                                        <select name="from" id="from" class="browser-default" >
                                            @for($i=0; $i<24; $i++)
                                                <option value="{{ $i }}"> {{ $i }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>

                                <div class="row" style="margin-bottom: 0">
                                    <div class="input-field col s12 register">
                                        <select name="to" id="to" class="browser-default" >
                                            @for($i=0; $i<24; $i++)
                                                <option value="{{ $i }}"> {{ $i }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                                <input type="hidden" id="lat" name="latitude">
                                <input type="hidden" id="lng" name="longitude">
                                <div class="row" style="margin-bottom: 0">
                                    <div class="input-field col s12">
                                        <input name="type" id="type" type="text" class="validate" placeholder="Enter turf type">
                                    </div>
                                </div>

                                <div class="row" style="margin-bottom: 0">
                                    <div class="input-field col s12">
                                        <input name="length" id="length" type="number" class="validate" placeholder="Enter turf length">
                                    </div>
                                </div>

                                <div class="row" style="margin-bottom: 0">
                                    <div class="input-field col s12">
                                        <input name="width" id="width" type="number" class="validate" placeholder="Enter turf width">
                                    </div>
                                </div>

                                <div class="row" style="margin-bottom: 0">
                                    <div class="input-field col s12">
                                        <input name="capacity" id="capacity" type="number" class="validate" placeholder="Enter turf capacity">
                                    </div>
                                </div>
                                <div class="row" style="margin-bottom: 0">
                                    <div class="input-field col s12">
                                        <input name="price" id="price" type="number" class="validate" placeholder="Enter turf price">
                                    </div>
                                </div>

                                <div class="row" style="margin-bottom: 0">
                                    <div class="input-field col s12">
                                        <input name="footwear" id="footwear" type="text" class="validate" placeholder="Enter allowed footwear">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s12">
                                        <button type="submit" id="submit" name="submit"> Submit </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    @endif
    
@endsection

@section('script')
    <script>
        {{-- @todo (RAJ) Remove code for native location --}}
        // This example displays an address form, using the autocomplete feature
        // of the Google Places API to help users fill in the information.

        // This example requires the Places library. Include the libraries=places
        // parameter when you first load the API. For example:
        // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">

        var placeSearch, autocomplete,nativeAutoComplete;
        var componentForm = {
            street_number: 'short_name',
            route: 'long_name',
            locality: 'long_name',
            administrative_area_level_1: 'long_name',
            administrative_area_level_2: 'long_name',
            country: 'long_name',
            postal_code: 'short_name'
        };

        function initAutocomplete() {
            // Create the autocomplete object, restricting the search to geographical
            // location types.
            autocomplete = new google.maps.places.Autocomplete(
                /** @type {!HTMLInputElement} */(document.getElementById('address')),
                {types: ['geocode'],componentRestrictions: {country: 'in'}});
            // When the user selects an address from the dropdown, populate the address
            // fields in the form.
            autocomplete.addListener('place_changed', function(){
                fillInAddress(0);
            });

        }
        function fillInAddress(type) {
            // Get the place details from the autocomplete object.
            var place;
            if(type==0) place = autocomplete.getPlace();
            else place = nativeAutocomplete.getPlace();

            document.getElementById('lat').value = place.geometry.location.lat();
            document.getElementById('lng').value = place.geometry.location.lng();

        }

        // Bias the autocomplete object to the user's geographical location,
        // as supplied by the browser's 'navigator.geolocation' object.
        function geolocate() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function (position) {
                    var geolocation = {
                        lat: position.coords.latitude,
                        lng: position.coords.longitude
                    };
                    var circle = new google.maps.Circle({
                        center: geolocation,
                        radius: position.coords.accuracy
                    });
                    autocomplete.setBounds(circle.getBounds());
                });
            }
        }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA4iWw0LCGTXJy6nxP37xO-GMu8XU4NGbc&libraries=places&callback=initAutocomplete" async defer></script>
    @endsection