//MOSTRAR DATOS PUNTO DE CONTROL EN EL MODAL

function modal(id,nombre,objetivo,id_objetivo){



   $('#idControlActulizar').val(id);
   $('#controlActualizar').val(nombre);
   $('#modificarObjetivo').val(id_objetivo);
   $('#optobjetivo').val(objetivo);

              
   $('#actualizarControlModal').modal('toggle');
}


   $("#tabla-items-ronda").on("click", ".del", function(){
      $(this).parents("tr").remove();
   });



   function guardarControl(){

      let dataRonda = [];

      $('#tabla-items-ronda tbody tr td:nth-child(2)').each(function () {
         idControl = ($(this).text());
         let fila = {
            nombreRonda: $('#nombreRonda').val(),
            idCliente: $('#clienteRonda').val(),
            idControl: idControl,
            
         };
         dataRonda.push(fila);
        }); 

        $.ajax({
         type : 'post',
         cache: false,
         url : '../ronda/guardoronda',
         data : {ronda:dataRonda
                 },
         success : function(data){
               if(data){
                  alert ("Ronda cargada exitosamente");
               }else{
                  alert("Error al generar la ronda");
               }
            }
         });


        
   }




//ELIMINA CONTROL

function eliminarControl(id){

   var id_control = id;

   $.ajax({
   type : 'post',
   cache: false,
   url : './puntocontrol/eliminacontrol', //Here you will fetch records 
   data : {id:id_control
           }, 
   success : function(data){
      alert ("Control eliminado correctamente");
      },
   error: function(data) { 
         alert("Error al eliminar el control");
     }       
   });

}


 $(document).ready(function() {   

/**************************** COMIENZA SCRIPTS DE PUNTOS DE CONTROL ************************************/   

   //LOGUEAMOS AL USUARIO

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

   //CARGA OBJETIVOS SEGUN CLIENTE SELECCIONADO      
      $('.clienteControl').change(function(){
        
         var idcliente = $('#cliente').val();

         $.ajax({
            type : 'post',
            cache: false,
            dataType: "json",
            url : './puntocontrol/listarobjetivo', //Here you will fetch records 
            data : {  id:idcliente,
                    }, 
            success : function(data){
                  for (var i = 0; i < data.length; i++) {
                     $("#objetivo").append("<option value=" + data[i].codigo_objetivo + ">" + data[i].nombre_objetivo + "</option>"),
                     $("#modificarObjetivo").append("<option value=" + data[i].codigo_objetivo + ">" + data[i].nombre_objetivo + "</option>")
                 }   
               }
            });
         
      })

   //LLENAMOS LA TABLA CON LOS CONTROLES DEL CLIENTE SELECCIONADO   
      $('.objetivoCliente').change(function(){
        
         var idcliente = $('#cliente').val();
         var objetivocliente = $('#objetivo').val();

         console.log(objetivocliente);

         $.ajax({
            type : 'post',
            cache: false,
            dataType: "json",
            url : './puntocontrol/tablacontrolCliente', //Here you will fetch records 
            data : {  id_cliente:idcliente,
                      id_objetivo:objetivocliente  
                    }, 
            success : function(data){
                  for (var i = 0; i < data.length; i++) {
                     var datos = data[i].id+",'"+data[i].nombre+"','"+data[i].objetivo+"',"+data[i].id_objetivo;
                     $("#tabla-control").append('<tr> \
                     <td>'+data[i].id+'</td> \
                     <td>'+data[i].nombre+'</td> \
                     <td>'+data[i].objetivo+'</td>\
                     <td><button onclick="modal('+datos+')">Editar</button></td>\
                     <td><button onclick="eliminarControl('+datos+')">Eliminar</button></td>\
                 </tr>');
                 }   
               }
            });
         
      });
     
      
   //MOSTRAR NOMBRE CONTROL y SUS BOTONES

      $('.agregarControl').on('click',function(e){
         e.preventDefault();
         document.getElementById("nombreControl").style.display = "inline-flex";
         document.getElementById("guardarControlbtn").style.display = "inline-flex";
         document.getElementById("cancelarCargaControlbtn").style.display = "inline-flex";
         document.getElementById("agregarControl").style.display = "none";
         
      });

      $('.cancelarCarga').on('click',function(e){
         e.preventDefault();
         document.getElementById("nombreControl").style.display = "none";
         document.getElementById("guardarControlbtn").style.display = "none";
         document.getElementById("cancelarCargaControlbtn").style.display = "none";
         document.getElementById("nombre-punto-control").value = '';
         document.getElementById("agregarControl").style.display = "inline-flex";
         
      });

   //ALTA NUEVO CONTROL  

      $('.guardarControl').on('click',function(){
         var idcliente = $('#cliente').val();
         var nombre = $('#nombre-punto-control').val();
         var codigo_objetivo = $('#objetivo option:selected').val();
         var nombre_objetivo = $('#objetivo option:selected').text();

              $.ajax({
              type : 'post',
              cache: false,
              url : './puntocontrol/cargacontrol', //Here you will fetch records 
              data : {  id:idcliente,
                        nombre:nombre,
                        id_objetivo:codigo_objetivo,
                        objetivo:nombre_objetivo 
                      }, 
              success :  function(data){
            alert("Punto de control guardado exitosamente");
            location.reload();
            }
              });
      });

   
   
   //CARGAR CONTROL EDITADO

   $('.modificarControl').on('click',function(e){
      e.preventDefault(); 

      var id = $('#idControlActulizar').val();
      var nombre = $('#controlActualizar').val();
      var id_objetivo = $('#modificarObjetivo').val();
      var objetivo = $('#modificarObjetivo option:selected').text();
   
      $.ajax({
      type : 'post',
      cache: false,
      url : './puntocontrol/actualizacontrol', //Here you will fetch records 
      data : { id:id,
               nombre:nombre,
               id_objetivo:id_objetivo,
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

   /**************************** FINALIZA SCRIPTS DE PUNTOS DE CONTROL ************************************/



/**************************** COMIENZA SCRIPTS DE RONDA ************************************/

   //CARGAMOS EL SELECT DE PUNTOS DE CONTROL SEGUN EL CLIENTE SELECCIONADO
      $('.clienteRonda').change(function(){
            
         var idcliente = $('#clienteRonda').val();

        // console.log(idcliente);

         $.ajax({
            type : 'post',
            cache: false,
            dataType: "json",
            url : './ronda/puntoscontrolCliente',
            data : {  id_cliente:idcliente,
                  }, 
            success : function(data){
                  for (var i = 0; i < data.length; i++) {
                     $("#puntoControlCliente").append('<option value="'+data[i].id+'">'+data[i].nombre+'</option>');
               }  
               }
            });
         
      });

   //LLENAMOS LA TABLA DE ITEMS DE RONDA SEGUN LA SELECCION Y EL ORDEN 

   $('.agregarItem').on('click',function(e){ 

      var secuencia = $('#ordenItemRonda').val();
      var puntoControl = $('#puntoControlCliente option:selected').text();
      var idPuntoControl = $('#puntoControlCliente').val();

      console.log(idPuntoControl);

      document.getElementById("ordenItemRonda").value = '';
      document.getElementById("puntoControlCliente").value = '';

      $("#tabla-items-ronda").append('<tr> \
      <td id="secuencia">'+secuencia+'</td> \
      <td style="display: none">'+idPuntoControl+'</td> \
      <td value="'+idPuntoControl+'">'+puntoControl+'</td> \
      <td><button class="btn"><i class="del fa fa-times"></i></button></td>\
      </tr>');

      console.log(puntoControl,idPuntoControl);


   });



});



