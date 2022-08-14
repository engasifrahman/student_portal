<div class="col-md-12 mt-3 mb-3">

    <div class="col-md-12">
        <table id="faculty-listing" class="table table-striped text-center" style="width:100%;">
            <thead>
                <tr>
                    <th class="w5">#</th>
                    <th class="w30">Name</th>
                    <th class="w10">Code</th>
                    <th class="w10">Abbreviation</th>
                    <th class="w35">Description</th>
                    <th class="w10">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php $no=1; ?>
                @foreach($data as $data)
                <tr>
                    <td class="w5">{{ $no++ }}</td>
                    <td class="w30">{{ $data->name }}</td>
                    <td class="w10">{{ $data->code }}</td>
                    <td class="w10">{{ $data->abbreviation }}</td>
                    <td class="w35">{{ $data->description }}</td>
                    <td class="w10">
                        <a class="pointer" title="Edit" onclick="EditFaculty('{{ $data->id }}');">
                            <i class="fa fa-pencil-square-o text-info"></i>
                        </a>
                        <a class="pointer" onclick="FacultyID('{{ $data->id }}')" data-toggle="modal" data-target="#faculty_delete_modal" title="Delete"> 
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