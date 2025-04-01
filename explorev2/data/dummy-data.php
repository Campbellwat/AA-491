<?php
// Dummy event data
$events = [
    ["name" => "Puppy Playdate", "postcode" => "3000", "image" => "puppy-playdate.jpg", "date" => "2025-04-15", "time" => "14:00-16:00", "description" => "Join us for a fun afternoon where puppies can socialize and play together."],
    ["name" => "Doggo Day Out", "postcode" => "3001", "image" => "doggo-day.jpg", "date" => "2025-04-20", "time" => "10:00-13:00", "description" => "A day out in the park for all dog lovers and their furry friends."],
    ["name" => "Bark in the Park", "postcode" => "3002", "image" => "bark-park.jpg", "date" => "2025-04-22", "time" => "15:00-17:00", "description" => "Enjoy an afternoon of activities and games for dogs of all sizes."],
    ["name" => "Fetch Fest", "postcode" => "3003", "image" => "fetch-fest.jpg", "date" => "2025-04-25", "time" => "11:00-14:00", "description" => "A festival dedicated to the game of fetch with competitions and prizes."],
    ["name" => "Paws & Claws Meetup", "postcode" => "3004", "image" => "paws-claws.jpg", "date" => "2025-04-28", "time" => "13:00-16:00", "description" => "Meet other pet owners and share stories and tips about pet care."],
    ["name" => "Woofstock", "postcode" => "3218", "image" => "woofstock.jpg", "date" => "2025-05-01", "time" => "12:00-18:00", "description" => "A music festival where dogs are not just allowed but encouraged."],
    ["name" => "Canine Carnival", "postcode" => "3350", "image" => "canine-carnival.jpg", "date" => "2025-05-05", "time" => "11:00-15:00", "description" => "A carnival with games and activities designed for dogs and their owners."],
    ["name" => "Furry Friends Festival", "postcode" => "4000", "image" => "furry-friends.jpg", "date" => "2025-05-10", "time" => "10:00-16:00", "description" => "A festival celebrating all furry pets and their human companions."],
    ["name" => "Puppy Parade", "postcode" => "5000", "image" => "puppy-parade.jpg", "date" => "2025-05-15", "time" => "14:00-16:00", "description" => "Watch adorable puppies parade in cute costumes."],
    ["name" => "Bark-Off Battle", "postcode" => "6000", "image" => "bark-off.jpg", "date" => "2025-05-20", "time" => "13:00-15:00", "description" => "A fun competition to see which dog has the most unique bark."],
    ["name" => "Dogs of the World Show", "postcode" => "7000", "image" => "dogs-world.jpg", "date" => "2025-05-25", "time" => "10:00-17:00", "description" => "An exhibition showcasing dog breeds from around the world."],
    ["name" => "Barking Bash", "postcode" => "8000", "image" => "barking-bash.jpg", "date" => "2025-06-01", "time" => "12:00-15:00", "description" => "A celebration of all things dog with food, games, and more."],
    ["name" => "Tail Waggers Meetup", "postcode" => "9000", "image" => "tail-waggers.jpg", "date" => "2025-06-05", "time" => "14:00-16:00", "description" => "A casual meetup for dogs that love to wag their tails."],
    ["name" => "Pup-Topia", "postcode" => "2000", "image" => "pup-topia.jpg", "date" => "2025-06-10", "time" => "11:00-14:00", "description" => "A utopia for puppies with play areas and training sessions."],
    ["name" => "Doggos Unleashed", "postcode" => "3000", "image" => "doggos-unleashed.jpg", "date" => "2025-06-15", "time" => "13:00-16:00", "description" => "Let your dog run free in a safe and controlled environment."]
];

// Dummy mapping of suburb to postcode (for testing purposes)
$suburb_to_postcode = [
    "Melbourne" => "3000",
    "Geelong" => "3218",
    "Ballarat" => "3350",
    "East Melbourne" => "3002",
    "South Melbourne" => "3205",
    "North Melbourne" => "3051",
    "West Melbourne" => "3003",
    "Port Melbourne" => "3207",
    "South Yarra" => "3141",
    "Carlton" => "3053",
    "Fitzroy" => "3065",
    "St Kilda" => "3182",
    "Footscray" => "3011",
    "Richmond" => "3121",
    "Hawthorn" => "3122"
];