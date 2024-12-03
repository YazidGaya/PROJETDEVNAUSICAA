#include "functions.h"
#include <stdio.h>
#include <stdlib.h>
#include <stdbool.h>
#include <string.h>




//crée une novuelle grille
int newGrid(Grid** grid, char size, char* hvalues, char* vvalues, char* field, char nboats1, char nboats2, char nboats3, char nboats4, char nboats5, char rank, Grid* actual) {
    *grid = (Grid*)malloc(sizeof(Grid));
    if (!*grid)
        return(0);
    (*grid)->Field = (char*)malloc(sizeof(char) * size * size);
    if (!*grid)
        return(0);
    defineTab(field, (*grid)->Field);
    (*grid)->HValues = (char*)malloc(sizeof(char));
    if (!*grid)
        return(0);
    defineTab(hvalues, (*grid)->HValues);
    (*grid)->VValues = (char*)malloc(sizeof(char));
    if (!*grid)
        return(0);
    defineTab(vvalues, (*grid)->VValues);
    (*grid)->size = size;
    (*grid)->NBoats1 = nboats1;
    (*grid)->NBoats2 = nboats2;
    (*grid)->NBoats3 = nboats3;
    (*grid)->NBoats4 = nboats4;
    (*grid)->NBoats5 = nboats5;
}

//copie une grille dna sune autre
int copyGrid(Grid** grid, Grid* old) {
    *grid = (Grid*)malloc(sizeof(Grid));
    if (!*grid)
        return(0);
    (*grid)->Field = (char*)malloc(sizeof(char) * old->size * old->size);
    if (!*grid)
        return(0);
    (*grid)->Field = old->Field;
    (*grid)->HValues = (char*)malloc(sizeof(char));
    if (!*grid)
        return(0);
    (*grid)->HValues = old->HValues;
    (*grid)->VValues = (char*)malloc(sizeof(char));
    if (!*grid)
        return(0);
    (*grid)->VValues = old->VValues;
    (*grid)->size = old->size;
    (*grid)->NBoats1 = old->NBoats1;
    (*grid)->NBoats2 = old->NBoats2;
    (*grid)->NBoats3 = old->NBoats3;
    (*grid)->NBoats4 = old->NBoats4;
    (*grid)->NBoats5 = old->NBoats5;
}

//transforme une chaine de caractere en tableau (hvalues vvlaues ou field)
int defineTab(char* chaine, char* tab) {
    char* ptr = chaine;
    int k = 0;
    while (*ptr != '\0') {
        if (*ptr != ' ' && *ptr != '/' && *ptr != '!') {
            tab[k] = *ptr - '0';
            k++;
        }ptr++;
    }
    return 0;
}

//met de l eau aux coins des cases bateau
int fillCorners(int size, char* tab) {
    for (int i = 0; i < size * size; i++)
    {
        if (tab[i] > 1) {
            if (i >= size) { // si pas en haut
                if ((i % size) > 0 && tab[i - size - 1] == 0) // si pas a gauche
                    tab[i - size - 1] = 1;
                if ((i % size) < (size - 1) && tab[i - size + 1] == 0) // si pas a droite
                    tab[i - size + 1] = 1;
            }
            if (i < (size * (size - 1))) { // si pas en bas
                if ((i % size) > 0 && tab[i + size - 1] == 0) // si pas a gauche
                    tab[i + size - 1] = 1;
                if ((i % size) < (size - 1) && tab[i + size + 1] == 0) // si pas a droite
                    tab[i + size + 1] = 1;
            }
        }
    }
    return(1);
}

//completes les lgines avec de l eau si il y a le bon nombre de cases bateaux
int fillLines(int size, char* tab, char* VValues, char* HValues) {
    int total = 0;
    for (int i = 0; i < size; i++)
    {
        total = 0;
        for (int j = 0; j < size; j++)
        {
            if (tab[i + size * j] > 1)
                total++;
        }
        if (total == VValues[i]) {
            for (int k = 0; k < size; k++)
            {
                if (tab[i + size * k] == 0)
                    tab[i + size * k] = 1;
            }
        }

        total = 0;
        for (int j = 0; j < size; j++)
        {
            if (tab[j + size * i] > 1)
                total++;
        }
        if (total == HValues[i]) {
            for (int k = 0; k < size; k++)
            {
                if (tab[k + size * i] == 0)
                    tab[k + size * i] = 1;
            }
        }
    }
    return(1);
}

// complete les lignes avec des bateaux si il retse le bon nombre de cases vides
int completeLines(int size, char* tab, char* VValues, char* HValues) {
    int total = 0;
    for (int i = 0; i < size; i++)
    {
        total = 0;
        for (int j = 0; j < size; j++)
        {
            if (tab[i * size + j] == 0 || tab[i * size + j] > 1)
                total++;
        }
        if (total == HValues[i]) {
            for (int j = 0; j < size; j++)
            {
                if (tab[i * size + j] == 0)
                    tab[i * size + j] = 8;
            }
        }

        total = 0;
        for (int j = 0; j < size; j++)
        {
            if (tab[j * size + i] == 0 || tab[j * size + i] > 1)
                total++;
        }
        if (total == VValues[i]) {
            for (int j = 0; j < size; j++)
            {
                if (tab[j * size + i] == 0)
                    tab[j * size + i] = 8;
            }
        }
    }
}

//met un bateau a cote des cases avant de abteau
int nextToFront(int size, char* tab) {
    for (int i = 0; i < size * size; i++)
    {
        if (tab[i] == 4 && tab[i - size] == 0)
            tab[i - size] = 8;
        if (tab[i] == 5 && tab[i + size] == 0)
            tab[i + size] = 8;
        if (tab[i] == 6 && tab[i + 1] == 0)
            tab[i + 1] = 8;
        if (tab[i] == 7 && tab[i + 1] == 0)
            tab[i + 1] = 8;
    }
}

//met des bateaux a cote des cases mid
int sideMidBoat(int size, char* tab) {
    for (int i = 0; i < size * size; i++)
    {
        if (tab[i] == 3) {
            if ((i % size) == 0 || tab[i + 1] == 1 || (i % size) == (size - 1) || tab[i - 1] == 1 || (i >= size && tab[i - size] > 2) || (i <= (size * (size - 1)) && tab[i + size] > 2)) {
                if (tab[i - size] == 0)
                    tab[i - size] = 8;
                if (tab[i + size] == 0)
                    tab[i + size] = 8;
            }

            if (i > (size * (size - 1)) || tab[i + size] == 1 || i < size || tab[i - size] == 1 || ((i % size) != 0 && tab[i - 1] > 2) || ((i % size) != (size - 1) && tab[i + 1] > 2)) {
                if (tab[i - 1] == 0)
                    tab[i - 1] = 8;
                if (tab[i + 1] == 0)
                    tab[i + 1] = 8;
            }
        }
    }
}

//met de l eau a cote des avnts de bateau
int waterAroundHead(int size, char* tab) {
    for (int i = 0; i < size * size; i++)
    {
        if (tab[i] == 2) {
            if (i >= size && tab[i - size] == 0)
                tab[i - size] = 1;
            if (i < (size * (size - 1)) && tab[i + size] == 0)
                tab[i + size] = 1;
            if ((i % size && tab[i - 1] == 0))
                tab[i - 1] = 1;
            if ((i % size) != (size - 1) && tab[i + 1] == 0)
                tab[i + 1] = 1;
        }
        if (tab[i] == 4) {
            if (i < (size * (size - 1)) && tab[i + size] == 0)
                tab[i + size] = 1;
            if ((i % size && tab[i - 1] == 0))
                tab[i - 1] = 1;
            if ((i % size) != (size - 1) && tab[i + 1] == 0)
                tab[i + 1] = 1;
        }
        if (tab[i] == 5) {
            if (i >= size && tab[i - size] == 0)
                tab[i - size] = 1;
            if ((i % size && tab[i - 1] == 0))
                tab[i - 1] = 1;
            if ((i % size) != (size - 1) && tab[i + 1] == 0)
                tab[i + 1] = 1;
        }
        if (tab[i] == 6) {
            if (i >= size && tab[i - size] == 0)
                tab[i - size] = 1;
            if (i < (size * (size - 1)) && tab[i + size] == 0)
                tab[i + size] = 1;
            if ((i % size) != 0 && tab[i - 1] == 0)
                tab[i - 1] = 1;
        }
        if (tab[i] == 7) {
            if (i >= size && tab[i - size] == 0)
                tab[i - size] = 1;
            if (i < (size * (size - 1)) && tab[i + size] == 0)
                tab[i + size] = 1;
            if ((i % size) != (size - 1) && tab[i + 1] == 0)
                tab[i + 1] = 1;
        }
    }
}

//focntion de backtracking
char* backTracking(Grid* playGrid) {
    int i = 0;
    char* tmp = (char*)malloc(sizeof(char) * playGrid->size * playGrid->size);
    char* tmp2 = (char*)malloc(sizeof(char) * playGrid->size * playGrid->size);
    char* ret = (char*)malloc(sizeof(char) * playGrid->size * playGrid->size * 2);
    Grid* grid2;
    copyGrid(&grid2, playGrid);
    int v = 0;
    //printf("\nstart\n");

    for (int j = 0; j < grid2->size * grid2->size; j++)
    {

        if (grid2->Field[j] == 0) {
            grid2->Field[j] = 8;
            for (int k = 0; k < (grid2->size * grid2->size); k++)
            {
                tmp2[k] = grid2->Field[k];
                tmp[k] = grid2->Field[k];
            }
            /*for (int z = 0; z < grid2->size; z++)
            {
                for (int a = 0; a < grid2->size; a++)
                {
                    printf("%d \t", tmp2[z * grid2->size + a]);
                }
                printf("\n");
            }
            printf("aaa\n\n");*/

            i = 0;

            int modif = 1;

            while (modif != 0)
            {
                for (int k = 0; k < grid2->size * grid2->size; k++)
                {
                    tmp[k] = grid2->Field[k];
                }

                modif = 0;
                fillCorners(grid2->size, grid2->Field);
                fillLines(grid2->size, grid2->Field, grid2->VValues, grid2->HValues);
                completeLines(grid2->size, grid2->Field, grid2->VValues, grid2->HValues);
                sideMidBoat(grid2->size, grid2->Field);
                nextToFront(grid2->size, grid2->Field);
                waterAroundHead(grid2->size, grid2->Field);
                placeBoatsInAvailableSpaces(grid2);
                defineBoat(grid2, 0);

                // et autres focntions dont on peut avoir besoins
                i = 0;
                while (i < (grid2->size * grid2->size) && modif == 0)
                {
                    if (grid2->Field[i] != tmp[i])
                        modif = 1;
                    i++;
                }
                /*for (int z = 0; z < grid2->size; z++)
                {
                    for (int a = 0; a < grid2->size; a++)
                    {
                        printf("%d \t", grid2->Field[z * grid2->size + a]);
                    }
                    printf("\n");
                }
                printf("\n\n");*/

            }

            //printf("c %d\n", isGridInvalid(grid2->size, grid2->Field, grid2->VValues, grid2->HValues, grid2->NBoats1, grid2->NBoats2, grid2->NBoats3, grid2->NBoats4, grid2->NBoats5));
            if (isGridValid(grid2->size, grid2->Field, grid2->VValues, grid2->HValues, grid2->NBoats1, grid2->NBoats2, grid2->NBoats3, grid2->NBoats4, grid2->NBoats5) == 1)
                return(toString(grid2->Field, grid2->size));
            if (isGridInvalid(grid2->size, grid2->Field, grid2->VValues, grid2->HValues, grid2->NBoats1, grid2->NBoats2, grid2->NBoats3, grid2->NBoats4, grid2->NBoats5) == 0) {
                ret = backTracking(grid2);
                //printf("ret2 = %s\n", ret);
                if (ret && ret != 0)
                    return(ret);
                if (ret == 0) {
                    for (int k = 0; k < grid2->size * grid2->size; k++)
                    {
                        grid2->Field[k] = tmp2[k];
                    }
                    grid2->Field[j] = 1;
                }
            }
            //printf("\isGrid invalid == %d\n", isGridInvalid(grid2->size, grid2->Field, grid2->VValues, grid2->HValues, grid2->NBoats1, grid2->NBoats2, grid2->NBoats3, grid2->NBoats4, grid2->NBoats5));
            /*for (int z = 0; z < grid2->size; z++)
            {
                for (int a = 0; a < grid2->size; a++)
                {
                    printf("%d \t", grid2->Field[z * grid2->size + a]);
                }
                printf("\n");
            }
            printf("\n\n");*/

            if (isGridInvalid(grid2->size, grid2->Field, grid2->VValues, grid2->HValues, grid2->NBoats1, grid2->NBoats2, grid2->NBoats3, grid2->NBoats4, grid2->NBoats5) == 1)
            {
                //printf("\ninvalidGrid\n");
                return(0);
            }
        }
    }
    //printf("\END\n");
    if (isGridValid(grid2) == 1)
        return(toString(grid2->Field, grid2->size));
    return(0);
}

// compte le nombre de bateau par lignes, si le bon nombre renvoie 0, si trop peu renvoie 1 si trop renvoie -1
int countBoatLines(int size, char* tab, char* VValues, char* HValues) {
    int count = 0;
    int verif = true;

    for (int i = 0; i < size; i++) {
        for (int j = 0; j < size; j++) {
            if (tab[i + size * j] > 1)
                count++;
        }
        if (count == VValues[i])
            verif = true;
        else {
            verif = false;
            if (count > VValues[i])
                return(-1);
            return(0);
            break;
        }
        count = 0;
    }
    for (int i = 0; i < size; i++) {
        for (int j = 0; j < size; j++) {
            if (tab[i * size + j] > 1)
                count++;
        }
        if (count == HValues[i])
            verif = true;
        else {
            verif = false;
            if (count > HValues[i])
            {
                printf("%d\n", count);
                return(-1);
            }
            else
                return(0);
            break;
        }
        count = 0;
    }
    if (verif == true)
        return 1;
    return 0;
}

// teste si il y a le bon nombre de chaques tailes de bateau
int verifBoats(int size, char* tab, char NBoat1, char NBoat2, char NBoat3, char NBoat4, char NBoat5) {
    int nbBoats = 0;
    for (int i = 0; i < size; i++) {
        for (int j = 0; j < size - 4; j++) {
            if (tab[j + size * i] == 6 && tab[j + size * i + 1] == 3 && tab[j + size * i + 2] == 3 && tab[j + size * i + 3] == 3 && tab[j + size * i + 4] == 7)
                nbBoats++;
        }
    }

    for (int i = 0; i < size - 4; i++) {
        for (int j = 0; j < size; j++) {
            if (tab[j + size * i] == 5 && tab[j + size * (i + 1)] == 3 && tab[j + size * (i + 2)] == 3 && tab[j + size * (i + 3)] == 3 && tab[j + size * (i + 4)] == 4)
                nbBoats++;
        }
    }
    if (nbBoats != NBoat5)
        return(0);
    nbBoats = 0;

    for (int i = 0; i < size; i++) {
        for (int j = 0; j < size - 3; j++) {
            if (tab[j + size * i] == 6 && tab[j + size * i + 1] == 3 && tab[j + size * i + 2] == 3 && tab[j + size * i + 3] == 7)
                nbBoats++;
        }
    }

    for (int i = 0; i < size - 3; i++) {
        for (int j = 0; j < size; j++) {
            if (tab[j + size * i] == 5 && tab[j + size * (i + 1)] == 3 && tab[j + size * (i + 2)] == 3 && tab[j + size * (i + 3)] == 4)
                nbBoats++;
        }
    }
    if (nbBoats != NBoat4)
        return(0);
    nbBoats = 0;

    for (int i = 0; i < size; i++) {
        for (int j = 0; j < size - 2; j++) {
            if (tab[j + size * i] == 6 && tab[j + size * i + 1] == 3 && tab[j + size * i + 2] == 7)
                nbBoats++;
        }
    }

    for (int i = 0; i < size - 2; i++) {
        for (int j = 0; j < size; j++) {
            if (tab[j + size * i] == 5 && tab[j + size * (i + 1)] == 3 && tab[j + size * (i + 2)] == 4)
                nbBoats++;
        }
    }
    if (nbBoats != NBoat3)
        return(0);
    nbBoats = 0;

    for (int i = 0; i < size; i++) {
        for (int j = 0; j < size - 1; j++) {
            if (tab[j + size * i] == 6 && tab[j + size * i + 1] == 7)
                nbBoats++;
        }
    }

    for (int i = 0; i < size - 1; i++) {
        for (int j = 0; j < size; j++) {
            if (tab[j + size * i] == 5 && tab[j + size * (i + 1)] == 4)
                nbBoats++;
        }
    }
    if (nbBoats != NBoat2)
        return(0);
    nbBoats = 0;

    for (int i = 0; i < (size * size); i++) {
        if (tab[i] == 2)
            nbBoats++;
    }
    if (nbBoats != NBoat1)
        return(0);

    return(1);
}

//verifie que 2 bateaux ne se touchent pas (pas de cases bateaux en diagonales) retourn 1 si ca touche sinon 0
int isTouching(int size, char* tab) {
    for (int i = size; i < (size * size); i++) {
        if (tab[i] > 1) {
            if ((i % size) != (size - 1) && tab[i + 1 - size] > 1)
                return(1);
            if ((i % size) != 0 && tab[i - 1 - size] > 1)
                return(1);
        }
    }
    return 0;
}

// verifie si la grille ets valide
int isGridValid(Grid* grid) {
    int touch = isTouching(grid->size, grid->Field);
    int boatcount = countBoatLines(grid->size, grid->Field, grid->VValues, grid->HValues);
    int* r = countBoats(grid);
    if (r[4] != grid->NBoats5)
        return(0);
    if (r[3] != grid->NBoats4)
        return(0);
    if (r[2] != grid->NBoats3)
        return(0);
    if (r[1] != grid->NBoats2)
        return(0);
    if (r[0] != grid->NBoats1)
        return(0);
    if (touch == 0 && boatcount == 1)
        return(1);
    return(0);
}

//verifie si la grille est invalide (donc mauvais backtracking) renvoie 1 si invalid sinon 0
int isGridInvalid(int size, char* tab, char* VValues, char* HValues, char NBoat1, char NBoat2, char NBoat3, char NBoat4, char NBoat5) {
    int touch = isTouching(size, tab);
    int boatcount = countBoatLines(size, tab, VValues, HValues);
    if (touch == 1 || boatcount == -1)
        return(1);
    return(0);
}

//attribue la bonne valuer aux cases bateaux en focntion de leurs voisins
int defineBoat(Grid* grid, int gen) {

    for (int i = 0; i < grid->size * grid->size; i++) {
        if (grid->Field[i] == 8) {
            if ((i % grid->size != grid->size - 1) && (i % grid->size == 0 || grid->Field[i - 1] == 1 || (grid->Field[i - 1] == 0 && gen)) && (grid->Field[i + 1] > 1)) {
                grid->Field[i] = 6;
            }
            else if ((i % grid->size != 0) && (i % grid->size == grid->size - 1 || grid->Field[i + 1] == 1 || (grid->Field[i + 1] == 0 && gen)) && (grid->Field[i - 1] > 1)) {
                grid->Field[i] = 7;
            }
            else if ((i < grid->size * (grid->size - 1)) && (i < grid->size || grid->Field[i - grid->size] == 1 || (grid->Field[i - grid->size] == 0 && gen)) && (grid->Field[i + grid->size] > 1)) {
                grid->Field[i] = 5;
            }
            else if ((i >= grid->size) && (i >= grid->size * (grid->size - 1) || grid->Field[i + grid->size] == 1 || (grid->Field[i + grid->size] == 0 && gen)) && (grid->Field[i - grid->size] > 1)) {
                grid->Field[i] = 4;
            }
            else if ((i < grid->size || grid->Field[i - grid->size] == 1 || (grid->Field[i - grid->size] == 0 && gen))
                && (i >= grid->size * (grid->size - 1) || grid->Field[i + grid->size] == 1 || (grid->Field[i + grid->size] == 0 && gen))
                && (i % grid->size == 0 || grid->Field[i - 1] == 1 || (grid->Field[i - 1] == 0))
                && (i % grid->size == grid->size - 1 || grid->Field[i + 1] == 1 || (grid->Field[i + 1] == 0 && gen))) {
                grid->Field[i] = 2;
            }
            else {
                if (((i < grid->size * (grid->size) && i > grid->size && grid->Field[i - grid->size] > 1 && grid->Field[i + grid->size] > 1))
                    || (i % grid->size != 0 && i % grid->size != (grid->size - 1) && grid->Field[i - 1] > 1 && grid->Field[i + 1] > 1))
                    grid->Field[i] = 3;
            }
        }
    }
}

//focniton qui écrise la chaine de caractère a partir du tableau
char* toString(char* tab, int size) {
    char* ret = (char*)malloc(sizeof(char) * size * size * 2);
    int k = 0;
    for (int i = 0; i < size; i++)
    {
        for (int j = 0; j < size; j++)
        {
            ret[k] = tab[i * size + j] + '0';
            ret[k + 1] = '/';
            k += 2;
        }
        ret[k - 1] = '!';
    }
    ret[k - 1] = 0;
    return(ret);
}

char* toStringValues(char* tab, int size) {
    char* ret = (char*)malloc(sizeof(char) * (size * 2 + 1)); // +1 pour le caractère nul '\0'
    if (ret == NULL) {
        printf("Memory allocation failed\n");
        exit(1);
    }
    int k = 0;
    for (int j = 0; j < size; j++) {
        ret[k] = tab[j] + '0';
        ret[k + 1] = '/';
        k += 2;
    }
    ret[k - 1] = '\0'; // Assurer que la chaîne est bien terminée par un caractère nul
    return ret;
}
//fonction qui place les bateaux dans les empmlacement restat qui ont la bonne taille
int placeBoatsInAvailableSpaces(Grid* grid) {
    int* boats = countBoats(grid);
    int spaces = 0;
    if (boats[4] < grid->NBoats5) {
        for (int i = 0; i < grid->size; i++)
        {
            for (int j = 0; j < grid->size - 3; j++)
            {
                if (grid->Field[i * grid->size + j] == 0 && grid->Field[i * grid->size + j + 1] == 0 && grid->Field[i * grid->size + j + 2] == 0 && grid->Field[i * grid->size + j + 3] == 0 && grid->Field[i * grid->size + j + 4] == 0)
                    spaces++;
                if (grid->Field[j * grid->size + i == 0] && grid->Field[j * grid->size + i + 1] == 0 && grid->Field[j * grid->size + i + 2] == 0 && grid->Field[j * grid->size + i + 3] == 0 && grid->Field[j * grid->size + i + 4] == 0)
                    spaces++;
            }
        }
        if (spaces == (grid->NBoats5 - boats[4])) {
            for (int i = 0; i < grid->size; i++)
            {
                for (int j = 0; j < grid->size - 4; j++)
                {
                    if (grid->Field[i * grid->size + j] && grid->Field[i * grid->size + j + 1] && grid->Field[i * grid->size + j + 2] && grid->Field[i * grid->size + j + 3] && grid->Field[i * grid->size + j + 4]) {
                        grid->Field[i * grid->size + j] = 6;
                        grid->Field[i * grid->size + j + 1] = 3;
                        grid->Field[i * grid->size + j + 2] = 3;
                        grid->Field[i * grid->size + j + 3] = 3;
                        grid->Field[i * grid->size + j + 4] = 7;
                    }
                    if (grid->Field[j * grid->size + i] && grid->Field[j * grid->size + i + 1] && grid->Field[j * grid->size + i + 2] && grid->Field[j * grid->size + i + 3] && grid->Field[j * grid->size + i + 4]) {
                        grid->Field[j * grid->size + i] = 6;
                        grid->Field[j * grid->size + i + 1] = 3;
                        grid->Field[j * grid->size + i + 2] = 3;
                        grid->Field[j * grid->size + i + 3] = 3;
                        grid->Field[j * grid->size + i + 4] = 7;
                    }
                }
            }
        }
    }
    spaces = 0;
    if (boats[3] < grid->NBoats4) {
        for (int i = 0; i < grid->size; i++)
        {
            for (int j = 0; j < grid->size - 3; j++)
            {
                if (grid->Field[i * grid->size + j] == 0 && grid->Field[i * grid->size + j + 1] == 0 && grid->Field[i * grid->size + j + 2] == 0 && grid->Field[i * grid->size + j + 3] == 0)
                    spaces++;
                if (grid->Field[j * grid->size + i] == 0 && grid->Field[j * grid->size + i + 1] == 0 && grid->Field[j * grid->size + i + 2] == 0 && grid->Field[j * grid->size + i + 3] == 0)
                    spaces++;
            }
        }
        if (spaces == (grid->NBoats5 - boats[3])) {
            for (int i = 0; i < grid->size; i++)
            {
                for (int j = 0; j < grid->size - 3; j++)
                {
                    if (grid->Field[i * grid->size + j] == 0 && grid->Field[i * grid->size + j + 1] == 0 && grid->Field[i * grid->size + j + 2] == 0 && grid->Field[i * grid->size + j + 3] == 0) {
                        grid->Field[i * grid->size + j] = 6;
                        grid->Field[i * grid->size + j + 1] = 3;
                        grid->Field[i * grid->size + j + 2] = 3;
                        grid->Field[i * grid->size + j + 3] = 7;
                    }
                    if (grid->Field[j * grid->size + i] == 0 && grid->Field[j * grid->size + i + 1] == 0 && grid->Field[j * grid->size + i + 2] == 0 && grid->Field[j * grid->size + i + 3] == 0) {
                        grid->Field[j * grid->size + i] = 6;
                        grid->Field[j * grid->size + i + 1] = 3;
                        grid->Field[j * grid->size + i + 2] = 3;
                        grid->Field[j * grid->size + i + 3] = 7;
                    }
                }
            }
        }
    }
    spaces = 0;
    if (boats[2] < grid->NBoats4) {
        for (int i = 0; i < grid->size; i++)
        {
            for (int j = 0; j < grid->size - 2; j++)
            {
                if (grid->Field[i * grid->size + j] == 0 && grid->Field[i * grid->size + j + 1] == 0 && grid->Field[i * grid->size + j + 2] == 0)
                    spaces++;
                if (grid->Field[j * grid->size + i] == 0 && grid->Field[j * grid->size + i + 1] == 0 && grid->Field[j * grid->size + i + 2] == 0)
                    spaces++;
            }
        }
        if (spaces == (grid->NBoats5 - boats[2])) {
            for (int i = 0; i < grid->size; i++)
            {
                for (int j = 0; j < grid->size - 2; j++)
                {
                    if (grid->Field[i * grid->size + j] == 0 && grid->Field[i * grid->size + j + 1] == 0 && grid->Field[i * grid->size + j + 2] == 0) {
                        grid->Field[i * grid->size + j] = 6;
                        grid->Field[i * grid->size + j + 1] = 3;
                        grid->Field[i * grid->size + j + 2] = 7;
                    }
                    if (grid->Field[j * grid->size + i] == 0 && grid->Field[j * grid->size + i + 1] == 0 && grid->Field[j * grid->size + i + 2] == 0) {
                        grid->Field[j * grid->size + i] = 6;
                        grid->Field[j * grid->size + i + 1] = 3;
                        grid->Field[j * grid->size + i + 2] = 7;
                    }
                }
            }
        }
    }
    spaces = 0;
    if (boats[1] < grid->NBoats4) {
        for (int i = 0; i < grid->size; i++)
        {
            for (int j = 0; j < grid->size - 1; j++)
            {
                if (grid->Field[i * grid->size + j] == 0 && grid->Field[i * grid->size + j + 1] == 0)
                    spaces++;
                if (grid->Field[j * grid->size + i] == 0 && grid->Field[j * grid->size + i + 1] == 0)
                    spaces++;
            }
        }
        if (spaces == (grid->NBoats5 - boats[1])) {
            for (int i = 0; i < grid->size; i++)
            {
                for (int j = 0; j < grid->size - 1; j++)
                {
                    if (grid->Field[i * grid->size + j] == 0 && grid->Field[i * grid->size + j + 1] == 0) {
                        grid->Field[i * grid->size + j] = 6;
                        grid->Field[i * grid->size + j + 1] = 7;
                    }
                    if (grid->Field[j * grid->size + i] == 0 && grid->Field[j * grid->size + i + 1] == 0) {
                        grid->Field[j * grid->size + i] = 6;
                        grid->Field[j * grid->size + i + 1] = 7;
                    }
                }
            }
        }
    }
    spaces = 0;
    if (boats[0] < grid->NBoats4) {
        for (int i = 0; i < grid->size; i++)
        {
            for (int j = 0; j < grid->size; j++)
            {
                if (grid->Field[i * grid->size + j] == 0)
                    spaces++;
                if (grid->Field[j * grid->size + i] == 0)
                    spaces++;
            }
        }
        if (spaces == (grid->NBoats5 - boats[0])) {
            for (int i = 0; i < grid->size; i++)
            {
                for (int j = 0; j < grid->size; j++)
                {
                    if (grid->Field[i * grid->size + j] == 0) {
                        grid->Field[i * grid->size + j] = 2;
                    }
                    if (grid->Field[j * grid->size + i] == 0) {
                        grid->Field[j * grid->size + i] = 2;
                    }
                }
            }
        }
    }
}

//fonction qui modfiife la grille pour lui faire avoir une unqiue solution
char* makesSolutionUnique(Grid* grid) {
    char** tab = (char**)malloc(sizeof(char) * grid->size * grid->size * 2 * 30);
    if (!tab || tab == NULL || *tab == NULL) {
        return(-1);
    }
    Grid* playGrid;

    newGrid(&playGrid, grid->size, grid->HValues, grid->VValues, grid->Field, grid->NBoats1, grid->NBoats1, grid->NBoats2, grid->NBoats3, grid->NBoats4, grid->NBoats5, NULL);

    int i = 0;
    int k = 0;
    char* tmp = (char*)malloc(sizeof(char) * playGrid->size * playGrid->size);
    char* ret = (char*)malloc(sizeof(char) * playGrid->size * playGrid->size * 2);
    i = 0;

    int modif = 1;
    while (modif != 0)
    {
        for (int k = 0; k < playGrid->size * playGrid->size; k++)
        {
            tmp[k] = playGrid->Field[k];
        }

        modif = 0;
        fillCorners(playGrid->size, playGrid->Field);
        fillLines(playGrid->size, playGrid->Field, playGrid->VValues, playGrid->HValues);
        completeLines(playGrid->size, playGrid->Field, playGrid->VValues, playGrid->HValues);
        sideMidBoat(playGrid->size, playGrid->Field);
        nextToFront(playGrid->size, playGrid->Field);
        waterAroundHead(playGrid->size, playGrid->Field);
        placeBoatsInAvailableSpaces(playGrid);
        defineBoat(playGrid, 0);
        // et autres focntions dont on peut avoir besoins
        i = 0;
        while (i < (playGrid->size * playGrid->size) && modif == 0)
        {
            if (playGrid->Field[i] != tmp[i])
                modif = 1;
            i++;
        }
    }

    if (isGridValid(playGrid) == 1)
        return(toString(playGrid->Field, playGrid->size));
    if (isGridInvalid(playGrid->size, playGrid->Field, playGrid->VValues, playGrid->HValues, playGrid->NBoats1, playGrid->NBoats2, playGrid->NBoats3, playGrid->NBoats4, playGrid->NBoats5) == 0) {
        ret = backTrackingGen(playGrid, tab);
    }
    else {
        return 0;
    }

    int tot = 0;
    int exit = 0;
    int tmpVal = 0;
    for (int i = 0; i < grid->size * grid->size; i++)
    {
        for (int j = 1; j < 7; j++)
        {
            while (tab[k][0]) {
                if (tab[k][i] == j)
                    tot++;
                tmpVal = k;
            }
            if (tot == 1) {
                exit = 1;
                break;
            }
            tot = 0;
        }
        if (exit == 1) {
            grid->Field[i] = k;
            break;
        }

    }
    ret = toString(grid->Field, grid->size);

    return(ret);
}

//fonction de backtracking
char* backTrackingGen(Grid* playGrid, char** tab) {
    int i = 0;
    char* tmp = (char*)malloc(sizeof(char) * playGrid->size * playGrid->size);
    char* tmp2 = (char*)malloc(sizeof(char) * playGrid->size * playGrid->size);
    char* ret = (char*)malloc(sizeof(char) * playGrid->size * playGrid->size * 2);
    Grid* grid2;
    copyGrid(&grid2, playGrid);
    int v = 0;

    for (int j = 0; j < grid2->size * grid2->size; j++)
    {

        if (grid2->Field[j] == 0) {
            grid2->Field[j] = 8;
            for (int k = 0; k < (grid2->size * grid2->size); k++)
            {
                tmp2[k] = grid2->Field[k];
                tmp[k] = grid2->Field[k];
            }

            i = 0;

            int modif = 1;

            while (modif != 0)
            {
                for (int k = 0; k < grid2->size * grid2->size; k++)
                {
                    tmp[k] = grid2->Field[k];
                }

                modif = 0;
                fillCorners(grid2->size, grid2->Field);
                fillLines(grid2->size, grid2->Field, grid2->VValues, grid2->HValues);
                completeLines(grid2->size, grid2->Field, grid2->VValues, grid2->HValues);
                sideMidBoat(grid2->size, grid2->Field);
                nextToFront(grid2->size, grid2->Field);
                waterAroundHead(grid2->size, grid2->Field);
                placeBoatsInAvailableSpaces(grid2);
                defineBoat(grid2, 0);

                // et autres focntions dont on peut avoir besoins
                i = 0;
                while (i < (grid2->size * grid2->size) && modif == 0)
                {
                    if (grid2->Field[i] != tmp[i])
                        modif = 1;
                    i++;
                }
            }

            if (isGridValid(grid2->size, grid2->Field, grid2->VValues, grid2->HValues, grid2->NBoats1, grid2->NBoats2, grid2->NBoats3, grid2->NBoats4, grid2->NBoats5) == 1)
            {
                addGridToTab(grid2, tab);
                return(0);
            }
            if (isGridInvalid(grid2->size, grid2->Field, grid2->VValues, grid2->HValues, grid2->NBoats1, grid2->NBoats2, grid2->NBoats3, grid2->NBoats4, grid2->NBoats5) == 0) {
                ret = backTracking(grid2);
                if (ret && ret != 0)
                    return(ret);
                if (ret == 0) {
                    for (int k = 0; k < grid2->size * grid2->size; k++)
                    {
                        grid2->Field[k] = tmp2[k];
                    }
                    grid2->Field[j] = 1;
                }
            }
            if (isGridInvalid(grid2->size, grid2->Field, grid2->VValues, grid2->HValues, grid2->NBoats1, grid2->NBoats2, grid2->NBoats3, grid2->NBoats4, grid2->NBoats5) == 1)
                return(0);
        }
    }
    if (isGridValid(grid2) == 1)
        return(toString(grid2->Field, grid2->size));
    return(0);
}

//ajotue la une grille supplementaire a la liste des solutions
char* addGridToTab(Grid* grid, char** tab) {
    int k = 0;
    while (tab[k])
    {
        k++;
    }
    for (int i = 0; i < grid->size * grid->size; i++)
    {
        tab[k][i] = grid->Field[i];
    }
}

//cache certaines cases lors de la genrateion
int hideCells(Grid* grid, int difficulty) {
    int nb;
    char* tab = (char*)malloc(10 * sizeof(char));
    if (tab == NULL) {
        return -1;
    }
    int a = 0;
    int tmp;
    int k = 0;
    if (grid->size == 6) {
        if (difficulty == 1) {
            nb = 5;
        }
        else if (difficulty == 2) {
            nb = 4;
        }
        else {
            nb = 3;
        }
    }
    else if (grid->size == 8) {
        if (difficulty == 1) {
            nb = 6;
        }
        else if (difficulty == 2) {
            nb = 5;
        }
        else {
            nb = 4;
        }
    }
    else if (grid->size == 10) {
        if (difficulty == 1) {
            nb = 7;
        }
        else if (difficulty == 2) {
            nb = 6;
        }
        else {
            nb = 5;
        }
    }
    else if (grid->size == 15) {
        if (difficulty == 1) {
            nb = 10;
        }
        else if (difficulty == 2) {
            nb = 8;
        }
        else {
            nb = 6;
        }
    }
    else {
        nb = 0;
    }
    while (k < nb) { //sélection des cases à garder
        tmp = rand() % (grid->size * grid->size);
        if (grid->Field[tmp] > 1) { //on ne prend que les cases bateau
            for (int i = 0; i <= k; i++) {
                if (tab[i] == grid->Field[tmp]) {//on vérifie qu'elle n'est pas déjà prise
                    tmp = -1;
                }
            }if (tmp != -1) {
                tab[k] = tmp;
                k++;
            }
        }
    }
    char* field = (char*)malloc(grid->size * grid->size * sizeof(char));//on place les cases dans un champ temporaire
    if (field == NULL) {
        return -1;
    }
    for (int i = 0; i < grid->size * grid->size; i++) {
        *(field + i) = 0;
    }
    for (int i = 0; i < grid->size * grid->size; i++) {
        for (int j = 0; j < k; j++) {
            if (i == tab[j]) {
                field[i] = grid->Field[tab[j]];
            }
        }
    }
    //appel du solveur pour voir si solvable
    grid->Field = field;
   
    return 0;

}

// focnitons qui compte les bateaux de chaques tailles
int* countBoats(Grid* grid) {
    int* tab = (int*)malloc(5 * sizeof(int));//le tableau contient les comptes des bateaux
    if (tab == NULL) {
        return NULL;
    }
    for (int i = 0; i < 5; i++) {
        *(tab + i) = 0;
    }
    int j;
    //tab[0] est le nombre de bateaux de taille 1
    for (int i = 0; i < grid->size * grid->size; i++) {//on ne s'intéresse qu'aux bateaux seuls, têtes hautes et gauches pour
        //éviter de compter deux fois un même bateau
        j = 1;
        if (grid->Field[i] == 2) {
            tab[0]++;
        }
        else if (grid->Field[i] == 5) {
            while (j <= 5 && i + j * grid->size < grid->size * grid->size && grid->Field[i + j * grid->size] != 4 && grid->Field[i + j * grid->size] > 1) {
                j++;
            }if (grid->Field[i + j * grid->size] == 4) {//si le bateau est correctement "terminé"
                tab[j]++;
            }
        }
        else if (grid->Field[i] == 6) {
            while (j <= 5 && (i + j) % grid->size < grid->size && grid->Field[i + j] != 7 && grid->Field[i + j]> 1) {
                j++;
            }if (grid->Field[i + j] == 7) {//si le bateau est correctement "terminé"
                tab[j]++;
            }
        }
    }return tab;
}

//
int countboatligne(Grid* grid) {
    for (int i = 0; i < grid->size; i++) {
        *(grid->VValues + i) = 0;
        for (int j = 0; j < grid->size; j++) {
            if (*(grid->Field + j * grid->size + i) > 1) {
                *(grid->VValues + i) += 1;
            }
        }
    }return 0;
}

//
int countboatcolo(Grid* grid) {
    for (int i = 0; i < grid->size; i++) {
        *(grid->HValues + i) = 0;
        for (int j = 0; j < grid->size; j++) {
            if (*(grid->Field + i * grid->size + j) > 1) {
                *(grid->HValues + i) += 1;
            }
        }
    }return 0;
}
char* generateur(int taille, int difficulty) {
    Grid* grid = (Grid*)malloc(sizeof(Grid));
    if (grid == NULL) {
        printf("Erreur d'allocation mémoire pour la grille.\n");
        return NULL;
    }
    int len = 0;
    int orientation;
    int posx, posy;
    int tab[15];
    int libre, essais, fail;

    // Initialisation des tailles de bateaux en fonction de la taille de la grille
    if (taille == 6) {
        len = 6;
        int ships[6] = { 3, 2, 2, 1, 1, 1 };
        memcpy(tab, ships, len * sizeof(int));
    }
    else if (taille == 8) {
        len = 9;
        int ships[9] = { 4, 3, 3, 2, 2, 2, 1, 1, 1 };
        memcpy(tab, ships, len * sizeof(int));
    }
    else if (taille == 10) {
        len = 10;
        int ships[10] = { 4, 3, 3, 2, 2, 2, 1, 1, 1, 1 };
        memcpy(tab, ships, len * sizeof(int));
    }
    else if (taille == 15) {
        len = 15;
        int ships[15] = { 5, 4, 4, 3, 3, 3, 2, 2, 2, 2, 1, 1, 1, 1, 1 };
        memcpy(tab, ships, len * sizeof(int));
    }
    else {
        printf("Taille de grille non supportée.\n");
        free(grid);
        return NULL; // Si la taille n'est pas bonne
    }

    grid->size = taille;
    grid->HValues = NULL;
    grid->VValues = NULL;
    grid->Field = (char*)malloc(grid->size * grid->size * sizeof(char));
    if (grid->Field == NULL) {
        free(grid);
        printf("Erreur d'allocation mémoire pour la grille.\n");
        return NULL;
    }

    srand((unsigned int)time(NULL)); // Initialisation du seed aléatoire

    do {
        // On réinitialise la grille
        for (int i = 0; i < grid->size * grid->size; i++) {
            grid->Field[i] = 0;
        }

        fail = 0; // Réinitialisation du drapeau fail

        for (int i = 0; i < len; i++) {
            essais = 0;
            libre = 0;
            while (essais < 7 && !libre) {
                libre = 1;
                orientation = rand() % 2; // 0 : vertical, 1 : horizontal

                if (orientation == 0) { // Orientation verticale
                    posx = rand() % grid->size;
                    posy = rand() % (grid->size - tab[i] + 1);
                    for (int j = 0; j < tab[i]; j++) { // Vérification que les cases ne sont pas prises
                        if (grid->Field[(posy + j) * grid->size + posx] != 0) {
                            libre = 0;
                            break;
                        }
                    }
                    if (libre) { // Si les cases ne sont pas prises, on place
                        for (int j = 0; j < tab[i]; j++) {
                            grid->Field[(posy + j) * grid->size + posx] = 8;
                        }
                        defineBoat(grid, 1);
                        waterAroundHead(grid->size, grid->Field); // Entourer d'eau
                        fillCorners(grid->size, grid->Field);
                    }
                    else {
                        essais++;
                    }
                }
                else { // Orientation horizontale
                    posx = rand() % (grid->size - tab[i] + 1);
                    posy = rand() % grid->size;
                    for (int j = 0; j < tab[i]; j++) { // Vérification que les cases ne sont pas prises
                        if (grid->Field[posy * grid->size + (posx + j)] != 0) {
                            libre = 0;
                            break;
                        }
                    }
                    if (libre) { // Si les cases ne sont pas prises, on place
                        for (int j = 0; j < tab[i]; j++) {
                            grid->Field[posy * grid->size + (posx + j)] = 8;
                        }
                        defineBoat(grid, 1);
                        waterAroundHead(grid->size, grid->Field); // Entourer d'eau
                        fillCorners(grid->size, grid->Field);
                    }
                    else {
                        essais++;
                    }
                }
            }

            if (essais >= 7 && !libre) { // Si on a essayé 7 fois sans succès
                fail = 1; // Marquer fail pour recommencer le processus
                break; // Sortir de la boucle pour recommencer le processus
            }
        }
    } while (fail); // On recommence si la grille a mené à une erreur

    grid->HValues = (char*)malloc(grid->size * sizeof(char)); // On alloue les HValues
    if (grid->HValues == NULL) {
        free(grid->Field);
        free(grid);
        printf("Erreur d'allocation mémoire pour les HValues.\n");
        return NULL;
    }
    countboatcolo(grid);

    grid->VValues = (char*)malloc(grid->size * sizeof(char)); // On alloue les VValues
    if (grid->VValues == NULL) {
        free(grid->HValues);
        free(grid->Field);
        free(grid);
        printf("Erreur d'allocation mémoire pour les VValues.\n");
        return NULL;
    }
    countboatligne(grid);

    if (hideCells(grid, difficulty) == -1) {
        free(grid->VValues);
        free(grid->HValues);
        free(grid->Field);
        free(grid);
        printf("Erreur lors de l'exécution de hideCells.\n");
        return NULL;
    }

    char* field = grid->Field;
    int size = grid->size;
    char* res1 = toString(field, size);
    char* res2 = toStringValues(grid->HValues, size);
    char* res3 = toStringValues(grid->VValues, size);
    char* res = (char*)realloc(res1,sizeof(char) * size * size * 2 + sizeof(char)*size * 4 + 2);
   
   
    strcat(res1, "#");
    strcat(res2, "#");
    strcat(res2, res3);
    strcat(res1, res2);

    free(grid->HValues);
    free(grid->VValues);
    free(grid->Field);
    free(grid);

    
    return res1;

}




