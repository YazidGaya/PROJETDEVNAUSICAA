//Lorsque tout le contenu de la page est chargé
document.addEventListener('DOMContentLoaded', function() {

    let size=6;//Définition de la taille de la grille

    //Définition des boutons de la grille (classement par ligne et colonne)
    var buttonsln1 = document.querySelectorAll('.ln1');
    var buttonsln2=document.querySelectorAll(".ln2");
    var buttonsln3=document.querySelectorAll(".ln3");
    var buttonsln4=document.querySelectorAll(".ln4");
    var buttonsln5=document.querySelectorAll(".ln5");
    var buttonsln6=document.querySelectorAll(".ln6");
    var buttonsln7=document.querySelectorAll(".ln7");
    var buttonsln8=document.querySelectorAll(".ln8");
    var buttonsln9=document.querySelectorAll(".ln9");
    var buttonsln10=document.querySelectorAll(".ln10");
    var buttonsln11=document.querySelectorAll(".ln11");
    var buttonsln12=document.querySelectorAll(".ln12");
    var buttonsln13=document.querySelectorAll(".ln13");
    var buttonsln14=document.querySelectorAll(".ln14");
    var buttonsln15=document.querySelectorAll(".ln15");
    

    var buttonscol1=document.querySelectorAll(".col1");
    var buttonscol2=document.querySelectorAll(".col2");
    var buttonscol3=document.querySelectorAll(".col3");
    var buttonscol4=document.querySelectorAll(".col4");
    var buttonscol5=document.querySelectorAll(".col5");
    var buttonscol6=document.querySelectorAll(".col6");
    var buttonscol7=document.querySelectorAll(".col7");
    var buttonscol8=document.querySelectorAll(".col8");
    var buttonscol9=document.querySelectorAll(".col9");
    var buttonscol10=document.querySelectorAll(".col10");
    var buttonscol11=document.querySelectorAll(".col11");
    var buttonscol12=document.querySelectorAll(".col12");
    var buttonscol13=document.querySelectorAll(".col13");
    var buttonscol14=document.querySelectorAll(".col14");
    var buttonscol15=document.querySelectorAll(".col15");
    

    var clickedln1=false;
    var clickedln2=false;
    var clickedln3=false;
    var clickedln4=false;
    var clickedln5=false;
    var clickedln6=false;
    var clickedln7=false;
    var clickedln8=false;
    var clickedln9=false;
    var clickedln10=false;
    var clickedln11=false;
    var clickedln12=false;
    var clickedln13=false;
    var clickedln14=false;
    var clickedln15=false;

    var clickedcol1=false;
    var clickedcol2=false;
    var clickedcol3=false;
    var clickedcol4=false;
    var clickedcol5=false;
    var clickedcol6=false;
    var clickedcol7=false;
    var clickedcol8=false;
    var clickedcol9=false;
    var clickedcol10=false;
    var clickedcol11=false;
    var clickedcol12=false;
    var clickedcol13=false;
    var clickedcol14=false;
    var clickedcol15=false;


    //Définition des nombres sur les côtés du tableau
    var thln1=document.querySelector("#thln1");
    var thln2=document.querySelector("#thln2");
    var thln3=document.querySelector("#thln3");
    var thln4=document.querySelector("#thln4");
    var thln5=document.querySelector("#thln5");
    var thln6=document.querySelector("#thln6");
    var thln7=document.querySelector("#thln7");
    var thln8=document.querySelector("#thln8");
    var thln9=document.querySelector("#thln9");
    var thln10=document.querySelector("#thln10");
    var thln11=document.querySelector("#thln11");
    var thln12=document.querySelector("#thln12");
    var thln13=document.querySelector("#thln13");
    var thln14=document.querySelector("#thln14");
    var thln15=document.querySelector("#thln15");
    

    var thcol1=document.querySelector("#thcol1");
    var thcol2=document.querySelector("#thcol2");
    var thcol3=document.querySelector("#thcol3");
    var thcol4=document.querySelector("#thcol4");
    var thcol5=document.querySelector("#thcol5");
    var thcol6=document.querySelector("#thcol6");
    var thcol7=document.querySelector("#thcol7");
    var thcol8=document.querySelector("#thcol8");
    var thcol9=document.querySelector("#thcol9");
    var thcol10=document.querySelector("#thcol10");
    var thcol11=document.querySelector("#thcol11");
    var thcol12=document.querySelector("#thcol12");
    var thcol13=document.querySelector("#thcol13");
    var thcol14=document.querySelector("#thcol14");
    var thcol15=document.querySelector("#thcol15");

    var valthln1=0;
    var valthln2=0;
    var valthln3=0;
    var valthln4=0;
    var valthln5=0;
    var valthln6=0;
    var valthln7=0;
    var valthln8=0;
    var valthln9=0;
    var valthln10=0;
    var valthln11=0;
    var valthln12=0;
    var valthln13=0;
    var valthln14=0;
    var valthln15=0;

    var valthcol1=0;
    var valthcol2=0;
    var valthcol3=0;
    var valthcol4=0;
    var valthcol5=0;
    var valthcol6=0;
    var valthcol7=0;
    var valthcol8=0;
    var valthcol9=0;
    var valthcol10=0;
    var valthcol11=0;
    var valthcol12=0;
    var valthcol13=0;
    var valthcol14=0;
    var valthcol15=0;

    thln1.innerHTML=`<h2>${valthln1}</h2>`;
    thln2.innerHTML=`<h2>${valthln2}</h2>`;
    thln3.innerHTML=`<h2>${valthln3}</h2>`;
    thln4.innerHTML=`<h2>${valthln4}</h2>`;
    thln5.innerHTML=`<h2>${valthln5}</h2>`;
    thln6.innerHTML=`<h2>${valthln6}</h2>`;
    if(thln7!=null){
        thln7.innerHTML=`<h2>${valthln7}</h2>`;
        size++;
    }
    if(thln8!=null){
        thln8.innerHTML=`<h2>${valthln8}</h2>`;
        size++;
    }
    if(thln9!=null){
        thln9.innerHTML=`<h2>${valthln9}</h2>`;
        size++;
    }
    if(thln10!=null){
        thln10.innerHTML=`<h2>${valthln10}</h2>`;
        size++;
    }
    if(thln11!=null){
        thln11.innerHTML=`<h2>${valthln11}</h2>`;
        size++;
    }
    if(thln12!=null){
        thln12.innerHTML=`<h2>${valthln12}</h2>`;
        size++;
    }
    if(thln13!=null){
        thln13.innerHTML=`<h2>${valthln13}</h2>`;
        size++;
    }
    if(thln14!=null){
        thln14.innerHTML=`<h2>${valthln14}</h2>`;
        size++;
    }
    if(thln15!=null){
        thln15.innerHTML=`<h2>${valthln15}</h2>`;
        size++;
    }
    

    thcol1.innerHTML=`<h2>${valthcol1}</h2>`;
    thcol2.innerHTML=`<h2>${valthcol2}</h2>`;
    thcol3.innerHTML=`<h2>${valthcol3}</h2>`;
    thcol4.innerHTML=`<h2>${valthcol4}</h2>`;
    thcol5.innerHTML=`<h2>${valthcol5}</h2>`;
    thcol6.innerHTML=`<h2>${valthcol6}</h2>`;
    if(thcol7!=null){thcol7.innerHTML=`<h2>${valthcol7}</h2>`;}
    if(thcol8!=null){thcol8.innerHTML=`<h2>${valthcol8}</h2>`;}
    if(thcol9!=null){thcol9.innerHTML=`<h2>${valthcol9}</h2>`;}
    if(thcol10!=null){thcol10.innerHTML=`<h2>${valthcol10}</h2>`;}
    if(thcol11!=null){thcol11.innerHTML=`<h2>${valthcol11}</h2>`;}
    if(thcol12!=null){thcol12.innerHTML=`<h2>${valthcol12}</h2>`;}
    if(thcol13!=null){thcol13.innerHTML=`<h2>${valthcol13}</h2>`;}
    if(thcol14!=null){thcol14.innerHTML=`<h2>${valthcol14}</h2>`;}
    if(thcol15!=null){thcol15.innerHTML=`<h2>${valthcol15}</h2>`;}
    
    //Si tel bouton contient un bateau, alors on incrémente la valeur de la ligne et de la colonne correspondante
    
    //Regroupement par lignes
    buttonsln1.forEach(function(button) {
        button.addEventListener('click', function() {
            if(clickedln1===true && (button.innerHTML==='<img src="images/smallBoat.png">' || button.innerHTML==='<img src="images/frontLeft.png">' || button.innerHTML==='<img src="images/frontRight.png">' || button.innerHTML==='<img src="images/frontTop.png">' || button.innerHTML==='<img src="images/frontBottom.png">' || button.innerHTML==='<img src="images/mid.png">')){
                clickedln1=true;
                valthln1++;
                thln1.innerHTML=`<h2>${valthln1}</h2>`;
            }
            
            if(clickedln1===false &&(button.innerHTML!='<img src="images/empty.png">' && button.innerHTML!='<img src="images/water.png">')){
                clickedln1=true;
                valthln1++;
                thln1.innerHTML=`<h2>${valthln1}</h2>`;
            }

            if(button.innerHTML===`<img src="images/empty.png">`){
                clickedln1=false;
                valthln1--;
                thln1.innerHTML=`<h2>${valthln1}</h2>`;
            }

        });
    });

    //Regroupement par lignes
    buttonsln2.forEach(function(button) {
        button.addEventListener('click', function() {
            if(clickedln2===true && (button.innerHTML==='<img src="images/smallBoat.png">' || button.innerHTML==='<img src="images/frontLeft.png">' || button.innerHTML==='<img src="images/frontRight.png">' || button.innerHTML==='<img src="images/frontTop.png">' || button.innerHTML==='<img src="images/frontBottom.png">' || button.innerHTML==='<img src="images/mid.png">')){
                clickedln2=true;
                valthln2++;
                thln2.innerHTML=`<h2>${valthln2}</h2>`;
            }
            
            if(clickedln2===false &&(button.innerHTML!='<img src="images/empty.png">' && button.innerHTML!='<img src="images/water.png">')){
                clickedln2=true;
                valthln2++;
                thln2.innerHTML=`<h2>${valthln2}</h2>`;
            }

            if(button.innerHTML===`<img src="images/empty.png">`){
                clickedln2=false;
                valthln2--;
                thln2.innerHTML=`<h2>${valthln2}</h2>`;
            }

        });
    });

    //Regroupement par lignes
    buttonsln3.forEach(function(button) {
        button.addEventListener('click', function() {
            if(clickedln3===true && (button.innerHTML==='<img src="images/smallBoat.png">' || button.innerHTML==='<img src="images/frontLeft.png">' || button.innerHTML==='<img src="images/frontRight.png">' || button.innerHTML==='<img src="images/frontTop.png">' || button.innerHTML==='<img src="images/frontBottom.png">' || button.innerHTML==='<img src="images/mid.png">')){
                clickedln3=true;
                valthln3++;
                thln3.innerHTML=`<h2>${valthln3}</h2>`;
            }
            
            if(clickedln3===false &&(button.innerHTML!='<img src="images/empty.png">' && button.innerHTML!='<img src="images/water.png">')){
                clickedln3=true;
                valthln3++;
                thln3.innerHTML=`<h2>${valthln3}</h2>`;
            }

            if(button.innerHTML===`<img src="images/empty.png">`){
                clickedln3=false;
                valthln3--;
                thln3.innerHTML=`<h2>${valthln3}</h2>`;
            }

        });
    });

    //Regroupement par lignes
    buttonsln4.forEach(function(button) {
        button.addEventListener('click', function() {
            if(clickedln4===true && (button.innerHTML==='<img src="images/smallBoat.png">' || button.innerHTML==='<img src="images/frontLeft.png">' || button.innerHTML==='<img src="images/frontRight.png">' || button.innerHTML==='<img src="images/frontTop.png">' || button.innerHTML==='<img src="images/frontBottom.png">' || button.innerHTML==='<img src="images/mid.png">')){
                clickedln4=true;
                valthln4++;
                thln4.innerHTML=`<h2>${valthln4}</h2>`;
            }
            
            if(clickedln4===false &&(button.innerHTML!='<img src="images/empty.png">' && button.innerHTML!='<img src="images/water.png">')){
                clickedln4=true;
                valthln4++;
                thln4.innerHTML=`<h2>${valthln4}</h2>`;
            }

            if(button.innerHTML===`<img src="images/empty.png">`){
                clickedln4=false;
                valthln4--;
                thln4.innerHTML=`<h2>${valthln4}</h2>`;
            }

        });
    });

    //Regroupement par lignes
    buttonsln5.forEach(function(button) {
        button.addEventListener('click', function() {
            if(clickedln5===true && (button.innerHTML==='<img src="images/smallBoat.png">' || button.innerHTML==='<img src="images/frontLeft.png">' || button.innerHTML==='<img src="images/frontRight.png">' || button.innerHTML==='<img src="images/frontTop.png">' || button.innerHTML==='<img src="images/frontBottom.png">' || button.innerHTML==='<img src="images/mid.png">')){
                clickedln5=true;
                valthln5++;
                thln5.innerHTML=`<h2>${valthln5}</h2>`;
            }
            
            if(clickedln5===false &&(button.innerHTML!='<img src="images/empty.png">' && button.innerHTML!='<img src="images/water.png">')){
                clickedln5=true;
                valthln5++;
                thln5.innerHTML=`<h2>${valthln5}</h2>`;
            }

            if(button.innerHTML===`<img src="images/empty.png">`){
                clickedln5=false;
                valthln5--;
                thln5.innerHTML=`<h2>${valthln5}</h2>`;
            }

        });
    });

    buttonsln6.forEach(function(button) {
        button.addEventListener('click', function() {
            if(clickedln6===true && (button.innerHTML==='<img src="images/smallBoat.png">' || button.innerHTML==='<img src="images/frontLeft.png">' || button.innerHTML==='<img src="images/frontRight.png">' || button.innerHTML==='<img src="images/frontTop.png">' || button.innerHTML==='<img src="images/frontBottom.png">' || button.innerHTML==='<img src="images/mid.png">')){
                clickedln6=true;
                valthln6++;
                thln6.innerHTML=`<h2>${valthln6}</h2>`;
            }
            
            if(clickedln6===false &&(button.innerHTML!='<img src="images/empty.png">' && button.innerHTML!='<img src="images/water.png">')){
                clickedln6=true;
                valthln6++;
                thln6.innerHTML=`<h2>${valthln6}</h2>`;
            }

            if(button.innerHTML===`<img src="images/empty.png">`){
                clickedln6=false;
                valthln6--;
                thln6.innerHTML=`<h2>${valthln6}</h2>`;
            }

        });
    });


    buttonsln7.forEach(function(button) {
        button.addEventListener('click', function() {
            if(clickedln7===true && (button.innerHTML==='<img src="images/smallBoat.png">' || button.innerHTML==='<img src="images/frontLeft.png">' || button.innerHTML==='<img src="images/frontRight.png">' || button.innerHTML==='<img src="images/frontTop.png">' || button.innerHTML==='<img src="images/frontBottom.png">' || button.innerHTML==='<img src="images/mid.png">')){
                clickedln7=true;
                valthln7++;
                thln7.innerHTML=`<h2>${valthln7}</h2>`;
            }
            
            if(clickedln7===false &&(button.innerHTML!='<img src="images/empty.png">' && button.innerHTML!='<img src="images/water.png">')){
                clickedln7=true;
                valthln7++;
                thln7.innerHTML=`<h2>${valthln7}</h2>`;
            }

            if(button.innerHTML===`<img src="images/empty.png">`){
                clickedln7=false;
                valthln7--;
                thln7.innerHTML=`<h2>${valthln7}</h2>`;
            }

        });
    });

    buttonsln8.forEach(function(button) {
        button.addEventListener('click', function() {
            if(clickedln8===true && (button.innerHTML==='<img src="images/smallBoat.png">' || button.innerHTML==='<img src="images/frontLeft.png">' || button.innerHTML==='<img src="images/frontRight.png">' || button.innerHTML==='<img src="images/frontTop.png">' || button.innerHTML==='<img src="images/frontBottom.png">' || button.innerHTML==='<img src="images/mid.png">')){
                clickedln8=true;
                valthln8++;
                thln8.innerHTML=`<h2>${valthln8}</h2>`;
            }
            
            if(clickedln8===false &&(button.innerHTML!='<img src="images/empty.png">' && button.innerHTML!='<img src="images/water.png">')){
                clickedln8=true;
                valthln8++;
                thln8.innerHTML=`<h2>${valthln8}</h2>`;
            }

            if(button.innerHTML===`<img src="images/empty.png">`){
                clickedln8=false;
                valthln8--;
                thln8.innerHTML=`<h2>${valthln8}</h2>`;
            }

        });
    });

    buttonsln9.forEach(function(button) {
        button.addEventListener('click', function() {
            if(clickedln9===true && (button.innerHTML==='<img src="images/smallBoat.png">' || button.innerHTML==='<img src="images/frontLeft.png">' || button.innerHTML==='<img src="images/frontRight.png">' || button.innerHTML==='<img src="images/frontTop.png">' || button.innerHTML==='<img src="images/frontBottom.png">' || button.innerHTML==='<img src="images/mid.png">')){
                clickedln9=true;
                valthln9++;
                thln9.innerHTML=`<h2>${valthln9}</h2>`;
            }
            
            if(clickedln9===false &&(button.innerHTML!='<img src="images/empty.png">' && button.innerHTML!='<img src="images/water.png">')){
                clickedln9=true;
                valthln9++;
                thln9.innerHTML=`<h2>${valthln9}</h2>`;
            }

            if(button.innerHTML===`<img src="images/empty.png">`){
                clickedln9=false;
                valthln9--;
                thln9.innerHTML=`<h2>${valthln9}</h2>`;
            }

        });
    });

    buttonsln10.forEach(function(button) {
        button.addEventListener('click', function() {
            if(clickedln10===true && (button.innerHTML==='<img src="images/smallBoat.png">' || button.innerHTML==='<img src="images/frontLeft.png">' || button.innerHTML==='<img src="images/frontRight.png">' || button.innerHTML==='<img src="images/frontTop.png">' || button.innerHTML==='<img src="images/frontBottom.png">' || button.innerHTML==='<img src="images/mid.png">')){
                clickedln10=true;
                valthln10++;
                thln10.innerHTML=`<h2>${valthln10}</h2>`;
            }
            
            if(clickedln10===false &&(button.innerHTML!='<img src="images/empty.png">' && button.innerHTML!='<img src="images/water.png">')){
                clickedln10=true;
                valthln10++;
                thln10.innerHTML=`<h2>${valthln10}</h2>`;
            }

            if(button.innerHTML===`<img src="images/empty.png">`){
                clickedln10=false;
                valthln10--;
                thln10.innerHTML=`<h2>${valthln10}</h2>`;
            }

        });
    });

    buttonsln11.forEach(function(button) {
        button.addEventListener('click', function() {
            if(clickedln11===true && (button.innerHTML==='<img src="images/smallBoat.png">' || button.innerHTML==='<img src="images/frontLeft.png">' || button.innerHTML==='<img src="images/frontRight.png">' || button.innerHTML==='<img src="images/frontTop.png">' || button.innerHTML==='<img src="images/frontBottom.png">' || button.innerHTML==='<img src="images/mid.png">')){
                clickedln11=true;
                valthln11++;
                thln11.innerHTML=`<h2>${valthln11}</h2>`;
            }
            
            if(clickedln11===false &&(button.innerHTML!='<img src="images/empty.png">' && button.innerHTML!='<img src="images/water.png">')){
                clickedln11=true;
                valthln11++;
                thln11.innerHTML=`<h2>${valthln11}</h2>`;
            }

            if(button.innerHTML===`<img src="images/empty.png">`){
                clickedln11=false;
                valthln11--;
                thln11.innerHTML=`<h2>${valthln11}</h2>`;
            }

        });
    });


    buttonsln12.forEach(function(button) {
        button.addEventListener('click', function() {
            if(clickedln12===true && (button.innerHTML==='<img src="images/smallBoat.png">' || button.innerHTML==='<img src="images/frontLeft.png">' || button.innerHTML==='<img src="images/frontRight.png">' || button.innerHTML==='<img src="images/frontTop.png">' || button.innerHTML==='<img src="images/frontBottom.png">' || button.innerHTML==='<img src="images/mid.png">')){
                clickedln12=true;
                valthln12++;
                thln12.innerHTML=`<h2>${valthln12}</h2>`;
            }
            
            if(clickedln12===false &&(button.innerHTML!='<img src="images/empty.png">' && button.innerHTML!='<img src="images/water.png">')){
                clickedln12=true;
                valthln12++;
                thln12.innerHTML=`<h2>${valthln12}</h2>`;
            }

            if(button.innerHTML===`<img src="images/empty.png">`){
                clickedln12=false;
                valthln12--;
                thln12.innerHTML=`<h2>${valthln12}</h2>`;
            }

        });
    });


    buttonsln13.forEach(function(button) {
        button.addEventListener('click', function() {
            if(clickedln13===true && (button.innerHTML==='<img src="images/smallBoat.png">' || button.innerHTML==='<img src="images/frontLeft.png">' || button.innerHTML==='<img src="images/frontRight.png">' || button.innerHTML==='<img src="images/frontTop.png">' || button.innerHTML==='<img src="images/frontBottom.png">' || button.innerHTML==='<img src="images/mid.png">')){
                clickedln13=true;
                valthln13++;
                thln13.innerHTML=`<h2>${valthln13}</h2>`;
            }
            
            if(clickedln13===false &&(button.innerHTML!='<img src="images/empty.png">' && button.innerHTML!='<img src="images/water.png">')){
                clickedln13=true;
                valthln13++;
                thln13.innerHTML=`<h2>${valthln13}</h2>`;
            }

            if(button.innerHTML===`<img src="images/empty.png">`){
                clickedln13=false;
                valthln13--;
                thln13.innerHTML=`<h2>${valthln13}</h2>`;
            }

        });
    });


    buttonsln14.forEach(function(button) {
        button.addEventListener('click', function() {
            if(clickedln14===true && (button.innerHTML==='<img src="images/smallBoat.png">' || button.innerHTML==='<img src="images/frontLeft.png">' || button.innerHTML==='<img src="images/frontRight.png">' || button.innerHTML==='<img src="images/frontTop.png">' || button.innerHTML==='<img src="images/frontBottom.png">' || button.innerHTML==='<img src="images/mid.png">')){
                clickedln14=true;
                valthln14++;
                thln14.innerHTML=`<h2>${valthln14}</h2>`;
            }
            
            if(clickedln14===false &&(button.innerHTML!='<img src="images/empty.png">' && button.innerHTML!='<img src="images/water.png">')){
                clickedln14=true;
                valthln14++;
                thln14.innerHTML=`<h2>${valthln14}</h2>`;
            }

            if(button.innerHTML===`<img src="images/empty.png">`){
                clickedln14=false;
                valthln14--;
                thln14.innerHTML=`<h2>${valthln14}</h2>`;
            }

        });
    });


    buttonsln15.forEach(function(button) {
        button.addEventListener('click', function() {
            if(clickedln15===true && (button.innerHTML==='<img src="images/smallBoat.png">' || button.innerHTML==='<img src="images/frontLeft.png">' || button.innerHTML==='<img src="images/frontRight.png">' || button.innerHTML==='<img src="images/frontTop.png">' || button.innerHTML==='<img src="images/frontBottom.png">' || button.innerHTML==='<img src="images/mid.png">')){
                clickedln15=true;
                valthln15++;
                thln15.innerHTML=`<h2>${valthln15}</h2>`;
            }
            
            if(clickedln15===false &&(button.innerHTML!='<img src="images/empty.png">' && button.innerHTML!='<img src="images/water.png">')){
                clickedln15=true;
                valthln15++;
                thln15.innerHTML=`<h2>${valthln15}</h2>`;
            }

            if(button.innerHTML===`<img src="images/empty.png">`){
                clickedln15=false;
                valthln15--;
                thln15.innerHTML=`<h2>${valthln15}</h2>`;
            }

        });
    });



//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////




    //Regroupement par colonnes
    buttonscol1.forEach(function(button) {
        button.addEventListener('click', function() {
            if(clickedcol1===true && (button.innerHTML==='<img src="images/smallBoat.png">' || button.innerHTML==='<img src="images/frontLeft.png">' || button.innerHTML==='<img src="images/frontRight.png">' || button.innerHTML==='<img src="images/frontTop.png">' || button.innerHTML==='<img src="images/frontBottom.png">' || button.innerHTML==='<img src="images/mid.png">')){
                clickedcol1=true;
                valthcol1++;
                thcol1.innerHTML=`<h2>${valthcol1}</h2>`;
            }
            
            if(clickedcol1===false &&(button.innerHTML!='<img src="images/empty.png">' && button.innerHTML!='<img src="images/water.png">')){
                clickedcol1=true;
                valthcol1++;
                thcol1.innerHTML=`<h2>${valthcol1}</h2>`;
            }

            if(button.innerHTML===`<img src="images/empty.png">`){
                clickedcol1=false;
                valthcol1--;
                thcol1.innerHTML=`<h2>${valthcol1}</h2>`;
            }

        });
    });
    


    //Regroupement par colonnes
    buttonscol2.forEach(function(button) {
        button.addEventListener('click', function() {
            if(clickedcol2===true && (button.innerHTML==='<img src="images/smallBoat.png">' || button.innerHTML==='<img src="images/frontLeft.png">' || button.innerHTML==='<img src="images/frontRight.png">' || button.innerHTML==='<img src="images/frontTop.png">' || button.innerHTML==='<img src="images/frontBottom.png">' || button.innerHTML==='<img src="images/mid.png">')){
                clickedcol2=true;
                valthcol2++;
                thcol2.innerHTML=`<h2>${valthcol2}</h2>`;
            }
            
            if(clickedcol2===false &&(button.innerHTML!='<img src="images/empty.png">' && button.innerHTML!='<img src="images/water.png">')){
                clickedcol2=true;
                valthcol2++;
                thcol2.innerHTML=`<h2>${valthcol2}</h2>`;
            }

            if(button.innerHTML===`<img src="images/empty.png">`){
                clickedcol2=false;
                valthcol2--;
                thcol2.innerHTML=`<h2>${valthcol2}</h2>`;
            }

        });
    });

    //Regroupement par colonnes
    buttonscol3.forEach(function(button) {
        button.addEventListener('click', function() {
            if(clickedcol3===true && (button.innerHTML==='<img src="images/smallBoat.png">' || button.innerHTML==='<img src="images/frontLeft.png">' || button.innerHTML==='<img src="images/frontRight.png">' || button.innerHTML==='<img src="images/frontTop.png">' || button.innerHTML==='<img src="images/frontBottom.png">' || button.innerHTML==='<img src="images/mid.png">')){
                clickedcol3=true;
                valthcol3++;
                thcol3.innerHTML=`<h2>${valthcol3}</h2>`;
            }
            
            if(clickedcol3===false &&(button.innerHTML!='<img src="images/empty.png">' && button.innerHTML!='<img src="images/water.png">')){
                clickedcol3=true;
                valthcol3++;
                thcol3.innerHTML=`<h2>${valthcol3}</h2>`;
            }

            if(button.innerHTML===`<img src="images/empty.png">`){
                clickedcol3=false;
                valthcol3--;
                thcol3.innerHTML=`<h2>${valthcol3}</h2>`;
            }

        });
    });



    //Regroupement par colonnes
    buttonscol4.forEach(function(button) {
        button.addEventListener('click', function() {
            if(clickedcol4===true && (button.innerHTML==='<img src="images/smallBoat.png">' || button.innerHTML==='<img src="images/frontLeft.png">' || button.innerHTML==='<img src="images/frontRight.png">' || button.innerHTML==='<img src="images/frontTop.png">' || button.innerHTML==='<img src="images/frontBottom.png">' || button.innerHTML==='<img src="images/mid.png">')){
                clickedcol4=true;
                valthcol4++;
                thcol4.innerHTML=`<h2>${valthcol4}</h2>`;
            }
            
            if(clickedcol4===false &&(button.innerHTML!='<img src="images/empty.png">' && button.innerHTML!='<img src="images/water.png">')){
                clickedcol4=true;
                valthcol4++;
                thcol4.innerHTML=`<h2>${valthcol4}</h2>`;
            }

            if(button.innerHTML===`<img src="images/empty.png">`){
                clickedcol4=false;
                valthcol4--;
                thcol4.innerHTML=`<h2>${valthcol4}</h2>`;
            }

        });
    });


    //Regroupement par colonnes
    buttonscol5.forEach(function(button) {
        button.addEventListener('click', function() {
            if(clickedcol5===true && (button.innerHTML==='<img src="images/smallBoat.png">' || button.innerHTML==='<img src="images/frontLeft.png">' || button.innerHTML==='<img src="images/frontRight.png">' || button.innerHTML==='<img src="images/frontTop.png">' || button.innerHTML==='<img src="images/frontBottom.png">' || button.innerHTML==='<img src="images/mid.png">')){
                clickedcol5=true;
                valthcol5++;
                thcol5.innerHTML=`<h2>${valthcol5}</h2>`;
            }
            
            if(clickedcol5===false &&(button.innerHTML!='<img src="images/empty.png">' && button.innerHTML!='<img src="images/water.png">')){
                clickedcol5=true;
                valthcol5++;
                thcol5.innerHTML=`<h2>${valthcol5}</h2>`;
            }

            if(button.innerHTML===`<img src="images/empty.png">`){
                clickedcol5=false;
                valthcol5--;
                thcol5.innerHTML=`<h2>${valthcol5}</h2>`;
            }

        });
    });


    //Regroupement par colonnes
    buttonscol6.forEach(function(button) {
        button.addEventListener('click', function() {
            if(clickedcol6===true && (button.innerHTML==='<img src="images/smallBoat.png">' || button.innerHTML==='<img src="images/frontLeft.png">' || button.innerHTML==='<img src="images/frontRight.png">' || button.innerHTML==='<img src="images/frontTop.png">' || button.innerHTML==='<img src="images/frontBottom.png">' || button.innerHTML==='<img src="images/mid.png">')){
                clickedcol6=true;
                valthcol6++;
                thcol6.innerHTML=`<h2>${valthcol6}</h2>`;
            }
            
            if(clickedcol6===false &&(button.innerHTML!='<img src="images/empty.png">' && button.innerHTML!='<img src="images/water.png">')){
                clickedcol6=true;
                valthcol6++;
                thcol6.innerHTML=`<h2>${valthcol6}</h2>`;
            }

            if(button.innerHTML===`<img src="images/empty.png">`){
                clickedcol6=false;
                valthcol6--;
                thcol6.innerHTML=`<h2>${valthcol6}</h2>`;
            }

        });
    });

    //Regroupement par colonnes
    buttonscol7.forEach(function(button) {
        button.addEventListener('click', function() {
            if(clickedcol7===true && (button.innerHTML==='<img src="images/smallBoat.png">' || button.innerHTML==='<img src="images/frontLeft.png">' || button.innerHTML==='<img src="images/frontRight.png">' || button.innerHTML==='<img src="images/frontTop.png">' || button.innerHTML==='<img src="images/frontBottom.png">' || button.innerHTML==='<img src="images/mid.png">')){
                clickedcol7=true;
                valthcol7++;
                thcol7.innerHTML=`<h2>${valthcol7}</h2>`;
            }
            
            if(clickedcol7===false &&(button.innerHTML!='<img src="images/empty.png">' && button.innerHTML!='<img src="images/water.png">')){
                clickedcol7=true;
                valthcol7++;
                thcol7.innerHTML=`<h2>${valthcol7}</h2>`;
            }

            if(button.innerHTML===`<img src="images/empty.png">`){
                clickedcol7=false;
                valthcol7--;
                thcol7.innerHTML=`<h2>${valthcol7}</h2>`;
            }

        });
    });

    //Regroupement par colonnes
    buttonscol8.forEach(function(button) {
        button.addEventListener('click', function() {
            if(clickedcol8===true && (button.innerHTML==='<img src="images/smallBoat.png">' || button.innerHTML==='<img src="images/frontLeft.png">' || button.innerHTML==='<img src="images/frontRight.png">' || button.innerHTML==='<img src="images/frontTop.png">' || button.innerHTML==='<img src="images/frontBottom.png">' || button.innerHTML==='<img src="images/mid.png">')){
                clickedcol8=true;
                valthcol8++;
                thcol8.innerHTML=`<h2>${valthcol8}</h2>`;
            }
            
            if(clickedcol8===false &&(button.innerHTML!='<img src="images/empty.png">' && button.innerHTML!='<img src="images/water.png">')){
                clickedcol8=true;
                valthcol8++;
                thcol8.innerHTML=`<h2>${valthcol8}</h2>`;
            }

            if(button.innerHTML===`<img src="images/empty.png">`){
                clickedcol8=false;
                valthcol8--;
                thcol8.innerHTML=`<h2>${valthcol8}</h2>`;
            }

        });
    });


    //Regroupement par colonnes
    buttonscol9.forEach(function(button) {
        button.addEventListener('click', function() {
            if(clickedcol9===true && (button.innerHTML==='<img src="images/smallBoat.png">' || button.innerHTML==='<img src="images/frontLeft.png">' || button.innerHTML==='<img src="images/frontRight.png">' || button.innerHTML==='<img src="images/frontTop.png">' || button.innerHTML==='<img src="images/frontBottom.png">' || button.innerHTML==='<img src="images/mid.png">')){
                clickedcol9=true;
                valthcol9++;
                thcol9.innerHTML=`<h2>${valthcol9}</h2>`;
            }
            
            if(clickedcol9===false &&(button.innerHTML!='<img src="images/empty.png">' && button.innerHTML!='<img src="images/water.png">')){
                clickedcol9=true;
                valthcol9++;
                thcol9.innerHTML=`<h2>${valthcol9}</h2>`;
            }

            if(button.innerHTML===`<img src="images/empty.png">`){
                clickedcol9=false;
                valthcol9--;
                thcol9.innerHTML=`<h2>${valthcol9}</h2>`;
            }

        });
    });


    //Regroupement par colonnes
    buttonscol10.forEach(function(button) {
        button.addEventListener('click', function() {
            if(clickedcol10===true && (button.innerHTML==='<img src="images/smallBoat.png">' || button.innerHTML==='<img src="images/frontLeft.png">' || button.innerHTML==='<img src="images/frontRight.png">' || button.innerHTML==='<img src="images/frontTop.png">' || button.innerHTML==='<img src="images/frontBottom.png">' || button.innerHTML==='<img src="images/mid.png">')){
                clickedcol10=true;
                valthcol10++;
                thcol10.innerHTML=`<h2>${valthcol10}</h2>`;
                
                
                
            }
            
            if(clickedcol10===false &&(button.innerHTML!='<img src="images/empty.png">' && button.innerHTML!='<img src="images/water.png">')){
                clickedcol10=true;
                valthcol10++;
                thcol10.innerHTML=`<h2>${valthcol10}</h2>`;
            }

            if(button.innerHTML===`<img src="images/empty.png">`){
                clickedcol10=false;
                valthcol10--;
                thcol10.innerHTML=`<h2>${valthcol10}</h2>`;
            }

        });
    }); 


        //Regroupement par colonnes
        buttonscol11.forEach(function(button) {
            button.addEventListener('click', function() {
                if(clickedcol11===true && (button.innerHTML==='<img src="images/smallBoat.png">' || button.innerHTML==='<img src="images/frontLeft.png">' || button.innerHTML==='<img src="images/frontRight.png">' || button.innerHTML==='<img src="images/frontTop.png">' || button.innerHTML==='<img src="images/frontBottom.png">' || button.innerHTML==='<img src="images/mid.png">')){
                    clickedcol11=true;
                    valthcol11++;
                    thcol11.innerHTML=`<h2>${valthcol11}</h2>`;                    
                }
                
                if(clickedcol11===false &&(button.innerHTML!='<img src="images/empty.png">' && button.innerHTML!='<img src="images/water.png">')){
                    clickedcol11=true;
                    valthcol11++;
                    thcol11.innerHTML=`<h2>${valthcol11}</h2>`;
                }
    
                if(button.innerHTML===`<img src="images/empty.png">`){
                    clickedcol11=false;
                    valthcol11--;
                    thcol11.innerHTML=`<h2>${valthcol11}</h2>`;
                }
    
            });
        });
    

        
        //Regroupement par colonnes
        buttonscol12.forEach(function(button) {
            button.addEventListener('click', function() {
                if(clickedcol12===true && (button.innerHTML==='<img src="images/smallBoat.png">' || button.innerHTML==='<img src="images/frontLeft.png">' || button.innerHTML==='<img src="images/frontRight.png">' || button.innerHTML==='<img src="images/frontTop.png">' || button.innerHTML==='<img src="images/frontBottom.png">' || button.innerHTML==='<img src="images/mid.png">')){
                    clickedcol12=true;
                    valthcol12++;
                    thcol12.innerHTML=`<h2>${valthcol12}</h2>`;                    
                }
                
                if(clickedcol12===false &&(button.innerHTML!='<img src="images/empty.png">' && button.innerHTML!='<img src="images/water.png">')){
                    clickedcol12=true;
                    valthcol12++;
                    thcol12.innerHTML=`<h2>${valthcol12}</h2>`;
                }
    
                if(button.innerHTML===`<img src="images/empty.png">`){
                    clickedcol12=false;
                    valthcol12--;
                    thcol12.innerHTML=`<h2>${valthcol12}</h2>`;
                }
    
            });
        });


        //Regroupement par colonnes
        buttonscol13.forEach(function(button) {
            button.addEventListener('click', function() {
                if(clickedcol13===true && (button.innerHTML==='<img src="images/smallBoat.png">' || button.innerHTML==='<img src="images/frontLeft.png">' || button.innerHTML==='<img src="images/frontRight.png">' || button.innerHTML==='<img src="images/frontTop.png">' || button.innerHTML==='<img src="images/frontBottom.png">' || button.innerHTML==='<img src="images/mid.png">')){
                    clickedcol13=true;
                    valthcol13++;
                    thcol13.innerHTML=`<h2>${valthcol13}</h2>`;                    
                }
                
                if(clickedcol13===false &&(button.innerHTML!='<img src="images/empty.png">' && button.innerHTML!='<img src="images/water.png">')){
                    clickedcol13=true;
                    valthcol13++;
                    thcol13.innerHTML=`<h2>${valthcol13}</h2>`;
                }
    
                if(button.innerHTML===`<img src="images/empty.png">`){
                    clickedcol13=false;
                    valthcol13--;
                    thcol13.innerHTML=`<h2>${valthcol13}</h2>`;
                }
    
            });
        });

    
        //Regroupement par colonnes
        buttonscol14.forEach(function(button) {
            button.addEventListener('click', function() {
                if(clickedcol14===true && (button.innerHTML==='<img src="images/smallBoat.png">' || button.innerHTML==='<img src="images/frontLeft.png">' || button.innerHTML==='<img src="images/frontRight.png">' || button.innerHTML==='<img src="images/frontTop.png">' || button.innerHTML==='<img src="images/frontBottom.png">' || button.innerHTML==='<img src="images/mid.png">')){
                    clickedcol14=true;
                    valthcol14++;
                    thcol14.innerHTML=`<h2>${valthcol14}</h2>`;                    
                }
                
                if(clickedcol14===false &&(button.innerHTML!='<img src="images/empty.png">' && button.innerHTML!='<img src="images/water.png">')){
                    clickedcol14=true;
                    valthcol14++;
                    thcol14.innerHTML=`<h2>${valthcol14}</h2>`;
                }
    
                if(button.innerHTML===`<img src="images/empty.png">`){
                    clickedcol14=false;
                    valthcol14--;
                    thcol14.innerHTML=`<h2>${valthcol14}</h2>`;
                }
    
            });
        });


        //Regroupement par colonnes
        buttonscol15.forEach(function(button) {
            button.addEventListener('click', function() {
                if(clickedcol15===true && (button.innerHTML==='<img src="images/smallBoat.png">' || button.innerHTML==='<img src="images/frontLeft.png">' || button.innerHTML==='<img src="images/frontRight.png">' || button.innerHTML==='<img src="images/frontTop.png">' || button.innerHTML==='<img src="images/frontBottom.png">' || button.innerHTML==='<img src="images/mid.png">')){
                    clickedcol15=true;
                    valthcol15++;
                    thcol15.innerHTML=`<h2>${valthcol15}</h2>`;                    
                }
                
                if(clickedcol15===false &&(button.innerHTML!='<img src="images/empty.png">' && button.innerHTML!='<img src="images/water.png">')){
                    clickedcol15=true;
                    valthcol15++;
                    thcol15.innerHTML=`<h2>${valthcol15}</h2>`;
                }
    
                if(button.innerHTML===`<img src="images/empty.png">`){
                    clickedcol15=false;
                    valthcol15--;
                    thcol15.innerHTML=`<h2>${valthcol15}</h2>`;
                }
    
            });
        });

        let buttonDone=document.getElementById('donebutton');

        buttonDone.addEventListener('click',()=>{
            let values;
            let horizontalValues;
            let verticalValues;
            
            //La variable values s'adapte en fonction de la taille du niveau
            if(size===6){    
                horizontalValues=String(valthcol1)+"/"+String(valthcol2)+"/"+String(valthcol3)+"/"+String(valthcol4)+"/"+String(valthcol5)+"/"+String(valthcol6);
                verticalValues=String(valthln1)+"/"+String(valthln2)+"/"+String(valthln3)+"/"+String(valthln4)+"/"+String(valthln5)+"/"+String(valthln6);
            }
            if(size===8){
                horizontalValues=String(valthcol1)+"/"+String(valthcol2)+"/"+String(valthcol3)+"/"+String(valthcol4)+"/"+String(valthcol5)+"/"+String(valthcol6)+"/"+String(valthcol7)+"/"+String(valthcol8);
                verticalValues=String(valthln1)+"/"+String(valthln2)+"/"+String(valthln3)+"/"+String(valthln4)+"/"+String(valthln5)+"/"+String(valthln6)+"/"+String(valthln7)+"/"+String(valthln8);
            }
            if(size===10){
                horizontalValues=String(valthcol1)+"/"+String(valthcol2)+"/"+String(valthcol3)+"/"+String(valthcol4)+"/"+String(valthcol5)+"/"+String(valthcol6)+"/"+String(valthcol7)+"/"+String(valthcol8)+"/"+String(valthcol9)+"/"+String(valthcol10);
                verticalValues=String(valthln1)+"/"+String(valthln2)+"/"+String(valthln3)+"/"+String(valthln4)+"/"+String(valthln5)+"/"+String(valthln6)+"/"+String(valthln7)+"/"+String(valthln8)+"/"+String(valthln9)+"/"+String(valthln10);
                
            }
            if(size===15){
                    horizontalValues=String(valthcol1)+"/"+String(valthcol2)+"/"+String(valthcol3)+"/"+String(valthcol4)+"/"+String(valthcol5)+"/"+String(valthcol6)+"/"+String(valthcol7)+"/"+String(valthcol8)+"/"+String(valthcol9)+"/"+String(valthcol10)+"/"+String(valthcol11)+"/"+String(valthcol12)+"/"+String(valthcol13)+"/"+String(valthcol14)+"/"+String(valthcol15);
                    verticalValues=String(valthln1)+"/"+String(valthln2)+"/"+String(valthln3)+"/"+String(valthln4)+"/"+String(valthln5)+"/"+String(valthln6)+"/"+String(valthln7)+"/"+String(valthln8)+"/"+String(valthln9)+"/"+String(valthln10)+"/"+String(valthln11)+"/"+String(valthln12)+"/"+String(valthln13)+"/"+String(valthln14)+"/"+String(valthln15);
            }

            //Transmission des données (valeurs horizontales et verticales) par la méthode get
            window.location.href="send_level_to_db.php?horizontalValues="+String(horizontalValues)+"&verticalValues="+String(verticalValues);



            /*fetch("create.php", {
                method: "post",
                headers: {
                    "Content-Type": "application/json; charset=utf-8"
                },
                body: JSON.stringify(values)
            }).then(function (response) {
                return response.text();
            }).then(function (data) {
                console.log(values);
            });*/
        });


        if(size>=10){
            let allbuttons=document.querySelectorAll("button");
            allbuttons.forEach(function(button){
                button.style.width="50%";
            });
        }      



});




