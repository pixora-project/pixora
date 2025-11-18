document.addEventListener('DOMContentLoaded',function(){
    const btn = document.getElementById('countryBtn');
    const list = document.getElementById('countryListe');
    const hiddenInput = document.getElementById('selectedCountry');

    fetch('./json/countries.json')
    .then(res => res.json())
    .then(countries => {
        countries.forEach(c => {
            const li = document.createElement('li');
            li.innerHTML = `<a class="dropdown-item" data-value="${c.id}">${c.name}</a>`;
            list.appendChild(li);
        });

        list.addEventListener('click',e => {
            if(e.target.classList.contains('dropdown-item')){
                const name = e.target.textContent;
                const id = e.target.getAttribute('data-value');
                btn.textContent = name;
                hiddenInput.value = name;
            }
        });

        const saved = hiddenInput.value;
        if(saved){
            const current = countries.find(c => c.name === saved);
            if(current) btn.textContent = current.name;
        }
    })
    .catch(err => console.error(err));
});