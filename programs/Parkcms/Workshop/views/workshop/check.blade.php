
<form class="form" action="{{ $next }}" data-async="async" data-target="#workshop-{{ $workshop->identifier }}" method="post">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&#215;</button>
        <h4 class="modal-title">{{ $workshop->title }}</h4>
    </div>
    <div class="modal-body">
        <p>{{ $workshop->description }}</p>

        <h4>{{ Lang::get('parkcms-workshop::fields.terms') }}:</h4>
        <div class="container-fluid">
            <textarea class="col-sm-12" rows="12">{{ $workshop->terms }}</textarea>
        </div>

        <div class="container-fluid">
            <div class="checkbox">
                <label>
                    {{ Lang::get('parkcms-workshop::fields.accept') }}
                    <input type="checkbox" name="terms" value="1" />
                </label>
            </div>
        </div>

@if($p->message('terms'))
        <div class="container-fluid">
            <span style="color: red;">{{ $p->message('terms') }}</span>
        </div>
@endif
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">{{ Lang::get('parkcms-workshop::fields.close') }}</button>
        <a href="{{ $previous }}" role="button" data-async="async" data-target="#workshop-{{ $workshop->identifier }}" class="btn btn-default">{{ Lang::get('parkcms-workshop::fields.back') }}</a>
        <button type="submit" class="btn btn-primary">{{ Lang::get('parkcms-workshop::fields.pay') }}</button>
    </div>
</form>
