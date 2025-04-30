document.addEventListener('DOMContentLoaded', () => {
    const burgerMenu = document.querySelector('.burger-menu');
    const navMenu = document.querySelector('.nav-menu');
    const searchIcon = document.querySelector('.search-icon');
    const searchContainer = document.querySelector('.search-container');
    const searchInput = document.getElementById('search-input');
    const searchButton = document.getElementById('search-btn');
    const logo = document.querySelector('.logo');
    const userIcon = document.querySelector('.user-icon');
    const userMenu = document.querySelector('.user-menu');


    logo.addEventListener('click', () => {
        window.location.href = "/boutique-en-ligne/index.php"; 
    });

    burgerMenu.addEventListener('click', () => {
        navMenu.classList.toggle('hidden');
        if (!navMenu.classList.contains('hidden')) {
            searchContainer.classList.add('hidden'); 
            userMenu.classList.add('hidden'); 
        }
    });

    userIcon.addEventListener('click', () => {
        userMenu.classList.toggle('hidden');
        if (!userMenu.classList.contains('hidden')) {
            searchContainer.classList.add('hidden'); 
        }
    });

    searchIcon.addEventListener('click', () => {
        searchContainer.classList.toggle('hidden');
        if (!searchContainer.classList.contains('hidden')) {
            navMenu.classList.add('hidden');
            userMenu.classList.add('hidden');
        }
    });

    
    searchButton.addEventListener('click', () => {
        const searchQuery = searchInput.value.trim().toLowerCase();
        if (searchQuery) {
            fetch('/path/to/products.json')
                .then(response => response.json())
                .then(products => {
                    const results = products.filter(product => 
                        product.name.toLowerCase().includes(searchQuery) || 
                        product.description.toLowerCase().includes(searchQuery)
                    );
                    displaySearchResults(results);
                })
                .catch(error => {
                    console.error('Erreur lors de la recherche:', error);
                });
        }
    });

    
    function displaySearchResults(results) {
        console.log('Résultats trouvés:', results);
    }
});