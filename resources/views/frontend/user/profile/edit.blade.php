@extends('frontend.layouts.master')

@section('content')
    <div class="log-fundal">

        <div class="log">

            <div class="panel panel-default">
                <div class="log-heading">{!! HTML::image('/img/lock-blue.png', 'a picture') !!} </br> <div class="log-title">{{ trans('labels.update_information_box_title') }}</div></div>
        
				<div class="panel-body">

                       {!! Form::model($user, ['route' => 'frontend.profile.update', 'class' => 'form-horizontal', 'method' => 'PATCH']) !!}

                              <div class="form-group">
                                    {!! Form::label('name', trans('validation.attributes.name'), ['class' => 'col-md-4 control-label']) !!}
                                    <div class="col-md-6">
                                        {!! Form::input('text', 'name', null, ['class' => 'form-control']) !!}
                                    </div>
                              </div>

                              <div class="form-group">
                                    {!! Form::label('phone', trans('validation.attributes.phone'), ['class' => 'col-md-4 control-label']) !!}
                                    <div class="col-md-6">
                                        {!! Form::input('text', 'phone', null, ['class' => 'form-control']) !!}
                                    </div>
                              </div>

                            @role('Saller')
                                <div class="form-group type_id">
                                    {!! Form::label('type_id', trans('validation.attributes.type'), ['class' => 'col-md-4 control-label']) !!}
                                    <div class="col-md-6">
                                        {!! Form::selectType('type_id', null, ['class' => 'form-control']) !!}
                                    </div>
                                </div>
                    
                                <div class="form-group fiz_jur">
                                    {!! Form::label('fiz_jur', trans('validation.attributes.fiz_jur'), ['class' => 'col-md-4 control-label']) !!}
                                    <div class="col-md-6">
                                        {!! Form::fizJur('fiz_jur', null, ['class' => 'form-control']) !!}
                                    </div>
                                </div>
                            @endauth
                              @if ($user->canChangeEmail())
                                  <div class="form-group">
                                      {!! Form::label('email', trans('validation.attributes.email'), ['class' => 'col-md-4 control-label']) !!}
                                      <div class="col-md-6">
                                          {!! Form::input('email', 'email', null, ['class' => 'form-control']) !!}
                                      </div>
                                  </div>
                              @endif

                              <div class="form-group">
                                  <div class="col-md-6 col-md-offset-4">
                                      {!! Form::submit(trans('labels.save_button'), ['class' => 'btn btn-primary']) !!}
                                  </div>
                              </div>

                       {!! Form::close() !!}

				</div><!--panel body-->

			</div><!-- panel -->

		</div><!-- col-md-10 -->

	</div><!-- row -->
@endsection

