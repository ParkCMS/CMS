
<form class="form" action="{{ $p->url() }}?workshop[{{ $workshop->identifier }}]=pay" data-async="async" data-target="#workshop-{{ $workshop->identifier }}" method="post">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&#215;</button>
        <h4 class="modal-title">{{ $workshop->title }}</h4>
    </div>
    <div class="modal-body">
        <p>{{ $workshop->description }}</p>

        <p>Terms...</p>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <a href="{{ $p->url() }}?workshop[{{ $workshop->identifier }}]=parts" role="button" data-async="async" data-target="#workshop-{{ $workshop->identifier }}" class="btn btn-default">Back</a>
        <button type="submit" class="btn btn-primary">Pay</button>
    </div>
</form>
