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

			$ligilo = "https://t.me";

			if (substr($grupo["ligilo"], 0, 1) !== "/") {
				$ligilo .= "/joinchat/";
			}

			$ligilo .= $grupo["ligilo"];

			break;
		}
	}
}

if ($nunaGrupo == null) {
	exit;
}

$ĉifritaLigilo = "";
$pasvorto = "esperanto";

for ($i = 0; $i < mb_strlen($ligilo); $i++) {
	$ĉifritaLigilo .= $ligilo[$i] ^ $pasvorto[$i % mb_strlen($pasvorto)];
}

$ĉifritaLigilo = base64_encode($ĉifritaLigilo);

?><!DOCTYPE html>
<html lang="eo">
<head>
	<meta charset="utf-8">
	<meta name="robots" content="noindex,nofollow">
	<title>Telegram-grupo: <?php echo htmlentities($nunaGrupo["nomo"], ENT_QUOTES); ?></title>
	<meta property="og:title" content="<?php echo htmlentities($nunaGrupo["nomo"], ENT_QUOTES); ?>">
	<meta property="og:site_name" content="Telegramo.org">
	<?php

	if (file_exists("/var/www/telegramo/grupbildoj/" . $nunaGrupo["subdomajno"][0] . ".jpg")) {
		echo "<meta property=\"og:image\" content=\"https://telegramo.org/grupbildoj/" . $nunaGrupo["subdomajno"][0] . ".jpg\">";
	}

	if (isset($nunaGrupo["gruppriskribo"])) {
		echo "<meta property=\"og:description\" content=\"" . htmlentities($nunaGrupo["gruppriskribo"], ENT_QUOTES) . "\">";
	}

	?>
	<script>
		function setPassword(value, days) {
			var d = new Date;
			d.setTime(d.getTime() + 86400000 * days);
			document.cookie = "pasvorto=" + value + ";path=/;domain=telegramo.org;expires=" + d.toGMTString();
		}

		for (provoj = 0; provoj < 5; provoj++) {
			var valoro = document.cookie.match("(^|;) ?pasvorto=([^;]*)(;|$)");
			var pasvorto = valoro ? valoro[2] : null;

			if (pasvorto === null) {
				pasvorto = prompt("Bonvolu respondi al la sekva demando por pruvi, ke vi estas homo kaj ne roboto.\n\nKiel nomiĝas nia lingvo?", "");
			}

			if (pasvorto !== null && pasvorto !== "") {
				pasvorto = pasvorto.toLowerCase();

				var teksto = atob("<?php echo $ĉifritaLigilo; ?>");
				var pasvortoDisigita = pasvorto.split("");
				var ligilo = "";

				for (var i = 0; i < teksto.length; i++) {
					ligilo = ligilo + String.fromCharCode(teksto[i].charCodeAt(0) ^ pasvortoDisigita[i % pasvortoDisigita.length].charCodeAt(0));
				}

				if (ligilo.indexOf("https://t.me/") === 0) {
					setPassword(pasvorto, 90);
					window.location.replace(ligilo);
				} else {
					setPassword("", -1);
				}
			}
		}
	</script>
</head>
<body style="text-align:center;font-size:xx-large">
	<br><br><br>
	Ĉi tiu paĝo plusendas vin al la Telegram-grupo post ĝusta respondo al la demando. Se vi ne ricevis demandon, vi verŝajne malŝaltis JavaScript.
	<br><br>
	Provu kontakti <a href="https://t.me/Robin">@Robin</a> per Telegram por helpo!
</body>
</html>
