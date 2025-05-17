document.addEventListener('DOMContentLoaded', function (){
    const buttons = document.querySelectorAll(".ul-button button");
    const mailInput = document.getElementById('mailChange');
    const loading = document.getElementById("loading");
    let value ="";

    buttons.forEach(button => {
        button.addEventListener("click", ()=>{
            let mail = mailInput.value;
            if(!mailInput.checkValidity()){
                alert("Email invalid");
                return;
            }

            value = button.value;

            loading.style.display = "inline";

            fetch(`assets/php/adminAsync.php?action=${value}`, {headers:{
                    'X-Requested-With': 'XMLHttpRequest',
                    'mail': mail
                }
            }).then(reception =>{
                if (!reception.ok){
                    return reception.json().then(err =>{
                        throw new Error(err.error || "Unknown error");
                    });
                }
                return reception.json();
            })
                .then(success => {
                alert("changed successfully");
            })
                .catch(error =>{
                alert("Error :" + error.message);
                console.error('error', error)
            })
                .finally(() => {
                    loading.style.display = "none";
                })
        });
    });
});