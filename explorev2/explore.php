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
<?php include 'includes/footer.php'; ?>