



class PlayerBehavior extends Sup.Behavior {
  
  awake() {
    Game.setTiles();
    Game.startGame();
  }
  
  
  
  // mouse method 
  mouse(action, tile){
    if(action == "click"){
      tile.spriteRenderer.setAnimation("cross");
    }
  }
  
  
  
  gameTurn(){
    turn = "cross";
    Game.checkVictory();
    
    if(turn !== "end"){
      turn = "circle";
      Game.AI();
      Game.checkVictory();
      
      if(turn !== "end"){
          turn = "cross";
      }
     }
    }
  
  
  update() {
    // Refresh mouse ray casting
    ray.setFromCamera(Sup.getActor("Camera").camera, Sup.Input.getMousePosition());
    let array;

    for(array of TILES){
      
      if(ray.intersectActor(array[0], false).length > 0){
        
        if(array[1] == "unHover"){
          // if true : set tile to new situation
          array[1] = "isHover";
          this.mouse("isHover", array[0]);
        }
        
        //mouse click
        if(Sup.Input.wasMouseButtonJustPressed(0) && array[1] == "isHover"){
          if(turn == "cross"){
            array[1] = "cross";
            this.mouse("click", array[0]);
            
            turn = "break";
            Sup.setTimeout(600, this.gameTurn);
          }
        }
        
      }
      
      // Change isHover to unHover if true
      else if(array[1] == "isHover"){
        array[1] = "unHover";
        this.mouse("unHover", array[0]);
      }
    }
    
  }
}
Sup.registerBehavior(PlayerBehavior);


//end game screen
class ScreenBehavior extends Sup.Behavior {  
  
  update() {
    if(Sup.Input.wasMouseButtonJustPressed(0)){
      Sup.getActor("Screen").destroy();
      Game.startGame();
      }
    }
 }

Sup.registerBehavior(ScreenBehavior);