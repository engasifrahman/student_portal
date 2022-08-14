@extends('layout.app')

@section('title', 'Admin Dashboard')

@section('main_content')

<?php
  if (session()->has('system_admin')) 
  {
    $id = session()->get('system_admin.id');
  }
  elseif (session()->has('finance_admin')) 
  {
    $id = session()->get('finance_admin.id');
  }
  elseif (session()->has('faculty_member')) 
  {
    $id = session()->get('faculty_member.id');
  }
  elseif (session()->has('student')) 
  {
    $id = session()->get('student.id');
  }
  else
  {
    return redirect('/login');
  }
?>

<div class="content-wrapper">
  <div class="row">
      <div class="col-md-12">
        <div class="col-md-12" id="password_notification_content"></div>
        <div class="card">
          <div class="card-header bg-info">
            <span class="h6 text-white">Change Password</span>
          </div>
          <div class="card-body">
            <form id="password_form" method="post" enctype="multipart/form-data">
            
            <input type="hidden" id="user_table_id" name="user_table_id" value="{{ $id }}">

              <div class="col-md-12 pull-left  pt-2">
                  <div id="old_password_group" class="form-group">
                      <label class="control-label">
                          Old Password<strong class="text-danger">*</strong>
                      </label>
                      <input type="password" id="old_password" name="old_password" class="form-control" required>
                      <small id="old_password_error" class="error-feedback"></small>
                  </div>
              </div>
              <div class="col-md-6 pull-left">
                  <div id="new_password_group" class="form-group">
                      <label class="control-label">
                          New Password<strong class="text-danger">*</strong>
                      </label>
                      <input type="password" id="new_password" name="new_password" class="form-control" required>
                      <small id="new_password_error" class="error-feedback"></small>
                  </div>
              </div>
              <div class="col-md-6 pull-left">
                  <div id="confirm_password_group" class="form-group">
                      <label class="control-label">
                          Confirm Password<strong class="text-danger">*</strong>
                      </label>
                      <input type="password" id="confirm_password" name="confirm_password" class="form-control" required>
                      <small id="confirm_password_error" class="error-feedback"></small>
                  </div>
              </div>
              <div class="col-md-12 pull-left mx-auto text-center pb-3">
                <button type="reset" class="btn btn-outline-warning mr-1 pointer">
                    <i class="icon-cross2"></i> Reset
                </button>

                <button type="submit" class="btn btn-outline-primary pointer" id="change_pass" name="change_pass">
                    <i class="icon-check2"></i> Change
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
  </div>
</div>
<script>
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  //######################## BEGAN VALIDATION #######################//
  $('#password_form').bootstrapValidator({
      fields:
      {
          old_password: 
          {
              message: 'The old password is not valid',
              validators: {
                notEmpty: {
                    message: 'The old password is required and cannot be empty'
                },
                remote: {
                  type: 'POST',
                  url: '/remote',
                  data: function(validator) {
                    return {
                      id: validator.getFieldElements('user_table_id').val(),
                      type: 'PassChange'
                    };
                  },
                  delay: 1500
                },
              }
          },

          new_password: 
          {
              message: 'The new password is not valid',
              validators: {
                notEmpty: {
                    message: 'The new password is required and cannot be empty'
                },
                  stringLength: {
                      min: 6,
                      max: 50,
                      message: 'The new password must be more than 5 and less than 50 characters long'
                  },
                  different: {
                      field: 'old_password',
                      message: 'The new password cannot be the same as old password'
                  }
              }
          },

          confirm_password: 
          {
              message: 'The confirm password is not valid',
              validators: {
                notEmpty: {
                    message: 'The confirm password is required and cannot be empty'
                },
                  stringLength: {
                      min: 6,
                      max: 50,
                      message: 'The confirm password must be more than 5 and less than 50 characters long'
                  },
                  identical: {
                      field: 'new_password',
                      message: 'The confirm password is not the same as new password'
                  }
              }
          }
      }
    }).on('success.form.bv', function (e){
      e.preventDefault();

      //######################## BEGAN Change Password #######################//
      var formData = new FormData(document.getElementById('password_form'));
      $.ajax({
          type: 'POST',
          url: '/settings/'+$('#user_table_id').val(),   // here your php file to do something with postdata
          data: formData, // here you set the data to send to php file
          async: false,
          cache: false,
          contentType: false,
          processData: false,
          beforeSend: function() {
            $('#password_notification_content').show().fadeOut(3100).html(`
                  <div class="text-center">OPERATION IS RUNNING PLEASE WAIT..</div>`);
          },

          success: function (response) {
            //console.log(response);
            if (response.message) 
            {
              $('#password_form').data('bootstrapValidator').resetForm(true);
              $('#password_form').trigger('reset');

              $.toast({
                  text: response.message, // Text that is to be shown in the toast
                  heading: 'Success', // Success, Info, Warning, Danger
                  icon: 'success', // success, info, warning, error
                  showHideTransition: 'slide', // fade, slide or plain
                  allowToastClose: true, // Boolean value true or false
                  hideAfter: 4000, // false to make it sticky or number representing the miliseconds as time after which toast needs to be hidden
                  stack: 5, // false if there should be only one toast at a time or a number representing the maximum number of toasts to be shown at a time
                  position: 'top-right', // bottom-left or bottom-right or bottom-center or top-left or top-right or top-center or mid-center or an object representing the left, right, top, bottom values
                  textAlign: 'left',  // Text alignment i.e. left, right or center
                  loader: true,  // Whether to show loader or not. True by default
                  loaderBg: '#929191',  // Background color of the toast loader
              });

            }
          },

          error: function (jqXHR, exception) 
          {
            @include('crud.ajax_error')
          },
      });
      //######################## END Change Password #######################//
    });
    //######################## END VALIDATION #######################//
</script>
<!-- content-wrapper ends -->
@endsection