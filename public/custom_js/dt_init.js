/* Note : Heading create in DataTable */
function thead_create(str = ""){
    arr = str.split(",");
    var theadString  = "";
    arr.forEach(function(val) {
        theadString += "<th>"+val+"</th>";
    });

    return theadString;
}

/* Note : Heading set in DataTable */
function dt_thead_set(theadString = "") {
    // Setup - add a text input to each footer cell
    thString = thead_create(theadString);
    $('.dataTableCls thead tr:first').append(thString);
    $('.dataTableCls thead tr:first').clone(true).appendTo( '.dataTableCls thead');
    $('.dataTableCls thead tr:last th:first').addClass('indexSearch no-sort');
    $('.indexSearch').removeClass('sorting_asc');

}

/* Note :Empty DataTable Before Ajax Call */
function dt_ajax_before_send(){
    recordIds = [];
    $('#optionNo').html(10);
    $('.spinnerTr').removeClass('d-none');
    $('#dataTableId').dataTable().fnClearTable();
    $('#dataTableId').dataTable().fnDestroy();
}

/* Note : DataTable Functionality */
function ajax_complete_dt_initialize() {
    $('.spinnerTr').addClass('d-none');
    var table = $('.dataTableCls').DataTable({
            fixedHeader: true,
            scrollY:'50vh',
            scrollX: true,
            paging:   true,
            responsive: false,

            autoWidth: false,
            bInfo : true,
            select: true,
            dom:
            '<"d-flex justify-content-between align-items-center header-actions mx-2 row mt-75"' +
            '<"col-sm-12 col-lg-4 d-flex justify-content-center justify-content-lg-start" l>' +
            '<"col-sm-12 col-lg-8 ps-xl-75 ps-0"<"dt-action-buttons d-flex align-items-center justify-content-center justify-content-lg-end flex-lg-nowrap flex-wrap"<"me-1"f>B>>' +
            '>tip',
            language: {
                sLengthMenu: 'Show _MENU_',
                search: 'Search',
                searchPlaceholder: 'Search..'
            },
            buttons: [
                {
                    extend: 'collection',
                    className: 'btn btn-outline-secondary dropdown-toggle me-2',
                    text: feather.icons['share'].toSvg({ class: 'font-small-4 me-50' }) + 'Export',

                    buttons: [
                    {
                        extend: 'print',
                        text: feather.icons['printer'].toSvg({ class: 'font-small-4 me-50' }) + 'Print',
                        className: 'dropdown-item',
                        exportOptions: {
                            format: {
                                header: function ( data, columnIdx ) {
                                    let position = data.search("placeholder=");
                                    let result = data.substr(position);
                                    let fresult1 = result.replace("placeholder=","");
                                    let fresult2 = fresult1.replace('"','');
                                    let fresult3 = fresult2.replace('">',"");
                                    let fresult4 = fresult3.replace('Search',"");
                                    return fresult4;
                                }
                            },
                            columns: [':visible']
                        }
                    },
                    {
                        extend: 'csv',
                        text: feather.icons['file-text'].toSvg({ class: 'font-small-4 me-50' }) + 'Csv',
                        className: 'dropdown-item',
                        exportOptions: {
                            format: {
                                header: function ( data, columnIdx ) {
                                    let position = data.search("placeholder=");
                                    let result = data.substr(position);
                                    let fresult1 = result.replace("placeholder=","");
                                    let fresult2 = fresult1.replace('"','');
                                    let fresult3 = fresult2.replace('">',"");
                                    let fresult4 = fresult3.replace('Search',"");
                                    return fresult4;
                                }
                            },
                            columns: [':visible']
                        }
                    },
                    {
                        extend: 'excel',
                        text: feather.icons['file'].toSvg({ class: 'font-small-4 me-50' }) + 'Excel',
                        className: 'dropdown-item',
                        exportOptions: {
                            format: {
                                header: function ( data, columnIdx ) {
                                    let position = data.search("placeholder=");
                                    let result = data.substr(position);
                                    let fresult1 = result.replace("placeholder=","");
                                    let fresult2 = fresult1.replace('"','');
                                    let fresult3 = fresult2.replace('">',"");
                                    let fresult4 = fresult3.replace('Search',"");
                                    return fresult4.trim();
                                }
                            },
                            columns: [':visible']
                        }
                    },
                    {
                        extend: 'pdf',
                        text: feather.icons['clipboard'].toSvg({ class: 'font-small-4 me-50' }) + 'Pdf',
                        className: 'dropdown-item',
                        orientation: 'landscape',
                        exportOptions: {
                            format: {
                                header: function ( data, columnIdx ) {
                                    let position = data.search("placeholder=");
                                    let result = data.substr(position);
                                    let fresult1 = result.replace("placeholder=","");
                                    let fresult2 = fresult1.replace('"','');
                                    let fresult3 = fresult2.replace('">',"");
                                    let fresult4 = fresult3.replace('Search',"");
                                    return fresult4.trim();
                                }
                            },
                            columns: [':visible']
                        }
                    },
                    {
                        extend: 'copy',
                        text: feather.icons['copy'].toSvg({ class: 'font-small-4 me-50' }) + 'Copy',
                        className: 'dropdown-item',
                        exportOptions: {
                            format: {
                                header: function ( data, columnIdx ) {
                                    let position = data.search("placeholder=");
                                    let result = data.substr(position);
                                    let fresult1 = result.replace("placeholder=","");
                                    let fresult2 = fresult1.replace('"','');
                                    let fresult3 = fresult2.replace('">',"");
                                    let fresult4 = fresult3.replace('Search',"");
                                    return fresult4;
                                }
                            },
                            columns: [':visible']
                        }
                    },
                  ],
                  init: function (api, node, config) {
                    $(node).removeClass('btn-secondary');
                    $(node).parent().removeClass('btn-group');
                    setTimeout(function () {
                      $(node).closest('.dt-buttons').removeClass('btn-group').addClass('d-inline-flex mt-50');
                    }, 50);
                  }
                },
              ],

    });

    /* Note : Checkbox effect in DataTable */
    function checkBox_CheckUncheck(state) {
        var cols = table.rows({ page: 'current' }).nodes(); //current page only
        console.log("cols-"+cols.length);

        recordIds = [];
        for (var i = 0; i < cols.length; i += 1) {
            if (cols[i].querySelector("input[type='checkbox']")) {
                cols[i].querySelector("input[type='checkbox']").checked = state;
                if(state){
                    recordIds.push(cols[i].querySelector("input[type='checkbox']").value);
                }
            }
        }
    }

    $(document).on("change",".parentCheckbox",function(){
        checkBox_CheckUncheck(this.checked);
    });

    $('.parentCheckbox').prop('checked', false);

    table.buttons().container().appendTo( $('.col-md-6:eq(0)', table.table().container() ) );
    $(':input[type="search"]').attr('placeholder',"Search....");
    $('.dataTableCls thead tr:eq(2) th').each( function (i) {
        var title = $(this).text();
        $(this).html( '<input type="text" class="form-control dt-search square" placeholder="Search '+title+'" />' );

        $( 'input', this ).on( 'keyup change', function () {
            if ( table.column(i).search() !== this.value ) {
                table.column(i).search( this.value ).draw();
            }
        });
    });

    $('.dataTables_filter .form-control').removeClass('form-control-sm');
    $('.dataTables_length .form-select').removeClass('form-select-sm').removeClass('form-control-sm');

    $(document).on('click','.pageLength',function () {
        table.page.len($(this).attr('val')).draw();
        $('#optionNo').html($(this).attr('val'));
    });

}
