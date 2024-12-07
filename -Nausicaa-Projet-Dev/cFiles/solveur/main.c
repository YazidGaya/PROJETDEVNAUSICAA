#include "functions.h"
#include <stdlib.h>
#include <stdio.h>

//Programme principal du solveur
int main(int argc, char* argv[]) {
	if (argc < 10)
		return -1;

	char size = argv[1][0] - '0';
	char* horizontalValues = argv[2];
	char* verticalValues = argv[3];
	char* field = argv[4];
	char nboats1 = argv[5][0] - '0';
	char nboats2 = argv[6][0] - '0';
	char nboats3 = argv[7][0] - '0';
	char nboats4 = argv[8][0] - '0';
	char nboats5 = argv[9][0] - '0';

	Grid* playGrid;
	//Tests des fonctions
	newGrid(&playGrid, size, horizontalValues, verticalValues, field, nboats1, nboats2, nboats3, nboats4, nboats5, 0, NULL);

	int i = 0;
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
		waterAroundHead(playGrid->size, playGrid->Field);
		fillLines(playGrid->size, playGrid->Field, playGrid->VValues, playGrid->HValues);
		completeLines(playGrid->size, playGrid->Field, playGrid->VValues, playGrid->HValues);
		sideMidBoat(playGrid->size, playGrid->Field);
		nextToFront(playGrid->size, playGrid->Field);
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
	{
		printf("%s", toString(playGrid->Field, playGrid->size));
		return(toString(playGrid->Field, playGrid->size));
	}
	if (isGridInvalid(playGrid->size, playGrid->Field, playGrid->VValues, playGrid->HValues, playGrid->NBoats1, playGrid->NBoats2, playGrid->NBoats3, playGrid->NBoats4, playGrid->NBoats5) == 0) {
		ret = backTracking(playGrid);
		printf("%s\n", ret);
		return(ret);
	}
	printf("0");
	return(0);
}
