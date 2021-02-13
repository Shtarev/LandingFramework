<?php session_start(); ?>
<!doctype html>
<html>
<head>
<meta charset='utf-8'>
<title>Hallo</title>
<style>
body {
    font-family: 'Gill Sans', 'Gill Sans MT', 'Myriad Pro', 'DejaVu Sans Condensed', Helvetica, Arial, 'sans-serif';
	height: 100vh;  
	align-items: center;  
	display: flex;  
	justify-content: center;
    background-color: #DCDCDC;
}
input {
	width: 300px;
    height: 30px;
	font-size: 13px;
	padding: 6px 0 4px 10px;
	border: 1px solid #cecece;
    background: linear-gradient(to top, #E3E3E3, #CBCBCB); 
	border-radius: 8px;
    box-shadow: inset 2px 4px 10px 1px rgba(0,0,0,0.5);
}
button {
    margin-top: 10%;
    width: 150px;    
    line-height: 50px;     
    border: 2px solid gray;    
    border-radius: 3px;  
    text-align: center;    
    background: linear-gradient(to top, lightgray, snow);
    cursor: pointer;    
    box-shadow: 2px 4px 10px 1px rgba(0,0,0,0.5);
}    
button:hover {    
    color: dimgray;      
    background: linear-gradient(to top, snow, lightgray);    
}    
button a {    
    display: block;
    height: 50px;
    color: dimgray;
    text-decoration: none;
} 
.cart {
	padding: 20px;
	border: 2px solid darkgray;
    border-radius: 10px;
    text-align: center;
    box-shadow: 2px 4px 10px 1px rgba(0,0,0,0.5);
    background-color: #E3E3E3;
}
</style>
</head>
<body>

<div class='cart'>
    <h4>{FRAZA}</h4>
    <p>Passwort: 12345</p>
	<form method='POST' action=''>
		<input type='text' name='pass'><br><br>
		<button type='submit'>{KNOPKA}</button>
	</form>
</div>

</body>
</html>
