
@if(isset($validator))
    @if($validator->fails())
        <ul>
            @foreach($validator->messages()->all() as $message)
                <li>{{ $message }}</li>
            @endforeach
        </ul>
    @else
        Ihre Anfrage wurde abgeschickt!
    @endif
@endif

<form class="form-horizontal" action="{{ $action }}" method="{{ $method }}">
    <input type="hidden" name="identifier" value="{{ $form->identifier }}" />

    <div class="form-group">
        <label for="inputName" class="col-sm-3 control-label">Name</label>
        <div class="col-sm-9">
            <input type="text" class="form-control" id="inputName" name="name" value="{{ Input::get('name') }}" />
        </div>
    </div>

    <div class="form-group">
        <label for="inputEmail" class="col-sm-3 control-label">E-Mail</label>
        <div class="col-sm-9">
            <input type="email" class="form-control" id="inputEmail" name="email" value="{{ Input::get('email') }}" />
        </div>
    </div>

    <button class="btn btn-default" type="reset">Zurücksetzen</button>
    <button class="btn btn-primary" type="submit">Abschicken</button>
</form>
