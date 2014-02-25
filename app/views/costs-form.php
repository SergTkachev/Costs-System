<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Laravel PHP Framework</title>
    <link rel="stylesheet" href="css/style.css"/>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script src="js/script.js"></script>
</head>
<body>
<section class="container">
    <h1 class="title">Cost system</h1>
    <form action="costs" method="post" class="form">
        <ul>
            <li>
                <label for="cost-type">Type:</label>
                <input placeholder="Type…" type="text" name="type" id="cost-type"/>
            </li>
            <li>
                <label for="cost-value">Value:</label>
                <input placeholder="Value…" type="text" name="value" id="cost-value"/>
            </li>
            <li>
                <label for="cost-description">Description:</label>
                <textarea placeholder="Description…" name="description" id="cost-description"></textarea>
            </li>
        </ul>
        <input type="submit" value="Send Message" id="submit"/>
    </form>
</section>
</body>
</html>
