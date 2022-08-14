<div class="col-md-12 mt-3 mb-3">

    <div class="col-md-12">
        <table id="userreg-listing" class="table table-striped text-center" style="width:100%;">
            <thead>
                <tr>
                    <th class="w5">#</th>
                    <th class="w10">Picture</th>
                    <th class="w20">Name</th>
                    <th class="w20">ID</th>
                    <th class="w10">Type</th>
                    <th class="w10">Department</th>
                    <th class="w15">Email</th>
                    <th class="w10">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php $no=1; ?>
                @foreach($data as $data)
                <tr>
                    <td class="w5">{{ $no++ }}</td>
                    <td class="w10">
                        <img class="rounded-circle mx-auto d-block bg-secondary" height="60px" width="60px" src="{{ asset($data->pic_dir) }}" alt="profile-pic">
                    </td>
                    <td class="w20">{{ $data->name }}</td>
                    <td class="w20">{{ $data->user_id }}</td>
                    <td class="w10">{{ $data->type }}</td>
                    <td class="w10">{{ $data->department }}</td>
                    <td class="w15">{{ $data->email }}</td>
                    <td class="w10">
                        <a class="pointer" title="Edit" onclick="EditUserReg('{{ $data->id }}');">
                            <i class="fa fa-pencil-square-o text-info"></i>
                        </a>
                        <a class="pointer" onclick="UserRegID('{{ $data->id }}')" data-toggle="modal" data-target="#userreg_delete_modal" title="Delete"> 
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