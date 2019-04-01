function agregarProducto(code){
	var amount = document.getElementById(code).value;
	window.location.href = 'ventas.php?action=add&code='+code+'&amount='+amount;
}
function borrarProducto(code){
	window.location.href = 'ventas.php?action=remove&code='+code;
}
//no se esta usando vaciarcarro, lo hace directamente desde el boton
function vaciarCarro(){
	window.location.href = 'ventas.php?action=empty';
}
//este tampoco
function cargarCarro(){
	window.location.href = 'ventas.php?action=load';
}


//Variable que guarda el total de la compra
var total = 0;
var devol = 0;

//Funcion que maneja la calculadora de cambio
$(document).ready(function() {
  var result = 0;
  var prevEntry = 0;
  var currentEntry = '0';
  updateEntreg(result);
  
  $('.button').on('click', function(evt) {
    var buttonPressed = $(this).html();
    console.log(buttonPressed);
    
    if (buttonPressed === "Borrar") {
      result = 0;
      currentEntry = '0';
    } else if (buttonPressed === '.') {
      currentEntry += '.';
    } else if (isNumber(buttonPressed)) {
      if (currentEntry === '0') currentEntry = buttonPressed;
      else currentEntry = currentEntry + buttonPressed;
    } 
    
    var entrRound = Math.round(currentEntry * 100) / 100;
    updateEntreg(entrRound);

    if (buttonPressed === 'Cambio') {
      currentEntry = operate(currentEntry);
      devol = currentEntry;
      operation = null;
      var devolRound = Math.round(currentEntry * 100) / 100;
      updateDevol(devolRound);
    }

  });
});

//Actualiza la pantalla con el importe entregado
updateEntreg = function(displayValue) {
  var displayValue = displayValue.toString()+' €';

  $('.screenEntreg').html(displayValue.substring(0, 6));
};

//Actualiza la pantalla con el importe a devolver
updateDevol = function(displayValue) {
  var displayValue = displayValue.toString();
  $('.screenDevol').html(displayValue.substring(0, 6)+' €');
};


isNumber = function(value) {
  return !isNaN(value);
}

//Calcula el cambio a devolver al cliente
operate = function(entregado) {
  total = parseFloat(total);
  entregado = parseFloat(entregado);
  
  
  return entregado - total;
  
}

devolucion = function (){
	window.location.href = 'cobro.php?devol='+devol;
}

//Guarda el total de la venta
guardarTotal = function(importe){
	total = importe;
	
}


function genPDF() {
	

	 
	html2canvas(document.getElementById('imprimir')).then(function(canvas) {
    document.body.appendChild(canvas);
    var img = canvas.toDataURL('image/png');
				var doc = new jsPDF();
				doc.addImage(img, 'PNG', 5, 5);
				doc.save('ticket.pdf');
				
				
});

	
	
}