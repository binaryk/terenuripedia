@extends('frontend.layouts.master')

@section('content')
    <div class="log-fundal">

        <div class="log">

            <div class="panel panel-default">
                <div class="log-heading">{!! HTML::image('/img/lock-blue.png', 'a picture') !!} </br> <div class="log-title">{{ trans('labels.change_password_box_title') }}</div></div>
            


				<div class="panel-body">

                       {!! Form::open(['route' => ['password.change'], 'class' => 'form-horizontal']) !!}


                              <div class="form-group">
                                  {!! Form::label('password', trans('validation.attributes.new_password'), ['class' => 'col-md-4 control-label']) !!}
                                  <div class="col-md-6">
                                      {!! Form::input('password', 'password', null, ['class' => 'form-control']) !!}
                                  </div>
                              </div>

                              <div class="form-group">
                                  {!! Form::label('password_confirmation', trans('validation.attributes.new_password_confirmation'), ['class' => 'col-md-4 control-label']) !!}
                                  <div class="col-md-6">
                                      {!! Form::input('password', 'password_confirmation', null, ['class' => 'form-control']) !!}
                                  </div>
                              </div>

                              <div class="form-group">
                                  <div class="col-md-6 col-md-offset-4">
                                      {!! Form::submit(trans('labels.change_password_button'), ['class' => 'btn btn-primary']) !!}
                                  </div>
                              </div>

                       {!! Form::close() !!}

				</div><!--panel body-->

			</div><!-- panel -->

		</div><!-- col-md-10 -->

	</div><!-- row -->
@endsection