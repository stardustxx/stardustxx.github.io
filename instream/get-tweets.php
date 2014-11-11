<?php
	//inclue code bird to do the oauth lifting for us
	require_once('cb/codebird.php');

    //include our own data storage
    include_once('data.php');

	//store keys/tokens/secrets provided by Twitter
	$CONSUMER_KEY = 'L2MGbFUJ0Wuuovd6uI4Ow';
	$CONSUMER_SECRET = 'sHVzOKmJdYeW8XeuO8hNZZ1ObOi6XSGI1iU8lcY4';
	$ACCESS_TOKEN = '35382612-vHZ8ujNgIICRFAhuSsu7ILvPuU1XQyWL0GzpcZiZg';
	$ACCESS_TOKEN_SECRET = 'c0pviC5B01gDO11zfg0s0z91E58PrqCBvt56M4tA4gdM1';

	//Get authenticated
	\Codebird\Codebird::setConsumerKey($CONSUMER_KEY, $CONSUMER_SECRET);
	$cb = \Codebird\Codebird::getInstance();
	$cb->setToken($ACCESS_TOKEN, $ACCESS_TOKEN_SECRET);

	$reply = $cb->oauth2_token();

	if (!isset($bearer_token)){
		$bearer_token = $reply->access_token;
	}

	//app authentication
	\Codebird\Codebird::setBearerToken($bearer_token);

		//if the stored tag and given tag aren't the same
        if($_SESSION['tag'] != $_GET['tag']){
            //stored tag becomes the newer tag
            $_SESSION['tag'] = $_GET['tag'];    //echo 'changed tag to '.$_SESSION['tag'];
            //reset the id counter
            $_SESSION['tweetID'] = '0';
        }

        //echo $_SESSION['tweetID'];
        
        $tag = $_SESSION['tag'];
        $id = $_SESSION['tweetID'];


		//Create query
		$params = array(
			'q' => '#'.$tag,
            'include_entities' => 'true',
            'since_id' => $id,
			'count' => 15
		);

        //retrieve posts
        $api = "search_tweets";

        //Make the REST call
        $twitterRes = (array) $cb->$api($params);

        //convert results to an associative array
        $twitterData = json_decode(json_encode($twitterRes), true);

        //Optionally, store results in a file
        //file_put_contents("twitter.json", json_encode($twitterRes));


	//Output result
    $data = $twitterData['statuses'];

    //check if id stored, if not, add the id
    if(empty($id) && !empty($data)){
        $_SESSION['tweetID'] = $data[0]['id_str'];
    }

	if(!empty($data)){
		//display the profile data
		echo "<div class='post'>";
		//display tweets under
		foreach ($data as $item){
			echo "<section class='post'>";
				echo "<div class='post-description'>";
				echo "<div class = 'item titem'>";
                echo "<paper-shadow z='2'></paper-shadow>";
                echo "<paper-ripple fit></paper-ripple>";
				echo $item['text'];
				if(!empty($item['entities']['media']['0']['media_url'])){
					echo "<img src=\"".$item['entities']['media']['0']['media_url']."\" width=\"200\" height=\"200\"/>"; //getting the media image
				}
				echo "</paper-shadow></div></div>";
				echo "<p class='post-meta'>";
				//echo "<em>".$item['created_at']."</em>";
				echo "</p>";
				echo '<br/>';
			echo '</p>';
			echo '<br/>';
		}

		echo "</div>";
	}
?>
