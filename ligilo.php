<?php

header("X-Robots-Tag: noindex");
require_once("sekretoj.php");

if (!isset($_POST["code"])) {
	exit;
}

$context = stream_context_create(array("http" =>
	array(
		"method" => "POST",
		"header" => "Content-type: application/x-www-form-urlencoded",
		"content" => http_build_query(
			array(
				"secret" => $reCAPTCHASekreto,
				"response" => $_POST["code"],
				"remoteip" => $_SERVER["HTTP_CF_CONNECTING_IP"]
			)
		)
	)
));

$response = file_get_contents("https://www.google.com/recaptcha/api/siteverify", false, $context);
$result = json_decode($response, true);

if (!$result["success"]) {
	exit;
}

$subdomajno = idn_to_utf8(substr($_SERVER["HTTP_HOST"], 0, -14));
$grupoj = json_decode(file_get_contents("/var/www/telegramo/grupoj.json"), true);

foreach ($grupoj as $grupo) {
	foreach ($grupo["subdomajno"] as $value) {
		$hsistemo = str_replace(array("ĉ", "ĝ", "ĥ", "ĵ", "ŝ", "ŭ"), array("ch", "gh", "hh", "jh", "sh", "u"), $value);
		$xsistemo = str_replace(array("ĉ", "ĝ", "ĥ", "ĵ", "ŝ", "ŭ"), array("cx", "gx", "hx", "jx", "sx", "ux"), $value);

		if ($subdomajno === $value || $subdomajno === $hsistemo || $subdomajno === $xsistemo) {
			$ligilo = "https://t.me";

			if (substr($grupo["ligilo"], 0, 1) !== "/") {
				$ligilo .= "/joinchat/";
			}

			$ligilo .= $grupo["ligilo"];

			echo base64_encode($ligilo);
			exit;
		}
	}
}
