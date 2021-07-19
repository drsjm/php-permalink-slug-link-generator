<?php

if ( isset($_POST['name']) ) {

	// NEVER TRUST USER INPUT -> SIMPLE SANITIZE FUNCTION //
	function sanitizeString($string) {
		$data = trim($string);
		$data = htmlspecialchars(strip_tags($data));
		return $data;
	}
	// NEVER TRUST USER INPUT -> SIMPLE SANITIZE FUNCTION //


	// SANITIZE $_POST INPUT --> USING ABOVE FUNCTION --> START //
	$name = sanitizeString($_POST['name']);
	// SANITIZE $_POST INPUT --> USING ABOVE FUNCTION --> END //


	// CLEAN SPECIAL CHARS FROM STRINGS --> START
	$clean_special_chars = array(
		'/[áàâãªä]/u'    =>   'a',
		'/[ÁÀÂÃÄ]/u'     =>   'A',
		'/[ÍÌÎÏ]/u'      =>   'I',
		'/[íìîï]/u'      =>   'i',
		'/[éèêë]/u'      =>   'e',
		'/[ÉÈÊË]/u'      =>   'E',
		'/[óòôõºö]/u'    =>   'o',
		'/[ÓÒÔÕÖ]/u'     =>   'O',
		'/[úùûü]/u'      =>   'u',
		'/[ÚÙÛÜ]/u'      =>   'U',
		'/ç/'            =>   'c',
		'/Ç/'            =>   'C',
		'/ñ/'            =>   'n',
		'/Ñ/'            =>   'N',
		'/–/'            =>   '-', // UTF-8 hyphen to "normal" hyphen
		'/[’‘‹›‚]/u'     =>   ' ', // Literally a single quote
		'/[“”«»„]/u'     =>   ' ', // Double quote
		'/ /'            =>   ' ', // nonbreaking space (equiv. to 0x160)
	);
	// CLEAN SPECIAL CHARS FROM STRINGS --> END


	// SET PERMALINK --> START
	$record_permalink = $name;
	$record_permalink = strtolower(preg_replace(array_keys($clean_special_chars), array_values($clean_special_chars), $record_permalink));
	$record_permalink = preg_replace('/[^A-Za-z0-9\-]/', '-', $record_permalink);
	$record_permalink = preg_replace("/[\-]+/", '-', $record_permalink);
	// SET PERMALINK --> END


	// CHECK IF PERMALINK ALREADY EXISTS IN DATABASE --> START
	// QUERY YOUR DATABASE --> START

	// ***** $record_permalink ***** //

	// QUERY YOUR DATABASE --> END
	// CHECK IF PERMALINK ALREADY EXISTS IN DATABASE --> END

}

?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PHP Permalink Generator | By DRSJM</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>

	<div class="container mt-5">
		<h1>PHP Permalink Generator</h1>
		<form action="example.php" method="post">
			<!-- Enter the title or name of your product, service, post, etc -->
			<div class="mb-3">
				<label class="form-label">Name / Title</label>
				<input name="name" type="text" class="form-control" placeholder="Enter the title of your post, product or service..." required>
			</div>
			<!-- Enter the title or name of your product, service, post, etc -->

			<!-- Automatic Generated Permalink -->
			<div class="mb-3">
				<?php if ( isset($_POST['name']) && !empty($_POST['name']) ): ?>
					<label class="form-label">Original Name/ Title</label>
					<input type="text" class="form-control" value="<?php echo $_POST['name']; ?>" placeholder="Original Name / Title" readonly>
				<?php endif; ?>
				<label class="form-label">Permalink</label>
				<input type="text" class="form-control" value="<?php echo $record_permalink ?? 'Generated Permalink'; ?>" readonly>
			</div>
			<!-- Automatic Generated Permalink -->

			<!-- Confirm To Generate Permalink -->
			<div class="col-auto">
				<button type="submit" class="btn btn-primary mb-3">Generate</button>
			</div>
			<!-- Confirm To Generate Permalink -->
		</form>

		<p>
			<strong>If you want to thank me you can buying me a coffee at:</strong>
			<br>
			<a href="https://www.buymeacoffee.com/drsjm" target="_blank">
				<img src="https://www.buymeacoffee.com/assets/img/custom_images/orange_img.png" alt="Buy Me A Coffee" style="height: 41px !important;width: 174px !important;box-shadow: 0px 3px 2px 0px rgba(190, 190, 190, 0.5) !important;-webkit-box-shadow: 0px 3px 2px 0px rgba(190, 190, 190, 0.5) !important;" >
			</a>
		</p>

	</div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
