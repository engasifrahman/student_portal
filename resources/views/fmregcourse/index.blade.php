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
                    url: '/fmregcourse/dynamic', 
                    data: {sem_code: sem_code, user_id: user_id}, 

                    success: function (response) {
                        console.log(response);

                        if(!response.message)
                        {
                            $("#search_result_content").html(response);
                        }
                    },

                    error: function (jqXHR, exception) 
                    {
                        @include('crud.ajax_error')
                    },
                });
            }

        });
</script>
@endsection