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
    //###################### BEGIN AJAX CRUD OPARATION ######################//
    //console.log('{{ $viewData }}');

    $('#{{ strtolower($Name) }}_create_title').hide();
    $('#{{ strtolower($Name) }}_edit_title').hide();
    $('#{{ strtolower($Name) }}_cancel_btn').hide();
    $('#{{ strtolower($Name) }}_createEdit_content').hide();
    $('#{{ strtolower($Name) }}_notification_content').hide();

    <?php echo $newEvent; ?>

    $('#{{ strtolower($Name) }}_changePic').on('change',function() {
        if ($('#{{ strtolower($Name) }}_changePic').is(':checked'))
        {
            $('#{{ strtolower($Name) }}_picture').prop('disabled', false);
            var drEvent = $('#{{ strtolower($Name) }}_picture').dropify();
            drEvent = drEvent.data('dropify');
            drEvent.resetPreview();
            drEvent.clearElement();
            drEvent.settings.defaultFile = '';
            drEvent.destroy();
            drEvent.init();
        }
        else
        {
            $('#{{ strtolower($Name) }}_picture').prop('disabled', true);
            var pic_dir = '#{{ strtolower($Name) }}_pic_dir';
            var imagenUrl = '<?php echo asset("'+$(pic_dir).val()+'")?>';
            //console.log(imagenUrl);
            var drEvent = $('#{{ strtolower($Name) }}_picture').dropify();
            drEvent = drEvent.data('dropify');
            drEvent.resetPreview();
            drEvent.clearElement();
            drEvent.settings.defaultFile = imagenUrl;
            drEvent.destroy();
            drEvent.init();
            $('.dropify-infos').css({ display: 'none' });
            $('#{{ strtolower($Name) }}_picture').attr('title', '');
        }
    });

    $('#{{ strtolower($Name) }}_cancel_btn').click(function(){

        if ('{{ $Name }}' === 'DeptCourse' || '{{ $Name }}' === 'CourseReg') {
            $('#course_code')[0].selectize.clear();
            $('#course_code')[0].selectize.clearOptions();
        }
        if ('{{ $Name }}' === 'UserReg') {
            $('#faculty_code')[0].selectize.clear();
            $('#dept_code')[0].selectize.clear();
            $('#dept_code')[0].selectize.clearOptions();
        }

        $('#dept_code').empty().append('<option value="">Select Department Name</option>');

        $('#{{ strtolower($Name) }}_createEdit_content').slideUp(400);
        $('#{{ strtolower($Name) }}_view_content').slideDown(400);
        $('#{{ strtolower($Name) }}_create_btn').show();
        $('#{{ strtolower($Name) }}_edit_btn').show();
        $('#{{ strtolower($Name) }}_title').show();
        $('#{{ strtolower($Name) }}_edit_title').hide();
        $('#{{ strtolower($Name) }}_create_title').hide();
        $('#{{ strtolower($Name) }}_cancel_btn').hide();
        {{ $Name }}ClearValidation();
        {{ $Name }}ClearForm();
    });

    $('#{{ strtolower($Name) }}_reset_btn').click(function(){

        //$('.dropify-clear').click();
        //('.dropify-preview').css({ display: 'none' });

        var op = null;
        op = $('input[name={{ strtolower($Name) }}_action]').val();

        if (op === 'update' && '{{ strtolower($havePic) }}' === 'yes') {
            $('#{{ strtolower($Name) }}_picture').prop('disabled', true);
            var docID = '#{{ strtolower($Name) }}_pic_dir';
            var imagenUrl = '<?php echo asset("'+$(docID).val()+'") ?>';
            var drEvent = $('#{{ strtolower($Name) }}_picture').dropify();
            drEvent = drEvent.data('dropify');
            drEvent.resetPreview();
            drEvent.clearElement();
            drEvent.settings.defaultFile = imagenUrl;
            drEvent.destroy();
            drEvent.init();
            $('.dropify-infos').css({ display: 'none' });
            $('#{{ strtolower($Name) }}_picture').attr('title', '');
        }

        if ('{{ $Name }}' === 'DeptCourse' || '{{ $Name }}' === 'CourseReg') {
            $('#course_code')[0].selectize.clear();
            $('#course_code')[0].selectize.clearOptions();
        }
        if ('{{ $Name }}' === 'UserReg') {
            $('#faculty_code')[0].selectize.clear();
            $('#dept_code')[0].selectize.clear();
            $('#dept_code')[0].selectize.clearOptions();
        }

        $('#dept_code').empty().append('<option value="">Select Department Name</option>');

        {{ $Name }}ClearValidation();
        $('#{{ strtolower($Name) }}_form').data('bootstrapValidator').resetForm(true);
    });

    var <?php echo strtolower($Name) ?>ID = null;
    function {{ $Name }}ID(id) {
        this.{{ strtolower($Name) }}ID = id; //we use id for update data also but here we need to verify some unique items using bootstrapValidator remote where we cant use this id, Therefore we used hidden input field for id to verify unique items $ update data;
        //console.log(this.<?php echo strtolower($Name) ?>ID);
    }

    function {{ $Name }}ClearValidation(){
        <?php echo $clearLVE; ?> //clearLVE = clear laravel validation error
    }

    function {{ $Name }}ClearForm(){
        this.{{ strtolower($Name) }}ID=null;
        $('#{{ strtolower($Name) }}_id').val('null');
        $('#{{ strtolower($Name) }}_action').val('null');
        $('#{{ strtolower($Name) }}_pic_dir').val('');
        $('#{{ strtolower($Name) }}_form').data('bootstrapValidator').resetForm(true);
        $('#{{ strtolower($Name) }}_form').trigger('reset');
    }

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    //########################### BEGIN VIEW ###########################//
    $.ajax({
        type:'POST',
        url:'/<?php echo strtolower($Name); ?>/view',
        data:{user_id: '{{ $viewData }}'},
        success:function(response) {
            $("#{{ strtolower($Name) }}_view_content").html(response);
            //console.log(response);
        },

        error: function (jqXHR, exception)
        {
			@include('crud.ajax_error')
        },
    });
    //############################## END VIEW ##############################//

    //############################# BEGIN CREATE ############################//
    function Create{{ $Name }}() {

        if ('{{ strtolower($havePic) }}' === 'yes') {
            $('#{{ strtolower($Name) }}_picture').prop('disabled', false);
            var drEvent = $('#{{ strtolower($Name) }}_picture').dropify();
            drEvent = drEvent.data('dropify');
            drEvent.resetPreview();
            drEvent.clearElement();
            drEvent.settings.defaultFile = '';
            drEvent.destroy();
            drEvent.init();
        }

        $('#dept_code').empty().append('<option value="">Select Department Name</option>');

        $('#{{ strtolower($Name) }}_action').val('store');
        $('.{{ strtolower($Name) }}_changePic').hide();
        $('#{{ strtolower($Name) }}_create_btn').hide();
        $('#{{ strtolower($Name) }}_edit_btn').hide();
        $('#{{ strtolower($Name) }}_title').hide();
        $('#{{ strtolower($Name) }}_edit_title').hide();
        $('#{{ strtolower($Name) }}_create_title').show();
        $('#{{ strtolower($Name) }}_cancel_btn').show();
        $('#{{ strtolower($Name) }}_store_btn').show();
        $('#{{ strtolower($Name) }}_update_btn').hide();
        $('#{{ strtolower($Name) }}_view_content').slideUp(400); //this is actually hide
        $('#{{ strtolower($Name) }}_createEdit_content').slideDown(400); //this is actually show
    }
    //############################### END CREATE ##############################//

    //############################### BEGIN EDIT ##############################//
    function Edit{{ $Name }}(id) {

        $.ajax({
            url : '/<?php echo strtolower($Name); ?>/'+id+'/edit',
            type: 'GET',
            data : '',
            success: function(response)
            {
                console.log(response);
                var data = response;

                if ('{{ strtolower($havePic) }}' == 'yes')
                {
                    $('#{{ strtolower($Name) }}_picture').prop('disabled', true);
                    var imagenUrl = '<?php echo asset("'+response.editData.pic_dir+'")?>';
                    var drEvent = $('#{{ strtolower($Name) }}_picture').dropify();
                    drEvent = drEvent.data('dropify');
                    drEvent.resetPreview();
                    drEvent.clearElement();
                    drEvent.settings.defaultFile = imagenUrl;
                    drEvent.destroy();
                    drEvent.init();
                    $('.dropify-infos').css({ display: 'none' });
                    $('#{{ strtolower($Name) }}_picture').attr('title', '');
                }

                <?php echo $editDataReg; ?>

                $('#{{ strtolower($Name) }}_id').val(id);
                $('#{{ strtolower($Name) }}_action').val('update');
                $('.{{ strtolower($Name) }}_changePic').show();
                $('#{{ strtolower($Name) }}_create_btn').hide();
                $('#{{ strtolower($Name) }}_edit_btn').hide();
                $('#{{ strtolower($Name) }}_title').hide();
                $('#{{ strtolower($Name) }}_create_title').hide();
                $('#{{ strtolower($Name) }}_edit_title').show();
                $('#{{ strtolower($Name) }}_cancel_btn').show();
                $('#{{ strtolower($Name) }}_store_btn').hide();
                $('#{{ strtolower($Name) }}_update_btn').show();
                $('#{{ strtolower($Name) }}_view_content').slideUp(400);  //this is actually hide
                $('#{{ strtolower($Name) }}_createEdit_content').slideDown(400); //this is actually show
            },

            error: function (jqXHR, exception)
            {
				@include('crud.ajax_error')
            },
        });
    }
    //############################### END EDIT ##############################//

    //############################# BEGIN DELETE ############################//
    function Delete{{ $Name }}() {
        var id = this.{{ strtolower($Name) }}ID;

        $('.app-content').modal('hide');
        $('body').removeClass('modal-open'); //these 3 lines for fully close the modal
        $('.modal-backdrop').remove();

        $.ajax({
            url : '/<?php echo strtolower($Name); ?>/'+id,
            type: 'DELETE',
            data : { id: id },
            success: function(response)
            {
                $('#{{ strtolower($Name) }}_notification_content').show().fadeOut(3100).html(response);
            },

            error: function (jqXHR, exception)
            {
     			@include('crud.ajax_error')
            },
        });
    }
    //############################### END DELETE ##############################//

    //########################### BEGIN Form Validation #########################//
    $('#{{ strtolower($Name) }}_form').bootstrapValidator({
        fields:
        {
            <?php echo $BVRules; ?>
        }
    })
    //########################## END Form Validation ########################//

    .on('success.form.bv', function (e){
        e.preventDefault();

        var action = null;
        action = $('input[name={{ strtolower($Name) }}_action]').val();

        if (action == 'store')
        {
            //########################## BEGIN STORE #########################//
            var formData = new FormData(document.getElementById('{{ strtolower($Name) }}_form'));
            //console.log($('#{{ strtolower($Name) }}_form').serialize());
            //console.log(formData);
            /*
            for (let [key, value] of formData.entries()) {
                  console.log(key, ':', value);
            }
            */
            $.ajax({
                type: 'POST',
                url: '/<?php echo strtolower($Name); ?>',   // here your php file to do something with postdata
                data: formData, // here you set the data to send to php file
                async: false,
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function() {
                    $('#{{ strtolower($Name) }}_notification_content').show().fadeOut(3100).html(`
                        <div class="text-center">OPERATION IS RUNNING PLEASE WAIT..</div>`);
                },

                success: function (response) {
                    $('#{{ strtolower($Name) }}_notification_content').show().fadeOut(3100).html(response);
                    //console.log(response);
                },

                error: function (jqXHR, exception)
                {
					@include('crud.ajax_error')
                },
            });
        }
        else if(action=='update')
        {
            //######################### BEGIN UPDATE ########################//
            var formData = new FormData(document.getElementById('{{ strtolower($Name) }}_form'));
            $.ajax({
                type: 'POST',
                url: '/<?php echo strtolower($Name); ?>/'+$('#{{ strtolower($Name) }}_id').val(),   // here your php file to do something with postdata
                data: formData, // here you set the data to send to php file
                async: false,
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function() {
                    $('#{{ strtolower($Name) }}_notification_content').show().fadeOut(3100).html(`
                        <div class="text-center">OPERATION IS RUNNING PLEASE WAIT..</div>`);
                },

                success: function (response) {
                    $('#{{ strtolower($Name) }}_notification_content').show().fadeOut(3100).html(response);
                    //console.log(response);
                },

                error: function (jqXHR, exception)
                {
                	@include('crud.ajax_error')
                },
            });
            //######################## END UPDATE #######################//
        }

    });
    //#########################END AJAX CRUD OPARATION ########################//
</script>
