<?php

/**
 * Classe responsável por gerar e validar o token
 */
class JwtUtil
{
    /**
     * Método responsável por validar o token
     */
    public static function validateToken($token)
    {
        $token_array = explode('.', $token);
        
        $header = $token_array[0];
        $payload = $token_array[1];
        $signature = $token_array[2];
        
        $chave = "3aR7hNfG8QkDpX2E5sT9uW1vYcZmB4qA6jLb";
        
        $validar_assinatura = hash_hmac('sha256', "$header.$payload", $chave, true);
        
        $validar_assinatura = base64_encode($validar_assinatura);
        
        if ($signature == $validar_assinatura) {
        
            $dados_token = base64_decode($payload);

            $dados_token = json_decode($dados_token);
        
            if ($dados_token->exp < time()) {
               header("HTTP/1.0 401 Unauthorized");
               echo json_encode(['error' => 'expired']);
               exit();
            }else{
               return true;
            }
        } else { 
            header("HTTP/1.0 401 Unauthorized");
            echo json_encode(['error' => 'Unauthorized']);
            exit();
        }

    }
    /**
     * Método responsável por gerar o token
     */
    public static function generateToken($key)
    {

        $header = [
            'alg' => 'HS256',
            'typ' => 'JWT',
        ];
        
        $header = json_encode($header);        
        $header = base64_encode($header);        
        $duracao = time() + 3600;
        
        $payload = [
            
            'exp' => $duracao,
            'id' => '1',
            'nome' => 'Wender Afonso',
        ];
        
        $payload = json_encode($payload);        
        $payload = base64_encode($payload);
        
        $chave = $key;
        
        $signature = hash_hmac('sha256', "$header.$payload", $chave, true);
        
        $signature = base64_encode($signature);
        
        return "$header.$payload.$signature";

    }
}
