
    feather.replace();
    const eye = document.querySelector('.feather-eye');
    const eyeoff = document.querySelector('.feather-eye-off');
    const passwordField = document.querySelector('input[type=password]');

    // Masquer les icônes initialement
    eye.style.display = "none";
    eyeoff.style.display = "none";

    // Afficher l'icône lorsque le champ de mot de passe reçoit le focus
    passwordField.addEventListener('focus', () => {
        if (passwordField.type === "password") {
            eye.style.display = "block";
        } else {
            eyeoff.style.display = "block";
        }
    });

    // Masquer les icônes lorsque le champ de mot de passe perd le focus
    passwordField.addEventListener('blur', () => {
        setTimeout(() => {
            if (document.activeElement !== eye && document.activeElement !== eyeoff) {
                eye.style.display = "none";
                eyeoff.style.display = "none";
            }
        }, 200);
    });

    eye.addEventListener('mousedown', (e) => {
        e.preventDefault(); // Empêche le champ de perdre le focus
        eye.style.display = "none";
        eyeoff.style.display = "block";
        passwordField.type = "text";
    });

    eyeoff.addEventListener('mousedown', (e) => {
        e.preventDefault(); // Empêche le champ de perdre le focus
        eyeoff.style.display = "none";
        eye.style.display = "block";
        passwordField.type = "password";
    });
