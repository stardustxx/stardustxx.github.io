<?php
    
    //start a session
    session_start();
    
    //set tags
    if(empty($_SESSION['tag'])){$_SESSION['tag'] = '';}

    //set tweetID
    if(empty($_SESSION['tweetID'])){$_SESSION['tweetID'] = '0';}
    
    //set instaID
    if(empty($_SESSION['instaID'])){$_SESSION['instaID'] = '0';}
?>