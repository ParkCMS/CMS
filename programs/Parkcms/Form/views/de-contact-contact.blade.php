
<div class="row">
    <div class="col-sm-10 col-sm-offset-2">
        @if(isset($validator))
            @if($validator->fails())
                <ul>
                    @foreach($validator->messages()->all() as $message)
                        <li>{{ $message }}</li>
                    @endforeach
                </ul>
            @else
                <p>Ihre Anfrage wurde abgeschickt!</p>
            @endif
        @endif
    </div>
</div>

<form class="form-horizontal" action="{{ $action }}" method="{{ $method }}">
    <input type="hidden" name="identifier" value="{{ $form->identifier }}" />

    <div class="form-group">
        <label for="inputName" class="col-sm-2 control-label">Name</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="inputName" name="name" value="{{ $p->get('name') }}" />
        </div>
    </div>

    <div class="form-group">
        <label for="inputEmail" class="col-sm-2 control-label">E-Mail</label>
        <div class="col-sm-10">
            <input type="email" class="form-control" id="inputEmail" name="email" value="{{ $p->get('email') }}" />
        </div>
    </div>

    <div class="form-group">
        <label for="inputComment" class="col-sm-2 control-label">Kommentar</label>
        <div class="col-sm-10">
            <textarea class="form-control" id="inputComment" name="comment" rows="10">{{ $p->get('comment') }}</textarea>
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-10 col-sm-offset-2">
            <button class="btn btn-default" type="reset">Zurücksetzen</button>
            <button class="btn btn-primary" type="submit">Abschicken</button>
        </div>
    </div>
</form>
