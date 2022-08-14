@extends('layout.app')

@section('main_content')

@php
    $form = 
    '
        <div class="col-md-6 pull-left">
            <div id="code_group" class="form-group">
                <label class="control-label">
                    Course Code<strong class="text-danger">*</strong>
                </label>
                <input type="text" id="code" name="code" class="form-control"  required>
                <small id="code_error" class="error-feedback"></small>
            </div>
        </div>
        <div class="col-md-6 pull-right">
            <div id="title_group" class="form-group">
                <label class="control-label">
                    Course Title<strong class="text-danger">*</strong>
                </label>
                <input type="text" id="title" name="title" class="form-control" required>
                <small id="title_error" class="error-feedback"></small>
            </div>
        </div>

        <div class="col-md-6 pull-left">
            <div id="credit_group" class="form-group">
                <label class="control-label">
                    Course Credit<strong class="text-danger">*</strong>
                </label>
                <input type="number" id="credit" name="credit" class="form-control" required>
                <small id="credit_error" class="error-feedback"></small>
            </div>
        </div>
        <div class="col-md-6 pull-left">
            <div id="cost_group" class="form-group">
                <label class="control-label">
                    Course cost<strong class="text-danger">*</strong>
                </label>
                <input type="number" id="cost" name="cost" class="form-control" required>
                <small id="cost_hint" class="no-display text-warning pull-left">Cost per credit</small>
                <small id="cost_error" class="error-feedback"></small>
            </div>
        </div>
        <div class="col-md-12 pull-right">
            <div id="description_group" class="form-group">
                <label class="control-label">
                    Course Description
                </label>
                <textarea id="description" name="description" class="form-control"></textarea>
                <small id="description_error" class="error-feedback"></small>
            </div>
        </div>
    '
@endphp
@include('crud.main', [
    'Name'  =>'Course',
    'Title' =>'Course',
    'Form'  =>$form
])

@php
    $event = 
    "
        $('#cost').mouseover(function(){
            $('#cost_hint').show();
        });
        $('#cost').mouseout(function(){
            $('#cost_hint').hide();
        });
    ";

    $clearLVE =
    "
        $('#code_error').html('');
        $('#title_error').html('');
        $('#credit_error').html('');
        $('#cost_error').html('');
        $('#description_error').html('');
    ";

    $editDataReg = 
    "
        $('#code').val(response.editData.code);
        $('#title').val(response.editData.title);
        $('#credit').val(response.editData.credit);
        $('#cost').val(response.editData.cost);
        $('#description').val(response.editData.description);
    ";

    $BVRules =
    "
        code: 
        {
            message: 'The course code is not valid',
            validators: {
                notEmpty: {
                    message: 'The course code is required and cannot be empty'
                },
                stringLength: {
                    max: 10,
                    message: 'The course code can be maximum 10 characters long'
                },
                regexp: {
                    regexp: /^[a-zA-Z0-9/]+$/,
                    message: 'The course code can only consist of alphnumeric characters'
                },
                remote: {
                    type: 'POST',
                    url: '/remote',
                    data: function(validator) {
                        return {
                            id: validator.getFieldElements('course_id').val(),
                            type: 'Course'
                        };
                    },
                    delay: 0
                },
            }
        },

        title: 
        {
            message: 'The course title is not valid',
            validators: {
                notEmpty: {
                    message: 'The course title is required and cannot be empty'
                },
                stringLength: {
                    max: 150,
                    message: 'The course title can be maximum 150 characters long'
                },
                different: {
                    field: 'code',
                    message: 'The course title cannot be the same as course code'
                },
                regexp: {
                    regexp: /^[a-zA-Z0-9.&()_ /-]+$/,
                    message: 'Course Title can only consist of alphanumeric, dot, space, underscore, hyphen, ampersand & parentheses'
                },
                remote: {
                    type: 'POST',
                    url: '/remote',
                    data: function(validator) {
                        return {
                            id: validator.getFieldElements('course_id').val(),
                            type: 'Course'
                        };
                    },
                    delay: 0
                },
            }
        },

        credit: 
        {
            message: 'Course credit is not valid',
            validators: {
                notEmpty: {
                    message: 'Course credit is required and cannot be empty'
                },
                stringLength: {
                    max: 1,
                    message: 'Course credit can be maximum 1 digits long'
                }
            }
        },

        cost: 
        {
            message: 'Course cost is not valid',
            validators: {
                notEmpty: {
                    message: 'Course cost is required and cannot be empty'
                },
                stringLength: {
                    max: 5,
                    message: 'Course cost can be maximum 5 digits long'
                }
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
    'Name'          =>'Course',
    'havePic'       =>'no',
    'newEvent'      =>$event,
    'clearLVE'      =>$clearLVE,
    'editDataReg'   =>$editDataReg,
    'BVRules'       =>$BVRules,
])

@endsection