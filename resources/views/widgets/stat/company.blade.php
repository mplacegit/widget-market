{{ $collection->appends([])->links() }}
<table class="table">
 	<thead>
		<tr>
			<th>{!! $sorts["company"] !!} </th>
			<th>{!! $sorts["clicks"] !!}</th>
			<th>{!! $sorts["cpc"] !!}</th>
			<th>{!!$sorts["inv"] !!}</th>
			
			<th>{!! $sorts["views"] !!}</th>
			<th>{!! $sorts["ctr"] !!}</th>
			<th>{!! $sorts["summa"]!!}</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
			@foreach($collection as $col)
			@php
			
			@endphp
			<tr>
			<td><a href="#">{{$col->shop}}</a></td>
			<td>{{$col->clicks}}</td>
			<td>{{$col->cpc}}</td>
			<td>{{$col->inv}}</td>
			
			<td>{{$col->views}}</td>
			<td>{{$col->ctr}}</td>
			<td>{{$col->summa}}</td>
			<td></td>
		</tr>
	@endforeach	
	</tbody>	
</table>	
{{ $collection->appends([])->links() }}