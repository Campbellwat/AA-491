<?php if (!empty($filtered_events)): ?>
    <?php foreach ($filtered_events as $event): ?>
        <div class="event-tile flex-shrink-0 w-full sm:w-1/2 md:w-1/3 lg:w-1/4 p-4">
        <div onclick="openModal(<?php echo htmlspecialchars(json_encode($event)); ?>)" class="cursor-pointer flex flex-col bg-white rounded-lg shadow-lg overflow-hidden transition-transform duration-300 ease-in-out hover:scale-102 hover:shadow-xl h-full">
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

<!-- <script>
function openModal(event) {
    document.getElementById('modalEventName').textContent = event.name;
    document.getElementById('modalEventDate').textContent = event.date;
    document.getElementById('modalEventTime').textContent = event.time;
    document.getElementById('modalEventLocation').textContent = event.postcode;
    document.getElementById('modalEventDescription').textContent = event.description;
    document.getElementById('eventModal').classList.remove('hidden');
}

function closeModal() {
    document.getElementById('eventModal').classList.add('hidden');
}
</script> -->
