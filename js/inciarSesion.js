	function mostrarLogin(){
		$("#login").load("mostrarLogin.php",{sesionn:sesion}, function(){
		});
	}
	
	function loguearse(){
		var recordar;
		var username = $("#userInput").val().trim();
		var password = $("#passInput").val().trim();
		if ($("#dropdownCheck2").is(":checked")){
			recordar='si';
		}else{
			recordar='no';
		}
		
		if( username != "" && password != "" ){
			$.ajax({
				url:'verificacion.php',
				type:'post',
				data:{usuario:username,pass:password,recordar:recordar},
				success:function(response){
				//alert(response);
				if(response == '1'){
					location.reload();
				}else{
					mostrarAlerta('Usuario o contraseña invalidos.');
				}
				}
			});
		}
	}