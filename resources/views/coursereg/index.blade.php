@extends('layout.app')

@section('main_content')

<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div id="search_notification_content" class="text-center no-display"></div>
            <br>

            <div class="col-md-12 col-sm-12 col-xs-12 mb-3" id="search_content">

                <div class="card">
                    <form id="search_form" method="post" enctype="multipart/form-data">

                        <div class="col-md-10 pull-left">
                            <div id="user_id_group" class="form-group">
                                <label class="control-label">
                                    User ID<strong class="text-danger">*</strong>
                                </label>
                                <input type="text" id="user_id" name="user_id" class="form-control"  required>
                                <small id="user_id_error" class="error-feedback"></small>
                            </div>
                        </div>
                        <div class="col-md-2 text-center pull-right">
                            <button type="submit" class="btn btn-outline-primary pointer" id="search" name="search" style="margin-top: 1.8rem !important">
                                <i class="icon-check2"></i> Search
                            </button>
                        </div>
                    </form>
                </div>

            </div>
            <div class="col-md-12 col-sm-12 col-xs-12" id="search_result_content"></div>

        </div>
    </div>
</div>
<script>
        $.ajaxSetup({
              headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        //############################# BEGIN VALIDATION ###########################//
        $('#search_form').bootstrapValidator({
            fields:
            {
                user_id:
                {
                    message: 'The id is not valid',
                    validators: {
                        notEmpty: {
                            message: 'The id is required and cannot be empty'
                        },
                        stringLength: {
                            max: 12,
                            message: 'The id can be maximum 12 characters long'
                        },
                        regexp: {
                            regexp: /^[0-9-/]+$/,
                            message: 'The id can only consist of digits & hyphen'
                        },
                        remote: {
                            type: 'POST',
                            url: '/remote',
                            data: function(validator) {
                                return {
                                    type: 'CourseReg'
                                };
                            },
                            delay: 1000
                        },
                    }
                },

            }
        }).on('success.form.bv', function (e){
            e.preventDefault();
            $('#user_id_error').html('');
            //######################## BEGIN SEARCH #######################//
            var formData = new FormData(document.getElementById('search_form'));
            //console.log($('#search_form').serialize());
            /*
            for (let [key, value] of formData.entries()) {
                  console.log(key, ':', value);
            }
            */
            $.ajax({
                type: 'POST',
                url: '/coursereg/search',
                data: formData,
                async: false,
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function() {
                    $('#search_notification_content').show().fadeOut(3100).html(`
                        <div class="text-center">OPERATION IS RUNNING PLEASE WAIT..</div>`);
                },

                success: function (response) {
                    $('#search_result_content').html(response);
                    //console.log(response);
                },

                error: function (jqXHR, exception)
                {
                    @include('crud.ajax_error')
                },
            });
       });
</script>
@endsection
