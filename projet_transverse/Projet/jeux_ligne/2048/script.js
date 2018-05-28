/*Une partie de ce code est inspiré du code d'un jeu 2048 toruvé sur github. Nous nous en sommes inspiré pour créer nos fonctions
 que nous avons assimilées, comprises et commentées pour avoir un jeu le plus similaire possible au vrai jeu 2048 et offrir
 au joueur la sensation d'un véritable jeu mis sur le marché!  */



var canvas = document.getElementById('canvas');
var ctx = canvas.getContext('2d');/* on nomme l'id canvas car il s'agit de paramètres par défaut signifiant case
en javascript*/
var sizeInput = document.getElementById('size');
var size= sizeInput.value = 4;
var scoreLabel = document.getElementById('score');
var score = 0;
var width = canvas.width / size - 6;
var cellules = [];
var fontSize;
var loss = false;


console.log(sizeInput.value);
canvasClean();
startGame();


function canvasClean() {
    ctx.clearRect(0, 0, 500, 500);
}

function finJeu() {
    canvas.style.opacity = '0.64'; /*on floute le tableau de jeu pour que le joueur comprenne qu'il a perdu*/
    loss = true;
}
function uneCelule(cell) {
    ctx.beginPath();
    ctx.rect(cell.x, cell.y, width, width);
    switch (cell.value){ //on établit les couleurs pour chaque cellule en fonction de sa valeur
        case 0 : ctx.fillStyle = '#FFFFFF'; break;
        case 2 : ctx.fillStyle = '#D2691E'; break;
        case 4 : ctx.fillStyle = '#FF7F50'; break;
        case 8 : ctx.fillStyle = '#ffbf00'; break;
        case 16 : ctx.fillStyle = '#bfff00'; break;
        case 32 : ctx.fillStyle = '#40ff00'; break;
        case 64 : ctx.fillStyle = '#00bfff'; break;
        case 128 : ctx.fillStyle = '#4682B4'; break;
        case 256 : ctx.fillStyle = '#0040ff'; break;
        case 512 : ctx.fillStyle = '#ff0080'; break;
        case 1024 : ctx.fillStyle = '#D2691E'; break;
        case 2048 : ctx.fillStyle = '#FF7F50'; break;
        default : ctx.fillStyle = '#ff0080';
    }
    ctx.fill();
    if (cell.value) {
        fontSize = width / 2;
        ctx.font = fontSize + 'px Arial';
        ctx.fillStyle = 'white';
        ctx.textAlign = 'center';
        ctx.fillText(cell.value, cell.x + width / 2, cell.y + width / 2 + width/7);
    }
}

function celule(range, colonne) {
    this.value = 0; /*this correspond à la cellule en cours et prend initialement pour valeur 0*/
    this.x = colonne * width + 5 * (colonne + 1);
    this.y = range * width + 5 * (range + 1);
}
function creerCelules() { /*cette fonction permet de créer une cellule à partir de ses informations: rangé et colonne*/
    for(var i = 0; i < size; i++) {
        cellules[i] = [];
        for(var j = 0; j < size; j++) {
            cellules[i][j] = new celule(i, j);
        }
    }
}

function dessinerToutesCelules() { /*on utilise la fonction dessiner une seule cellules pour pouvoir toutes les dessiner*/
    for(var i = 0; i < size; i++) {
        for(var j = 0; j < size; j++) {
            uneCelule(cellules[i][j]);
        }
    }
}

function dessinerUneCellule() {  /*cette fonction permet de d'aficher une nouvelle cellul*/
    var a = 0;
    for(var i = 0; i < size; i++) {
        for(var j = 0; j < size; j++) {
            if(!cellules[i][j].value) {
                a++; /*pour toutes les cases du tableau de jeu on rajouter 1 à un compteur pour pouvoir compter le nombre de cases*/
            }
        }
    }
    if(!a) { /*si toutes les cases sont des cellules, c'est à dire qu'il n'y a plus de place pour une nouvelle cellule
    alors c'est perdu donc fin de jeu*/
        finJeu();
        return;
    }
    while(true) {
        var range = Math.floor(Math.random() * size);
        var colonne = Math.floor(Math.random() * size);
        if(!cellules[range][colonne].value) {
            cellules[range][colonne].value = 2 * Math.ceil(Math.random() * 2);
            dessinerToutesCelules();
            return;
        }
    }
}

function startGame() {
    creerCelules();
    dessinerToutesCelules();
    dessinerUneCellule();
    dessinerUneCellule();
    /*on crée deux cellules au début d'une partie comme dans le jeu commercialisé*/
}

document.onkeydown = function (event) { /*ceci est un 'templete' trouvé qui permet de savoir sur quelle touche
appuyée pour exécuter les actions des fonctions de déplacement: les touches en questions sont les fleches haut, bas, gauche , droite d'un clavier*/
    if (!loss) {
        if (event.keyCode === 38 || event.keyCode === 87) {
            haut();
        } else if (event.keyCode === 39 || event.keyCode === 68) {
            droite();
        } else if (event.keyCode === 40 || event.keyCode === 83) {
            bas;
        } else if (event.keyCode === 37 || event.keyCode === 65) {
            gauche();
        }
        scoreLabel.innerHTML = 'Score : ' + score;
    }
}



function droite () {
    var colonne;/*On a une variable pour se situer dans le tableau de jeu, colonne car pour aller à gauche c'est la colonne qui change et pas la rangé*/
    for(var i = 0; i < size; i++) {
        for(var j = size - 2; j >= 0; j--) {
            if(cellules[i][j].value) { /*si il y a une valeur dans la cellule en cours*/
                colonne = j; /*la colonne en cours que l'on va déplacer est donc établie à j*/
                while (colonne + 1 < size) { //tant que la colonne se situe dans le tableau
                    if (!cellules[i][colonne + 1].value) { //si la cellule à droite est une case vide
                        cellules[i][colonne + 1].value = cellules[i][colonne].value; //alors la case de droite va devenir une cellule prenant la valeur de la cellule en cours
                        cellules[i][colonne].value = 0; // la cellule en cours devient une case vide
                        colonne++; //la colonne est maintenant celle de droite
                    } else if (cellules[i][colonne].value == cellules[i][colonne + 1].value) { //si la case en cours et celle de droite on la meme valeur
                        cellules[i][colonne + 1].value *= 2; /*la nouvelle cellule prend la valeur des deux anciennes(identiques) multipliée par deux*/
                        score +=  cellules[i][colonne + 1].value; /*on rajoute au score la valeur de la nouvelle cellule*/
                        cellules[i][colonne].value = 0;// la cellule en cours devient une case vide
                        break;
                    } else {
                        break;
                    }
                }
            }
        }
    }
    dessinerUneCellule(); //on creer un nouvelle cellule dans le tableau
}

function gauche() {
    var colonne; /*On a une variable pour se situer dans le tableau de jeu, colonne car pour aller à gauche c'est la colonne qui change et pas la rangé*/
    for(var i = 0; i < size; i++) {
        for(var j = 1; j < size; j++) {
            if(cellules[i][j].value) { /*si il y a une valeur dans la cellule en cours alors*/
                colonne = j;
                while (colonne - 1 >= 0) { /*si on ne se situe pas sur la colonne tout à gauche du tableau de jeu*/
                    if (!cellules[i][colonne - 1].value) { /*alors si la case de gauche est une cellule VIDE*/
                        cellules[i][colonne - 1].value = cellules[i][colonne].value; /*alors la case de gauche prend la valeur de la cellule en colonne j*/
                        cellules[i][colonne].value = 0; /*la cellule de colonne j est maintenant vide*/
                        colonne--; /*est la colonne en cours devient alors la colonne de gauche*/
                    } else if (cellules[i][colonne].value == cellules[i][colonne - 1].value) { /*si la case à gauche à la meme valeur que ma cellule en cours*/
                        cellules[i][colonne - 1].value *= 2; /*alors la cellule à gauche prendre la valeur des deux cellules(identique) multipliée par deux
                        (ou la somme des deux cellules si on préfere)*/
                        score +=   cellules[i][colonne - 1].value; /*on ajoute au score la valeur de la cellule de gauche*/
                        cellules[i][colonne].value = 0; //la cellule en cours est mtn vide
                        break;
                    } else {
                        break;
                    }
                }
            }
        }
    }
    dessinerUneCellule(); /*on dessine une nouvel cellule*/
}

function haut() {
    var range; //la variable est ici la rangé(ou ligne) car l'action est le fait de monter donc c'est la ligne qui change et pas la colonne
    for(var j = 0; j < size; j++) {
        for(var i = 1; i < size; i++) {
            if(cellules[i][j].value) {/*si il y a une valeur dans la cellule en cours alors*/
                range = i; // la variable range prend la valeur de la ligne ou cette case se trouve
                while (range > 0) { //tant que la ligne se trouve dans le tableau, donc si elle est de valeur positive
                    if(!cellules[range - 1][j].value) { /*alors si la case du haut est une cellule VIDE*/
                        cellules[range - 1][j].value = cellules[range][j].value; /*alors la case du haut prend la valeur de la cellule à la ligne i*/
                        cellules[range][j].value = 0; /*la cellule de ligne i est maintenant vide*/
                        range--; //la ligne en cours devient alors la ligne du haut
                    } else if (cellules[range][j].value == cellules[range - 1][j].value) { /*si la case du haut à la meme valeur que ma cellule en cours*/
                        cellules[range - 1][j].value *= 2;/*alors la cellule du haut prendre la valeur des deux cellules(identique) multipliée par deux
                        (ou la somme des deux cellules si on préfere)*/
                        score +=  cellules[range - 1][j].value; //on ajoute au score la valeur de la cellule du haut
                        cellules[range][j].value = 0; // la cellule en cours est maintenant vide
                        break;
                    } else {
                        break;
                    }
                }
            }
        }
    }
    dessinerUneCellule();// on crée une nouvelle cellule
}

function bas() {
    var range; //la variable est ici la rangé(ou ligne) car l'action est le fait de descendre donc c'est la ligne qui change et pas la colonne
    for (var j = 0; j < size; j++) {
        for (var i = size - 2; i >= 0; i--) {
            if (cellules[i][j].value) { /*si il y a une valeur dans la cellule en cours alors*/
                range = i; // la variable range prend la valeur de la ligne ou cette case remplie se trouve
                while (range + 1 < size) { //tant que la ligne se trouve dans le tableau
                    if (!cellules[range + 1][j].value) { /*alors si la case du bas est une cellule VIDE*/
                        cellules[range + 1][j].value = cellules[range][j].value;/*alors la case du bas prend la valeur de la cellule à la ligne i*/
                        cellules[range][j].value = 0; /*la cellule de ligne i est maintenant vide*/
                        range++;//la ligne en cours devient alors la ligne du bas
                    } else if (cellules[range][j].value == cellules[range + 1][j].value) { /*si la case du bas à la meme valeur que ma cellule en cours*/
                        cellules[range + 1][j].value *= 2; /*alors la cellule du bas prendre la valeur des deux cellules(identique) multipliée par deux
                        (ou la somme des deux cellules si on préfere)*/
                        score += cellules[range + 1][j].value; //on ajoute au score la valeur de la cellule du bas (étant maintenant l'addition des deux précédentes cellules
                        cellules[range][j].value = 0; // la cellule en cours est maintenant vide
                        break;
                    } else {
                        break;
                    }
                }
            }
        }
    }
    dessinerUneCellule();
}

