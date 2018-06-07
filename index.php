<?php

$grupoj = json_decode(file_get_contents("grupoj.json"), true);
$kategorioj = json_decode(file_get_contents("kategorioj.json"), true);

function akiriLigilon($ŝlosiloj) {
	global $grupoj;

	foreach ($ŝlosiloj as $valoro) {
		$grupo = $grupoj[$valoro];

		$tme = "/joinchat/";
		if (substr($grupo["ligilo"], 0, 1) == "/") {
			$tme = "";
		}

		$m = 0;
		$mteksto = "";
		if (is_numeric($grupo["membroj"])) {
			$m = $grupo["membroj"];
			$mteksto = sprintf(" <small><i>(%d membroj)</i></small>", $m);
		}
		$eligo[] = array(
		"teksto" => sprintf("<li><a class=\"emoji kasxitaLigilo\" href=\"#%s\">%s</a> - %s%s</li>",
			base64_encode($tme . $grupo["ligilo"]), $grupo["nomo"], $grupo["priskribo"], $mteksto),
		"ordo" => $m);
	}

	usort($eligo, function($a, $b) {
		return $b["ordo"] - $a["ordo"];
	});

	echo "<div><ul>";

	foreach ($eligo as $valoro) {
		echo $valoro["teksto"];
	}

	echo "</ul></div>";
}

function printiLigilojn($n, $vlisto) {
	foreach ($vlisto as $nomo => $valoro) {
		echo "<h" . $n . ">" . $nomo . "</h" . $n . ">";

		if (isset($valoro[0])) {
			akiriLigilon($valoro);
		} else {
			printiLigilojn($n + 1, $valoro);
		}
	}
}

require_once("header.php");

?>
<div class="jumbotron">
	<h1>Telegram</h1>
	<p>Telegram estas simpla senpaga mesaĝilo por komputiloj kaj poŝtelefonoj. Esperantistoj uzas ĝin por sendi tekstajn kaj voĉajn mesaĝojn, kaj por voki aliajn parolantojn. Eblas sendi per ĝi ĉian enhavon. Ekzistas multaj grupoj, per kiuj esperantistoj povas paroli pri diversaj temoj.</p>
	<p><a class="btn btn-lg btn-primary" href="elŝuti.php" role="button">Elŝuti &raquo;</a></p>
</div>
<?php

printiLigilojn(3, $kategorioj);

# Malkaŝu la ligilojn per JavaScript. La teorio estas ke aŭtomata
# roboto kiu skanas la paĝon por ligiloj malprobable povus ruli la
# skripton por malkaŝi la ligilon.
?>
<script type="text/javascript">
(function(){
	var elementoj = document.getElementsByClassName("kasxitaLigilo");
	var i;
	for (i = 0; i < elementoj.length; i++) {
		var kodo = elementoj[i].href.replace(/.*#/, '');
		elementoj[i].href = "http://t.me" + atob(kodo);
	}
})();
</script>
<?php

require_once("footer.php");

?>
