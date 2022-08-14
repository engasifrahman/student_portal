<div class="col-md-12 mt-3 mb-3">

    <div class="col-md-12">
        <table id="tutionfee-listing" class="table table-striped text-center" style="width:100%;">
            <thead>
                <tr>
                    <th class="w5">#</th>
                    <th class="w15">Semester</th>
                    <th class="w10">Section</th>
                    <th class="w30">Course Code</th>
                    <th class="w10">Payable</th>
                    <th class="w10">Paid</th>
                    <th class="w10">Due</th>
                    <th class="w10">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php $no=1; ?>
                @foreach($data as $data)
                <tr>
                    <td class="w5">{{ $no++ }}</td>
                    <td class="w15">{{ $data->semester }}</td>
                    <td class="w10">{{ $data->section }}</td>
                    <td class="w30">{{ $data->course_code }}</td>
                    <td class="w10">{{ $data->total_fee }}</td>
                    <td class="w10">{{ $data->paid }}</td>
                    <td class="w10">{{ $data->due }}</td>
                    <td class="w10">
                        <a class="pointer" title="Edit" onclick="EditTutionFee('{{ $data->id }}');">
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