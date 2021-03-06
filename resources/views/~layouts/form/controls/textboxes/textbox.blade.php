<div class="form-group{!!$feedback ? ' has-' . $feedback : ''!!}">
	@if( ! empty($caption) )
		<label class="control-label" for="{{$name}}" title="{!! @$title !!}">
			@if($feedback == Easy\Form\Base::FEEDBACK_SUCCESS)
				<i class="fa fa-check"></i>
			@elseif($feedback == Easy\Form\Base::FEEDBACK_WARNING)
				<i class="fa fa-bell-o"></i>
			@elseif($feedback == Easy\Form\Base::FEEDBACK_ERROR)
				<i class="fa fa-times-circle-o"></i>
			@endif
			{!! $caption !!}
		</label>
    @endif
    {!! Form::text($name, $value, $attributes + $angular) !!}
    @if($help)
		<p class="help-block">{!!$help!!}</p>
	@endif
</div> 