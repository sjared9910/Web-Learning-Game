   function range(){
        var range = document.getElementById("so").value;
        var a = document.querySelector(".brightness");

        a.style.opacity = range / 100;

        var c = document.getElementById("back");
        c.style.height = (range - 10) + "%";

        var d=document.getElementById("sun");
        if(range<=22){
            d.style.color="white";
        } else {
            d.style.color="black";
            c.style.textShadow="0px 0px 10px black";
        }
        
    }
