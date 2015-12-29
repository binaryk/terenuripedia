@extends('frontend.layouts.master')
@section('content')
	<div class="log-fundal">
		<div class="log">
			<div class="panel panel-default">
                <div class="log-heading">{!! HTML::image('/img/profile-blue.png', 'a picture') !!} </br> <div class="log-title">{{ trans('labels.register_box_title') }}</div></div>

				<div class="log-body">

					{!! Form::open(['to' => 'auth/register', 'class' => 'form-horizontal', 'role' => 'form']) !!}

						<div class="form-group">
							{!! Form::label('name', trans('validation.attributes.name'), ['class' => 'log-label']) !!}
							<div class="md-6">
								{!! Form::input('name', 'name', old('name'), ['class' => 'log-control']) !!}
							</div>
						</div>

						<div class="form-group">
							{!! Form::label('email', trans('validation.attributes.email'), ['class' => 'log-label']) !!}
							<div class="md-6">
								{!! Form::input('email', 'email', old('email'), ['class' => 'log-control']) !!}
							</div>
						</div>

						<div class="form-group">
							{!! Form::label('phone', trans('validation.attributes.phone'), ['class' => 'log-label']) !!}
							<div class="md-6">
								{!! Form::input('phone', 'phone', old('phone'), ['class' => 'log-control']) !!}
							</div>
						</div>
					@if($category == "saller")
						<div class="form-group type_id">
							{!! Form::label('type_id', trans('validation.attributes.type'), ['class' => 'log-label']) !!}
							<div class="md-6">
								{!! Form::selectType('type_id', '1', ['class' => 'log-control']) !!}
							</div>
						</div>
					@endif
						<div class="form-group">
							{!! Form::label('password', trans('validation.attributes.password'), ['class' => 'log-label']) !!}
							<div class="md-6">
								{!! Form::input('password', 'password', null, ['class' => 'log-control']) !!}
							</div>
						</div>

						<div class="form-group">
							{!! Form::label('password_confirmation', trans('validation.attributes.password_confirmation'), ['class' => 'log-label']) !!}
							<div class="md-6">
								{!! Form::input('password', 'password_confirmation', null, ['class' => 'log-control']) !!}
							</div>
						</div>

						<div class="form-group">
							<div class="md-6">
								{!! Form::submit(trans('labels.register_button'), ['class' => 'btn btn-confirm']) !!}
							</div>
						</div>

					{!! Form::close() !!}

				</div><!-- panel body -->

            </div><!-- panel -->

        </div><!-- col-md-8 -->

    </div><!-- row -->
@endsection
