
@if($validator)
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

    <input class="form-control" type="text" name="name" value="{{ Input::get('name') }}" />
    <input class="form-control" type="email" name="email" value="{{ Input::get('email') }}" />

    <button class="btn btn-default" type="reset">Zurücksetzen</button>
    <button class="btn btn-primary" type="submit">Abschicken</button>
</form>
