
<form class="form-horizontal" action="{{ $next }}" method="post">
    <div class="modal-header">
        <h4 class="modal-title">{{ $workshop->title }}</h4>
    </div>
    <div class="modal-body">
        <div class="form-group">
            <label for="inputTitle" class="col-sm-3 control-label">{{ Lang::get('parkcms-workshop::fields.title') }}</label>
            <div class="col-sm-9 @if($p->failed('title')) has-error @endif">
                <input type="text" class="form-control" id="inputTitle" placeholder="{{ Lang::get('parkcms-workshop::fields.title') }}" name="title" value="{{ $p->get('title') }}" data-toggle="tooltip" data-placement="bottom" title="{{ $p->message('title') }}" />
            </div>
        </div>
        <div class="form-group">
            <label for="inputSurname" class="col-sm-3 control-label">{{ Lang::get('parkcms-workshop::fields.surname') }}</label>
            <div class="col-sm-9 @if($p->failed('surname')) has-error @endif">
                <input type="text" class="form-control" id="inputSurname" placeholder="{{ Lang::get('parkcms-workshop::fields.surname') }}" name="surname" value="{{ $p->get('surname') }}" data-toggle="tooltip" data-placement="bottom" title="{{ $p->message('surname') }}" />
            </div>
        </div>
		<div class="form-group">
			<label for="inputFirstname" class="col-sm-3 control-label">{{ Lang::get('parkcms-workshop::fields.firstname') }}</label>
			<div class="col-sm-5 @if($p->failed('firstname')) has-error @endif">
				<input type="text" class="form-control" id="inputFirstname" placeholder="{{ Lang::get('parkcms-workshop::fields.firstname') }}" name="firstname" value="{{ $p->get('firstname') }}" data-toggle="tooltip" data-placement="bottom" title="{{ $p->message('firstname') }}" />
			</div>
            <div class="col-sm-4 @if($p->failed('middlename')) has-error @endif">
                <input type="text" class="form-control" id="inputMiddlename" placeholder="{{ Lang::get('parkcms-workshop::fields.middlename') }}" name="middlename" value="{{ $p->get('middlename') }}" data-toggle="tooltip" data-placement="bottom" title="{{ $p->message('middlename') }}" />
            </div>
		</div>
        <div class="form-group">
            <label for="inputInstitution" class="col-sm-3 control-label">{{ Lang::get('parkcms-workshop::fields.institution') }}</label>
            <div class="col-sm-9 @if($p->failed('institution')) has-error @endif">
                <input type="text" class="form-control" id="inputInstitution" placeholder="{{ Lang::get('parkcms-workshop::fields.institution') }}" name="institution" value="{{ $p->get('institution') }}" data-toggle="tooltip" data-placement="bottom" title="{{ $p->message('institution') }}" />
            </div>
        </div>
        <div class="form-group">
            <label for="inputAdress" class="col-sm-3 control-label">{{ Lang::get('parkcms-workshop::fields.address') }}</label>
            <div class="col-sm-9 @if($p->failed('address')) has-error @endif">
                <input type="text" class="form-control" id="inputAdress" placeholder="{{ Lang::get('parkcms-workshop::fields.address') }}" name="address" value="{{ $p->get('address') }}" data-toggle="tooltip" data-placement="bottom" title="{{ $p->message('address') }}" />
            </div>
        </div>
		<div class="form-group">
			<label for="inputCity" class="col-sm-3 control-label">{{ Lang::get('parkcms-workshop::fields.location') }}</label>
            <div class="col-sm-5 @if($p->failed('city')) has-error @endif">
                <input type="text" class="form-control" id="inputCity" placeholder="{{ Lang::get('parkcms-workshop::fields.city') }}" name="city" value="{{ $p->get('city') }}" data-toggle="tooltip" data-placement="bottom" title="{{ $p->message('city') }}" />
            </div>
            <div class="col-sm-4 @if($p->failed('zip')) has-error @endif">
                <input type="text" class="form-control" id="inputZip" placeholder="{{ Lang::get('parkcms-workshop::fields.zip') }}" name="zip" value="{{ $p->get('zip') }}" data-toggle="tooltip" data-placement="bottom" title="{{ $p->message('zip') }}" />
            </div>
		</div>
        <div class="form-group">
            <label for="inputCountry" class="col-sm-3 control-label">{{ Lang::get('parkcms-workshop::fields.country') }}</label>
            <div class="col-sm-9 @if($p->failed('country')) has-error @endif">
                <input type="text" class="form-control" id="inputCountry" placeholder="{{ Lang::get('parkcms-workshop::fields.country') }}" name="country" value="{{ $p->get('country') }}" data-toggle="tooltip" data-placement="bottom" title="{{ $p->message('country') }}" />
            </div>
        </div>

        <br />
		
        <div class="form-group">
            <label for="inputEmail" class="col-sm-3 control-label">{{ Lang::get('parkcms-workshop::fields.email') }}</label>
            <div class="col-sm-9 @if($p->failed('email')) has-error @endif">
                <input type="email" class="form-control" id="inputEmail" placeholder="{{ Lang::get('parkcms-workshop::fields.email') }}" name="email" value="{{ $p->get('email') }}" data-toggle="tooltip" data-placement="bottom" title="{{ $p->message('email') }}" />
            </div>
        </div>
        <div class="form-group">
            <label for="inputPhone" class="col-sm-3 control-label">{{ Lang::get('parkcms-workshop::fields.phone') }}</label>
            <div class="col-sm-5 @if($p->failed('phone')) has-error @endif">
                <input type="phone" class="form-control" id="inputPhone" placeholder="{{ Lang::get('parkcms-workshop::fields.phone') }}" name="phone" value="{{ $p->get('phone') }}" data-toggle="tooltip" data-placement="bottom" title="{{ $p->message('phone') }}" />
            </div>
            <div class="col-sm-4 @if($p->failed('fax')) has-error @endif">
                <input type="fax" class="form-control" id="inputFax" placeholder="{{ Lang::get('parkcms-workshop::fields.fax') }}" name="fax" value="{{ $p->get('fax') }}" data-toggle="tooltip" data-placement="bottom" title="{{ $p->message('fax') }}" />
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <a href="{{ $first }}" role="button" class="btn btn-default">{{ Lang::get('parkcms-workshop::fields.abort') }}</a>
        <button type="submit" class="btn btn-primary">{{ Lang::get('parkcms-workshop::fields.next') }}</button>
    </div>
</form>