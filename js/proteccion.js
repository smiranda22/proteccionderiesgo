
 $(document).ready(function() {   

      $('.envialogin').on('click',function(){
         var usuario = $('#usuario').val();
         var pass=$('#password').val();

              $.ajax({
              type : 'post',
              cache: false,
              url : '../login/getlogin', //Here you will fetch records 
              data : {usuario:usuario,
                      pass:pass
                      },
              success : function(data){
                 var datos = JSON.parse(data);
                 var cbte = datos['usuario'];
                 if(cbte==false){
                  $(".error_login").html("Usurio incorrecto");
                     }else{
                      location.href = "../puntocontrol"; 
                     }
                 }
              });
      });

      $('.clienteControl').change(function(){
        
         let idcliente = $('#cliente').val();

         console.log(typeof(idcliente));
         console.log(idcliente);

         $.ajax({
            type : 'post',
            cache: false,
            url : './puntocontrol/listarobjetivo', //Here you will fetch records 
            data : {  id:idcliente,
                    }, 
            success : function(data){
               JSON.parse(data);
                alert (data);
               }
            });
         
      })

//ALTA NUEVO CONTROL  

      $('.agregarControl').on('click',function(e){
         e.preventDefault();
         var idcliente = $('#cliente').val();
         var nombre = $('#nombreControl').val();
         var objetivo= $('#objetivo').val();


              $.ajax({
              type : 'post',
              cache: false,
              url : './puntocontrol/cargacontrol', //Here you will fetch records 
              data : {  id:idcliente,
                        nombre:nombre,
                        objetivo:objetivo
                      }, 
              success : function(data){
                  alert ("Control cargado correctamente");
                 }
              });
      });


//ELIMINA CONTROL

      $('.eliminarControl').on('click',function(e){
         e.preventDefault(); 
   
             var id = $(this).data('id');
   
                  $.ajax({
                  type : 'post',
                  cache: false,
                  url : './puntocontrol/eliminacontrol', //Here you will fetch records 
                  data : {id:id
                          }, 
                  success : function(data){
                     alert ("Control eliminado correctamente");
                     location.reload();
                     },
                  error: function(data) { 
                        alert("Error al eliminar el control"); 
                    }       
                  });
      });   
   
  
//MOSTRAR CONTROL EN MODAL

   $('.modalControl').on('click',function(e){
      e.preventDefault(); 

      var nombre=($(this).closest('tr').children('td.nombre').text());
      var objetivo=($(this).closest('tr').children('td.objetivo').text());
      var id=($(this).closest('tr').children('td.id').text());


      $('#idControlActulizar').val(id);
      $('#controlActualizar').val(nombre);
      $('#modificarObjetivo').children('option:first').text(objetivo);

                 
      $('#actualizarControlModal').modal('toggle');

   });

//CARGAR CONTROL EDITADO

   $('.modificarControl').on('click',function(e){
      e.preventDefault(); 

      var id = $('#idControlActulizar').val();
      var nombre = $('#controlActualizar').val();
      var objetivo = $('#modificarObjetivo').val();
   
      $.ajax({
      type : 'post',
      cache: false,
      url : './puntocontrol/actualizacontrol', //Here you will fetch records 
      data : { id:id,
               nombre:nombre,
               objetivo:objetivo
              }, 
      success : function(data){
         alert ("Control actualizado correctamente");
         location.reload();
         },
      error: function(data) { 
            alert("Error al actualizar el control"); 
        }       
      });


   });



   $("#agregarItem").click(function(){
		  
      //alert($("#descripcion").val());
      var ordenItem =$("#ordenItemRonda").val();
      var nombreItem = $("#nombreItemRonda").val();
      var descripcionRonda = $("#descripcionItemRonda").val();
      var clienteRonda = $("#clienteRonda").val();

      $.ajax({
         type : 'post',
         cache: false,
         url : './puntocontrol/cargaritem', //Here you will fetch records 
         data : { orden:ordenItem,
                  nombre:nombreItem,
                  descripcion:descripcionRonda,
                  cliente:clienteRonda
                 }, 
         success : function(data){

            },   
         });
      
      var nuevaFila="<tr> \
         <td>"+ordenItem+"</td> \
         <td>"+nombreItem+"</td> \
         <td>"+descripcionRonda+"</td> \
     </tr>";
        
    $("#tabla-items-ronda").append(nuevaFila);
  
    });

    $("#cargarRonda").click(function(){

      var nombreRonda = $("nombreRonda").val();
      var controlRonda = $("#controlRonda").val();

      $.ajax({
         type: 'post',
         cache: false,
         url: './puntocontrol/cargaRonda',
         data: {
               nombre:nombreRonda,
               pcRonda:controlRonda
         },
         success: function(data){
            
         },
      })


    })


    $('#cargarRonda').on('click',function(e){
      var cliente = $('#clienteRonda').val();
      var id_orden= new Array();
      var id_nombre =new Array();
      var id_descripcion= new Array();
      var orden=[];
      var nombre=[];
      var descripcion=[];

      $('#tabla-items-ronda tbody tr td:nth-child(1)').each(function () {
         id_orden.push($(this).text());
                      });
      $('#tabla-items-ronda tbody tr td:nth-child(2)').each(function () {
         id_nombre.push($(this).text());
         });
      $('#tabla-items-ronda tbody tr td:nth-child(3)').each(function () {
         id_descripcion.push($(this).text());
         });
                      
       orden = id_orden;
       nombre = id_nombre;
       descripcion = id_descripcion;
   
      $.ajax({
      type : 'post',
      cache: false,
      url : 'hhhhh', //Here you will fetch records 
      data : { 
            orden:orden,
            nombre:nombre,
            descripcion:descripcion,
            cliente:cliente
              }, 
      success : function(data){
         
         },
      error: function(data) { 
           // alert("Error al actualizar el control"); 
        }       
      });


   });

   ('#')

});



