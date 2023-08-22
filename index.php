<?php

/**
 * @OA\Info(
 *     title="API de Campanhas",
 *     version="1.0.0",
 *     @OA\Contact(
 *         email=wammachado@gmail.com"
 *    )
 * )
 */

require_once 'config/database.php';
require_once 'utils/JwtUtil.php';
require_once 'config/jwt.php';
require_once 'controllers/CampanhaController.php';
require_once 'exceptions/ApiException.php';
require_once 'exceptions/NotFoundException.php';
require_once 'exceptions/ValidationException.php';
require_once 'models/Campanha.php';
require_once 'routes/routes.php';

header('Content-Type: application/json; charset=utf-8');

$headers = getallheaders();

if (isset($headers['Authorization'])) {
    $token = str_replace('Bearer ', '', $headers['Authorization']);
    
    $validate =JwtConfig::validateAuthentication($token);

    if ($validate) {

        $data = json_decode(file_get_contents('php://input'), true) ?? [];

        if (array_key_exists($method, $routes)) {

            $controllerAction = $routes[$method];
            list($controllerName, $methodName) = explode('@', $controllerAction);

            require_once 'controllers/' . $controllerName . '.php';

            $controller = new $controllerName();
            $response = $controller->$methodName($id, $data);

            echo json_encode($response);
        } else {
            header("HTTP/1.0 404 Not Found");
            echo json_encode(['error' => 'Endpoint not found']);
        }
    }
}else{
    header("HTTP/1.0 401 Unauthorized");
    echo json_encode(['error' => 'Unauthorized']);
    exit();
}
