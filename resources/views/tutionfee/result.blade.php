<div class="row mb-4">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body p-3">
                <ul class="nav nav-tabs" id="Demo-tab1" role="tablist">
                    <li class="nav-item col-md-4">
                        <a class="nav-link text-center" data-toggle="tab" href="#profile" role="tab">Profile</a>
                    </li>
                    <li class="nav-item col-md-4">
                        <a class="nav-link text-center active" data-toggle="tab" href="#semesters" role="tab">Semesters</a>
                    </li>
                    <li class="nav-item col-md-4">
                        <a class="nav-link text-center" data-toggle="tab" href="#paymentsummary" role="tab">Payment Summary</a>
                    </li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <div class="tab-pane pt-4" id="profile" role="tabpanel">
                        <div class="col-md-12">
                            <div class="col-md-4 mx-auto text-center">
                                <img src="{{ asset($user->pic_dir) }}" class="bg-secondary rounded-circle" alt="{{ $user->name }}" height="120" width="120">
                            </div>
                            <div class="col-md-12">
                                <div class="col-xs-6 col-sm-6 col-md-6 pull-left text-right pr-0"><strong class="text-info">Name&nbsp;&nbsp;&nbsp;&nbsp;:</strong></div>
                                <div class="col-xs-6 col-sm-6 col-md-6 pull-right text-justify pl-0">&nbsp;&nbsp;&nbsp;&nbsp;{{ $user->name }}</div>
                                <div class="clearfix"></div>

                                <div class="col-xs-6 col-sm-6 col-md-6 pull-left text-right pr-0"><strong class="text-info">ID&nbsp;&nbsp;&nbsp;&nbsp;:</strong></div>
                                <div class="col-xs-6 col-sm-6 col-md-6 pull-right text-justify pl-0">&nbsp;&nbsp;&nbsp;&nbsp;{{ $user->user_id }}</div>
                                <div class="clearfix"></div>

                                <div class="col-xs-6 col-sm-6 col-md-6 pull-left text-right pr-0"><strong class="text-info">Type&nbsp;&nbsp;&nbsp;&nbsp;:</strong></div>
                                <div class="col-xs-6 col-sm-6 col-md-6 pull-right text-justify pl-0">&nbsp;&nbsp;&nbsp;&nbsp;{{ $user->type }}</div>
                                <div class="clearfix"></div>

                                <?php
                                if ($user->type === 'Faculty Member') 
                                {
                                    ?>
                                    <div class="col-xs-6 col-sm-6 col-md-6 pull-left text-right pr-0"><strong class="text-info">Abbreviation&nbsp;&nbsp;&nbsp;&nbsp;:</strong></div>
                                    <div class="col-xs-6 col-sm-6 col-md-6 pull-right text-justify pl-0">&nbsp;&nbsp;&nbsp;&nbsp;{{ $user->faculty }}</div>
                                    <div class="clearfix"></div>
                                    <?php
                                }
                                ?>   
                                
                                <?php
                                if ($user->type !== 'Student') 
                                {
                                    ?>
                                    <div class="col-xs-6 col-sm-6 col-md-6 pull-left text-right pr-0"><strong class="text-info">Designation&nbsp;&nbsp;&nbsp;&nbsp;:</strong></div>
                                    <div class="col-xs-6 col-sm-6 col-md-6 pull-right text-justify pl-0">&nbsp;&nbsp;&nbsp;&nbsp;{{ $user->designation }}</div>
                                    <div class="clearfix"></div>
                                    <?php
                                }
                                ?>

                                <div class="col-xs-6 col-sm-6 col-md-6 pull-left text-right pr-0"><strong class="text-info">Faculty&nbsp;&nbsp;&nbsp;&nbsp;:</strong></div>
                                <div class="col-xs-6 col-sm-6 col-md-6 pull-right text-justify pl-0">&nbsp;&nbsp;&nbsp;&nbsp;{{ $user->faculty }}</div>
                                <div class="clearfix"></div>

                                <div class="col-xs-6 col-sm-6 col-md-6 pull-left text-right pr-0"><strong class="text-info">Department&nbsp;&nbsp;&nbsp;&nbsp;:</strong></div>
                                <div class="col-xs-6 col-sm-6 col-md-6 pull-right text-justify pl-0">&nbsp;&nbsp;&nbsp;&nbsp;{{ $user->department }}</div>
                                <div class="clearfix"></div>

                                <div class="col-xs-6 col-sm-6 col-md-6 pull-left text-right pr-0"><strong class="text-info">Enrollment&nbsp;&nbsp;&nbsp;&nbsp;:</strong></div>
                                <div class="col-xs-6 col-sm-6 col-md-6 pull-right text-justify pl-0">&nbsp;&nbsp;&nbsp;&nbsp;{{ $user->semester }}</div>
                                <div class="clearfix"></div>

                                <div class="col-xs-6 col-sm-6 col-md-6 pull-left text-right pr-0"><strong class="text-info">Gender&nbsp;&nbsp;&nbsp;&nbsp;:</strong></div>
                                <div class="col-xs-6 col-sm-6 col-md-6 pull-right text-justify pl-0">&nbsp;&nbsp;&nbsp;&nbsp;{{ $user->gender }}</div>
                                <div class="clearfix"></div>

                                <div class="col-xs-6 col-sm-6 col-md-6 pull-left text-right pr-0"><strong class="text-info">Marital Status&nbsp;&nbsp;&nbsp;&nbsp;:</strong></div>
                                <div class="col-xs-6 col-sm-6 col-md-6 pull-right text-justify pl-0">&nbsp;&nbsp;&nbsp;&nbsp;{{ $user->marital_status }}</div>
                                <div class="clearfix"></div>

                                <div class="col-xs-6 col-sm-6 col-md-6 pull-left text-right pr-0"><strong class="text-info">Date of Birth&nbsp;&nbsp;&nbsp;&nbsp;:</strong></div>
                                <div class="col-xs-6 col-sm-6 col-md-6 pull-right text-justify pl-0">&nbsp;&nbsp;&nbsp;&nbsp;{{ $user->dob }}</div>
                                <div class="clearfix"></div>

                                <div class="col-xs-6 col-sm-6 col-md-6 pull-left text-right pr-0"><strong class="text-info">Nationality&nbsp;&nbsp;&nbsp;&nbsp;:</strong></div>
                                <div class="col-xs-6 col-sm-6 col-md-6 pull-right text-justify pl-0">&nbsp;&nbsp;&nbsp;&nbsp;{{ $user->nationality }}</div>
                                <div class="clearfix"></div>

                                <?php
                                if (!empty($user->nid))
                                {
                                    ?>
                                    <div class="col-xs-6 col-sm-6 col-md-6 pull-left text-right pr-0"><strong class="text-info">National ID&nbsp;&nbsp;&nbsp;&nbsp;:</strong></div>
                                    <div class="col-xs-6 col-sm-6 col-md-6 pull-right text-justify pl-0">&nbsp;&nbsp;&nbsp;&nbsp;{{ $user->nid }}</div>
                                    <div class="clearfix"></div>
                                    <?php
                                }
                                ?>
                                
                                <?php
                                if (!empty($user->birth_certificate))
                                {
                                    ?>
                                    <div class="col-xs-6 col-sm-6 col-md-6 pull-left text-right pr-0"><strong class="text-info">Birth Certificate&nbsp;&nbsp;&nbsp;&nbsp;:</strong></div>
                                    <div class="col-xs-6 col-sm-6 col-md-6 pull-right text-justify pl-0">&nbsp;&nbsp;&nbsp;&nbsp;{{ $user->birth_certificate }}</div>
                                    <div class="clearfix"></div>
                                    <?php
                                }
                                ?>

                                <div class="col-xs-6 col-sm-6 col-md-6 pull-left text-right pr-0"><strong class="text-info">Father Name&nbsp;&nbsp;&nbsp;&nbsp;:</strong></div>
                                <div class="col-xs-6 col-sm-6 col-md-6 pull-right text-justify pl-0">&nbsp;&nbsp;&nbsp;&nbsp;{{ $user->father_name }}</div>
                                <div class="clearfix"></div>

                                <div class="col-xs-6 col-sm-6 col-md-6 pull-left text-right pr-0"><strong class="text-info">Mother Name&nbsp;&nbsp;&nbsp;&nbsp;:</strong></div>
                                <div class="col-xs-6 col-sm-6 col-md-6 pull-right text-justify pl-0">&nbsp;&nbsp;&nbsp;&nbsp;{{ $user->mother_name }}</div>
                                <div class="clearfix"></div>

                                <div class="col-xs-6 col-sm-6 col-md-6 pull-left text-right pr-0"><strong class="text-info">Email&nbsp;&nbsp;&nbsp;&nbsp;:</strong></div>
                                <div class="col-xs-6 col-sm-6 col-md-6 pull-right text-justify pl-0">&nbsp;&nbsp;&nbsp;&nbsp;{{ $user->email }}</div>
                                <div class="clearfix"></div>
                                
                                <?php
                                if (!empty($user->altr_email))
                                {
                                    ?>
                                    <div class="col-xs-6 col-sm-6 col-md-6 pull-left text-right pr-0"><strong class="text-info">Alternative Email&nbsp;&nbsp;&nbsp;&nbsp;:</strong></div>
                                    <div class="col-xs-6 col-sm-6 col-md-6 pull-right text-justify pl-0">&nbsp;&nbsp;&nbsp;&nbsp;{{ $user->altr_email }}</div>
                                    <div class="clearfix"></div>
                                    <?php
                                }
                                ?>

                                <div class="col-xs-6 col-sm-6 col-md-6 pull-left text-right pr-0"><strong class="text-info">Phone&nbsp;&nbsp;&nbsp;&nbsp;:</strong></div>
                                <div class="col-xs-6 col-sm-6 col-md-6 pull-right text-justify pl-0">&nbsp;&nbsp;&nbsp;&nbsp;{{ $user->phone }}</div>
                                <div class="clearfix"></div>
                                
                                <?php
                                if (!empty($user->altr_phone))
                                {
                                    ?>
                                    <div class="col-xs-6 col-sm-6 col-md-6 pull-left text-right pr-0"><strong class="text-info">Alternative Phone&nbsp;&nbsp;&nbsp;&nbsp;:</strong></div>
                                    <div class="col-xs-6 col-sm-6 col-md-6 pull-right text-justify pl-0">&nbsp;&nbsp;&nbsp;&nbsp;{{ $user->altr_phone }}</div>
                                    <div class="clearfix"></div>
                                    <?php
                                }
                                ?>

                                <div class="col-xs-6 col-sm-6 col-md-6 pull-left text-right pr-0"><strong class="text-info">Present Address&nbsp;&nbsp;&nbsp;&nbsp;:</strong></div>
                                <div class="col-xs-6 col-sm-6 col-md-6 pull-right text-justify pl-0">&nbsp;&nbsp;&nbsp;&nbsp;{{ $user->present_addr }}</div>
                                <div class="clearfix"></div>

                                <div class="col-xs-6 col-sm-6 col-md-6 pull-left text-right pr-0"><strong class="text-info">Permanent Address&nbsp;&nbsp;&nbsp;&nbsp;:</strong></div>
                                <div class="col-xs-6 col-sm-6 col-md-6 pull-right text-justify pl-0">&nbsp;&nbsp;&nbsp;&nbsp;{{ $user->permanent_addr }}</div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane pt-4 active" id="semesters" role="tabpanel">
                        @php

                            $form = 
                            '
                                <table class="table table-bordered table-sm text-center">
                                  <thead>
                                    <tr>
                                      <th scope="col">Payable</th>
                                      <th scope="col">Paid</th>
                                      <th scope="col">Due</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <tr>
                                      <td id="payable"></td>
                                      <td id="paid"></td>
                                      <td id="due"></td>
                                    </tr>
                                  </tbody>
                                </table>

                                <input type="hidden" id="user_id" name="user_id" value="'.$user->user_id.'">

                                <div class="col-md-6 pull-left">
                                    <div id="add_payment_group" class="form-group">
                                        <label class="control-label">
                                            Add Payment
                                        </label>
                                        <input type="number" id="add_payment" name="add_payment" class="form-control">
                                        <small id="add_payment_error" class="  error-feedback"></small>
                                    </div>
                                </div>
                                <div class="col-md-6 pull-right">
                                    <div id="deduct_payment_group" class="form-group">
                                        <label class="control-label">
                                            Deduct Payment
                                        </label>
                                        <input type="number" id="deduct_payment" name="deduct_payment" class="form-control">
                                        <small id="deduct_payment_error" class="  error-feedback"></small>
                                    </div>
                                </div>
                            ';
                        @endphp
                        @include('crud.main', [
                            'Name'  =>'TutionFee',
                            'Title' =>'Tution Fee',
                            'createBtn'  =>'No',
                            'Form'  =>$form
                        ])

                        @php

                            $event = 
                            "
                                $('#crud_content_wrapper').removeClass('content-wrapper');
                            ";

                            $clearLVE =
                            "
                                $('#add_payment_error').html('');
                                $('#deduct_payment_error').html('');
                            ";

                            $editDataReg = 
                            "
                                $('#payable').html(response.editData.total_fee);
                                $('#paid').html(response.editData.paid);
                                $('#due').html(response.editData.due);   
                            ";

                            $BVRules =
                            "
                                add_payment: 
                                {
                                    message: 'The add payment is not valid',
                                    validators: {
                                        stringLength: {
                                            max: 7,
                                        },
                                        digits: {},
                                    }
                                },

                                deduct_payment:
                                {
                                    message: 'The add payment is not valid',
                                    validators: {
                                        stringLength: {
                                            max: 7,
                                        },
                                        digits: {},
                                    }
                                },
                            "
                        @endphp
                        @include('crud.ajax', [
                            'Name'          =>'TutionFee',
                            'havePic'       =>'no',
                            'newEvent'      =>$event,
                            'clearLVE'      =>$clearLVE,
                            'editDataReg'   =>$editDataReg,
                            'BVRules'       =>$BVRules,
                        ])
                    </div>
                    <div class="tab-pane pt-4" id="paymentsummary" role="tabpanel">
                        <div class="colmd-6 mx-auto">
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
        </div>
    </div>
</div>

