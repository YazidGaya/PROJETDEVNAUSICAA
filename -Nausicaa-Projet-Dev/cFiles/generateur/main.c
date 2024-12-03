#include "functions.h"
#include <stdlib.h>
#include <stdio.h>




int main(int argc, char* argv[]) {
    if (argc != 3) {
        printf("Usage: %s <taille> <difficulty>\n", argv[0]);
        return 1;
    }
    
    int taille = atoi(argv[1]);
    int difficulty = atoi(argv[2]);

    char* resultat = generateur(taille, difficulty);
    if (resultat != NULL) {
        printf("%s", resultat);
        return 0;
    }
    else {
        printf("Échec de la génération de la grille.\n");
        return -1;
    }
    
}


