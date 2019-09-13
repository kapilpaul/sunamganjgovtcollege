<div id="faq2" class="panel-group">
    <div class="panel panel-default">
        <div class="panel-heading" data-toggle="collapse" data-parent="#faq2" href="#faq2_q1" style="cursor:pointer;">
            <h4 class="panel-title">Filter Students</h4>
        </div>
        <div id="faq2_q1" class="panel-collapse collapse">
            <div class="panel-body">
                {!! Form::open(['method' => 'POST', 'route' => 'admin.participant.filter', 'class' => 'form-bordered mb-20']) !!}
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-4">
                            {!! Form::label('register_type', 'Register Type') !!}
                            {!! Form::select('register_type', [
                                'participate' => 'Register For Participate',
                                 'only_register' => "Only Register"
                             ], null, ["class" => "form-control"]) !!}

                            @include('common.form.validation', ['key' => 'register_type'])
                        </div>
                        <div class="col-md-4">
                            {!! Form::label('student_type', 'Student Type') !!}
                            {!! Form::select('student_type', ['current-student' => "Current Student", 'former-student' => "Former Student", 'nrb-former-student' => "NRB Former Student"], null, ["class" => "form-control"]) !!}

                            @include('common.form.validation', ['key' => 'student_type'])
                        </div>
                        <div class="col-md-3">
                            {!! Form::label('payment_status', 'Payment Status') !!}
                            {!! Form::select('payment_status', ['paid' => "Paid", "not_paid" => "Not Paid"], null, ["class" => "form-control"]) !!}

                            @include('common.form.validation', ['key' => 'payment_status'])
                        </div>
                        <div class="col-md-1">
                            <button type="submit" class="btn btn-sm btn-primary mt-25 pl-20 pr-20">Filter</button>
                        </div>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
