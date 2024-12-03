function changeImage(id){
    var buttons = document.getElementById(String(id));
    if(map[2 * id] > 1) // si au debut il est deja defini alors on ne peut le modifier
            return;
    if(tab[id] > 1){ //si on doit le transformer en vide
        tab[id] = 0;
        // on vient maintenant changer les images de ses voisins en fonction de sa position
        //si pas en haut
        if(id >= size && tab[id - size] > 1 && map[2 * (id - size)] <= 1)
            tab[id - size] = chooseImage(id - size);
        //si pas en bas
        if((id + size) <= (size * size) && tab[id + size] > 1 && map[2 * (id + size)] <= 1)
            tab[id + size] = chooseImage(id + size);
        //si pas a gauche
        if((id % size) != 0 && tab[id - 1] > 1 && map[2 * (id - 1)] <= 1)
            tab[id - 1] = chooseImage(id - 1);
        //si pas a droite
        if((id % size) != (size - 1) && tab[id + 1] > 1 && map[2 * (id + 1)] <= 1)
            tab[id +1] = chooseImage(id + 1);
    }else //sinon on change son etat (il devient eau ou bateau)
        tab[id]++;
    
    if(tab[id] == 0)
        buttons.innerHTML = '<img src="images/empty.png" />';
    if(tab[id] == 1)
        buttons.innerHTML = '<img src="images/water.png" />';

    // si la case devient une case bateau
    if(tab[id] > 1){
        // on choisit l'image adaptée
        tab[id] = chooseImage(id);
        //puis on actualise l'etat de ses voisins en focntion de sa position
        // si pas en haut
        if(id >= size && tab[id - size] > 1 && map[2 * (id - size)] <= 1)
            tab[id - size] = chooseImage(id - size);
        //si pas en bas
        if((id + size) <= (size * size) && tab[id + size] > 1 && map[2 * (id + size)] <= 1)
            tab[id + size] = chooseImage(id + size);
        //si pas a gauche
        if((id % size) != 0 && tab[id - 1] > 1 && map[2 * (id - 1)] <= 1)
            tab[id - 1] = chooseImage(id - 1);
        //si a droite
        if((id % size) != (size - 1) && tab[id + 1] > 1 && map[2 * (id + 1)] <= 1)
            tab[id + 1] = chooseImage(id + 1);
    }

    if (verifBoats() == 1 && verifGrid() == 1 && verifNotTouching() == 1) {
        gridSuccess();
    }
}

//focntion qui attribue la bonne valeur et image aux bateaux
function chooseImage(id){
    var buttons = document.getElementById(String(id));
    // si en haut a gauche
    if((id % size) == 0 && id < size){ 
        if(tab[id + 1] > 1){ //  si il possede un voisin a droite
            buttons.innerHTML = '<img src="images/frontLeft.png" />';
            return 6;
        }
        else { //sinon si il possede un voisin en bas          
            if(tab[id + size] > 1){
                buttons.innerHTML = '<img src="images/frontTop.png" />';
                return 5;
            }
            else{ //sinon bateau de 1
                buttons.innerHTML = '<img src="images/smallBoat.png" />';
                return 2;
            }
        }
    }

    // si en haut a droite
    if((id % size) == (size - 1) && id < size){ 
        if(tab[id - 1] > 1){ //si il possede un voisin a gauche
            buttons.innerHTML = '<img src="images/frontRight.png" />';
            return 7;
        }
        else { //sinon si il possede un voisin en bas
            if(tab[id + size] > 1){
                buttons.innerHTML = '<img src="images/frontTop.png" />';
                return 5;
            }
            else{ //sinon bateaud e 1
                buttons.innerHTML = '<img src="images/smallBoat.png" />';
                return 2;
            }
        }
    }

    // si en bas a droite
    if((id % size) == (size - 1) && (id + size) > (size * size)){ 
        if(tab[id - 1] > 1){ //si il possede un voisin a gauche
            buttons.innerHTML = '<img src="images/frontRight.png" />';
            return 7;
        }
        else { //sinon si il possede un voisin en haut
            if(tab[id - size] > 1){
                buttons.innerHTML = '<img src="images/frontBottom.png" />';
                return 4;
            }
            else{ //sinon bateaud e 1
                buttons.innerHTML = '<img src="images/smallBoat.png" />';
                return 2;
            }
        }
    }
    

    // si en bas a gauche
    if((id % size) == 0 && (id + size) > (size * size - 1)){ 
        if(tab[id + 1] > 1){ //si il possede un voisin a droite
            buttons.innerHTML = '<img src="images/frontLeft.png" />';
            return 6;
        }
        else { //sinon si il possede un voisin en haut
            if(tab[id - size] > 1){
                buttons.innerHTML = '<img src="images/frontBottom.png" />';
                return 4;
            }
            else{ //sinon bateau de 1
                buttons.innerHTML = '<img src="images/smallBoat.png" />';
                return 2;
            }
        }
    }

    // si en haut
    if(id < size){
        if(tab[id + size] > 1){ //si il possede un voisin en bas
            buttons.innerHTML = '<img src="images/frontTop.png" />';
            return(5);
        }
        else{ //sinon si il possede des voisin a gauche et a droite
            if(tab[id + 1] > 1 && tab[id - 1] > 1){
                buttons.innerHTML = '<img src="images/mid.png" />';
                return(3);
            }
            else{ //sinon si il possede un voisin uniquement a droite
                if(tab[id + 1] > 1){
                    buttons.innerHTML = '<img src="images/frontLeft.png" />';
                    return(6);
                }
                else{ //sinon si il possede un voisin uniquement a gauche
                    if(tab[id - 1] > 1){
                        buttons.innerHTML = '<img src="images/frontRight.png" />';
                        return(7);
                    }
                    else{ //sinon bateau de 1
                        buttons.innerHTML = '<img src="images/smallBoat.png" />';
                        return(2);
                    }
                }                        
            }
        }
    }

    //si en bas
    if((id + size) > (size * size - 1)){
        if(tab[id - size] > 1){ //si il possede un voisin en haut
            buttons.innerHTML = '<img src="images/frontBottom.png" />';
            return(4);
        }
        else{ //sinon si il possede des vosiins a gauche et a droite
            if(tab[id + 1] > 1 && tab[id - 1] > 1){
                buttons.innerHTML = '<img src="images/mid.png" />';
                return(3);
            }
            else{ // sinon si il possede un voisin uniquement a droite
                if(tab[id + 1] > 1){
                    buttons.innerHTML = '<img src="images/frontLeft.png" />';
                    return(6);
                }
                else{ //sinon si il possede un voisin uniquement a gauche
                    if(tab[id - 1] > 1){
                        buttons.innerHTML = '<img src="images/frontRight.png" />';
                        return(7);
                    }
                    else{ //sinon bateau de 1
                        buttons.innerHTML = '<img src="images/smallBoat.png" />';
                        return(2);
                    }
                }                        
            }
        }
    }

    //si a gauche
    if((id % size) == 0){
        if(tab[id + 1] > 1){ //si il possede un voisin a droite
            buttons.innerHTML = '<img src="images/frontLeft.png" />';
            return(6);
        }
        else{ //sinon si il possede des voisins en haut et en bas
            if(tab[id + size] > 1 && tab[id - size] > 1){
                buttons.innerHTML = '<img src="images/mid.png" />';
                return(3);
            }
            else{ //sinon si il possede un voisin uniquement en bas
                if(tab[id + size] > 1){
                    buttons.innerHTML = '<img src="images/frontTop.png" />';
                    return(6);
                }
                else{ //sinon si il possede un voisin uniquement en haut
                    if(tab[id - size] > 1){
                        buttons.innerHTML = '<img src="images/frontBottom.png" />';
                        return(7);
                    }
                    else{ //sinon bateau de 1
                        buttons.innerHTML = '<img src="images/smallBoat.png" />';
                        return(2);
                    }
                }                        
            }
        }
    }

    //si a droite
    if((id % size) == (size - 1)){
        if(tab[id - 1] > 1){ //si il possede un voisin a guache
            buttons.innerHTML = '<img src="images/frontRight.png" />';
            return(7);
        }
        else{ //sinon si il possede des voisnins en haut et en bas
            if(tab[id + size] > 1 && tab[id - size] > 1){
                buttons.innerHTML = '<img src="images/mid.png" />';
                return(3);
            }
            else{ // sinon si il possede un voisin uniquement en bas
                if(tab[id + size] > 1){
                    buttons.innerHTML = '<img src="images/frontTop.png" />';
                    return(6);
                }
                else{ //sinon si il possede un voisin uniquement en haut
                    if(tab[id - size] > 1){
                        buttons.innerHTML = '<img src="images/frontBottom.png" />';
                        return(7);
                    }
                    else{ //sinon bateaud e 1
                        buttons.innerHTML = '<img src="images/smallBoat.png" />';
                        return(2);
                    }
                }                        
            }
        }
    }

    //sinon si il n'est ni dan sun coin ni sur un bord
    if(tab[id + 1] > 1 && tab[id - 1] > 1){ //si il possede des vosiins a gauche et a droite
        buttons.innerHTML = '<img src="images/mid.png" />';
        return(3);
    }
    else{ //sinon si il possede des vosiins en haut et en bas
        if(tab[id + size] > 1 && tab[id - size] > 1){
            buttons.innerHTML = '<img src="images/mid.png" />';
            return(3);
        }
        else{ //sinon si il possede un voisin uniquement a droite
            if(tab[id + 1] > 1){
                buttons.innerHTML = '<img src="images/frontLeft.png" />';
                return(6);
            }
            else{//sinon si il possede un voisin uniquement a gauche
                if(tab[id - 1] > 1){
                    buttons.innerHTML = '<img src="images/frontRight.png" />';
                    return(7);
                }
                else{//sinon si il possede un voisin uniquement en haut
                    if(tab[id - size] > 1){
                        buttons.innerHTML = '<img src="images/frontBottom.png" />';
                        return(4);
                    }
                    else{//sinon si il possede un voisin uniquement en bas
                        if(tab[id + size] > 1){
                            buttons.innerHTML = '<img src="images/frontTop.png" />';
                            return(5);
                        }
                        else{ //sinon bateau de 1
                            buttons.innerHTML = '<img src="images/smallBoat.png" />';
                            return(2);
                        }
                    }
                }
            }
        }
    }
}




document.addEventListener('DOMContentLoaded', function() {

    let header1_0=document.getElementsByClassName("1/0");
    
    

});

// Cette fonction sera appelée lorsqu'un élément sera cliqué
function handleClick(event) {
    console.log("Un élément a été cliqué : " + event.target.tagName);
}

let allTh=document.querySelectorAll("th");

allTh.forEach(function(ThElem){

    ThElem.addEventListener('click',(elem)=>{
        let clickedTh=elem.target;
        
        //On détermine si on veut mettre de l'eau sur une ligne ou une colonne
        let classname=clickedTh.className;
        let sens="";
        if(classname.includes("headerTh 0/")){
            sens="ligne";
        }
        else{
            sens="colonne";
        }

        //Recherche du numéro de la ligne/colonne sélectionnée
        let numligne_colonne;

        for(let i=1;i<=size;i++){
            if(classname==='headerTh 0/'+String(i)+''){
                numligne_colonne=i;
            }
        }   

        for(let j=1;j<=size;j++){
            if(classname==='headerTh '+String(j)+'/0'){
                numligne_colonne=j;
            }
        }

        console.log(numligne_colonne);

        ////////////////////////////////////////////////////
        //Fonction permettant de mettre de l'eau dans la ligne/colonne souhaitée
        function EauLigneColonne(sens,start,sizetab){

            if(sens==='ligne'){
                let button;
                for(let i=(start-1)*sizetab;i<start*sizetab;i++){
                    button=document.getElementById(String(i));

                    if(button.innerHTML===`<img src="images/empty.png">`){
                        changeImage(i);
                    }

                }

            }
            if(sens==='colonne'){
                let button2;

                for(let j=start-1;j<start+size*(size-1);j+=size){
                    button2=document.getElementById(String(j));

                    if(button2.innerHTML===`<img src="images/empty.png">`){
                        changeImage(j);
                    }
                }

            }

        }
        ////////////////////////////////////////////////////

        EauLigneColonne(sens,numligne_colonne,size);
        

        
    })


});


