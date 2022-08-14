<div class="col-md-12 mt-3 mb-3">

    <div class="col-md-12">
        <table id="deptcourse-listing" class="table table-striped text-center" style="width:100%;">
            <thead>
                <tr>
                    <th class="w5">#</th>
                    <th class="w20">Department</th>
                    <th class="w45">Course Code</th>
                    <th class="w20">Total Course</th>
                    <th class="w10">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php $no=1; ?>
                @foreach($data as $data)
                    <?php
                        if(!empty($data->course_code)){
                            $course_code = explode(',', $data->course_code);
                            $total_course = sizeof($course_code);
                        }
                        else{
                            $total_course = 0;
                        }
                    ?>
                    <tr>
                        <td class="w5">{{ $no++ }}</td>
                        <td class="w20">{{ $data->department }}</td>
                        <td class="w45">{{ $data->course_code }}</td>
                        <td class="w20">{{ $total_course }}</td>
                        <td class="w10">
                            <a class="pointer" title="Edit" onclick="EditDeptCourse('{{ $data->id }}');">
                                <i class="fa fa-pencil-square-o text-info"></i>
                            </a>
                            <a class="pointer" onclick="DeptCourseID('{{ $data->id }}')" data-toggle="modal" data-target="#deptcourse_delete_modal" title="Delete"> 
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