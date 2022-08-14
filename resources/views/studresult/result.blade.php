@php

    $form =
    '
        <div class="col-md-12 text-center text-info p-2" id="stud_id"></div>

        <input type="hidden" id="viewData" name="viewData" value="'.$viewData.'">
        <div class="col-md-6 pull-left">
            <div id="attendance_group" class="form-group">
                <label class="control-label">
                    Attendance
                </label>
                <input type="text" id="attendance" name="attendance" class="form-control">
                <small id="attendance_error" class="  error-feedback"></small>
            </div>
        </div>
        <div class="col-md-6 pull-right">
            <div id="ct_1_group" class="form-group">
                <label class="control-label">
                    CT 1
                </label>
                <input type="text" id="ct_1" name="ct_1" class="form-control">
                <small id="ct_1_error" class="  error-feedback"></small>
            </div>
        </div>
        <div class="col-md-6 pull-left">
            <div id="ct_2_group" class="form-group">
                <label class="control-label">
                    CT 2
                </label>
                <input type="text" id="ct_2" name="ct_2" class="form-control">
                <small id="ct_2_error" class="  error-feedback"></small>
            </div>
        </div>
        <div class="col-md-6 pull-right">
            <div id="ct_3_group" class="form-group">
                <label class="control-label">
                    CT 3
                </label>
                <input type="text" id="ct_3" name="ct_3" class="form-control">
                <small id="ct_3_error" class="  error-feedback"></small>
            </div>
        </div>
        <div class="col-md-6 pull-left">
            <div id="presentation_group" class="form-group">
                <label class="control-label">
                    Presentation
                </label>
                <input type="text" id="presentation" name="presentation" class="form-control">
                <small id="presentation_error" class="  error-feedback"></small>
            </div>
        </div>
        <div class="col-md-6 pull-right">
            <div id="assignment_group" class="form-group">
                <label class="control-label">
                    Assignment
                </label>
                <input type="text" id="assignment" name="assignment" class="form-control">
                <small id="assignment_error" class="  error-feedback"></small>
            </div>
        </div>
        <div class="col-md-6 pull-left">
            <div id="midterm_group" class="form-group">
                <label class="control-label">
                    Mid Term
                </label>
                <input type="text" id="midterm" name="midterm" class="form-control">
                <small id="midterm_error" class="  error-feedback"></small>
            </div>
        </div>
        <div class="col-md-6 pull-right">
            <div id="final_group" class="form-group">
                <label class="control-label">
                    Final
                </label>
                <input type="text" id="final" name="final" class="form-control">
                <small id="final_error" class="  error-feedback"></small>
            </div>
        </div>
    ';
@endphp
@include('crud.main', [
    'Name'  =>'StudResult',
    'Title' =>'Student Result',
    'createBtn'  =>'No',
    'Form'  =>$form
])

@php

    $event =
    "
        $('#crud_content_wrapper').removeClass('content-wrapper');

        $('#attendance').maskMoney({allowZero: true, thousands: ''});
        $('#ct_1').maskMoney({allowZero: true, thousands: ''});
        $('#ct_2').maskMoney({allowZero: true, thousands: ''});
        $('#ct_3').maskMoney({allowZero: true, thousands: ''});
        $('#presentation').maskMoney({allowZero: true, thousands: ''});
        $('#assignment').maskMoney({allowZero: true, thousands: ''});
        $('#midterm').maskMoney({allowZero: true, thousands: ''});
        $('#final').maskMoney({allowZero: true, thousands: ''});
    ";

    //Clear laravel validation errors
    $clearLVE =
    "
        $('#attendance_error').html('');
        $('#ct_1_error').html('');
        $('#ct_2_error').html('');
        $('#ct_3_error').html('');
        $('#presentation_error').html('');
        $('#assignment_error').html('');
        $('#midterm_error').html('');
        $('#final_error').html('');

        // $('#attendance').val('0.00');
        // $('#ct_1').val('0.00');
        // $('#ct_2').val('0.00');
        // $('#ct_3').val('0.00');
        // $('#presentation').val('0.00');
        // $('#assignment').val('0.00');
        // $('#midterm').val('0.00');
        // $('#final').val('0.00');
    ";

    $editDataReg =
    "
        $('#attendance').val(parseFloat(response.editData.attendance).toFixed(2));
        $('#ct_1').val(parseFloat(response.editData.ct_1).toFixed(2));
        $('#ct_2').val(parseFloat(response.editData.ct_2).toFixed(2));
        $('#ct_3').val(parseFloat(response.editData.ct_3).toFixed(2));
        $('#presentation').val(parseFloat(response.editData.presentation).toFixed(2));
        $('#assignment').val(parseFloat(response.editData.assignment).toFixed(2));
        $('#midterm').val(parseFloat(response.editData.midterm).toFixed(2));
        $('#final').val(parseFloat(response.editData.final).toFixed(2));
        $('#stud_id').html('Student ID: '+response.editData.stud_id);
    ";
    // Bootstrap Validators rules
    $BVRules =
    "
        attendance:
        {
            message: 'The attendance is not valid',
            validators: {
                stringLength: {
                    max: 4,
                    message: 'The attendance marks will be within 3 digit',
                }
            }
        },

        ct_1:
        {
            message: 'The ct 1 is not valid',
            validators: {
                stringLength: {
                    max: 5,
                    message: 'The ct 1 marks will be within 4 digit',
                }
            }
        },

        ct_2:
        {
            message: 'The ct 2 is not valid',
            validators: {
                stringLength: {
                    max: 5,
                    message: 'The ct 2 marks will be within 2 digit',
                }
            }
        },

        ct_3:
        {
            message: 'The ct 3 is not valid',
            validators: {
                stringLength: {
                    max: 5,
                    message: 'The ct 3 marks will be within 4 digit',
                }
            }
        },

        presentation:
        {
            message: 'The presentation is not valid',
            validators: {
                stringLength: {
                    max: 4,
                    message: 'The presentation marks will be within 3 digit',
                }
            }
        },

        assignment:
        {
            message: 'The assignment is not valid',
            validators: {
                stringLength: {
                    max: 4,
                    message: 'The assignment marks will be within 3 digit',
                }
            }
        },

        midterm:
        {
            message: 'The midterm is not valid',
            validators: {
                stringLength: {
                    max: 5,
                    message: 'The midterm marks will be within 4 digit',
                }
            }
        },

        final:
        {
            message: 'The final is not valid',
            validators: {
                stringLength: {
                    max: 5,
                    message: 'The final marks will be within 4 digit',
                }
            }
        },
    "
@endphp
@include('crud.ajax', [
    'Name'          =>'StudResult',
    'havePic'       =>'no',
    'newEvent'      =>$event,
    'clearLVE'      =>$clearLVE,
    'editDataReg'   =>$editDataReg,
    'BVRules'       =>$BVRules,
])

