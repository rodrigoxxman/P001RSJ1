<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>CRM</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
 
 <style>
   .container{
    padding: 0.5%;
   } 
   table {
    display: block;
    overflow-x: auto;
    white-space: nowrap;
    }
</style>
</head>
<body>
 

<div class="container">
    <h2 style="margin-top: 12px;" class="alert alert-success">Registra Oportunidades</h2><br>
    <div class="row">
        <div class="col-12">
          <a href="javascript:void(0)" class="btn btn-success mb-2" id="create-new-user">Oportunidad +</a> 
          



          <table  class="table table-bordered" id="crm">
           <thead>
              <tr>
                <th>Cliente</th>
                <th>Empresa</th>
                <th>Oportunidad</th>
                <th>FechaOportunidad</th>
                <th>FechaCierre</th>
                <th>MustWin</th>
                <th>Monto$</th>
                <th>%Win</th>
                <th>Avance</th>
                <th>Ponderado</th>
                <th>Funnel</th>
                
                
                <th>Vendedor</th>
                <th>Marca</th>
                <th>Costo</th>
                <th>Sector</th>
                <th>Industria</th>
                <th>Mayorista</th>
                <th>TipoVenta</th>
                <th>Area</th>
                <th>Solucion</th>
                <th>Tier</th>
                <th>Tamaño</th>
                <th>Relevante</th>
                <th>Mes</th>
                <th>Trimestre</th>
                <th>Prevendedor</th>
                <th>Registrados</th>
                <th>Codigo</th>
                <th>Facturado</th>
                <th>N° Factura</th>
                 <td colspan="2">Action</td>
              </tr>
           </thead>
           <tbody id="oportunidades-crm">
              @foreach($oportunidades as $o_info)
              <tr id="idoportunidad_{{ $o_info->idoportunidad }}">
                <td>{{ $o_info->cliente->Nombre }}</td>              
                <td>{{ $o_info->cliente->Empresa->Nombre }}</td>     
                <td>{{ $o_info->Nombre }}</td>                       
                <td>{{ $o_info->FechaOportunidad }}</td>             
                <td>{{ $o_info->FechaCierre }}</td>                  
                <td>{{ $o_info->MustWin }}</td>                      
                <td>{{ $o_info->MontoUSS }}</td>                     
                <td>{{ $o_info->PercentWin }}</td>                   
                <td>{{ $o_info->Avance }}</td>                       
                <td>{{ $o_info->Ponderado }}</td>                    
                <td>{{ $o_info->Funnel }}</td>                       
                <td>{{ $o_info->vendedor->Nombre }}</td>           
                <td>{{ $o_info->solucion->Marca }}</td>              
                <td>{{ $o_info->Costo }}</td>                        
                <td>{{ $o_info->cliente->Empresa->Sector }}</td>     
                <td>{{ $o_info->cliente->Empresa->Industria }}</td>  
                <td>{{ $o_info->Mayorista }}</td>            
                <td>{{ $o_info->TipoVenta }}</td>                    
                <td>{{ $o_info->solucion->Area }}</td>               
                <td>{{ $o_info->solucion->Solucion }}</td>           
                <td>{{ $o_info->cliente->Empresa->Tier }}</td>       
                <td>{{ $o_info->Tamano}}</td>                        
                <td>{{ $o_info->Relevante}}</td>                     
                <td>{{ $o_info->Mes }}</td>                          
                <td>{{ $o_info->Trimestre }}</td>                    
                <td>{{ $o_info->prevendedor->Nombre }}</td>              
                <td>{{ $o_info->Registrado }}</td>                   
                <td>{{ $o_info->Codigo }}</td>                       
                <td>{{ $o_info->Facturado }}</td>                    
                <td>{{ $o_info->NFac }}</td>                         

                 <td><a href="javascript:void(0)" id="edit-user" data-id="{{ $o_info->IdOportunidad }}" class="btn btn-info">Edit</a></td>
                 <td>
                  <a href="javascript:void(0)" id="delete-user" data-id="{{ $o_info->IdOportunidad }}" class="btn btn-danger delete-user">Delete</a></td>
              </tr>
              @endforeach
           </tbody>
          </table>
       </div> 
    </div>
</div> 
</body>


<script>
  $(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    /*  Cuando Hagas Click en oportunidades + */
    $('#create-new-user').click(function () {
        $('#btn-save').val("create-user");
        $('#userForm').trigger("reset");
        $('#userCrudModal').html("Add New User");
        $('#ajax-crud-modal').modal('show');
    });

   /* When click edit user */
    $('body').on('click', '#edit-user', function () {
      var user_id = $(this).data('id');
      $.get('ajax-crud/' + user_id +'/edit', function (data) {
         $('#userCrudModal').html("Edit User");
          $('#btn-save').val("edit-user");
          $('#ajax-crud-modal').modal('show');
          $('#user_id').val(data.id);
          $('#name').val(data.name);
          $('#email').val(data.email);
      })
   });
   //delete user login
    $('body').on('click', '.delete-user', function () {
        var user_id = $(this).data("id");
        confirm("Are You sure want to delete !");

        $.ajax({
            type: "DELETE",
            url: "{{ url('ajax-crud')}}"+'/'+user_id,
            success: function (data) {
                $("#user_id_" + user_id).remove();
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });   
  });

 if ($("#userForm").length > 0) {
      $("#userForm").validate({

     submitHandler: function(form) {

      var actionType = $('#btn-save').val();
      $('#btn-save').html('Sending..');
     
      $.ajax({
          data: $('#userForm').serialize(),
          url: "https://www.tutsmake.com/laravel-example/ajax-crud/store",
          type: "POST",
          dataType: 'json',
          success: function (data) {
              var user = '<tr id="user_id_' + data.id + '"><td>' + data.id + '</td><td>' + data.name + '</td><td>' + data.email + '</td>';
              user += '<td><a href="javascript:void(0)" id="edit-user" data-id="' + data.id + '" class="btn btn-info">Edit</a></td>';
              user += '<td><a href="javascript:void(0)" id="delete-user" data-id="' + data.id + '" class="btn btn-danger delete-user">Delete</a></td></tr>';
              
             
              if (actionType == "create-user") {
                  $('#users-crud').prepend(user);
              } else {
                  $("#user_id_" + data.id).replaceWith(user);
              }

              $('#userForm').trigger("reset");
              $('#ajax-crud-modal').modal('hide');
              $('#btn-save').html('Save Changes');
             
          },
          error: function (data) {
              console.log('Error:', data);
              $('#btn-save').html('Save Changes');
          }
      });
    }
  })
}
  
 
</script>


</html>









<div class="modal fade" id="ajax-crud-modal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" id="userCrudModal"></h4>
        </div>
        <div class="modal-body">
            <form id="userForm" name="userForm" class="form-horizontal">
               <input type="hidden" name="user_id" id="user_id">
                <div class="form-group">
                    <label for="name" class="col-sm-2 control-label">Name</label>
                    <div class="col-sm-12">
                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" value="" maxlength="50" required="">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Email</label>
                    <div class="col-sm-12">
                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email" value="" required="">
                    </div>
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-primary" id="btn-save" value="create">Save changes
            </button>
        </div>
    </div>
  </div>
</div>