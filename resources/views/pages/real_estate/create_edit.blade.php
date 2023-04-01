@extends('layout.app')
@php
    /*---- Global variable for reuse ---*/
    $pageTitle = "Real Estate";
    $pageIndexUrl = route('real_estate.index');
    $pageCreateUrl = route('real_estate.create');
    $mainDashboard = route('main_dashboard');
    $tableLineFlag = true;

@endphp
@section('title') {{$pageTitle}} @endsection

@section('css')
<style>
    .table tbody td {
        padding: 1px;
        margin: 0px;
        border-style: none;
    }
    .table thead th{
        vertical-align: middle;
    }
    .table thead tr td {
        padding-bottom: 0px;
        padding-left: 0px;
        padding-right: 0px;
    }
</style>
@endsection

@section('breadcrumbs')
<div class="content-header-left col-md-9 col-12 mb-2">
    <div class="row breadcrumbs-top">
        <div class="col-12">
            <h2 class="content-header-title float-start mb-0">{{$pageTitle}}</h2>
            <div class="breadcrumb-wrapper">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{$mainDashboard}}">Home</a>
                    </li>
                    <li class="breadcrumb-item"><a href="{{ $pageIndexUrl }}">{{$pageTitle}}</a>
                    </li>
                    <li class="breadcrumb-item active">{{ (isset($id) && !empty($id)) ? 'Update' : 'New' }}
                    </li>
                </ol>
            </div>
        </div>
    </div>
</div>
@endsection
@section('content')
<section id="multiple-column-form">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header border-bottom">
                    <h4 class="card-title">{{ (isset($id) && !empty($id)) ? 'Update' : 'New' }} {{$pageTitle}}</h4>
                </div>
                <div class="card-body py-2 my-25">
                    <form id="form1" enctype="multipart/form-data" method="post" >
                        @csrf
                        <div class="row">
                            <div class="col-12 col-md-4 mb-2">
                                @php $fieldname = "real_estate_type"; @endphp  {{-- must be lowercase and with underscore --}}
                                {{ Form::label( str_replace("_"," ",$fieldname), null, ['class' => 'required control-label']) }}
                                {{ Form::select($fieldname, ['House' => 'House', 'Department' => 'Department', 'Land' => 'Land', 'Commercial Ground' => 'Commercial Ground'], null, ['id'=>$fieldname,'class' => 'form-control select2 text-capitalize '.$fieldname,'placeholder' => 'Select Real Estate Type']) }}
                                <span class="error invalid-feedback {{$fieldname}}_error"></span>
                            </div>
                            <div class="col-12 col-md-4 mb-2">
                                @php $fieldname = "name";@endphp  {{-- must be lowercase and with underscore --}}
                                {{ Form::label( str_replace("_"," ",$fieldname), null, ['class' => 'required control-label']) }}
                                {{ Form::text($fieldname,null, ['class' => 'form-control '.$fieldname,'placeholder' => 'Please Enter Name','id' => $fieldname]) }}
                                <span class="error invalid-feedback {{$fieldname}}_error"></span>
                            </div>
                            <div class="col-12 col-md-4 mb-2">
                                @php $fieldname = "street";@endphp  {{-- must be lowercase and with underscore --}}
                                {{ Form::label( str_replace("_"," ",$fieldname), null, ['class' => 'required control-label']) }}
                                {{ Form::text($fieldname,null, ['class' => 'form-control '.$fieldname,'placeholder' => 'Please Enter Street','id' => $fieldname]) }}
                                <span class="error invalid-feedback {{$fieldname}}_error"></span>
                            </div>
                            <div class="col-12 col-md-4 mb-2">
                                @php $fieldname = "external_number"; @endphp  {{-- must be lowercase and with underscore --}}
                                {{ Form::label( str_replace("_"," ",$fieldname), null, ['class' => 'required control-label']) }}
                                {{ Form::text($fieldname,null, ['class' => 'form-control '.$fieldname,'placeholder' => 'Please Enter External Number','onkeypress' => 'return ExternalValidate(event);','id' => $fieldname]) }}
                                <span style="color:red;" id="lblExternalErr"></span>
                                <span class="error invalid-feedback {{$fieldname}}_error"></span>
                            </div>
                            <div class="col-12 col-md-4 mb-2">
                                @php $fieldname = "internal_number"; @endphp  {{-- must be lowercase and with underscore --}}
                                {{ Form::label( str_replace("_"," ",$fieldname), null, ['class' => ' control-label']) }}
                                {{ Form::text($fieldname,null, ['class' => 'form-control '.$fieldname,'placeholder' => 'Please Enter Internal Number','onkeypress' => 'return InternalValidate(event);','id' => $fieldname]) }}
                                <span style="color:red;" id="lblInternalErr"></span>
                                <span class="error invalid-feedback {{$fieldname}}_error"></span>
                            </div>
                            <div class="col-12 col-md-4 mb-2">
                                @php $fieldname = "neighborhood"; @endphp  {{-- must be lowercase and with underscore --}}
                                {{ Form::label( str_replace("_"," ",$fieldname), null, ['class' => 'required control-label']) }}
                                {{ Form::text($fieldname,null, ['class' => 'form-control '.$fieldname,'placeholder' => 'Please Enter Neighborhood','id' => $fieldname]) }}
                                <span class="error invalid-feedback {{$fieldname}}_error"></span>
                            </div>
                            <div class="col-12 col-md-4 mb-2">
                                @php $fieldname = "city"; @endphp  {{-- must be lowercase and with underscore --}}
                                {{ Form::label( str_replace("_"," ",$fieldname), null, ['class' => 'required control-label']) }}
                                {{ Form::text($fieldname,null, ['class' => 'form-control '.$fieldname,'placeholder' => 'Please Enter City','id' => $fieldname]) }}
                                <span class="error invalid-feedback {{$fieldname}}_error"></span>
                            </div>
                            <div class="col-12 col-md-4 mb-2">
                                @php $fieldname = "country"; @endphp  {{-- must be lowercase and with underscore --}}
                                {{ Form::label( str_replace("_"," ",$fieldname), null, ['class' => 'required control-label']) }}
                                {{ Form::text($fieldname,null, ['class' => 'form-control '.$fieldname,'placeholder' => 'Please Enter Country','id' => $fieldname]) }}
                                <span style="color:red;" id="lblCountryErr"></span>
                                <span class="error invalid-feedback {{$fieldname}}_error"></span>
                            </div>
                            <div class="col-12 col-md-4 mb-2">
                                @php $fieldname = "rooms"; @endphp  {{-- must be lowercase and with underscore --}}
                                {{ Form::label( str_replace("_"," ",$fieldname), null, ['class' => 'required control-label']) }}
                                {{ Form::number($fieldname,null, ['class' => 'form-control '.$fieldname,'placeholder' => 'Please Enter Rooms','id' => $fieldname]) }}
                                <span class="error invalid-feedback {{$fieldname}}_error"></span>
                            </div>
                            <div class="col-12 col-md-4 mb-2">
                                @php $fieldname = "bathrooms"; @endphp  {{-- must be lowercase and with underscore --}}
                                {{ Form::label( str_replace("_"," ",$fieldname), null, ['class' => 'required control-label']) }}
                                {{ Form::number($fieldname,null, ['class' => 'form-control '.$fieldname,'placeholder' => 'Please Enter Bathrooms','id' => $fieldname]) }}
                                <span class="error invalid-feedback {{$fieldname}}_error"></span>
                            </div>
                            <div class="col-12 col-md-4 mb-2">
                                @php $fieldname = "comments";@endphp  {{-- must be lowercase and with underscore --}}
                                {{ Form::label( str_replace("_"," ",$fieldname), null, ['class' => 'control-label']) }}
                                {{ Form::text($fieldname,null, ['class' => 'form-control '.$fieldname,'placeholder' => 'Please Enter Comments','id' => $fieldname]) }}
                                <span class="error invalid-feedback {{$fieldname}}_error"></span>
                            </div>
                            <div class="col-12 d-flex flex-sm-row flex-column justify-content-end mt-1">
                                <div id="hiddenField">
                                </div>
                                <button type="submit" id="save1"  value="add" class="btn btn-primary glow  mt-1 me-1">Save</button>
                                <button type="submit"  id="saveNclose" class="btn btn-success glow  mt-1 me-1">Save & Close </button>
                                <button type="reset" value="form1" class="reset btn btn-outline-warning  mt-1 me-1">Reset</button>
                                <a href="{{ $pageIndexUrl }}" class="btn btn-outline-danger  mt-1 me-1 cancel">Cancel</a>
                            </div>
                        </div>
                    </form>
                    <!-- users edit Info form ends -->
                </div>
            </div>
        </div>
    </div>

</section>
@endsection

@section('js')
<!-- BEGIN: Page JS-->
<script>

    /*----- Note : All Operation API Url -----*/
    /* ---- PageUrl Begin ----- */
    EditUrl = api_url+"/real/estate/get_single";
    InfoStoreUrl = api_url+"/real/estate/store";
    InfoUpdateUrl = api_url+"/real/estate/update";
    /* ---- PageUrl End ----- */

    /*----- Note : Reset All Form Fields ------*/
    $('button[class~="reset"]').click(function(){
        $("#form1")[0].reset();
        $(".select2").val(null).trigger('change');
        $("#lblExternalErr").addClass("d-none");
        $("#lblInternalErr").addClass("d-none");
        $("#lblCountryErr").addClass("d-none");
    });

    /*------ Note : Validate external number field to allow only Alphabets Numbers Dash -------*/
    function ExternalValidate(e) {
        var keyCode = e.keyCode || e.which;
        $("#lblExternalErr").removeClass("d-none");
        var errorMsg = document.getElementById("lblExternalErr");
        errorMsg.innerHTML = "";
        var pattern = /^[a-z\d\-]+$/i;
        var isValid = pattern.test(String.fromCharCode(keyCode));
        if (!isValid) {
            errorMsg.innerHTML = "Invalid Attempt. Only alphanumeric and dash are allowed.";
        }
        return isValid;
    }

    /*---- Note : Validate Internal Number field to allow only Alphabets Numbers Dash and Blank Space ------*/
    function InternalValidate(e) {
        var keyCode = e.keyCode || e.which;
        $("#lblInternalErr").removeClass("d-none");
        var errorMsg = document.getElementById("lblInternalErr");
        errorMsg.innerHTML = "";
        var pattern = /^[a-z\d\- ]+$/i;
        var isValid = pattern.test(String.fromCharCode(keyCode));
        if (!isValid) {
            errorMsg.innerHTML = "Invalid Attempt. Only alphanumeric, dash and blank space are allowed.";
        }
        return isValid;
    }

    /*---- Note : Validate ISO 3166 Alpha2 Country ------*/
    function CountryValidate(e) {
        var keyCode = e.keyCode || e.which;
        $("#lblCountryErr").removeClass("d-none");
        var errorMsg = document.getElementById("lblCountryErr");
        errorMsg.innerHTML = "";
        var pattern = /^(A(D|E|F|G|I|L|M|N|O|R|S|T|Q|U|W|X|Z)|B(A|B|D|E|F|G|H|I|J|L|M|N|O|R|S|T|V|W|Y|Z)|C(A|C|D|F|G|H|I|K|L|M|N|O|R|U|V|X|Y|Z)|D(E|J|K|M|O|Z)|E(C|E|G|H|R|S|T)|F(I|J|K|M|O|R)|G(A|B|D|E|F|G|H|I|L|M|N|P|Q|R|S|T|U|W|Y)|H(K|M|N|R|T|U)|I(D|E|Q|L|M|N|O|R|S|T)|J(E|M|O|P)|K(E|G|H|I|M|N|P|R|W|Y|Z)|L(A|B|C|I|K|R|S|T|U|V|Y)|M(A|C|D|E|F|G|H|K|L|M|N|O|Q|P|R|S|T|U|V|W|X|Y|Z)|N(A|C|E|F|G|I|L|O|P|R|U|Z)|OM|P(A|E|F|G|H|K|L|M|N|R|S|T|W|Y)|QA|R(E|O|S|U|W)|S(A|B|C|D|E|G|H|I|J|K|L|M|N|O|R|T|V|Y|Z)|T(C|D|F|G|H|J|K|L|M|N|O|R|T|V|W|Z)|U(A|G|M|S|Y|Z)|V(A|C|E|G|I|N|U)|W(F|S)|Y(E|T)|Z(A|M|W))$/;
        var isValid = pattern.test(String.fromCharCode(keyCode));
        if (!isValid) {
            errorMsg.innerHTML = "Invalid Country. Only Under ISO 3166 Alpha2 Country is allowed.";
        }
        return isValid;
    }

    /*----- Note : Ajax call for Add and Update data into database ---------*/
    $(document).on('submit', '#form1', function(e){
        e.preventDefault();
        $(".is-invalid").removeClass("is-invalid");
        $(".error").html("");
        var action = $('#save1').val();
        var url = '';
        if(action == 'add')
        {
            $("#hiddenField").html("");
            url = InfoStoreUrl;
            fd = new FormData(this);
        }
        if(action == 'edit')
        {
            url = InfoUpdateUrl;
            fd = new FormData(this);
            fd.append('id',$('#row').val());
        }
        $.ajax({
            url: url,
            method: 'post',
            data: fd ,
            contentType: false,
            cache: false,
            processData:false,
            headers: {
            },
            success:function(response)
            {
                if(response.success == true)
                {
                    var html = '<input type="hidden" name="row" value="'+response.results.records.id+'" id="row">';
                    $("#hiddenField").html(html);
                    success_msg(response.message);
                    if (e.originalEvent.submitter.id == "saveNclose") {
                        window.location.href = $('.cancel').attr('href');
                    }
                    if(action == 'add')
                    {
                        $("button[type='reset']").trigger('click');
                    }

                }
                else
                {
                    error_msg(response.message);
                }
            },
            error: function(jqXHR, textStatus, errorThrown){
                ajax_error_event(jqXHR);
            }
        });
    });

    /*----- Note : Ajax call for get the data from database and set into the form ----*/
    @if(isset($id) && !empty($id))
        $('button[class~="reset"]').addClass('d-none');
        $('#save1').val('edit');
        var html = '<input type="hidden" name="row" value="{{$id}}" id="row">';
        $("#hiddenField").html(html);
        $.ajax({
            url: EditUrl,
            method: 'post',
            data : {id:"{{$id}}"},
            cache:false,
            headers: {
            },
            success:function(response)
            {
                console.log(response);
                if(response.success == true)
                {
                    $.each(response.results.records, function (key, val)
                    {
                        if(key == 'real_estate_type'){
                            $("#" + key).val(val).trigger('change');
                        }else{
                            $("#" + key).val(val);
                        }
                    });
                }
                else
                {
                    error_msg(response.message);
                }
            },
            error: function(jqXHR, textStatus, errorThrown){
                ajax_error_event(jqXHR);
            }
        });
    @endif

</script>
<!-- END: Page JS-->

@endsection
