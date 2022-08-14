<?php
    if (isset($user)) {
        $viewData = $user->user_id;
    }
    elseif (isset($viewData)) {
        $viewData = $viewData;
    }
    elseif (isset($user_id)) {
        $viewData = $user_id;
    }
    else
    {
       $viewData = '';
    }
?>
<script>

    $.toast({
        text: '{{ $msg }}', // Text that is to be shown in the toast
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
    
    if ('{{ $name }}' === 'deptcourse' || '{{ $name }}' === 'coursereg') {
        $('#course_code')[0].selectize.clear();
        $('#course_code')[0].selectize.clearOptions();
    }
    if ('{{ $name }}' === 'userreg') {
        $('#faculty_code')[0].selectize.clear();
        $('#dept_code')[0].selectize.clear();
        $('#dept_code')[0].selectize.clearOptions();
    }
    this.db_id=null;
    $('#{{ $name }}_id').val('null');
    $('#{{ $name }}_action').val('null');
    $('#{{ $name }}_pic_dir').val('');
    $('#{{ $name }}_form').data('bootstrapValidator').resetForm(true);
    $('#{{ $name }}_form').trigger('reset');

    $('#{{ $name }}_createEdit_content').slideUp(400);
    $('#{{ $name }}_view_content').slideDown(400);
    $('#{{ $name }}_create_btn').show();
    $('#{{ $name }}_edit_btn').show();
    $('#{{ $name }}_title').show();
    $('#{{ $name }}_edit_title').hide();
    $('#{{ $name }}_create_title').hide();
    $('#{{ $name }}_cancel_btn').hide();
    
    $.ajax({
        type:'POST',
        url:'/<?php echo $name?>/view',
        data:{user_id: '{{ $viewData }}'},
        success:function(response) {
            $("#{{ $name }}_view_content").html(response);
            //console.log(response);
        },
        
        error: function (jqXHR, exception) 
        {
            var msg = '';
            if (jqXHR.status === 0) 
            {
                msg = 'Not connect. Verify Network.';
            } 
            else if (jqXHR.status == 404) 
            {
                msg = 'Requested page not found. [404]';
            } 
            else if (jqXHR.status == 500) 
            {
                msg = 'Internal Server Error [500].';
            } 
            else if (exception === 'parsererror') 
            {
                msg = 'Requested JSON parse failed.';
            } 
            else if (exception === 'timeout') 
            {
                msg = 'Time out error.';
            } 
            else if (exception === 'abort') 
            {
                msg = 'Ajax request aborted.';
            } 
            else 
            {
                console.log('Uncaught Error: \n' + jqXHR.responseText);
            }

            $('#{{ $name }}_notification_content').show().fadeOut(6100).html(msg);
        },
    });
</script>

            