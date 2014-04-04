
<h1>{{ $ticker->title }}</h1>
<p>{{ $ticker->description }}</p>

@foreach($ticker->items as $item)
    <div class="ticker-item">
        @if(!is_null($item->media_preview))
            <div class="media-preview">
                <img src="{{ URL::to('files' . $item->media_preview) }}" />
            </div>
        @endif

        <h2>{{ $item->title }}</h2>
        <p>
            {{ $item->description }}
        </p>
    </div>
@endforeach
