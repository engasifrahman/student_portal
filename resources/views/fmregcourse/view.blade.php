<div class="card">
	<div class="card-header bg-success  text-center">
		<span class="h6 text-white">Registered Course List</span>
	</div>
	<div class="card-body">
		<div class="col-md-12">
			<table class="table table-striped text-center" style="width:100%;">
				<thead>
					<tr>
						<th class="w5">#</th>
						<th class="w10">Course Code</th>
						<th class="w25">Course Title</th>
						<th class="w5">Course Credit</th>
						<th class="w5">Section</th>
					</tr>
				</thead>
				<tbody>
					<?php $no=1; ?>
					@foreach($data as $data)
					<tr>
						<td class="w10">{{ $no++ }}</td>
						<td class="w10">{{ $data['course_code'] }}</td>
						<td class="w25">{{ $data['course_title'] }}</td>
						<td class="w10">{{ $data['course_credit'] }}</td>
						<td class="w10">{{ $data['section'] }}</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>
<!------ Custom js page level  (this here because if we place it in master file then datatable not works when you add or update any data)------>
<script src="{{ asset('assets') }}/custom/js/page-level/data-table.js"></script>
  <!------ /Custom js page level------>