@extends('layout.app')

@section('main_content')

@php
    $semesterList = '';
    foreach($semesters as $semester)
    {
        $semesterList .= '<option value="'.$semester->code.'">'.$semester->name.'</option>';

    }

    if (session()->has('faculty_member'))
    {
        $id         = session()->get('faculty_member.id');
        $user_id    = session()->get('faculty_member.user_id');
    }
    else
    {
        return redirect('/login');
    }
@endphp

<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div id="search_notification_content" class="text-center no-display"></div>
            <br>

            <div class="col-md-12 col-sm-12 col-xs-12 mb-3" id="search_content">

                <div class="card">
                    <form id="search_form" method="post" enctype="multipart/form-data">

                        <input type="hidden" id="user_id" name="user_id" value="{{ $user_id }}">
                        <div class="col-md-5 pull-left">
                            <div id="sem_code_group" class="form-group">
                                <label class="control-label">
                                    Semester<strong class="text-danger">*</strong>
                                </label>
                                <select id="sem_code" name="sem_code" class="form-control"  required>
                                    <option value="">Select Semester</option>
                                    <?php echo $semesterList; ?>
                                </select>
                                <small id="sem_code_error" class="  error-feedback"></small>
                            </div>
                        </div>
                        <div class="col-md-5 pull-left">
                            <div id="course_details_group" class="form-group">
                                <label class="control-label">
                                    Course's<strong class="text-danger">*</strong>
                                </label>
                                <select id="course_details" name="course_details" class="form-control" required>
                                    <option value="">Select Course</option>
                                </select>
                                <small id="course_details_error" class="  error-feedback"></small>
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

        $('#sem_code').change(function(){

            var sem_code = $('#sem_code').val();
            var user_id = $('#user_id').val();

            if (user_id !== '' && sem_code !== '')
            {
                $.ajax({
                    type: 'POST',
                    url: '/studresult/dynamic',
                    data: {sem_code: sem_code, user_id: user_id},

                    success: function (response) {
                        // console.log(response);
                        if(!response.message)
                        {
                            $('#course_details').empty().append(`<option value="">Select Course</option>`);

                            var regDetails = response.regDetails;
                            // console.log(regDetails);

                            $.each(regDetails, function(key, item){
                                // console.log(key);
                                // console.log(item);

                                var selectOption = `<option value="${item.sem_code}-${item.dept_code}-${item.course_code}-${item.section}">${item.department} - ${item.course_code} (${item.course_title}) - ${item.section}</option>`;
                                // console.log(selectOption);
                                $('#course_details').append(selectOption);
                            });
                        }
                    },

                    error: function (jqXHR, exception)
                    {
                        @include('crud.ajax_error')
                    },
                });
            }

        });

        //############################# BEGIN VALIDATION ###########################//
        $('#search_form').bootstrapValidator({
            fields:
            {
                sem_code:
                {
                    message: 'The semester is not valid',
                    validators: {
                        notEmpty: {
                            message: 'The semester is required and cannot be empty'
                        },
                        stringLength: {
                            max: 3,
                        },
                        digits: {},
                    }
                },

                course_details:
                {
                    message: 'The course details is not valid',
                    validators: {
                        notEmpty: {
                            message: 'The course details is required and cannot be empty'
                        },
                        stringLength: {
                            max: 17,
                        },
                        regexp: {
                            regexp: /^[a-zA-Z0-9-/]+$/,
                        },
                    }
                },

            },
        }).on('success.form.bv', function (e){
            e.preventDefault();

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
                url: '/studresult/search',
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
