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
						<th class="w30">Course Title</th>
						<th class="w10">Credit</th>
						<th class="w10">Section</th>
						<th class="w20">Teacher</th>
						<th class="w15">Action</th>
					</tr>
				</thead>
				<tbody>
					<?php $no=1; ?>
					@foreach($data as $data)
					<tr>
						<td class="w5">{{ $no++ }}</td>
						<td class="w10">{{ $data['course_code'] }}</td>
						<td class="w30">{{ $data['course_title'] }}</td>
						<td class="w10">{{ $data['course_credit'] }}</td>
						<td class="w10">{{ $data['section'] }}</td>
						<td class="w20">{{ $data['teacher'] }}</td>
						<td class="w15">
							<a class="pointer text-info" title="View Result" onclick="live_result('{{ $data['user_id'].'='.$data['dept_code'].'='.$data['sem_code'].'='.$data['course_code'].'='.$data['section'] }}');">
								<i class="fa fa-eye" aria-hidden="true"></i> Result
							</a>
						</td>
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