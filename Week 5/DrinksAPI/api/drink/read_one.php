<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Expose-Headers: Content-Length, X-JSON");
header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
header("Access-Control-Allow-Headers: *");
header("Content-Type: application/json; charset=UTF-8");

  
// include database and object files
include_once '../config/database.php';
include_once '../objects/Drink.php';
  
// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare product object
$match = new Drink($db);
  
// set ID property of record to read
$match->id = isset($_GET['id']) ? $_GET['id'] : die();
  
// read the details of product to be edited
$match->readOne();
  
if($match->name != null) {
    // create array
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
  
    // set response code - 200 OK
    http_response_code(200);
  
    // make it json format
    echo json_encode($item);
}
else {
    // set response code - 404 Not found
    http_response_code(404);
  
    // no data found
    echo json_encode(array("message" => "No data available."));
}
?>