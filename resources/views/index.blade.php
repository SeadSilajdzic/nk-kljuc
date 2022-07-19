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

<nav class="d-lg-none ss-mob-nav">
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
        <img src="{{ asset($latest_post->image) }}" alt="Slika: {{ $latest_post->title }}">
        <div class="ss-hero-info">
            <div class="ss-info-date d-flex justify-content-between align-items-center">
                <h4>{{ $latest_post->created_at->format('d.m.Y') }} | {{ $latest_post->category->name }}</h4>
                <h4>Kom. 0</h4>
            </div>
            <div class="ss-info-divider my-2"></div>
            <h3>{{ $latest_post->subtitle }}</h3>
            <h1 class="my-3">{{ $latest_post->title }}</h1>
            <p>{{ $latest_post->short_description }}</p>
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
    });

    navigation.addEventListener('mouseleave', function() {
        navigation.classList.remove('ss-nav-expanded');
    });

    const hamburger = document.querySelector('#ss-hamburger');
    const mobileNavigation = document.querySelector('.ss-mob-nav');
    hamburger.addEventListener('click', function() {
        hamburger.classList.toggle('active');
        mobileNavigation.classList.toggle('active');
    });
</script>
</body>
</html>
