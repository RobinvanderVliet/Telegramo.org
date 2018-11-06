<!DOCTYPE html>
<html lang="eo">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Telegramo.org</title>

        <!-- Bootstrap -->
        <link href="css/bootstrap.min.css" rel="stylesheet">

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

        <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />

        <style>
        :root {
          --esperanta-verdo: #009900;
          --esperanta-verdo-malheligxe: #007300;
          --esperanta-verdo-plimalheligxe: #006600;
        }
        body {
            padding-top: 75px;
            padding-bottom: 75px;
        }
        a {
          color: var(--esperanta-verdo);
        }
        a:hover {
          color: var(--esperanta-verdo-malheligxe);
        }
        .bg-primary {
          background-color: var(--esperanta-verdo)!important;
        }
        .btn-primary {
          background-color: var(--esperanta-verdo);
          border-color: var(--esperanta-verdo);
        }
        .btn-primary:hover {
          background-color: var(--esperanta-verdo-malheligxe);
          border-color: var(--esperanta-verdo-malheligxe);
        }
        .btn-primary:not(:disabled):not(.disabled):active {
          background-color: var(--esperanta-verdo-plimalheligxe);
          border-color: var(--esperanta-verdo-plimalheligxe);
        }
        .emoji {
            width: 16px;
            height: 16px;
        }
        </style>
    </head>
    <body>
        <!-- Fixed navbar -->
        <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-primary">
          <a class="navbar-brand" href="/">Telegramo.org</a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="nav navbar-nav mr-auto"> <!-- class="active" -->
              <li class="nav-item"><a class="nav-link" href="index.php">Grupoj</a></li>
              <li class="nav-item"><a class="nav-link" href="kanaloj.php">Kanaloj</a></li>
              <li class="nav-item"><a class="nav-link" href="glumarkaroj.php">Glumarkaroj</a></li>
              <li class="nav-item"><a class="nav-link" href="robotoj.php">Robotoj</a></li>
              <li class="nav-item"><a class="nav-link" href="elŝuti.php">Elŝuti</a></li>
              <!--<li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Manlibroj <span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li class="dropdown-header">Telegram</li>
                  <li><a href="#">Krei konton</a></li>
                  <li><a href="#">Aldoni profilbildon</a></li>
                  <li><a href="#">Ŝanĝi uzantnomon</a></li>
                  <li role="separator" class="divider"></li>
                  <li class="dropdown-header">Esperanto</li>
                  <li><a href="#">Aliĝi al grupoj</a></li>
                  <li><a href="#">Aldoni glumarkarojn</a></li>
                  <li><a href="#">Krei novan grupon</a></li>
                  <li><a href="#">Uzi Esperantan tradukon</a></li>
                </ul>
              </li> -->
            </ul>
            <ul class="nav navbar-nav">
              <li class="nav-item"><a class="nav-link" href="https://github.com/RobinvanderVliet/Telegramo.org">GitHub</a></li>
              <li class="nav-item"><a class="nav-link" href="https://twitter.com/telegram_eo">Twitter</a></li>
            </ul>
          </div>
        </nav>

        <div class="container-fluid" id="container">
          <div class="row">
            <div class="col-lg-9 mx-auto">
