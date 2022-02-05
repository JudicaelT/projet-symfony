class Square {

    resizeSquares() {
      
      let squares = document.querySelectorAll('.square');

      squares.forEach(function(square) {
        square.style.height = square.offsetWidth+"px";
      });
    }
}

let square = new Square();
square.resizeSquares();

window.addEventListener('resize', () => { square.resizeSquares() });