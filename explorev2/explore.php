<?php
// Include common functions
require_once 'includes/functions.php';
// Include dummy data
require_once 'data/dummy-data.php';

// Default filtered events (show all initially)
$filtered_events = $events;

// Get the user input (suburb or postcode)
$user_input = isset($_GET['search']) ? $_GET['search'] : '';

// Process the search if coming from AJAX or initial page load
if (isset($_GET['ajax']) || $user_input) {
    // If the user input is a postcode, filter events by postcode
    if ($user_input && is_numeric($user_input)) {
        // Filter events by postcode
        $filtered_events = array_filter($events, function($event) use ($user_input) {
            return $event["postcode"] === $user_input;
        });
    // If the user input is a suburb, convert it to postcode and filter events
    } elseif ($user_input) {
        $user_postcode = getPostcodeFromSuburb($user_input, $suburb_to_postcode);
        if ($user_postcode) {
            // Filter events by the found postcode
            $filtered_events = array_filter($events, function($event) use ($user_postcode) {
                return $event["postcode"] === $user_postcode;
            });
        } else {
            // If the suburb is not found in the list, show no events
            $filtered_events = [];
        }
    }

    // If this is an AJAX request, return only the events HTML
    if (isset($_GET['ajax'])) {
        include 'includes/event-cards.php';
        exit;
    }
}

// Include the page template
include 'includes/header.php';
include 'includes/search-bar.php';
?>


<!-- Events Section with Carousel -->
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between mb-8">
        <h2 class="text-3xl font-bold text-gray-900 mb-4 sm:mb-0">Events Near You</h2>
        <div class="flex space-x-2">
            <select id="sortEvents" class="block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md">
                <option value="all">All Events</option>
                <option value="date">Sort by Date</option>
                <option value="name">Sort by Name</option>
            </select>
        </div>
    </div>

    <!-- Carousel Container -->
    <div class="relative">
        <!-- Carousel Navigation Buttons -->
        <button id="prevButton" class="absolute left-0 top-1/2 transform -translate-y-1/2 z-10 bg-white rounded-full p-2 shadow-lg hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500 disabled:opacity-50 disabled:cursor-not-allowed">
            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
        </button>
        
        <div id="eventsCarousel" class="overflow-hidden">
            <div id="eventsContainer" class="flex transition-transform duration-300 ease-in-out">
                <?php include 'includes/event-cards.php'; ?>
            </div>
        </div>
        
        <button id="nextButton" class="absolute right-0 top-1/2 transform -translate-y-1/2 z-10 bg-white rounded-full p-2 shadow-lg hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500 disabled:opacity-50 disabled:cursor-not-allowed">
            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
        </button>
    </div>
    
    <!-- Pagination dots -->
    <div id="carouselPagination" class="flex justify-center mt-6 space-x-2">
        <!-- Pagination dots will be added by JavaScript -->
    </div>
</div>

<!-- Modal Overlay -->
<div id="eventModalOverlay" class="fixed inset-0 hidden bg-black bg-opacity-50 z-40"></div>

<!-- Modal Structure -->
<div id="eventModal" class="fixed inset-0 hidden flex items-center justify-center z-50">
    <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-2xl relative">
        <h2 id="modalEventName" class="text-xl font-bold mb-2"></h2>
        <div class="flex items-center text-gray-600 mb-2">
            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
            </svg>
            <p id="modalEventDate" class="text-gray-600"></p>
        </div>
        <div class="flex items-center text-gray-600 mb-2">
            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <p id="modalEventTime" class="text-gray-600"></p>
        </div>
        <div class="flex items-center text-gray-600 mb-2">
            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
            </svg>
            <p id="modalEventLocation" class="text-gray-600"></p>
        </div>
        <p id="modalEventDescription" class="text-gray-700 mb-4"></p>

        <!-- Buttons Container -->
        <div class="flex justify-between">
            <button onclick="closeModal()" class="w-1/2 bg-red-600 hover:bg-red-700 text-white font-medium py-2 px-4 rounded-lg transition-colors duration-300 mr-2">
                Close
            </button>
            <button class="w-1/2 bg-green-600 hover:bg-green-700 text-white font-medium py-2 px-4 rounded-lg transition-colors duration-300">
                Join Event
            </button>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>

<script>
function openModal(event) {
    document.getElementById('modalEventName').textContent = event.name;
    document.getElementById('modalEventDate').textContent = event.start_date;
    document.getElementById('modalEventTime').textContent = event.start_time;
    document.getElementById('modalEventLocation').textContent = event.localized_address_display;
    document.getElementById('modalEventDescription').textContent = event.summary;
    
    document.getElementById('eventModal').classList.remove('hidden');
    document.getElementById('eventModalOverlay').classList.remove('hidden');
    
    // Disable scrolling
    document.body.style.overflow = 'hidden';
}

function closeModal() {
    document.getElementById('eventModal').classList.add('hidden');
    document.getElementById('eventModalOverlay').classList.add('hidden');
    
    // Enable scrolling again
    document.body.style.overflow = 'auto';
}

// Close modal when clicking outside the modal content
document.addEventListener('click', function (event) {
    let modal = document.getElementById('eventModal');
    let overlay = document.getElementById('eventModalOverlay');
    
    // If clicking directly on the overlay (background), close the modal
    if (event.target === modal) {
        closeModal();
    }
});
</script>