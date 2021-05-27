@extends('adminlte::page')

@section('title','Annoucement System | User Profiles')

@section('plugins.Datatables',true)
@section('plugins.DatatablesPlugins',true)
@section('plugins.Sweetalert2',true)

@section('content_header')
    <h1>User Profiles</h1>
@stop

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title">List of Users with Access</h3>
            </div>
              <!-- /.card-header -->
            <div class="card-body">
                
                <table id="UsersTable" class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Actions</th>
                            
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
var deleteUser;

$(document).ready(function () {
    var Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
        });
    var UserTable = $('#UsersTable').DataTable({
        //dom: 'Blfrtip',
        "responsive":true,
        "lengthChange": true,
        "lengthMenu":[[10,25,50,-1],[10,25,50,'All']],
        "autoWidth": false,
        ajax: '{{ route('users.showall') }}',
        serverSide: true,
        processing: true,
        
        "columns": [
        { data: 'id',
            visible: false,
            searchable: false
        } ,
        { data: 'name' } ,
        { data: 'email' },
        { data: 'action'}
        ],
        "initComplete": function() {
            UserTable.buttons().container().appendTo('#UsersTable_wrapper .col-md-6:eq(0)');
            $("#UsersTable").show();
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
                        window.location = '{{route('users.create')}}';
                    }
                },
                { extend: "excel", className: 'btn btn-warning', text: '<i class="fas fa-file-excel"></i>',titleAttr: 'Export to Excel',
                    exportOptions: {
                        columns: [1,2]
                    }
                },
                { extend: "pdf", className: 'btn btn-warning', text: '<i class="fas fa-file-pdf"></i>',titleAttr: 'Export to PDF',
                    orientation: 'landscape',
                    download: 'open',
                    exportOptions: {
                        columns: [1,2]
                    },
                    customize: function (doc) {
                        doc.content[1].table.widths = 
                            Array(doc.content[1].table.body[0].length + 1).join('*').split('');
                    }
                },
                { extend: "print", className: 'btn btn-warning', text: '<i class="fas fa-print"></i>', titleAttr: 'Print',
                    exportOptions: {
                        columns: [1,2]
                    }
                },
                { extend: "colvis", className: 'btn btn-warning dropdown-toggle dropdown-icon', text:'', titleAttr: 'Column Visibility',columns: ':gt(0)'}
            ]
        }
        
    });
    deleteUser = function(index){
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
                            url: '/users/' + index,
                            type: 'delete',
                            data: {
                                _token: '{{ csrf_token() }}'
                            },
                            success:  function(response){
                                if (response.success){
                                    Toast.fire({
                                        icon:'success',
                                        title:response.success
                                    });
                                    $('#UsersTable').DataTable().ajax.reload(null,false);
                                }else if(response.error){
                                    Toast.fire({
                                        icon:'error',
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
   

});


</script>
@stop

