
<form class="form" action="{{ $next }}" method="post">
    <div class="modal-header">
        <h4 class="modal-title">{{ $workshop->title }}</h4>
    </div>
    <div class="modal-body">
        <p>{{ $workshop->description }}</p>

        <table>
            <tbody>
                <tr>
                    <td>Titel</td>
                    <td></td>
                </tr>
                <tr>
                    <td>Nachname</td>
                    <td></td>
                </tr>
                <tr>
                    <td>Vorname</td>
                    <td></td>
                </tr>
                <tr>
                    <td>Institution</td>
                    <td></td>
                </tr>
                <tr>
                    <td>Adresse</td>
                    <td></td>
                </tr>
                <tr>
                    <td>Ort</td>
                    <td></td>
                </tr>
                <tr>
                    <td>Land</td>
                    <td></td>
                </tr>
                <tr>
                    <td>E-Mail</td>
                    <td></td>
                </tr>
                <tr>
                    <td>Telefon</td>
                    <td></td>
                </tr>
            </tbody>
        </table>

        <hr />

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
        <a href="{{ $first }}" role="button" class="btn btn-default">{{ Lang::get('parkcms-workshop::fields.abort') }}</a>
        <a href="{{ $previous }}" role="button" class="btn btn-default">{{ Lang::get('parkcms-workshop::fields.back') }}</a>
        <button type="submit" class="btn btn-primary">{{ Lang::get('parkcms-workshop::fields.pay') }}</button>
    </div>
</form>
