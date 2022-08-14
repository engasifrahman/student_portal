@extends('layout.app')

@section('main_content')

@php
    $form = 
    '
        <div class="col-md-6 pull-left">
            <div id="name_group" class="form-group">
                <label class="control-label">
                    Faculty Name<strong class="text-danger">*</strong>
                </label>
                <input type="text" id="name" name="name" class="form-control"  required>
                <small id="name_error" class="  error-feedback"></small>
            </div>
        </div>
        <div class="col-md-6 pull-left">
            <div id="code_group" class="form-group">
                <label class="control-label">
                    Faculty Code<strong class="text-danger">*</strong>
                </label>
                <input type="text" id="code" name="code" class="form-control"  required>
                <small id="code_error" class="  error-feedback"></small>
            </div>
        </div>
        <div class="col-md-6 pull-left">
            <div id="abbreviation_group" class="form-group">
                <label class="control-label">
                    Faculty Abbreviation<strong class="text-danger">*</strong>
                </label>
                <input type="text" id="abbreviation" name="abbreviation" class="form-control"  required>
                <small id="abbreviation_error" class="  error-feedback"></small>
            </div>
        </div>
        <div class="col-md-6 pull-right">
            <div id="description_group" class="form-group">
                <label class="control-label">
                    Faculty Description
                </label>
                <input type="text" id="description" name="description" class="form-control">
                <small id="description_error" class="  error-feedback"></small>
            </div>
        </div>
    '
@endphp
@include('crud.main', [
    'Name'  =>'Faculty',
    'Title' =>'Faculty',
    'Form'  =>$form
])

@php
    $event = 
    "
    ";

    $clearLVE =
    "
        $('#name_error').html('');
        $('#code_error').html('');
        $('#abbreviation_error').html('');
        $('#description_error').html('');
    ";

    $editDataReg = 
    "
        $('#name').val(response.editData.name);
        $('#code').val(response.editData.code);
        $('#abbreviation').val(response.editData.abbreviation);
        $('#description').val(response.editData.description);

    ";

    $BVRules =
    "
        name: 
        {
            message: 'The faculty name is not valid',
            validators: {
                notEmpty: {
                    message: 'The faculty name is required and cannot be empty'
                },
                stringLength: {
                    max: 250,
                    message: 'The faculty name can be maximum 250 characters long'
                },
                regexp: {
                    regexp: /^[a-zA-Z0-9-_ &/]+$/,
                    message: 'The faculty name can only consist of alphnumeric, dashes, space, ampersand & underscore'
                },
                remote: {
                    type: 'POST',
                    url: '/remote',
                    data: function(validator) {
                        return {
                            id: validator.getFieldElements('faculty_id').val(),
                            type: 'Faculty'
                        };
                    },
                    delay: 0
                },
            }
        },

        code: 
        {
            message: 'The faculty code is not valid',
            validators: {
                notEmpty: {
                    message: 'The faculty code is required and cannot be empty'
                },
                stringLength: {
                    max: 10,
                    message: 'The faculty code can be maximum 10 digits long'
                },
                digits: {
                    message: 'The faculty code can only consist of digits'
                },
                remote: {
                    type: 'POST',
                    url: '/remote',
                    data: function(validator) {
                        return {
                            id: validator.getFieldElements('faculty_id').val(),
                            type: 'Faculty'
                        };
                    },
                    delay: 0
                },
            }
        },

        abbreviation: 
        {
            message: 'The faculty abbreviation is not valid',
            validators: {
                notEmpty: {
                    message: 'The faculty abbreviation is required and cannot be empty'
                },
                stringLength: {
                    max: 10,
                    message: 'The faculty abbreviation can be maximum 10 charecters long'
                },
                regexp: {
                    regexp: /^[a-zA-Z]+$/,
                    message: 'The faculty abbreviation can only consist of alphnbatic charecters'
                },
                remote: {
                    type: 'POST',
                    url: '/remote',
                    data: function(validator) {
                        return {
                            id: validator.getFieldElements('faculty_id').val(),
                            type: 'Faculty'
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
    'Name'          =>'Faculty',
    'havePic'       =>'no',
    'newEvent'      =>$event,
    'clearLVE'      =>$clearLVE,
    'editDataReg'   =>$editDataReg,
    'BVRules'       =>$BVRules,
])

@endsection