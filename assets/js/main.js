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

    //form sign
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

    const showPassword = document.createElement('button');
    showPassword.type = 'button';
    showPassword.textContent = '👁';
    showPassword.className = 'show';
    passwordInput.parentElement.appendChild(showPassword);
    showPassword.addEventListener('click', () => {
        passwordInput.type = passwordInput.type === 'password' ? 'text' : 'password';
    });





});