<!-- Hero Banner with Search Bar -->
<div class="relative bg-gradient-to-r from-blue-600 to-indigo-800 overflow-hidden">
    <div class="absolute inset-0">
        <svg class="w-full h-full" viewBox="0 0 100 100" preserveAspectRatio="none">
            <path d="M0,0 L100,0 L100,100 L0,100 Z" fill-opacity="0.1" fill="url(#pattern)" />
            <defs>
                <pattern id="pattern" patternUnits="userSpaceOnUse" width="10" height="10" x="0" y="0">
                    <circle cx="5" cy="5" r="1" fill="white" fill-opacity="0.2" />
                </pattern>
            </defs>
        </svg>
    </div>
    <div class="max-w-7xl mx-auto py-12 px-4 sm:py-16 sm:px-6 lg:px-8 lg:py-20 relative">
        <div class="text-center">
            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight text-white"> Explore Near You</h1>
            <p class="mt-4 max-w-3xl mx-auto text-lg sm:text-xl text-blue-100">Locations and events in your area.</p>
            <div class="mt-8 max-w-xl mx-auto">
                <div class="relative">
                    <div class="flex items-center">
                        <div class="relative flex-grow">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <input type="text" id="searchInput" name="search" class="block w-full pl-10 pr-3 py-3 sm:py-4 border border-transparent rounded-lg bg-white shadow-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-gray-900 placeholder-gray-500 text-base sm:text-lg" placeholder="Enter suburb or postcode" value="<?php echo htmlspecialchars($user_input ?? ''); ?>">
                            <div id="autocompleteResults" class="autocomplete hidden"></div>
                        </div>
                    </div>
                    <div id="searchStatus" class="mt-2 text-sm text-blue-200 hidden">
                        <div class="flex items-center">
                            <div class="spinner mr-2"></div>
                            <span>Searching...</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>