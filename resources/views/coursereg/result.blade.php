
    <div class="row mb-4">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body p-4">
                    <ul class="nav nav-tabs" id="Demo-tab1" role="tablist">
                        <li class="nav-item col-md-6">
                            <a class="nav-link text-center" data-toggle="tab" href="#profile" role="tab">Profile</a>
                        </li>
                        <li class="nav-item col-md-6">
                            <a class="nav-link text-center active" data-toggle="tab" href="#registration" role="tab">Registration</a>
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
                                        <div class="col-xs-6 col-sm-6 col-md-6 pull-right text-justify pl-0">&nbsp;&nbsp;&nbsp;&nbsp;{{ $user->abbreviation }}</div>
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
                        <div class="tab-pane pt-4 active" id="registration" role="tabpanel">
                            @php
                                $semesterList = '';
                                foreach($semesters as $semester)
                                {
                                    $semesterList .= '<option value="'.$semester->code.'">'.$semester->name.'</option>';

                                }

                                $sectionList = '';
                                foreach($sections as $section)
                                {
                                    $sectionList .= '<option value="'.$section->name.'">'.$section->name.'</option>';

                                }

                                $deptList = '';
                                foreach($departments as $department)
                                {
                                    $deptList .= '<option value="'.$department->code.'">'.$department->name.'</option>';
                                }

                                $form = 
                                '
                                    <input type="hidden" id="user_id" name="user_id" value="'.$user->user_id.'">

                                    <div class="col-md-6 pull-left">
                                        <div id="sem_code_group" class="form-group">
                                            <label class="control-label">
                                                Semester Name<strong class="text-danger">*</strong>
                                            </label>
                                            <select id="sem_code" name="sem_code" class="form-control"  required>
                                                <option value="">Select Semester Name</option>
                                                '.$semesterList.'
                                            </select>
                                            <small id="sem_code_error" class="  error-feedback"></small>
                                        </div>
                                    </div>
                                    <div class="col-md-6 pull-right">
                                        <div id="section_group" class="form-group">
                                            <label class="control-label">
                                                Section Name<strong class="text-danger">*</strong>
                                            </label>
                                            <select id="section" name="section" class="form-control"  required>
                                                <option value="">Select Section Name</option>
                                                '.$sectionList.'
                                            </select>
                                            <small id="section_error" class="  error-feedback"></small>
                                        </div>
                                    </div>
                                    <div class="col-md-6 pull-left">
                                        <div id="department_code_group" class="form-group">
                                            <label class="control-label">
                                                Department Name<strong class="text-danger">*</strong>
                                            </label>
                                            <select id="department_code" name="department_code" class="form-control" required>
                                                <option value="">Select Department Name</option>
                                            '.$deptList.'
                                            </select>
                                            <small id="department_code_error" class="  error-feedback"></small>
                                        </div>
                                    </div>
                                    <div class="col-md-6 pull-right">
                                        <div id="course_code_group" class="form-group">
                                            <label class="control-label">
                                                Course Name<strong class="text-danger">*</strong>
                                            </label>
                                            <select id="course_code" name="course_code[]" class="form-control"  multiple required>
                                                <option value="">Select Course Name</option>
                                            </select>
                                            <small id="course_code_error" class="  error-feedback"></small>
                                        </div>
                                    </div>

                                ';
                            @endphp
                            @include('crud.main', [
                                'Name'  =>'CourseReg',
                                'Title' =>'Course Registration',
                                'Form'  =>$form
                            ])

                            @php

                                $event = 
                                "
                                    $('#crud_content_wrapper').removeClass('content-wrapper');
                                    $('#course_code').selectize({
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

                                    $('#department_code').change(function(){
                                        
                                        var department_code =  $('#department_code').val();
                                        $('#course_code')[0].selectize.clear();
                                        $('#course_code')[0].selectize.clearOptions();

                                        $.ajax({
                                            url : '/coursereg/dynamic',
                                            type: 'POST',
                                            data : {department_code: department_code},
                                            success: function(response)
                                            {
                                                if(!response.message)
                                                {
                                                    var courses = response.courses;
                                                    var l = courses.length;
                                                    for(var i=0; i < l; i++)
                                                    { 
                                                        $('#course_code')[0].selectize.addOption({value:courses[i].code, text: courses[i].title});
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

                                                    $('#department_code_error').html(validation.errors.department_code);
                                                    $('#department_code_group').removeClass('has-success');
                                                    $('#department_code_group').addClass('has-error');
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
                                    $('#sem_code_error').html('');
                                    $('#section_error').html('');
                                    $('#course_code_error').html('');
                                    $('#course_code_group').removeClass('has-error');
                                ";

                                $editDataReg = 
                                "
                                    $('#department_code').val(response.editData.dept_code);
                                    $('#sem_code').val(response.editData.sem_code);
                                    $('#section').val(response.editData.section);

                                    var department_code =  $('#department_code').val();
                                    $('#course_code')[0].selectize.clear();
                                    $('#course_code')[0].selectize.clearOptions();

                                    $.ajax({
                                        url : '/coursereg/dynamic',
                                        type: 'POST',
                                        data : {department_code: department_code},
                                        success: function(response)
                                        {
                                            if(!response.message)
                                            {
                                                var courses = response.courses;
                                                var l = courses.length;
                                                for(var i=0; i < l; i++)
                                                { 
                                                    $('#course_code')[0].selectize.addOption({value:courses[i].code, text: courses[i].title});
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

                                                $('#department_code_error').html(validation.errors.department_code);
                                                $('#department_code_group').removeClass('has-success');
                                                $('#department_code_group').addClass('has-error');
                                            }
                                            else
                                            {
                                                console.log('Uncaught Error.' + jqXHR.responseText);
                                            } 
                                        },
                                    });

                                    setCourseCode();

                                    //console.log(response.editData.course_code);
                                    function setCourseCode() 
                                    {
                                        setTimeout(function()
                                        {
                                            var setectedCode = response.editData.course_code.split(', ');
                                            //console.log(setectedCode);
                                            var l =setectedCode.length;
                                            for(var i=0; i < l; i++)
                                            {
                                                $('#course_code')[0].selectize.setValue(setectedCode);
                                            };
                                        }, 800);
                                    }
                                ";

                                $BVRules =
                                "
                                    sem_code: 
                                    {
                                        message: 'The semester name is not valid',
                                        validators: {
                                            notEmpty: {
                                                message: 'The semester name is required and cannot be empty'
                                            },
                                            stringLength: {
                                                max: 3,
                                            },
                                            digits: {},
                                            remote: {
                                                type: 'POST',
                                                url: '/remote',
                                                data: function(validator) {
                                                    return {
                                                        id: validator.getFieldElements('coursereg_id').val(),
                                                        user_id: validator.getFieldElements('user_id').val(),
                                                        type: 'CourseReg'
                                                    };
                                                },
                                                delay: 0
                                            },
                                        }
                                    },

                                    section: 
                                    {
                                        message: 'The section name is not valid',
                                        validators: {
                                            notEmpty: {
                                                message: 'The section name is required and cannot be empty'
                                            },
                                            stringLength: {
                                                max: 15,
                                            },
                                            regexp: {
                                                regexp: /^[a-zA-Z0-9-_/]+$/,
                                            },
                                        }
                                    },

                                    department_code: 
                                    {
                                        message: 'The department name is not valid',
                                        validators: {
                                            notEmpty: {
                                                message: 'The department name is required and cannot be empty'
                                            },
                                            stringLength: {
                                                max: 10,
                                            },
                                            digits: {},
                                        }
                                    },
                                "
                            @endphp
                            @include('crud.ajax', [
                                'Name'          =>'CourseReg',
                                'havePic'       =>'no',
                                'newEvent'      =>$event,
                                'clearLVE'      =>$clearLVE,
                                'editDataReg'   =>$editDataReg,
                                'BVRules'       =>$BVRules,
                            ])
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

