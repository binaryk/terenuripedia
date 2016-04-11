@extends('frontend.layouts.master')

@section('content')
    <div class="log-fundal">

        <div class="user_dashboard">

            <div class="panel panel-default">
                <div class="img-heading">{!! HTML::image('/img/lock-blue.png', 'a picture') !!}</div> 
                <div class="dash_left">
                <div class="log-title"><strong>{!! $user->name !!}</strong></div>
                    @if(access()->user()->hasRole('Saller'))
                    <div class="log-attr">{!! @App\Models\Access\User\User::type()[access()->user()->type_id] !!}</div>
                    <div class="log-attr">{!! @App\Models\Access\User\User::fizjur()[access()->user()->fiz_jur] !!}</div>
                    @endif
                    <div class="actions">     
                    <a href="{!!route('frontend.profile.edit')!!}" class="btn btn-primary btn-xs">{{ trans('labels.edit_information') }}</a>
                    @if (access()->user()->canChangePassword())
                        <a href="{!!url('auth/password/change')!!}" class="btn btn-warning btn-xs">{{ trans('navs.change_password') }}</a>
                    @endif
                    </div>  
                </div>  
                <div class="dash_left">
                    <div class="log-attr"><strong class="width-fix">{{ trans('validation.attributes.email') }} :</strong> {!! $user->email !!} </div>
                    <div class="log-attr"><strong class="width-fix">{{ trans('validation.attributes.phone') }} :</strong> {!! $user->phone !!}  </div>
                    <div class="log-attr"><strong class="width-fix">{{ trans('validation.attributes.type') }} :</strong> {!! @$user::type()[$user->type_id] !!} </div>
                    <div class="log-attr"><strong class="width-fix">{{ trans('validation.attributes.created_at') }} :</strong> {!! $user->created_at !!}</div>
                    <div class="log-attr"><strong class="width-fix">{{ trans('validation.attributes.last_updated') }} :</strong> {!! $user->updated_at !!}</div>
                </div>
            </div>
				

				<div class="istoric panel-body">
					<div role="tabpanel">
                      <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="profile">
                            <table class="table table-striped table-hover table-bordered dashboard-table">
                                <tr>
                                    <th>Terenuri publicate/deblocate</th>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th>Teren extravilan Bucuresti</th>
                                    <td>12.08.2016</td>
                                </tr>

                            </table>
                        </div><!--tab panel profile-->
                          
   
                      </div><!--tab content-->

                    </div><!--tab panel-->

				</div><!--panel body-->

			</div><!-- panel -->

		</div><!-- col-md-10 -->

	</div><!-- row -->
   <div class="log-fundal-image">
        
    </div>
@endsection