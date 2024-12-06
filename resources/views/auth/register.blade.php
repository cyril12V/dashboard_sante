@extends('layouts.auth')

@section('content')
<div class="container">

    <!-- Contenu de la page d'inscription centré -->
    <div class="row justify-content-center align-items-center min-vh-100">
        <div class="col-lg-10 col-md-12">
            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Carrousel à gauche et formulaire d'inscription à droite -->
                    <div class="row">
                        <div class="col-lg-6 d-none d-lg-block p-0">
                            <!-- Carrousel des fonctionnalités -->
                            <div id="featuresCarousel" class="carousel slide" data-ride="carousel">
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <div class="carousel-overlay">
                                            <img class="d-block w-100 fixed-size-image" src="{{ asset('img/carrousel_img3.jpeg') }}" alt="Gestion de la fréquence cardiaque">
                                            <div class="carousel-caption d-none d-md-block">
                                                <h5>Gestion de la Fréquence Cardiaque</h5>
                                                <p>Suivez votre fréquence cardiaque moyenne pour une meilleure santé.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="carousel-item">
                                        <div class="carousel-overlay">
                                            <img class="d-block w-100 fixed-size-image" src="{{ asset('img/carrousel_img1.jpeg') }}" alt="Objectif de Pas Quotidien">
                                            <div class="carousel-caption d-none d-md-block">
                                                <h5>Objectif de Pas Quotidien</h5>
                                                <p>Définissez et atteignez vos objectifs de marche chaque jour.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="carousel-item">
                                        <div class="carousel-overlay">
                                            <img class="d-block w-100 fixed-size-image" src="{{ asset('img/carrousel_img2.png') }}" alt="Suivi de la qualité du sommeil">
                                            <div class="carousel-caption d-none d-md-block">
                                                <h5>Suivi de la Qualité du Sommeil</h5>
                                                <p>Améliorez votre qualité de sommeil en suivant vos habitudes.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Formulaire d'inscription -->
                        <div class="col-lg-6">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Créer un Compte !</h1>
                                </div>
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        @foreach ($errors->all() as $error)
                                            <p>{{ $error }}</p>
                                        @endforeach
                                    </div>
                                @endif
                                <form class="user" method="POST" action="{{ route('register') }}">
                                    @csrf
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-user" name="name" placeholder="Nom Complet" value="{{ old('name') }}" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="email" class="form-control form-control-user" name="email" placeholder="Adresse Email" value="{{ old('email') }}" required>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                            <input type="password" class="form-control form-control-user" name="password" placeholder="Mot de Passe" required>
                                        </div>
                                        <div class="col-sm-6">
                                            <input type="password" class="form-control form-control-user" name="password_confirmation" placeholder="Confirmez le Mot de Passe" required>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-user btn-block">
                                        Créer le Compte
                                    </button>
                                </form>
                                <hr>
                                <div class="text-center">
                                    <a class="small" href="{{ route('login') }}">Vous avez déjà un compte ? Connectez-vous !</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Ajout de CSS personnalisé -->
<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap');
    .fixed-size-image {
        width: 100%;
        height: 500px;
        object-fit: cover;
    }
    .carousel-overlay {
        position: relative;
    }
    .carousel-overlay::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.5);
        z-index: 1;
    }
    .carousel-caption {
        position: absolute;
        z-index: 2;
        font-family: 'Poppins', sans-serif;
    }
    .carousel-caption h5,
    .carousel-caption p {
        color: white;
        font-weight: 600;
    }
    .carousel-caption h5 {
        font-size: 19px;
        white-space: nowrap;
        text-overflow: ellipsis;
    }
    .carousel-caption p {
        white-space: normal;
    }
</style>
@endsection
