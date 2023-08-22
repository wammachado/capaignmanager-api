<?php

/**
 * Classe responsável por configurar o JWT
 */
class JwtConfig {
   
    public static function validateAuthentication() {
        $headers = getallheaders();

        if (isset($headers['Authorization'])) {
            $token = str_replace('Bearer ', '', $headers['Authorization']);

            if (!empty($token)) {
                $jwtPayload = JwtUtil::validateToken($token);
                  
                if ($jwtPayload !== null) {                   
                    return true;                }
            }
        }

        header("HTTP/1.0 401 Unauthorized");
        echo json_encode(['error' => 'Unauthorized']);
        exit();
    }
}


