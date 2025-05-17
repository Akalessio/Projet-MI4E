const originValues = {};
let areModified = false;

window.enableEdit = function (fieldId) {
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

window.cancelEdit = function (fieldId) {
    const input = document.getElementById(fieldId);
    input.value = originValues[fieldId];
    disableEdit(fieldId);
}

window.enableProfilePicEdit = function () {
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

window.previewProfilePicture = function (value) {
    const preview = document.getElementById('profile_picture_preview');
    if (preview) {
        preview.src = `assets/img/PP/${value}.png`;
    }
}

window.saveEdit = function (fieldId) {
    const input = document.getElementById(fieldId);
    const firstname = document.getElementById("firstname")
    const name = document.getElementById("name")
    const date = document.getElementById("date")
    const email = document.getElementById("email")
    const password = document.getElementById("password")
    const profile_picture_select = document.getElementById("profile_picture_select")
    const original = originValues[fieldId];
    const current = input.value;
    const loading = input.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling
    if (current !== original) {
        areModified = true;

        loading.style.display = "inline";

        fetch(`modify.php?field=${fieldId}`, {headers:{
            'X-Requested-With': 'XMLHttpRequest',
            'email': email.value,
            'firstname': firstname.value,
            'name': name.value,
            'date': date.value,
            'password': password.value,
            'profile_picture_select': profile_picture_select.value,
            'current': current
            }
        }).then(reception =>{
            if(!reception.ok){
                return reception.json().then(err =>{
                    throw new Error(err.error || "Unknown Error");
                });
            }
            return reception.json;
        })
            .then(success =>{
                alert("succefully changed your profile");
                if(fieldId == 'profile_picture_select'){
                    document.getElementById('pdp').src = `assets/img/PP/${profile_picture_select.value}.png?` + new Date().getTime();
                }
            })
            .catch(error =>{
                alert("Error :" + error.message);
                console.error('error', error)
            })
            .finally(() => {
                loading.style.display = "none";
            })
    }
    disableEdit(fieldId);
    if (fieldId === 'profile_picture_select') {
        previewProfilePicture(current);
    }
}

window.disableEdit = function (fieldId) {
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