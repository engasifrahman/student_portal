@extends('layout.app')

@section('main_content')

<div class="content-wrapper" id="crud_content_wrapper">
    <div class="row">
        <div class="col-md-6 pull-left">
            <div class="card">
                <div class="card-header bg-info text-center h6 text-white">Student Information</div>
                <div class="card-body">
                    <div class="p-3">
                        <div class="col-xs-6 col-sm-6 col-md-6 pull-left text-right pr-0"><strong class="text-info">Name&nbsp;&nbsp;&nbsp;&nbsp;:</strong></div>
                        <div class="col-xs-6 col-sm-6 col-md-6 pull-right text-justify pl-0">&nbsp;&nbsp;&nbsp;&nbsp;{{ $user->name }}</div>
                        <div class="clearfix"></div>

                        <div class="col-xs-6 col-sm-6 col-md-6 pull-left text-right pr-0"><strong class="text-info">ID&nbsp;&nbsp;&nbsp;&nbsp;:</strong></div>
                        <div class="col-xs-6 col-sm-6 col-md-6 pull-right text-justify pl-0">&nbsp;&nbsp;&nbsp;&nbsp;{{ $user->user_id }}</div>
                        <div class="clearfix"></div>
                    
                        <div class="col-xs-6 col-sm-6 col-md-6 pull-left text-right pr-0"><strong class="text-info">Department&nbsp;&nbsp;&nbsp;&nbsp;:</strong></div>
                        <div class="col-xs-6 col-sm-6 col-md-6 pull-right text-justify pl-0">&nbsp;&nbsp;&nbsp;&nbsp;{{ $user->department }}</div>
                        <div class="clearfix"></div>

                        <div class="col-xs-6 col-sm-6 col-md-6 pull-left text-right pr-0"><strong class="text-info">Email&nbsp;&nbsp;&nbsp;&nbsp;:</strong></div>
                        <div class="col-xs-6 col-sm-6 col-md-6 pull-right text-justify pl-0">&nbsp;&nbsp;&nbsp;&nbsp;{{ $user->email }}</div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 pull-right">
            <div class="card">
                <div class="card-header bg-info text-center h6 text-white">Payment Ledger Summary</div>
                <div class="card-body">
                    <div class="p-4">
                        <div class="col-xs-6 col-sm-6 col-md-6 pull-left text-right pr-0"><strong class="text-info">Total Payable&nbsp;&nbsp;&nbsp;&nbsp;:</strong></div>
                        <div class="col-xs-6 col-sm-6 col-md-6 pull-right text-justify pl-0">&nbsp;&nbsp;&nbsp;&nbsp;{{ $tutionfee->total_payable }}</div>
                        <div class="clearfix"></div>

                        <div class="col-xs-6 col-sm-6 col-md-6 pull-left text-right pr-0"><strong class="text-info">Total Paid&nbsp;&nbsp;&nbsp;&nbsp;:</strong></div>
                        <div class="col-xs-6 col-sm-6 col-md-6 pull-right text-justify pl-0">&nbsp;&nbsp;&nbsp;&nbsp;{{ $tutionfee->total_paid }}</div>
                        <div class="clearfix"></div>

                        <div class="col-xs-6 col-sm-6 col-md-6 pull-left text-right pr-0"><strong class="text-info">Total Due&nbsp;&nbsp;&nbsp;&nbsp;:</strong></div>
                        <div class="col-xs-6 col-sm-6 col-md-6 pull-right text-justify pl-0">&nbsp;&nbsp;&nbsp;&nbsp;{{ $tutionfee->total_due }}</div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12 mt-3 mb-3">
            <div class="card">
                <div class="card-header bg-success text-center h6 text-white">Semester's Payment Details</div>
                <div class="card-body">
                    <div class="p-4">
                        <table id="paymentledger-listing" class="table table-striped text-center" style="width:100%;">
                            <thead>
                                <tr>
                                    <th class="w5">#</th>
                                    <th class="w15">Semester</th>
                                    <th class="w15">Section</th>
                                    <th class="w30">Course Code</th>
                                    <th class="w15">Payable</th>
                                    <th class="w10">Paid</th>
                                    <th class="w10">Due</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no=1; ?>
                                @foreach($semesterwise as $data)
                                <tr>
                                    <td class="w5">{{ $no++ }}</td>
                                    <td class="w15">{{ $data->semester }}</td>
                                    <td class="w15">{{ $data->section }}</td>
                                    <td class="w30">{{ $data->course_code }}</td>
                                    <td class="w15">{{ $data->total_fee }}</td>
                                    <td class="w10">{{ $data->paid }}</td>
                                    <td class="w10">{{ $data->due }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!------ Custom js page level  (this here because if we place it in master file then datatable not works when you add or update any data)------>
<script src="{{ asset('assets') }}/custom/js/page-level/data-table.js"></script>
  <!------ /Custom js page level------>

@endsection