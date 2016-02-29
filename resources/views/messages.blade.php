@foreach ($messages as $type => $message)
	@if ( ! empty($message))
		<div class="container">
			<div class="alert alert-{{ $type }} alert-dismissible" role="alert">
				<button type="button" class="close" data-dismiss="alert">
					<span aria-hidden="true">&times;</span>
					<span class="sr-only">@lang('back.message.close')</span>
				</button>
				@if (is_array($message))
					<ul>
					@foreach ($message as $text)
						<li>{{ $text }}</li>
					@endforeach
					</ul>
				@else
					{!! $message !!}
				@endif
			</div>
		</div>
	@endif
@endforeach
