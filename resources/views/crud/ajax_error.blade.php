var msg = '';
var validation = null;

if (jqXHR.status === 0)
{
    msg = 'Not connect. Verify Network.';
}
else if (jqXHR.status == 404)
{
    msg = 'Requested page not found. [404]';
}
else if (jqXHR.status == 422)
{
    validation = jqXHR.responseText;
    validation = JSON.parse(validation);
    console.log(validation);
    msg = validation.message;
}
else if (jqXHR.status == 500)
{
    msg = 'Internal Server Error [500].';
}
else if (jqXHR.status == 420)
{
    error = jqXHR.responseText;
    error = JSON.parse(error);
    console.log(error);
    msg = error.message;
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
    console.log('Uncaught Error.\n' + jqXHR.responseText);
}

$.toast({
    text: msg,
    heading: 'Error', // // As your wish
    icon: 'error', // success, info, warning, error
    showHideTransition: 'slide', // fade, slide or plain
    allowToastClose: true,
    hideAfter: 4000,
    stack: 5,
    position: 'top-right',
    textAlign: 'left',  // left, right or center
    loader: true,
    loaderBg: '#929191',
});

if (validation)
{
    if (validation.errors.code)
    {
        $('#code_error').html(validation.errors.code);
        $('#code_group').removeClass('has-success');
        $('#code_group').addClass('has-error');
    }
    if(validation.errors.title)
    {
        $('#title_error').html(validation.errors.title);
        $('#title_group').removeClass('has-success');
        $('#title_group').addClass('has-error');
    }
    if(validation.errors.credit)
    {
        $('#credit_error').html(validation.errors.credit);
        $('#credit_group').removeClass('has-success');
        $('#credit_group').addClass('has-error');
    }
    if(validation.errors.cost)
    {
        $('#cost_error').html(validation.errors.cost);
        $('#cost_group').removeClass('has-success');
        $('#cost_group').addClass('has-error');
    }
    if(validation.errors.description)
    {
        $('#description_error').html(validation.errors.description);
        $('#description_group').removeClass('has-success');
        $('#description_group').addClass('has-error');
    }
    if (validation.errors.type)
    {
        $('#type_error').html(validation.errors.type);
        $('#type_group').removeClass('has-success');
        $('#type_group').addClass('has-error');
    }
    if (validation.errors.user_id)
    {
        $('#user_id_error').html(validation.errors.user_id);
        $('#user_id_group').removeClass('has-success');
        $('#user_id_group').addClass('has-error');
    }
    if (validation.errors.course_code)
    {
        $('#course_code_error').html(validation.errors.course_code);
        $('#course_code_group').removeClass('has-success');
        $('#course_code_group').addClass('has-error');
    }
    if (validation.errors.course_codes)
    {
        $('#course_code_error').html(validation.errors.course_codes);
        $('#course_code_group').removeClass('has-success');
        $('#course_code_group').addClass('has-error');
    }
    if (validation.errors.sem_code)
    {
        $('#sem_code_error').html(validation.errors.sem_code);
        $('#sem_code_group').removeClass('has-success');
        $('#sem_code_group').addClass('has-error');
    }
    if (validation.errors.faculty_code)
    {
        $('#faculty_code_error').html(validation.errors.faculty_code);
        $('#faculty_code_group').removeClass('has-success');
        $('#faculty_code_group').addClass('has-error');
    }
    if (validation.errors.faculty_codes)
    {
        $('#faculty_code_error').html(validation.errors.faculty_codes);
        $('#faculty_code_group').removeClass('has-success');
        $('#faculty_code_group').addClass('has-error');
    }
    if (validation.errors.dept_code)
    {
        $('#dept_code_error').html(validation.errors.dept_code);
        $('#dept_code_group').removeClass('has-success');
        $('#dept_code_group').addClass('has-error');
    }
    if (validation.errors.picture)
    {
        $('#picture_error').html(validation.errors.picture);
        $('#picture_group').removeClass('has-success');
        $('#picture_group').addClass('has-error');
    }
    if (validation.errors.name)
    {
        $('#name_error').html(validation.errors.name);
        $('#name_group').removeClass('has-success');
        $('#name_group').addClass('has-error');
    }
    if (validation.errors.designation)
    {
        $('#designation_error').html(validation.errors.designation);
        $('#designation_group').removeClass('has-success');
        $('#designation_group').addClass('has-error');
    }
    if (validation.errors.abbreviation)
    {
        $('#abbreviation_error').html(validation.errors.abbreviation);
        $('#abbreviation_group').removeClass('has-success');
        $('#abbreviation_group').addClass('has-error');
    }
    if (validation.errors.dob)
    {
        $('#dob_error').html(validation.errors.dob);
        $('#dob_group').removeClass('has-success');
        $('#dob_group').addClass('has-error');
    }
    if (validation.errors.gender)
    {
        $('#gender_error').html(validation.errors.gender);
        $('#gender_group').removeClass('has-success');
        $('#gender_group').addClass('has-error');
    }
    if (validation.errors.marital_status)
    {
        $('#marital_status_error').html(validation.errors.marital_status);
        $('#marital_status_group').removeClass('has-success');
        $('#marital_status_group').addClass('has-error');
    }
    if (validation.errors.nationality)
    {
        $('#nationality_error').html(validation.errors.nationality);
        $('#nationality_group').removeClass('has-success');
        $('#nationality_group').addClass('has-error');
    }
    if (validation.errors.nid)
    {
        $('#nid_error').html(validation.errors.nid);
        $('#nid_group').removeClass('has-success');
        $('#nid_group').addClass('has-error');
    }
    if (validation.errors.birth_certificate)
    {
        $('#birth_certificate_error').html(validation.errors.birth_certificate);
        $('#birth_certificate_group').removeClass('has-success');
        $('#birth_certificate_group').addClass('has-error');
    }
    if (validation.errors.father_name)
    {
        $('#father_name_error').html(validation.errors.father_name);
        $('#father_name_group').removeClass('has-success');
        $('#father_name_group').addClass('has-error');
    }
    if (validation.errors.mother_name)
    {
        $('#mother_name_error').html(validation.errors.mother_name);
        $('#mother_name_group').removeClass('has-success');
        $('#mother_name_group').addClass('has-error');
    }
    if (validation.errors.email)
    {
        $('#email_error').html(validation.errors.email);
        $('#email_group').removeClass('has-success');
        $('#email_group').addClass('has-error');
    }
    if (validation.errors.altr_email)
    {
        $('#altr_email_error').html(validation.errors.altr_email);
        $('#altr_email_group').removeClass('has-success');
        $('#altr_email_group').addClass('has-error');
    }
    if (validation.errors.phone)
    {
        $('#phone_error').html(validation.errors.phone);
        $('#phone_group').removeClass('has-success');
        $('#phone_group').addClass('has-error');
    }
    if (validation.errors.altr_phone)
    {
        $('#altr_phone_error').html(validation.errors.altr_phone);
        $('#altr_phone_group').removeClass('has-success');
        $('#altr_phone_group').addClass('has-error');
    }
    if (validation.errors.present_addr)
    {
        $('#present_addr_error').html(validation.errors.present_addr);
        $('#present_addr_group').removeClass('has-success');
        $('#present_addr_group').addClass('has-error');
    }
    if (validation.errors.permanent_addr)
    {
        $('#permanent_addr_error').html(validation.errors.permanent_addr);
        $('#permanent_addr_group').removeClass('has-success');
        $('#permanent_addr_group').addClass('has-error');
    }
    if (validation.errors.old_password)
    {
        $('#old_password_error').html(validation.errors.old_password);
        $('#old_password_group').removeClass('has-success');
        $('#old_password_group').addClass('has-error');
    }
    if (validation.errors.new_password)
    {
        $('#new_password_error').html(validation.errors.new_password);
        $('#new_password_group').removeClass('has-success');
        $('#new_password_group').addClass('has-error');
    }
    if (validation.errors.confirm_password)
    {
        $('#confirm_password_error').html(validation.errors.confirm_password);
        $('#confirm_password_group').removeClass('has-success');
        $('#confirm_password_group').addClass('has-error');
    }
    if (validation.errors.add_payment)
    {
        $('#add_payment_error').html(validation.errors.add_payment);
        $('#add_payment_group').removeClass('has-success');
        $('#add_payment_group').addClass('has-error');
    }
    if (validation.errors.deduct_payment)
    {
        $('#deduct_payment_error').html(validation.errors.deduct_payment);
        $('#deduct_payment_group').removeClass('has-success');
        $('#deduct_payment_group').addClass('has-error');
    }
    if (validation.errors.attendance)
    {
        $('#attendance_error').html(validation.errors.attendance);
        $('#attendance_group').removeClass('has-success');
        $('#attendance_group').addClass('has-error');
    }
    if (validation.errors.ct_1)
    {
        $('#ct_1_error').html(validation.errors.ct_1);
        $('#ct_1_group').removeClass('has-success');
        $('#ct_1_group').addClass('has-error');
    }
    if (validation.errors.ct_2)
    {
        $('#ct_2_error').html(validation.errors.ct_2);
        $('#ct_2_group').removeClass('has-success');
        $('#ct_2_group').addClass('has-error');
    }
    if (validation.errors.ct_3)
    {
        $('#ct_3_error').html(validation.errors.ct_3);
        $('#ct_3_group').removeClass('has-success');
        $('#ct_3_group').addClass('has-error');
    }
    if (validation.errors.presentation)
    {
        $('#presentation_error').html(validation.errors.presentation);
        $('#presentation_group').removeClass('has-success');
        $('#presentation_group').addClass('has-error');
    }
    if (validation.errors.assignment)
    {
        $('#assignment_error').html(validation.errors.assignment);
        $('#assignment_group').removeClass('has-success');
        $('#assignment_group').addClass('has-error');
    }
    if (validation.errors.midterm)
    {
        $('#midterm_error').html(validation.errors.midterm);
        $('#midterm_group').removeClass('has-success');
        $('#midterm_group').addClass('has-error');
    }
    if (validation.errors.final)
    {
        $('#final_error').html(validation.errors.final);
        $('#final_group').removeClass('has-success');
        $('#final_group').addClass('has-error');
    }


}

this.id=null;
//reset deleteID
