var tweetSearch;
var instaSearch;

$(document).ready(function(){
  var searchField = $('#search');
  var timer;
    
  console.log('document loaded');

    /**
   * keycode glossary
   * 32 = SPACE
   * 188 = COMMA
   * 189 = DASH
   * 190 = PERIOD
   * 191 = BACKSLASH
   * 13 = ENTER
   * 219 = LEFT BRACKET
   * 220 = FORWARD SLASH
   * 221 = RIGHT BRACKET
   */

  $(searchField).keydown(function(e){
    if(e.keyCode == '32' || e.keyCode == '188' || e.keyCode == '189' || e.keyCode == '13' || e.keyCode == '190' || e.keyCode == '219' || e.keyCode == '221' || e.keyCode == '191' || e.keyCode == '220') {
       e.preventDefault();
     } else {
          clearTimeout(timer);
          loading();
          timer = setTimeout(function() {
            instaSearch();
            //tweetSearch();
          }, 900);
          document.querySelector("#toast1").show();
     }
  });

  //tweetSearch
  tweetSearch = function(){
    var tag = $(searchField).val();
    if(tag == ''){
      document.querySelector("#toast2").show();
    }else{
      var Tweeturl = 'get-tweets.php?tag='+tag;
      postRequest(Tweeturl);
    }
  }

  instaSearch = function() {
    var tag = $(searchField).val();
    if(tag == ''){
      document.querySelector("#toast2").show();
    }else{
      var Instaurl = 'instasearch.php?tag='+tag;
      postRequest(Instaurl);
    }
  }

});

//checks if polymer is loaded
window.addEventListener('polymer-ready', function(){
    instaSearch();
});

var result = "";

function updatepage(){
  loading();
  instaSearch();
  //tweetSearch();
}

function addToResult(str){
  var newResult = str + result;
  result = newResult;
//  $("#container").append("str");
  document.getElementById("container").innerHTML = result;
    console.log("container has run");
    
    //do some functions?
    var papers = document.getElementsByTagName('paper-item');
    
    /*
    for(var i=0; i<papers.length; i++){
        var paper = papers[i];
        paper.addEventListener('click', function(){
            console.log('became bigger and harder :D');
            if(this.className == 'item'){this.className = 'expand';}
            else{this.className = 'item';}
        }, false);
    }*/
}

function postRequest(strURL) {
 var xmlHttp;
 if (window.XMLHttpRequest) {
   // Mozilla, Safari, ...
   var xmlHttp = new XMLHttpRequest();
   } else if (window.ActiveXObject) {
   // IE
   var xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
   }

   xmlHttp.open('POST', strURL, true);

   xmlHttp.setRequestHeader('Content-Type',
        'application/x-www-form-urlencoded');

   xmlHttp.onreadystatechange = function() {
       if (xmlHttp.readyState == 4) {
           addToResult(xmlHttp.responseText);
       }
   }

   xmlHttp.send(strURL);
}

//declare loading
function loading(){
  result = "";
  document.querySelector("#toast1").show();
}
