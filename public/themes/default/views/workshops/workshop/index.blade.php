
<h2>{{ $workshop->title }}</h2>
<p>{{ $workshop->description }}</p>

<a href="{{ $p->url() }}?workshop[{{ $workshop->identifier }}]=register" data-async="async" data-target="#workshop-{{ $workshop->identifier }}" role="button" class="btn btn-default">Register</a>

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
