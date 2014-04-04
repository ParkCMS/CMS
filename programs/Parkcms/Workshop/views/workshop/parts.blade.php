
<form class="form" action="{{ $next }}" method="post">
    <div class="modal-header">
        <h4 class="modal-title">{{ $workshop->title }}</h4>
    </div>
    <div class="modal-body">
        <p>{{ $workshop->description }}</p>

        <p>{{ Lang::get('parkcms-workshop::fields.parts') }}</p>

@if($errors->first('parts'))
        <div class="container-fluid">
            <span style="color: red;">{{ Lang::get('parkcms-workshop::validation.parts') }}</span>
        </div>
@endif
        
        @foreach ($workshop->parts as $part)
            <div class="checkbox">
                <label>
                    {{ $part->title }}
                    <input type="checkbox" name="parts[{{ $part->id }}]" value="1" @if($p->step()->get($part->id)) checked="checked"@endif />
                </label>
            </div>
        @endforeach
    </div>
    <div class="modal-footer">
        <a href="{{ $first }}" role="button" class="btn btn-default">{{ Lang::get('parkcms-workshop::fields.abort') }}</a>
        <a href="{{ $previous }}" role="button" class="btn btn-default">{{ Lang::get('parkcms-workshop::fields.back') }}</a>
        <button type="submit" class="btn btn-primary">{{ Lang::get('parkcms-workshop::fields.next') }}</button>
    </div>
</form>
