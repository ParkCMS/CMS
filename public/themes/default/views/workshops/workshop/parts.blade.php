
<form class="form" action="{{ $next }}" data-async="async" data-target="#workshop-{{ $workshop->identifier }}" method="post">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&#215;</button>
        <h4 class="modal-title">{{ $workshop->title }}</h4>
    </div>
    <div class="modal-body">
        <p>{{ $workshop->description }}</p>

        <p>I will register for the following parts</p>
        @foreach ($workshop->parts as $part)
            <div class="checkbox">
                <label>
                    {{ $part->title }}
                    <input type="checkbox" name="parts[{{ $part->id }}]" value="1" @if($p->get($part->id)) checked="checked"@endif />
                </label>
            </div>
        @endforeach
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <a href="{{ $previous }}" role="button" data-async="async" data-target="#workshop-{{ $workshop->identifier }}" class="btn btn-default">Back</a>
        <button type="submit" class="btn btn-primary">Next</button>
    </div>
</form>
