@extends('layout.app')

@section('main_content')

@php
    $form = 
    '
        <div class="col-md-6 pull-left">
            <div id="name_group" class="form-group">
                <label class="control-label">
                    Section Name<strong class="text-danger">*</strong>
                </label>
                <input type="text" id="name" name="name" class="form-control"  required>
                <small id="name_error" class="  error-feedback"></small>
            </div>
        </div>
        <div class="col-md-6 pull-right">
            <div id="description_group" class="form-group">
                <label class="control-label">
                    Section Description
                </label>
                <input type="text" id="description" name="description" class="form-control">
                <small id="description_error" class="  error-feedback"></small>
            </div>
        </div>
    '
@endphp
@include('crud.main', [
    'Name'  =>'Section',
    'Title' =>'Section',
    'Form'  =>$form
])

@php
    $event = 
    "
    ";

    $clearLVE =
    "
        $('#name_error').html('');
        $('#description_error').html('');
    ";

    $editDataReg = 
    "
        $('#name').val(response.editData.name);
        $('#description').val(response.editData.description);

    ";

    $BVRules =
    "
        name: 
        {
            message: 'The section name is not valid',
            validators: {
                notEmpty: {
                    message: 'The section name is required and cannot be empty'
                },
                stringLength: {
                    max: 15,
                    message: 'The section name can be maximum 15 characters long'
                },
                regexp: {
                    regexp: /^[a-zA-Z0-9-_/]+$/,
                    message: 'The section name can only consist of alphnumeric, dashes & underscore'
                },
                remote: {
                    type: 'POST',
                    url: '/remote',
                    data: function(validator) {
                        return {
                            id: validator.getFieldElements('section_id').val(),
                            type: 'Section'
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
    'Name'          =>'Section',
    'havePic'       =>'no',
    'newEvent'      =>$event,
    'clearLVE'      =>$clearLVE,
    'editDataReg'   =>$editDataReg,
    'BVRules'       =>$BVRules,
])

@endsection