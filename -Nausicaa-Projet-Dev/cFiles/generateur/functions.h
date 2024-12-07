#pragma once
// structure de la grille 
typedef struct Grid {

	int size;
	char* HValues;
	char* VValues;
	char* Field;
	char NBoats1;
	char NBoats2;
	char NBoats3;
	char NBoats4;
	char NBoats5;
	struct Grid* previous;
	struct Grid* next;
	char rank;

} Grid;

int newGrid(Grid** grid, char size, char* hvalues, char* vvalues, char* field, char nboats1, char nboats2, char nboats3, char nboats4, char nboats5, char rank, Grid* actual);

int copyGrid(Grid** grid, Grid* old);

int defineTab(char* chaine, char* tab);

int fillCorners(int size, char* tab);

int fillLines(int size, char* tab, char* VValues, char* HValues);

int completeLines(int size, char* tab, char* VValues, char* HValues);

int nextToFront(int size, char* tab);

int sideMidBoat(int size, char* tab);

int waterAroundHead(int size, char* tab);

char* backTracking(Grid* playGrid);

int countBoatLines(int size, char* tab, char* VValues, char* HValues);

int verifBoats(int size, char* tab, char NBoat1, char NBoat2, char NBoat3, char NBoat4, char NBoat5);

int isTouching(int size, char* tab);

int isGridValid(Grid* grid);

int isGridInvalid(int size, char* tab, char* VValues, char* HValues, char NBoat1, char NBoat2, char NBoat3, char NBoat4, char NBoat5);

int defineBoat(Grid* grid, int gen);

char* toString(char* tab, int size);

int placeBoatsInAvailableSpaces(Grid* grid);

int CountBoat(int size, char* tab, char* VValues, char* HValues);

char* backTrackingGen(Grid* playGrid, char** tab);

char* makesSolutionUnique(Grid* grid);

int hideCells(Grid* grid, int difficulty);

char* addGridToTab(Grid* grid, char** tab);

int countboatligne(Grid* grid);

int countboatcolo(Grid*grid);

char* generateur(int taille, int difficulty); 

int* countBoats(Grid* grid);

int defineBoat(Grid* grid, int gen);

char* toStringValues(char* tab, int size);
