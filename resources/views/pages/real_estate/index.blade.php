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

<!-- Append datatable css file -->
@section('css')
@include('tools.datatable_css')
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
                    <li class="breadcrumb-item active">{{$pageTitle}}
                    </li>
                </ol>
            </div>
        </div>
    </div>
</div>
@endsection
@section('content')
<section id="index">
     <!-- Action Start -->
     <div class="action-btns">
        <div class="btn-dropdown mr-1 mb-1 ">
            <a href="{{ $pageCreateUrl }}"  class="btn btn-outline-primary pb-1 pt-1 add_new_button"  tabindex="0">
                Add New</span>
            </a>
        </div>
    </div>
    <!-- Action End -->

    <!-- Datatable -->
    <div class="card" style="min-height: 85vh;height:auto;">
        <div class="card-content">
            <div class="card-body p-0">
                <div class="table-responsive "  style="overflow: hidden;">
                    <table class="table   dataTableCls " id="dataTableId" style="width:100%" cellspacing="0" style="border: 1px solid grey;overflow:scroll;">
                        <thead >
                            <tr>
                                <th>
                                    <div class="form-check form-check-inline d-flex justify">
                                        <input class="form-check-input parentCheckbox " type="checkbox" id="parentCheckbox1" onclick="event.stopPropagation()" />
                                        <label class="form-check-label" for="parentCheckbox1" style="margin-right: 5px !important;margin-left: 5px !important">#</label>
                                        <i data-feather="trash-2" class="delete "></i>
                                    </div>
                                </th>
                                <th>Actions</th>
                            </tr>
                            <tr class="spinnerTr">
                                <td colspan="100" class="text-center" id="spiinerTd">
                                    <div>
                                        <div class="spinner-border" role="status">
                                            <span class="visually-hidden">Loading...</span>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </thead>
                        <!---- Datatable------->
                        <tbody id="dynamicTablebody">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('js')
<!-- Append datatable js file -->
@include('tools.datatable_js')
<script src="{{asset('custom_js/dt_init.js?v='.time())}}"></script>
<script src="{{asset('custom_js/dt_index_file.js?v='.time())}}"></script>

<script>

    /* ---- Note: Set the datatable fields title ----- */
    dt_thead_set('Status,RealEstateType,Name,City,Country');

    /*----- Note : All Operation API Url -----*/
    /* ---- PageUrl Begin ----- */
    GetDataUrl =  api_url+"/real/estate/list";
    EditUrl = "{{ route('real_estate.edit',':id') }}";
    DeleteUrl =  api_url+"/real/estate/delete";
    RestoreUrl =  api_url+"/real/estate/restore";
    RecycleUrl =  api_url+"/real/estate/recycle";
    /* ---- PageUrl End ----- */

    get_data();
    /* ---- Note: Function For Get All data and set in datatable ----- */
    function get_data()
    {
        /* Bind Table */
        $.ajax({
            url: GetDataUrl,
            method: 'post',
            cache: false,
            data :{
                "indexFlag": "true",
            },
            headers: {
            },
            beforeSend: function(){
                dt_ajax_before_send();
            },
            success:function(response)
            {
                console.log(response);
                if(response.success == true)
                {
                    var records = "";
                    i = 1;
                    console.log(response.results.records);
                    $.each(response.results.records, function (key, val) {
                        records += '<tr id="row'+i+'">';
                        records += '<td>'+checkBoxIcon(val.id,i)+'</td>';
                        // records += '<td class="actionBtn">'+actionIcon(val.id)+'</td>';
                        records += '<td>'+actionIcon(val.id,val.deleted_at)+recycleIcon(val.id,val.deleted_at)+'</td>';
                        records += '<td>'+customRecycle(val.deleted_at)+'</td>';
                        records += '<td>'+nullCheck(val.real_estate_type)+'</td>';
                        records += '<td>'+nullCheck(val.name)+'</td>';
                        records += '<td>'+nullCheck(val.city)+'</td>';
                        records += '<td>'+nullCheck(val.country)+'</td>';
                        records += '</tr>';
                        i++;
                    });
                    $("#dynamicTablebody").append(records);
                }
                else
                {
                    error_msg(response.message);
                }
            },
            error: function(jqXHR, textStatus, errorThrown){
                ajax_error_event(jqXHR);
            },
            complete: function(){
                ajax_complete_dt_initialize();
            }
        });
    }

</script>
@endsection
