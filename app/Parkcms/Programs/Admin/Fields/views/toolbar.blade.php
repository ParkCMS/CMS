<nav class="navbar navbar-default toolbar" role="navigation">
	<div class="container-fluid">
		<ul class="nav navbar-nav">
			@foreach($buttons as $button)
			<li><a href="#" {{ $button['actions'] }}><i class="glyphicon glyphicon-{{ $button['icon'] }}"></i>{{ $button['title'] }}</a></li>
			@endforeach
		</ul>
	</div>
</nav>