
<div id="carousel-{{ $ticker->identifier }}" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
        @for($i = 0; $i < count($ticker->items); $i++)
            <li data-target="#carousel-{{ $ticker->identifier }}" data-slide-to="{{ $i }}" @if($i == 0)class="active"@endif></li>
        @endfor
    </ol>

<!-- Wrapper for slides -->
    <div class="carousel-inner">
        @foreach($ticker->items as $i => $item)
            <div class="item @if($i == 0)active@endif">
                <img src="{{ URL::to('files' . $item->media_preview) }}" alt="" />
                <div class="carousel-caption">
                    <h3>{{ $item->title }}</h3>
                    <p>
                        {{ $item->description }}
                    </p>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Controls -->
    <a class="left carousel-control" href="#carousel-{{ $ticker->identifier }}" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left"></span>
    </a>
    <a class="right carousel-control" href="#carousel-{{ $ticker->identifier }}" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right"></span>
    </a>
</div>
