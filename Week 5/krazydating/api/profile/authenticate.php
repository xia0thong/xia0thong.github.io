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
include_once '../objects/Person.php';
  
// instantiate database and product object
$database = new Database();
$db = $database->getConnection();
  
// initialize object
$match = new Person($db);

$stmt = '';
$num = '';

// get search query
if( isset($_POST["email"]) && isset($_POST["password"]) ) {
    // Gender only
    $stmt = $match->authenticate($_POST["email"], $_POST["password"]);
}
else {
    // set response code - 404 Not found
    http_response_code(404);
  
    // tell the user no items found
    echo json_encode(
        array("message" => "Query parameters are not set. No results.")
    );
    exit;
}
  
// See query count
$num = $stmt->rowCount();
  
// check if more than 0 record found
if($num > 0) {
  
    // products array
    $result_arr = array();
    $result_arr["records"] = array();
  
    if( $row = $stmt->fetch(PDO::FETCH_ASSOC) ) {

        // If there's a match
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);

        $stmt = $match->get_by_id($id);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        extract($row);
  
        $item = array(
            "id" => $id,
            "name" => $name,
            "age" => $age,
            "gender" => $gender,
            "occupation" => $occupation,
            "city" => $city,
            "photo_url" => $photo_url
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
}
else {
    // set response code - 404 Not found
    http_response_code(404);
  
    // tell the user no items found
    echo json_encode(
        array("message" => "No items found.")
    );
}
?>