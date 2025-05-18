document.addEventListener("DOMContentLoaded", function (){
    const checks = document.querySelectorAll('input[type="checkbox"]');
    let totalPrice = 0;
    let optionName = "";
    const tripId = document.getElementById("tripId").value;
    const dailyPrice = parseInt(document.getElementById("dayValue").value);
    let howMany = document.getElementById("number");
    const discountExist = document.getElementById("discoutExist").value;

    function price(priceFile){
        if (discountExist == 100){
            const discount = document.getElementById("reduction");
            if(discount.checked){
                totalPrice = 0;
                const price = document.getElementById("price-amount").textContent = `${totalPrice}`;
                return;
            }
        }
        totalPrice = 0;
        checks.forEach(check =>{
            if(check.checked){
                optionName = check.dataset.name;
                totalPrice += Number(priceFile[optionName]);
            }
        });
        const start = new Date(document.getElementById("start_date")?.value);
        const end = new Date(document.getElementById("end_date")?.value);

        if (!isNaN(start) && !isNaN(end) && end > start) {
            const delta = (end - start) / (1000 * 3600 * 24);
            totalPrice += delta * dailyPrice;
        }

        totalPrice *= Number(howMany.value);

        const price = document.getElementById("price-amount").textContent = `${totalPrice}`;
    }

    fetch(`assets/php/checkTripPrice.php?id=${tripId}`, {headers:{
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
        .then(reception => {
            return reception.json();
        })
        .then(priceFile =>{

            checks.forEach(check => check.addEventListener("change", () => price(priceFile)));
            document.getElementById("start_date").addEventListener("change", () => price(priceFile));
            document.getElementById("end_date").addEventListener("change", () =>  price(priceFile));
            howMany.addEventListener("change", () => price(priceFile));

            price(priceFile);
        })
        .catch(error => {
            console.error('error', error);
        })
})