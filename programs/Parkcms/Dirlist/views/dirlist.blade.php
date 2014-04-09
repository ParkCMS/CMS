
<ul>
    @foreach($files as $file)
        <li><a href="{{ $file->url }}">{{ $file->name }} ({{ round(filesize($file->path) / 1024) }} KB)</a></li>
    @endforeach
</ul>
