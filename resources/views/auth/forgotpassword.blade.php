<!-- Reminder Form -->
{!! Form::open([
    'method' => 'POST',
    'url' => route('postForgotpassword'),
    'id' => 'form-reminder', 'class' => "form-horizontal form-bordered form-control-borderless display-none"
]) !!}
    <div class="form-group">
        <div class="col-xs-12">
            <div class="input-group">
                <span class="input-group-addon"><i class="gi gi-envelope"></i></span>
                {!! Form::email('email', null, ['id' => "reminder-email", 'class'=>'form-control', 'placeholder' => 'example@example.com']) !!}

                @if ($errors->has('email'))
                    <span class="help-block">{{ $errors->first('email') }}</span>
                @endif
            </div>
        </div>
    </div>
    <div class="form-group form-actions">
        <div class="col-xs-12 text-right">
            <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-angle-right"></i> Reset
                Password
            </button>
        </div>
    </div>
    <div class="form-group">
        <div class="col-xs-12 text-center">
            <small>Did you remember your password?</small>
            <a href="javascript:void(0)" id="link-reminder">
                <small>Login</small>
            </a>
        </div>
    </div>
{!! Form::close() !!}
<!-- END Reminder Form -->