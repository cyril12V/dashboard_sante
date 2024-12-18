<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>The Guardian - Bienvenue</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700&display=swap" rel="stylesheet">
  <style>
    * {
      margin: 0px;
      padding: 0px;
      box-sizing: border-box;
      font-family: 'Poppins', sans-serif;
    }

    a.product-link {
      background: #000;
      padding: 12px 18px;
      color: #fff !important;
      border-radius: 5px;
      text-decoration: none;
      font-size: 14px;
      width: fit-content;
    }
    a.product-link span {
      color: #938d8f;
    }

    main {
      width: 100%;
      display: flex;
      flex-direction: column;
    }
    main .section-1 {
      width: 100%;
      background-repeat: no-repeat;
      background-size: cover;
      background-position: center;
      display: flex;
      justify-content: center;
    }
    main .section-1 .section-1-main {
      width: 80%;
      padding: 50px 0px 0px 0px;
    }
    main .section-1 .section-1-main nav {
      width: 100%;
      display: flex;
      align-items: center;
      justify-content: space-between;
    }
    main .section-1 .section-1-main nav .nav-logo img, main .section-1 .section-1-main nav .nav-links ul li a img {
      display: block;
    }
    main .section-1 .section-1-main nav .nav-links ul {
      display: flex;
      column-gap: 25px;
      list-style-type: none;
      align-items: center;
    }
    main .section-1 .section-1-main nav .nav-links ul li a {
      text-decoration: none;
      color: #000;
      font-weight: 400;
    }
    main .section-1 .section-1-main nav .nav-mobile-menu-btn {
      cursor: pointer;
      display: none;
    }
    main .section-1 .section-1-main nav .nav-mobile-menu-btn img {
      display: block;
    }
    main .section-1 .section-1-main .section-content {
      margin-top: 80px;
      width: 100%;
      display: flex;
      flex-direction: column;
      row-gap: 15px;
      align-items: center;
    }
    main .section-1 .section-1-main .section-content .section-1-title {
      font-size: 40px;
      line-height: 42px;
      text-align: center;
    }
    main .section-1 .section-1-main .section-content .section-1-desc, main .section-1 .section-1-main .section-content .section-1-alt-txt {
      color: #5a5444;
      line-height: 24px;
      font-weight: 500;
      text-align: center;
    }
    main .section-1 .section-1-main .section-content .section-1-img {
      margin-top: 50px;
  width: 100%;
  border-radius: 25px 25px 0 0; /* Arrondir seulement le haut */
    }

    main .section-2 {
      width: 100%;
      display: flex;
      justify-content: center;
    }
    main .section-2 .section-2-main {
      width: 80%;
      padding: 50px 0px;
      display: flex;
      align-items: center;
      column-gap: 50px;
    }
    main .section-2 .section-2-main .section-2-1 {
      width: 60%;
      display: flex;
      flex-direction: column;
      row-gap: 20px;
    }
    main .section-2 .section-2-main .section-2-2 {
      width: 40%;
    }
    main .section-2 .section-2-main .section-2-2 img {
      width: 100%;
    }

    nav.mobile-menu {
      width: fit-content;
      position: fixed;
      height: 100vh;
      background: white;
      padding: 25px;
      display: none;
    }
    nav.mobile-menu.active {
      display: block;
    }
    nav.mobile-menu ul {
      list-style-type: none;
      display: flex;
      flex-direction: column;
      row-gap: 25px;
      margin-top: 25px;
    }
    nav.mobile-menu ul li a {
      text-decoration: none;
      color: #000;    
      font-weight: 400;
    }

    footer {
      width: 100%;
      display: flex;
      justify-content: center;
    }
    footer .footer-main {
      width: 80%;
      padding: 50px 0px;
      display: flex;
      flex-direction: column;
      row-gap: 25px;
    }
    footer .footer-main .footer-content, footer .footer-main .footer-text {
      width: 100%;
      display: flex;
      justify-content: space-between;
    }
    footer .footer-main .footer-content .footer-links ul {
      display: flex;
      column-gap: 20px;
      list-style-type: none;
    }
    footer .footer-main .footer-content .footer-links ul li a, footer .footer-main .footer-text p, footer .footer-main .footer-text p a {
      text-decoration: none;
      color: #938d8f;
      font-weight: 400;
    }
    footer .footer-main .footer-text {
      justify-content: center;
    }
    footer .footer-main .footer-text p a:hover {
      text-decoration: underline;
    }

    @media only screen and (max-width: 1024px) {
      main .section-1 .section-1-main, main .section-2 .section-2-main {
        width: 90%;
      }
      main .section-2 .section-2-main {
        flex-direction: column-reverse;
        padding: 50px 0px 25px 0px;
        row-gap: 40px;
        align-items: center;
      }
      main .section-2 .section-2-main .section-2-1 {
        width: 100%;
      }
      main .section-2 .section-2-main .section-2-2 {
        width: 65%;
      }

      footer .footer-main {
        width: 90%;
        padding: 25px 0px;
      }
    }

    @media only screen and (max-width: 600px) {
      main .section-1 .section-1-main nav .nav-mobile-menu-btn {
        display: block;
      }
      main .section-1 .section-1-main nav .nav-links {
        display: none;
      }
      main .section-2 .section-2-main .section-2-1 {
        row-gap: 10px;
      }
      main .section-2 .section-2-main .section-2-1 .section-2-1-link {
        margin-top: 10px;
      }
      main .section-2 .section-2-main .section-2-2 {
        width: 90%;
      }

      main .section-1 .section-1-main {
        padding-top: 30px;
      }

      footer .footer-main .footer-content {
        flex-direction: column;
        row-gap: 10px;
      }
    }
  </style>
</head>
<body>
  <nav class="mobile-menu">
    <ul>
      <li><a href="{{ route('login') }}">Se connecter</a></li>
      <li><a href="{{ route('login') }}" class="product-link">Commencer &#8211; <span>C'est gratuit</span></a></li>
    </ul>
  </nav>

  <main>
    <section class="section-1" style="background-image: url('{{ asset('img/background.png') }}');">
      <div class="section-1-main">
        <nav>
          <div class="nav-logo">
            <a href="{{ url('/') }}"><img src="{{ asset('img/logo.png') }}" alt=""></a>
          </div>
          <div class="nav-links">
            <ul>
              <li></li>
              @if (Route::has('login'))
                @auth
                  <li><a href="{{ url('/dashboard') }}">Votre tableau de bord</a></li>
                @else
                  <li><a href="{{ route('login') }}">Se connecter</a></li>
                  @if (Route::has('register'))
                    <li><a href="{{ route('register') }}" class="product-link">S'inscrire &#8211; <span>C'est gratuit</span></a></li>
                  @endif
                @endauth
              @endif
            </ul>
          </div>
          <div class="nav-mobile-menu-btn">
            <img src="https://rvs-product-landing-page.vercel.app/Assets/Hamburger-Menu.svg" alt="" id="mobile-menu-btn">
          </div>
        </nav>
        <div class="section-content">
          <h1 class="section-1-title">Des outils de gestion de santé exceptionnels</h1>
          <p class="section-1-desc">Avec The Guardian, suivez vos données de santé et vos activités en un rien de temps directement depuis votre navigateur.</p>
          <a href="{{ route('login') }}" class="section-1-link product-link">Commencer &#8211; <span>C'est gratuit</span></a>
          <p class="section-1-alt-txt">Aucune carte de crédit requise.</p>
          <img  src="{{ asset('img/fond_lpage.png') }}" alt="" class="section-1-img">
        </div>
      </div>
    </section>
    <section class="section-2">
      <div class="section-2-main">
        <div class="section-2-1">
          <h1 class="section-2-1-title">Un tableau de bord entièrement personnalisable</h1>
          <p class="section-2-1-desc">Personnalisez intégralement votre tableau de bord santé ou utilisez nos thèmes prédéfinis. Suivez vos progrès de manière simple et efficace.</p>
          <a href="{{ route('login') }}" class="section-2-1-link product-link">Commencer &#8211; C'est gratuit</a>
        </div>
        <div class="section-2-2">
          <img src="{{ asset('img/img_lp.png') }}" alt="" class="section-2-2-img">
        </div>
      </div>
    </section>
  </main>

  <footer>
    <div class="footer-main">
      <div class="footer-content">
       
        <div class="footer-links">
        </div>
      </div>
      <div class="footer-text">
        <p>Conçu par - <a><span>EPITECH DIGITAL</span></a></p>
      </div>
    </div>
  </footer>
  
  <script>
    const navEl = document.getElementById("mobile-menu-btn");
    const nav = document.getElementsByTagName("nav");

    navEl.addEventListener("click", () => {
      nav[0].classList.toggle("active");
    });
  </script>
</body>
</html>
