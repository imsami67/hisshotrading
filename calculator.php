<div id="calculator" role="application">
	<!-- Screen -->
	<div class="top">
		<div class="screen" aria-labelledby="displayScreen"></div>
	</div>
	
	<div class="keys" aria-labelledby="inputKeys">
		<!-- operators and other keys -->
		<span tabindex="0">7</span>
		<span tabindex="0">8</span>
		<span tabindex="0">9</span>
		<span tabindex="0" class="operator">+</span>
		<span tabindex="0">4</span>
		<span tabindex="0">5</span>
		<span tabindex="0">6</span>
		<span tabindex="0" class="operator">-</span>
		<span tabindex="0">1</span>
		<span tabindex="0">2</span>
		<span tabindex="0">3</span>
  	<span tabindex="0" class="operator">x</span>
    <span tabindex="0" class="clear">C</span>
		<span tabindex="0">0</span>
		<span tabindex="0">.</span>
		<span tabindex="0" class="operator">÷</span>
    <span tabindex="0" class="eval">=</span>
    <span tabindex="0" class="operator">^</span>
	</div>
</div>

<style type="text/css">
	@import url(https://fonts.googleapis.com/css?family=Quicksand:400,700);

/* Basic reset */
* {
	margin: 0;
	padding: 0;
	box-sizing: border-box;
	
	/* Text styling */
	font: 400 46px "Quicksand", sans-serif;
  color:#fff;
  text-align:center;
}

/* BG gradient */
html {
	background: #229ad7;
  background-image: linear-gradient(to bottom, rgba(34,156,219,1) 0%, rgba(10,114,187,1) 100%);
  background-attachment: fixed;
}

/* Calculator */
#calculator {
	width: 325px;
	height: auto;
	margin: 100px auto;
	padding: 20px 20px 9px;
	/* background: #none; */
	/* background: linear-gradient(#c9dd84, #9fcb96); */
	border-radius: 5px;
}

/* Top */
.top  span.clear{
	float: left;
}

/* Screen styling */


.top .screen {
  height:90px;
	width: 100%;
	padding: 0 10px;
	background: rgba(154, 185, 188, 0.8);
	border-radius: 5px;
  margin-bottom:10px;
	/* Typography */
	font-size: 30px;
	line-height: 90px;
	color: white;
	text-align: right;
  overflow:auto;
}

/* Clear floats */
.keys  {
  overflow: hidden;
}

/* Keys */
.keys span, .top span.clear {
	float: left;
	position: relative;
	top: 0;
	background: #523d98;
	font-size:27px;
	cursor: pointer;
	width: 66px;
	height: 46px;
	border-radius: 5px;
	box-shadow: 0px 4px rgba(0, 0, 0, 0.2);
	margin: 0 7px 11px 0;
	color: #f1c851;
	line-height: 46px;
	text-align: center;
	user-select: none;
  outline: 0 solid;
	/* hover and active state transitions */
	transition: all 0.2s ease;
}

/* Unique key styling */
.keys span.operator {
	background: #536ea5;
	margin-right: 0;
}

.keys span.operator sup {
  font-size: 50%;
  vertical-align: top;
  color:#f1c851;
}

.keys span.eval {
	background: #d6643f;
	box-shadow: 0px 4px #c3502b;
	color: #f1c851;
  width: 212px;
}

span.clear {
	background: #523d98;
	box-shadow: 0px 4px rgba(0, 0, 0, 0.2);
}

/* hover effects */
.keys span:hover {
	background: #795ebd;
	color: white;
}

.keys span.eval:hover {
	background: #f37c4c;
	box-shadow: 0px 4px #d65f3d;
	color: #ffffff;
}

.keys span.operator:hover {
	background: #5d7bba;
	color: #ffffff;
}

.top span.clear:hover {
	background: #f68991;
	box-shadow: 0px 4px #d3545d;
	color: white;
}

/* Simulating "pressed" effect */
.keys span:active {
	box-shadow: 0px 0px #6b54d3;
	top: 4px;
}

.keys span.eval:active {
	box-shadow: 0px 0px #717a33;
	top: 4px;
}

.top span.clear:active {
	top: 4px;
	box-shadow: 0px 0px #d3545d;
}
</style>

<script type="text/javascript">
	
// Select all the from document using queryselectAll
var keys = document.querySelectorAll('#calculator span');
// Define operators
var operators = ['+', '-', 'x', '÷', '^'];
// Set decimal flag for use later
var decimalAdded = false;

// loop through all keys
for(var i = 0; i < keys.length; i++) {
  //add onclick event to the keys
	keys[i].onclick = function(e) {
		// Get the input and button values
		var input = document.querySelector('.screen');
		var inputVal = input.innerHTML;
		var btnVal = this.innerHTML;
    
		// If clear key is pressed, erase everything
		if(btnVal == 'C') {
			input.innerHTML = '';
			decimalAdded = false;
		}
		
		// If eval key is pressed, calculate and display the result
		else if(btnVal == '=') {
			var equation = inputVal; //append equation to variable
			var lastChar = equation[equation.length - 1]; //target the end of the eval string
     	
			// Use regex to replace all instances of x, ÷, ^ with *, / and **
			equation = equation.replace(/x/g, '*').replace(/÷/g, '/').replace(/\^/g, '\*\*');
			
			//Use regex to remove decimals from the end of an equation
			if(operators.indexOf(lastChar) > -1 || lastChar == '.')
				equation = equation.replace(/.$/, '');
      
			// use javascript's eval function to get the result
      
			if(equation)
				input.innerHTML = eval(equation);	
			  decimalAdded = false;
		}
		
		// Javascript checks

    // No two operators should be added consecutively.		
		else if(operators.indexOf(btnVal) > -1) {
			// Get the last character from the equation
			var lastChar = inputVal[inputVal.length - 1];
			
			// Only add operator if input is not empty 
			if(inputVal != '' && operators.indexOf(lastChar) == -1) 
				input.innerHTML += btnVal;
			
			// Allow minus operator if the string is empty
			else if(inputVal == '' && btnVal == '-') 
				input.innerHTML += btnVal;
			
			// Replace the last operator (if exists) with the newly pressed operator
			if(operators.indexOf(lastChar) > -1 && inputVal.length > 1) {
				input.innerHTML = inputVal.replace(/.$/, btnVal);
			}
			
			decimalAdded =false;
		}
    // allow decimal point input
		else if(btnVal == '.') {
			if(!decimalAdded) {
				input.innerHTML += btnVal;
				decimalAdded = true;
			}
		}
		
		// if any other key is pressed, just append it after the decimal
		else {
			input.innerHTML += btnVal;
		}
		
		// prevent page jumps
		e.preventDefault();
	} 
}

//adding keyboard input functionality
document.onkeydown = function(event) {

	var key_press = String.fromCharCode(event.keyCode);
	var key_code = event.keyCode;
	var input = document.querySelector('.screen');
	var inputVal = input.innerHTML;
	var btnVal = this.innerHTML;
  var lastChar = inputVal[inputVal.length - 1];
  var equation = inputVal;
	// Using regex to replace all instances of x, ÷, ^ with *, / and ** respectively. 
	equation = equation.replace(/x/g, '*').replace(/÷/g, '/').replace(/\^/g, '**');

 // Target each keypress and update the input screen
  
    if(key_press==1) {
      input.innerHTML += key_press;
  }
    if(key_press==2) {
      input.innerHTML += key_press; 
  }
    if(key_press==3 || key_code == 32) {
      input.innerHTML += key_press; 
  }
    if(key_press==4) {
      input.innerHTML += key_press; 
  }
    if(key_press==5) {
      input.innerHTML += key_press; 
  }
    if(key_press==6 && event.shiftKey == false) {
      input.innerHTML += key_press; 
  }
    if(key_press==7) {
      input.innerHTML += key_press; 
  }
    if(key_press==8 && event.shiftKey == false) {
      input.innerHTML += key_press; 
  }
    if(key_press==9) {
      input.innerHTML += key_press; 
  }
    if(key_press==0) {
      input.innerHTML += key_press;
  }
  
  // Cature operators and prevent from addint two consecutuve operators
  
    if ((inputVal != '' && operators.indexOf(lastChar) == -1 && key_code == 187 && event.shiftKey) || (key_code == 107) || (key_code == 61 && event.shiftKey)) {
      document.querySelector('.screen').innerHTML += '+';
  }
    if ((inputVal != '' && operators.indexOf(lastChar) == -1 && key_code == 189 && event.shiftKey) || (inputVal != '' && operators.indexOf(lastChar) == -1 && key_code == 107)) {
      document.querySelector('.screen').innerHTML += '-';
  }
    if ((inputVal != '' && operators.indexOf(lastChar) == -1 && key_code == 56 && event.shiftKey) || (inputVal != '' && operators.indexOf(lastChar) == -1 && key_code == 106)) {
      document.querySelector('.screen').innerHTML += 'x';
  }
    if ((inputVal != '' && operators.indexOf(lastChar) == -1 && key_code == 191) || (inputVal != '' && operators.indexOf(lastChar) == -1 && key_code == 111)) {
      document.querySelector('.screen').innerHTML += '÷';
  }
    if ((inputVal != '' && operators.indexOf(lastChar) == -1 && key_code == 54 && event.shiftKey)) {
      document.querySelector('.screen').innerHTML += '^';
  }
    if(key_code==13 || key_code==187 && event.shiftKey == false) {
      input.innerHTML = eval(equation);
      //reset decimal added flag
      decimalAdded =false;
  }
    if(key_code==8 || key_code==46) {
			input.innerHTML = '';
			decimalAdded = false;
  }
}
</script>