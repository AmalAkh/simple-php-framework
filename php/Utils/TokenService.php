<?php
require "Libs/JWT/JWT.php";
require "Libs/JWT/JWK.php";
require "Libs/JWT/Key.php";
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
class TokenService
{

  protected static $secretKey;
  protected static $encryptionAlg;


  static function setAuthParams($secretKey, $alg)
  {
    TokenService::$secretKey = $secretKey;
    TokenService::$encryptionAlg = $alg;

  }
  
  static function createAuthToken($id)
  {
    $payload = array(
    "iss" => "http://example.org",
    "aud" => "http://example.com",
    "iat" => time(),
    "nbf" => time(),
    "id"=>$id


    );
    return JWT::encode($payload, TokenService::$secretKey, TokenService::$encryptionAlg);

  }

  static function checkAuthToken($token)
  {
    //return (array)JWT::decode($token, new Key(TokenService::$secretKey, TokenService::$encryptionAlg));
   try
    {
      return (array)JWT::decode($token, new Key(TokenService::$secretKey, TokenService::$encryptionAlg));
    }catch(Exception $exp)
    {
      http_response_code(401);
      throw new Exception();
    }
  }

}

?>
