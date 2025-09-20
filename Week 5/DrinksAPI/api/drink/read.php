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

// instantiate database and product object
$database = new Database();
$db = $database->getConnection();

// initialize object
$match = new Drink($db);

// query products
$stmt = $match->read();
$num = $stmt->rowCount();

// check if more than 0 record found
if($num > 0) {

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

    // show products data in json format
    echo json_encode($result_arr);
}
else {
  
    // set response code - 404 Not found
    http_response_code(404);
  
    // no data found
    echo json_encode(
        array("message" => "No data available.")
    );
}
?>