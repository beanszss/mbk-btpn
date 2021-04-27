var base_url = $('input[name=base_url]').val()
$('#formUsers').validate({
    rules: {
        password: {
            minlength: 6
        },
        re_password: {
            equalTo: '#password'
        }
    }
})

$(document).ready(function() {
    $(document)
    var url = window.location
    $('.sidebar-menu li a[href="' + url + '"]')
        .parent()
        .addClass('active')
    $('.sidebar-menu li a')
        .filter(function() {
            return this.href == url
        })
        .parent()
        .parent()
        .show()
        .parent()
        .addClass('menu-open')
    $('ul.treeview-menu a')
        .filter(function() {
            return this.href == url
        })
        .parentsUntil('.sidebar-menu > .treeview-menu')
        .show()
        .addClass('active')
})

$(function() {
    $('#sidebar').slimscroll({
        height: 'auto'
    })
})

// function escapeXml(string) {
// 	return string.replace(/[<>]/g, function (c) {
// 		switch (c) {
// 			case '<':
// 				return '\u003c';
// 			case '>':
// 				return '\u003e';
// 		}
// 	});
// }
$(function() {
    var gdpData = {
        path01: [4.695135, 96.749397]
    }
    var map,
        markerIndex = 0,
        markersCoords = {}

    map = new jvm.Map({
        map: 'asia_mill',
        markerStyle: {
            initial: {
                fill: 'red'
            }
        },
        series: {
            regions: [{
                values: gdpData,
                scale: ['#C8EEFF', '#0071A4'],
                normalizeFunction: 'polynomial'
            }]
        },
        onRegionTipShow: function(e, el, code) {
            el.html(el.html() + '</br>' + ' (GDP - ' + gdpData[code] + ')')
        },
        container: $('#vmap'),
        onMarkerTipShow: function(e, tip, code) {
            map.tip.text(
                    markersCoords[code].lat.toFixed(2) +
                    ' ' +
                    markersCoords[code].lng.toFixed(2)
                )
                // el.html(el.html() + ' (GDP - ' + gdpData[code] + ')');
        },
        onMarkerClick: function(e, code) {
            map.removeMarkers([code])
            map.tip.hide()
        }
    })

    $('#vmap').click(function(e) {
        var x = e.pageX - map.container.offset().left,
            y = e.pageY - map.container.offset().top,
            latLng = map.pointToLatLng(x, y),
            targetCls = $(e.target).attr('class')

        if (
            latLng &&
            (!targetCls || targetCls.indexOf('jvectormap-marker') === -1)
        ) {
            markersCoords[markerIndex] = latLng
            map.addMarker(markerIndex, {
                latLng: [latLng.lat, latLng.lng]
            })
            markerIndex += 1
        }
    })
    $('#vmap').bind('')
})

$(document).ready(function() {
    $('#category').on('change', function() {
        var id_category = $(this).val()
            // if (id_category == 3) {
            // 	$('#sub_kategori').hide();
            // 	$('#sub_other').show();
            // }else{
            // $('#sub_other').hide();
            // $('#sub_kategori').show();
        if (id_category == '') {
            $('#sub_kategori').prop('disabled', true)
        } else {
            $('#sub_kategori').prop('disabled', false)
            $.ajax({
                    url: base_url + 'admin/getSub_kategori',
                    type: 'POST',
                    data: {
                        id_category: id_category
                    },
                    success: function(data) {
                        $('#sub_kategori').html(data)
                    },
                    error: function() {
                        alert('Error...!!')
                    }
                })
                // }
        }
    })
    $('#sub_other').hide()
})

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader()

        reader.onload = function(e) {
            $('#imgPreview').attr('src', e.target.result)
            $('#imgPreview').hide()
            $('#imgPreview').fadeIn(650)
        }
        reader.readAsDataURL(input.files[0])
    }
}

$('input[name=images]').change(function() {
    readURL(this)
})

$('#kv-explorer').fileinput({
    theme: 'explorer-fas',
    uploadUrl: '#',
    overwriteInitial: false,
    initialPreviewAsData: true,
    initialPreview: [
        'https://lorempixel.com/1920/1080/food/1',
        'https://lorempixel.com/1920/1080/food/2',
        'https://lorempixel.com/1920/1080/food/3'
    ],
    initialPreviewConfig: [{
            caption: 'makanan-1.jpg',
            size: 329892,
            width: '120px',
            url: '{$url}',
            key: 1
        },
        {
            caption: 'makanan-2.jpg',
            size: 872378,
            width: '120px',
            url: '{$url}',
            key: 2
        },
        {
            caption: 'makanan-3.jpg',
            size: 632762,
            width: '120px',
            url: '{$url}',
            key: 3
        }
    ]
})

var tags = $('select[name="tags[]"]').select2({
    placeholder: 'Tambah Tags',
    multiple: true,
    tags: true
})

var editorProduct = $('.editorKeren').summernote({
    height: 200,
    minHeight: null,
    maxHeight: null,
    focus: true,
    toolbar: [
        ['style', ['style', 'bold', 'italic', 'underline', 'clear']],
        ['fontsize', ['fontsize']],
        ['insert', ['link', 'table', 'picture', 'hr']],
        ['color', ['color']],
        ['para', ['ul', 'ol', 'paragraph']],
        ['height', ['height', 'codeview']]
    ]
})

// =============================================================================================
// 									Table View
// =============================================================================================

// =============================================================================================
// 									Table Setting
// =============================================================================================

$(document).ready(function() {
    $('#tableCategory').DataTable({
        responsive: true,
        colReorder: true,
        language: {
            infoFiltered: ''
        },
        fnRowCallback: function(nRow, aData, iDisplayIndex, iDisplayIndexFull) {
            var index = iDisplayIndex + 1
            $('td:eq(0)', nRow).html(index)
            return nRow
        },
        serverSide: true,
        processing: true,
        ajax: {
            url: base_url + 'api/kategori'
        },
        columnDefs: [{
                width: '5%',
                class: 'text-center',
                data: 'id_category',
                targets: 0
            },
            {
                width: '5%',
                data: 'nama_category',
                targets: 1
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'status',
                targets: 2,
                render: function(data, type, row, meta) {
                    if (data == 1) {
                        var span = '<span class="label label-success">Aktif<span>'
                    } else {
                        var span = '<span class="label label-danger">Nonaktif<span>'
                    }
                    return span
                }
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'actions',
                orderable: false,
                targets: 3,
                render: function(data, type, row, meta) {
                    return (
                        '<a href="javascript:void(0)" onclick="editCategory(' +
                        data +
                        ')"><span class="label label-warning"><i class="fa fa-pencil"></i><span></a> ' +
                        '<a href="javascript:void(0)" onclick="removeCategory(' +
                        data +
                        ')"><span class="label label-danger"><i class="fa fa-trash"></i><span></a>'
                    )
                }
            }
        ]
    })
})

$(document).ready(function() {
    $('#tableSub_kategori').DataTable({
        responsive: true,
        colReorder: true,
        language: {
            infoFiltered: ''
        },
        fnRowCallback: function(nRow, aData, iDisplayIndex, iDisplayIndexFull) {
            var index = iDisplayIndex + 1
            $('td:eq(0)', nRow).html(index)
            return nRow
        },
        serverSide: true,
        processing: true,
        ajax: {
            url: base_url + 'api/sub_kategori'
        },
        columnDefs: [{
                width: '5%',
                class: 'text-center',
                data: 'id_sub_kategori',
                targets: 0
            },
            {
                width: '5%',
                data: 'nama_sub_kategori',
                targets: 1
            },
            {
                width: '5%',
                data: 'category',
                targets: 2
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'status',
                targets: 3,
                render: function(data, type, row, meta) {
                    if (data == 1) {
                        var span = '<span class="label label-success">Aktif<span>'
                    } else {
                        var span = '<span class="label label-danger">Nonaktif<span>'
                    }
                    return span
                }
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'actions',
                orderable: false,
                targets: 4,
                render: function(data, type, row, meta) {
                    return (
                        '<a href="javascript:void(0)" onclick="edit_sub_kategori(' +
                        data +
                        ')"><span class="label label-warning"><i class="fa fa-pencil"></i><span></a> ' +
                        '<a href="javascript:void(0)" onclick="remove_sub_kategori(' +
                        data +
                        ')"><span class="label label-danger"><i class="fa fa-trash"></i><span></a>'
                    )
                }
            }
        ]
    })
})

$(document).ready(function() {
    $('#tableActivity').DataTable({
        responsive: true,
        colReorder: true,
        language: {
            infoFiltered: ''
        },
        fnRowCallback: function(nRow, aData, iDisplayIndex, iDisplayIndexFull) {
            var index = iDisplayIndex + 1
            $('td:eq(0)', nRow).html(index)
            return nRow
        },
        serverSide: true,
        processing: true,
        ajax: {
            url: base_url + 'api/activity'
        },
        columnDefs: [{
                width: '1%',
                class: 'text-center',
                data: 'id_activity',
                targets: 0
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'nama_activity',
                targets: 1
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'status',
                targets: 2,
                render: function(data, type, row, meta) {
                    if (data == 1) {
                        var span = '<span class="label label-success">Aktif<span>'
                    } else {
                        var span = '<span class="label label-danger">Non Aktif<span>'
                    }
                    return span
                }
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'actions',
                orderable: false,
                targets: 3,
                render: function(data, type, row, meta) {
                    return (
                        '<a href="javascript:void(0)" onclick="editActivity(' +
                        data +
                        ')"><span class="label label-warning"><i class="fa fa-pencil"></i><span></a> ' +
                        '<a href="javascript:void(0)" onclick="removeActivity(' +
                        data +
                        ')"><span class="label label-danger"><i class="fa fa-trash"></i><span></a>'
                    )
                }
            }
        ]
    })
})

$(document).ready(function() {
    $('#masterDevice').DataTable({
        responsive: true,
        colReorder: true,
        dom: 'Bfrtip',
        lengthMenu: [
            [10, 25, 50, -1],
            ['10 rows', '25 rows', '50 rows', 'Show all']
        ],
        buttons: [
            'pageLength',
            'copyHtml5',
            {
                text: 'Export To Excel',
                extend: 'excelHtml5',
                title: 'Data WOW'
            },
            {
                text: 'Export To Pdf',
                extend: 'pdfHtml5',
                title: 'Data WOW'
            },
            'print',
            'colvis'
        ],
        language: {
            infoFiltered: ''
        },
        fnRowCallback: function(nRow, aData, iDisplayIndex, iDisplayIndexFull) {
            var index = iDisplayIndex + 1
            $('td:eq(0)', nRow).html(index)
            return nRow
        },
        serverSide: true,
        processing: true,
        ajax: {
            url: base_url + 'device/api/device'
        },
        columnDefs: [{
                width: '5%',
                class: 'text-center',
                data: 'id_device',
                targets: 0
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'nama_device',
                targets: 1
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'brand',
                targets: 2
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'model',
                targets: 3
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'sn',
                targets: 4
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'imei',
                targets: 5
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'lob',
                targets: 6
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'tb_service',
                targets: 7
            }
        ]
    })
})

$(document).ready(function() {
    $('#masterWow').DataTable({
        responsive: {
            details: {
                display: $.fn.dataTable.Responsive.display.modal({
                    header: function(row) {
                        var data = row.data()
                        return 'Details for ' + data['imei'] + ' ' + data[1]
                    }
                }),
                renderer: $.fn.dataTable.Responsive.renderer.tableAll({
                    tableClass: 'table'
                })
            }
        },
        orderable: true,
        dom: 'Bfrtip',
        lengthMenu: [
            [10, 25, 50, -1],
            ['10 rows', '25 rows', '50 rows', 'Show all']
        ],
        buttons: [
            'pageLength',
            'copyHtml5',
            {
                text: 'Export To Excel',
                extend: 'excelHtml5',
                title: 'Data WOW'
            },
            {
                text: 'Export To Pdf',
                extend: 'pdfHtml5',
                title: 'Data WOW'
            },
            'print',
            'colvis'
        ],
        language: {
            infoFiltered: ''
        },
        fnRowCallback: function(nRow, aData, iDisplayIndex, iDisplayIndexFull) {
            var index = iDisplayIndex + 1
            $('td:eq(0)', nRow).html(index)
            return nRow
        },
        serverSide: true,
        processing: true,
        ajax: {
            url: base_url + 'api/master_wow'
        },
        columnDefs: [{
                width: '5%',
                class: 'text-center',
                data: 'id_wow',
                targets: 0
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'nama_device',
                targets: 1
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'brand',
                targets: 2
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'model',
                targets: 3
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'sn',
                targets: 4
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'imei',
                targets: 5
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'lob',
                targets: 6
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'status_allocated',
                targets: 7,
                render: function(data, type, row, meta) {
                    if ((data == 'Sudah Dialokasikan', 'BACKUP IT')) {
                        var span = '<span class="label label-success">' + data + '<span>'
                    } else {
                        var span = '<span class="label label-default"> #N/A <span>'
                    }
                    return span
                }
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'tb_service',
                targets: 8,
                render: function(data, type, row, meta) {
                    if (data == 'Warranty') {
                        var span = '<span class="label label-success">' + data + '<span>'
                    } else if (data == 'Out Of Warranty') {
                        var span = '<span class="label label-danger">' + data + '<span>'
                    } else {
                        var span = '<span class="label label-default"> #N/A <span>'
                    }
                    return span
                }
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'start_date',
                targets: 9,
                render: function(data, type, row, meta) {
                    if (data == '01 Jan 1970') {
                        var span = '<span class="label label-danger">Not Defined<span>'
                    } else if (data == '01 Nov 2018') {
                        var span = '<span class="label label-primary">' + data + '<span>'
                    } else {
                        var span = '<span class="label label-default"> #N/A <span>'
                    }
                    return span
                }
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'end_date',
                targets: 10,
                render: function(data, type, row, meta) {
                    if (data == '01 Jan 1970') {
                        var span = '<span class="label label-danger">Not Defined<span>'
                    } else if (data == '31 Oct 2019') {
                        var span = '<span class="label label-warning">' + data + '<span>'
                    } else {
                        var span = '<span class="label label-default"> #N/A <span>'
                    }
                    return span
                }
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'nama_karyawan',
                targets: 11
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'nik',
                targets: 12
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'telp',
                targets: 13
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'bc',
                targets: 14
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'cabang',
                targets: 15
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'region',
                targets: 16
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'kota',
                targets: 17
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'provinsi',
                targets: 18
            }
        ]
    })
})

$(document).ready(function() {
    $('#warrantyWOW').DataTable({
        responsive: {
            details: {
                display: $.fn.dataTable.Responsive.display.modal({
                    header: function(row) {
                        var data = row.data()
                        return 'Details for IMEI : ' + data['imei']
                    }
                }),
                renderer: $.fn.dataTable.Responsive.renderer.tableAll({
                    tableClass: 'table'
                })
            }
        },
        colReorder: true,
        dom: 'Bfrtip',
        lengthMenu: [
            [10, 25, 50, -1],
            ['10 rows', '25 rows', '50 rows', 'Show all']
        ],
        buttons: [
            'pageLength',
            'copyHtml5',
            {
                text: 'Export To Excel',
                extend: 'excelHtml5',
                title: 'Data WOW'
            },
            {
                text: 'Export To Pdf',
                extend: 'pdfHtml5',
                title: 'Data WOW'
            },
            'print',
            'colvis'
        ],
        language: {
            infoFiltered: ''
        },
        fnRowCallback: function(nRow, aData, iDisplayIndex, iDisplayIndexFull) {
            var index = iDisplayIndex + 1
            $('td:eq(0)', nRow).html(index)
            return nRow
        },
        serverSide: true,
        processing: true,
        ajax: {
            url: base_url + 'api/master_wow/get_warranty'
        },
        columnDefs: [{
                width: '5%',
                class: 'text-center',
                data: 'id_wow',
                targets: 0
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'nama_device',
                targets: 1
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'brand',
                targets: 2
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'model',
                targets: 3
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'sn',
                targets: 4
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'imei',
                targets: 5
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'lob',
                targets: 6
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'status_allocated',
                targets: 7,
                render: function(data, type, row, meta) {
                    if ((data == 'Sudah Dialokasikan', 'BACKUP IT')) {
                        var span = '<span class="label label-success">' + data + '<span>'
                    } else {
                        var span = '<span class="label label-default"> #N/A <span>'
                    }
                    return span
                }
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'tb_service',
                targets: 8,
                render: function(data, type, row, meta) {
                    if (data == 'Warranty') {
                        var span = '<span class="label label-success">' + data + '<span>'
                    } else if (data == 'Out Of Warranty') {
                        var span = '<span class="label label-danger">' + data + '<span>'
                    } else {
                        var span = '<span class="label label-default"> N/A <span>'
                    }
                    return span
                }
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'start_date',
                targets: 9,
                render: function(data, type, row, meta) {
                    if (data == '01 Jan 1970') {
                        var span = '<span class="label label-danger">Not Defined<span>'
                    } else if (data == '01 Nov 2018') {
                        var span = '<span class="label label-primary">' + data + '<span>'
                    } else {
                        var span = '<span class="label label-default"> #N/A <span>'
                    }
                    return span
                }
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'end_date',
                targets: 10,
                render: function(data, type, row, meta) {
                    if (data == '01 Jan 1970') {
                        var span = '<span class="label label-danger">Not Defined<span>'
                    } else if (data == '31 Oct 2019') {
                        var span = '<span class="label label-warning">' + data + '<span>'
                    } else {
                        var span = '<span class="label label-default"> #N/A <span>'
                    }
                    return span
                }
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'nama_karyawan',
                targets: 11
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'nik',
                targets: 12
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'telp',
                targets: 13
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'bc',
                targets: 14
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'cabang',
                targets: 15
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'region',
                targets: 16
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'kota',
                targets: 17
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'provinsi',
                targets: 18
            }
        ]
    })
})

$(document).ready(function() {
    $('#masterMur').DataTable({
        responsive: {
            details: {
                display: $.fn.dataTable.Responsive.display.modal({
                    header: function(row) {
                        var data = row.data()
                        return 'Details for ' + data['imei'] + ' ' + data[1]
                    }
                }),
                renderer: $.fn.dataTable.Responsive.renderer.tableAll({
                    tableClass: 'table'
                })
            }
        },
        colReorder: true,
        dom: 'Bfrtip',
        lengthMenu: [
            [10, 25, 50, -1],
            ['10 rows', '25 rows', '50 rows', 'Show all']
        ],
        buttons: [
            'pageLength',
            'copyHtml5',
            {
                text: 'Export To Excel',
                extend: 'excelHtml5',
                title: 'Data WOW'
            },
            {
                text: 'Export To Pdf',
                extend: 'pdfHtml5',
                title: 'Data WOW'
            },
            'print',
            'colvis'
        ],
        language: {
            infoFiltered: ''
        },
        fnRowCallback: function(nRow, aData, iDisplayIndex, iDisplayIndexFull) {
            var index = iDisplayIndex + 1
            $('td:eq(0)', nRow).html(index)
            return nRow
        },
        serverSide: true,
        processing: true,
        ajax: {
            url: base_url + 'api/master_mur'
        },
        columnDefs: [{
                width: '5%',
                class: 'text-center',
                data: 'id_mur',
                targets: 0
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'nama_device',
                targets: 1
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'brand',
                targets: 2
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'model',
                targets: 3
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'sn',
                targets: 4
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'imei',
                targets: 5
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'lob',
                targets: 6
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'status_allocated',
                targets: 7,
                render: function(data, type, row, meta) {
                    if ((data == 'Sudah Dialokasikan', 'BACKUP IT')) {
                        var span = '<span class="label label-success">' + data + '<span>'
                    } else {
                        var span = '<span class="label label-default"> #N/A <span>'
                    }
                    return span
                }
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'tb_service',
                targets: 8,
                render: function(data, type, row, meta) {
                    if (data == 'Warranty') {
                        var span = '<span class="label label-success">' + data + '<span>'
                    } else if (data == 'Out Of Warranty') {
                        var span = '<span class="label label-danger">' + data + '<span>'
                    } else {
                        var span = '<span class="label label-default"> N/A <span>'
                    }
                    return span
                }
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'start_date',
                targets: 9,
                render: function(data, type, row, meta) {
                    if (data == '01 Jan 1970') {
                        var span = '<span class="label label-danger">#N/A<span>'
                    } else if (data == '31 Oct 2018') {
                        var span = '<span class="label label-success">' + data + '<span>'
                    } else {
                        var span = '<span class="label label-default"> N/A <span>'
                    }
                    return span
                }
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'end_date',
                targets: 10,
                render: function(data, type, row, meta) {
                    if (data == '01 Jan 1970') {
                        var span = '<span class="label label-danger">#N/A<span>'
                    } else if (data == '31 Oct 2019') {
                        var span = '<span class="label label-primary">' + data + '<span>'
                    } else {
                        var span = '<span class="label label-default"> #N/A <span>'
                    }
                    return span
                }
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'nama_karyawan',
                targets: 11
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'nik',
                targets: 12
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'telp',
                targets: 13
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'bc',
                targets: 14
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'cabang',
                targets: 15
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'region',
                targets: 16
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'kota',
                targets: 17
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'provinsi',
                targets: 18
            }
        ]
    })
})

$(document).ready(function() {
    $('#warrantyMur').DataTable({
        // 'responsive': true,
        responsive: {
            details: {
                display: $.fn.dataTable.Responsive.display.modal({
                    header: function(row) {
                        var data = row.data()
                        return (
                            'Details for Purnabakti devices ' +
                            '<br>IMEI ' +
                            data['imei'] +
                            '<br> ' +
                            'Serial Number ' +
                            data['sn']
                        )
                    }
                }),
                renderer: $.fn.dataTable.Responsive.renderer.tableAll({
                    tableClass: 'table'
                })
            }
        },
        colReorder: true,
        dom: 'Bfrtip',
        lengthMenu: [
            [10, 25, 50, -1],
            ['10 rows', '25 rows', '50 rows', 'Show all']
        ],
        buttons: [
            'pageLength',
            'copyHtml5',
            {
                text: 'Export To Excel',
                extend: 'excelHtml5',
                title: 'Data Mur'
            },
            {
                text: 'Export To Pdf',
                extend: 'pdfHtml5',
                title: 'Data Mur'
            },
            'print',
            'colvis'
        ],
        language: {
            infoFiltered: ''
        },
        fnRowCallback: function(nRow, aData, iDisplayIndex, iDisplayIndexFull) {
            var index = iDisplayIndex + 1
            $('td:eq(0)', nRow).html(index)
            return nRow
        },
        serverSide: true,
        processing: true,
        ajax: {
            url: base_url + 'api/master_mur/get_warranty'
        },
        columnDefs: [{
                width: '5%',
                class: 'text-center',
                data: 'id_mur',
                targets: 0
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'nama_device',
                targets: 1
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'brand',
                targets: 2
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'model',
                targets: 3
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'sn',
                targets: 4
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'imei',
                targets: 5
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'lob',
                targets: 6
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'status_allocated',
                targets: 7,
                render: function(data, type, row, meta) {
                    if ((data == 'Sudah Dialokasikan', 'BACKUP IT')) {
                        var span = '<span class="label label-success">' + data + '<span>'
                    } else {
                        var span = '<span class="label label-default"> #N/A <span>'
                    }
                    return span
                }
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'tb_service',
                targets: 8,
                render: function(data, type, row, meta) {
                    if (data === 'Warranty') {
                        var span = '<span class="label label-success">' + data + '<span>'
                    } else if (data === 'Out Of Warranty') {
                        var span = '<span class="label label-danger">' + data + '<span>'
                    } else {
                        var span = '<span class="label label-default"> N/A <span>'
                    }
                    return span
                }
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'start_date',
                targets: 9,
                render: function(data, type, row, meta) {
                    if (data == '01 Jan 1970') {
                        var span = '<span class="label label-danger">#N/A<span>'
                    } else if ((data == '01 Jan 2018', '31 Dec 2019')) {
                        var span = '<span class="label label-primary">' + data + '<span>'
                    } else {
                        var span = '<span class="label label-default"> N/A <span>'
                    }
                    return span
                }
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'end_date',
                targets: 10,
                render: function(data, type, row, meta) {
                    if (data == '01 Jan 1970') {
                        var span = '<span class="label label-danger">#N/A<span>'
                    } else if ((data == '01 Jan 2019', '31 Dec 2019')) {
                        var span = '<span class="label label-warning">' + data + '<span>'
                    } else {
                        var span = '<span class="label label-default"> #N/A <span>'
                    }
                    return span
                }
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'nama_karyawan',
                targets: 11
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'nik',
                targets: 12
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'telp',
                targets: 13
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'bc',
                targets: 14
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'cabang',
                targets: 15
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'region',
                targets: 16
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'kota',
                targets: 17
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'provinsi',
                targets: 18
            }
        ]
    })
})

$(document).ready(function() {
    $('#tableDevice').DataTable({
        responsive: true,
        colReorder: true,
        language: {
            infoFiltered: ''
        },
        fnRowCallback: function(nRow, aData, iDisplayIndex, iDisplayIndexFull) {
            var index = iDisplayIndex + 1
            $('td:eq(0)', nRow).html(index)
            return nRow
        },
        serverSide: true,
        processing: true,
        ajax: {
            url: base_url + 'device/api/device'
        },
        columnDefs: [{
                width: '5%',
                class: 'text-center',
                data: 'id_device',
                targets: 0
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'nama_device',
                targets: 1
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'brand',
                targets: 2
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'model',
                targets: 3
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'sn',
                targets: 4
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'imei',
                targets: 5
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'lob',
                targets: 6
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'tb_service',
                targets: 7
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'actions',
                targets: 8,
                render: function(data, type, row, meta) {
                    return (
                        '<a href="javascript:void(0)" onclick="editDevice(' +
                        data +
                        ')"><span class="label label-warning"><i class="fa fa-pencil"></i><span></a> ' +
                        '<a href="javascript:void(0)" onclick="removeDevice(' +
                        data +
                        ')"><span class="label label-danger"><i class="fa fa-trash"></i><span></a>'
                    )
                }
            }
        ]
    })
})

$(document).ready(function() {
    $('#masterPur').DataTable({
        // 'responsive': true,
        responsive: {
            details: {
                display: $.fn.dataTable.Responsive.display.modal({
                    header: function(row) {
                        var data = row.data()
                        return (
                            'Details for Purnabakti devices ' +
                            '<br>IMEI ' +
                            data['imei'] +
                            '<br> ' +
                            'Serial Number ' +
                            data['sn']
                        )
                    }
                }),
                renderer: $.fn.dataTable.Responsive.renderer.tableAll({
                    tableClass: 'table'
                })
            }
        },
        dom: 'Bfrtip',
        lengthMenu: [
            [10, 25, 50, -1],
            ['10 rows', '25 rows', '50 rows', 'Show all']
        ],
        buttons: [
            'pageLength',
            'copyHtml5',
            {
                text: 'Export To Excel',
                extend: 'excelHtml5',
                title: 'Data WOW'
            },
            {
                text: 'Export To Pdf',
                extend: 'pdfHtml5',
                title: 'Data WOW'
            },
            'print',
            'colvis'
        ],
        language: {
            infoFiltered: ''
        },
        fnRowCallback: function(nRow, aData, iDisplayIndex, iDisplayIndexFull) {
            var index = iDisplayIndex + 1
            $('td:eq(0)', nRow).html(index)
            return nRow
        },
        serverSide: true,
        processing: true,
        ajax: {
            url: base_url + 'api/master_pur'
        },
        columnDefs: [{
                width: '0.3%',
                class: 'text-center',
                data: 'id_pur',
                targets: 0
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'nama_device',
                targets: 1
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'brand',
                targets: 2
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'model',
                targets: 3
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'sn',
                targets: 4
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'imei',
                targets: 5
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'lob',
                targets: 6
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'status_allocated',
                targets: 7,
                render: function(data, type, row, meta) {
                    if ((data == 'Sudah Dialokasikan', 'BACKUP IT')) {
                        var span = '<span class="label label-success">' + data + '<span>'
                    } else {
                        var span = '<span class="label label-default"> #N/A <span>'
                    }
                    return span
                }
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'tb_service',
                targets: 8,
                render: function(data, type, row, meta) {
                    if (data == 'Warranty') {
                        var span = '<span class="label label-success">' + data + '<span>'
                    } else if (data == 'Out Of Warranty') {
                        var span = '<span class="label label-danger">' + data + '<span>'
                    } else {
                        var span = '<span class="label label-default"> N/A <span>'
                    }
                    return span
                }
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'start_date',
                targets: 9,
                sortable: true,
                render: function(data, type, row, meta) {
                    if (data == '01 Jan 1970') {
                        var span = '<span class="label label-danger">Not Defined<span>'
                    } else if ((data == '01 Jan 2018', '31 Dec 2018')) {
                        var span = '<span class="label label-primary">' + data + '<span>'
                    } else {
                        var span = '<span class="label label-default"> #N/A <span>'
                    }
                    return span
                }
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'end_date',
                targets: 10,
                render: function(data, type, row, meta) {
                    if (data == '01 Jan 1970') {
                        var span = '<span class="label label-danger">Not Defined<span>'
                    } else if ((data == '01 Jan 2019', '31 Dec 2019')) {
                        var span = '<span class="label label-warning">' + data + '<span>'
                    } else {
                        var span = '<span class="label label-default"> #N/A <span>'
                    }
                    return span
                }
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'nama_karyawan',
                targets: 11
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'nik',
                targets: 12
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'telp',
                targets: 13
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'bc',
                targets: 14
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'cabang',
                targets: 15
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'region',
                targets: 16
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'kota',
                targets: 17
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'provinsi',
                targets: 18
            }
        ]
    })
})

$(document).ready(function() {
    $('#warrantyPur').DataTable({
        // 'responsive': true,
        responsive: {
            details: {
                display: $.fn.dataTable.Responsive.display.modal({
                    header: function(row) {
                        var data = row.data()
                        return (
                            'Details for Purnabakti devices ' +
                            '<br>IMEI ' +
                            data['imei'] +
                            '<br> ' +
                            'Serial Number ' +
                            data['sn']
                        )
                    }
                }),
                renderer: $.fn.dataTable.Responsive.renderer.tableAll({
                    tableClass: 'table'
                })
            }
        },
        colReorder: true,
        dom: 'Bfrtip',
        lengthMenu: [
            [10, 25, 50, -1],
            ['10 rows', '25 rows', '50 rows', 'Show all']
        ],
        buttons: [
            'pageLength',
            'copyHtml5',
            {
                text: 'Export To Excel',
                extend: 'excelHtml5',
                title: 'Data Purnabakti'
            },
            {
                text: 'Export To Pdf',
                extend: 'pdfHtml5',
                title: 'Data Purnabakti'
            },
            'print',
            'colvis'
        ],

        language: {
            infoFiltered: ''
        },
        fnRowCallBack: function(nRow, nData, iDisplayIndex, iDisplayIndexFull) {
            var index = iDisplayIndex + 1
            $('td:eq(0)', nRow).html(index)
            return nRow
        },
        serverSide: true,
        processing: true,
        ajax: {
            url: base_url + 'api/master_pur/get_warranty'
        },
        columnDefs: [{
                width: '0.3%',
                class: 'text-center',
                data: 'id_pur',
                targets: 0
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'nama_device',
                targets: 1
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'brand',
                targets: 2
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'model',
                targets: 3
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'sn',
                targets: 4
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'imei',
                targets: 5
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'lob',
                targets: 6
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'status_allocated',
                targets: 7,
                render: function(data, type, row, meta) {
                    if ((data == 'Sudah Dialokasikan', 'BACKUP IT')) {
                        var span = '<span class="label label-success">' + data + '<span>'
                    } else {
                        var span = '<span class="label label-default"> #N/A <span>'
                    }
                    return span
                }
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'tb_service',
                targets: 8,
                render: function(data, type, row, meta) {
                    if (data == 'Warranty') {
                        var span = '<span class="label label-success">' + data + '<span>'
                    } else if (data == 'Out Of Warranty') {
                        var span = '<span class="label label-danger">' + data + '<span>'
                    } else {
                        var span = '<span class="label label-default"> N/A <span>'
                    }
                    return span
                }
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'start_date',
                targets: 9,
                render: function(data, type, row, meta) {
                    if (data == '01 Jan 1970') {
                        var span = '<span class="label label-danger">Not Defined<span>'
                    } else if ((data == '01 Jan 2018', '31 Dec 2018')) {
                        var span = '<span class="label label-primary">' + data + '<span>'
                    } else {
                        var span = '<span class="label label-default"> #N/A <span>'
                    }
                    return span
                }
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'end_date',
                targets: 10,
                render: function(data, type, row, meta) {
                    if (data == '01 Jan 1970') {
                        var span = '<span class="label label-danger">Not Defined<span>'
                    } else if ((data == '01 Jan 2019', '31 Dec 2019')) {
                        var span = '<span class="label label-warning">' + data + '<span>'
                    } else {
                        var span = '<span class="label label-default"> #N/A <span>'
                    }
                    return span
                }
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'nama_karyawan',
                targets: 11
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'nik',
                targets: 12
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'telp',
                targets: 13
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'bc',
                targets: 14
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'cabang',
                targets: 15
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'region',
                targets: 16
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'kota',
                targets: 17
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'provinsi',
                targets: 18
            }
        ]
    })
})

$(document).ready(function() {
    $('#masterSinaya').DataTable({
        responsive: {
            details: {
                display: $.fn.dataTable.Responsive.display.modal({
                    header: function(row) {
                        var data = row.data()
                        return 'Details for IMEI : ' + data['imei'] + ' ' + data[1]
                    }
                }),
                renderer: $.fn.dataTable.Responsive.renderer.tableAll({
                    tableClass: 'table'
                })
            }
        },
        colReorder: true,
        dom: 'Bfrtip',
        lengthMenu: [
            [10, 25, 50, -1],
            ['10 rows', '25 rows', '50 rows', 'Show all']
        ],
        buttons: [
            'pageLength',
            'copyHtml5',
            {
                text: 'Export To Excel',
                extend: 'excelHtml5',
                title: 'Master Data Sinaya'
            },
            {
                text: 'Export To Pdf',
                extend: 'pdfHtml5',
                title: 'Master Data Sinaya'
            },
            'print',
            'colvis'
        ],
        language: {
            infoFiltered: ''
        },
        fnRowCallback: function(nRow, aData, iDisplayIndex, iDisplayIndexFull) {
            var index = iDisplayIndex + 1
            $('td:eq(0)', nRow).html(index)
            return nRow
        },
        serverSide: true,
        processing: true,
        ajax: {
            url: base_url + 'api/master_sinaya'
        },
        columnDefs: [{
                width: '5%',
                class: 'text-center',
                data: 'id_sinaya',
                targets: 0
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'nama_device',
                targets: 1
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'brand',
                targets: 2
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'model',
                targets: 3
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'sn',
                targets: 4
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'imei',
                targets: 5
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'lob',
                targets: 6
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'status_allocated',
                targets: 7,
                render: function(data, type, row, meta) {
                    if ((data == 'Sudah Dialokasikan', 'BACKUP IT')) {
                        var span = '<span class="label label-success">' + data + '<span>'
                    } else {
                        var span = '<span class="label label-default"> #N/A <span>'
                    }
                    return span
                }
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'tb_service',
                targets: 8,
                render: function(data, type, row, meta) {
                    if (data == 'Warranty') {
                        var span = '<span class="label label-success">' + data + '<span>'
                    } else if (data == 'Out Of Warranty') {
                        var span = '<span class="label label-danger">' + data + '<span>'
                    } else {
                        var span = '<span class="label label-default"> N/A <span>'
                    }
                    return span
                }
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'start_date',
                targets: 9,
                render: function(data, type, row, meta) {
                    if (data == '01 Jan 1970') {
                        var span = '<span class="label label-danger">Not Defined<span>'
                    } else if ((data == '01 Jan 2018', '31 Dec 2018')) {
                        var span = '<span class="label label-primary">' + data + '<span>'
                    } else {
                        var span = '<span class="label label-default"> #N/A <span>'
                    }
                    return span
                }
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'end_date',
                targets: 10,
                render: function(data, type, row, meta) {
                    if (data == '01 Jan 1970') {
                        var span = '<span class="label label-danger">Not Defined<span>'
                    } else if ((data == '01 Jan 2019', '31 Dec 2019')) {
                        var span = '<span class="label label-warning">' + data + '<span>'
                    } else {
                        var span = '<span class="label label-default"> #N/A <span>'
                    }
                    return span
                }
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'nama_karyawan',
                targets: 11
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'nik',
                targets: 12
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'telp',
                targets: 13
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'bc',
                targets: 14
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'cabang',
                targets: 15
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'region',
                targets: 16
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'kota',
                targets: 17
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'provinsi',
                targets: 18
            }
        ]
    })
})

$(document).ready(function() {
        $('#warrantySinaya').DataTable({
            responsive: {
                details: {
                    display: $.fn.dataTable.Responsive.display.modal({
                        header: function(row) {
                            var data = row.data()
                            return 'Details for IMEI ' + data['imei'] + ' ' + data[1]
                        }
                    }),
                    renderer: $.fn.dataTable.Responsive.renderer.tableAll({
                        tableClass: 'table'
                    })
                }
            },
            colReorder: true,
            dom: 'Bfrtip',
            lengthMenu: [
                [10, 25, 50, -1],
                ['10 rows', '25 rows', '50 rows', 'Show all']
            ],
            buttons: [
                'pageLength',
                'copyHtml5',
                {
                    text: 'Export To Excel',
                    extend: 'excelHtml5',
                    title: 'Data Sinaya'
                },
                {
                    text: 'Export To Pdf',
                    extend: 'pdfHtml5',
                    title: 'Data Sinaya'
                },
                'print',
                'colvis'
            ],
            language: {
                infoFiltered: ''
            },
            fnRowCallBack: function(nRow, nData, iDisplayIndex, iDisplayIndexFull) {
                var index = iDisplayIndex + 1
                $('td:eq(0)', nRow).html(index)
                return nRow
            },
            serverSide: true,
            processing: true,
            ajax: {
                url: base_url + 'api/master_sinaya/get_warranty'
            },
            columnDefs: [{
                    width: '5%',
                    class: 'text-center',
                    data: 'id_sinaya',
                    targets: 0
                },
                {
                    width: '5%',
                    class: 'text-center',
                    data: 'nama_device',
                    targets: 1
                },
                {
                    width: '5%',
                    class: 'text-center',
                    data: 'brand',
                    targets: 2
                },
                {
                    width: '5%',
                    class: 'text-center',
                    data: 'model',
                    targets: 3
                },
                {
                    width: '5%',
                    class: 'text-center',
                    data: 'sn',
                    targets: 4
                },
                {
                    width: '5%',
                    class: 'text-center',
                    data: 'imei',
                    targets: 5
                },
                {
                    width: '5%',
                    class: 'text-center',
                    data: 'lob',
                    targets: 6
                },
                {
                    width: '5%',
                    class: 'text-center',
                    data: 'status_allocated',
                    targets: 7,
                    render: function(data, type, row, meta) {
                        if ((data == 'Sudah Dialokasikan', 'BACKUP IT')) {
                            var span = '<span class="label label-success">' + data + '<span>'
                        } else {
                            var span = '<span class="label label-default"> #N/A <span>'
                        }
                        return span
                    }
                },
                {
                    width: '5%',
                    class: 'text-center',
                    data: 'tb_service',
                    targets: 8,
                    render: function(data, type, row, meta) {
                        if (data == 'Warranty') {
                            var span = '<span class="label label-success">' + data + '<span>'
                        } else if (data == 'Out Of Warranty') {
                            var span = '<span class="label label-danger">' + data + '<span>'
                        } else {
                            var span = '<span class="label label-default"> N/A <span>'
                        }
                        return span
                    }
                },
                {
                    width: '5%',
                    class: 'text-center',
                    data: 'start_date',
                    targets: 9,
                    render: function(data, type, row, meta) {
                        if (data == '01 Jan 1970') {
                            var span = '<span class="label label-danger">Not Defined<span>'
                        } else if ((data == '01 Jan 2018', '31 Dec 2018')) {
                            var span = '<span class="label label-primary">' + data + '<span>'
                        } else {
                            var span = '<span class="label label-default"> #N/A <span>'
                        }
                        return span
                    }
                },
                {
                    width: '5%',
                    class: 'text-center',
                    data: 'end_date',
                    targets: 10,
                    render: function(data, type, row, meta) {
                        if (data == '01 Jan 1970') {
                            var span = '<span class="label label-danger">Not Defined<span>'
                        } else if ((data == '01 Jan 2019', '31 Dec 2019')) {
                            var span = '<span class="label label-warning">' + data + '<span>'
                        } else {
                            var span = '<span class="label label-default"> #N/A <span>'
                        }
                        return span
                    }
                },
                {
                    width: '5%',
                    class: 'text-center',
                    data: 'nama_karyawan',
                    targets: 11
                },
                {
                    width: '5%',
                    class: 'text-center',
                    data: 'nik',
                    targets: 12
                },
                {
                    width: '5%',
                    class: 'text-center',
                    data: 'telp',
                    targets: 13
                },
                {
                    width: '5%',
                    class: 'text-center',
                    data: 'bc',
                    targets: 14
                },
                {
                    width: '5%',
                    class: 'text-center',
                    data: 'cabang',
                    targets: 15
                },
                {
                    width: '5%',
                    class: 'text-center',
                    data: 'region',
                    targets: 16
                },
                {
                    width: '5%',
                    class: 'text-center',
                    data: 'kota',
                    targets: 17
                },
                {
                    width: '5%',
                    class: 'text-center',
                    data: 'provinsi',
                    targets: 18
                }
            ]
        })
    })
    /** */
$(document).ready(function() {
    $('#masterSMBC').DataTable({
        responsive: {
            details: {
                display: $.fn.dataTable.Responsive.display.modal({
                    header: function(row) {
                        var data = row.data()
                        return 'Details for ' + data['imei'] + ' ' + data[1]
                    }
                }),
                renderer: $.fn.dataTable.Responsive.renderer.tableAll({
                    tableClass: 'table'
                })
            }
        },
        orderable: true,
        dom: 'Bfrtip',
        lengthMenu: [
            [10, 25, 50, -1],
            ['10 rows', '25 rows', '50 rows', 'Show all']
        ],
        buttons: [
            'pageLength',
            'copyHtml5',
            {
                text: 'Export To Excel',
                extend: 'excelHtml5',
                title: 'Data WOW'
            },
            {
                text: 'Export To Pdf',
                extend: 'pdfHtml5',
                title: 'Data WOW'
            },
            'print',
            'colvis'
        ],
        language: {
            infoFiltered: ''
        },
        fnRowCallback: function(nRow, aData, iDisplayIndex, iDisplayIndexFull) {
            var index = iDisplayIndex + 1
            $('td:eq(0)', nRow).html(index)
            return nRow
        },
        serverSide: true,
        processing: true,
        ajax: {
            url: base_url + 'api/master_smbc'
        },
        columnDefs: [{
                width: '5%',
                class: 'text-center',
                data: 'id_smbc',
                targets: 0
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'nama_device',
                targets: 1
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'brand',
                targets: 2
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'model',
                targets: 3
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'sn',
                targets: 4
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'imei',
                targets: 5
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'lob',
                targets: 6
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'status_allocated',
                targets: 7,
                render: function(data, type, row, meta) {
                    if (data == 'Sudah di allocated') {
                        var span = '<span class="label label-success">' + data + '<span>'
                    } else {
                        var span = '<span class="label label-danger"> Not Allocated <span>'
                    }
                    return span
                }
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'tb_service',
                targets: 8,
                render: function(data, type, row, meta) {
                    if (data == 'Warranty') {
                        var span = '<span class="label label-success">' + data + '<span>'
                    } else if (data == 'Out Of Warranty') {
                        var span = '<span class="label label-danger">' + data + '<span>'
                    } else {
                        var span = '<span class="label label-default"> N/A <span>'
                    }
                    return span
                }
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'start_date',
                targets: 9,
                render: function(data, type, row, meta) {
                    if (data == '01 Jan 1970') {
                        var span = '<span class="label label-danger">Not Defined<span>'
                    } else if ((data == '01 Jan 2018', '31 Dec 2018')) {
                        var span = '<span class="label label-primary">' + data + '<span>'
                    } else {
                        var span = '<span class="label label-default"> #N/A <span>'
                    }
                    return span
                }
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'end_date',
                targets: 10,
                render: function(data, type, row, meta) {
                    if (data == '01 Jan 1970') {
                        var span = '<span class="label label-danger">Not Defined<span>'
                    } else if ((data == '01 Jan 2019', '31 Dec 2019')) {
                        var span = '<span class="label label-warning">' + data + '<span>'
                    } else {
                        var span = '<span class="label label-default"> #N/A <span>'
                    }
                    return span
                }
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'kondisi',
                targets: 11
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'kelengkapan',
                targets: 12
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'nama_karyawan',
                targets: 13
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'divisi',
                targets: 14
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'keterangan',
                targets: 15
            }
        ]
    })
})

$(document).ready(function() {
    $('#masterJenius').DataTable({
        responsive: {
            details: {
                display: $.fn.dataTable.Responsive.display.modal({
                    header: function(row) {
                        var data = row.data()
                        return 'Details for ' + data['imei'] + ' ' + data[1]
                    }
                }),
                renderer: $.fn.dataTable.Responsive.renderer.tableAll({
                    tableClass: 'table'
                })
            }
        },
        orderable: true,
        dom: 'Bfrtip',
        lengthMenu: [
            [10, 25, 50, -1],
            ['10 rows', '25 rows', '50 rows', 'Show all']
        ],
        buttons: [
            'pageLength',
            'copyHtml5',
            {
                text: 'Export To Excel',
                extend: 'excelHtml5',
                title: 'Data WOW'
            },
            {
                text: 'Export To Pdf',
                extend: 'pdfHtml5',
                title: 'Data WOW'
            },
            'print',
            'colvis'
        ],
        language: {
            infoFiltered: ''
        },
        fnRowCallback: function(nRow, aData, iDisplayIndex, iDisplayIndexFull) {
            var index = iDisplayIndex + 1
            $('td:eq(0)', nRow).html(index)
            return nRow
        },
        serverSide: true,
        processing: true,
        ajax: {
            url: base_url + 'api/master_jenius'
        },
        columnDefs: [{
                width: '5%',
                class: 'text-center',
                data: 'id_jenius',
                targets: 0
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'nama_device',
                targets: 1
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'brand',
                targets: 2
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'model',
                targets: 3
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'sn',
                targets: 4
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'imei',
                targets: 5,
                render: function(data, type, row, meta) {
                    if (data == '') {
                        var span = '<span class="label label-danger"> #N/A <span>'
                    } else {
                        data
                    }
                    return span
                }
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'lob',
                targets: 6
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'status_allocated',
                targets: 7,
                render: function(data, type, row, meta) {
                    if (data == 'Sudah dialokasi') {
                        var span = '<span class="label label-success">' + data + '<span>'
                    } else if (data == 'BACKUP JENIUS') {
                        var span = '<span class="label label-warning">' + data + '<span>'
                    } else {
                        var span = '<span class="label label-default"> #N/A <span>'
                    }
                    return span
                }
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'tb_service',
                targets: 8,
                render: function(data, type, row, meta) {
                    if (data == 'Warranty') {
                        var span = '<span class="label label-success">' + data + '<span>'
                    } else if (data == 'Out Of Warranty') {
                        var span = '<span class="label label-danger">' + data + '<span>'
                    } else {
                        var span = '<span class="label label-default"> #N/A <span>'
                    }
                    return span
                }
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'start_date',
                targets: 9,
                render: function(data, type, row, meta) {
                    if (data == '01 Jan 1970') {
                        var span = '<span class="label label-danger">Not Defined<span>'
                    } else if (data == '01 Nov 2018') {
                        var span = '<span class="label label-primary">' + data + '<span>'
                    } else {
                        var span = '<span class="label label-default"> #N/A <span>'
                    }
                    return span
                }
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'end_date',
                targets: 10,
                render: function(data, type, row, meta) {
                    if (data == '01 Jan 1970') {
                        var span = '<span class="label label-danger">Not Defined<span>'
                    } else if (data == '31 Oct 2019') {
                        var span = '<span class="label label-warning">' + data + '<span>'
                    } else {
                        var span = '<span class="label label-default"> #N/A <span>'
                    }
                    return span
                }
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'nama_karyawan',
                targets: 11
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'nik',
                targets: 12
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'telp',
                targets: 13
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'bc',
                targets: 14
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'cabang',
                targets: 15
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'region',
                targets: 16
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'kota',
                targets: 17
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'provinsi',
                targets: 18
            }
        ]
    })
})

$(document).ready(function() {
    $('#masterOthers').DataTable({
        responsive: {
            details: {
                display: $.fn.dataTable.Responsive.display.modal({
                    header: function(row) {
                        var data = row.data()
                        return 'Details for ' + data['imei'] + ' ' + data[1]
                    }
                }),
                renderer: $.fn.dataTable.Responsive.renderer.tableAll({
                    tableClass: 'table'
                })
            }
        },
        orderable: true,
        dom: 'Bfrtip',
        lengthMenu: [
            [10, 25, 50, -1],
            ['10 rows', '25 rows', '50 rows', 'Show all']
        ],
        buttons: [
            'pageLength',
            'copyHtml5',
            {
                text: 'Export To Excel',
                extend: 'excelHtml5',
                title: 'Data WOW'
            },
            {
                text: 'Export To Pdf',
                extend: 'pdfHtml5',
                title: 'Data WOW'
            },
            'print',
            'colvis'
        ],
        language: {
            infoFiltered: ''
        },
        fnRowCallback: function(nRow, aData, iDisplayIndex, iDisplayIndexFull) {
            var index = iDisplayIndex + 1
            $('td:eq(0)', nRow).html(index)
            return nRow
        },
        serverSide: true,
        processing: true,
        ajax: {
            url: base_url + 'api/master_other'
        },
        columnDefs: [{
                width: '5%',
                class: 'text-center',
                data: 'id_other',
                targets: 0
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'nama_device',
                targets: 1
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'brand',
                targets: 2
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'model',
                targets: 3
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'sn',
                targets: 4
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'imei',
                targets: 5
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'lob',
                targets: 6,
                render: function(data, type, row, meta) {
                    return (span = '<span class="label label-danger"> #N/A <span>')
                }
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'status_allocated',
                targets: 7,
                render: function(data, type, row, meta) {
                    if ((data == 'Sudah Dialokasikan', 'backup it', 'backup jenius')) {
                        var span =
                            '<span class="label label-success">' +
                            data.toUpperCase() +
                            '<span>'
                    } else {
                        var span = '<span class="label label-default"> #N/A <span>'
                    }
                    return span
                }
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'tb_service',
                targets: 8,
                render: function(data, type, row, meta) {
                    if (data == 'Warranty') {
                        var span = '<span class="label label-success">' + data + '<span>'
                    } else if (data == 'Out Of Warranty') {
                        var span = '<span class="label label-danger">' + data + '<span>'
                    } else {
                        var span = '<span class="label label-default"> #N/A <span>'
                    }
                    return span
                }
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'start_date',
                targets: 9,
                render: function(data, type, row, meta) {
                    if (data == '01 Jan 1970') {
                        var span = '<span class="label label-danger">Not Defined<span>'
                    } else if (data == '01 Nov 2018') {
                        var span = '<span class="label label-primary">' + data + '<span>'
                    } else {
                        var span = '<span class="label label-default"> #N/A <span>'
                    }
                    return span
                }
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'end_date',
                targets: 10,
                render: function(data, type, row, meta) {
                    if (data == '01 Jan 1970') {
                        var span = '<span class="label label-danger">Not Defined<span>'
                    } else if (data == '31 Oct 2019') {
                        var span = '<span class="label label-warning">' + data + '<span>'
                    } else {
                        var span = '<span class="label label-default"> #N/A <span>'
                    }
                    return span
                }
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'nama_karyawan',
                targets: 11
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'nik',
                targets: 12
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'telp',
                targets: 13
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'bc',
                targets: 14
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'cabang',
                targets: 15
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'region',
                targets: 16
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'kota',
                targets: 17
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'provinsi',
                targets: 18
            }
        ]
    })
})

/**=========================================================================================================================================== */

$(document).ready(function() {
    $('#table_subKanwil').DataTable({
        responsive: true,
        colReorder: true,
        language: {
            infoFiltered: ''
        },
        fnRowCallBack: function(nRow, aData, iDisplayIndex, iDisplayIndexFull) {
            var index = iDisplayIndex + 1
            $('td:eq(0)', nRow).html(index)
            return nRow
        },
        serverSide: true,
        processing: true,
        ajax: {
            url: base_url + 'api/sub_kanwil'
        },
        columnDefs: [{
                width: '5%',
                class: 'text-center',
                data: 'id_sub_kanwil',
                targets: 0
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'jenis',
                targets: 1
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'nama_cabang',
                targets: 2
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'alamat',
                targets: 3
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'region',
                targets: 4
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'actions',
                orderable: false,
                targets: 5,
                render: function(data, type, row, meta) {
                    return (
                        '<a href="javascript:void(0)" onclick="edit_sub_kanwil(' +
                        data +
                        ')"><span class="label label-warning"><i class="fa fa-pencil"></i><span></a> ' +
                        '<a href="javascript:void(0)" onclick="remove_sub_kanwil(' +
                        data +
                        ')"><span class="label label-danger"><i class="fa fa-trash"></i><span></a>'
                    )
                }
            }
        ]
    })
})

$(document).ready(function() {
    $('#table_dtKanwil').DataTable({
        responsive: true,
        colReorder: true,
        dom: 'Bfrtip',
        lengthMenu: [
            [10, 25, 50, -1],
            ['10 rows', '25 rows', '50 rows', 'Show all']
        ],
        buttons: [
            'pageLength',
            'copyHtml5',
            {
                text: 'Export To Excel',
                extend: 'excelHtml5',
                title: 'Data Cabang'
            },
            {
                text: 'Export To Pdf',
                extend: 'pdfHtml5',
                title: 'Data Cabang'
            },
            'print',
            'colvis'
        ],
        language: {
            infoFiltered: ''
        },

        fnRowCallBack: function(nRow, aData, iDisplayIndex, iDisplayIndexFull) {
            var index = iDisplayIndex + 1
            $('td:eq(0)', nRow).html(index)
            return nRow
        },
        serverSide: true,
        processing: true,
        ajax: {
            url: base_url + 'api/dt_kanwil'
        },
        columnDefs: [{
                width: '0.1%',
                class: 'text-center',
                data: 'id_detail',
                targets: 0
            },
            {
                width: '2.5%',
                class: 'text-center',
                data: 'jenis',
                targets: 1
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'business',
                targets: 2
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'nama_cabang',
                targets: 3
            },
            {
                width: '15%',
                class: 'text-center',
                data: 'alamat',
                targets: 4
            },
            {
                width: '2.5%',
                class: 'text-center',
                data: 'region',
                targets: 5
            }
        ]
    })
})

$(document).ready(function() {
    $('#table_dtLaporan').DataTable({
        // responsive		: true,
        order: [
            [3, 'desc']
        ],
        // 'responsive': true,
        responsive: {
            details: {
                display: $.fn.dataTable.Responsive.display.modal({
                    header: function(row) {
                        var data = row.data()
                        return 'Details for ' + data['case_id'] + ' ' + data[1]
                    }
                }),
                renderer: $.fn.dataTable.Responsive.renderer.tableAll({
                    tableClass: 'table'
                })
            }
        },
        language: {
            lengthMenu: 'Display _MENU_ records per page',
            infoFiltered: '(filtered from _MAX_ total records)',
            info: 'Showing page _PAGE_ of _PAGES_',
            zeroRecords: 'Nothing found - sorry'
        },
        fnRowCallBack: function(nRow, aData, iDisplayIndex, iDisplayIndexFull) {
            var index = iDisplayIndex + 1
            $('td:eq(0)', nRow).html(index)
            return nRow
        },
        serverSide: true,
        processing: true,
        ajax: {
            url: base_url + 'api/laporan'
        },
        columnDefs: [{
                width: '5%',
                class: 'text-center',
                data: 'id_laporan',
                targets: 0
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'case_id',
                targets: 1
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'tiket_btpn',
                targets: 2
            },
            {
                width: '7%',
                class: 'text-center',
                data: 'created_at',
                targets: 3
            },
            {
                width: '10%',
                class: 'text-center',
                data: 'nama',
                targets: 4
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'nohp',
                targets: 5
            },
            {
                width: '17%',
                class: 'text-center',
                data: 'lokasi',
                targets: 6
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'alamat',
                targets: 7
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'imei_problem',
                targets: 8
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'sn_problem',
                targets: 9
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'imei_replace',
                targets: 10
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'sn_replace',
                targets: 11
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'category',
                targets: 12
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'sub_kategori',
                targets: 13
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'text',
                targets: 14
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'activity',
                targets: 15,
                render: function(data, type, row, meta) {
                    if (data == 'In Process') {
                        var span = '<span class="label label-info">' + data + '<span>'
                    } else if (data == 'Resolved') {
                        var span = '<span class="label label-warning">' + data + '<span>'
                    } else if (data == 'Closed') {
                        var span = '<span class="label label-success">' + data + '<span>'
                    } else {
                        var span = '<span class="label label-danger">Undefined<span>'
                    }
                    return span
                }
            }
        ]
    })
})

$('.modal-child').on('show.bs.modal', function() {
    var modalParent = $(this).attr('data-modal-parent')
    $(modalParent).css('opocity', 0)
})

$(document).ready(function() {
    $('#tableLaporan').DataTable({
        responsive: true,
        order: [
            [3, 'desc']
        ],
        fnRowCallback: function(nRow, aData, iDisplayIndex, iDisplayIndexFull) {
            var index = iDisplayIndex + 1
            $('td:eq(0)', nRow).html(index)
            return nRow
        },
        serverSide: true,
        processing: true,
        ajax: {
            url: base_url + 'api/laporan'
        },
        columnDefs: [{
                width: '0.1%',
                class: 'text-center',
                data: 'id_laporan',
                targets: 0
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'case_id',
                targets: 1
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'tiket_btpn',
                targets: 2
            },
            {
                width: '7%',
                class: 'text-center',
                data: 'created_at',
                targets: 3
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'nama',
                targets: 4
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'nohp',
                targets: 5
            },
            {
                width: '15%',
                class: 'text-center',
                data: 'lokasi',
                orderable: false,
                targets: 6
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'alamat',
                targets: 7
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'imei_problem',
                targets: 8
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'sn_problem',
                targets: 9
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'imei_replace',
                targets: 10
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'sn_replace',
                targets: 11
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'sub_kategori',
                targets: 12
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'category',
                targets: 13
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'text',
                targets: 14
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'activity',
                targets: 15,
                render: function(data, type, row, meta) {
                    if (data == 'In Process') {
                        var span = '<span class="label label-info">' + data + '<span>'
                    } else if (data == 'Resolved') {
                        var span = '<span class="label label-warning">' + data + '<span>'
                    } else if (data == 'Closed') {
                        var span = '<span class="label label-success">' + data + '<span>'
                    } else {
                        var span = '<span class="label label-danger">Undefined<span>'
                    }
                    return span
                }
            },

            {
                width: '5%',
                class: 'text-center',
                data: 'actions',
                orderable: false,
                targets: 16,
                render: function(data, type, row, meta) {
                    return (
                            '<a href="javascript:void(0)" onclick="editLaporan(' +
                            data +
                            ')"><span class="label label-warning"><i class="fa fa-pencil openBtn"></i><span></a> ' +
                            '<a href="javascript:void(0)" onclick="removeLaporan(' +
                            data +
                            ')"><span class="label label-danger"><i class="fa fa-trash"></i><span></a>'
                        )
                        // '<a href="javascript:void(0)" onclick="detailLaporan(' + data + ')"><span class="label label-success"><i class="fa fa-file"></i><span></a> ' +
                }
            }
        ]
    })
})

$(document).ready(function() {
    $('#tableUsers').DataTable({
        responsive: true,
        colReorder: true,
        language: {
            infoFiltered: ''
        },
        fnRowCallback: function(nRow, aData, iDisplayIndex, iDisplayIndexFull) {
            var index = iDisplayIndex + 1
            $('td:eq(0)', nRow).html(index)
            return nRow
        },
        serverSide: true,
        processing: true,
        ajax: {
            url: base_url + 'api/users'
        },
        columnDefs: [{
                width: '5%',
                class: 'text-center',
                data: 'id',
                targets: 0
            },
            {
                width: '5%',
                data: 'username',
                targets: 1
            },
            {
                width: '5%',
                data: 'email',
                targets: 2
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'access',
                targets: 3,
                render: function(data, type, row, meta) {
                    if (data == 'admin') {
                        var span =
                            '<span class="label label-success">' +
                            data.toUpperCase() +
                            '<span>'
                    } else if (data == 'mod') {
                        var span =
                            '<span class="label label-danger">' +
                            data.toUpperCase() +
                            '<span>'
                    } else if (data == 'helpdesk') {
                        var span =
                            '<span class="label label-primary">' +
                            data.toUpperCase() +
                            '<span>'
                    } else {
                        var span =
                            '<span class="label label-default">' +
                            data.toUpperCase() +
                            '<span>'
                    }
                    return span
                }
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'active',
                targets: 4,
                render: function(data, type, row, meta) {
                    if (data == 1) {
                        var span = '<span class="label label-success">Aktif<span>'
                    } else {
                        var span = '<span class="label label-danger">Nonaktif<span>'
                    }
                    return span
                }
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'actions',
                orderable: false,
                targets: 5,
                render: function(data, type, row, meta) {
                    return (
                        '<a href="javascript:void(0)" onclick="editUsers(' +
                        data +
                        ')"><span class="label label-warning"><i class="fa fa-pencil"></i><span></a> ' +
                        '<a href="javascript:void(0)" onclick="removeUsers(' +
                        data +
                        ')"><span class="label label-warning"><i class="fa fa-trash"></i><span></a>'
                    )
                }
            }
        ]
    })
})

/**
 * ===============================================
 * Configuration
 * ===============================================
 */
$(document).ready(function() {
    $('#tableLob').DataTable({
        responsive: true,
        colReorder: true,
        language: {
            infoFiltered: ''
        },
        fnRowCallback: function(nRow, aData, iDisplayIndex, iDisplayIndexFull) {
            var index = iDisplayIndex + 1
            $('td:eq(0)', nRow).html(index)
            return nRow
        },
        serverSide: true,
        processing: true,
        ajax: {
            url: base_url + 'api/lob'
        },
        columnDefs: [{
                width: '5%',
                class: 'text-center',
                data: 'id_lob',
                targets: 0
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'nama_lob',
                targets: 1
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'status',
                targets: 2,
                render: function(data, type, row, meta) {
                    if (data == 1) {
                        var span = '<span class="label label-success">Aktif<span>'
                    } else {
                        var span = '<span class="label label-danger">Non Aktif<span>'
                    }
                    return span
                }
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'actions',
                orderable: false,
                targets: 3,
                render: function(data, type, row, meta) {
                    return (
                        '<a href="javascript:void(0)" onclick="editLob(' +
                        data +
                        ')"><span class="label label-warning"><i class="fa fa-pencil"></i><span></a> ' +
                        '<a href="javascript:void(0)" onclick="removeLob(' +
                        data +
                        ')"><span class="label label-danger"><i class="fa fa-trash"></i><span></a>'
                    )
                }
            }
        ]
    })
})

$(document).ready(function() {
    $('#tableService').DataTable({
        responsive: true,
        colReorder: true,
        language: {
            infoFiltered: ''
        },
        fnRowCallback: function(nRow, aData, iDisplayIndex, iDisplayIndexFull) {
            var index = iDisplayIndex + 1
            $('td:eq(0)', nRow).html(index)
            return nRow
        },
        serverSide: true,
        processing: true,
        ajax: {
            url: base_url + 'api/service'
        },
        columnDefs: [{
                width: '5%',
                class: 'text-center',
                data: 'id_service',
                targets: 0
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'service',
                targets: 1
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'status',
                targets: 2,
                render: function(data, type, row, meta) {
                    if (data == 1) {
                        var span = '<span class="label label-success">Aktif<span>'
                    } else {
                        var span = '<span class="label label-danger">Non Aktif<span>'
                    }
                    return span
                }
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'actions',
                orderable: false,
                targets: 3,
                render: function(data, type, row, meta) {
                    return (
                        '<a href="javascript:void(0)" onclick="editService(' +
                        data +
                        ')"><span class="label label-warning"><i class="fa fa-pencil"></i><span></a> ' +
                        '<a href="javascript:void(0)" onclick="removeService(' +
                        data +
                        ')"><span class="label label-danger"><i class="fa fa-trash"></i><span></a>'
                    )
                }
            }
        ]
    })
})

$(document).ready(function() {
    $('#tableKanwil').DataTable({
        responsive: true,
        colReorder: true,
        language: {
            infoFiltered: ''
        },
        fnRowCallback: function(nRow, aData, iDisplayIndex, iDisplayIndexFull) {
            var index = iDisplayIndex + 1
            $('td:eq(0)', nRow).html(index)
            return nRow
        },
        serverSide: true,
        processing: true,
        ajax: {
            url: base_url + 'api/kanwil'
        },
        columnDefs: [{
                width: '5%',
                class: 'text-center',
                data: 'id_kanwil',
                targets: 0
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'jenis',
                targets: 1
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'status',
                targets: 2,
                render: function(data, type, row, meta) {
                    if (data == 1) {
                        var span = '<span class="label label-success">Aktif<span>'
                    } else {
                        var span = '<span class="label label-danger">Nonaktif<span>'
                    }
                    return span
                }
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'actions',
                orderable: false,
                targets: 3,
                render: function(data, type, row, meta) {
                    return (
                        '<a href="javascript:void(0)" onclick="editKanwil(' +
                        data +
                        ')"><span class="label label-warning"><i class="fa fa-pencil"></i><span></a> ' +
                        '<a href="javascript:void(0)" onclick="removeKanwil(' +
                        data +
                        ')"><span class="label label-danger"><i class="fa fa-trash"></i><span></a>'
                    )
                }
            }
        ]
    })
})

$(document).ready(function() {
    $('#tableDevice_type').DataTable({
        responsive: true,
        colReorder: true,
        language: {
            infoFiltered: ''
        },
        fnRowCallback: function(nRow, aData, iDisplayIndex, iDisplayIndexFull) {
            var index = iDisplayIndex + 1
            $('td:eq(0)', nRow).html(index)
            return nRow
        },
        serverSide: true,
        processing: true,
        ajax: {
            url: base_url + 'device/api/type'
        },
        columnDefs: [{
                width: '5%',
                class: 'text-center',
                data: 'id_dc',
                targets: 0
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'device_type',
                targets: 1
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'status',
                targets: 2,
                render: function(data, type, row, meta) {
                    if (data == 1) {
                        var span = '<span class="label label-success">Aktif<span>'
                    } else {
                        var span = '<span class="label label-danger">Nonaktif<span>'
                    }
                    return span
                }
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'actions',
                orderable: false,
                targets: 3,
                render: function(data, type, row, meta) {
                    return (
                        '<a href="javascript:void(0)" onclick="editDevice_type(' +
                        data +
                        ')"><span class="label label-warning"><i class="fa fa-pencil"></i></span></a>' +
                        ' <a href="javascript:void(0)" onclick="removeDevice_type(' +
                        data +
                        ')"><span class="label label-danger"><i class="fa fa-trash"></i></span></a>'
                    )
                }
            }
        ]
    })
})

$(document).ready(function() {
    $('#tableDevice_brand').DataTable({
        responsive: true,
        colReorder: true,
        language: {
            infoFiltered: ''
        },
        fnRowCallback: function(nRow, aData, iDisplayIndex, iDisplayIndexFull) {
            var index = iDisplayIndex + 1
            $('td:eq(0)', nRow).html(index)
            return nRow
        },
        serverSide: true,
        processing: true,
        ajax: {
            url: base_url + 'device/api/brand'
        },
        columnDefs: [{
                width: '5%',
                class: 'text-center',
                data: 'id_brand',
                targets: 0
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'nama_brand',
                targets: 1
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'status',
                targets: 2,
                render: function(data, type, row, meta) {
                    if (data == 1) {
                        var span = '<span class="label label-success">Aktif</span>'
                    } else {
                        var span = '<span class="label label-danger">Nonaktif</span>'
                    }
                    return span
                }
            },
            {
                width: '5%',
                class: 'text-center',
                data: 'actions',
                orderable: false,
                targets: 3,
                render: function(data, type, row, meta) {
                    return (
                        '<a href="javascript:void(0)" onclick="editDevice_brand(' +
                        data +
                        ')"><span class="label label-warning"><i class="fa fa-pencil"></i></span></a>' +
                        ' <a href="javascript:void(0)" onclick="removeDevice_brand(' +
                        data +
                        ')"><span class="label label-danger"><i class="fa fa-trash"></i></span></a>'
                    )
                }
            }
        ]
    })
})

$(document).ready(function() {
    $('#tableAllocated').DataTable({
        responsive: true,
        colreorder: true,
        language: {
            infoFiltered: ''
        },
        fnRowCallback: function(nRow, aData, iDisplayIndex, iDisplayIndexFull) {
            var index = iDisplayIndex + 1
            $('td:eq(0)', nRow).html(index)
            return nRow
        },
        serverSide: true,
        processing: true,
        ajax: {
            url: base_url + 'device/api/allocated'
        },
        columnDefs: [{}]
    })
})

/**
 * ================================================================================================
 * End of Configuration DataTable
 * ================================================================================================
 */

// =======================================================
// Configuration DataTable
// =======================================================

/**
 * ======================================
 * ACTIVITY
 * ======================================
 */
function saveActivity() {
    var formActivity = $('#formActivity')
    if (formActivity.valid()) {
        Swal({
            title: 'Anda Yakin?',
            text: 'Proses Ini Tidak Dapat Dikembalikan!',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
        }).then(result => {
            if (result.value) {
                var formData = new FormData(formActivity[0])
                $.ajax({
                    url: base_url + 'api/activity/create',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    dataType: 'JSON',
                    success: function(data) {
                        if (data.status === true) {
                            $('#formActivity')[0].reset()
                                // tableCategory.ajax.reload(null, false);
                            $('#tableActivity')
                                .DataTable()
                                .ajax.reload(null, false)
                            Swal('Berhasil !', 'Your Activity Created.', 'success')
                        } else {
                            Swal('Opps!', 'Terjadi Kesalahan!.', 'error')
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        Swal('Opps!', errorThrown, 'error')
                    }
                })
            }
        })
    }
}

function editActivity(id) {
    $.ajax({
        url: base_url + 'api/activity/getById/' + id,
        type: 'GET',
        dataType: 'JSON',
        success: function(data) {
            if (data.status == true) {
                $('input[name=id_activity]').val(data.result.id_activity)
                $('input[name=nama_activity]').val(data.result.nama_activity)
                $('select[name=status]').val(data.result.status)
                $('.box-title').text('Edit Activity ' + data.result.nama_activity)
                $('#btnActivity')
                    .attr('onclick', 'updateActivity()')
                    .text('Update Activity')
                    .attr('class', 'btn btn-danger pull-right')
            } else {
                Swal('Opps!', 'Terjadi Kesalahan !', 'error')
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            Swal('Opps!', errorThrown, 'error')
        }
    })
}

function updateActivity() {
    var formActivity = $('#formActivity')
    if (formActivity.valid()) {
        Swal({
            title: 'Anda Yakin?',
            text: 'Proses Ini Tidak Dapat Dikembalikan!',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
        }).then(result => {
            if (result.value) {
                var formData = new FormData(formActivity[0])
                $.ajax({
                    url: base_url + 'api/activity/create',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    dataType: 'JSON',
                    success: function(data) {
                        if (data.status === true) {
                            $('#formActivity')[0].reset()
                            $('input[name=id_activity]').val('')
                                // tableCategory.ajax.reload(null, false);
                            $('#tableActivity')
                                .DataTable()
                                .ajax.reload(null, false)
                            $('.box-title').text('Add Category')
                            $('#btnActivity')
                                .attr('onclick', 'saveActivity()')
                                .text('Tambah Activity')
                                .attr('class', 'btn btn-info pull-right')
                            Swal('Berhasil !', 'Your Activity has been Update.', 'success')
                        } else {
                            Swal('Opps!', 'Terjadi Kesalahan!.', 'error')
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        Swal('Opps!', errorThrown, 'error')
                    }
                })
            }
        })
    }
}

function removeActivity(id) {
    Swal({
        title: 'Anda Yakin?',
        text: 'Proses Ini Tidak Dapat Dikembalikan!',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes'
    }).then(result => {
        if (result.value) {
            $.ajax({
                url: base_url + 'api/activity/destroy/' + id,
                type: 'GET',
                dataType: 'JSON',
                success: function(data) {
                    if (data.status == true) {
                        $('#formActivity')[0].reset()
                            // tableCategory.ajax.reload(null, false);
                        $('#tableActivity')
                            .DataTable()
                            .ajax.reload(null, false)
                        Swal('Terhapus !', 'Activity has been Deleted !.', 'success')
                    } else {
                        Swal('Opps!', 'Terjadi Kesalahan!.', 'error')
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    Swal('Opps!', errorThrown, 'error')
                }
            })
        }
    })
}
/**
 * ======================================
 * End of ACTIVITY
 * ======================================
 */

/**
 * ======================================
 * KATEGORI
 * ======================================
 */
function saveCategory() {
    var formCategory = $('#formCategory')
    if (formCategory.valid()) {
        Swal({
            title: 'Anda Yakin?',
            text: 'Proses Ini Tidak Dapat Dikembalikan!',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
        }).then(result => {
            if (result.value) {
                var formData = new FormData(formCategory[0])
                $.ajax({
                    url: base_url + 'api/kategori/create',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    dataType: 'JSON',
                    success: function(data) {
                        if (data.status === true) {
                            $('#formCategory')[0].reset()
                                // tableCategory.ajax.reload(null, false);
                            $('#tableCategory')
                                .DataTable()
                                .ajax.reload(null, false)
                            Swal('Berhasil !', 'Your Category created.', 'success')
                        } else {
                            Swal('Opps!', 'Terjadi Kesalahan!.', 'error')
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        Swal('Opps!', errorThrown, 'error')
                    }
                })
            }
        })
    }
}

function editCategory(id) {
    $.ajax({
        url: base_url + 'api/kategori/getById/' + id,
        type: 'GET',
        dataType: 'JSON',
        success: function(data) {
            if (data.status == true) {
                $('input[name=id_category]').val(data.result.id_category)
                $('input[name=name]').val(data.result.nama_category)

                $('select[name=status]').val(data.result.status)

                $('.box-title').text('Edit Category ' + data.result.nama_category)
                $('#btnCategory')
                    .attr('onclick', 'updateCategory()')
                    .text('Update Category')
                    .attr('class', 'btn btn-danger pull-right')
            } else {
                Swal('Opps!', 'Terjadi Kesalahan!.', 'error')
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            Swal('Opps!', errorThrown, 'error')
        }
    })
}

function updateCategory() {
    var formCategory = $('#formCategory')
    if (formCategory.valid()) {
        Swal({
            title: 'Anda Yakin?',
            text: 'Proses Ini Tidak Dapat Dikembalikan!',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
        }).then(result => {
            if (result.value) {
                var formData = new FormData(formCategory[0])
                $.ajax({
                    url: base_url + 'api/kategori/create',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    dataType: 'JSON',
                    success: function(data) {
                        if (data.status === true) {
                            $('#formCategory')[0].reset()
                            $('input[name=id_category]').val('')
                                // tableCategory.ajax.reload(null, false);
                            $('#tableCategory')
                                .DataTable()
                                .ajax.reload(null, false)
                            $('.box-title').text('Add Category')
                            $('#btnCategory')
                                .attr('onclick', 'saveCategory()')
                                .text('Add Category')
                                .attr('class', 'btn btn-info pull-right')
                            Swal('Success !', 'Kategori Telah Diupdate.', 'success')
                        } else {
                            Swal('Opps!', 'Terjadi Kesalahan!.', 'error')
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        Swal('Opps!', errorThrown, 'error')
                    }
                })
            }
        })
    }
}

function removeCategory(id) {
    Swal({
        title: 'Anda Yakin?',
        text: 'Proses Ini Tidak Dapat Dikembalikan!',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes'
    }).then(result => {
        if (result.value) {
            $.ajax({
                url: base_url + 'api/kategori/destroy/' + id,
                type: 'GET',
                dataType: 'JSON',
                success: function(data) {
                    if (data.status == true) {
                        $('#formCategory')[0].reset()
                            // tableCategory.ajax.reload(null, false);
                        $('#tableCategory')
                            .DataTable()
                            .ajax.reload(null, false)
                        Swal('Terhapus !', 'Your Category has been deleted.', 'success')
                    } else {
                        Swal('Opps!', 'Terjadi Kesalahan!.', 'error')
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    Swal('Opps!', errorThrown, 'error')
                }
            })
        }
    })
}
/**
 * ======================================
 * End of KATEGORI
 * ======================================
 */

/**
 * ======================================
 * SUB KATEGORI
 * ======================================
 */
function save_sub_kategori() {
    var form_sub_kategori = $('#form_sub_kategori')
    if (form_sub_kategori.valid()) {
        Swal({
            title: 'Anda Yakin?',
            text: 'Proses Ini Tidak Dapat Dikembalikan!',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
        }).then(result => {
            if (result.value) {
                var formData = new FormData(form_sub_kategori[0])
                $.ajax({
                    url: base_url + 'api/sub_kategori/create',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    dataType: 'JSON',
                    success: function(data) {
                        if (data.status === true) {
                            $('#form_sub_kategori')[0].reset()
                                // tableSub_kategori.ajax.reload(null, false);
                            $('#tableSub_kategori')
                                .DataTable()
                                .ajax.reload(null, false)
                            Swal('Berhasil !', 'Sub Kategori Berhasil Di Buat.', 'success')
                        } else {
                            Swal('Opps!', 'Terjadi Kesalahan!.', 'error')
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        Swal('Opps!', errorThrown, 'error')
                    }
                })
            }
        })
    }
}

function edit_sub_kategori(id) {
    $.ajax({
        url: base_url + 'api/sub_kategori/getById/' + id,
        type: 'GET',
        dataType: 'JSON',
        success: function(data) {
            if (data.status == true) {
                $('input[name=id_sub_kategori]').val(data.result.id_sub_kategori)
                $('input[name=nama_sub]').val(data.result.nama_sub_kategori)
                $('select[name=category]').val(data.result.id_category)
                $('select[name=status]').val(data.result.status)
                $('#btn_sub_kategori')
                    .attr('onclick', 'update_sub_kategori()')
                    .text('Update Data')
                    .attr('class', 'btn btn-danger pull-right')
            } else {
                Swal('Opps!', ' Terjadi Kesalahan!', 'error')
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            Swal('Opps!', errorThrown, 'error')
        }
    })
}

function update_sub_kategori() {
    var form_sub_kategori = $('#form_sub_kategori')
    if (form_sub_kategori.valid()) {
        Swal({
            title: 'Anda Yakin ?',
            text: 'Data Sub Kategori akan Di Update, proses ini tidak dapat dikembalikan!',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
        }).then(result => {
            if (result.value) {
                var formData = new FormData(form_sub_kategori[0])
                $.ajax({
                    url: base_url + 'api/sub_kategori/create',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    dataType: 'JSON',
                    success: function(data) {
                        if (data.status == true) {
                            $('#form_sub_kategori')[0].reset()
                            $('input[name=id_sub_kategori]').val('')
                            $('#tableSub_kategori')
                                .DataTable()
                                .ajax.reload(null, false)
                            $('.box-title').text('Tambah Data Sub Kategori')
                            $('#btn_sub_kategori')
                                .attr('onclick', 'save_sub_kategori()')
                                .text('Tambah Data')
                                .attr('class', 'btn btn-info pull-right')
                            Swal('Success!', 'Data Sub Kategori telah Di Update', 'success')
                        } else {
                            Swal('Opps!', 'Terjadi Kesalahan !', 'error')
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        Swal('Opps!', errorThrown, 'error')
                    }
                })
            }
        })
    }
}

function remove_sub_kategori(id) {
    Swal({
        title: 'Anda Yakin?',
        text: 'Data ini akan di hapus dan tidak dapat dikembalikan !',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes'
    }).then(result => {
        if (result.value) {
            $.ajax({
                url: base_url + 'api/sub_kategori/destroy/' + id,
                type: 'GET',
                dataType: 'JSON',
                success: function(data) {
                    if (data.status == true) {
                        $('#form_sub_kategori')[0].reset()
                            // tableSub_kategori.ajax.reload(null, false);
                        $('#tableSub_kategori')
                            .DataTable()
                            .ajax.reload(null, false)
                        Swal(
                            'Terhapus !',
                            'Data Sub Kategori Berhasil Di Hapus.',
                            'success'
                        )
                    } else {
                        Swal('Opps!', 'Terjadi Kesalahan!.', 'error')
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    Swal('Opps!', errorThrown, 'error')
                }
            })
        }
    })
}
/**
 * ======================================
 * End of SUB KATEGORI
 * ======================================
 */

/**
 * ======================================
 * KANWIL
 * ======================================
 */
function saveKanwil() {
    var formKanwil = $('#formKanwil')
    if (formKanwil.valid()) {
        Swal({
            title: 'Anda Yakin?',
            text: 'Proses Ini Tidak Dapat Dikembalikan!',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
        }).then(result => {
            if (result.value) {
                var formData = new FormData(formKanwil[0])
                $.ajax({
                    url: base_url + 'api/kanwil/create',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    dataType: 'JSON',
                    success: function(data) {
                        if (data.status == true) {
                            $('#formKanwil')[0].reset()
                            $('#tableKanwil')
                                .DataTable()
                                .ajax.reload(null, false)
                            Swal(
                                'Berhasil !',
                                'Data Jenis Kantor Wilayah Berhasil Di Buat.',
                                'success'
                            )
                        } else {
                            Swal('Opps!', 'Terjadi Kesalahan!.', 'error')
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        Swal('Opps!', errorThrown, 'error')
                    }
                })
            }
        })
    }
}

function editKanwil(id) {
    $.ajax({
        url: base_url + 'api/kanwil/getById/' + id,
        type: 'GET',
        dataType: 'JSON',
        success: function(data) {
            if (data.status == true) {
                $('input[name=id_kanwil]').val(data.result.id_kanwil)
                $('input[name=jenis]').val(data.result.jenis)
                $('select[name=status]').val(data.result.status)
                $('.box-title').text('Edit Jenis Kantor Wilayah ' + data.result.jenis)
                $('#btnKanwil')
                    .attr('onclick', 'updateKanwil()')
                    .text('Update Data')
                    .attr('class', 'btn btn-danger pull-right')
            } else {
                Swal('Opps!', 'Terjadi Kesalahan!.', 'error')
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            Swal('Opps!', errorThrown, 'error')
        }
    })
}

function updateKanwil() {
    var formKanwil = $('#formKanwil')
    if (formKanwil.valid()) {
        Swal({
            title: 'Anda Yakin?',
            text: 'Proses Ini Tidak Dapat Dikembalikan!',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
        }).then(result => {
            if (result.value) {
                var formData = new FormData(formKanwil[0])
                $.ajax({
                    url: base_url + 'api/kanwil/create',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    dataType: 'JSON',
                    success: function(data) {
                        if (data.status === true) {
                            $('#formKanwil')[0].reset()
                            $('input[name=id_kanwil]').val('')
                                // tableKanwil.ajax.reload(null, false);
                            $('#tableKanwil')
                                .DataTable()
                                .ajax.reload(null, false)
                            $('.box-title').text('Update Kanwil')
                            $('#btnKanwil')
                                .attr('onclick', 'saveKanwil()')
                                .text('Tambah Data')
                                .attr('class', 'btn btn-info pull-right')
                            Swal(
                                'Berhasil !',
                                'Data Jenis Kantor Wilayah Berhasil di Update.',
                                'success'
                            )
                        } else {
                            Swal('Opps!', 'Terjadi Kesalahan!.', 'error')
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        Swal('Opps!', errorThrown, 'error')
                    }
                })
            }
        })
    }
}

function removeKanwil(id) {
    Swal({
        title: 'Anda Yakin?',
        text: 'Proses Ini Tidak Dapat Dikembalikan!',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes'
    }).then(result => {
        if (result.value) {
            $.ajax({
                url: base_url + 'api/kanwil/destroy/' + id,
                type: 'GET',
                dataType: 'JSON',
                success: function(data) {
                    if (data.status == true) {
                        $('#formKanwil')[0].reset()
                            // tableKanwil.ajax.reload(null, false);
                        $('#tableKanwil')
                            .DataTable()
                            .ajax.reload(null, false)
                        Swal('Terhapus !', 'Data Jenis Kantor Wilayah Terhapus.', 'success')
                    } else {
                        Swal('Opps!', 'Terjadi Kesalahan!.', 'error')
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    Swal('Opps!', errorThrown, 'error')
                }
            })
        }
    })
}
/**
 * ======================================
 * End of KANWIL
 * ======================================
 */

/**
 * ======================================
 * SUB KANWIL
 * ======================================
 */
function save_sub_kanwil() {
    var form_sub_kanwil = $('#form_sub_kanwil')
    if (form_sub_kanwil.valid()) {
        Swal({
            title: 'Anda Yakin?',
            text: 'Proses Ini Tidak Dapat Dikembalikan!',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
        }).then(result => {
            if (result.value) {
                var formData = new FormData(form_sub_kanwil[0])
                $.ajax({
                    url: base_url + 'api/sub_kanwil/create',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    dataType: 'JSON',
                    success: function(data) {
                        if (data.status === true) {
                            $('#form_sub_kanwil')[0].reset()
                                // table_subKanwil.ajax.reload(null, false);
                            $('#table_subKanwil')
                                .DataTable()
                                .ajax.reload(null, false)
                            Swal(
                                'Berhasil !',
                                'Data Kantor Wilayah Berhasil DiBuat.',
                                'success'
                            )
                        } else {
                            Swal('Oops!', 'Ada Kesalahan!', 'error')
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        Swal('Oops!', errorThrown, 'error')
                    }
                })
            }
        })
    }
}

function edit_sub_kanwil(id) {
    $.ajax({
        url: base_url + 'api/sub_kanwil/getById/' + id,
        type: 'GET',
        dataType: 'JSON',
        success: function(data) {
            if (data.status == true) {
                $('input[name=id_sub_kanwil]').val(data.result.id_sub_kanwil)
                $('select[name=jenis').val(data.result.id_kanwil)
                $('input[name=nama_cabang]').val(data.result.nama_cabang)
                $('input[name=alamat]').val(data.result.alamat)
                $('input[name=region').val(data.result.region)
                $('.box-title').text('Edit Data ' + data.result.nama_cabang)
                $('#btn_sub_kanwil')
                    .attr('onclick', 'update_sub_kanwil()')
                    .text('Update Data')
                    .attr('class', 'btn btn-danger pull-right')
            } else {
                Swal('Oops!', ' Terjadi Kesalahan!', 'error')
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            Swal('Opps!', errorThrown, 'error')
        }
    })
}

function update_sub_kanwil() {
    var form_sub_kanwil = $('#form_sub_kanwil')
    if (form_sub_kanwil.valid()) {
        Swal({
            title: 'Anda Setuju?',
            text: 'Proses ini tidak dapat dikembalikan',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
        }).then(result => {
            if (result.value) {
                var formData = new FormData(form_sub_kanwil[0])
                $.ajax({
                    url: base_url + 'api/sub_kanwil/create',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    dataType: 'JSON',
                    success: function(data) {
                        if (data.status == true) {
                            $('#form_sub_kanwil')[0].reset()
                            $('input[name=id_sub_kanwil]').val('')
                                // table_subKanwil.ajax.reload(null, false);
                            $('#table_subKanwil')
                                .DataTable()
                                .ajax.reload(null, false)
                            $('.box-title').text('Tambah Data Kantor Wilayah')
                            $('#btn_sub_kanwil')
                                .attr('onclick', 'save_sub_kanwil()')
                                .text('Tambah Data')
                                .attr('class', 'btn btn-info pull-right')
                            Swal('Berhasil!', 'Data Berhasil Di Update!', 'success')
                        } else {
                            Swal('Oops!', 'Terjadi Kesalahan', 'error')
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        Swal('Oops!', errorThrown, 'error')
                    }
                })
            }
        })
    }
}

function remove_sub_kanwil(id) {
    Swal({
        title: 'Anda Setuju?',
        text: 'Proses ini tidak dapat dikembalikan!',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes'
    }).then(result => {
        if (result.value) {
            $.ajax({
                url: base_url + 'api/sub_kanwil/destroy/' + id,
                type: 'GET',
                dataType: 'JSON',
                success: function(data) {
                    if (data.status == true) {
                        $('#form_sub_kanwil')[0].reset()
                            // table_subKanwil.ajax.reload(null, false);
                        $('#table_subKanwil')
                            .DataTable()
                            .ajax.reload(null, false)
                        Swal('Terhapus !', 'Data Cabang Berhasil Dihapus', 'success')
                    } else {
                        Swal('Oops!', 'Terjadi Kesalahan!', 'error')
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    Swal('Oops!', errorThrown, 'error')
                }
            })
        }
    })
}
/**
 * ======================================
 * End of SUB KANWIL
 * ======================================
 */

/**
 * ======================================
 * USER
 * ======================================
 */
function saveUsers() {
    var formUsers = $('#formUsers')
    if (formUsers.valid()) {
        Swal({
            title: 'Anda Yakin?',
            text: 'Proses Ini Tidak Dapat Dikembalikan!',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
        }).then(result => {
            if (result.value) {
                var formData = new FormData(formUsers[0])
                $.ajax({
                    url: base_url + 'api/users/create',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    dataType: 'JSON',
                    success: function(data) {
                        if (data.status === true) {
                            $('#formUsers')[0].reset()
                                // tableUsers.ajax.reload(null, false);
                            $('#tableUsers')
                                .DataTable()
                                .ajax.reload(null, false)
                            Swal('Berhasil !', 'Data User Berhasil Di Tambahkan.', 'success')
                        } else {
                            Swal('Opps!', 'Terjadi Kesalahan!.', 'error')
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        Swal('Opps!', errorThrown, 'error')
                    }
                })
            }
        })
    }
}

function editUsers(id) {
    $.ajax({
        url: base_url + 'api/users/getById/' + id,
        type: 'GET',
        dataType: 'JSON',
        success: function(data) {
            if (data.status == true) {
                $('input[name=password]').prop('required', false)
                $('input[name=re_password]').prop('required', false)
                $('input[name=id_users]').val(data.result[0].users.id)
                $('input[name=username]').val(data.result[0].users.username)
                $('input[name=email]').val(data.result[0].users.email)
                $('input[name=first_name]').val(data.result[0].users.first_name)
                $('input[name=last_name]').val(data.result[0].users.last_name)
                $('select[name=access]').val(data.result[1].access.id)
                $('select[name=status]').val(data.result[0].users.active)
                $('.box-title').text('Edit Users ' + data.result[0].users.username)
                $('#btnUsers')
                    .attr('onclick', 'updateUsers()')
                    .text('Update Users')
                    .attr('class', 'btn btn-danger pull-right')
            } else {
                Swal('Opps!', 'Terjadi Kesalahan!.', 'error')
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            Swal('Opps!', errorThrown, 'error')
        }
    })
}

function updateUsers() {
    var formUsers = $('#formUsers')
    if (formUsers.valid()) {
        Swal({
            title: 'Anda Yakin?',
            text: 'Proses Ini Tidak Dapat Dikembalikan!',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
        }).then(result => {
            if (result.value) {
                var formData = new FormData(formUsers[0])
                $.ajax({
                    url: base_url + 'api/users/create',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    dataType: 'JSON',
                    success: function(data) {
                        if (data.status === true) {
                            $('#formUsers')[0].reset()
                            $('input[name=id]').val('')
                                // tableUsers.ajax.reload(null, false);
                            $('#tableUsers')
                                .DataTable()
                                .ajax.reload(null, false)
                            $('input[name=password]').prop('required', true)
                            $('input[name=re_password]').prop('required', true)
                            $('.box-title').text('Add Users')
                            $('#btnUsers')
                                .attr('onclick', 'saveUsers()')
                                .text('Add Users')
                                .attr('class', 'btn btn-info pull-right')
                            Swal('Berhasil !', 'Data User Berhasil Di Update.', 'success')
                        } else {
                            Swal('Opps!', 'Terjadi Kesalahan!.', 'error')
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        Swal('Opps!', errorThrown, 'error')
                    }
                })
            }
        })
    }
}

function removeUsers(id) {
    Swal({
        title: 'Anda Yakin?',
        text: 'Proses Ini Tidak Dapat Dikembalikan!',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes'
    }).then(result => {
        if (result.value) {
            $.ajax({
				url: base_url + 'api/users/destroy/' + id,
                type: 'GET',
                dataType: 'JSON',
                success: function(data) {
                    if (data.status == true) {
                        $('#formUsers')[0].reset()
                            // tableUsers.ajax.reload(null, false);
                        $('#tableUsers')
                            .DataTable()
                            .ajax.reload(null, false)
                        Swal('Terhapus !', 'Data User Telah Di Hapus.', 'success')
                    } else {
                        Swal('Opps!', 'Terjadi Kesalahan!.', 'error')
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    Swal('Opps!', errorThrown, 'error')
                }
            })
        }
    })
}
/**
 * ======================================
 * End of USER
 * ======================================
 */

/**
 * ======================================
 * LAPORAN
 * ======================================
 */

/**
 * =================================================================================================================
 * 										DETAIL LAPORAN
 * =================================================================================================================
 */
function detailLaporan(id) {
    $.ajax({
        url: base_url + 'api/laporan/getById/' + id,
        type: 'POST',
        dataType: 'JSON',
        success: function(data) {
            if (data.status == true) {
                // console.log(data);
                $('#nama').html(data.result.nama)
                $('#depart').html(data.result.depart)
                $('#nohp').html(data.result.nohp)
                $('#lokasi').html(data.result.lokasi)
                $('#alamat').html(data.result.alamat)
                $('#case_id').html(data.result.case_id)
                $('#tiket_btpn').html(data.result.tiket_btpn)
                    /**
                     * KATEGORI DAN SUB KATEGORI
                     */
                    // KATEGORI
                if (data.result.id_category == 1) {
                    var category = 'HARDWARE'
                } else if (data.result.id_category == 2) {
                    var category = 'SOFTWARE'
                } else {
                    var category = 'NULL'
                }
                $('#kategori').html(category)
                    // SUB KATEGORI
                if (data.result.id_category == 1) {
                    if (data.result.id_sub_kategori == 1) {
                        var sub_kategori = 'KERUSAKAN LCD'
                    } else if (data.result.id_sub_kategori == 3) {
                        var sub_kategori = 'IC POWER'
                    }
                } else {
                    if (data.result.id_sub_kategori == 2) {
                        var sub_kategori = 'RESET FIRMWARE (OS)'
                    } else if (data.result.id_sub_kategori == 4) {
                        var sub_kategori = 'APP FORCE STOP'
                    }
                }
                $('#sub_k').html(sub_kategori)

                $('#imei_prob').html(data.result.imei_problem)
                $('#sn_prob').html(data.result.sn_problem)
                $('#imei_rep').html(data.result.imei_replace)
                $('#sn_rep').html(data.result.sn_replace)
                if (data.result.status == 1) {
                    var status = 'Aktif'
                } else {
                    var status = 'Tidak aktif'
                }
                $('#status').html(status)
                $('.modal-title').text('Detail Laporan ')
                $('#modal_detailLaporan').modal('show')
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            Swal('Opps!', errorThrown, 'error')
        }
    })
}
/**======================================================================================================================= */
function saveLaporan() {
    var formLaporan = $('#formLaporan')
    if (formLaporan.valid()) {
        Swal({
            title: 'Anda Yakin ??',
            text: 'Proses Ini Tidak Dapat Dikembalikan!',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
        }).then(result => {
            if (result.value) {
                var formData = new FormData(formLaporan[0])
                $.ajax({
                    url: base_url + 'api/laporan/create',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    dataType: 'JSON',
                    success: function(data) {
                        if (data.status === true) {
                            $('#formLaporan')[0].reset()

                            Swal('Berhasil !', 'Ticket Berhasil DiBuat.', 'success').then(
                                () => {
                                    window.location = base_url + 'admin/laporan'
                                }
                            )
                        } else {
                            Swal('Opps!', 'Terjadi Kesalahan!.', 'error')
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        Swal('Opps!', errorThrown, 'error')
                    }
                })
            }
        })
    }
}

function removeLaporan(id) {
    Swal({
        title: 'Anda Setuju??',
        text: 'Proses Ini Tidak Dapat Dikembalikan!',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes'
    }).then(result => {
        if (result.value) {
            $.ajax({
                url: base_url + 'api/laporan/destroy/' + id,
                type: 'GET',
                dataType: 'JSON',
                success: function(data) {
                    if (data.status == true) {
                        $('#tableLaporan')
                            .DataTable()
                            .ajax.reload(null, false)
                        Swal('Terhapus !', 'Laporan Telah Dihapus.', 'success')
                    } else {
                        Swal('Opps!', 'Terjadi Kesalahan!.', 'error')
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    Swal('Opps!', errorThrown, 'error')
                }
            })
        }
    })
}

function editLaporan(id) {
    $.ajax({
        url: base_url + 'api/laporan/getById/' + id,
        type: 'GET',
        dataType: 'JSON',
        success: function(data) {
            if (data.status === true) {
                $('input[name=id_laporan]').val(data.result.id_laporan)
                $('input[name=nama]').val(data.result.nama)
                $('input[name=depart]').val(data.result.depart)
                $('input[name=nohp]').val(data.result.nohp)
                $('input[name=lokasi]').val(data.result.lokasi)
                $('input[name=alamat]').val(data.result.alamat)
                $('textarea[name=text]').val(data.result.text)
                $('input[name=case_id]').val(data.result.case_id)
                $('input[name=tiket_btpn]').val(data.result.tiket_btpn)
                $('select[name=category]').val(data.result.id_category)
                $('select[name=sub_kategori]').val(data.result.id_sub_kategori)
                $('input[name=imei_prob]').val(data.result.imei_problem)
                $('input[name=sn_prob]').val(data.result.sn_problem)
                $('input[name=imei_rep]').val(data.result.imei_replace)
                $('input[name=sn_rep]').val(data.result.sn_replace)
                    // $("#sub_kategori").html(data);
                $('select[name=status]').val(data.result.status)
                $('.modal-title').text('Edit Laporan ' + data.result.tiket_btpn)
                    // $('#modalLaporan').modal({
                    // 	backdrop: 'static',
                    // 	keyboard: false
                    // });
                $('#modalLaporan').modal('show')
            } else {
                Swal('Opps!', 'Terjadi Kesalahan!.', 'error')
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            Swal('Opps!', errorThrown, 'error')
        }
    })
}

function updateLaporan() {
    var formLaporan = $('#formLaporan')
    if (formLaporan.valid()) {
        Swal({
            title: 'Anda Yakin?',
            text: 'Proses Ini Tidak Dapat Dikembalikan!',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
        }).then(result => {
            if (result.value) {
                var formData = new FormData(formLaporan[0])
                $.ajax({
                    url: base_url + 'api/laporan/create',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    dataType: 'JSON',
                    success: function(data) {
                        if (data.status === true) {
                            $('#formLaporan')[0].reset()
                            $('input[name=id_laporan]').val('')
                            $('#tableLaporan')
                                .DataTable()
                                .ajax.reload(null, false)
                            $('.box-title').text('Add Laporan')
                            $('#btnLaporan')
                                .attr('onclick', 'saveLaporan()')
                                .text('Add Laporan')
                                .attr('class', 'btn btn-info pull-right')
                            Swal('Berhasil !', 'Data Berhasil Di Update!.', 'success')
                            $('#modalLaporan').modal('hide')
                        } else {
                            Swal('Opps!', 'Terjadi Kesalahan!.', 'error')
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        Swal('Opps!', errorThrown, 'error')
                    }
                })
            }
        })
    }
}
/**
 * ======================================
 * End of LAPORAN
 * ======================================
 */

/**
 * ======================================
 * LOB
 * ======================================
 */
function saveLob() {
    var formLob = $('#formLob')
    if (formLob.valid()) {
        Swal({
            title: 'Anda Yakin?',
            text: 'Proses Ini Tidak Dapat Dikembalikan!',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
        }).then(result => {
            if (result.value) {
                var formData = new FormData(formLob[0])
                $.ajax({
                    url: base_url + 'api/lob/create',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    dataType: 'JSON',
                    success: function(data) {
                        if (data.status == true) {
                            $('#formLob')[0].reset()
                            $('#tableLob')
                                .DataTable()
                                .ajax.reload(null, false)
                            Swal('Berhasil !', 'Project LOB Berhasil di Buat', 'success')
                        } else {
                            Swal('Oopss !', 'Terjadi Kesalahan', 'error')
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        Swal('Oopss !', errorThrown, 'error')
                    }
                })
            }
        })
    }
}

function removeLob(id) {
    Swal({
        title: 'Anda Yakin?',
        text: 'Proses Ini Tidak Dapat Dikembalikan!',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes'
    }).then(result => {
        if (result.value) {
            $.ajax({
                url: base_url + 'api/lob/destroy/' + id,
                type: 'GET',
                dataType: 'JSON',
                success: function(data) {
                    if (data.status == true) {
                        $('#formLob')[0].reset()
                            // tableKanwil.ajax.reload(null, false);
                        $('#tableLob')
                            .DataTable()
                            .ajax.reload(null, false)
                        Swal('Terhapus !', 'Project LOB Telah Terhapus.', 'success')
                    } else {
                        Swal('Opps!', 'Terjadi Kesalahan!.', 'error')
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    Swal('Opps!', errorThrown, 'error')
                }
            })
        }
    })
}

function editLob(id) {
    $.ajax({
        url: base_url + 'api/lob/getById/' + id,
        type: 'GET',
        dataType: 'JSON',
        success: function(data) {
            if (data.status == true) {
                $('input[name=id_lob]').val(data.result.id_lob)
                $('input[name=lob]').val(data.result.nama_lob)
                $('select[name=status]').val(data.result.status)
                $('.box-title').text('Edit Kategori LOB ' + data.result.nama_lob)
                $('#btnLob')
                    .attr('onclick', 'updateLob()')
                    .text('Update LOB')
                    .attr('class', 'btn btn-danger pull-right')
            } else {
                Swal('Oopss !', 'Terjadi Kesalahan !', 'error')
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            Swal('Oppss !', errorThrown, 'error')
        }
    })
}

function updateLob() {
    var formLob = $('#formLob')
    if (formLob.valid()) {
        Swal({
            title: 'Anda Yakin?',
            text: 'Proses Ini Tidak Dapat Dikembalikan!',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
        }).then(result => {
            if (result.value) {
                var formData = new FormData(formLob[0])
                $.ajax({
                    url: base_url + 'api/lob/create',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    dataType: 'JSON',
                    success: function(data) {
                        if (data.status == true) {
                            $('#formLob')[0].reset()
                            $('input[name=id_lob]').val()
                            $('#tableLob')
                                .DataTable()
                                .ajax.reload(null, false)
                            $('.box-title').text('Update Kategori LOB')
                            $('#btnLob')
                                .attr('onclick', 'saveLob()')
                                .text('Save')
                                .attr('class', 'btn btn-info pull-right')
                            Swal('Berhasil !', 'Project LOB Berhasil di Update', 'success')
                        } else {
                            Swal('Oopss !', 'Terjadi Kesalahan !', 'error')
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        Swal('Oopss !', errorThrown, 'error')
                    }
                })
            }
        })
    }
}
/**
 * ======================================
 * End of LOB
 * ======================================
 */

/**
 * ======================================
 * SERVICE
 * ======================================
 */
function saveService() {
    var formService = $('#formService')
    if (formService.valid()) {
        Swal({
            title: 'Anda Yakin?',
            text: 'Proses Ini Tidak Dapat Dikembalikan!',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
        }).then(result => {
            if (result.value) {
                var formData = new FormData(formService[0])
                $.ajax({
                    url: base_url + 'api/service/create',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    dataType: 'JSON',
                    success: function(data) {
                        if (data.status == true) {
                            $('#formService')[0].reset()
                            $('#tableService')
                                .DataTable()
                                .ajax.reload(null, false)
                            Swal('Berhasil !', 'Kategori Service Berhasil di Buat', 'success')
                        } else {
                            Swal('Oopss !', 'Terjadi Kesalahan', 'error')
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        Swal('Oopss !', errorThrown, 'error')
                    }
                })
            }
        })
    }
}

function removeService(id) {
    Swal({
        title: 'Anda Yakin?',
        text: 'Proses Ini Tidak Dapat Dikembalikan!',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes'
    }).then(result => {
        if (result.value) {
            $.ajax({
                url: base_url + 'api/service/destroy/' + id,
                type: 'GET',
                dataType: 'JSON',
                success: function(data) {
                    if (data.status == true) {
                        $('#formService')[0].reset()
                            // tableKanwil.ajax.reload(null, false);
                        $('#tableService')
                            .DataTable()
                            .ajax.reload(null, false)
                        Swal('Terhapus !', 'Data Jenis Kantor Wilayah Terhapus.', 'success')
                    } else {
                        Swal('Opps!', 'Terjadi Kesalahan!.', 'error')
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    Swal('Opps!', errorThrown, 'error')
                }
            })
        }
    })
}

function editService(id) {
    $.ajax({
        url: base_url + 'api/service/getById/' + id,
        type: 'GET',
        dataType: 'JSON',
        success: function(data) {
            if (data.status == true) {
                $('input[name=id_service]').val(data.result.id_service)
                $('input[name=service]').val(data.result.service)
                $('select[name=status]').val(data.result.status)
                $('.box-title').text('Edit Kategori Service ' + data.result.service)
                $('#btnService')
                    .attr('onclick', 'updateService()')
                    .text('Update')
                    .attr('class', 'btn btn-danger pull-right')
            } else {
                Swal('Oopss !', 'Terjadi Kesalahan !', 'error')
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            Swal('Oppss !', errorThrown, 'error')
        }
    })
}

function updateService() {
    var formService = $('#formService')
    if (formService.valid()) {
        Swal({
            title: 'Anda Yakin?',
            text: 'Proses Ini Tidak Dapat Dikembalikan!',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
        }).then(result => {
            if (result.value) {
                var formData = new FormData(formService[0])
                $.ajax({
                    url: base_url + 'api/service/create',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    dataType: 'JSON',
                    success: function(data) {
                        if (data.status == true) {
                            $('#formService')[0].reset()
                            $('input[name=id_service]').val()
                            $('#tableService')
                                .DataTable()
                                .ajax.reload(null, false)
                            $('.box-title').text('Update Kategori Service')
                            $('#btnService')
                                .attr('onclick', 'saveService()')
                                .text('Save')
                                .attr('class', 'btn btn-info pull-right')
                            Swal(
                                'Berhasil !',
                                'Kategori Service Berhasil di Update',
                                'success'
                            )
                        } else {
                            Swal('Oopss !', 'Terjadi Kesalahan !', 'error')
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        Swal('Oopss !', errorThrown, 'error')
                    }
                })
            }
        })
    }
}
/**
 * ======================================
 * End of SERVICE
 * ======================================*/

// =======================================================================================================
//									END OF CONFIGURATION
// =======================================================================================================

function saveDevice() {
    var formDevice = $('#formDevice')
    if (formDevice.valid()) {
        Swal({
            title: 'Anda Yakin?',
            text: 'Proses Ini Tidak Dapat Dikembalikan!',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
        }).then(result => {
            if (result.value) {
                var formData = new FormData(formDevice[0])
                $.ajax({
                    url: base_url + 'device/api/device/create',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    dataType: 'json',
                    success: function(data) {
                        if (data.status === true) {
                            $('#formDevice')[0].reset()
                            $('#tableDevice')
                                .DataTable()
                                .ajax.reload(null, false)
                            Swal('Berhasil !', 'Device berhasil ditambahkan', 'success')
                        } else {
                            Swal('Opps !', 'Terjadi Kesalahan !', 'error')
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        Swal('Opps !', errorThrown, 'error')
                    }
                })
            }
        })
    }
}

function editDevice(id) {
    $.ajax({
        url: base_url + 'device/api/device/getById/' + id,
        type: 'get',
        dataType: 'json',
        success: function(data) {
            if (data.status == true) {
                $('input[name=id_device]').val(data.result.id_device)
                $('input[name=nama_device]').val(data.result.nama_device)
                $('input[name=brand').val(data.result.brand)
                $('input[name=model]').val(data.result.model)
                $('input[name=sn]').val(data.result.sn)
                $('input[name=imei]').val(data.result.imei)
                $('select[name=nama_lob]').val(data.result.id_lob)
                $('select[name=jenis_service]').val(data.result.id_service)

                $('.box-title').text('Edit Device ' + data.result.brand + ' ' +
                    data.result.model +
                    ' Serial Number ' + data.result.sn)
                $('#btnService')
                    .attr('onclick', 'updateDevice()')
                    .text('Update Device')
                    .attr('class', 'btn btn-danger pull-right')
            } else {
                Swal('Opps!', 'Terjadi Kesalahan', 'error')
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            Swal('Opps!', errorThrown, 'error')
        }
    })
}

function updateDevice() {
    var formDevice = $('#formDevice')
    if (formDevice.valid()) {
        Swal({
            title: 'Anda Yakin?',
            text: 'Proses Ini Tidak Dapat Dikembalikan!',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
        }).then(result => {
            if (result.value) {
                var formData = new FormData(formDevice[0])
                $.ajax({
                    url: base_url + 'device/api/device/create/',
                    type: 'post',
                    data: formData,
                    processData: false,
                    contentType: false,
                    dataType: 'json',
                    success: function(data) {
                        if (data.status === true) {
                            $('formDevice')[0].reset()
                            $('input[name=id_device]').val('')
                            $('#tableDevice')
                                .DataTable()
                                .ajax.reload(null, false)
                            $('.box-tilte').text('Tambah Data Device')
                            $('#btnDevice')
                                .attr('onclick', 'saveDevice()')
                                .text('Tambah Device')
                                .attr('class', 'btn btn-info pull-right')
                            Swal('Success!', 'Device berhasil diupdate', 'success')
                        } else {
                            Swal('Opps!', 'Terajadi Kesalahan', 'error')
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        Swal('Opps!', errorThrown, 'error')
                    }
                })
            }
        })
    }
}

function removeDevice(id) {
    Swal({
        title: 'Anda Yakin?',
        text: 'Proses Ini Tidak Dapat Dikembalikan!',
        // icon : 'warning',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes'
    }).then(result => {
        if (result.value) {
            $.ajax({
                url: base_url + 'device/api/device/destroy/' + id,
                type: 'get',
                dataType: 'json',
                success: function(data) {
                    if (data.status == true) {
                        $('#formDevice')[0].reset()
                        $('#tableDevice')
                            .DataTable()
                            .ajax.reload(null, false)
                        Swal('Terhapus !', 'Data device berhasil dihapus', 'success')
                    } else {
                        Swal('Opps!', 'Terjadi Kesalahan !', 'error')
                    }
                }
            })
        }
    })
}

function saveDevice_type() {
    var formDevice_type = $('#formDevice_type')
    if (formDevice_type.valid()) {
        Swal({
            title: 'Anda Yakin?',
            text: 'Proses Ini Tidak Dapat Dikembalikan!',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
        }).then(result => {
            if (result.value) {
                var formData = new FormData(formDevice_type[0])
                $.ajax({
                    url: base_url + 'device/api/type/create',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    dataType: 'json',
                    success: function(data) {
                        if (data.status === true) {
                            $('#formDevice_type')[0].reset()
                            $('#tableDevice_type')
                                .DataTable()
                                .ajax.reload(null, false)
                            Swal('Berhasil !', 'Tipe Device telah ditambahkan', 'success')
                        } else {
                            Swal('Opps !', 'Terjadi Kesalahan !', 'error')
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        Swal('Opps !', errorThrown, 'error')
                    }
                })
            }
        })
    }
}

function editDevice_type(id) {
    $.ajax({
        url: base_url + 'device/api/type/getById/' + id,
        type: 'GET',
        dataType: 'json',
        success: function(data) {
            if (data.status == true) {
                $('input[name=id_dc]').val(data.result.id_dc)
                $('input[name=type]').val(data.result.device_type)
                $('select[name=status]').val(data.result.status)
                $('.box-title').text('Edit Tipe Device ' + data.result.device_type)
                $('#btnDevice_type')
                    .attr('onclick', 'updateDevice_type()')
                    .text('Update Device Type')
                    .attr('class', 'btn btn-danger pull-right')
            } else {
                Swal('Opps!', 'Terjadi Kesalahan !', 'error')
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            Swal('Opps!', errorThrown, 'error')
        }
    })
}

function updateDevice_type() {
    var formDevice_type = $('#formDevice_type')
    if (formDevice_type.valid()) {
        Swal({
            title: 'Anda Yakin?',
            text: 'Proses Ini Tidak Dapat Dikembalikan!',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
        }).then(result => {
            if (result.value) {
                var formData = new FormData(formDevice_type[0])
                $.ajax({
                    url: base_url + 'device/api/type/create',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    dataType: 'json',
                    success: function(data) {
                        if (data.status === true) {
                            $('#formDevice_type')[0].reset()
                            $('input[name=id_dc]').val('')
                            $('#tableDevice_type')
                                .DataTable()
                                .ajax.reload(null, false)
                            $('.box-title').text('Add Device Type')
                            $('#btnDevice_type')
                                .attr('onclick', 'saveDevice_type()')
                                .text('Add Device Type')
                                .attr('class', 'btn btn-info pull-right')
                            Swal('Success !', 'Tipe Device Telah Diupdate', 'success')
                        } else {
                            Swal('Opps !', 'Terjadi Kesalahan!', 'error')
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        Swal('Opps !', errorThrown, 'error')
                    }
                })
            }
        })
    }
}

function removeDevice_type(id) {
    Swal({
        title: 'Anda Yakin?',
        text: 'Proses Ini Tidak Dapat Dikembalikan!',
        // icon : 'warning',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes'
    }).then(result => {
        if (result.value) {
            $.ajax({
                url: base_url + 'device/api/type/destroy/' + id,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    if (data.status == true) {
                        $('#formDevice_type')[0].reset()
                            // tableSub_kategori.ajax.reload(null, false);
                        $('#tableDevice_type')
                            .DataTable()
                            .ajax.reload(null, false)
                        Swal('Terhapus !', 'Tipe device berhasil dihapus', 'success')
                    } else {
                        Swal('Opps!', 'Terjadi Kesalahan!.', 'error')
                    }
                }
            })
        }
    })
}

function saveDevice_brand() {
    var formDevice_brand = $('#formDevice_brand')
    if (formDevice_brand.valid()) {
        Swal({
            title: 'Anda Yakin?',
            text: 'Proses Ini Tidak Dapat Dikembalikan!',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
        }).then(result => {
            if (result.value) {
                var formData = new FormData(formDevice_brand[0])
                $.ajax({
                    url: base_url + 'device/api/brand/create/',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    dataType: 'json',
                    success: function(data) {
                        if (data.status === true) {
                            $('#formDevice_brand')[0].reset()
                            $('#tableDevice_brand')
                                .DataTable()
                                .ajax.reload(null, false)
                            Swal('Berhasil !', 'Brand Device Telah Ditambahkan', 'success')
                        } else {
                            Swal('Opps !', 'Terjadi Kesalahan !', 'error')
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        Swal('Opps !', errorThrown, 'error')
                    }
                })
            }
        })
    }
}

function editDevice_brand(id) {
    $.ajax({
        url: base_url + 'device/api/brand/getById/' + id,
        type: 'GET',
        dataType: 'json',
        success: function(data) {
            if (data.status == true) {
                $('input[name=id_brand]').val(data.result.id_brand)
                $('input[name=nama_brand]').val(data.result.nama_brand)
                $('select[name=status]').val(data.result.status)
                $('.box-title').text('Edit Brand ' + data.result.nama_brand)
                $('#btnDevice_brand')
                    .attr('onclick', 'updateDevice_brand()')
                    .text('Update Brand')
                    .attr('class', ' btn btn-danger pull-right')
            } else {
                Swal('Opps !', 'Terjadi Kesalahan !', 'error')
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            Swal('Opps !', errorThrown, 'error')
        }
    })
}

function updateDevice_brand() {
    var formDevice_brand = $('#formDevice_brand')
    if (formDevice_brand.valid()) {
        Swal({
            title: 'Anda Yakin?',
            text: 'Proses Ini Tidak Dapat Dikembalikan!',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
        }).then(result => {
            if (result.value) {
                var formData = new FormData(formDevice_brand[0])
                $.ajax({
                    url: base_url + 'device/api/brand/create',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    dataType: 'json',
                    success: function(data) {
                        if (data.status === true) {
                            $('#formDevice_brand')[0].reset()
                            $('input[name=id_brand]').val('')
                            $('#tableDevice_brand')
                                .DataTable()
                                .ajax.reload(null, false)
                            $('.box-title').text('Add Brand Brand')
                            $('#btnDevice_brand')
                                .attr('onclick', 'saveDevice_brand()')
                                .text('Add Brand')
                                .attr('class', 'btn btn-info pull-right')
                            Swal('Success !', 'Brand Telah Diupdate', 'success')
                        } else {
                            Swal('Opps !', 'Terjadi Kesalahan !', 'error')
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        Swal('Opps !', errorThrown, 'error')
                    }
                })
            }
        })
    }
}
