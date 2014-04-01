
<h2>{{ $workshop->title }}</h2>
<p>{{ $workshop->description }}</p>

<a href="{{ $next }}" data-async="async" data-target="#workshop-{{ $workshop->identifier }}" role="button" class="btn btn-default" @if($workshop->isFullOrClosed()) disabled="disabled"@endif>{{ Lang::get('parkcms-workshop::fields.register') }}</a>

@if($workshop->seats >= 0)
    <p>
        {{ count($workshop->registrations()) }} von {{ $workshop->seats }} Plätzen vergeben
    </p>
@endif

<!-- Event Modal -->
<div id="workshop-{{ $workshop->identifier }}" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <p>Loading...</p>
            </div>
        </div>
    </div>
</div>
