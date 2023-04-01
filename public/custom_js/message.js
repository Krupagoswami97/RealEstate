function success_msg(message)
{
    //toastr.success(message);
    toastr.success("",message,{
        closeButton: true,
        tapToDismiss: false,
        progressBar: true,
    });
}

function error_msg(message)
{
    toastr.error("",message,{
        closeButton: true,
        tapToDismiss: false,
        progressBar: true,
    });
}

function error_403_message()
{
    toastr.error("","You have no rights to perform this action",{
        closeButton: true,
        tapToDismiss: false,
        progressBar: true,
    });
}

function common_error()
{
    toastr.error("","Something went wrong",{
        closeButton: true,
        tapToDismiss: false,
        progressBar: true,
    });
}

function cancel_delete()
{
    toastr.success("",'Your Records is Safe',{
        closeButton: true,
        tapToDismiss: false,
        progressBar: true,
    });
}

function api_error_display(jqXHR)
{
    if(jqXHR.status == 401)
    {
        error_msg(jqXHR.responseJSON.message);
        return;
    }
    if(jqXHR.status == 402)
    {
        error_msg(jqXHR.responseJSON.message);
        return;
    }
    if(jqXHR.status == 403)
    {
        error_msg(jqXHR.responseJSON.message);
        return;
    }if(jqXHR.status == 429)
    {
        error_msg(jqXHR.responseJSON.message);
        return;
    }
    if(jqXHR.status == 500)
    {
        console.log(jqXHR);
        if(jqXHR.responseJSON.message.indexOf("1451 Cannot delete or update a parent row") != -1){
            error_msg("It Cannot Be Deleted,B'coz Child Records Exists");
        }else{
            error_msg("Something Went Wrong");
            //jqXHR.responseJSON.message
        }
        return;
    }
    if(jqXHR.status == 419)
    {

        error_msg("Token Mismatched");
        setTimeout(function () {
            location.reload(true);
        }, 200);

        return;
    }
    if(jqXHR.status == 404)
    {

        error_msg("404 - Not Found");
        return;
    }

    if(Object.keys(jqXHR.responseJSON.error).length > 0)
    {
        $(".is-invalid").removeClass("is-invalid");
        $(".error").html("");
        $.each(jqXHR.responseJSON.error, function (key, val) {
            $("." + key).addClass('is-invalid');
            $("." + key + "_error").html(val[0]);
        });
    }
    toastr.error("",jqXHR.responseJSON.message,{
        closeButton: true,
        tapToDismiss: false,
        progressBar: true,
    });

}

function ajax_error_event(jqXHR) {
    if(jqXHR.status == 401 || jqXHR.status == 402 )
    {
         $('#Logout').click();
    }
    else
    {
        console.log(jqXHR);
        api_error_display(jqXHR);
    }
}

function nullCheck(txt){
    if (txt && txt != 'null') {
        return txt;
    }else{
        return "";
    }
}
