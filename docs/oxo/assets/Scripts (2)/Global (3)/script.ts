
var ray = new Sup.Math.Ray(); //mouse
const TILES = new Array;
var turn : string;  //cross == player || circle == ai

// Victory possibilities
const VICTORIES = [
  // Row
    [0, 1, 2], 
    [3, 4, 5],
    [6, 7, 8],
// Column
    [0, 3, 6],
    [1, 4, 7],
    [2, 5, 8],
// Diagonal
    [0, 4, 8],
    [2, 4, 6],
  ];

namespace Game{

  
  export function startGame(){
  let tile;
  for(tile of TILES){
      tile[1] = "unHover";
    }
    randomStart();
  }
  
    

  function randomStart(){
    if(Math.floor(Math.random() * 2)){ //first player chosen randomly
      // choose random tile and play it
      let randomIndex = Math.floor(Math.random() * 9);
      playTiles(TILES[randomIndex]);
    }
    turn = "cross"; //give the turn to the player
  }
  
  
  export function setTiles(){
    function addTiles(index){
      let name = "Tiles" + index.toString();

      // get the actor from the Game scene
      let tile = Sup.getActor("Board").getChild(name);
      TILES.push([tile, "unHover"]);
    }
    
    for(let i = 0; i < 9; i++){
      addTiles(i); //recussif
    }
  }

  

  function checkBoard(){
    let crossCounter : number = 0;
    let circleCounter : number = 0;
    let freeTiles;
    let line; let index;
    let win;
    let block;

    
    for(line of VICTORIES){
      for(index of line){

        if(TILES[index][1] == "cross"){
          crossCounter++
        }
        else if(TILES[index][1] == "circle"){
          circleCounter++
        }
        else{
          freeTiles = TILES[index];
        }
      }
      
      
      
      // Check if win
    if(circleCounter == 2 && crossCounter == 0){ //computer
        win = ["Win", freeTiles];
      }
      
      else if(crossCounter == 2 && circleCounter == 0){ //player
        block = ["Block", freeTiles];
      }
      
    crossCounter = 0;
    circleCounter = 0;
    }
    
    if(win){
      return win;
    }
    else if(block){
      return block;
    }
    else{
      return ["Play", undefined];
    }
    
  }

  
  
  export function AI(){

    let check = checkBoard();
    if(check[0] == "Win"){
      playTiles(check[1]);
    }

    else if(check[0] == "Block"){
      playTiles(check[1]);
    }

    else if(check[0] == "Play"){

      if(TILES[4][1] !== "cross" && TILES[4][1] !== "circle"){
        playTiles(TILES[4]);
      }

      else if(
              TILES[0][1] !== "cross" && TILES[0][1] !== "circle" ||
              TILES[2][1] !== "cross" && TILES[2][1] !== "circle" ||
              TILES[6][1] !== "cross" && TILES[6][1] !== "circle" ||
              TILES[8][1] !== "cross" && TILES[8][1] !== "circle"
             ){
        playTiles(getTile([0, 2, 6, 8]));
      }

      else if(
              TILES[1][1] !== "cross" && TILES[1][1] !== "circle" ||
              TILES[3][1] !== "cross" && TILES[3][1] !== "circle" ||
              TILES[5][1] !== "cross" && TILES[5][1] !== "circle" ||
              TILES[7][1] !== "cross" && TILES[7][1] !== "circle"
             ){
        playTiles(getTile([1, 3, 5, 7]));
      }

      else{
        Sup.log("Game Over")
      }
    }
  }//end of AI

  
  // Free square
  function getTile(array){
    let index;
    let freeTiles = new Array;

    
    //Check array index
    //if the square is free add to freeSquares

    for(index of array){
      if(TILES[index][1] !== "cross" && TILES[index][1] !== "circle"){
        freeTiles.push(TILES[index]);
      }
    }
    // then take randomly one the square from freeSquares and return it
    let randomIndex = Math.floor(Math.random() * freeTiles.length);
    return freeTiles[randomIndex];
  }

  
  
  function playTiles(tile){
    tile[0].spriteRenderer.setAnimation("circle");
    tile[1] = "circle";
  }

  
  
export function checkVictory(){
    let countCross: number = 0;
    let countCircle: number = 0;
    let countFreeTiles: number = 0; //check if draw
    let line: number[];
    let index: number;


    for(line of VICTORIES){
      for(index of line){
        if(TILES[index][1] == "cross"){
          countCross++
        }
        else if(TILES[index][1] == "circle"){
          countCircle++
        }
        else{
          countFreeTiles++
        }
      }
      if(countCross == 3){
        displayScreen();
      }
      if(countCircle == 3){
        displayScreen();
      }
      countCross = 0;
      countCircle = 0;
    }
   
   if(countFreeTiles == 0){
        turn = "tie"; 
        displayScreen();
    }
  }

  
  
  function displayScreen(){
    let Screen = new Sup.Actor("Screen");
    new Sup.SpriteRenderer(Screen, "Sprites/Screens");
    Screen.spriteRenderer.setAnimation(turn);
    Screen.addBehavior(ScreenBehavior);
    var WIN= 0;
    if (turn == "cross"){
       WIN = 1;
    }

    Screen.setPosition(0, 0, -2);
    turn = "end";

    function displayFrame(){
      Screen.setPosition(0, 0, 4);
    }
    Sup.setTimeout(1000, displayFrame);
  }
  

}
