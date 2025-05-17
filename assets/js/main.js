document.addEventListener('DOMContentLoaded', () => {

    //dark theme
    const toggleTheme = document.getElementById('theme');
    const pageBody = document.body;
    const localTheme = localStorage.getItem('theme');

    if (localTheme === 'dark') {
        pageBody.classList.add('dark');
        toggleTheme?.classList.add('dark');
    }

    toggleTheme?.addEventListener('click', () => {
        pageBody.classList.toggle('dark');
        toggleTheme.classList.toggle('dark');
        const currentTheme = pageBody.classList.contains('dark') ? 'dark' : 'light';
        localStorage.setItem('theme', currentTheme);
    });

    //form
    const form = document.querySelector('form');

    if (form) {
        const inputs = form.querySelectorAll('input');
        let passwordInput = document.getElementById('password') || document.getElementById('psw');

        inputs.forEach(input => {
            if (['text', 'email', 'password'].includes(input.type)) {
                const max = input.getAttribute('maxlength') || 50;
                const counter = document.createElement('small');
                counter.className = 'char-counter';
                counter.textContent = `0 / ${max}`;
                input.parentElement.appendChild(counter);
                input.addEventListener('input', () => {
                    counter.textContent = `${input.value.length} / ${max}`;
                });
            }
        });

        form.addEventListener('submit', (event) => {
            let valid = true;
            inputs.forEach(input => {
                if (input.hasAttribute('required') && !input.value.trim()) {
                    valid = false;
                    alert(`The ${input.name} field is required.`);
                }
                if (input.type === 'email' && !input.value.match(/^\S+@\S+\.\S+$/)) {
                    valid = false;
                    alert("Invalid email.");
                }
            });

            const terms = document.getElementById('terms');
            if (terms && !terms.checked) {
                valid = false;
                alert("You must accept the terms and conditions.");
            }

            if (!valid) event.preventDefault();
        });

        if (passwordInput && passwordInput.value !== 'xxxxxxxxxx') {
            const showPassword = document.createElement('button');
            showPassword.type = 'button';
            showPassword.textContent = '👁';
            showPassword.className = 'show';
            passwordInput.parentElement.appendChild(showPassword);
            showPassword.addEventListener('click', () => {
                passwordInput.type = passwordInput.type === 'password' ? 'text' : 'password';
            });
        }
    }

    //trip search
    const filterUniverse = document.getElementById('Dimension-Type');
    const sortPrice = document.getElementById('sort-price');
    const searchInput = document.querySelector('.selection-field .input-trip[type="text"]');
    const trips = Array.from(document.querySelectorAll('.headliner-item'));
    const container = document.querySelector('.trip-list');

    if (filterUniverse && sortPrice && searchInput && container && trips.length > 0) {
        function applyFilters() {
            const selectedUniverse = filterUniverse.value;
            const priceSort = sortPrice.value;
            const searchTerm = searchInput.value.trim().toLowerCase();

            let filtered = trips.slice();

            if (selectedUniverse) {
                filtered = filtered.filter(trip => trip.dataset.type === selectedUniverse);
            }

            if (searchTerm) {
                filtered = filtered.filter(trip => {
                    const name = trip.querySelector('.hover-text')?.textContent.toLowerCase();
                    return name && name.includes(searchTerm);
                });
            }

            if (priceSort) {
                filtered.sort((a, b) => {
                    const pa = parseInt(a.dataset.price);
                    const pb = parseInt(b.dataset.price);
                    return priceSort === "asc" ? pa - pb : pb - pa;
                });
            }

            container.innerHTML = "";
            filtered.forEach(trip => container.appendChild(trip));
        }

        filterUniverse.addEventListener('change', applyFilters);
        sortPrice.addEventListener('change', applyFilters);
        searchInput.addEventListener('input', applyFilters);
    }

    //remove from basket
    document.querySelectorAll('.remove-btn').forEach(button => {
        button.addEventListener('click', function () {
            const tripId = this.dataset.tripId;

            fetch('assets/php/removeBasket.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: 'trip_id=' + encodeURIComponent(tripId)
            })
                .then(res => res.text())
                .then(response => {
                    if (response === 'success') {
                        this.closest('div').remove();
                    } else {
                        alert('Error removing trip: ' + response);
                    }
                });
        });
    });



});