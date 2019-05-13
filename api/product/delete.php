<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// get database connection
include_once '../config/database.php';

// instantiate product object1
include_once '../objects/product.php';

$database = new Database();
$db = $database->getConnection();


$product = new Product($db);

// get product id
$product_id = isset($_GET['id']) ? $_GET['id'] : die();

echo $product_id;

// show all products
$stmt = $product->delete($product_id);
