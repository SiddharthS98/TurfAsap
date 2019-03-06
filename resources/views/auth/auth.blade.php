@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row" style="margin-bottom: 0">
            <div class="col s12 offset-m2 offset-m8 offset-l0 l5">
                @include('partials.register')
            </div>
            <div class="col s12 offset-m2 offset-m8 offset-l2 l5">
                @include('partials.login')
            </div>
        </div>
    </div>
{{--
    <v-container grid-list-md text-xs-center>
        <v-layout row wrap align-center justify-space-around >
            <v-flex xs5>
                <v-card
                        class="flex"
                        dark
                        tile
                >
                    <v-card-title primary-title>
                        <div class="headline">Login</div>

                    </v-card-title>

                    <v-card-title>
                        <v-form v-model="valid" class="flex">
                            <v-text-field
                                    v-model="name"
                                    :rules="nameRules"
                                    :counter="10"
                                    label="Name"
                                    required
                            ></v-text-field>
                            <v-text-field
                                    v-model="email"
                                    :rules="emailRules"
                                    label="E-mail"
                                    required
                            ></v-text-field>
                        </v-form>
                    </v-card-title>

                    <v-card-actions class="justify-end">
                        <v-btn flat color="blue">Submit</v-btn>
                    </v-card-actions>
                </v-card>
            </v-flex>
            <v-flex xs5>
                <v-card
                        class="flex"
                        dark
                        tile
                >
                    <v-card-title>
                        <strong class="headline">Register</strong>

                    </v-card-title>

                    <v-card-actions class="justify-end">
                        <v-btn flat color="blue">Submit</v-btn>
                    </v-card-actions>
                </v-card>
            </v-flex>
        </v-layout>
    </v-container>--}}

{{--<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}" aria-label="{{ __('Register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>--}}
@endsection

@section('scripts')

@endsection
