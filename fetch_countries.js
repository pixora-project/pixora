document.addEventListener('DOMContentLoaded', function () {
    /* const btn = document.getElementById('countryBtn'); */
    const select = document.getElementById('countrySelect');
    const hiddenInput = document.getElementById('selectedCountry');

    fetch('./json/countries.json')
        .then(res => res.json())
        .then(countries => {
            countries.forEach(c => {
                const opt = document.createElement('option');
                /* li.innerHTML = `<a class="dropdown-item" data-value="${c.id}">${c.name}</a>`; */
                opt.value = c.id;
                opt.textContent = c.name;
                select.appendChild(opt);
            });

            select.addEventListener('change', function () {
                const selected = select.options[select.selectedIndex].textContent;
                hiddenInput.value = selected;
            })

            const choices = new Choices(select, {
                searchEnabled: true,
                searchPlaceholderValue: "Search country ...",
            });

            const saved = hiddenInput.value;
            if (saved) {
                const option = Array.from(select.options).find(o => o.textContent === saved);
                if (option) {
                    choices.setChoiceByValue(option.value);
                }
            }

        })
        .catch(err => console.error(err));
});