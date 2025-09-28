<?php
// Save as PuzzlePlatformer.php and run with PHP server, play in browser.
?>
<!DOCTYPE html>
<html>
<head>
<title>Puzzle Platformer</title>
<style>
body { background: #222; color: #fff; font-family: Arial;}
canvas { background: #333; display: block; margin: 40px auto;}
</style>
</head>
<body>
<h1 style="text-align:center;">Puzzle Platformer</h1>
<canvas id="game" width="640" height="480"></canvas>
<script>
const c=document.getElementById("game"),ctx=c.getContext("2d");
let player={x:40,y:400,vx:0,vy:0,key:false};
let plats=[[0,460,640,20],[100,380,120,16],[300,320,100,16],[500,260,120,16]];
let key=[570,220], door=[600,200];
document.addEventListener("keydown",e=>{
  if(e.key=="ArrowLeft")player.vx=-5;
  if(e.key=="ArrowRight")player.vx=5;
  if(e.key==" "&&player.vy==0)player.vy=-16;
});
document.addEventListener("keyup",e=>{
  if(e.key=="ArrowLeft"||e.key=="ArrowRight")player.vx=0;
});
setInterval(()=>{
  player.vy+=1; player.x+=player.vx; player.y+=player.vy;
  for(let p of plats)
    if(player.x+32>p[0]&&player.x<p[0]+p[2]&&player.y+32>p[1]&&player.y<p[1]+p[3]){player.y=p[1]-32;player.vy=0;}
  if(Math.abs(player.x-key[0])<32&&Math.abs(player.y-key[1])<32)player.key=true;
  if(player.key&&Math.abs(player.x-door[0])<32&&Math.abs(player.y-door[1])<32){
    player.x=40;player.y=400;player.key=false;
  }
  if(player.y>460)player.y=400;
  ctx.clearRect(0,0,640,480);
  ctx.fillStyle="#ff0";ctx.fillRect(player.x,player.y,32,32);
  ctx.fillStyle="#0f0";plats.forEach(p=>ctx.fillRect(...p));
  ctx.fillStyle="#0ef";if(!player.key)ctx.fillRect(key[0],key[1],24,24);
  ctx.fillStyle="#f00";ctx.fillRect(door[0],door[1],36,36);
  ctx.fillStyle="#fff";ctx.fillText("Get the key and reach the door!",10,30);
},1000/60);
</script>
</body>
</html>