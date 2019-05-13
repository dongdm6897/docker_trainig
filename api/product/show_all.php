<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// get database connection
include_once '../config/database.php';

// instantiate product object1
include_once '../objects/product.php';

$database = new Database();
$db = $database->getConnection();


$product = new Product($db);
    // show all products
    $stmt = $product->showAll();
    $num = $stmt->rowCount();

    if($num >0 ){
        $products_arr=array();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            extract($row);
            $product_item=array(
                "id" => $id,
                "name" => $name,
                "description" => $description,
                "price" => $price,
                "category_id" => $category_id,
                "category_name" => $category_name
            );

            array_push($products_arr, $product_item);
        }
        echo json_encode($products_arr);

    }


    // if unable to show all product, tell the user
    else{

        // set response code - 503 service unavailable
        http_response_code(503);

        // tell the user
        echo json_encode(array("message" => "Unable to show all products."));
    }


