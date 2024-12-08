#pragma once
// Création de la grille
typedef struct Grid {
    int size;               // Taille de la grille (ex : 10x10)
    char* HValues;          // Valeurs horizontales représentant les indices ou indices de ligne
    char* VValues;          // Valeurs verticales représentant les indices ou indices de colonne
    char* Field;            // Tableau représentant l'état des cases de la grille (bateaux, eau, etc.)
    char NBoats1;           // Nombre de bateaux de taille 1
    char NBoats2;           // Nombre de bateaux de taille 2
    char NBoats3;           // Nombre de bateaux de taille 3
    char NBoats4;           // Nombre de bateaux de taille 4
    char NBoats5;           // Nombre de bateaux de taille 5
    struct Grid* previous;  // Pointeur vers la grille précédente (utilisé dans une liste chaînée)
    struct Grid* next;      // Pointeur vers la grille suivante (utilisé dans une liste chaînée)
    char rank;              // Rang ou score associé à cette grille (ex : difficulté ou priorité)
} Grid;

// Crée une nouvelle grille de jeu
int newGrid(Grid** grid, char size, char* hvalues, char* vvalues, char* field, 
            char nboats1, char nboats2, char nboats3, char nboats4, char nboats5, 
            char rank, Grid* actual);

// Copie une grille existante dans une nouvelle instance
int copyGrid(Grid** grid, Grid* old);

// Définit un tableau à partir d'une chaîne de caractères
int defineTab(char* chaine, char* tab);

// Remplit les coins de la grille avec des valeurs spéciales
int fillCorners(int size, char* tab);

// Remplit les lignes de la grille en fonction des contraintes
int fillLines(int size, char* tab, char* VValues, char* HValues);

// Complète les lignes en appliquant des règles spécifiques
int completeLines(int size, char* tab, char* VValues, char* HValues);

// Vérifie les cases adjacentes pour éviter les chevauchements
int nextToFront(int size, char* tab);

// Gère les bateaux situés sur les côtés ou au milieu de la grille
int sideMidBoat(int size, char* tab);

// Ajoute de l'eau autour des têtes de bateaux pour respecter les règles
int waterAroundHead(int size, char* tab);

// Résout la grille par backtracking
char* backTracking(Grid* playGrid);

// Compte les bateaux par ligne en fonction des contraintes
int countBoatLines(int size, char* tab, char* VValues, char* HValues);

// Vérifie si les bateaux dans la grille respectent les contraintes
int verifBoats(int size, char* tab, char NBoat1, char NBoat2, char NBoat3, char NBoat4, char NBoat5);

// Vérifie si des bateaux se touchent
int isTouching(int size, char* tab);

// Vérifie si une grille est valide selon les règles
int isGridValid(Grid* grid);

// Vérifie si une grille est invalide
int isGridInvalid(int size, char* tab, char* VValues, char* HValues, 
                  char NBoat1, char NBoat2, char NBoat3, char NBoat4, char NBoat5);

// Définit la position d'un bateau dans la grille
int defineBoat(Grid* grid, int gen);

// Convertit une grille en chaîne de caractères
char* toString(char* tab, int size);

// Place les bateaux dans les espaces disponibles
int placeBoatsInAvailableSpaces(Grid* grid);

// Compte les bateaux dans les lignes et colonnes
int CountBoat(int size, char* tab, char* VValues, char* HValues);

// Résout la grille par backtracking avec génération multiple
char* backTrackingGen(Grid* playGrid, char** tab);

// Rend une solution unique pour la grille
char* makesSolutionUnique(Grid* grid);

// Cache des cases pour augmenter la difficulté
int hideCells(Grid* grid, int difficulty);

// Ajoute une grille à une liste ou un tableau
char* addGridToTab(Grid* grid, char** tab);

// Compte les bateaux présents dans chaque ligne
int countboatligne(Grid* grid);

// Compte les bateaux présents dans chaque colonne
int countboatcolo(Grid* grid);

// Génère une grille de jeu selon la taille et la difficulté
char* generateur(int taille, int difficulty);

// Compte le nombre total de bateaux présents dans une grille
int* countBoats(Grid* grid);

// Définit les bateaux dans la grille (variante)
int defineBoat(Grid* grid, int gen);

// Convertit les valeurs d'un tableau en chaîne de caractères
char* toStringValues(char* tab, int size);
