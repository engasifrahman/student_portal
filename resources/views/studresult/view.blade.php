<div class="col-md-12 mt-3 mb-3">

    <div class="col-md-12">
        <table id="tutionfee-listing" class="table table-striped text-center" style="width:100%;">
            <thead>
                <tr>
                    <th class="w5">#</th>
                    <th class="w15">Id</th>
                    <th class="w10">Attnd</th>
                    <th class="w5">Avg CT</th>
                    <th class="w5">Presn</th>
                    <th class="w5">Assign</th>
                    <th class="w5">Mid</th>
                    <th class="w5">Final</th>
                    <th class="w5">Total</th>
                    <th class="w5">GPA</th>
                    <th class="w5">Grade</th>
                    <th class="w10">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php $no=1; ?>
                @foreach($data as $data)
                <tr>
                    <td class="w5">{{ $no++ }}</td>
                    <td class="w15">{{ $data->stud_id }}</td>
                    <td class="w10">{{ number_format($data->attendance, 2) }}</td>
                    <td class="w5">{{ number_format($data->avg_ct, 2) }}</td>
                    <td class="w5">{{ number_format($data->presentation, 2) }}</td>
                    <td class="w5">{{ number_format($data->assignment, 2) }}</td>
                    <td class="w5">{{ number_format($data->midterm, 2) }}</td>
                    <td class="w5">{{ number_format($data->final, 2) }}</td>
                    <td class="w5">{{ number_format($data->total, 2) }}</td>
                    <td class="w5">{{ number_format($data->gpa, 2) }}</td>
                    <td class="w10">{{ $data->grade }}</td>
                    <td class="w10">
                        <a class="pointer" title="Edit" onclick="EditStudResult('{{ $data->id }}');">
                            <i class="fa fa-pencil-square-o text-info"></i>
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
