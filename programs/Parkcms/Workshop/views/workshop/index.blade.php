
<h2>{{ $workshop->title }}</h2>
<p>{{ $workshop->description }}</p>

<form action="{{ $next }}" method="post">
    <input type="hidden" name="identifier" value="{{ $workshop->identifier }}" />
    <button type="submit" class="btn btn-default" @if($workshop->isFullOrClosed()) disabled="disabled"@endif>{{ Lang::get('parkcms-workshop::fields.register') }}</button>
</form>


@if($workshop->seats >= 0)
    <p>
        {{ $workshop->occupiedSeats() }} von {{ $workshop->seats }} Plätzen vergeben
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
