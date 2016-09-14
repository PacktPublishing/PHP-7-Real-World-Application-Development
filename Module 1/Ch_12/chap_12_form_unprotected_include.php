<!DOCTYPE html>
<head>
	<title>PHP 7 Cookbook</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<link rel="stylesheet" type="text/css" href="php7cookbook.css">
</head>
<body>

<div class="container">

	<h1>CSRF Protected Form</h1>

	<!-- simulates infected web page -->
    <form method="post" id="crsf_test">
        <input name="name" type="hidden" value="Malicious Entry" />
        <input name="email" type="hidden" value="malicious@owasp.org" />
        <input name="visit_date" type="hidden" value="<?php echo date('Y-m-d H:i:s'); ?>" />
        <input name="message" type="hidden" value="If you see this, your form is vulnerable to CSRF attacks!" />
    </form>
	<script>document.getElementById('csrf_test').submit();</script>
	<!-- end infection simulation -->

	<!-- display contents of "visitors" table -->
	<h3>Visitors Table</h3>
	<pre>
	<?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) : ?>
	<?php     var_dump($row); ?>
	<?php endwhile; ?>
	</pre>

</div>

<?php phpinfo(INFO_VARIABLES); ?>

</body>
</html>

