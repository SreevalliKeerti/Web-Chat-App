$(document).ready(function(){
    $("#exit").click(function(){
        var exit = confirm("Click on OK to logout");
        if(exit==true){window.location = 'index.php?logout=true';}      
    });
});
 
$("#submitmsg").click(function(){
        var inchat = $("#chat").val();
        $.post("show.php", {text: inchat});              
        $("#chat").attr("value", "");
        loadmsg;
    return false;
});
 
function loadmsg(){     
    var prevspace = $("#chatspace").attr("scrollHeight") - 19; 
    $.ajax({
        url: "history.html",
        cache: false,
        success: function(html){        
            $("#chatspace").html(html); 
            var newspace = $("#chatspace").attr("scrollHeight") - 19; 
            if(newspace > prevspace){
                $("#chatspace").animate({ scrollTop: newspace }, 'normal');
            }               
        },
    });
}
 
setInterval (loadmsg, 500);