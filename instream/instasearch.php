<?php
  header('Content-type: application/json');

  $CLIENT_ID = '332c1744fa094a458368bff138f07d6a';
  $CLIENT_SECRET = 'c1f8b69281fc4dceba14b3754d21df64';

  //include our own data storage
  include_once('data.php');

  //if the stored tag and given tag aren't the same
  if($_SESSION['tag'] != $_GET['tag']){
    //stored tag becomes the newer tag
    $_SESSION['tag'] = $_GET['tag'];    //echo 'changed tag to '.$_SESSION['tag'];
    //reset the id counter
    $_SESSION['instaID'] = '0';
  }
  
  $tag = $_SESSION['tag'];
  $id = $_SESSION['instaID'];
  $count = 60;

  $api = 'https://api.instagram.com/v1/tags/'.$tag.'/media/recent?client_id='.$CLIENT_ID.'&count='.$count;


  function get_curl($url) {
    if(function_exists('curl_init')) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        $output = curl_exec($ch);
        echo curl_error($ch);
        curl_close($ch);
        return $output;
    } else{
        return file_get_contents($url);
    }
  }

  //getting response
  $response = get_curl($api);
  $results = json_decode($response, true);

  //Optionally, store results in a file
  //file_put_contents("insta.json", json_encode($response));

  //Now parse through the $results array to display your results...
  if(!empty($results)){
    //store id to session
      //echo sizeof($results['data']);
        //start the lightbox album
        //echo "<section>";
        //echo "<ul class='lb-album'>";
    foreach($results['data'] as $item){
        $user = $item['user']['username'];
        $caption = $item['caption']['text'];
        
        echo "<paper-item class = 'item'>";
        echo "<paper-shadow z='2'></paper-shadow>";
        $image_link = $item['images']['standard_resolution']['url'];
        echo '<a href = "'.$image_link.'" data-lightbox = "insta" data-title="@'.$user.'<br>'.$caption.'">';
        echo "<paper-ripple fit></paper-ripple>";
        echo '<img id="img" src="'.$image_link.'" /></a>';
        
        //hidden content
        echo '<div class="card-right content" flex>';
            $user = $item['user']['username'];
            $url = $item['link'];
            echo '<div layout horizontal center><strong>'.$user.'</strong></div>';
            $caption = $item['caption']['text'];
           // echo '<div flex><p class="caption">'.$caption.'</p></div>';
        echo '</div>';
        
        echo "</paper-item>";
        
        /*
        //grabbing data
        $image_link = $item['images']['standard_resolution']['url'];
        $user = $item['user']['username'];
        $caption = $item['caption']['text'];
        
        //echo them
        echo "<li class='item'>";
            echo "<a href='#'>";
                echo '<img id="img" src="'.$image_link.'" />';
            echo "</a>";
            
            echo "<div class='li-overlay'>";
                echo '<img id="img" src="'.$image_link.'" />';
                echo "<div>";
                    echo "<h3>".$user."<span></h3>";
                    echo "<p>".$caption."</p>";
                echo "</div>";
                echo "<a href='#page' class='lib-close'>x Close</a>";
            echo "</div>";
        echo "</li>";
        */
    }
      
    //echo "</ul></section>";
  }else{
    echo "No Results!";
  }
?>
