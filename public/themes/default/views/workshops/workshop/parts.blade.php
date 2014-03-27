
<form class="form" action="{{ $p->url() }}?workshop[{{ $workshop->identifier }}]=check" data-async="async" data-target="#workshop-{{ $workshop->identifier }}" method="post">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&#215;</button>
        <h4 class="modal-title">{{ $workshop->title }}</h4>
    </div>
    <div class="modal-body">
        <p>{{ $workshop->description }}</p>

        @foreach ($workshop->parts as $part)
            <div class="checkbox">
                <label>
                    {{ $part->title }}
                    <input type="checkbox" name="parts[{{ $part->id }}]" value="1" {{ $p->get('parts.' . $part->id) }} />
                </label>
            </div>
        @endforeach
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <a href="{{ $p->url() }}?workshop[{{ $workshop->identifier }}]=register" role="button" data-async="async" data-target="#workshop-{{ $workshop->identifier }}" class="btn btn-default">Back</a>
        <button type="submit" class="btn btn-primary">Next</button>
    </div>
</form>
