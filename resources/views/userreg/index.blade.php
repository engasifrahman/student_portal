@extends('layout.app')

@section('main_content')

@php
    $semesterList = '';
    foreach($semesters as $semester)
    {
        $semesterList .= '<option value="'.$semester->code.'">'.$semester->name.'</option>';

    }
    $facultyList = '';
    foreach($faculties as $faculty)
    {
        $facultyList .= '<option value="'.$faculty->code.'">'.$faculty->name.'</option>';

    }

    $form =
    '
        <div class="col-md-4 mx-auto">
            <div id="picture_group" class="form-group">
                <label class="control-label">
                    Picture
                </label>
                <input type="file" id="userreg_picture" name="userreg_picture" class="dropify" data-height="200" data-max-file-size="2M" data-allowed-file-extensions="jpeg png jpg gif">

                <div class="form-check">
                  <label class="form-check-label userreg_changePic">
                    <input class="checkbox" type="checkbox" id="userreg_changePic" name="userreg_changePic">
                        Change Picture
                    </label>
                </div>

                <small id="picture_error" class="error-feedback"></small>
            </div>
        </div>
        <div class="col-md-6 pull-left">
            <div id="type_group" class="form-group">
                <label class="control-label">
                    User Type<strong class="text-danger">*</strong>
                </label>
                <select id="type" name="type" class="form-control" required>
                    <option value="">Select User Type</option>
                    <optgroup label="Administration"></optgroup>
                    <option value="System Admin">System Admin</option>
                    <option value="Finance Admin">Finance Admin</option>
                    <optgroup label="System User"></optgroup>
                    <option value="Faculty Member">Faculty Member</option>
                    <option value="Student">Student</option>
                </select>
                <small id="type_error" class="  error-feedback"></small>
            </div>
        </div>
        <div class="col-md-6 pull-left">
            <div id="sem_code_group" class="form-group">
                <label class="control-label">
                    Semester Name<strong class="text-danger">*</strong>
                </label>
                <select id="sem_code" name="sem_code" class="form-control" required>
                     <option value="">Select Semester Name</option>
                    '.$semesterList.'
                </select>
                <small id="sem_code_error" class="  error-feedback"></small>
            </div>
        </div>
        <div class="col-md-6 pull-left">
            <div id="faculty_code_group" class="form-group">
                <label class="control-label">
                    Faculty Name<strong class="text-danger">*</strong>
                </label>
                <select id="faculty_code" name="faculty_code[]" class="form-control" multiple required>
                    <option value="">Select Faculty Name</option>
                    '.$facultyList.'
                </select>
                <small id="faculty_code_error" class="  error-feedback"></small>
            </div>
        </div>
        <div class="col-md-6 pull-left">
            <div id="dept_code_group" class="form-group">
                <label class="control-label">
                    Department Name<strong class="text-danger">*</strong>
                </label>
                <select id="dept_code" name="dept_code[]" class="form-control" required>
                    <option value="">Select Department Name</option>
                </select>
                <small id="dept_code_error" class="error-feedback"></small>
            </div>
        </div>
        <div class="col-md-6 pull-left name">
            <div id="name_group" class="form-group">
                <label class="control-label">
                    Name<strong class="text-danger">*</strong>
                </label>
                <input type="text" id="name" name="name" class="form-control" required>
                <small id="name_error" class="error-feedback"></small>
            </div>
        </div>
        <div class="col-md-6 pull-left">
            <div id="designation_group" class="form-group">
                <label class="control-label">
                    Designation<strong class="text-danger">*</strong>
                </label>
                <input type="text" id="designation" name="designation" class="form-control" required>
                <small id="designation_error" class="error-feedback"></small>
            </div>
        </div>
        <div class="col-md-12 pull-left">
            <div id="abbreviation_group" class="form-group" style="display: none">
                <label class="control-label">
                    Abbreviation<strong class="text-danger">*</strong>
                </label>
                <input type="text" id="abbreviation" name="abbreviation" class="form-control" required>
                <small id="abbreviation_error" class="error-feedback"></small>
            </div>
        </div>
        <div class="col-md-6 pull-left">
            <div id="dob_group" class="form-group">
                <label class="control-label">
                    Date of Birth<strong class="text-danger">*</strong>
                </label>
                <input type="date" id="dob" name="dob" class="form-control" required>
                <small id="dob_error" class="error-feedback"></small>
            </div>
        </div>
        <div class="col-md-6 pull-left">
            <div id="gender_group" class="form-group">
                <label class="control-label">
                    Gender<strong class="text-danger">*</strong>
                </label>
                <select id="gender" name="gender" class="form-control" required>
                    <option value="">Select Gender</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                    <option value="Others">Others</option>
                </select>
                <small id="gender_error" class="error-feedback"></small>
            </div>
        </div>
        <div class="col-md-6 pull-left">
            <div id="marital_status_group" class="form-group">
                <label class="control-label">
                    Marital Status<strong class="text-danger">*</strong>
                </label>
                <select id="marital_status" name="marital_status" class="form-control" required>
                    <option value="">Select Marital Status</option>
                    <option value="Unmarried">Unmarried</option>
                    <option value="Married">Married</option>
                    <option value="Divorced">Divorced</option>
                    <option value="Widow">Widow</option>
                    <option value="Widower">Widower</option>
                </select>
                <small id="marital_status_error" class="error-feedback"></small>
            </div>
        </div>
        <div class="col-md-6 pull-left">
            <div id="nationality_group" class="form-group">
                <label class="control-label">
                    Nationality<strong class="text-danger">*</strong>
                </label>
                <input type="text" id="nationality" name="nationality" class="form-control" required>
                <small id="nationality_error" class="error-feedback"></small>
            </div>
        </div>
        <div class="col-md-6 pull-left">
            <div id="nid_group" class="form-group">
                <label class="control-label">
                    National ID
                </label>
                <input type="number" id="nid" name="nid" class="form-control">
                <small id="nid_error" class="error-feedback"></small>
            </div>
        </div>
        <div class="col-md-6 pull-left">
            <div id="birth_certificate_group" class="form-group">
                <label class="control-label">
                    Birth Certificate
                </label>
                <input type="number" id="birth_certificate" name="birth_certificate" class="form-control">
                <small id="birth_certificate_error" class="error-feedback"></small>
            </div>
        </div>
        <div class="col-md-6 pull-left">
            <div id="father_name_group" class="form-group">
                <label class="control-label">
                    Father Name<strong class="text-danger">*</strong>
                </label>
                <input type="text" id="father_name" name="father_name" class="form-control" required>
                <small id="father_name_error" class="error-feedback"></small>
            </div>
        </div>
        <div class="col-md-6 pull-left">
            <div id="mother_name_group" class="form-group">
                <label class="control-label">
                    Mother Name<strong class="text-danger">*</strong>
                </label>
                <input type="text" id="mother_name" name="mother_name" class="form-control" required>
                <small id="mother_name_error" class="error-feedback"></small>
            </div>
        </div>
        <div class="col-md-6 pull-left">
            <div id="email_group" class="form-group">
                <label class="control-label">
                    Email<strong class="text-danger">*</strong>
                </label>
                <input type="email" id="email" name="email" class="form-control">
                <small id="email_error" class="error-feedback"></small>
            </div>
        </div>
        <div class="col-md-6 pull-left">
            <div id="altr_email_group" class="form-group">
                <label class="control-label">
                    Alternative Email
                </label>
                <input type="email" id="altr_email" name="altr_email" class="form-control">
                <small id="altr_email_error" class="error-feedback"></small>
            </div>
        </div>
        <div class="col-md-6 pull-left">
            <div id="phone_group" class="form-group">
                <label class="control-label">
                    Phone<strong class="text-danger">*</strong>
                </label>
                <input type="text" id="phone" name="phone" class="form-control">
                <small id="phone_error" class="error-feedback"></small>
            </div>
        </div>
        <div class="col-md-6 pull-left">
            <div id="altr_phone_group" class="form-group">
                <label class="control-label">
                    Alternative Phone
                </label>
                <input type="text" id="altr_phone" name="altr_phone" class="form-control">
                <small id="altr_phone_error" class="error-feedback"></small>
            </div>
        </div>
        <div class="col-md-6 pull-left">
            <div id="permanent_addr_group" class="form-group">
                <label class="control-label">
                   Permanent Address<strong class="text-danger">*</strong>
                </label>
                <textarea id="permanent_addr" name="permanent_addr" class="form-control"></textarea>
                <small id="permanent_addr_error" class="error-feedback"></small>
            </div>
        </div>
        <div class="col-md-6 pull-left">
            <div id="present_addr_group" class="form-group">
                <label class="control-label">
                    Present Address<strong class="text-danger">*</strong>
                </label>
                <textarea id="present_addr" name="present_addr" class="form-control"></textarea>
                <div class="form-check">
                  <label class="form-check-label">
                    <input class="checkbox" type="checkbox" id="copyAddress">
                        Copy permanent address
                    </label>
                </div>
                <small id="present_addr_error" class="error-feedback"></small>
            </div>
        </div>
    ';
@endphp
@include('crud.main', [
    'Name'  =>'UserReg',
    'Title' =>'Register',
    'Form'  =>$form
])

@php
    $event =
    "
        $('#faculty_code').selectize({
            plugins: ['remove_button', 'drag_drop'],
            maxItems:100,
            persist: true,
            create: false,
            render: {
                item: function(data, escape) {
                    return '<div>' + escape(data.text) + '</div>';
                }
            }
        });

        $('#dept_code').selectize({
            plugins: ['remove_button', 'drag_drop'],
            maxItems:100,
            persist: true,
            create: false,
            render: {
                item: function(data, escape) {
                    return '<div>' + escape(data.text) + '</div>';
                }
            }
        });

        $('#userreg_form').on('change mouseover',function() {

            if ($('#copyAddress').is(':checked'))
            {
                $('#present_addr').val($('#permanent_addr').val());

            }
        });

        $('#type').on('change',function() {
            var type = $('#type').val();

            if (type == 'Faculty Member')
            {
                $('#abbreviation_group').slideDown(500);
                $('#abbreviation').prop('required', true);
            }
            else
            {
                $('#abbreviation').val('');
                $('#abbreviation_group').slideUp(500);
                $('#abbreviation').prop('required', false);
            }

            if(type == 'Student')
            {
                $('#designation').val('');
                $('#designation_group').slideUp(500);
                $('#designation').prop('required', false);
                $('.name').removeClass('col-md-6');
                $('.name').addClass('col-md-12');

            }
            else
            {
                $('#designation_group').slideDown(500);
                $('#designation').prop('required', true);
                $('.name').removeClass('col-md-12');
                $('.name').addClass('col-md-6');
            }
        });

        $('#faculty_code').on('change', function(){

            var faculty_code =  $('#faculty_code').val();

            $('#dept_code')[0].selectize.clear();
            $('#dept_code')[0].selectize.clearOptions();
            $.ajax({
                url: '/userreg/dynamic',
                type: 'POST',
                data: {faculty_code: faculty_code},
                success: function(response)
                {
                    if(!response.message)
                    {
                        var departments = response.departments;
                        var l = departments.length;
                        for(var i=0; i < l; i++)
                        {

                            $('#dept_code')[0].selectize.addOption({value:departments[i].code, text: departments[i].name});
                        };
                    }
                },

                error: function (jqXHR, exception)
                {
                    if (jqXHR.status == 422)
                    {
                        validation = jqXHR.responseText;
                        validation = JSON.parse(validation);
                        console.log(validation);
                        msg = validation.message;

                        $.toast({
                            text: msg,
                            heading: 'Error', // // As your wish
                            icon: 'error', // success, info, warning, error
                            showHideTransition: 'slide', // fade, slide or plain
                            allowToastClose: true,
                            hideAfter: 4000,
                            stack: 5,
                            position: 'top-right',
                            textAlign: 'left',  // left, right or center
                            loader: true,
                            loaderBg: '#929191',
                        });

                        $('#faculty_code_error').html(validation.errors.faculty_code);
                        $('#faculty_code_group').removeClass('has-success');
                        $('#faculty_code_group').addClass('has-error');
                    }
                    else
                    {
                        console.log('Uncaught Error.' + jqXHR.responseText);
                    }
                },
            });
        });

    ";

    $clearLVE =
    "
        $('#dept_code_error').html('');
        $('#name_error').html('');
        $('#picture_error').html('');
        $('#designation_error').html('');
        $('#dob_error').html('');
        $('#gender_error').html('');
        $('#marital_status_error').html('');
        $('#nationality_error').html('');
        $('#nid_error').html('');
        $('#birth_certificate_error').html('');
        $('#father_name_error').html('');
        $('#mother_name_error').html('');
        $('#email_error').html('');
        $('#altr_email_error').html('');
        $('#phone_error').html('');
        $('#altr_phone_error').html('');
        $('#permanent_addr_error').html('');
        $('#present_addr_error').html('');
    ";

    $editDataReg =
    "
        var facultycode = response.editData.faculty_code.toString().split(', ');
        console.log(facultycode);
        var l =facultycode.length;
        for(var i=0; i < l; i++)
        {
            $('#faculty_code')[0].selectize.setValue(facultycode);
        };

        var faculty_code =  $('#faculty_code').val();

        $.ajax({
            url: '/userreg/dynamic',
            type: 'POST',
            data: {faculty_code: faculty_code},
            success: function(response)
            {
                console.log(response);
                if(!response.message)
                {
                    var departments = response.departments;
                    var l = departments.length;
                    for(var i=0; i < l; i++)
                    {

                        $('#dept_code')[0].selectize.addOption({value:departments[i].code, text: departments[i].name});
                    };
                }
            },

            error: function (jqXHR, exception)
            {
                if (jqXHR.status == 422)
                {
                    validation = jqXHR.responseText;
                    validation = JSON.parse(validation);
                    console.log(validation);
                    msg = validation.message;

                    $.toast({
                        text: msg,
                        heading: 'Error', // // As your wish
                        icon: 'error', // success, info, warning, error
                        showHideTransition: 'slide', // fade, slide or plain
                        allowToastClose: true,
                        hideAfter: 4000,
                        stack: 5,
                        position: 'top-right',
                        textAlign: 'left',  // left, right or center
                        loader: true,
                        loaderBg: '#929191',
                    });

                    $('#faculty_code_error').html(validation.errors.faculty_code);
                    $('#faculty_code_group').removeClass('has-success');
                    $('#faculty_code_group').addClass('has-error');
                }
                else
                {
                    console.log('Uncaught Error.' + jqXHR.responseText);
                }
            },
        });

        setDeptCode();

        //console.log(response.editData.dept_code);
        function setDeptCode() {
            setTimeout(function(){
                var deptcode = response.editData.dept_code.toString().split(', ');
                //console.log(facultycode);
                var l =deptcode.length;
                for(var i=0; i < l; i++)
                {
                    $('#dept_code')[0].selectize.setValue(deptcode);
                };
            }, 800);
        }

        $('#userreg_pic_dir').val(response.editData.pic_dir);
        $('#type').val(response.editData.type);
        $('#sem_code').val(response.editData.sem_code);
        $('#name').val(response.editData.name);
        $('#abbreviation').val(response.editData.abbreviation);
        $('#designation').val(response.editData.designation);
        $('#dob').val(response.editData.dob);
        $('#gender').val(response.editData.gender);
        $('#marital_status').val(response.editData.marital_status);
        $('#nationality').val(response.editData.nationality);
        $('#nid').val(response.editData.nid);
        $('#birth_certificate').val(response.editData.birth_certificate);
        $('#father_name').val(response.editData.father_name);
        $('#mother_name').val(response.editData.mother_name);
        $('#email').val(response.editData.email);
        $('#altr_email').val(response.editData.altr_email);
        $('#phone').val(response.editData.phone);
        $('#altr_phone').val(response.editData.altr_phone);
        $('#present_addr').val(response.editData.present_addr);
        $('#permanent_addr').val(response.editData.permanent_addr);

        var type = $('#type').val();

        if (type == 'Faculty Member')
        {
            $('#abbreviation_group').slideDown(500);
            $('#abbreviation').prop('required', true);
        }
        else
        {
            $('#abbreviation').val('');
            $('#abbreviation_group').slideUp(500);
            $('#abbreviation').prop('required', false);
        }

        if(type == 'Student')
        {
            $('#designation').val('');
            $('#designation_group').slideUp(500);
            $('#designation').prop('required', false);
            $('.name').removeClass('col-md-6');
            $('.name').addClass('col-md-12');

        }
        else
        {
            $('#designation_group').slideDown(500);
            $('#designation').prop('required', true);
            $('.name').removeClass('col-md-12');
            $('.name').addClass('col-md-6');
        }
    ";

    $BVRules =
    "
        type:
        {
            message: 'The user type is not valid',
            validators: {
                notEmpty: {
                    message: 'The user type is required and cannot be empty'
                },
                stringLength: {
                    max: 15,
                },
                regexp: {
                    regexp: /^[a-zA-Z /]+$/,
                },
            }
        },

        sem_code:
        {
            message: 'The user type is not valid',
            validators: {
                notEmpty: {
                    message: 'The user name is required and cannot be empty'
                },
                stringLength: {
                    max: 10,
                },
                digits: {},
            }
        },

        userreg_picture:
        {
            message: 'The picture is not valid',
            validators: {
                file:
                {
                    extension: 'jpeg,png,jpg,gif',
                    maxSize: 2*1024*1024,
                    message: 'Please choose a picture with jpeg, png, jpg, gif extension and maximum size of 2M'
                }
            }
        },

        name:
        {
            message: 'The user name is not valid',
            validators: {
                notEmpty: {
                    message: 'The user name is required and cannot be empty'
                },
                stringLength: {
                    max: 100,
                    message: 'The user name can be maximum 100 characters long'
                },
                regexp: {
                    regexp: /^[a-zA-Z.: /]+$/,
                    message: 'The user name can only consist of alphabatic, space, dot & collon'
                },
            }
        },

        designation:
        {
            message: 'The designation is not valid',
            validators: {
                stringLength: {
                    max: 100,
                    message: 'The designation can be maximum 100 characters long'
                },
                regexp: {
                    regexp: /^[a-zA-Z0-9 &()_/-/,]+$/,
                    message: 'The designation can only consist of alphnumeric, space, underscore, hyphen, ampersand, comma & parentheses'
                }
            }
        },

        abbreviation:
        {
            message: 'The faculty member abbreviation is not valid',
            validators: {
                stringLength: {
                    max: 10,
                    message: 'The faculty member abbreviation can be maximum 10 characters long'
                },
                regexp: {
                    regexp: /^[A-Z/]+$/,
                    message: 'The faculty member abbreviation can only consist of capital letters'
                }
            }
        },

        dob:
        {
            message: 'The date of birth is not valid',
            validators: {
                notEmpty: {
                    message: 'The date of birth is required and cannot be empty'
                },
                date: {
                    format: 'DD-MM-YYYY',
                    message: 'Date of birth is not valid'
                }
            }
        },

        gender:
        {
            validators: {
                notEmpty: {
                    message: 'The gender is required and cannot be empty'
                },
                stringLength: {
                    max: 10,
                },
                regexp: {
                    regexp: /^[a-zA-Z]+$/,
                },
                choice: {
                    min: 1,
                    max: 1,
                    message: 'Please choose one option only'
                }
            }
        },

        marital_status:
        {
            message: 'The marital Status is not valid',
            validators: {
                notEmpty: {
                    message: 'The marital Status is required and cannot be empty'
                },
                stringLength: {
                    max: 15,
                },
                regexp: {
                    regexp: /^[a-zA-Z]+$/,
                },
                choice: {
                    min: 1,
                    max: 1,
                }
            }
        },

        nationality:
        {
            message: 'The nationality is not valid',
            validators: {
                notEmpty: {
                    message: 'The nationality is required and cannot be empty'
                },
                stringLength: {
                    max: 20,
                    message: 'The nationality can only consist of 20 characters long'
                },
                regexp: {
                    regexp: /^[a-zA-Z]+$/,
                    message: 'The nationality can only consist of alphabetical characters'
                }
            }
        },

        nid:
        {
            message: 'The national ID is not valid',
            validators: {
                stringLength: {
                    min: 9,
                    max: 20,
                    message: 'The national ID must be 9 to 20 characters long'
                },
                digits: {
                    message: 'The national ID can only consist of digits'
                }
            }
        },

        birth_certificate:
        {
            message: 'The birth certificate is not valid',
            validators: {
                stringLength: {
                    min: 9,
                    max: 20,
                    message: 'The birth certificate must be 9 to 17 characters long'
                },
                digits: {
                    message: 'The birth certificate can only consist of digits'
                }
            }
        },

        father_name:
        {
            message: 'The father name is not valid',
            validators: {
                notEmpty: {
                    message: 'The father name is required and cannot be empty'
                },
                stringLength: {
                    max: 100,
                    message: 'The father name can be maximum 100 characters long'
                },
                regexp: {
                    regexp: /^[a-zA-Z.: /]+$/,
                    message: 'The father name can only consist of alphabatic, space, dot & collon'
                }
            }
        },

        mother_name:
        {
            message: 'The mother name is not valid',
            validators: {
                notEmpty: {
                    message: 'The mother name is required and cannot be empty'
                },
                stringLength: {
                    max: 100,
                    message: 'The mother name can be maximum 100 characters long'
                },
                regexp: {
                    regexp: /^[a-zA-Z.: /]+$/,
                    message: 'The father name can only consist of alphabatic, space, dot & collon'
                }
            }
        },

        email:
        {
            message: 'The E-mail address is not valid',
            validators: {
                notEmpty: {
                    message: 'The E-mail address is required and cannot be empty'
                },
                stringLength: {
                    max: 100,
                    message: 'The E-mail address can be maximum 100 characters long'
                },
                emailAddress: {
                    message: 'The input is not a valid E-mail address'
                },
                different: {
                    field: 'altr_email',
                    message: 'The E-mail address cannot be the same as alternative E-mail address'
                },
                remote: {
                    type: 'POST',
                    url: '/remote',
                    data: function(validator) {
                        return {
                            id: validator.getFieldElements('userreg_id').val(),
                            type: 'UserReg'
                        };
                    },
                    delay: 0
                },
            }
        },

        altr_email:
        {
            message: 'The alternative E-mail address is not valid',
            validators: {
                stringLength: {
                    max: 100,
                    message: 'The alternative E-mail address can be maximum 100 characters long'
                },
                emailAddress: {
                    message: 'The input is not a valid E-mail address'
                },
                different: {
                    field: 'email',
                    message: 'The alternative E-mail address cannot be the same as E-mail address'
                }
            }
        },

        phone:
        {
            message: 'The phone number is not valid',
            validators: {
                notEmpty: {
                    message: 'The phone number is required and cannot be empty'
                },
                stringLength: {
                    min: 11,
                    max: 15,
                    message: 'The phone number must be 11 to 15 characters long'
                },
                digits: {
                    message: 'The phone number can only consist of digit'
                },
                different: {
                    field: 'altr_phone',
                    message: 'The phone number cannot be the same as alternative phone number'
                },
                remote: {
                    type: 'POST',
                    url: '/remote',
                    data: function(validator) {
                        return {
                            id: validator.getFieldElements('userreg_id').val(),
                            type: 'UserReg'
                        };
                    },
                    delay: 0
                },
            }
        },

        altr_phone:
        {
            message: 'The alternative phone number is not valid',
            validators: {
                stringLength: {
                    min: 11,
                    max: 15,
                    message: 'The alternative phone number must be 11 to 15 characters long'
                },
                digits: {
                    message: 'The alternative phone number can only consist of digit'
                },
                different: {
                    field: 'phone',
                    message: 'The alternative phone number cannot be the same as phone number'
                }
            }
        },

        present_addr:
        {
            message: 'The present address is not valid',
            validators: {
                notEmpty: {
                    message: 'The present address is required and cannot be empty'
                },
                stringLength: {
                    max: 250,
                    message: 'The present address can only 250 characters long'
                },
                regexp: {
                    regexp: /^[a-zA-Z0-9/#_() ;:, .\-]+$/,
                    message: 'The present address can only consist of alphabetical, space, number, hash, comma, dot, underscore, colon, semi-colon, hyphen and backslash'
                }
            }
        },

        permanent_addr:
        {
            message: 'The permanent address is not valid',
            validators: {
                notEmpty: {
                    message: 'The permanent address is required and cannot be empty'
                },
                stringLength: {
                    max: 250,
                    message: 'The permanent address can only 250 characters long'
                },
                regexp: {
                    regexp: /^[a-zA-Z0-9/#_() ;:, .\-]+$/,
                    message: 'The permanent address can only consist of alphabetical, space, number, hash, comma, dot, underscore, colon, semi-colon, hyphen and backslash'
                }
            }
        },
    "
@endphp
@include('crud.ajax', [
    'Name'          =>'UserReg',
    'havePic'       =>'yes',
    'newEvent'      =>$event,
    'clearLVE'      =>$clearLVE,
    'editDataReg'   =>$editDataReg,
    'BVRules'       =>$BVRules,
])

@endsection
