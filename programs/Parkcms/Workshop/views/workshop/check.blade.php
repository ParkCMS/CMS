
<form class="form" action="{{ $next }}" method="post">
    <div class="modal-header">
        <h4 class="modal-title">{{ $workshop->title }}</h4>
    </div>
    <div class="modal-body">
        <p>{{ $workshop->description }}</p>

        <table width="70%">
@foreach($p->step()->prev->prev->getAll() as $k => $v)
@if($v)
            <tr>
                <td width="50%">{{ Lang::get('parkcms-workshop::fields.' . $k) }}</td>
                <td width="50%">{{ $v }}</td>
            </tr>
@endif
@endforeach
        </table>

        <hr />

        <table width="70%">
@foreach($workshop->parts as $part)
@if($p->step()->prev->get($part->id))
            <tr>
                <td width="50%">{{ $part->title }}</td>
                <td>{{ round($part->price, 2) * $p->step()->prev->get($part->id) }}&euro;</td>
            </tr>
@endif
@endforeach
            <tr><td colspan="2">&nbsp;</td></tr>
            <tr>
                <td width="50%">Total:</td>
                <td>{{ $p->step()->prev->totalAmount() }}&euro;</td>
            </tr>
        </table>

        <hr />

        <h4>{{ Lang::get('parkcms-workshop::fields.terms') }}:</h4>
        <div class="container-fluid">
            <textarea class="col-sm-12" rows="12" disabled>{{ $workshop->terms }}</textarea>
        </div>

        <div class="container-fluid">
            <div class="checkbox">
                <label>
                    {{ Lang::get('parkcms-workshop::fields.accept') }}
                    <input type="checkbox" name="terms" value="1" />
                </label>
            </div>
        </div>

@if($errors->first('terms'))
        <div class="container-fluid">
            <span style="color: red;">{{ $errors->first('terms') }}</span>
        </div>
@endif
@if($errors->first('payment'))
        <div class="container-fluid">
            <span style="color: red;">{{ $errors->first('payment') }}</span>
        </div>
@endif
    </div>
    <div class="modal-footer">
        <a href="{{ $first }}" role="button" class="btn btn-default">{{ Lang::get('parkcms-workshop::fields.abort') }}</a>
        <a href="{{ $previous }}" role="button" class="btn btn-default">{{ Lang::get('parkcms-workshop::fields.back') }}</a>
        <button type="submit" class="btn btn-primary">{{ Lang::get('parkcms-workshop::fields.pay') }}</button>
    </div>
</form>
