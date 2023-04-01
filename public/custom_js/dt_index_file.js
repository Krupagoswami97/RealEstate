var recordIds = [];

/* Note : Checkbox icon in DataTable */
function checkBoxIcon(id,i) {
    var IconHTML = '<div class="form-check form-check-inline"><input class="form-check-input childCheckbox" type="checkbox" value="'+id+'" id="childCheckbox'+id+'" /><label class="form-check-label" for="childCheckbox'+id+'">'+i+'</label></div></div>';
    return IconHTML;
}

/* Note : Recycle Or Restore Action icon in DataTable */
function recycleIcon(id,deleted_at) {
    var IconHTML = "";
    if(deleted_at != null && deleted_at != '')
    {
        var IconHTML = '<div class="m-50 d-inline">'+feather.icons['refresh-ccw'].toSvg({ class: 'font-medium-3 text-primary restore_single',val:id })+'</div>';
    }
    else
    {
        var IconHTML = '<div class="m-50 d-inline">'+feather.icons['alert-circle'].toSvg({ class: 'font-medium-3 text-primary recycle_single',val:id })+'</div>';
    }
    return IconHTML;
}

/* Note : Edit Delete Action icon in DataTable */
function actionIcon(id,deleted_at,arr = '') {
    var IconHTML = "";
    if(deleted_at != null && deleted_at != '')
    {
        if(arr.length > 0){
            if($.inArray(id,arr) == -1){
                var DeleteIconHTML = '<div class="m-50 d-inline">'+feather.icons['trash'].toSvg({ class: 'font-medium-3 text-danger delete_single',val:id })+'</div>';
            }else{
                var DeleteIconHTML = "";
            }
        }else{
            var DeleteIconHTML =  '<div class="m-50 d-inline">'+feather.icons['trash'].toSvg({ class: 'font-medium-3 text-danger delete_single',val:id })+'</div>';
        }
        IconHTML += DeleteIconHTML;

    }
    else{
        var EditIconHTML = '<div class="m-50 d-inline">'+feather.icons['edit'].toSvg({ class: 'font-medium-3 text-success edit',val:id })+'</div>';
        if(arr.length > 0)
        {
            if($.inArray(id,arr) == -1){
                var DeleteIconHTML = '<div class="m-50 d-inline">'+feather.icons['trash'].toSvg({ class: 'font-medium-3 text-danger delete_single',val:id })+'</div>';
            }else{
                var DeleteIconHTML = "";
            }
        }
        else{
            var DeleteIconHTML =  '<div class="m-50 d-inline">'+feather.icons['trash'].toSvg({ class: 'font-medium-3 text-danger delete_single',val:id })+'</div>';
        }
        IconHTML += EditIconHTML;
        feather.replace();
        IconHTML += DeleteIconHTML;
        feather.replace();
    }
    return IconHTML;
}

/* Note : Define status that data is soft deleted or safe */
var customRecycle = function (val) {
    var color = "";
    if (val != null && val != "" ) {
        color = "danger";
        return "<div class='badge badge-pill badge-light-" + color + "' >Soft Deleted</div>";
    } else{
        color = "success"
        return "<div class='badge badge-pill badge-light-" + color + "' >Safe</div>";
    }
}

/* Note : Main Check box Check when all child checkbox checked in DataTable */
$(document).on("change",".childCheckbox",function(){
    if(this.checked)
    {
        recordIds.push($(this).val());
        var LengthCheck = $('.childCheckbox');
        var LengthChecked = $('.childCheckbox:checked');

        //if all siblings are checked, check its parent checkbox
        if (LengthCheck.length == LengthChecked.length) {
            $('input:checkbox').not(this).prop('checked', this.checked);
        }else{
            $('.parentCheckbox').prop('checked', false);
        }
    }
    else
    {
        var removeItem = $(this).val();
        recordIds = jQuery.grep(recordIds, function(value) {
            return value != removeItem;
        });
        $('.parentCheckbox').prop('checked', false);
    }
});

/* Note : If Single id pass from DataTable than call single record delete function */
$(document).on("click", '.delete_single', function () {
    delete_record_single($(this).attr('val'));
});
/* Note : Restore single record */
$(document).on("click", '.restore_single', function () {
    restore_record_single($(this).attr('val'));
});
/* Note : Recycle single record */
$(document).on("click", '.recycle_single', function () {
    recycle_record_single($(this).attr('val'));
});

/* Note : If multiple id pass from DataTable than call record delete function */
$(document).on("click", '.delete', function (value) {
    if(recordIds.length > 0)
    {
        delete_record(recordIds);
    }
    else
    {
        error_msg('Please Select Rows to Delete!');
    }
});

function delete_record_single(id)
{
    recordIds = [];
    recordIds.push(id);
    delete_record(recordIds);
}

function recycle_record_single(id)
{
    recordIds = [];
    recordIds.push(id);
    recycle_record(recordIds);
}

function restore_record_single(id)
{
    recordIds = [];
    recordIds.push(id);
    restore_record(recordIds);
}

/* Note : Edit Record */
$(document).on("click", '.edit', function () {
    var url = EditUrl;
    var new_url = url.replace(':id', $(this).attr('val'));
    window.location.href = new_url;
});

function RecordArrayEmpty(){
    recordIds = [];
    $('.parentCheckbox').prop("checked", false).change();
}

/* Note : Ajax call for Delete Record */
function delete_record(recordIds)
{
    var themeClass = "";
    if(localStorage.getItem('light-layout-current-skin') == 'light-layout'){
        themeClass = "";
        themeTextColor = "";
    }else{
        themeClass = "dark-box";
        themeTextColor = "text-white";
    }

    Swal.fire({
        title: "Are you sure you want to remove "+recordIds.length+" Row(s) ?",
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!',
        customClass: {
            popup: themeClass,
            htmlContainer : themeTextColor,
            confirmButton: 'btn btn-primary',
            cancelButton: 'btn btn-outline-danger ms-1'
        },
        buttonsStyling: false,
        willClose: () => {
            RecordArrayEmpty;
        }
    }).then(function (result) {
        if (result.value) {
            $.ajax({
                url: DeleteUrl,
                method: 'post',
                headers: {
                },
                data: {
                    'id':recordIds,
                    '_token':"{{ csrf_token() }}",
                },
                success:function(response)
                {
                    console.log(response);
                    if(response.success == true)
                    {
                        success_msg(response.message);
                        get_data();
                    }
                    else
                    {
                        error_msg(response.message);
                    }
                },
                error: function(jqXHR, textStatus, errorThrown){
                    if(jqXHR.status == 401)
                    {
                        $('#Logout').click();;
                    }
                    else
                    {
                        api_error_display(jqXHR);
                    }
                }
            });
        } else if (result.dismiss === Swal.DismissReason.cancel) {
            cancel_delete();
        }
    })
}

function restore_record(recordIds)
{
    var themeClass = "";
    if(localStorage.getItem('light-layout-current-skin') == 'light-layout'){
        themeClass = "";
        themeTextColor = "";
    }else{
        themeClass = "dark-box";
        themeTextColor = "text-white";
    }

    Swal.fire({
        title: "Are you sure you want to restore "+recordIds.length+" record(s) ?",
        //text: "You won't be able to revert this!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#00C851',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, restore it!',
        confirmButtonClass: 'btn btn-success',
        customClass: {
            popup: themeClass,
            htmlContainer : themeTextColor,
            confirmButton: 'btn btn-primary',
            cancelButton: 'btn btn-outline-danger ms-1'
        },
        buttonsStyling: false,
        onClose: RecordArrayEmpty,
    }).then(function (result) {
        if (result.value) {
            $.ajax({
                url: RestoreUrl,
                method: 'post',
                headers: {
                },
                data: {
                    'id':recordIds,
                    '_token':"{{ csrf_token() }}",
                },
                success:function(response)
                {
                    console.log(response);
                    if(response.success == true)
                    {
                        success_msg(response.message);
                        get_data();
                    }
                    else
                    {
                        error_msg(response.message);
                    }
                },
                error: function(jqXHR, textStatus, errorThrown){
                    if(jqXHR.status == 401)
                    {
                        $('#Logout').click();;
                    }
                    else
                    {
                        api_error_display(jqXHR);
                    }
                }
            });
        }
    })
}

function recycle_record(recordIds)
{
    var themeClass = "";
    if(localStorage.getItem('light-layout-current-skin') == 'light-layout'){
        themeClass = "";
        themeTextColor = "";
    }else{
        themeClass = "dark-box";
        themeTextColor = "text-white";
    }

    Swal.fire({
        title: "Are you sure you want to move "+recordIds.length+" record(s) into recycle ?",
        //text: "You won't be able to revert this!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#00C851',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes',
        confirmButtonClass: 'btn btn-success',
        customClass: {
            popup: themeClass,
            htmlContainer : themeTextColor,
            confirmButton: 'btn btn-primary',
            cancelButton: 'btn btn-outline-danger ms-1'
        },
        buttonsStyling: false,
        onClose: RecordArrayEmpty,
    }).then(function (result) {
        if (result.value) {
            $.ajax({
                url: RecycleUrl,
                method: 'post',
                headers: {
                },
                data: {
                    'id':recordIds,
                    '_token':"{{ csrf_token() }}",
                },
                success:function(response)
                {
                    console.log(response);
                    if(response.success == true)
                    {
                        success_msg(response.message);
                        get_data();
                    }
                    else
                    {
                        error_msg(response.message);
                    }
                },
                error: function(jqXHR, textStatus, errorThrown){
                    if(jqXHR.status == 401)
                    {
                        $('#Logout').click();;
                    }
                    else
                    {
                        api_error_display(jqXHR);
                    }
                }
            });
        }
    })
}
