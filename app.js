var selectedProject;
var projects = document.querySelector("#projectList");
var projectDetail = document.querySelector("#projectDetails");
var backButton = document.getElementById("backButton");
var projectTitle = document.getElementById("projectTitle");

$(document).ready(function(){
   $("#proJS").progressbar({
        value: 90
    });  
});

$(document).ready(function(){
   $("#proP").progressbar({
        value: 75
    });  
});

$(document).ready(function(){
   $("#proD").progressbar({
        value: 80
    });  
});

var bindTaskEvent = function(projectInput, projectDetailInput, order){
    $(projectInput).click(function(){
        $(projects).fadeOut('slow');
        $(projectTitle).fadeOut('slow', function(){
            $(projectDetailInput).fadeIn('slow');
            $(backButton).fadeIn('slow');
            if (order == 0){
                $(projectTitle).text("InStream").fadeIn('slow');      
            }
            else if (order == 1){
                $(projectTitle).text("MissBehuaCa").fadeIn('slow');   
            }
            else if (order == 2){
                $(projectTitle).text("Ordering System").fadeIn('slow');
            }   
        });
    });
    
    $(backButton).click(function(){
        $(backButton).fadeOut('slow');
        $(projectDetailInput).fadeOut('slow');                        
        $(projectTitle).fadeOut('slow', function(){
            $(projects).fadeIn('slow');
            $(projectTitle).text("My Projects").fadeIn('slow');
        });
    });

}

$(document).ready(function(){
   for (var i = 0; i < projects.children.length; i++){
        bindTaskEvent(projects.children[i], projectDetail.children[i], i);
   }
    $(function(){ 
    if ($(window).width() > 768){
        skrollr.init(); 
        console.log("on desktop");
    }
    
    $(window).on('resize', function () {
    if ($(window).width() <= 767) {
        skrollr.init().destroy(); 
    }
    else {
        skrollr.init();   
    }
  });
});
});


