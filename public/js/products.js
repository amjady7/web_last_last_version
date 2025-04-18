document.addEventListener('DOMContentLoaded', function() {
    // Get all filter form elements
    const filterForm = document.getElementById('filter-form');
    const sortSelect = document.getElementById('sort');
    const categorySelect = document.getElementById('category');
    const brandSelect = document.getElementById('brand');
    const priceRange = document.getElementById('price-range');
    const priceValue = document.getElementById('price-value');
    const searchInput = document.getElementById('search');

    // Function to update products grid and pagination
    function updateProducts(url) {
        // Show loading state
        document.getElementById('products-grid').innerHTML = '<div class="text-center"><div class="spinner-border" role="status"><span class="visually-hidden">Loading...</span></div></div>';
        
        // Make AJAX request
        fetch(url, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => response.text())
        .then(html => {
            // Create a temporary container
            const temp = document.createElement('div');
            temp.innerHTML = html;

            // Update products grid
            const newGrid = temp.querySelector('#products-grid');
            if (newGrid) {
                document.getElementById('products-grid').innerHTML = newGrid.innerHTML;
            }

            // Update pagination
            const newPagination = temp.querySelector('.pagination');
            const paginationContainer = document.querySelector('.pagination-container');
            if (newPagination) {
                if (paginationContainer) {
                    paginationContainer.innerHTML = newPagination.outerHTML;
                } else {
                    document.querySelector('.products-section').insertAdjacentHTML('beforeend', newPagination.outerHTML);
                }
            } else if (paginationContainer) {
                paginationContainer.remove();
            }

            // Update URL without page reload
            window.history.pushState({}, '', url);
        })
        .catch(error => {
            console.error('Error:', error);
            document.getElementById('products-grid').innerHTML = '<div class="alert alert-danger">Error loading products. Please try again.</div>';
        });
    }

    // Handle form submission
    if (filterForm) {
        filterForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(filterForm);
            const queryString = new URLSearchParams(formData).toString();
            updateProducts(`${window.location.pathname}?${queryString}`);
        });
    }

    // Handle sort change
    if (sortSelect) {
        sortSelect.addEventListener('change', function() {
            filterForm.submit();
        });
    }

    // Handle category change
    if (categorySelect) {
        categorySelect.addEventListener('change', function() {
            filterForm.submit();
        });
    }

    // Handle brand change
    if (brandSelect) {
        brandSelect.addEventListener('change', function() {
            filterForm.submit();
        });
    }

    // Handle price range change
    if (priceRange && priceValue) {
        priceRange.addEventListener('input', function() {
            priceValue.textContent = this.value;
        });
        priceRange.addEventListener('change', function() {
            filterForm.submit();
        });
    }

    // Handle search input with debounce
    if (searchInput) {
        let searchTimeout;
        searchInput.addEventListener('input', function() {
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(() => {
                filterForm.submit();
            }, 500);
        });
    }

    // Handle pagination clicks
    document.addEventListener('click', function(e) {
        if (e.target.matches('.pagination .page-link')) {
            e.preventDefault();
            const url = e.target.href;
            updateProducts(url);
        }
    });

    // Handle browser back/forward buttons
    window.addEventListener('popstate', function() {
        updateProducts(window.location.href);
    });
}); 