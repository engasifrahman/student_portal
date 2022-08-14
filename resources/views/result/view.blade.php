<div class="col-md-12 mt-3 mb-3">
    <div class="card">
        <div class="card-header bg-success text-center h6 text-white">Result</div>
        <div class="card-body">
            <div class="p-4">
                <table id="result-listing" class="table table-striped text-center" style="width:100%;">
                    <thead>
                        <tr>
                            <th class="w5">#</th>
                            <th class="w15">Course Code</th>
                            <th class="w50">Course Title</th>
                            <th class="w10">Credit</th>
                            <th class="w10">Grade</th>
                            <th class="w10">GPA</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no=1; ?>
                        @foreach($data as $data)
                        <tr>
                            <td class="w5">{{ $no++ }}</td>
                            <td class="w15">{{ $data->course_code }}</td>
                            <td class="w10">{{ $data->course_title }}</td>
                            <td class="w5">{{ $data->course_credit }}</td>
                            <td class="w5">{{ $data->grade }}</td>
                            <td class="w5">{{ $data->gpa }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="col-md-8 mx-auto text-center pb-3">
                    <div class="col-md-6 pull-left text-info"><b>Total Credits Taken : {{ $total_credit }}</b></div>
                    <div class="col-md-6 pull-right text-info"><b>SGPA : {{ number_format($sgpa, 2) }}</b></div>
                </div>
            </div>
        </div>
    </div>
</div>
<!------ Custom js page level  (this here because if we place it in master file then datatable not works when you add or update any data)------>
<script src="{{ asset('assets') }}/custom/js/page-level/data-table.js"></script>
  <!------ /Custom js page level------>
