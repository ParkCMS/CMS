
<form class="form-horizontal" action="{{ $next }}" data-async="async" data-target="#workshop-{{ $workshop->identifier }}" method="post">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&#215;</button>
        <h4 class="modal-title">{{ $workshop->title }}</h4>
    </div>
    <div class="modal-body">
        <div class="form-group">
            <label for="inputTitle" class="col-sm-3 control-label">Title</label>
            <div class="col-sm-9 @if($p->failed('title')) has-error @endif">
                <input type="text" class="form-control" id="inputTitle" placeholder="Title" name="title" value="{{ $p->get('title') }}" data-toogle="tooltip" data-placement="bottom" title="{{ $p->message('title') }}">
            </div>
        </div>
        <div class="form-group">
            <label for="inputSurname" class="col-sm-3 control-label">Surname</label>
            <div class="col-sm-9 @if($p->failed('surname')) has-error @endif">
                <input type="text" class="form-control" id="inputSurname" placeholder="Surname" name="surname" value="{{ $p->get('surname') }}" data-toogle="tooltip" data-placement="bottom" title="{{ $p->message('surname') }}">
            </div>
        </div>
		<div class="form-group">
			<label for="inputFirstname" class="col-sm-3 control-label">First Name</label>
			<div class="col-sm-5 @if($p->failed('firstname')) has-error @endif">
				<input type="text" class="form-control" id="inputFirstname" placeholder="First Name" name="firstname" value="{{ $p->get('firstname') }}" data-toogle="tooltip" data-placement="bottom" title="{{ $p->message('firstname') }}">
			</div>
            <div class="col-sm-4 @if($p->failed('middlename')) has-error @endif">
                <input type="text" class="form-control" id="inputMiddlename" placeholder="Middle Name" name="middlename" value="{{ $p->get('middlename') }}" data-toogle="tooltip" data-placement="bottom" title="{{ $p->message('middlename') }}">
            </div>
		</div>
        <div class="form-group">
            <label for="inputInstitution" class="col-sm-3 control-label">Institution</label>
            <div class="col-sm-9 @if($p->failed('institution')) has-error @endif">
                <input type="text" class="form-control" id="inputInstitution" placeholder="Institution" name="institution" value="{{ $p->get('institution') }}" data-toogle="tooltip" data-placement="bottom" title="{{ $p->message('institution') }}">
            </div>
        </div>
        <div class="form-group">
            <label for="inputAdress" class="col-sm-3 control-label">Address</label>
            <div class="col-sm-9 @if($p->failed('address')) has-error @endif">
                <input type="text" class="form-control" id="inputAdress" placeholder="Address" name="address" value="{{ $p->get('address') }}" data-toogle="tooltip" data-placement="bottom" title="{{ $p->message('address') }}">
            </div>
        </div>
		<div class="form-group">
			<label for="inputCity" class="col-sm-3 control-label">Location</label>
            <div class="col-sm-5 @if($p->failed('city')) has-error @endif">
                <input type="text" class="form-control" id="inputCity" placeholder="City" name="city" value="{{ $p->get('city') }}" data-toogle="tooltip" data-placement="bottom" title="{{ $p->message('city') }}">
            </div>
            <div class="col-sm-4 @if($p->failed('zip')) has-error @endif">
                <input type="text" class="form-control" id="inputZip" placeholder="Zip" name="zip" value="{{ $p->get('zip') }}" data-toogle="tooltip" data-placement="bottom" title="{{ $p->message('zip') }}">
            </div>
		</div>

        <br />
		
        <div class="form-group">
            <label for="inputEmail" class="col-sm-3 control-label">E-Mail</label>
            <div class="col-sm-9 @if($p->failed('email')) has-error @endif">
                <input type="text" class="form-control" id="inputEmail" placeholder="E-Mail" name="email" value="{{ $p->get('email') }}" data-toogle="tooltip" data-placement="bottom" title="{{ $p->message('email') }}">
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Next</button>
    </div>
</form>