#include "functions.h"
#include <stdio.h>
#include <stdlib.h>
#include <stdbool.h>

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
        if (tab[i] == 7 && tab[i - 1] == 0)
            tab[i - 1] = 8;
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

    for (int j = 0; j < grid2->size * grid2->size; j++)
    {
        for (int k = 0; k < (grid2->size * grid2->size); k++)
        {
            tmp2[k] = grid2->Field[k];
        }

        if (grid2->Field[j] == 0) {
            
            grid2->Field[j] = 8;

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
                waterAroundHead(grid2->size, grid2->Field);
                fillLines(grid2->size, grid2->Field, grid2->VValues, grid2->HValues);
                completeLines(grid2->size, grid2->Field, grid2->VValues, grid2->HValues);
                sideMidBoat(grid2->size, grid2->Field);
                nextToFront(grid2->size, grid2->Field);
                

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

            if (isGridValid(grid2) == 1)
                return(toString(grid2->Field, grid2->size));
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
                //printf("%d\n", count);
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

//fonction qui place les bateaux dans les empmlacement restat qui ont la bonne taille
int placeBoatsInAvailableSpaces(Grid* grid) {
    int* boats = countBoats(grid);
    int spaces = 0;
    if (boats[4] < grid->NBoats5) {
        for (int i = 0; i < grid->size; i++)
        {
            for (int j = 0; j < grid->size - 4; j++)
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
                    if (grid->Field[i * grid->size + j] == 0 && grid->Field[i * grid->size + j + 1] == 0 && grid->Field[i * grid->size + j + 2] == 0 && grid->Field[i * grid->size + j + 3] == 0 && grid->Field[i * grid->size + j + 4] == 0) {
                        grid->Field[i * grid->size + j] = 6;
                        grid->Field[i * grid->size + j + 1] = 3;
                        grid->Field[i * grid->size + j + 2] = 3;
                        grid->Field[i * grid->size + j + 3] = 3;
                        grid->Field[i * grid->size + j + 4] = 7;
                    }
                    if (grid->Field[j * grid->size + i] == 0 && grid->Field[j * grid->size + i + 1] == 0 && grid->Field[j * grid->size + i + 2] == 0 && grid->Field[j * grid->size + i + 3] == 0 && grid->Field[j * grid->size + i + 4] == 0) {
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
            for (int i = 0; i < grid->size - 3; i++)
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