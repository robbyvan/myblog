$(document).ready(function(){
  var startButton = document.getElementById("start");
  startButton.addEventListener ("click", function(){
    gameStart();
  });
});


function gameStart(){
  clock = null;
  $("#title").html("Score");
  $("#con").empty();
  $("#score").html(0);
  state = 0;
  speed = 4;
  alreadyFail = 0;

  for (var i = 0; i < 3; i++) {
    createRow();
  }
  
  document.getElementById("main").onclick = function(event){
      if (!alreadyFail) {
        judge(event);
      }
  };
  clock = window.setInterval('move()', 30);
}

function createDiv(className){
  var div = document.createElement('div');
  div.className = className;
  return div;
}

function createCell(){
  var temp = ['cell', 'cell', 'cell', 'cell'];
  var i = Math.floor(Math.random() * 4);
  temp[i] = 'cell black';
  return temp;
}

function createRow(){
  var con = document.getElementById("con");
  var row = createDiv("row");
  var arr = createCell();

  con.appendChild(row);

  for (var i = 0; i < 4; i++) {
    row.appendChild(createDiv(arr[i]));
  }

  if (con.firstChild === null) {
    con.appendChild(row);
  }else{
    con.insertBefore(row, con.firstChild);
  }
  row.setAttribute("data-pass", "0");
}

function deleteRow(){
  var con = document.getElementById("con");
  // var rows = con.getElementsByClassName("row");
  if (con.childNodes.length == 6) {
    con.removeChild(con.lastChild);
  }
}

function move(){
  var con = document.getElementById("con");
  var top = parseInt(window.getComputedStyle(con, null)['top']);//get CSS style of top

  if (speed + top > 0) {
    top = 0;
  }else{
    top += speed;
  }
  con.style.top = top + "px";

  if (top == 0) {
    createRow();
    con.style.top = "-100px";
    deleteRow();
  }else if (top == (-100 + speed) ){
    var rows = con.childNodes;
    if ((rows.length == 5) && (rows[rows.length-1].getAttribute("data-pass") != "1")) {
      slowFail();
    }
  }
}

function slowFail(){
  clearInterval(clock);
  // $("#con").empty();
  alreadyFail = 1;
  $("#title").html("Oops, a block touched down! xP")
  $("#score").html('Final Score: ' + parseInt($('#score').html()) );
}
function misClickFail(){
  clearInterval(clock);
  // $("#con").empty();
  alreadyFail = 1;
  $("#title").html("Oops, you clicked a white block! xP")
  $("#score").html("Final Score: " + parseInt($('#score').html()) );
}

function judge(ev){
  if (ev.target.className.indexOf('black') == -1) {
    misClickFail();
  }else{
    $(ev.target).animate({opacity: 0}, 200);
    $("#wrap").append('<embed id="embed_player" src="./sound/bubble_clap.mp3" autostart="true" hidden="true"></embed>');
    ev.target.parentNode.setAttribute("data-pass", "1");
    score();
  }
}

function speedUp(){
  speed += 2;
  if (speed == 20) {
    alert('Legendary!');
  }
}

function score(){
  var newScore = parseInt($("#score").html()) + 1;
  $("#score").html(newScore);
  if (newScore % 10 == 0) {
    speedUp();
  }
}

