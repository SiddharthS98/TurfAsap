<div class="card grey darken-3 white-text">
    <form action="{{ route("register") }}" method="post">
        {{ csrf_field() }}
        <div class="card-content">
            <span class="card-title"> Register </span>
            <hr>
            <div class="row" style="margin-bottom: 0">
                <div class="input-field col s12">
                    <input name="r_name" id="r_name" type="text" class="validate" placeholder="Enter your name">
                </div>
            </div>
            <div class="row" style="margin-bottom: 0">
                <div class="input-field col s12">
                    <input name="r_email" id="r_email" type="email" class="validate"  placeholder="Enter your email">
                </div>
            </div>
            <div class="row" style="margin-bottom: 0">
                <div class="input-field col s12">
                    <input name="r_phone" id="r_phone" type="number" class="validate" placeholder="Enter your phone">
                </div>
            </div>
            <div class="row" style="margin-bottom: 0">
                <div class="input-field col s12">
                    <input name="r_password" id="r_password" type="password" class="validate" placeholder="Enter your password">
                </div>
            </div>
            <div class="row white-text" style="margin-bottom: 0">
                <div class="input-field col s12 register">
                    <select name="r_role" id="r_role">
                        @foreach(App\Model\Role::where('id', '<>','1')->get() as $role)
                            <option value="{{ $role->id }}"> {{ $role->name }} </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row">
                @if ($errors->has('r_name'))
                    <div class="card-panel red">
                    <span>
                         <p>{{ $errors->first('r_name') }}</p>
                    </span>
                    </div>
                @endif
                    @if ($errors->has('r_email'))
                    <div class="card-panel red">
                    <span>
                         <p>{{ $errors->first('r_email') }}</p>
                    </span>
                    </div>
                @endif
                    @if ($errors->has('r_phone'))
                    <div class="card-panel red">
                    <span>
                         <p>{{ $errors->first('r_phone') }}</p>
                    </span>
                    </div>
                @endif
                @if ($errors->has('r_password'))
                    <div class="card-panel red">
                    <span>
                         <p>{{ $errors->first('r_password') }}</p>
                    </span>
                    </div>
                @endif
            </div>
        </div>
        <div class="card-action right-align">
            <button type="submit" class="btn btn-primary blue ">Submit</button>
        </div>
    </form>
</div>