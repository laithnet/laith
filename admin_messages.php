<?php
// Establish a database connection



$servername = "localhost";
$username = "root";
$password = "";
$dbname = "laith";

$connection = new mysqli($servername, $username, $password, $dbname);
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}
$query = "SELECT * FROM message";
$result = mysqli_query($connection, $query);


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>رسائل المستخدمين </title>
    <style>

/* relevant portion */
#toggle-pseudos:checked ~ .container ul{
	--separator: ",";
	--connector: "and";

	padding: 0;
	margin: 0;
	display: inline;
	list-style-type: none;
}

/* spread these list items as text nodes */
#toggle-pseudos:checked ~ .container li{
	display: inline;
}

#toggle-pseudos:not(:checked) ~ .container li{
	margin: 0.5em 0;
}

#toggle-pseudos:not(:checked) ~ .container li::after{
	content: none;
}

#highlight-pseudos:not(:checked) ~ .container li::after{
	color: inherit;
	font-weight: 500;
}

/* "Add a comma after each list item." */
li::after{
	content: var(--separator);
	color: #ef5016;
	transition: color ease 200ms;
	font-weight: 700;
}

/* "Hold on, add a comma along with an 'and' after the second last list item." */
li:nth-last-of-type(2)::after{
	content: var(--separator) " " var(--connector) " ";
	color: #0058ff;
}

/* "Hang on, only add an 'and' after the second last list item if it's the first list item as well." */
li:first-of-type:nth-last-of-type(2)::after{
	content: " " var(--connector);
	color: #178717;
}

/* "Finally, add a fullstop after the last list item." */
li:last-of-type::after{
	content: ".";
	color: #0000ff;
}

/* no margin for item containers */
ul{
	margin: 0;
	list-style-type: square;
}

li::marker{
	color: var(--accent-alpha);
}

/* layout and decoration */
:root{
	font-family: 'Cairo', sans-serif;

	--accent: #7a24f2;
	--accent-alpha: #7a24f2bb;
	--text: #000;
	--text-secondary: #000000cc;
	--container: #fff;
	--section-color: #fff;
}

::selection{
	font-family: 'Cairo', sans-serif;

	background-color: var(--accent-alpha);
	color: var(--section-color);
}

html, body{
	font-family: 'Cairo', sans-serif;

	position: relative;
	inset: 0;
	width: 100%;
	min-height: 100vh;
	padding: 0;
	margin: 0;
}

html{
	font-family: 'Cairo', sans-serif;

	color: var(--text);
	font-size: 1.28em;
	font-weight: 500;
	display: block;
	background-image: radial-gradient(circle at 50%, #fff, #eee);
	background-size: 100% 100%;
	background-attachment: fixed;
}

body{
	display: grid;
	font-family: 'Cairo', sans-serif;

	place-items: center;
	background-color: transparent;
}

/* keep the <main> thing the <main> thing */
main{
	position: relative;
	font-family: 'Cairo', sans-serif;

	inset: 0;
	max-width: 950px;
	min-width: 480px;
	margin: 3em 2em;
}

h1, h2{
	padding: 0;
	font-family: 'Cairo', sans-serif;

	margin: 0;
	margin-top: -0.3ch; /* wanna get rid of those annoying margin */
	font-weight: 700;
	color: var(--accent);
}

h2{
	font-family: 'Cairo', sans-serif;

	font-size: 1em;
}

h1::before, h2::before{
	content: "#"; /* some icing, I suppose */
	color: var(--text-secondary);
	font-size: 0.8em;
}

h2::before{
	font-size: 1em;
}

p{
	margin: 1em 0;
	line-height: 1.7;
}

/* checkboxes (disguised as toggles) */
input{
	position: relative;
	left: 0;
	top: 0;
	opacity: 0;
	margin: 0 -7px; /* a typical Windows checkbox is 14x14 in size */
}

input:checked + label{
	color: var(--accent);
}

input:checked + label::before{
	transform: translateY(30%) scaleX(1);
	transform-origin: left top;
}

input:focus-visible + label{
	outline: 2px solid var(--accent);
	outline-offset: 4px;
}

label{
	position: relative;
	margin: 0 0.6em 1em 0;
	font-weight: 600;
	font-family: 'Cairo', sans-serif;

	cursor: pointer;
	transition: color ease 0.4s;
	color: var(--text-secondary);
	display: inline-block;
}

label::before{
	font-family: 'Cairo', sans-serif;

	content: "";
	position: absolute;
	left: 0;
	bottom: 0;
	transform: translateY(30%) scaleX(0);
	width: 100%;
	height: 0.72em;
	background-color: currentColor;
	z-index: -1;
	transform-origin: right top;
	transition: transform ease 0.4s;
	opacity: 0.4;
}

label:hover{
	color: var(--text);
}

/* showcase the concept */
.container{
	font-family: 'Cairo', sans-serif;

	position: relative;
	width: 90%;
	background-color: var(--container);
	border-radius: 4px;
	box-shadow: 0.8em 0.8em 0 0 var(--accent-alpha);
	border: 2px solid var(--accent);
	margin-top: 1.5em;
	padding: 0 2em;
	box-sizing: border-box;
}

.container section{
	margin: 1.8em 0;
}

.container div{
	margin-top: 0.5em;
	font-size: 0.9em;
	line-height: 1.6;
}

/* 13 */
a {
	font-family: 'Cairo', sans-serif;
	
	background-color: #000;
	
	background-image: linear-gradient(315deg, #89d8d3 0%, #03c8a8 74%);
	border: none;
	z-index: 1;
}
a:after {
	font-family: 'Cairo', sans-serif;
	position: absolute;
	content: "";
	width: 30%;
	height: 0;
	bottom: 0;
	left: 0;
	z-index: -1;
  border-radius: 5px;
  background-color: #4dccc6;
  background-image: linear-gradient(315deg, #4dccc6 0%, #96e4df 74%);
  box-shadow:
   -7px -7px 20px 0px #ef5016,
   -4px -4px 5px 0px #ef5016,
   7px 7px 20px 0px #ef5016,
   4px 4px 5px 0px #ef5016;
   transition: all 10s ease;
}
a:hover {
	color: #fff;
	font-family: 'Cairo', sans-serif;
}
a:hover:after {
	top: 0;
	font-family: 'Cairo', sans-serif;
	height: 100%;
}
a:active {
	top: 2px;
	font-family: 'Cairo', sans-serif;
}


/* Made with Coffee, Care, and Curiosity by @ShadowShahriar */
    </style>
</head>
<body>

</body>
</html>
<div class="container">
    <?php
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<section>";
            echo "<h2>" . $row['name'] . "</h2>";
            echo "<div>" . $row['message'] . "</div>";
            echo "</section>";
            echo "<hr>";
            
        }
    }else {
        echo "لا توجد رسائل.";
    }
    echo "<a href=\"delete_all_messages.php\">";
    echo "حذف جميع الرسائل ";
    echo "</a>";

    ?>
   
</div>

<?php 
// إغلاق اتصال قاعدة البيانات
mysqli_close($connection);


?>