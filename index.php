<!DOCTYPE html>
<html>
<head>
  <title>
    My Name
  </title>
</head>

<body>
  <h1>Get My Name from Facebook</h1>
  
  <?php
  
  //vender をあなたが autoload.php を設置したパスに書き換えてください
  require_once __DIR__ . '/vendor/autoload.php';
  
  $fb = new \Facebook\Facebook([
    'app_id' => '{your-app-id}',           // {your-app-id} をあなたの app-id に書き換えてください
    'app_secret' => '{your-app-secret}',   //{your-app-secret} をあなたの app-secret に書き換えてください
    'graph_api_version' => 'v5.0',
  ]);
  
  
  try {
    
    // Get your UserNode object, {access-token} をあなたの access-token に書き換えてください
    $response = $fb->get('/me/?fields=posts{full_picture,message}', '{access-token}');
    
  } catch(\Facebook\Exceptions\FacebookResponseException $e) {
    // Returns Graph API errors when they occur
    echo 'Graph returned an error: ' . $e->getMessage();
    exit;
  } catch(\Facebook\Exceptions\FacebookSDKException $e) {
    // Returns SDK errors when validation fails or other local issues
    echo 'Facebook SDK returned an error: ' . $e->getMessage();
    exit;
  }
  
  $me = $response->getGraphUser();
  
  //All that is returned in the response
  // echo 'All the data returned from the Facebook server: ' . $me;
  
  //Print out my name
  // echo 'My name is ' . $me->getName();
  // echo 'My id is ' . $me->getId();
  $json = json_decode( $me , true ) ;
  for($i = 0; $i < count($json["posts"]) ; $i++){
    $full_picture = $json["posts"][$i]["full_picture"];
    $message = $json["posts"][$i]["message"];
    $full_picture_tag = "<img src=".$full_picture.">";
    $message_tag = "<p>".$message."</p>";
    echo "<div>".$full_picture_tag.$message_tag."</div>";
  }
  ?>
  
</body>
</html>
