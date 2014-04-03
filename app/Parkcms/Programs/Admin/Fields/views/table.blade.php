<table {{ $attributes }}>
	<thead>
		<tr>
			@foreach ($headers as $header)
			<th>{{ $header }}</th>
			@endforeach
			@if (count($buttons) > 0)
			<th>&nbsp;</th>
			@endif
		</tr>
	</thead>
	<tbody>
		@foreach ($rows as $row)
		<tr>
			@foreach ($keys as $key)
				<td>{{ $row->{$key} }}</td>
			@endforeach
			@if (count($buttons) > 0)
				<td>
					@foreach ($buttons as $button)
						<a load-action="{{ $button['action'] }}" load-params="{'id': {{ $row->id }} }" title="{{ $button['title'] }}">{{ $button['content'] }}</a>
					@endforeach
				</td>
			@endif
		</tr>
		@endforeach
		@if (count($rows) === 0)
		<tr>
			<td class="empty-table" colspan="{{ count($headers) }}">No entries available!</td>
		</tr>
		@endif
	</tbody>
</table>