document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    const searchButton = document.getElementById('searchButton');
    const eventsContainer = document.getElementById('eventsContainer');
    const searchStatus = document.getElementById('searchStatus');
    const clearSearchButton = document.getElementById('clearSearch');
    const autocompleteResults = document.getElementById('autocompleteResults');
    const sortEvents = document.getElementById('sortEvents');
    
    // Timer for debouncing search input
    let searchTimer;
    
    // List of suburbs for autocomplete
    const suburbs = [
        "Melbourne", "Geelong", "Ballarat", "East Melbourne", "South Melbourne", 
        "North Melbourne", "West Melbourne", "Port Melbourne", "South Yarra", 
        "Carlton", "Fitzroy", "St Kilda", "Footscray", "Richmond", "Hawthorn"
    ];
    
    // Search functionality
    function performSearch() {
        const searchTerm = searchInput.value.trim();
        if (searchTerm === '') return;
        
        // Show loading indicator
        searchStatus.classList.remove('hidden');
        
        // Perform AJAX request
        const xhr = new XMLHttpRequest();
        xhr.open('GET', `explore.php?search=${encodeURIComponent(searchTerm)}&ajax=1`, true);
        
        xhr.onload = function() {
            if (xhr.status === 200) {
                // Update the events container with the results
                eventsContainer.innerHTML = xhr.responseText;
                
                // Add animation to new elements
                const eventTiles = eventsContainer.querySelectorAll('.event-tile');
                eventTiles.forEach((tile, index) => {
                    tile.style.opacity = '0';
                    setTimeout(() => {
                        tile.classList.add('animate-fadeIn');
                    }, index * 100);
                });
                
                // Hide loading indicator
                searchStatus.classList.add('hidden');
            }
        };
        
        xhr.send();
    }
    
    // Event listener for search button
    searchButton.addEventListener('click', performSearch);
    
    // Event listener for Enter key in search input
    searchInput.addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            performSearch();
            autocompleteResults.classList.add('hidden');
        }
    });
    
    // Autocomplete functionality
    searchInput.addEventListener('input', function() {
        const searchTerm = this.value.trim().toLowerCase();
        
        // Clear previous timer
        clearTimeout(searchTimer);
        
        if (searchTerm.length < 2) {
            autocompleteResults.classList.add('hidden');
            return;
        }
        
        // Set new timer for debouncing
        searchTimer = setTimeout(() => {
            // Filter suburbs based on input
            const filteredSuburbs = suburbs.filter(suburb => 
                suburb.toLowerCase().includes(searchTerm)
            );
            
            // Update autocomplete results
            if (filteredSuburbs.length > 0) {
                autocompleteResults.innerHTML = '';
                filteredSuburbs.forEach(suburb => {
                    const item = document.createElement('div');
                    item.className = 'autocomplete-item';
                    item.textContent = suburb;
                    item.addEventListener('click', function() {
                        searchInput.value = suburb;
                        autocompleteResults.classList.add('hidden');
                        performSearch();
                    });
                    autocompleteResults.appendChild(item);
                });
                autocompleteResults.classList.remove('hidden');
            } else {
                autocompleteResults.classList.add('hidden');
            }
        }, 300);
    });
    
    // Hide autocomplete when clicking outside
    document.addEventListener('click', function(e) {
        if (!searchInput.contains(e.target) && !autocompleteResults.contains(e.target)) {
            autocompleteResults.classList.add('hidden');
        }
    });
    
    // Clear search functionality
    if (clearSearchButton) {
        clearSearchButton.addEventListener('click', function() {
            searchInput.value = '';
            window.location.href = 'explore.php';
        });
    }
    
    // Sorting functionality
    sortEvents.addEventListener('change', function() {
        const eventTiles = Array.from(eventsContainer.querySelectorAll('.event-tile'));
        
        if (eventTiles.length === 0) return;
        
        switch(this.value) {
            case 'date':
                eventTiles.sort((a, b) => {
                    const dateA = a.querySelector('svg[viewBox="0 0 24 24"] + span').textContent;
                    const dateB = b.querySelector('svg[viewBox="0 0 24 24"] + span').textContent;
                    return dateA.localeCompare(dateB);
                });
                break;
            case 'name':
                eventTiles.sort((a, b) => {
                    const nameA = a.querySelector('h3').textContent;
                    const nameB = b.querySelector('h3').textContent;
                    return nameA.localeCompare(nameB);
                });
                break;
            default:
                // Default order (could be loaded order or any other criterion)
                break;
        }
        
        // Clear container and append sorted elements
        eventsContainer.innerHTML = '';
        eventTiles.forEach(tile => {
            eventsContainer.appendChild(tile);
        });
    });
});


document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    const eventsContainer = document.getElementById('eventsContainer');
    const searchStatus = document.getElementById('searchStatus');
    const clearSearchButton = document.getElementById('clearSearch');
    const autocompleteResults = document.getElementById('autocompleteResults');
    const sortEvents = document.getElementById('sortEvents');
    
    // Timer for debouncing search input
    let searchTimer;
    
    // List of suburbs for autocomplete
    const suburbs = [
        "Melbourne", "Geelong", "Ballarat", "East Melbourne", "South Melbourne", 
        "North Melbourne", "West Melbourne", "Port Melbourne", "South Yarra", 
        "Carlton", "Fitzroy", "St Kilda", "Footscray", "Richmond", "Hawthorn"
    ];
    
    // Dynamic search functionality
    function performSearch() {
        const searchTerm = searchInput.value.trim();
        
        // Show loading indicator
        searchStatus.classList.remove('hidden');
        
        // Perform AJAX request
        const xhr = new XMLHttpRequest();
        xhr.open('GET', `explore.php?search=${encodeURIComponent(searchTerm)}&ajax=1`, true);
        
        xhr.onload = function() {
            if (xhr.status === 200) {
                // Update the events container with the results
                eventsContainer.innerHTML = xhr.responseText;
                
                // Add animation to new elements
                const eventTiles = eventsContainer.querySelectorAll('.event-tile');
                eventTiles.forEach((tile, index) => {
                    tile.style.opacity = '0';
                    setTimeout(() => {
                        tile.classList.add('animate-fadeIn');
                    }, index * 100);
                });
                
                // Hide loading indicator
                searchStatus.classList.add('hidden');
            }
        };
        
        xhr.send();
    }
    
    // Debounce function for dynamic search
    searchInput.addEventListener('input', function() {
        const searchTerm = this.value.trim().toLowerCase();
        
        // Clear previous timer
        clearTimeout(searchTimer);
        
        // Handle autocomplete
        if (searchTerm.length < 2) {
            autocompleteResults.classList.add('hidden');
            if (searchTerm.length === 0) {
                performSearch(); // Search with empty string to show all events
            }
            return;
        }
        
        // Set new timer for debouncing search
        searchTimer = setTimeout(() => {
            performSearch();
            
            // Filter suburbs for autocomplete
            const filteredSuburbs = suburbs.filter(suburb => 
                suburb.toLowerCase().includes(searchTerm)
            );
            
            // Update autocomplete results
            if (filteredSuburbs.length > 0) {
                autocompleteResults.innerHTML = '';
                filteredSuburbs.forEach(suburb => {
                    const item = document.createElement('div');
                    item.className = 'autocomplete-item';
                    item.textContent = suburb;
                    item.addEventListener('click', function() {
                        searchInput.value = suburb;
                        autocompleteResults.classList.add('hidden');
                        performSearch();
                    });
                    autocompleteResults.appendChild(item);
                });
                autocompleteResults.classList.remove('hidden');
            } else {
                autocompleteResults.classList.add('hidden');
            }
        }, 300); // 300ms delay to reduce server load while typing
    });
    
    // Event listener for Enter key in search input
    searchInput.addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            clearTimeout(searchTimer);
            performSearch();
            autocompleteResults.classList.add('hidden');
        }
    });
    
    // Hide autocomplete when clicking outside
    document.addEventListener('click', function(e) {
        if (!searchInput.contains(e.target) && !autocompleteResults.contains(e.target)) {
            autocompleteResults.classList.add('hidden');
        }
    });
    
    // Clear search functionality
    if (clearSearchButton) {
        clearSearchButton.addEventListener('click', function() {
            searchInput.value = '';
            performSearch(); // Immediately search with empty value to show all events
        });
    }
    
    // Sorting functionality
    sortEvents.addEventListener('change', function() {
        const eventTiles = Array.from(eventsContainer.querySelectorAll('.event-tile'));
        
        if (eventTiles.length === 0) return;
        
        switch(this.value) {
            case 'date':
                eventTiles.sort((a, b) => {
                    const dateA = a.querySelector('svg[viewBox="0 0 24 24"] + span').textContent;
                    const dateB = b.querySelector('svg[viewBox="0 0 24 24"] + span').textContent;
                    return dateA.localeCompare(dateB);
                });
                break;
            case 'name':
                eventTiles.sort((a, b) => {
                    const nameA = a.querySelector('h3').textContent;
                    const nameB = b.querySelector('h3').textContent;
                    return nameA.localeCompare(nameB);
                });
                break;
            default:
                // Default order (could be loaded order or any other criterion)
                break;
        }
        
        // Clear container and append sorted elements
        eventsContainer.innerHTML = '';
        eventTiles.forEach(tile => {
            eventsContainer.appendChild(tile);
        });
    });
    
    // Initial search to ensure all events are shown properly
    // Only if there's no existing search term
    if (searchInput.value.trim() === '') {
        performSearch();
    }
});
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    const eventsContainer = document.getElementById('eventsContainer');
    const eventsCarousel = document.getElementById('eventsCarousel');
    const searchStatus = document.getElementById('searchStatus');
    const clearSearchButton = document.getElementById('clearSearch');
    const autocompleteResults = document.getElementById('autocompleteResults');
    const sortEvents = document.getElementById('sortEvents');
    const prevButton = document.getElementById('prevButton');
    const nextButton = document.getElementById('nextButton');
    const paginationContainer = document.getElementById('carouselPagination');
    
    // Carousel state
    let currentSlide = 0;
    let totalSlides = 0;
    let slidesPerView = 4; // Default for large screens
    let slideWidth = 0;
    
    // Timer for debouncing search input
    let searchTimer;
    
    // List of suburbs for autocomplete
    const suburbs = [
        "Melbourne", "Geelong", "Ballarat", "East Melbourne", "South Melbourne", 
        "North Melbourne", "West Melbourne", "Port Melbourne", "South Yarra", 
        "Carlton", "Fitzroy", "St Kilda", "Footscray", "Richmond", "Hawthorn"
    ];
    
    // Set slides per view based on screen size
    function updateSlidesPerView() {
        if (window.innerWidth < 640) {
            slidesPerView = 1; // Mobile
        } else if (window.innerWidth < 768) {
            slidesPerView = 2; // Small tablet
        } else if (window.innerWidth < 1024) {
            slidesPerView = 3; // Large tablet
        } else {
            slidesPerView = 4; // Desktop
        }
        
        updateCarousel();
    }
    
    // Update carousel based on current slide
    function updateCarousel() {
        const eventTiles = eventsContainer.querySelectorAll('.event-tile');
        totalSlides = Math.max(0, eventTiles.length - slidesPerView + 1);
        
        // Reset current slide if necessary
        if (currentSlide >= totalSlides && totalSlides > 0) {
            currentSlide = totalSlides - 1;
        }
        
        // Calculate slide width
        if (eventsCarousel) {
            slideWidth = eventsCarousel.offsetWidth / slidesPerView;
            
            // Apply width to event tiles
            eventTiles.forEach(tile => {
                tile.style.width = `${slideWidth}px`;
            });
            
            // Move container to current slide
            eventsContainer.style.transform = `translateX(-${currentSlide * slideWidth}px)`;
        }
        
        // Update button states
        prevButton.disabled = currentSlide === 0 || totalSlides <= 1;
        nextButton.disabled = currentSlide >= totalSlides - 1 || totalSlides <= 1;
        
        // Update pagination dots
        updatePagination();
    }
    
    // Create or update pagination dots
    function updatePagination() {
        if (!paginationContainer) return;
        
        paginationContainer.innerHTML = '';
        
        if (totalSlides <= 1) return;
        
        for (let i = 0; i < totalSlides; i++) {
            const dot = document.createElement('button');
            dot.classList.add('w-3', 'h-3', 'rounded-full', 'transition-colors', 'duration-300');
            
            if (i === currentSlide) {
                dot.classList.add('bg-blue-600');
            } else {
                dot.classList.add('bg-gray-300', 'hover:bg-gray-400');
            }
            
            dot.addEventListener('click', () => {
                currentSlide = i;
                updateCarousel();
            });
            
            paginationContainer.appendChild(dot);
        }
    }
    
    // Navigation button event listeners
    if (prevButton) {
        prevButton.addEventListener('click', () => {
            if (currentSlide > 0) {
                currentSlide--;
                updateCarousel();
            }
        });
    }
    
    if (nextButton) {
        nextButton.addEventListener('click', () => {
            if (currentSlide < totalSlides - 1) {
                currentSlide++;
                updateCarousel();
            }
        });
    }
    
    // Window resize event listener
    window.addEventListener('resize', updateSlidesPerView);
    
    // Search functionality
    function performSearch() {
        const searchTerm = searchInput.value.trim();
        
        // Show loading indicator
        if (searchStatus) {
            searchStatus.classList.remove('hidden');
        }
        
        // Reset carousel position
        currentSlide = 0;
        
        // Perform AJAX request
        const xhr = new XMLHttpRequest();
        xhr.open('GET', `explore.php?search=${encodeURIComponent(searchTerm)}&ajax=1`, true);
        
        xhr.onload = function() {
            if (xhr.status === 200) {
                // Update the events container with the results
                eventsContainer.innerHTML = xhr.responseText;
                
                // Add animation to new elements
                const eventTiles = eventsContainer.querySelectorAll('.event-tile');
                eventTiles.forEach((tile, index) => {
                    tile.style.opacity = '0';
                    setTimeout(() => {
                        tile.classList.add('animate-fadeIn');
                    }, index * 100);
                });
                
                // Update carousel after search results are loaded
                updateSlidesPerView();
                
                // Hide loading indicator
                if (searchStatus) {
                    searchStatus.classList.add('hidden');
                }
            }
        };
        
        xhr.send();
    }
    
    // Debounce function for dynamic search
    if (searchInput) {
        searchInput.addEventListener('input', function() {
            const searchTerm = this.value.trim().toLowerCase();
            
            // Clear previous timer
            clearTimeout(searchTimer);
            
            // Handle autocomplete
            if (searchTerm.length < 2) {
                if (autocompleteResults) {
                    autocompleteResults.classList.add('hidden');
                }
                if (searchTerm.length === 0) {
                    performSearch(); // Search with empty string to show all events
                }
                return;
            }
            
            // Set new timer for debouncing search
            searchTimer = setTimeout(() => {
                performSearch();
                
                // Filter suburbs for autocomplete
                if (autocompleteResults) {
                    const filteredSuburbs = suburbs.filter(suburb => 
                        suburb.toLowerCase().includes(searchTerm)
                    );
                    
                    // Update autocomplete results
                    if (filteredSuburbs.length > 0) {
                        autocompleteResults.innerHTML = '';
                        filteredSuburbs.forEach(suburb => {
                            const item = document.createElement('div');
                            item.className = 'autocomplete-item';
                            item.textContent = suburb;
                            item.addEventListener('click', function() {
                                searchInput.value = suburb;
                                autocompleteResults.classList.add('hidden');
                                performSearch();
                            });
                            autocompleteResults.appendChild(item);
                        });
                        autocompleteResults.classList.remove('hidden');
                    } else {
                        autocompleteResults.classList.add('hidden');
                    }
                }
            }, 300); // 300ms delay to reduce server load while typing
        });
        
        // Event listener for Enter key in search input
        searchInput.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                clearTimeout(searchTimer);
                performSearch();
                if (autocompleteResults) {
                    autocompleteResults.classList.add('hidden');
                }
            }
        });
    }
    
    // Hide autocomplete when clicking outside
    if (autocompleteResults) {
        document.addEventListener('click', function(e) {
            if (!searchInput.contains(e.target) && !autocompleteResults.contains(e.target)) {
                autocompleteResults.classList.add('hidden');
            }
        });
    }
    
    // Clear search functionality
    if (clearSearchButton) {
        clearSearchButton.addEventListener('click', function() {
            if (searchInput) {
                searchInput.value = '';
                performSearch(); // Immediately search with empty value to show all events
            }
        });
    }
    
    // Sorting functionality
    if (sortEvents) {
        sortEvents.addEventListener('change', function() {
            const eventTiles = Array.from(eventsContainer.querySelectorAll('.event-tile'));
            
            if (eventTiles.length === 0) return;
            
            switch(this.value) {
                case 'date':
                    eventTiles.sort((a, b) => {
                        const dateA = a.querySelector('svg[viewBox="0 0 24 24"] + span').textContent;
                        const dateB = b.querySelector('svg[viewBox="0 0 24 24"] + span').textContent;
                        return dateA.localeCompare(dateB);
                    });
                    break;
                case 'name':
                    eventTiles.sort((a, b) => {
                        const nameA = a.querySelector('h3').textContent;
                        const nameB = b.querySelector('h3').textContent;
                        return nameA.localeCompare(nameB);
                    });
                    break;
                default:
                    // Default order (could be loaded order or any other criterion)
                    break;
            }
            
            // Reset carousel position
            currentSlide = 0;
            
            // Clear container and append sorted elements
            eventTiles.forEach(tile => {
                eventsContainer.appendChild(tile);
            });
            
            // Update carousel after sorting
            updateCarousel();
        });
    }
    
    // Initialize carousel
    updateSlidesPerView();
    
    // Initial search to ensure all events are shown properly
    // Only if there's no existing search term
    if (searchInput && searchInput.value.trim() === '') {
        performSearch();
    }
});