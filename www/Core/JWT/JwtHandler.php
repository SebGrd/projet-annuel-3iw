<?php

// require './JWT.php';
// require './ExpiredException.php';
// require './SignatureInvalidException.php';
// require './BeforeValidException.php';

namespace App\Core\JWT;

/**
 * JSON Web Token implementation, based on this spec:
 * https://tools.ietf.org/html/rfc7519
 * @category Authentication
 * @package  Authentication_JWT
 * @author   Neuman Vong <neuman@twilio.com>
 * @author   Anant Narayanan <anant@php.net>
 * @license  http://opensource.org/licenses/BSD-3-Clause 3-clause BSD
 * @link     https://github.com/firebase/php-jwt
 */
class JwtHandler {
  protected $jwt_secrect;
  protected $token;
  protected $issuedAt;
  protected $expire;
  protected $jwt;

  public function __construct()
  {
    // set your default time-zone
    date_default_timezone_set('Europe/Paris');
    $this->issuedAt = time();
    
    // Token Validity (3600 second = 1hr) total 24h
    $this->expire = $this->issuedAt + (3600 * 24);

    // Set your secret or signature
    $this->jwt_secrect = "Groupe69_Secret_Signature";  
  }

  // ENCODING THE TOKEN
  public function _jwt_encode_data($iss,$data){
    try {
        $this->token = array(
        //Adding the identifier to the token (who issue the token)
        "iss" => $iss,
        "aud" => $iss,
        // Adding the current timestamp to the token, for identifying that when the token was issued.
        "iat" => $this->issuedAt,
        // Token expiration
        "exp" => $this->expire,
        // Payload
        "data"=> $data
      );

        $this->jwt = JWT::encode($this->token, $this->jwt_secrect);
        return $this->jwt;
    } catch (\Exception $e) {
      return $e;
    }

  }
  
  //DECODING THE TOKEN
  public function _jwt_decode_data($jwt_token){
    try{
      $decode = JWT::decode($jwt_token, $this->jwt_secrect, array('HS256'));
      return $decode->data;
    }
    catch(\App\Core\JWT\ExpiredException $e){
      return $e->getMessage();
    }
    catch(\App\Core\JWT\SignatureInvalidException $e){
      return $e->getMessage();
    }
    catch(\App\Core\JWT\BeforeValidException $e){
      return $e->getMessage();
    }
    catch(\DomainException $e){
      return $e->getMessage();
    }
    catch(\InvalidArgumentException $e){
      return $e->getMessage();
    }
    catch(\UnexpectedValueException $e){
      return $e->getMessage();
    }

  }
}