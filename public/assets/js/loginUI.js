const loginForm = document.querySelector('.login-form');
const userForm  = document.querySelector('.user-regis-form');
const mitraForm = document.querySelector('.worker-regis-form');

const goRegister = document.getElementById('goRegister');
const registerSwitch = document.querySelector('.register-switch');

const switchBox = document.getElementById('dynamicSwitch');
const indicator = switchBox.querySelector('.auth-indicator');
const buttons   = switchBox.querySelectorAll('button');

function hideAllForms() {
    [loginForm, userForm, mitraForm].forEach(f =>
        f.classList.add('form-hidden')
    );
}

function showForm(form) {
    form.classList.remove('form-hidden');
    form.classList.remove('form-fade');
    void form.offsetWidth;
    form.classList.add('form-fade');
}

function resetForm(form) {
    if (!form) return;
    form.reset();

    // optional: reset password type & icon
    form.querySelectorAll('input[type="text"], input[type="password"]').forEach(input => {
        if (input.dataset.originalType === 'password') {
            input.type = 'password';
        }
    });

    form.querySelectorAll('.fa-eye-slash').forEach(icon => {
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
    });
}

// GO REGISTER
goRegister.addEventListener('click', e => {
    e.preventDefault();

    loginForm.classList.add('d-none');
    registerSwitch.classList.remove('d-none');

    buttons.forEach(b => b.classList.remove('active'));
    buttons[0].classList.add('active');
    indicator.style.transform = 'translateX(0%)';

    hideAllForms();
    resetForm(mitraForm);
    showForm(userForm);
});

// SWITCH CLICK
buttons.forEach((btn, index) => {
    btn.addEventListener('click', () => {
        buttons.forEach(b => b.classList.remove('active'));
        btn.classList.add('active');

        indicator.style.transform =
            index === 0 ? 'translateX(0%)' : 'translateX(104%)';

        hideAllForms();
        if(index === 0) {
            resetForm(mitraForm);
            showForm(userForm);
        }else{
            resetForm(userForm);
            showForm(mitraForm);
        }
    });
});

document.addEventListener("click", function (e) {
    if (!e.target.classList.contains("toggle-password")) return;

    const wrapper = e.target.closest(".password-input");
    if (!wrapper) return;

    const input = wrapper.querySelector("input");
    if (!input) return;

    const isPassword = input.type === "password";
    input.type = isPassword ? "text" : "password";

    e.target.classList.toggle("fa-eye-slash");
    e.target.classList.toggle("fa-eye");
});
