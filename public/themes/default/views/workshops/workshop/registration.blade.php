
<form action="{{ $p->url() }}?workshop[{{ $workshop->identifier }}]=parts" data-async="async" data-target="#workshop-{{ $workshop->identifier }}" method="post">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&#215;</button>
        <h4 class="modal-title">{{ $workshop->title }}</h4>
    </div>
    <div class="modal-body">
        <p>{{ $workshop->description }}</p>

        <input type="text" name="name" value="{{ $p->get('name') }}" placeholder="Name" />
        <input type="email" name="email" value="{{ $p->get('email') }}" placeholder="E-Mail" />
        <input type="name" name="address" value="{{ $p->get('address') }}" placeholder="Adresse" />
        <input type="name" name="institution" value="{{ $p->get('institution') }}" placeholder="Institution" />
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Next</button>
    </div>
</form>