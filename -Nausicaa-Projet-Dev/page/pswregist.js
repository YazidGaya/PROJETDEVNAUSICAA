    feather.replace();

    const eye = document.querySelector('.feather-eye.eye1');
    const eyeoff = document.querySelector('.feather-eye-off.eye');
    
    const eye2 = document.querySelector('.feather-eye.eye2');
    const eyeoff2 = document.querySelector('.feather-eye-off.eye2');
    const passwordFields = document.querySelectorAll('input[type=password]');

    // Masquer les icônes initialement
    eye.style.display = "none";
    eyeoff.style.display = "none";

    eye2.style.display = "none";
    eyeoff2.style.display = "none";

    // Afficher l'icône lorsque le champ de mot de passe reçoit le focus
    passwordFields.forEach(p => {p.addEventListener('focus', () => {
        if (p.type === "password") {
            p.parentElement.querySelector('.feather-eye').style.display = "block";
        } else {
            p.parentElement.querySelector('.feather-eye-off').style.display = "block";
        }
    });
    p.addEventListener('blur', () => {
        setTimeout(() => {
            if (document.activeElement !== p.parentElement.querySelector('.feather-eye') && document.activeElement !== p.parentElement.querySelector('.feather-eye-off')) {
                p.parentElement.querySelector('.feather-eye').style.display = "none";
                p.parentElement.querySelector('.feather-eye-off').style.display = "none";
            }
        }, 200);
    });
});

    // Masquer les icônes lorsque le champ de mot de passe perd le focus

    eye.addEventListener('mousedown', (e) => {
        e.preventDefault(); // Empêche le champ de perdre le focus
        eye.style.display = "none";
        eyeoff.style.display = "block";
        eye.parentElement.firstElementChild.type = "text";
    });

    eyeoff.addEventListener('mousedown', (e) => {
        e.preventDefault(); // Empêche le champ de perdre le focus
        eyeoff.style.display = "none";
        eye.style.display = "block";
        eye.parentElement.firstElementChild.type = "password";
    });

    eye2.addEventListener('mousedown', (e) => {
        e.preventDefault(); // Empêche le champ de perdre le focus
        eye2.style.display = "none";
        eyeoff2.style.display = "block";
        eye2.parentElement.firstElementChild.type = "text";
    });

    eyeoff2.addEventListener('mousedown', (e) => {
        e.preventDefault(); // Empêche le champ de perdre le focus
        eyeoff2.style.display = "none";
        eye2.style.display = "block";
        eye2.parentElement.firstElementChild.type = "password";
    });
