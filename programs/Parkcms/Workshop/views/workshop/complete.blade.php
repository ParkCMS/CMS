
<div class="modal-header">
    <h4 class="modal-title">{{ $workshop->title }}</h4>
</div>
<div class="modal-body">
    <p>
@if($pending)
        <div class="container-fluid">
            {{ Lang::get('parkcms-workshop::validation.pending') }}
        </div>
@else
        <div class="container-fluid">
            {{ Lang::get('parkcms-workshop::validation.approved') }}
        </div>
@endif
    </p>
</div>

