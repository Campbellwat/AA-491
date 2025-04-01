<?php if (!empty($filtered_events)): ?>
    <?php foreach ($filtered_events as $event): ?>
        <div class="event-tile flex-shrink-0 w-full sm:w-1/2 md:w-1/3 lg:w-1/4 p-4">
            <div class="flex flex-col bg-white rounded-lg shadow-lg overflow-hidden transition-transform duration-300 ease-in-out hover:scale-102 hover:shadow-xl h-full">
                <div class="h-40 bg-gray-200 relative">
                    <div class="absolute inset-0 bg-gradient-to-br from-blue-500 to-purple-600 opacity-80"></div>
                    <div class="absolute inset-0 flex items-center justify-center">
                        <svg class="w-16 h-16 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"></path>
                        </svg>
                    </div>
                </div>
                <div class="p-5 flex flex-col flex-grow">
                    <h3 class="text-xl font-bold text-gray-800 mb-2"><?php echo htmlspecialchars($event["name"]); ?></h3>
                    <div class="flex items-center text-gray-600 mb-2">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        <span><?php echo htmlspecialchars($event["postcode"]); ?></span>
                    </div>
                    <div class="flex items-center text-gray-600 mb-2">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        <span><?php echo htmlspecialchars($event["date"]); ?></span>
                    </div>
                    <div class="flex items-center text-gray-600 mb-3">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span><?php echo htmlspecialchars($event["time"]); ?></span>
                    </div>
                    <p class="text-gray-600 mb-4 flex-grow"><?php echo htmlspecialchars($event["description"]); ?></p>
                    <button class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg transition-colors duration-300">View Details</button>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
<?php else: ?>
    <div class="w-full text-center py-12">
        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
        </svg>
        <h3 class="mt-2 text-lg font-medium text-gray-900">No events found</h3>
        <p class="mt-1 text-gray-500">Try changing your search or check back later for new events.</p>
        <button id="clearSearch" class="mt-4 inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
            Clear Search
        </button>
    </div>
<?php endif; ?>