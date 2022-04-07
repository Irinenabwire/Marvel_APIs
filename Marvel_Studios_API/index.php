<!DOCTYPE html>
	<head>
		<title>Marvel Characters</title>
		<link rel="stylesheet" href="./style.css">
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
		<link rel="stylesheet" href="css/index.css">
		<link rel="stylesheet" href="css/toolbar.css">
		<link rel="stylesheet" href="css/featured-character.css">
		<link rel="stylesheet" href="css/carousel.css">
	</head>
	<body>
		<h1>Marvel Multiverse Characters</h1>
		
		<header class="toolbar">
    <img src="img/marvel-logo.png" alt="Marvel logo" class="marvel-logo">
    <div class="search">
      <i class="material-icons icon-search">search</i>
      <input type="text" placeholder="Search for character" class="search-input">
    </div>
    <ul class="search-dropdown">
    </ul>
  </header>
  <main>
    <p class="error-message">Failed to load characters. Please, try again later.</p>
    <div class="container">
      <div class="featured-character">
        <div class="featured-character-img">
          <img alt="Featured Character" class="large-img">
          <div class="featured-character-details">
            <h1 class="character-name"></h1>
            <ul class="character-links">
            </ul>
          </div>
        </div>
        <div class="character-details">
          <h2>Description</h2>
          <p class="character-description"></p>
          <h2>Comics</h2>
          <ul class="character-comics">
          </ul>
        </div>
      </div>
    </div>
  </main>
		<?php
			$marvel_char_api = "https://gateway.marvel.com/v1/public/characters?";

			function call_to_api($api_endpoint){
				$publicKey = "c9c29cc4fa02de6883a32b6fda6b0aff";
				$privateKey = "a3ae5d34c47d02123f1568c3b7add349a6239995";
				$timeStamp = time();
				$hash_ = md5($timeStamp.$privateKey.$publicKey);
				$ch = curl_init();
				$url = $api_endpoint."&apikey=".$publicKey."&hash=".$hash_."&ts=".(string)$timeStamp;
				curl_setopt($ch, CURLOPT_URL, $url);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
								
				$data = curl_exec($ch);
				
				if(!$data){
					die("Connection failure");
				}
				curl_close($ch);
				
				return $data;
			}
			
			$response = json_decode(call_to_api($marvel_char_api), true);
			
			echo "<pre>";
			//print_r($response["data"]["results"][0]["comics"]["items"]);
			print_r($response);
			echo "</pre";
			$style = "list-style-type:none;margin:0;padding:0;display:inline-block;";

			// $characters = $response["data"]["results"][0]["comics"]["items"];
			// echo "<div id=ul>";
			// echo "<ul>";
			// $i=1;
			// foreach($characters as $actors){
			// 	echo "<li>";
			// 	echo "<div id=li, desc><img src=".$actors["resourceURI"].">";
			// 	echo $actors["name"]."</div>";
			// 	echo "</li>";
			// 	//if($i%5==0 && $i!=0)echo "<br>";
			// 	$i++;
			// }
			// echo "</ul>";
			// echo "</div>";
		?>
	</body>
	
</html>