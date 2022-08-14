<div class="col-md-12 mt-3 mb-3">

	<div class="col-md-12">
		<table id="section-listing" class="table table-striped text-center" style="width:100%;">
			<thead>
				<tr>
					<th class="w5">#</th>
					<th class="20">Name</th>
					<th class="55">Description</th>
					<th class="20">Actions</th>
				</tr>
			</thead>
			<tbody>
				<?php $no=1; ?>
				@foreach($data as $data)
				<tr>
					<td class="w5">{{ $no++ }}</td>
					<td class="20">{{ $data->name }}</td>
					<td class="55">{{ $data->description }}</td>
					<td class="20">
						<a class="pointer" title="Edit" onclick="EditSection('{{ $data->id }}');">
							<i class="fa fa-pencil-square-o text-info"></i>
						</a>
						<a class="pointer" onclick="SectionID('{{ $data->id }}')" data-toggle="modal" data-target="#section_delete_modal" title="Delete"> 
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