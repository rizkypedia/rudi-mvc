<!doctype html>
<html lang="en">
<head>
    <link rel="stylesheet" href="<?=$this->asset('/css/bootstrap/bootstrap.min.css')?>" />
    <link rel="stylesheet" href="<?=$this->asset('/css/jumbotron.css')?>" />
    <title><?=$this->e($title)?></title>
</head>
<body>
<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="/index.php/home">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/index.php/welcome">Link</a>
            </li>
            <li class="nav-item">
                <a class="nav-link disabled" href="#">Disabled</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="http://example.com" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Dropdown</a>
                <div class="dropdown-menu" aria-labelledby="dropdown01">
                    <a class="dropdown-item" href="/index.php/home">Home</a>
                    <a class="dropdown-item" href="/index.php/welcome">Welcome</a>
                    <a class="dropdown-item" href="/index.php/links">URL Checker</a>
                    <a class="dropdown-item" href="https://www.platesphp.com" target="_blank">PlatesPhp</a>
                    <a class="dropdown-item" href="https://www.doctrine-project.org/" target="_blank">Doctrine ORM</a>

                </div>
            </li>
        </ul>
        <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
    </div>
</nav>
<main role="main">

    <!-- CONTENT -->
    <div class="jumbotron">
        <?=$this->section('content')?>
    </div>

    <div class="container">
        <div class="container">

        </div>
    </div>

</main><!-- /.container -->



<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="<?=$this->asset('/js/bootstrap/jquery-3.4.1.min.js')?>"></script>
<script src="<?=$this->asset('/js/bootstrap/popper.min.js') ?>"></script>
<script src="<?=$this->asset('/js/bootstrap/bootstrap.min.js')?>"></script>
</body>
</html>



