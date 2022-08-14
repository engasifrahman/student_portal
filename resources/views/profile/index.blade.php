@extends('layout.app')

@section('main_content')
<?php
  if (session()->has('system_admin')) 
  {
    $id         = session()->get('system_admin.id');
    $user_id    = session()->get('system_admin.user_id');
  }
  elseif (session()->has('finance_admin')) 
  {
    $id         = session()->get('finance_admin.id');
    $user_id    = session()->get('finance_admin.user_id');
  }
  elseif (session()->has('faculty_member')) 
  {
    $id         = session()->get('faculty_member.id');
    $user_id    = session()->get('faculty_member.user_id');
  }
  elseif (session()->has('student')) 
  {
    $id         = session()->get('student.id');
    $user_id    = session()->get('student.user_id');
  }
  else
  {
    return redirect('/login');
  }
?>
@php

    $form = 
    '
        <div class="col-md-4 mx-auto">
            <div id="picture_group" class="form-group">
                <label class="control-label">
                    Picture
                </label>
                <input type="file" id="profile_picture" name="profile_picture" class="dropify" data-height="200" data-max-file-size="2M" data-allowed-file-extensions="jpeg png jpg gif">

                <div class="form-check">
                  <label class="form-check-label profile_changePic">
                    <input class="checkbox" type="checkbox" id="profile_changePic" name="profile_changePic">
                        Change Picture
                    </label>
                </div>
                
                <small id="picture_error" class="error-feedback"></small>
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
            <div id="altr_email_group" class="form-group">
                <label class="control-label">
                    Alternative Email
                </label>
                <input type="email" id="altr_email" name="altr_email" class="form-control">
                <small id="altr_email_error" class="error-feedback"></small>
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
    'Name'  =>'Profile',
    'Title' =>'Profile',
    'createBtn'  =>'No',
    'editBtn'  =>'Yes',
    'editId'  =>$id,
    'Form'  =>$form
])

@php
    $event = 
    "
        $('#profile_form').on('change mouseover',function() {

            if ($('#copyAddress').is(':checked'))
            {
                $('#present_addr').val($('#permanent_addr').val());
                
            }
        });

    ";

    $clearLVE =
    "    
        $('#profile_picture_error').html('');
        $('#nid_error').html('');
        $('#birth_certificate_error').html('');
        $('#altr_email_error').html('');
        $('#altr_phone_error').html('');
        $('#permanent_addr_error').html('');
        $('#present_addr_error').html('');
    ";

    $editDataReg = 
    "
        $('#profile_pic_dir').val(response.editData.pic_dir);
        $('#nid').val(response.editData.nid);
        $('#birth_certificate').val(response.editData.birth_certificate);
        $('#altr_email').val(response.editData.altr_email);
        $('#altr_phone').val(response.editData.altr_phone);
        $('#present_addr').val(response.editData.present_addr);
        $('#permanent_addr').val(response.editData.permanent_addr);
    ";

    $BVRules =
    "

        profile_picture: 
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
    'Name'          =>'Profile',
    'havePic'       =>'yes',
    'newEvent'      =>$event,
    'clearLVE'      =>$clearLVE,
    'editDataReg'   =>$editDataReg,
    'BVRules'       =>$BVRules,
])

@endsection