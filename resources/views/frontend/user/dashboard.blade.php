@extends('frontend.layouts.master')

@section('content')
    <div class="log-fundal">

        <div class="log">

            <div class="panel panel-default">
                <div class="log-heading">{!! HTML::image('/img/lock-blue.png', 'a picture') !!} </br> <div class="log-title">{{ trans('navs.my_information') }}</div></div>
				<div class="panel-heading">{{ trans('navs.dashboard') }}</div>

				<div class="panel-body">
					<div role="tabpanel">
                      <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="profile">
                            <table class="table table-striped table-hover table-bordered dashboard-table">
                                <tr>
                                    <th>{{ trans('validation.attributes.name') }}</th>
                                    <td>{!! $user->name !!}</td>
                                </tr>
                                <tr>
                                    <th>{{ trans('validation.attributes.email') }}</th>
                                    <td>{!! $user->email !!}</td>
                                </tr>
                                <tr>
                                    <th>{{ trans('validation.attributes.phone') }}</th>
                                    <td>{!! $user->phone !!}</td>
                                </tr>
                                @role('Saller')
                                <tr>
                                    <th>{{ trans('validation.attributes.type') }}</th>
                                    <td>{!! $user::type()[$user->type_id] !!}</td>
                                </tr>
                                @endauth
                                <tr>
                                    <th>{{ trans('validation.attributes.created_at') }}</th>
                                    <td>{!! $user->created_at !!}</td>
                                </tr>
                                <tr>
                                    <th>{{ trans('validation.attributes.last_updated') }}</th>
                                    <td>{!! $user->updated_at !!}</td>
                                </tr>
                            </table>
                        </div><!--tab panel profile-->
                          
                     <div class="actions">     
                    <a href="{!!route('frontend.profile.edit')!!}" class="btn btn-primary btn-xs">{{ trans('labels.edit_information') }}</a>
                    @if (access()->user()->canChangePassword())
                        <a href="{!!url('auth/password/change')!!}" class="btn btn-warning btn-xs">{{ trans('navs.change_password') }}</a>
                    @endif
                    </div>     
                      </div><!--tab content-->

                    </div><!--tab panel-->

				</div><!--panel body-->

			</div><!-- panel -->

		</div><!-- col-md-10 -->

	</div><!-- row -->
   <div class="log-fundal-image">
        
    </div>
@endsection