// Detecta si el formulario es de registro o de inicio de sesión y aplica lógica correspondiente
document.addEventListener('DOMContentLoaded', function() {
    var formRegistro = document.querySelector('.formregistro');
    var formLogin = document.querySelector('.formlogin');

    if (formRegistro) {
        console.log("formulario de registro")
        var emailField = document.getElementById('email');
        var passwordField = document.getElementById('password');
        var passwordField2 = document.getElementById('password2');
    
        var form = document.getElementById('registerForm');
        var emailError = document.getElementById('emailError');
        var contrasenaError = document.getElementById('passwordError');
        var contrasena2Error = document.getElementById('password2Error');
    
        const patronEmail = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/; // Patrón del correo electrónico
        const patronContrasena = /^(?=.*\d)(?=.*[A-Z])[0-9a-zA-Z]{8,}$/; // Al menos 1 número, 1 mayúscula, mínimo 8 caracteres
    
    
        contrasenaError.innerHTML = "";
        contrasena2Error.innerHTML = "";
    
        // Validaciones email
        emailField.addEventListener('keyup', function() {
            const email = emailField.value;
        if (email === "") {
            emailError.innerHTML = "Ingresa un correo electrónico.";
            emailField.style.borderColor = '#187786';
        } else if (!patronEmail.test(email)) {
            emailError.innerHTML = "El email no es válido, debe estar escrito con la siguiente pauta: ejemplo@ejemplo.com";
            emailField.style.borderColor = '#187786';
        } else {
            emailError.innerHTML = "";
            emailField.style.borderColor = '#CCCCCC';
        }
        });
    
        // Validaciones contraseña
        passwordField.addEventListener('keyup', function(){
            const contrasena = passwordField.value;
        if (contrasena === "") {
            contrasenaError.innerHTML = "Ingresa una contraseña.";
            passwordField.style.borderColor = '#187786';
        } else if (!patronContrasena.test(contrasena)) {
            contrasenaError.innerHTML = "La contraseña debe tener al menos 1 número, 1 mayúscula y mínimo 8 carácteres.";
            passwordField.style.borderColor = '#187786';
        } else {
            contrasenaError.innerHTML = "";
            passwordField.style.borderColor = '#CCCCCC';
            
        }
        });
    
        passwordField2.addEventListener('keyup', function() {
            const contrasena = passwordField.value;
            const contrasena2 = passwordField2.value;
    
            if (contrasena2 === "") {
                contrasena2Error.innerHTML = "Ingresa la anterior contraseña.";
                passwordField2.style.borderColor = '#187786';
            } else if (contrasena !== contrasena2) {
                contrasena2Error.innerHTML = "Las contraseñas no coinciden.";
                passwordField2.style.borderColor = '#187786';
            } else {
                contrasena2Error.innerHTML = "";
                passwordField2.style.borderColor = '#CCCCCC';
            }
        });
    
    
        form.addEventListener('submit', function(event) {
            const email = emailField.value.trim();
            const contrasena = passwordField.value.trim();
            const contrasena2 = passwordField2.value.trim();
    
            // Restablecer los mensajes de error
            emailError.innerHTML = "";
            contrasenaError.innerHTML = "";
            contrasena2Error.innerHTML = "";
    
            // Validaciones email
            if (email === "") {
                emailError.innerHTML = "Ingresa un correo electrónico.";
                emailField.style.borderColor = '#187786';
                event.preventDefault();
            } else if (!patronEmail.test(email)) {
                emailError.innerHTML = "El email no es válido, debe estar escrito con la siguiente pauta: ejemplo@ejemplo.com";
                emailField.style.borderColor = '#187786';
                event.preventDefault();
            }
    
            // Validaciones contraseña
            if (contrasena === "") {
                contrasenaError.innerHTML = "Ingresa una contraseña.";
                passwordField.style.borderColor = '#187786';
                event.preventDefault();
            } else if (!patronContrasena.test(contrasena)) {
                contrasenaError.innerHTML = "La contraseña debe tener al menos 1 número, 1 mayúscula y mínimo 8 caracteres.";
                passwordField.style.borderColor = '#187786';
                event.preventDefault();
            }
    
            // Validación de las contraseñas coincidentes
            if (contrasena2 === "") {
                contrasena2Error.innerHTML = "Ingresa la contraseña nuevamente.";
                passwordField2.style.borderColor = '#187786';
                event.preventDefault();
            } else if (contrasena !== contrasena2) {
                contrasena2Error.innerHTML = "Las contraseñas no coinciden.";
                passwordField2.style.borderColor = '#187786';
                event.preventDefault();
            }
        });
    
    }

    if (formLogin) {
        console.log("formulario de inicio de sesion")

        var emailField = document.getElementById('email');
        var passwordField = document.getElementById('password');
        var form = document.getElementById('loginForm');
        var emailError = document.getElementById('emailError')
        var email = document.getElementById("email").value;

        const patronEmail = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/; // Formato de email

        // Validaciones email
        emailField.addEventListener('blur', function() {
            const email = emailField.value;
        if (email === "") {
            emailError.innerHTML = "Ingresa un correo electrónico.";
            emailField.style.borderColor = '#187786';
        } else if (!patronEmail.test(email)) {
            emailError.innerHTML = "El email no es válido, debe estar escrito con la siguiente pauta: ejemplo@ejemplo.com";
            emailField.style.borderColor = '#187786';
        } else {
            emailError.innerHTML = "";
        }
        });



        form.addEventListener('submit', function(event) {
                const email = emailField.value.trim();
                // Restablecer los mensajes de error
                emailError.innerHTML = "";
                contrasenaError.innerHTML = "";
                // Validaciones email
                if (email === "") {
                    emailError.innerHTML = "Ingresa un correo electrónico.";
                    emailField.style.borderColor = '#187786';
                    event.preventDefault();
                } else if (!patronEmail.test(email)) {
                    emailError.innerHTML = "El email no es válido, debe estar escrito con la siguiente pauta: ejemplo@ejemplo.com";
                    emailField.style.borderColor = '#187786';
                    event.preventDefault();
                }

            });
        // console.log("Es un formulario de login")
        // Lógica específica para el formulario de inicio de sesión
        // Por ejemplo, añadir eventos de escucha para enviar datos de inicio de sesión
    }
});
