
<form class="form-horizontal" action="{{ $next }}" data-async="async" data-target="#workshop-{{ $workshop->identifier }}" method="post">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&#215;</button>
        <h4 class="modal-title">{{ $workshop->title }}</h4>
    </div>
    <div class="modal-body">
        <p>
            bezahlen
        </p>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">{{ Lang::get('parkcms-workshop::fields.close') }}</button>
        <a href="{{ $previous }}" role="button" data-async="async" data-target="#workshop-{{ $workshop->identifier }}" class="btn btn-default">{{ Lang::get('parkcms-workshop::fields.back') }}</a>
        <button type="submit" class="btn btn-primary">{{ Lang::get('parkcms-workshop::fields.finish') }}</button>
    </div>
</form>
