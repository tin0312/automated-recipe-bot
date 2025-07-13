<?php
ini_set('log_errors', 1);
error_reporting(E_ALL);

// Get user input safely
$userQuery = isset($_POST['user-input']) ? strtolower(trim($_POST['user-input'])) : '';
error_log("User input: $userQuery");
// Define recipes
$recipes = [
    [
        'id' => 1,
        'category' => 'beef',
        'name' => "Bò Kho (Vietnamese Beef Stew)",
        'author' => "Grandma Lan",
        'location' => "Saigon",
        'ingredients' => [
            "500g beef brisket or shank, cut into chunks",
            "2 carrots, cut into chunks",
            "3 garlic cloves, minced",
            "1 lemongrass stalk, bruised and chopped",
            "2 tablespoons fish sauce",
            "1 tablespoon soy sauce",
            "1 tablespoon sugar",
            "1 teaspoon five-spice powder",
            "1 tablespoon tomato paste",
            "1 star anise",
            "Salt and pepper to taste",
            "500ml water or coconut juice",
            "Fresh cilantro and basil (for garnish)",
            "French baguette or rice noodles (to serve)"
        ],
        'instructions' => [
            "Marinate beef with fish sauce, soy sauce, sugar, five-spice powder, and garlic for at least 1 hour.",
            "In a pot, heat oil and sauté lemongrass until fragrant.",
            "Add beef and sear on all sides.",
            "Add tomato paste, star anise, and water/coconut juice.",
            "Bring to boil, reduce heat, cover and simmer for 1.5–2 hours.",
            "Add carrots in the last 30 minutes of cooking.",
            "Adjust seasoning to taste.",
            "Serve hot with bread or noodles, garnish with herbs."
        ]
    ],
    [
        'id' => 2,
        'category' => 'beef',
        'name' => "Bò Lúc Lắc (Shaking Beef)",
        'author' => "Chef Tuan",
        'location' => "Hanoi",
        'ingredients' => [
            "400g beef sirloin or tenderloin, cut into cubes",
            "2 tablespoons soy sauce",
            "1 tablespoon oyster sauce",
            "1 teaspoon sugar",
            "1 tablespoon minced garlic",
            "1/2 teaspoon black pepper",
            "1 tablespoon vegetable oil",
            "1 small red onion, thinly sliced",
            "Lettuce, tomatoes, cucumber (for serving)",
            "Lime dipping sauce (salt, pepper, lime juice)"
        ],
        'instructions' => [
            "Marinate beef with soy sauce, oyster sauce, sugar, garlic, and pepper for at least 30 minutes.",
            "Heat oil in a pan over high heat.",
            "Add beef and quickly sear while shaking the pan to evenly cook.",
            "Add onion slices and sauté briefly until softened.",
            "Serve hot over a bed of lettuce and vegetables.",
            "Dip in lime sauce as desired."
        ]
    ],
    [
        'id' => 3,
        'category' => 'beef',
        'name' => "Phở Bò (Vietnamese Beef Noodle Soup)",
        'author' => "Aunt Mai",
        'location' => "Nam Định",
        'ingredients' => [
            "500g beef bones (marrow or knuckle)",
            "300g beef brisket or eye of round",
            "1 onion and 1 piece of ginger, charred",
            "1 cinnamon stick",
            "3 star anise",
            "3 cloves",
            "1 cardamom pod",
            "1 tsp coriander seeds",
            "1 tbsp fish sauce",
            "1 tsp salt",
            "Rice noodles (bánh phở)",
            "Fresh herbs: basil, cilantro, green onions",
            "Bean sprouts, lime wedges, chili (optional)"
        ],
        'instructions' => [
            "Boil bones briefly, discard water, rinse bones.",
            "Add bones to clean pot with water, onion, ginger, and spices.",
            "Simmer for 3–4 hours, skimming foam.",
            "Add fish sauce and salt to taste.",
            "Blanch noodles and place in bowls.",
            "Slice beef thinly and place over noodles.",
            "Pour hot broth over to cook the beef.",
            "Serve with herbs, sprouts, lime, and chili."
        ]
    ],
    [
        'id' => 4,
        'category' => 'beef',
        'name' => "Bún Bò Huế (Spicy Beef Noodle Soup)",
        'author' => "Mrs. Huong",
        'location' => "Huế",
        'ingredients' => [
            "500g beef shank",
            "500g pork hock (optional)",
            "1 stalk lemongrass, bruised",
            "3 tablespoons shrimp paste",
            "2 tablespoons chili oil",
            "1 tablespoon fish sauce",
            "1 onion, halved",
            "Salt and sugar to taste",
            "Rice vermicelli (bún)",
            "Fresh herbs: mint, cilantro, green onion",
            "Lime wedges, banana blossoms, chili (optional)"
        ],
        'instructions' => [
            "Boil beef and pork briefly, discard water, and clean meat.",
            "Refill pot with fresh water, add lemongrass and onion, simmer for 2 hours.",
            "Add shrimp paste, fish sauce, salt, and sugar. Adjust to taste.",
            "Cook vermicelli separately and place in bowls.",
            "Top with sliced meat, pour in broth, and drizzle with chili oil.",
            "Serve with herbs, lime, and banana blossoms."
        ]
    ],
    [
        'id' => 5,
        'category' => 'beef',
        'name' => "Bò Né (Vietnamese Sizzling Beef Steak)",
        'author' => "Uncle Dũng",
        'location' => "Cần Thơ",
        'ingredients' => [
            "2 beef steaks (sirloin or ribeye)",
            "2 eggs",
            "1 small onion, sliced",
            "1 tomato, sliced",
            "1 tablespoon soy sauce",
            "1 tablespoon oyster sauce",
            "1 teaspoon minced garlic",
            "1 tablespoon butter",
            "Salt and pepper to taste",
            "Pate (optional)",
            "Vietnamese baguette (bánh mì)"
        ],
        'instructions' => [
            "Marinate beef with soy sauce, oyster sauce, garlic, salt, and pepper for 30 mins.",
            "Heat a cast iron pan with butter until sizzling.",
            "Add steak and sear both sides.",
            "Push steak aside, add onion, tomato, and crack in the egg(s).",
            "Add a scoop of pate if using.",
            "Serve hot in the pan with baguette on the side."
        ]
    ],
    [
        'id' => 6,
        'category' => 'beef',
        'name' => "Bò Xào Sả Ớt (Stir-Fried Lemongrass Chili Beef)",
        'author' => "Chef Linh",
        'location' => "Đà Nẵng",
        'ingredients' => [
            "400g beef (flank or sirloin), thinly sliced",
            "2 stalks lemongrass, finely minced",
            "2 red chili peppers, thinly sliced",
            "1 tablespoon fish sauce",
            "1 tablespoon oyster sauce",
            "1 teaspoon sugar",
            "1 teaspoon minced garlic",
            "2 tablespoons cooking oil",
            "Fresh cilantro (for garnish)",
            "Steamed rice (to serve)"
        ],
        'instructions' => [
            "Marinate beef with fish sauce, oyster sauce, sugar, and garlic for 20 minutes.",
            "Heat oil in a wok or pan over medium heat.",
            "Add lemongrass and chili, stir-fry until fragrant.",
            "Add beef and stir-fry quickly until cooked through.",
            "Serve hot over rice, garnished with cilantro."
        ]
    ]
];

// Search for multiple matches
$matchedRecipes = [];

foreach ($recipes as $recipe) {
    if (stripos($recipe['name'], $userQuery) !== false) {
        $matchedRecipes[] = $recipe;
    }
}

// Output result
header('Content-Type: application/json');
if (!empty($matchedRecipes)) {
    echo json_encode([
        'status' => 'success',
        'results' => $matchedRecipes
    ]);
} else {
    echo json_encode([
        'status' => 'not_found',
        'message' => "No matching recipes found for '$userQuery'."
    ]);
}

