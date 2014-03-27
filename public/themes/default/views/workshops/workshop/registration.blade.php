
<form class="form-horizontal" action="{{ $p->url() }}?workshop[{{ $workshop->identifier }}]=parts" data-async="async" data-target="#workshop-{{ $workshop->identifier }}" method="post">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&#215;</button>
        <h4 class="modal-title">{{ $workshop->title }}</h4>
    </div>
    <div class="modal-body">
        <p>{{ $workshop->description }}</p>
		
		<div class="form-group">
			<label for="inputSurname" class="col-sm-3 control-label">Surname</label>
			<div class="col-sm-9">
				<input type="text" class="form-control" id="inputSurname" placeholder="Surname" name="surname" value="{{ $p->get('name') }}">
			</div>
		</div>
		<div class="form-group">
			<label for="inputFirstname" class="col-sm-3 control-label">First Name</label>
			<div class="col-sm-9">
				<input type="text" class="form-control" id="inputFirstname" placeholder="First Name" name="firstname" value="{{ $p->get('firstname') }}">
			</div>
		</div>
		<div class="form-group">
			<label for="inputFirstname" class="col-sm-3 control-label">Middle Name</label>
			<div class="col-sm-9">
				<input type="text" class="form-control" id="inputFirstname" placeholder="Middle Name" name="middlename" value="{{ $p->get('middlename') }}">
			</div>
		</div>
		<div class="form-group">
			<label for="inputFirstname" class="col-sm-3 control-label">Address</label>
			<div class="col-sm-9">
				<input type="text" class="form-control" id="inputFirstname" placeholder="Address" name="address" value="{{ $p->get('address') }}">
			</div>
		</div>
		<div class="form-group">
			<label for="inputFirstname" class="col-sm-3 control-label">First Name</label>
			<div class="col-sm-9">
				<input type="text" class="form-control" id="inputFirstname" placeholder="First Name" name="firstname" value="{{ $p->get('firstname') }}">
			</div>
		</div>
		
        <input type="text" name="name" value="{{ $p->get('name') }}" placeholder="Name" />
        <input type="email" name="email" value="{{ $p->get('email') }}" placeholder="E-Mail" />
        <input type="name" name="address" value="{{ $p->get('') }}" placeholder="" />
        <input type="name" name="institution" value="{{ $p->get('institution') }}" placeholder="Institution" />
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Next</button>
    </div>
</form>