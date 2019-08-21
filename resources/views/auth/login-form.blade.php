<!-- Login Form -->
{!! Form::open([
    'method' => 'POST',
    'url' => route('postLogin'),
    'id' => 'form-login', 'class' => "form-horizontal form-bordered form-control-borderless"
]) !!}

    <div class="form-group has-error">
        <div class="col-xs-12">
            <div class="input-group">
                <span class="input-group-addon"><i class="gi gi-envelope"></i></span>
                {!! Form::email('email', null, ['id' => 'login-email', 'class'=>'form-control', 'placeholder' =>
                'example@example.com']) !!}

                @if ($errors->has('email'))
                    <span class="help-block">{{ $errors->first('email') }}</span>
                @endif
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="col-xs-12">
            <div class="input-group">
                <span class="input-group-addon"><i class="gi gi-asterisk"></i></span>
                {!! Form::password('password', ['id' => 'login-password', 'class'=>'form-control', 'placeholder' => 'Password']) !!}

                @if ($errors->has('password'))
                    <span class="help-block">{{ $errors->first('password') }}</span>
                @endif
            </div>
        </div>
    </div>
    <div class="form-group form-actions">
        <div class="col-xs-4">
            <label class="switch switch-primary" data-toggle="tooltip" title="Remember Me?">
                <input type="checkbox" id="login-remember-me" name="remember_me">
                <span></span>
            </label>
        </div>
        <div class="col-xs-8 text-right">
            <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-angle-right"></i> Login to
                Dashboard
            </button>
        </div>
    </div>
    <div class="form-group">
        <div class="col-xs-12 text-center">
            <a href="javascript:void(0)" id="link-reminder-login">
                <small>Forgot password?</small>
            </a>
        </div>
    </div>
{!! Form::close() !!}
<!-- END Login Form -->