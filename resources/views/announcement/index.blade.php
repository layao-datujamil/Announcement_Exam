@extends('adminlte::page')

@section('title','Annoucement System | Announcement')

@section('plugins.Datatables',true)
@section('plugins.DatatablesPlugins',true)
@section('plugins.Sweetalert2',true)

@section('content_header')
    <h1>Announcements</h1>
@stop

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title">List of Announcements</h3>
            </div>
              <!-- /.card-header -->
            <div class="card-body">
                
                <table id="AnnouncementTable" class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Status</th>
                            <th>Action</th>
                            
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
               
            </div>
        </div>           
    </div>
</div> 
@stop

@section('js')
<script>
var deleteAnnouncement;

$(document).ready(function () {
    var Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
        });
    var AnnouncementTable = $('#AnnouncementTable').DataTable({
        "responsive":true,
        "lengthChange": true,
        "lengthMenu":[[10,25,50,-1],[10,25,50,'All']],
        "autoWidth": false,
        ajax: '{{ route('announcements.showall') }}',
        serverSide: true,
        processing: true,
        
        "columns": [
        { data: 'id',
            visible: false,
            searchable: false
        } ,
        { data: 'title' } ,
        { data: 'startdate' },
        { data: 'enddate'},
        { data: 'stat'},
        { data: 'action'}
        ],
        "initComplete": function() {
            AnnouncementTable.buttons().container().appendTo('#AnnouncementTable_wrapper .col-md-6:eq(0)');
            $("#AnnouncementTable").show();
        },
        "buttons": {
            buttons: [
               // { extend:"copy", className: 'btn btn-success'},
               // { extend:"csv", className:'btn btn-success' },
                {
                    className: 'btn btn-warning',
                    text: '<i class="fas fa-plus"></i>',
                    titleAttr: 'Create',
                    action: function(e, dt, node, config){
                        window.location = '{{route('announcements.create')}}';
                    }
                },
                { extend: "excel", className: 'btn btn-warning', text: '<i class="fas fa-file-excel"></i>',titleAttr: 'Export to Excel',
                    exportOptions: {
                        columns: [1,2,3,4]
                    }
                },
                { extend: "pdf", className: 'btn btn-warning', text: '<i class="fas fa-file-pdf"></i>',titleAttr: 'Export to PDF',
                    orientation: 'landscape',
                    download: 'open',
                    exportOptions: {
                        columns: [1,2,3,4]
                    },
                    customize: function (doc) {
                        doc.content[1].table.widths = 
                            Array(doc.content[1].table.body[0].length + 1).join('*').split('');
                    }
                },
                { extend: "print", className: 'btn btn-warning', text: '<i class="fas fa-print"></i>', titleAttr: 'Print',
                    exportOptions: {
                        columns: [1,2,3,4]
                    }
                },
                { extend: "colvis", className: 'btn btn-warning dropdown-toggle dropdown-icon', text:'', titleAttr: 'Column Visibility',columns: ':gt(0)'}
            ]
        }
        
    });
    deleteAnnouncement = function(index){
        Swal.fire({  
                title: 'Are you sure you want to delete the selected record?', 
                text: "You won't be able to revert this!",
                icon: 'warning', 
                showCancelButton: true,  
                confirmButtonText: `Yes`,  
                cancelButtonText: `No`,
                }).then((result) => {  
                    /* Read more about isConfirmed, isDenied below */ 
                     
                    if (result.value) {    
                        $.ajax({
                            url: '/announcements/' + index,
                            type: 'delete',
                            data: {
                                _token: '{{ csrf_token() }}'
                            },
                            success:  function(response){
                                if (response.success){
                                    Toast.fire({
                                        type:'success',
                                        title:response.success
                                    });
                                    $('#AnnouncementTable').DataTable().ajax.reload(null,false);
                                }else if(response.error){
                                    Toast.fire({
                                        type:'error',
                                        title:response.error
                                    });
                                }
                                
                            }
                        }); 
                    }
                });
       
   };

    @if (\Session::has('success'))
        Toast.fire({
            type:'success',
            title:"{{ \Session::get('success') }}"
        });
    @endif

    @if (\Session::has('error'))
        Toast.fire({
            type:'error',
            title:"{{ \Session::get('error') }}"
        });
    @endif
   

});


</script>
@stop

