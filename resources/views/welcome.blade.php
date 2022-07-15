<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <title>NK Ključ | Početna</title>
</head>
<body>
<nav class="d-none d-lg-block ss-desk-nav">
    <img src="{{ asset('images/logo/grb.png') }}" alt="NK Kljuc grb" id="logo" class="d-flex">
    <ul class="ss-desk-nav-items">
        <li>
            <a href="">Početna</a>
        </li>
        <li>
            <a href="">Vijesti</a>
        </li>
        <li>
            <a href="">Ekipa</a>
        </li>
        <li>
            <a href="">Klub</a>
        </li>
        <li>
            <a href="">Škola</a>
        </li>
        <li>
            <a href="">Članstvo</a>
        </li>
        <li>
            <a href="">Prodavnica</a>
        </li>
        <li>
            <a href="">Kontakt</a>
        </li>
    </ul>
</nav>

<nav class="d-flex align-items-center justify-content-between d-lg-none ss-mob-nav">
    <img src="{{ asset('images/logo/grb.png') }}" alt="NK Kljuc grb" id="logo" class="d-flex">
    <ul class="ss-mob-nav-items">
        <li>
            <a href="">Početna</a>
        </li>
        <li>
            <a href="">Vijesti</a>
        </li>
        <li>
            <a href="">Ekipa</a>
        </li>
        <li>
            <a href="">Klub</a>
        </li>
        <li>
            <a href="">Škola</a>
        </li>
        <li>
            <a href="">Članstvo</a>
        </li>
        <li>
            <a href="">Prodavnica</a>
        </li>
        <li>
            <a href="">Kontakt</a>
        </li>
    </ul>
    <div id="ss-hamburger">
        <span></span>
        <span></span>
        <span></span>
    </div>
</nav>

<main>
    <section class="ss-hero">
        <img src="{{ asset('images/default/hero.jpg') }}" alt="Slika">
        <div class="ss-hero-info">
            <div class="ss-info-date d-flex justify-content-between align-items-center">
                <h4>7.6.2022 | Sport</h4>
                <h4>Kom. 0</h4>
            </div>
            <div class="ss-info-divider my-2"></div>
            <h3>Neki moj subtitle</h3>
            <h1 class="my-3">Glavni naslov na početnoj stranici</h1>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus atque debitis esse fuga hic, impedit,
                ipsam libero mollitia nemo nostrum possimus quas reiciendis, vero voluptates.</p>
            <br class="d-none d-md-block">
            <a href="#" class="ss-btn ss-btn--outline ss-btn--outline-light mt-3 ">Opširnije</a>
        </div>
        <div class="ss-hero-overlay"></div>
    </section>
</main>

<script>
    const navigation = document.querySelector('.ss-desk-nav');
    navigation.addEventListener('mouseover', function() {
        navigation.classList.add('ss-nav-expanded');
    })

    navigation.addEventListener('mouseleave', function() {
        navigation.classList.remove('ss-nav-expanded');
    })
</script>
</body>
</html>
