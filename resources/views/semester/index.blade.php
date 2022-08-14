@extends('layout.app')

@section('main_content')

@php
    $form = 
    '
        <div class="col-md-6 pull-left">
            <div id="name_group" class="form-group">
                <label class="control-label">
                    Semester Name<strong class="text-danger">*</strong>
                </label>
                <input type="text" id="name" name="name" class="form-control"  required>
                <small id="name_error" class="  error-feedback"></small>
            </div>
        </div>
        <div class="col-md-6 pull-right">
            <div id="description_group" class="form-group">
                <label class="control-label">
                    Semester Description
                </label>
                <input type="text" id="description" name="description" class="form-control">
                <small id="description_error" class="  error-feedback"></small>
            </div>
        </div>
        <div class="col-md-12 pull-left">
            <div class="form-check">
                <label class="form-check-label publish_result">
                    <input class="checkbox" type="checkbox" id="publish_result" name="publish_result">
                Publish Result
                </label>
            </div>
        </div>
    '
@endphp
@include('crud.main', [
    'Name'  =>'Semester',
    'Title' =>'Semester',
    'Form'  =>$form
])

@php
    $event = 
    "
        //var a = $('#publish_result').val();
        //console.log(a);
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
        if(response.editData.published === 'true')
        {
            $('#publish_result').prop('checked', true);
        }
    ";

    $BVRules =
    "
        name: 
        {
            message: 'The semester name is not valid',
            validators: {
                notEmpty: {
                    message: 'The semester name is required and cannot be empty'
                },
                stringLength: {
                    max: 15,
                    message: 'The semester name can be maximum 15 characters long'
                },
                regexp: {
                    regexp: /^[a-zA-Z0-9-_/]+$/,
                    message: 'The semester name can only consist of alphnumeric, dashes & underscore'
                },
                remote: {
                    type: 'POST',
                    url: '/remote',
                    data: function(validator) {
                        return {
                            id: validator.getFieldElements('semester_id').val(),
                            type: 'Semester'
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
        },
        publish_result: {
            validators: {
                regexp: {
                    regexp: /^[a-z]+$/,
                }
            }
        }
    "
@endphp
@include('crud.ajax', [
    'Name'          =>'Semester',
    'havePic'       =>'no',
    'newEvent'      =>$event,
    'clearLVE'      =>$clearLVE,
    'editDataReg'   =>$editDataReg,
    'BVRules'       =>$BVRules,
])

@endsection