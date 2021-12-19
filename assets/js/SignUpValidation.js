const pwd = document.querySelector('#password');
const pwdRep = document.querySelector('#pwdCheck');
const samePwdError = document.querySelector('.same-password');
const invalidPwdError = document.querySelector('.invalid-password');
const btn = document.querySelector('#submit-btn');

pwd.addEventListener('input', ()=>{

    if(pwd.value.length < 6){

        btn.disabled = true;
        !pwd.classList.contains('is-invalid') && pwd.classList.add('is-invalid');
        invalidPwdError.classList.contains('d-none') && invalidPwdError.classList.remove('d-none');

        return;
    }

    pwd.classList.contains('is-invalid') && pwd.classList.remove('is-invalid');
    !invalidPwdError.classList.contains('d-none') && invalidPwdError.classList.add('d-none');

    if(pwd.value !== pwdRep.value){

        btn.disabled = true;
        !pwdRep.classList.contains('is-invalid') && pwdRep.classList.add('is-invalid');
        samePwdError.classList.contains('d-none') && samePwdError.classList.remove('d-none');

        return;
    }

    pwdRep.classList.contains('is-invalid') && pwdRep.classList.remove('is-invalid');
    !samePwdError.classList.contains('d-none') && samePwdError.classList.add('d-none');
    btn.disabled = false;
});

pwdRep.addEventListener('input', () => {
    if(pwd.value !== pwdRep.value){

        btn.disabled = true;
        !pwdRep.classList.contains('is-invalid') && pwdRep.classList.add('is-invalid');
        samePwdError.classList.contains('d-none') && samePwdError.classList.remove('d-none');

        return;
    }

    pwdRep.classList.contains('is-invalid') && pwdRep.classList.remove('is-invalid');
    !samePwdError.classList.contains('d-none') && samePwdError.classList.add('d-none');
    btn.disabled = false;
});



