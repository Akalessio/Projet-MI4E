document.addEventListener('DOMContentLoaded', () =>{

    //dark theme
    const toggleTheme = document.getElementById('theme');
    const pageBody = document.body;
    const localTheme = localStorage.getItem('theme');

    if (localTheme === 'dark'){
        pageBody.classList.add('dark');
        toggleTheme.classList.add('dark');
    }

    toggleTheme.addEventListener('click', () =>{
        pageBody.classList.toggle('dark');
        toggleTheme.classList.toggle('dark');
        const currentTheme = pageBody.classList.contains('dark') ? 'dark' : 'light';
        localStorage.setItem('theme', currentTheme);
    });

    //form
    const form = document.querySelector('form');
    const inputs = form.querySelectorAll('input');
    let passwordInput = document.getElementById('password');
    if(!passwordInput){
        passwordInput = document.getElementById('psw');
    }

    inputs.forEach( input => {
        if(input.type === 'text' || input.type === 'email' || input.type === 'password'){
            const max = input.getAttribute('maxlength') || 50;
            const counter = document.createElement('small');
            counter.className = 'char-counter';
            counter.textContent = `0 / ${max}`;
            input.parentElement.appendChild(counter);
            input.addEventListener('input', () => {
                counter.textContent =`${input.value.length} / ${max}`;
            })
        }
    });

    form.addEventListener('submit', (submit) => {
        let valid = true;
        inputs.forEach(input => {
            if (input.hasAttribute('required') && !input.value.trim()){
                valid = false;
                alert(`the ${input.name}'s field is required.`);
            }if (input.type === 'email' && !input.value.match(/^\S+@\S+\.\S+$/)){
                valid = false;
                alert("email invalid.");
            }
        });
        const terms = document.getElementById('terms');
        if(!terms.checked){
            valid = false;
            alert("accept terms and conditions");
        }

        if (valid){
            form.submit();
        }else{
            submit.preventDefault();
        }
    });

    if(passwordInput.value !== 'xxxxxxxxxx'){
        const showPassword = document.createElement('button');
        showPassword.type = 'button';
        showPassword.textContent = '👁';
        showPassword.className = 'show';
        passwordInput.parentElement.appendChild(showPassword);
        showPassword.addEventListener('click', () => {
            passwordInput.type = passwordInput.type === 'password' ? 'text' : 'password';
        });
    };



    //profile modification
    const originValues = {};
    let areModified = false;

    window.enableEdit = function(fieldId){
        const input = document.getElementById(fieldId);
        const save = input.nextElementSibling.nextElementSibling;
        const cancel = input.nextElementSibling.nextElementSibling.nextElementSibling;
        originValues[fieldId] = input.value;
        input.removeAttribute('readonly');
        input.style.backgroundColor = "#fff";
        input.nextElementSibling.style.display = 'none';
        save.style.display = 'inline';
        cancel.style.display = 'inline';
    }

    window.cancelEdit = function(fieldId){
        const input = document.getElementById(fieldId);
        input.value = originValues[fieldId];
        disableEdit(fieldId);
    }

    window.enableProfilePicEdit = function(){
        const select = document.getElementById('profile_picture_select');
        const save = select.nextElementSibling.nextElementSibling;
        const cancel = select.nextElementSibling.nextElementSibling.nextElementSibling;
        originValues['profile_picture_select'] = select.value;
        select.disabled = false;
        select.style.backgroundColor = "#fff";
        select.nextElementSibling.style.display = 'none';
        save.style.display = 'inline';
        cancel.style.display = 'inline';
    }

    window.previewProfilePicture = function(value){
        const preview = document.getElementById('profile_picture_preview');
        preview.src = `assets/img/PP/${value}.png`;
    }

    window.saveEdit = function(fieldId) {
        const input = document.getElementById(fieldId);
        const original = originValues[fieldId];
        const current = input.value;
        if (current !== original) {
            areModified = true;
            document.getElementById('submitModif').style.display = 'block';
        }
        disableEdit(fieldId);
        if (fieldId === 'profile_picture_select') {
            previewProfilePicture(current);
        }
    }


    window.disableEdit = function(fieldId){
        const input = document.getElementById(fieldId);
        const edit = input.nextElementSibling;
        const save = input.nextElementSibling.nextElementSibling;
        const cancel = input.nextElementSibling.nextElementSibling.nextElementSibling;
        if (input.tagName.toLowerCase() === 'select') {
            input.disabled = true;
        } else {
            input.setAttribute('readonly', true);
        }
        input.style.backgroundColor = "#f0f0f0";
        edit.style.display = 'inline';
        save.style.display = 'none';
        cancel.style.display = 'none';
    }





});