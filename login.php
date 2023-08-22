<?php 

header('Content-Type: application/json; charset=utf-8');

require_once 'utils/JwtUtil.php';

$header = getallheaders();
$key = $header['AuthorizationKey'];

$token = JwtUtil::generateToken($key);

echo json_encode(
   [
      'token' => $token,
      'expires_in' => '3600s'
   ]
);