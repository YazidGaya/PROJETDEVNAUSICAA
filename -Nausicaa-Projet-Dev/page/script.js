
let buttontoggle=document.getElementById("themeswitch");
let cercle=document.getElementById("cercle");
var clicked=false;

buttontoggle.addEventListener("click",()=>{
    if(clicked===false){
        buttontoggle.style.backgroundColor="green";
        buttontoggle.style.borderColor="green";
        cercle.style.left="24.3px";
        cercle.style.boxShadow="0px 0px 3px white";
        clicked=true;
        
        //Mise en place du thème sombre
        document.querySelector("body").style.backgroundColor="black";
        document.querySelector("footer").style.backgroundColor="rgb(0 97 81)";
        document.querySelector("footer").style.color="white";
        document.querySelector(".contentpage").style.backgroundColor="rgb(82 82 82)";
        document.querySelector(".contentpage").style.color="white";
        document.querySelector(".headerall").style.backgroundColor="rgb(0, 97, 81)";
        document.querySelector(".logo table, .logo th, .logo td").style.backgroundColor="rgb(0, 97, 81)";
        document.getElementById("titreheader").style.backgroundColor="rgb(0, 97, 81)";
        document.getElementById("titreheader").style.color="white";
        document.querySelector("body").style.color="white";
        document.querySelector("tbody").style.color="white";
        document.getElementById("timer").style.backgroundColor="black";
        document.getElementById("timer").style.color="white";
        document.getElementById("controlbuttons").style.backgroundColor="#3a3a3a";
        document.querySelector("#imagebg").style.backgroundColor="#00000069";
        document.getElementsByClassName("headerall").style.backgroundColor="rgb(0, 97, 81)";
        let h1elements=document.querySelectorAll("h1");
        h1elements.forEach(function(h1elem){
            h1elem.style.color="white";
        });

        let buttonsplay=document.querySelectorAll(".buttonplay");
        buttonsplay.forEach(function(elem){
            elem.style.backgroundColor="#36af39";
        });
        
    }
    else{
        buttontoggle.style.backgroundColor="rgb(222, 222, 222)";
        buttontoggle.style.borderColor="rgb(222, 222, 222)";
        cercle.style.left="0px";
        cercle.style.boxShadow="0px 0px 3px grey";
        clicked=false;

        document.querySelector("body").style.backgroundColor="white";
        document.querySelector("footer").style.backgroundColor="rgb(0, 255, 213)";
        document.querySelector("footer").style.color="black";
        document.querySelector(".contentpage").style.backgroundColor="rgb(237, 237, 237)";
        document.querySelector(".contentpage").style.color="black";
        document.querySelector(".headerall .logo table, .logo th, .logo td").style.backgroundColor="rgb(0, 255, 213)"
        document.querySelector(".headerall").style.backgroundColor="rgb(0, 255, 213)";
        document.querySelector(".logo table, .logo th, .logo td").style.backgroundColor="rgb(0, 255, 213)";
        document.getElementById("titreheader").style.backgroundColor="rgb(0, 255, 213)";
        document.getElementById("titreheader").style.color="black";
        document.querySelector("body").style.color="black";
        document.querySelector("tbody").style.color="black";
        document.getElementById("timer").style.backgroundColor="rgb(237, 237, 237)";
        document.getElementById("timer").style.color="black";
        document.getElementById("controlbuttons").style.color="rgb(237, 237, 237)";
        document.getElementById("controlbuttons").style.backgroundColor="#d8d8d8";
        document.querySelector("#imagebg").style.backgroundColor="#00000000";
        document.getElementsByClassName("headerall").style.backgroundColor="rgb(0, 255, 213)";
        let h1elements=document.querySelectorAll("h1");
        h1elements.forEach(function(h1elem){
            h1elem.style.color="black";
        });
        let buttonsplay=document.querySelectorAll(".buttonplay");
        buttonsplay.forEach(function(elem){
            elem.style.backgroundColor="#6aeb6e";
        });
    }
});
