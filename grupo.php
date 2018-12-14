<?php

header("X-Robots-Tag: noindex");

$subdomajno = idn_to_utf8(substr($_SERVER["HTTP_HOST"], 0, -14));
$grupoj = json_decode(file_get_contents("/var/www/telegramo/grupoj.json"), true);
$nunaGrupo = null;

foreach ($grupoj as $grupo) {
	foreach ($grupo["subdomajno"] as $value) {
		$hsistemo = str_replace(array("ĉ", "ĝ", "ĥ", "ĵ", "ŝ", "ŭ"), array("ch", "gh", "hh", "jh", "sh", "u"), $value);
		$xsistemo = str_replace(array("ĉ", "ĝ", "ĥ", "ĵ", "ŝ", "ŭ"), array("cx", "gx", "hx", "jx", "sx", "ux"), $value);

		if ($subdomajno === $value || $subdomajno === $hsistemo || $subdomajno === $xsistemo) {
			if ($grupo["subdomajno"][0] !== $subdomajno) {
				header("Location: https://" . $grupo["subdomajno"][0] . ".telegramo.org/");
			}

			$nunaGrupo = $grupo;
			break;
		}
	}
}

if ($nunaGrupo == null) {
	exit;
}

?><!DOCTYPE html>
<html lang="eo">
	<head>
		<meta charset="utf-8">
		<meta name="robots" content="noindex,nofollow">
		<title>Telegram-grupo: <?php echo $nunaGrupo["nomo"]; ?></title>
		<meta property="og:title" content="<?php echo $nunaGrupo["nomo"]; ?>">
		<meta property="og:site_name" content="Telegramo.org">
		<?php

		if (file_exists("/var/www/telegramo/grupbildoj/" . $nunaGrupo["subdomajno"][0] . ".jpg")) {
			echo "<meta property=\"og:image\" content=\"https://telegramo.org/grupbildoj/" . $nunaGrupo["subdomajno"][0] . ".jpg\">";
		}

		if (isset($nunaGrupo["gruppriskribo"])) {
			echo "<meta property=\"og:description\" content=\"" . $nunaGrupo["gruppriskribo"] . "\">";
		}

		?>
		<script>
		function onloadCallback(){
			grecaptcha.execute();
		}
		function onSubmit(code) {
			var xhttp = new XMLHttpRequest();
			xhttp.onreadystatechange = function() {
				if (this.readyState === 4 && this.status === 200 && this.responseText !== "") {
					window.location.replace(atob(this.responseText));
				}
			};
			xhttp.open("POST", "ligilo.php", true);
			xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			xhttp.send("code=" + code);
		}
		</script>
		<script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback" async defer></script>
	</head>
	<body style="text-align:center;font-size:xx-large">
		<br><br><br>
		Ĉi tiu paĝo tuj plusendas vin al la Telegram-grupo. Se tio ne okazas, vi verŝajne malŝaltis JavaScript.
		<div class="g-recaptcha"
			data-sitekey="6LcFs2EUAAAAAHeH7Vuve8r48GZOE63NV75LmoKo"
			data-callback="onSubmit"
			data-size="invisible">
		</div>
	</body>
</html>
