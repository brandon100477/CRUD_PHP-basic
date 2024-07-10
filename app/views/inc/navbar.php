<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="./app/static/css/navbar.css">
        <script src="./app/static/js/navbar.js"></script>
    </head>
    <body>
        <nav class="navbar" role="navigation" aria-label="main navigation">
            <div class="navbar-brand">
                <a class="navbar-item" href="<?php echo APP_URL; ?>dashboard">
                <img class="img" src="./app/static/img/logo-prueba.jpeg" alt="">
                <span class="img-text"><strong>Brandon</strong></span>
                </a>

                <a role="button" class="navbar-burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
                </a>
            </div>
            <div id="navbarBasicExample" class="navbar-menu">
                <div class="navbar-start">
                    <a class="navbar-item" href="<?php echo APP_URL; ?>dashboard" ><strong>Home</strong></a>
                    <a class="navbar-item"><strong>Ability</strong></a>
                    <div class="navbar-item has-dropdown is-hoverable">
                        <a class="navbar-link"><strong>More</strong></a>
                        <div class="navbar-dropdown">
                            <a class="navbar-item item-text"><strong>Description</strong></a>
                            <a class="navbar-item item-text"><strong>Certification</strong></a>
                            <a class="navbar-item item-text"><strong>Why me</strong></a>
                            <hr class="navbar-divider">
                            <a class="navbar-item item-text"><strong>Contact me</strong></a>
                        </div>
                    </div>
                </div>
                <div class="navbar-end">
                    <div class="navbar-item">
                        <div class="buttons">
                            <a class="button is-info is-dark"><strong>Sign off</strong></a>

                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </body>
</html>