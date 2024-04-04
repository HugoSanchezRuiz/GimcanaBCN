document.addEventListener("DOMContentLoaded", function() {
    var emailField = document.getElementById('email');
    var passwordField = document.getElementById('password');
    var form = document.getElementById('loginForm');

    var email = document.getElementById("email").value;
    var contrasena = document.getElementById("password").value;

    var emailError = document.getElementById('emailError');
    var contrasenaError = document.getElementById('passwordError');

    const patronEmail = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/; // Formato de email
    const patronContrasena = /^(?=.*\d)(?=.*[A-Z])[0-9a-zA-Z]{8,}$/; // Al menos 1 número, 1 mayúscula, mínimo 8 caracteres

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

    // Validaciones contraseña
    passwordField.addEventListener('blur', function() {
        const contrasena = passwordField.value;
        if (contrasena === "") {
            contrasenaError.innerHTML = "Ingresa una contraseña.";
            passwordField.style.borderColor = '#187786';
        } else if (!patronContrasena.test(contrasena)) {
            contrasenaError.innerHTML = "La contraseña debe tener al menos 1 número, 1 mayúscula y mínimo 8 carácteres.";
            passwordField.style.borderColor = '#187786';
        } else {
            contrasenaError.innerHTML = "";
        }
    });


    form.addEventListener('submit', function(event) {
        const email = emailField.value.trim();
        const contrasena = passwordField.value.trim();

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
    });
});