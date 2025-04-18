document.addEventListener('DOMContentLoaded', function() {
    const filterForm = document.getElementById('filter-form');
    const productsGrid = document.getElementById('products-grid');
    const paginationContainer = document.getElementById('pagination-container');

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