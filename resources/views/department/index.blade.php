@extends('layout.app')

@section('main_content')

@php
    $facultyList = '';
    foreach($faculties as $faculty)
    {
        $facultyList .= '<option value="'.$faculty->code.'">'.$faculty->name.'</option>';

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
            <div id="name_group" class="form-group">
                <label class="control-label">
                    Department Name<strong class="text-danger">*</strong>
                </label>
                <input type="text" id="name" name="name" class="form-control"  required>
                <small id="name_error" class="  error-feedback"></small>
            </div>
        </div>
        <div class="col-md-6 pull-left">
            <div id="code_group" class="form-group">
                <label class="control-label">
                    Department Code<strong class="text-danger">*</strong>
                </label>
                <input type="text" id="code" name="code" class="form-control"  required>
                <small id="code_error" class="  error-feedback"></small>
            </div>
        </div>
        <div class="col-md-6 pull-left">
            <div id="abbreviation_group" class="form-group">
                <label class="control-label">
                    Department Abbreviation<strong class="text-danger">*</strong>
                </label>
                <input type="text" id="abbreviation" name="abbreviation" class="form-control"  required>
                <small id="abbreviation_error" class="  error-feedback"></small>
            </div>
        </div>
        <div class="col-md-12 pull-right">
            <div id="description_group" class="form-group">
                <label class="control-label">
                    Department Description
                </label>
                <textarea id="description" name="description" class="form-control"></textarea>
                <small id="description_error" class="  error-feedback"></small>
            </div>
        </div>
    ';
@endphp
@include('crud.main', [
    'Name'  =>'Department',
    'Title' =>'Department',
    'Form'  =>$form
])

@php
    $event = 
    "
    ";

    $clearLVE =
    "
        $('#faculty_code_error').html('');
        $('#name_error').html('');
        $('#code_error').html('');
        $('#abbreviation_error').html('');
        $('#description_error').html('');
    ";

    $editDataReg = 
    "
        $('#faculty_code').val(response.editData.faculty_code);
        $('#name').val(response.editData.name);
        $('#code').val(response.editData.code);
        $('#abbreviation').val(response.editData.abbreviation);
        $('#description').val(response.editData.description);

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
                    message: 'Don\'t try to be smart'
                },
                regexp: {
                    regexp: /^[a-zA-Z0-9]+$/,
                    message: 'Don\'t try to be smart'
                },
            }
        },

        name: 
        {
            message: 'The department name is not valid',
            validators: {
                notEmpty: {
                    message: 'The department name is required and cannot be empty'
                },
                stringLength: {
                    max: 250,
                    message: 'The department name can be maximum 250 characters long'
                },
                regexp: {
                    regexp: /^[a-zA-Z0-9-_ &/]+$/,
                    message: 'The department name can only consist of alphnumeric, dashes, space, ampersand & underscore'
                },
                remote: {
                    type: 'POST',
                    url: '/remote',
                    data: function(validator) {
                        return {
                            id: validator.getFieldElements('department_id').val(),
                            type: 'Department'
                        };
                    },
                    delay: 0
                },
            }
        },

        code: 
        {
            message: 'The department code is not valid',
            validators: {
                notEmpty: {
                    message: 'The department code is required and cannot be empty'
                },
                stringLength: {
                    max: 10,
                    message: 'The department code can be maximum 10 charecters long'
                },
                regexp: {
                    regexp: /^[a-zA-Z0-9]+$/,
                    message: 'The department code can only consist of alphnumeric charecters'
                },
                remote: {
                    type: 'POST',
                    url: '/remote',
                    data: function(validator) {
                        return {
                            id: validator.getFieldElements('department_id').val(),
                            type: 'Department'
                        };
                    },
                    delay: 0
                },
            }
        },

        abbreviation: 
        {
            message: 'The department abbreviation is not valid',
            validators: {
                notEmpty: {
                    message: 'The department abbreviation is required and cannot be empty'
                },
                stringLength: {
                    max: 10,
                    message: 'The department abbreviation can be maximum 10 charecters long'
                },
                regexp: {
                    regexp: /^[a-zA-Z]+$/,
                    message: 'The department abbreviation can only consist of alphnbatic charecters'
                },
                remote: {
                    type: 'POST',
                    url: '/remote',
                    data: function(validator) {
                        return {
                            id: validator.getFieldElements('department_id').val(),
                            type: 'Department'
                        };
                    },
                    delay: 0
                },
            }
        },

        description: 
        {
            message: 'The description is not valid',
            validators: {
                stringLength: {
                    max: 250,
                    message: 'The description can be maximum 250 characters long'
                },
                regexp: {
                    regexp: /^[a-zA-Z0-9 &()_/-/,]+$/,
                    message: 'The description can only consist of alphnumeric, space, underscore, hyphen, ampersand, comma & parentheses'
                }
            }
        }
    "
@endphp
@include('crud.ajax', [
    'Name'          =>'Department',
    'havePic'       =>'no',
    'newEvent'      =>$event,
    'clearLVE'      =>$clearLVE,
    'editDataReg'   =>$editDataReg,
    'BVRules'       =>$BVRules,
])

@endsection