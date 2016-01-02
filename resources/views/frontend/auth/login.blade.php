@extends('frontend.layouts.master')

@section('content')

    <div class="log-fundal">

        <div class="log">

            <div class="panel panel-default">
                <div class="log-heading">{!! HTML::image('/img/lock-blue.png', 'a picture') !!} </br> <div class="log-title">{{trans('labels.login_box_title')}}</div></div>

                <div class="log-body">

                    {!! Form::open(['url' => 'auth/login', 'class' => 'form-horizontal', 'role' => 'form']) !!}

                        <div class="form-group">
                            {!! Form::label('email', trans('validation.attributes.email'), ['class' => 'log-label']) !!}
                            <div class="md-6">
                                {!! Form::input('email', 'email', old('email'), ['class' => 'log-control']) !!}
                            </div>
                        </div>

                        <div class="form-group">
                            {!! Form::label('password', trans('validation.attributes.password'), ['class' => 'log-label']) !!}
                            <div class="md-6">
                                {!! Form::input('password', 'password', null, ['class' => 'log-control']) !!}
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="md-6">
                                <div class="checkbox">
                                    <label>
                                        {!! Form::checkbox('remember') !!} {{ trans('labels.remember_me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="md-6">
                                {!! Form::submit(trans('labels.login_button'), ['class' => 'btn btn-confirm', 'style' => 'margin-right:15px']) !!}

                               <span class="log-forgot"> {!! link_to('password/email', trans('labels.forgot_password')) !!}
                            </div>
                        </div>

                    {!! Form::close() !!}

                    <div class="row text-center">
                        {!! $socialite_links !!}
                    </div>
                </div><!-- panel body -->

            </div><!-- panel -->

        </div><!-- col-md-8 -->

    </div><!-- row -->

@endsection