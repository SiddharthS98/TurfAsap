<div class="card grey darken-3 white-text">
    <form action="{{ route("login") }}" method="post">
        {{ csrf_field() }}
    <div class="card-content">
        <span class="card-title"> Login </span>
        <hr>
        <div class="row" style="margin-bottom: 0">

            <div class="input-field col s12">
                <input id="email" type="email" name="email" class="validate" value="{{ old('email') }}" required placeholder="Enter your email">
            </div>
        </div>
        <div class="row" style="margin-bottom: 0">


            <div class="input-field col s12">
                <input id="password" type="password" name="password" class="validate" placeholder="Enter your password">
            </div>
        </div>
        <div class="row" style="margin-bottom: 0">
            @if ($errors->has('email'))
                <div class="card-panel red">
                    <span>
                         <p>{{ $errors->first('email') }}</p>
                    </span>
                </div>
            @endif
            @if ($errors->has('password'))
                <div class="card-panel red">
                    <span>
                         <p>{{ $errors->first('password') }}</p>
                    </span>
                </div>
            @endif
        </div>
    </div>
    <div class="card-action right-align">
        <label for="remember" class="left"><input class="browser-default" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}> <span>Remember Me? </span></label>
        <button type="submit" class="btn btn-primary blue ">Submit</button>
    </div>
    </form>
</div>
<br>
<div class="card grey darken-3 white-text">
    <div class="card-content">
        <span class="card-title"> Social Login</span>
        <hr>
        <div class="row" style="margin-bottom: 0">
            <div class="input-field col s12">
                <a href="redirect/google" class="btn btn-primary red" style="width: 100%"> Login Via Google </a>
            </div>
        </div>


    </div>
</div>