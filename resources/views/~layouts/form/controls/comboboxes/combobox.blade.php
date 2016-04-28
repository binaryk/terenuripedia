<div class="form-group{{$feedback ? ' has-' . $feedback : ''}}">
	@if($caption)
		<label class="" title="{!! @$title !!}">{{$caption}}</label>
	@endif
	{!! Form::select($name, $options, $value, $attributes + $angular) !!}
</div>