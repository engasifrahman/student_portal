@extends('layout.app')

@section('main_content')

@php
    $facultyList = '';
    foreach($faculties as $faculty)
    {
        $facultyList .= '<option value="'.$faculty->code.'">'.$faculty->name.'</option>';

    }

    $coursetList = '';
    foreach($courses as $course)
    {
        $coursetList .= '<option value="'.$course->code.'">'.$course->code.' ('.$course->title.')</option>';
    }

    $form = 
    '
        <div class="col-md-6 pull-left">
            <div id="faculty_code_group" class="form-group">
                <label class="control-label">
                    Faculty Name<strong class="text-danger">*</strong>
                </label>
                <select id="faculty_code" name="faculty_code" class="form-control"  required>
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
                <select id="dept_code" name="dept_code" class="form-control"  required>
                </select>
                <small id="dept_code_error" class="  error-feedback"></small>
            </div>
        </div>
        <div class="col-md-12 pull-left">
            <div id="course_code_group" class="form-group">
                <label class="control-label">
                    Course Name<strong class="text-danger">*</strong>
                </label>
                <select id="course_code" name="course_code[]" class="form-control"  multiple required>
                    <option value="">Select Course Name</option>
                '.$coursetList.'
                </select>
                <small id="course_code_error" class="  error-feedback"></small>
            </div>
        </div>

    ';
@endphp
@include('crud.main', [
    'Name'  =>'DeptCourse',
    'Title'  =>"Department's Course",
    'Form'  =>$form
])

@php

    $event = 
    "
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

        $('#faculty_code').change(function(){
            
            var faculty_code =  $('#faculty_code').val();
            $.ajax({
                url : '/deptcourse/dynamic',
                type: 'POST',
                data : {faculty_code: faculty_code},
                success: function(response)
                {
                    if(!response.message)
                    {
                        $('#dept_code').empty().append('<option value=\"\">Select Department Name</option>');

                        var departments = response.departments;
                        var l = departments.length;
                        for(var i=0; i < l; i++)
                        {
                            $('#dept_code').append('<option value=\"'+departments[i].code+'\">'+departments[i].name+'</option>');
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
        $('#course_code_error').html('');
        $('#course_code_group').removeClass('has-error');
    ";

    $editDataReg = 
    "
        $('#faculty_code').val(response.editData.faculty_code);
        //$('#faculty_code option[value=\"'+response.editData.faculty_code+'\"]').attr('selected', 'selected');

        var faculty_code =  $('#faculty_code').val();
        $.ajax({
            url : '/deptcourse/dynamic',
            type: 'POST',
            data : {faculty_code: faculty_code},
            success: function(response)
            {
                if(!response.message)
                {
                    $('#dept_code').empty().append('<option value=\"\">Select Department Name</option>');

                    var departments = response.departments;
                    var l = departments.length;
                    for(var i=0; i < l; i++)
                    {
                        $('#dept_code').append('<option value=\"'+departments[i].code+'\">'+departments[i].name+'</option>');
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

                    $('#dept_code_error').html(validation.errors.dept_code);
                    $('#dept_code_group').removeClass('has-success');
                    $('#dept_code_group').addClass('has-error');
                }
                else
                {
                    console.log('Uncaught Error.' + jqXHR.responseText);
                } 
            },
        });

        var setectedCode = response.editData.course_code.split(', ');
        //console.log(setectedCode);
        var l =setectedCode.length;
        for(var i=0; i < l; i++)
        {
            $('#course_code')[0].selectize.setValue(setectedCode);
        };
        setDeptCode();

        //console.log(response.editData.dept_code);
        function setDeptCode() {
            setTimeout(function(){
                $('#dept_code').val(response.editData.dept_code);
                $('#dept_code option[value=\"'+response.editData.dept_code+'\"]').attr('selected', 'selected');
            }, 800);
        }
    ";

    $BVRules =
    "
        faculty_code: 
        {
            message: 'The faculty name is not valid',
            validators: {
                notEmpty: {
                    message: 'The faculty name is required and cannot be empty'
                },
                stringLength: {
                    max: 10,
                },
                digits: {},
            }
        },

        dept_code: 
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
                remote: {
                    type: 'POST',
                    url: '/remote',
                    data: function(validator) {
                        return {
                            id: validator.getFieldElements('deptcourse_id').val(),
                            type: 'DepartmentalCourse'
                        };
                    },
                    delay: 0
                },
            }
        },
    "
@endphp
@include('crud.ajax', [
    'Name'          =>'DeptCourse',
    'havePic'       =>'no',
    'newEvent'      =>$event,
    'clearLVE'      =>$clearLVE,
    'editDataReg'   =>$editDataReg,
    'BVRules'       =>$BVRules,
])

@endsection