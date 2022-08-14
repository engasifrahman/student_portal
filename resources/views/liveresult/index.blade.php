@extends('layout.app')

@section('main_content')

@php
    $semesterList = '';
    foreach($semesters as $semester)
    {
        $semesterList .= '<option value="'.$semester->code.'">'.$semester->name.'</option>';

    }

    if (session()->has('student'))
    {
        $id         = session()->get('student.id');
        $user_id    = session()->get('student.user_id');
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
                        <div class="col-md-12 pull-left">
                            <div id="sem_code_group" class="form-group">
                                <label class="control-label">
                                    Semester
                                </label>
                                <select id="sem_code" name="sem_code" class="form-control"  required>
                                    <option value="">Select Semester</option>
                                    <?php echo $semesterList; ?>
                                </select>
                                <small id="sem_code_error" class="  error-feedback"></small>
                            </div>
                        </div>

                    </form>
                </div>

            </div>
            <div class="col-md-12 col-sm-12 col-xs-12" id="search_view_content"></div>
            <div class="col-md-12 col-sm-12 col-xs-12 mt-3" id="search_result_content" style="display: none">
                <div class="card">
                    <div class="card-header bg-primary text-center">
                        <span class="h6 text-white">Live Result</span>
                    </div>
                    <div class="card-body">
                        <div class="col-md-12 p-3">
                            <div class="col-xs-6 col-sm-6 col-md-6 pull-left text-right pr-0">
                                <strong class="text-info">Quiz 1 <span class="px-1"></span> :</strong>
                            </div>
                            <div class="col-xs-6 col-sm-6 col-md-6 pull-right text-justify pl-0">
                                 <span class="px-1"></span><span id="ct_1"></span>
                            </div>
                            <div class="clearfix"></div>

                            <div class="col-xs-6 col-sm-6 col-md-6 pull-left text-right pr-0">
                                <strong class="text-info">Quiz 2 <span class="px-1"></span> :</strong>
                            </div>
                            <div class="col-xs-6 col-sm-6 col-md-6 pull-right text-justify pl-0">
                                <span class="px-1"></span><span id="ct_2"></span>
                            </div>
                            <div class="clearfix"></div>

                            <div class="col-xs-6 col-sm-6 col-md-6 pull-left text-right pr-0">
                                <strong class="text-info">Quiz 4 <span class="px-1"></span> :</strong>
                            </div>
                            <div class="col-xs-6 col-sm-6 col-md-6 pull-right text-justify pl-0">
                                <span class="px-1"></span><span id="ct_3"></span>
                            </div>
                            <div class="clearfix"></div>

                            <div class="col-xs-6 col-sm-6 col-md-6 pull-left text-right pr-0">
                                <strong class="text-info">Quiz Average <span class="px-1"></span> :</strong>
                            </div>
                            <div class="col-xs-6 col-sm-6 col-md-6 pull-right text-justify pl-0">
                                <span class="px-1"></span><span id="avg_ct"></span>
                            </div>
                            <div class="clearfix"></div>

                            <div class="col-xs-6 col-sm-6 col-md-6 pull-left text-right pr-0">
                                <strong class="text-info">Midterm <span class="px-1"></span> :</strong>
                            </div>
                            <div class="col-xs-6 col-sm-6 col-md-6 pull-right text-justify pl-0">
                                <span class="px-1"></span><span id="midterm"></span>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
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

        $('#sem_code').change(function(){

            var sem_code = $('#sem_code').val();
            var user_id = $('#user_id').val();

            if (user_id !== '' && sem_code !== '')
            {
                $.ajax({
                    type: 'POST',
                    url: '/liveresult/dynamic',
                    data: {sem_code: sem_code, user_id: user_id},

                    success: function (response) {
                        console.log(response);

                        if(!response.message)
                        {
                            $("#search_view_content").slideDown(500).html(response);
                        }
                    },

                    error: function (jqXHR, exception)
                    {
                        @include('crud.ajax_error')
                    },
                });
            }

        });

        function live_result($course_details){
            var course_details = $course_details;
            $.ajax({
                type: 'POST',
                url: '/liveresult/result',
                data: {course_details: course_details},

                success: function (response) {
                    console.log(response);
                    console.log(response.data.ct_1);

                    $('#ct_1').html(parseFloat(response.data.ct_1).toFixed(2));
                    $('#ct_2').html(parseFloat(response.data.ct_2).toFixed(2));
                    $('#ct_3').html(parseFloat(response.data.ct_3).toFixed(2));
                    $('#avg_ct').html(parseFloat(response.data.avg_ct).toFixed(2));
                    $('#midterm').html(parseFloat(response.data.midterm).toFixed(2));
                    $("#search_result_content").slideDown(500);
                },

                error: function (jqXHR, exception)
                {
                    @include('crud.ajax_error')
                },
            });
        }

</script>
@endsection
