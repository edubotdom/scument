// Funciones de validación

	// Validación del formulario en cliente con Javascript (después de la validación de HTML5)
	function validateForm() {
		var noValidation = document.getElementById("#altaUsuario").novalidate;
		
		if (!noValidation){
			// Comprobar que la longitud de la contraseña es >=8, que contiene letras mayúsculas y minúsculas y números
			var error1 = passwordValidation();
	        
			var error2 = passwordConfirmation();
			
			var error3 = emailValidation();
	        
			return (error1.length==0) && (error2.length==0) && (error3.length==0);
		}
		else 
			return true;
	}
	
	// CORREO ELECTRÓNICO
	
	function emailValidation(){
		var email = document.getElementById("correo_electronico");
		var pwd = email.value;
		campo = event.target;
		var valid = true;

		// ya que JavaScript no tiene una función como PHP para válidar el correo se le da manualmente
		emailRegex = /^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;

		// Comprobamos que sea correcto dicha restricción
		valid = valid && emailRegex.test(campo.value);
				
		// Si no cumple las restricciones, devolvemos un error
		if(!valid){
			var error = "No se ha introducido un correo válido, por favor introduzca un correo válido.";
		}else{
			var error = "";
		}
	        email.setCustomValidity(error);
		return error;
	}
	
	function emailEmpty(){
		var email = document.getElementById("correo_electronico");
		var pwd = email.value;
		var valid = true;


		// Comprobamos que sea correcto dicha restricción
		valid = valid && (pwd.length!=0);
				
		// Si no cumple las restricciones, devolvemos un error
		if(!valid){
			var error = "No se ha introducido correo electrónico.";
		}else{
			var error = "";
		}
	        email.setCustomValidity(error);
		return error;
	}
	
	function emailColor(){
		var emailField = document.getElementById("correo_electronico");
		
		var type = "email_invalid";		//por defecto no hay email insertado, se muestra en amarillo
		
		if(emailEmpty()!=""){
			
			type = "no_email";			// no hay email insertado, se muestra en amarillo
			
		} else {
			
			if(emailValidation()!=""){
				
				type = "email_invalid";		// tiene algún error de validación, reporta un error y se pone en rojo
				
			} else {
				
				type = "email_valid";		// validación correcta, se muestra en verde
				
			}
			
		}
		
		
		
		emailField.className = type;
		
		return type;
	}
	
	
	
	
	// CONTRASEÑAS

	// Comprobar la restricciones del password y aplicar clases CSS mediante JQuery
	function passwordValidation(){
		var password = document.getElementById("contrasena");
		var pwd = password.value;
		var valid = true;

		// Comprobamos la longitud de la contraseña
		valid = valid && (pwd.length>=8);
		
		// Comprobamos si contiene letras mayúsculas, minúsculas y números
		var hasNumber = /\d/;
		var hasUpperCases = /[A-Z]/;
		var hasLowerCases = /[a-z]/;
		valid = valid && (hasNumber.test(pwd)) && (hasUpperCases.test(pwd)) && (hasLowerCases.test(pwd));
		
		// Si no cumple las restricciones, devolvemos un error
		if(!valid){
			var error = "La contraseña tiene que poseer 8 caractéres incluyendo Mayúsculas, Minúsculas y Números";
		}else{
			var error = "";
		}
	        password.setCustomValidity(error);
		return error;
	}
	
	// Campos de contraseña y confirmación de contraseña iguales
	function passwordConfirmation(){
		// Obtenemos el campo de password y su valor
        var password = document.getElementById("contrasena");
		var pwd = password.value;
		// Obtenemos el campo de confirmación de password y su valor
		var passconfirm = document.getElementById("confirmcontrasena");
		var confirmation = passconfirm.value;

		// Los comparamos
		if (pwd != confirmation) {
			var error = "Introzduzca correctamente la contraseña en ambos campos.";
		}else{
			var error = "";
		}

		passconfirm.setCustomValidity(error);

		return error;
	}

	// Calcula la fortaleza de una contraseña: frecuencia de repetición de caracteres
	function passwordStrength(password){
    		// Creamos un Map donde almacenar las ocurrencias de cada carácter
    		var letters = {};

    		// Recorremos la contraseña carácter por carácter
    		var length = password.length;
    		for(x = 0, length; x < length; x++) {
        		// Consultamos el carácter en la posición x
        		var l = password.charAt(x);

        		// Si NO existe en el Map, inicializamos su contador a uno
        		// Si ya existía, incrementamos el contador en uno
        		letters[l] = (isNaN(letters[l])? 1 : letters[l] + 1);
    		}

    		// Devolvemos el cociente entre el número de caracteres únicos (las claves del Map)
		// y la longitud de la contraseña
    		return Object.keys(letters).length / length;
	}
	
	// Coloreado del campo de contraseña según su fortaleza
	function passwordColor(){
		var passField = document.getElementById("contrasena");
		var strength = passwordStrength(passField.value);
		
		if(!isNaN(strength)){
			var type = "weakpass";
			if(passwordValidation()!=""){
				type = "weakpass";
			}else if(strength > 0.7){
				type = "strongpass";
			}else if(strength > 0.4){
				type = "middlepass";
			}
		}else{
			type = "nanpass";
		}
		passField.className = type;
		
		return type;
	}
	