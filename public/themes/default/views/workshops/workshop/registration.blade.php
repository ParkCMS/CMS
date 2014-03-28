
<form class="form-horizontal" action="{{ $p->url() }}?workshop[{{ $workshop->identifier }}]=parts" data-async="async" data-target="#workshop-{{ $workshop->identifier }}" method="post">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&#215;</button>
        <h4 class="modal-title">{{ $workshop->title }}</h4>
    </div>
    <div class="modal-body">
        @if (isset($workshop_messages))
            <ul>
                @foreach ($workshop_messages->all('<li>:message</li>') as $message)
                    {{ $message }}
                @endforeach
            </ul>
        @endif

        <div class="form-group">
            <label for="inputTitle" class="col-sm-3 control-label">Title</label>
            <div class="col-sm-9 {{ $p->classFor('title') }}">
                <input type="text" class="form-control" id="inputTitle" placeholder="Title" name="title" value="{{ $p->get('title') }}">
            </div>
        </div>
        <div class="form-group">
            <label for="inputSurname" class="col-sm-3 control-label">Surname</label>
            <div class="col-sm-9 {{ $p->classFor('surname') }}">
                <input type="text" class="form-control" id="inputSurname" placeholder="Surname" name="surname" value="{{ $p->get('surname') }}">
            </div>
        </div>
		<div class="form-group">
			<label for="inputFirstname" class="col-sm-3 control-label">First Name</label>
			<div class="col-sm-5 {{ $p->classFor('firstname') }}">
				<input type="text" class="form-control" id="inputFirstname" placeholder="First Name" name="firstname" value="{{ $p->get('firstname') }}">
			</div>
            <div class="col-sm-4 {{ $p->classFor('middlename') }}">
                <input type="text" class="form-control" id="inputMiddlename" placeholder="Middle Name" name="middlename" value="{{ $p->get('middlename') }}">
            </div>
		</div>
        <div class="form-group">
            <label for="inputInstitution" class="col-sm-3 control-label">Institution</label>
            <div class="col-sm-9 {{ $p->classFor('institution') }}">
                <input type="text" class="form-control" id="inputInstitution" placeholder="Institution" name="institution" value="{{ $p->get('institution') }}">
            </div>
        </div>
        <div class="form-group">
            <label for="inputAdress" class="col-sm-3 control-label">Address</label>
            <div class="col-sm-9 {{ $p->classFor('address') }}">
                <input type="text" class="form-control" id="inputAdress" placeholder="Address" name="address" value="{{ $p->get('address') }}">
            </div>
        </div>
		<div class="form-group">
			<label for="inputCity" class="col-sm-3 control-label">Location</label>
            <div class="col-sm-5 {{ $p->classFor('city') }}">
                <input type="text" class="form-control" id="inputCity" placeholder="City" name="city" value="{{ $p->get('city') }}">
            </div>
            <div class="col-sm-4 {{ $p->classFor('zip') }}">
                <input type="text" class="form-control" id="inputZip" placeholder="Zip" name="zip" value="{{ $p->get('zip') }}">
            </div>
		</div>

        <br />
		
        <div class="form-group">
            <label for="inputEmail" class="col-sm-3 control-label">E-Mail</label>
            <div class="col-sm-9 {{ $p->classFor('email') }}">
                <input type="text" class="form-control" id="inputEmail" placeholder="E-Mail" name="email" value="{{ $p->get('email') }}">
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Next</button>
    </div>
</form>