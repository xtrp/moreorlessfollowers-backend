<?php

include('./auth-token.php');

if(isset($_SERVER['HTTP_X_AUTH_TOKEN']) && $_SERVER['HTTP_X_AUTH_TOKEN'] == $auth_token) {
  try {
    $new_accounts = json_decode(file_get_contents('php://input'), true);
    file_put_contents('accounts.json', json_encode($new_accounts));
  } catch(Exception $e) {
    http_response_code(500);
    echo json_encode([ "message" => "A server error occurred." ]);
  }
} else {
  http_response_code(401);
  echo json_encode([ "message" => "Missing or bad authorization token." ]);
}

?>