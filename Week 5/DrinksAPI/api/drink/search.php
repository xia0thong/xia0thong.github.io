<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Expose-Headers: Content-Length, X-JSON");
header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
header("Access-Control-Allow-Headers: *");
header("Content-Type: application/json; charset=UTF-8");
  
// include database and object files
include_once '../config/core.php';
include_once '../config/database.php';
include_once '../objects/Drink.php';
  
// instantiate database and product object
$database = new Database();
$db = $database->getConnection();
  
// initialize object
$match = new Drink($db);

$stmt = '';
$num = '';

$input_category = '';
$input_alcoholic = '';
$input_name = '';

if( isset($_GET["c"]) ) {
    $input_category = trim($_GET["c"]);
}
if( isset($_GET["a"]) ) {
    $input_alcoholic = trim($_GET["a"]);
}
if( isset($_GET["n"]) ) {
    $input_name = trim($_GET["n"]);
}

$stmt = $match->search_by_category_alcoholic_name($input_category, $input_alcoholic, $input_name);


if($stmt != '' && $stmt !== false) {
    // See query count
    $num = $stmt->rowCount();
}


// products array
$result_arr = array();
$result_arr["records"] = array();

while( $row = $stmt->fetch(PDO::FETCH_ASSOC) ) {
    // extract row
    // this will make $row['name'] to
    // just $name only
    extract($row);

    $item = array(
        "id" => $id,
        "name" => $name,
        "category" => $category,
        "alcoholic" => $alcoholic,
        "glass" => $glass,
        "instructions" => $instructions,
        "photo_url" => $photo_url,
        "ingredient1" => $ingredient1,
        "ingredient2" => $ingredient2,
        "ingredient3" => $ingredient3,
        "ingredient4" => $ingredient4,
        "ingredient5" => $ingredient5,
        "ingredient6" => $ingredient6,
        "ingredient7" => $ingredient7,
        "ingredient8" => $ingredient8,
        "ingredient9" => $ingredient9,
        "ingredient10" => $ingredient10
    );

    array_push($result_arr["records"], $item);
}

// Add info node (1 per response)
$date = new DateTime('', new DateTimeZone('Asia/Singapore'));
$result_arr["info"] = array(
    "author" => "Krazy Company",
    "response_datetime_singapore" => $date->format('Y-m-d H:i:sP')
);

// set response code - 200 OK
http_response_code(200);

// show products data
echo json_encode($result_arr);
?>