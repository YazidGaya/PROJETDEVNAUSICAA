#include "functions.h"
#include <stdlib.h>
#include <stdio.h>

//Programme principal du solveur
int main(int argc, char* argv[]) {
	if (argc < 10)
		return -1;
	// Récupération des arguments pour initialiser la grille
	char size = argv[1][0] - '0'; // Taille de la grille
	char* horizontalValues = argv[2];// Contraintes horizontales
	char* verticalValues = argv[3]; // Contraintes verticales
	char* field = argv[4];// Grille initiale
	char nboats1 = argv[5][0] - '0'; // Nombre de bateaux de taille 1
	char nboats2 = argv[6][0] - '0'; // Nombre de bateaux de taille 2
	char nboats3 = argv[7][0] - '0'; // Nombre de bateaux de taille 3
	char nboats4 = argv[8][0] - '0'; // Nombre de bateaux de taille 4
	char nboats5 = argv[9][0] - '0'; // Nombre de bateaux de taille 5

	Grid* playGrid;// Déclaration d'une grille de jeu
	//Tests des fonctions
	// Initialisation de la grille avec les données fournies
	newGrid(&playGrid, size, horizontalValues, verticalValues, field, nboats1, nboats2, nboats3, nboats4, nboats5, 0, NULL);

	int i = 0;
	char* tmp = (char*)malloc(sizeof(char) * playGrid->size * playGrid->size);//Comparer les états de la grille
	char* ret = (char*)malloc(sizeof(char) * playGrid->size * playGrid->size * 2);
	i = 0;

	int modif = 1;//Indique si des modifications ont été effectuées sur la grille
	while (modif != 0)
	{	// Sauvegarde de l'état actuel de la grille
		for (int k = 0; k < playGrid->size * playGrid->size; k++)
		{
			tmp[k] = playGrid->Field[k];
		}

		modif = 0;// Réinitialisation du drapeau de modification
		fillCorners(playGrid->size, playGrid->Field);
		waterAroundHead(playGrid->size, playGrid->Field);
		fillLines(playGrid->size, playGrid->Field, playGrid->VValues, playGrid->HValues);
		completeLines(playGrid->size, playGrid->Field, playGrid->VValues, playGrid->HValues);
		sideMidBoat(playGrid->size, playGrid->Field);
		nextToFront(playGrid->size, playGrid->Field);
		defineBoat(playGrid, 0);

		// Vérifie si l'état de la grille a changé
		i = 0;
		while (i < (playGrid->size * playGrid->size) && modif == 0)
		{
			if (playGrid->Field[i] != tmp[i])
				modif = 1;
			i++;
		}
	}
	// Vérifie si la grille est valide
	if (isGridValid(playGrid) == 1)
	{
		printf("%s", toString(playGrid->Field, playGrid->size));
		return(toString(playGrid->Field, playGrid->size));
	}
	if (isGridInvalid(playGrid->size, playGrid->Field, playGrid->VValues, playGrid->HValues, playGrid->NBoats1, playGrid->NBoats2, playGrid->NBoats3, playGrid->NBoats4, playGrid->NBoats5) == 0) {
		ret = backTracking(playGrid);
		printf("%s\n", ret);
		return(ret);
	}
	// Si aucune solution n'est trouvée, retourne "0"
	printf("0");
	return(0);
}
