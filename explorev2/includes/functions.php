<?php
// Function to simulate getting postcode from suburb
function getPostcodeFromSuburb($suburb, $suburb_to_postcode) {
    $suburb = trim(ucwords(strtolower($suburb)));
    return isset($suburb_to_postcode[$suburb]) ? $suburb_to_postcode[$suburb] : null;
}

// Add more utility functions here as needed