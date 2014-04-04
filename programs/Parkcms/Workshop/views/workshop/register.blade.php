
<form class="form-horizontal" action="{{ $next }}" method="post">
    <div class="modal-header">
        <h4 class="modal-title">{{ $workshop->title }}</h4>
    </div>
    <div class="modal-body">
        <div class="form-group">
            <label for="inputTitle" class="col-sm-3 control-label">{{ Lang::get('parkcms-workshop::fields.title') }}</label>
            <div class="col-sm-9 @if($errors->first('title')) has-error @endif">
                <input type="text" class="form-control" id="inputTitle" placeholder="{{ Lang::get('parkcms-workshop::fields.title') }}" name="title" value="{{ $p->step()->get('title') }}" data-toggle="tooltip" data-placement="bottom" title="{{ $errors->first('title') }}" />
            </div>
        </div>
        <div class="form-group">
            <label for="inputSurname" class="col-sm-3 control-label">{{ Lang::get('parkcms-workshop::fields.surname') }}</label>
            <div class="col-sm-9 @if($errors->first('surname')) has-error @endif">
                <input type="text" class="form-control" id="inputSurname" placeholder="{{ Lang::get('parkcms-workshop::fields.surname') }}" name="surname" value="{{ $p->step()->get('surname') }}" data-toggle="tooltip" data-placement="bottom" title="{{ $errors->first('surname') }}" />
            </div>
        </div>
		<div class="form-group">
			<label for="inputFirstname" class="col-sm-3 control-label">{{ Lang::get('parkcms-workshop::fields.firstname') }}</label>
			<div class="col-sm-5 @if($errors->first('firstname')) has-error @endif">
				<input type="text" class="form-control" id="inputFirstname" placeholder="{{ Lang::get('parkcms-workshop::fields.firstname') }}" name="firstname" value="{{ $p->step()->get('firstname') }}" data-toggle="tooltip" data-placement="bottom" title="{{ $errors->first('firstname') }}" />
			</div>
            <div class="col-sm-4 @if($errors->first('middlename')) has-error @endif">
                <input type="text" class="form-control" id="inputMiddlename" placeholder="{{ Lang::get('parkcms-workshop::fields.middlename') }}" name="middlename" value="{{ $p->step()->get('middlename') }}" data-toggle="tooltip" data-placement="bottom" title="{{ $errors->first('middlename') }}" />
            </div>
		</div>
        <div class="form-group">
            <label for="inputInstitution" class="col-sm-3 control-label">{{ Lang::get('parkcms-workshop::fields.institution') }}</label>
            <div class="col-sm-9 @if($errors->first('institution')) has-error @endif">
                <input type="text" class="form-control" id="inputInstitution" placeholder="{{ Lang::get('parkcms-workshop::fields.institution') }}" name="institution" value="{{ $p->step()->get('institution') }}" data-toggle="tooltip" data-placement="bottom" title="{{ $errors->first('institution') }}" />
            </div>
        </div>
        <div class="form-group">
            <label for="inputAdress" class="col-sm-3 control-label">{{ Lang::get('parkcms-workshop::fields.address') }}</label>
            <div class="col-sm-9 @if($errors->first('address')) has-error @endif">
                <input type="text" class="form-control" id="inputAdress" placeholder="{{ Lang::get('parkcms-workshop::fields.address') }}" name="address" value="{{ $p->step()->get('address') }}" data-toggle="tooltip" data-placement="bottom" title="{{ $errors->first('address') }}" />
            </div>
        </div>
		<div class="form-group">
			<label for="inputCity" class="col-sm-3 control-label">{{ Lang::get('parkcms-workshop::fields.location') }}</label>
            <div class="col-sm-5 @if($errors->first('city')) has-error @endif">
                <input type="text" class="form-control" id="inputCity" placeholder="{{ Lang::get('parkcms-workshop::fields.city') }}" name="city" value="{{ $p->step()->get('city') }}" data-toggle="tooltip" data-placement="bottom" title="{{ $errors->first('city') }}" />
            </div>
            <div class="col-sm-4 @if($errors->first('zip')) has-error @endif">
                <input type="text" class="form-control" id="inputZip" placeholder="{{ Lang::get('parkcms-workshop::fields.zip') }}" name="zip" value="{{ $p->step()->get('zip') }}" data-toggle="tooltip" data-placement="bottom" title="{{ $errors->first('zip') }}" />
            </div>
		</div>
        <div class="form-group">
            <label for="inputCountry" class="col-sm-3 control-label">{{ Lang::get('parkcms-workshop::fields.country') }}</label>
            <div class="col-sm-9 @if($errors->first('country')) has-error @endif">
                <input type="text" class="form-control" id="inputCountry" placeholder="{{ Lang::get('parkcms-workshop::fields.country') }}" name="country" value="{{ $p->step()->get('country') }}" data-toggle="tooltip" data-placement="bottom" title="{{ $errors->first('country') }}" />
            </div>
        </div>

        <br />
		
        <div class="form-group">
            <label for="inputEmail" class="col-sm-3 control-label">{{ Lang::get('parkcms-workshop::fields.email') }}</label>
            <div class="col-sm-9 @if($errors->first('email')) has-error @endif">
                <input type="email" class="form-control" id="inputEmail" placeholder="{{ Lang::get('parkcms-workshop::fields.email') }}" name="email" value="{{ $p->step()->get('email') }}" data-toggle="tooltip" data-placement="bottom" title="{{ $errors->first('email') }}" />
            </div>
        </div>
        <div class="form-group">
            <label for="inputPhone" class="col-sm-3 control-label">{{ Lang::get('parkcms-workshop::fields.phone') }}</label>
            <div class="col-sm-5 @if($errors->first('phone')) has-error @endif">
                <input type="phone" class="form-control" id="inputPhone" placeholder="{{ Lang::get('parkcms-workshop::fields.phone') }}" name="phone" value="{{ $p->step()->get('phone') }}" data-toggle="tooltip" data-placement="bottom" title="{{ $errors->first('phone') }}" />
            </div>
            <div class="col-sm-4 @if($errors->first('fax')) has-error @endif">
                <input type="fax" class="form-control" id="inputFax" placeholder="{{ Lang::get('parkcms-workshop::fields.fax') }}" name="fax" value="{{ $p->step()->get('fax') }}" data-toggle="tooltip" data-placement="bottom" title="{{ $errors->first('fax') }}" />
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <a href="{{ $first }}" role="button" class="btn btn-default">{{ Lang::get('parkcms-workshop::fields.abort') }}</a>
        <button type="submit" class="btn btn-primary">{{ Lang::get('parkcms-workshop::fields.next') }}</button>
    </div>
</form>