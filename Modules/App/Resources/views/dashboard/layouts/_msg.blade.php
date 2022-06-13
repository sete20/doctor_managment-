<section class="container">
	<div class="row">
		{{-- Errors --}}
		@if($errors->all())
			<div class="alert alert-danger">
				<ul>
					<a href='#' class="close" data-dismiss="alert" aria-label="close">x</a>
					@foreach ($errors->all() as $error)
						<li>{{ $error }}</li>
					@endforeach
				</ul>
			</div>
		@endif
		{{-- Success --}}
		@if(session('msg'))
		    <div class="alert alert-{{session('alert')}}" align="center">
			        <a href='#' class="close" data-dismiss="alert" aria-label="close">x</a>
			        <h4>{{session('msg')}}</h4>
		    </div>
		@endif
	</div>
</section>
