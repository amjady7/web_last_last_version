document.addEventListener('DOMContentLoaded', function() {
    const filterForm = document.getElementById('filterForm');
    const mobileFilterForm = document.getElementById('mobileFilterForm');
    const searchInput = document.getElementById('search');
    const mobileSearchInput = document.getElementById('mobileSearch');
    const productsGrid = document.getElementById('products-grid');
    const paginationContainer = document.getElementById('pagination-container');

    // Function to submit form with debounce
    function debounce(func, wait) {
        let timeout;
        return function executedFunction(...args) {
            const later = () => {
                clearTimeout(timeout);
                func(...args);
            };
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
        };
    }

    // Handle search input with debounce
    if (searchInput) {
        searchInput.addEventListener('input', debounce(function() {
            filterForm.submit();
        }, 500));
    }

    if (mobileSearchInput) {
        mobileSearchInput.addEventListener('input', debounce(function() {
            mobileFilterForm.submit();
        }, 500));
    }

    // Auto-submit form when other filters change
    document.querySelectorAll('#filterForm select, #filterForm input[type="checkbox"], #mobileFilterForm select, #mobileFilterForm input[type="checkbox"]').forEach(element => {
        element.addEventListener('change', function() {
            this.closest('form').submit();
        });
    });

    if (filterForm) {
        filterForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(filterForm);
            const queryString = new URLSearchParams(formData).toString();
            
            // Show loading state
            productsGrid.innerHTML = '<div class="col-12 text-center"><div class="spinner-border" role="status"><span class="visually-hidden">Loading...</span></div></div>';
            
            fetch(`${window.location.pathname}?${queryString}`, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.json())
            .then(data => {
                // Update products grid
                productsGrid.innerHTML = data.html;
                
                // Update pagination
                if (paginationContainer) {
                    paginationContainer.innerHTML = data.pagination;
                }
                
                // Update URL without page reload
                window.history.pushState({}, '', `${window.location.pathname}?${queryString}`);
            })
            .catch(error => {
                console.error('Error:', error);
                productsGrid.innerHTML = '<div class="col-12 text-center text-danger">An error occurred while loading products.</div>';
            });
        });

        // Handle pagination clicks
        document.addEventListener('click', function(e) {
            if (e.target.matches('.pagination a')) {
                e.preventDefault();
                const url = e.target.href;
                
                // Show loading state
                productsGrid.innerHTML = '<div class="col-12 text-center"><div class="spinner-border" role="status"><span class="visually-hidden">Loading...</span></div></div>';
                
                fetch(url, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    // Update products grid
                    productsGrid.innerHTML = data.html;
                    
                    // Update pagination
                    if (paginationContainer) {
                        paginationContainer.innerHTML = data.pagination;
                    }
                    
                    // Update URL without page reload
                    window.history.pushState({}, '', url);
                })
                .catch(error => {
                    console.error('Error:', error);
                    productsGrid.innerHTML = '<div class="col-12 text-center text-danger">An error occurred while loading products.</div>';
                });
            }
        });
    }
}); 