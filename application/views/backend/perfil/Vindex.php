
<script>
$(document).ready(function(){
 	
   $("#cambiarPassword").click(function(){     
        $(".pages").load("../menu/Cmenu/cambiarPassword");
    });
   $("#cambiarAvatar").click(function(){     
        $(".pages").load("../menu/Cmenu/cambiarAvatar");
    });
});

</script>

<style>
.espacios{

}

.perfil_datos{
  border:1px solid black;
  padding: 5px;
  margin-top: 5px;
}

.btn-primary{
	background-color: #9AC835;
}

</style>

<div class="perfil">
	<div class="row line ">
		    <div class="col-md-3 espacios">
                                    
              <span class="input__label-content">Nombres</span>
        	  
        </div>

        <div class="col-md-3 espacios">
           	
            <span class="input__label-content"><?php echo $perfil[0]->nombres; ?></span>
          	
        </div>

        <div class="col-md-3 espacios">
            
                <span class="input__label-content">Apellidos</span>
        	
        </div>
        <div class="col-md-3 espacios">
          
                <span class="input__label-content"><?php echo $perfil[0]->apellidos; ?></span>
          
        </div>
	</div>
	
	<div class="row line">
		<div class="col-md-3">
                           
               
                <span class="input__label-content">Direccion</span>
        
          
            </div>
            <div class="col-md-3">
                           
                
                <span class="input__label-content"><?php echo $perfil[0]->direccion ; ?></span>
               
        
        </div>
        <div class="col-md-3">
                         
                
                <span class="input__label-content">DUI</span>
                
           
            </div>
            <div class="col-md-3">
                            
                
                <span class="input__label-content"><?php echo $perfil[0]->dui; ?></span>
                
        	
        </div>
	</div>

	<div class="row line">
		<div class="col-md-3">
                              
                
                  <span class="input__label-content">Telefono</span>
                
            
            </div>
            <div class="col-md-3">
                       
                
                  <span class="input__label-content"><?php echo $perfil[0]->telefono; ?></span>
                
           
            </div>
            <div class="col-md-3">
                          
                 
                  <span class="input__label-content">Celular</span>
                 
             
            </div>
            <div class="col-md-3">
                       
                 
                  <span class="input__label-content"><?php echo $perfil[0]->celular; ?></span>
                 
             
            </div>
	</div>

	<div class="row line">
		<div class="col-md-3">
                           
               
                <span class="input__label-content">Fecha Creacion</span>
               
        	
        </div>
        <div class="col-md-3">
          	               
              
              	<span class="input__label-content"><?php echo $perfil[0]->fecha_creacion; ?></span>
              
            
        </div>
        <div class="col-md-3">
                        
               
                <span class="input__label-content">Cargo</span>
               
        	
        </div>
        <div class="col-md-3">
          	                
              
              	<span class="input__label-content"><?php echo $perfil[0]->nombre_cargo; ?></span>
              
            	
        </div>
	</div>

  <div class="row line">
    <div class="col-md-3">
      Cambiar password <a href='#' class="btn btn-primary" id="cambiarPassword">aqui</a>
    </div>
    <div class="col-md-3">
      Cambiar Avatar <a href='#' class="btn btn-primary" id="cambiarAvatar">aqui</a>
    </div>
  </div>
</div>




