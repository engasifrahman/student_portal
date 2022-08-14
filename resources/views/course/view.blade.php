<div class="col-md-12 mt-3 mb-3">

	<div class="col-md-12">
		<table id="course-listing" class="table table-striped text-center" style="width:100%;">
			<thead>
				<tr>
					<th class="w5">#</th>
					<th class="w10">Code</th>
					<th class="w25">Title</th>
					<th class="w5">Credit</th>
					<th class="w5">Cost</th>
					<th class="w40">Description</th>
					<th class="w10">Actions</th>
				</tr>
			</thead>
			<tbody>
				<?php $no=1; ?>
				@foreach($data as $data)
				<tr>
					<td class="w5">{{ $no++ }}</td>
					<td class="w10">{{ $data->code }}</td>
					<td class="w25">{{ $data->title }}</td>
					<td class="w5">{{ $data->credit }}</td>
					<td class="w5">{{ $data->cost }}</td>
					<td class="w40">{{ $data->description }}</td>
					<td class="w10">
						<a class="pointer" title="Edit" onclick="EditCourse('{{ $data->id }}');">
							<i class="fa fa-pencil-square-o text-info"></i>
						</a>
						<a class="pointer" onclick="CourseID('{{ $data->id }}')" data-toggle="modal" data-target="#course_delete_modal" title="Delete"> 
							<i class="fa fa-trash text-danger"></i>
						</a>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
	
</div>
<!------ Custom js page level  (this here because if we place it in master file then datatable not works when you add or update any data)------>
<script src="{{ asset('assets') }}/custom/js/page-level/data-table.js"></script>
  <!------ /Custom js page level------>