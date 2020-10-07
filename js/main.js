$(document).ready(function (){
    var a = 0;
    setInterval(function (){
        a++;
        $("#timer").html("გავიდა " + a + " წამი!");
    }, 1000);
});

