
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
        @if($part->part_type == 2)
            <div class="select">
                <label style="font-weight: 400;">
                    <span data-toggle="tooltip" data-position="bottom" title="{{ $part->description }}">{{ $part->title }}</span>
                    <select name="parts[{{ $part->id }}]">
                        @foreach(explode(',', $part->select_values) as $item)
                            <option value="{{ $item }}" @if($p->step()->get($part->id) == $item) selected="selected"@endif>{{ $item }}</option>
                        @endforeach
                    </select>
                </label>
            </div>
        @else
            <div class="checkbox">
                <label>
                    <span data-toggle="tooltip" data-position="bottom" title="{{ $part->description }}">{{ $part->title }}</span>
                    <input type="checkbox" name="parts[{{ $part->id }}]" value="1" @if($p->step()->get($part->id)) checked="checked"@endif />
                </label>
            </div>
        @endif
        @endforeach
    </div>
    <div class="modal-footer">
        <a href="{{ $first }}" role="button" class="btn btn-default">{{ Lang::get('parkcms-workshop::fields.abort') }}</a>
        <a href="{{ $previous }}" role="button" class="btn btn-default">{{ Lang::get('parkcms-workshop::fields.back') }}</a>
        <button type="submit" class="btn btn-primary">{{ Lang::get('parkcms-workshop::fields.next') }}</button>
    </div>
</form>
