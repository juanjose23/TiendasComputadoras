
@extends('layout.app')
@section('title', 'Inicio')
@section('content')
<style>
    .oleez-landing-section .oleez-landing-section-content .oleez-landing-section-verticalss {
        position: absolute;
        left: 0;
        top: 0;
        height: 100%;
        padding-top: 11px;
    }

    .oleez-landing-section .oleez-landing-section-content .oleez-landing-section-verticalss .number {
        font-size: 20px;
        color: black;
        line-height: 1;
        display: inline-block;
        margin-right: 13px;
    }

    .oleez-landing-section .oleez-landing-section-content .oleez-landing-section-verticalss img {
        position: relative;
        top: -3px;
    }

    @media (max-width: 767px) {
        .oleez-landing-section .oleez-landing-section-content .oleez-landing-section-verticalss img {
            display: none;
        }
    }

    .oleez-landing-section .oleez-landing-section-content .section-title {
        font-size: 30px;
        line-height: 1.33;
        font-weight: 500;
    }

    .oleez-landing-section .oleez-landing-section-content .oleez-landing-section-verticalss::after {
        content: "";
        display: inline-block;
        width: 1px;
        position: absolute;
        top: 50px;
        left: 11px;
        bottom: 0;
        background-color: white;
    }
</style>
<section>
    <div class="container wow fadeIn">
        <div id="oleezLandingCarousel" class="oleez-landing-carousel carousel slide" data-ride="carousel">
            <div class="carousel-inner" role="listbox">
                <div class="carousel-item active">
                    <img src="assets/images/Carrusel/empty-clothing-department-store-shopping-mall-new-fashion-collection-shelf-fashionable-clothes-hangers-accessories-modern-boutique-with-merchandise-sale-customers.jpg"
                        alt="First slide" class="w-100">
                    <div class="carousel-caption">
                        <h2 data-animation="animated fadeInRight"><span>Tu moda</span></h2>
                        <h2 data-animation="animated fadeInRight"><span>Tu identidad</span></h2>
                        <a href="/shop.html" class="carousel-item-link"
                            data-animation="animated fadeInRight">Explora nuestras tendencias</a>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="assets/images/Carrusel/empty-clothing-department-store-shopping-mall-new-fashion-collection-shelf-fashionable-clothes-hangers-accessories-modern-boutique-with-merchandise-sale-customers.jpg"
                        alt="Second slide" class="w-100">
                    <div class="carousel-caption">
                        <h2 data-animation="animated fadeInRight"><span>Tu moda</span></h2>
                        <h2 data-animation="animated fadeInRight"><span>Tu identidad</span></h2>
                        <a href="/shop.html" class="carousel-item-link"
                            data-animation="animated fadeInRight">Explora nuestras tendencias</a>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="assets/images/Carrusel/empty-clothing-department-store-shopping-mall-new-fashion-collection-shelf-fashionable-clothes-hangers-accessories-modern-boutique-with-merchandise-sale-customers.jpg"
                        alt="Third slide" class="w-100">
                    <div class="carousel-caption">
                        <h2 data-animation="animated fadeInRight"><span>Tu moda</span></h2>
                        <h2 data-animation="animated fadeInRight"><span>Tu identidad</span></h2>
                        <a href="/shop.html" class="carousel-item-link"
                            data-animation="animated fadeInRight">Explora nuestras tendencias</a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
<section class="oleez-landing-section oleez-landing-section-about">
    <div class="container">
        <div class="oleez-landing-section-content">
            <div class="oleez-landing-section-verticals wow fadeIn">
                <span class="number">01</span> <img
                    src="https://res.cloudinary.com/dxtlbsa62/image/upload/v1716337113/productos/vucidlclxjws1alnlq65.png"
                    alt="ollez" height="50">
            </div>
            <div class="row landing-about-content wow fadeInUp">
                <div class="col-md-6">
                    <h2>Encuentra la prenda perfecta para tu estilo.</h2>
                </div>
                <div class="col-md-6">
                    <p>
                        Encuentra la prenda que define tu estilo.
                        Nuestras colecciones exclusivas te ofrecen variedad de estilos
                        ideales a ti.
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 landing-about-feature wow fadeInUp">
                    <img src="assets/images/iconos-09.svg" alt="document" class="about-feature-icon"
                        width="80">
                    <h5 class="about-feature-title">Worldwide Delivery</h5>
                    <p class="about-feature-description">No importa dónde te
                        encuentres, llevamos la moda
                        hasta tu puerta. Disfruta de
                        nuestras colecciones
                        exclusivas con la comodidad
                        de saber que ofrecemos
                        envíos a nivel mundial.

                    </p>
                </div>
                <div class="col-md-4 landing-about-feature wow fadeInUp">
                    <img src="assets/images/iconos-10.svg" alt="document" class="about-feature-icon"
                        width="80">
                    <h5 class="about-feature-title">100% Money Back</h5>
                    <p class="about-feature-description">
                        Tu satisfacción es nuestra
                        prioridad. Si por alguna razón
                        no estás completamente satisfecho
                        con tu compra, te ofrecemos una
                        garantía de devolución del 100%
                        del dinero.

                    </p>
                </div>
                <div class="col-md-4 landing-about-feature wow fadeInUp">
                    <img src="assets/images/iconos-08.svg" alt="document" class="about-feature-icon"
                        width="80">
                    <h5 class="about-feature-title">Secure Payment</h5>
                    <p class="about-feature-description">
                        Garantizamos un pago seguro
                        para tu tranquilidad. Utilizamos
                        tecnología de punta para proteger
                        tus transacciones y datos
                        personales, asegurando que
                        cada compra sea una experiencia
                        sin preocupaciones.

                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="oleez-landing-section oleez-landing-section-projects">
    <div class="container">
        <div class="oleez-landing-section-content">
            <div class="oleez-landing-section-verticals wow fadeIn">
                <span class="number">02</span> <img
                    src="https://res.cloudinary.com/dxtlbsa62/image/upload/v1716337113/productos/vucidlclxjws1alnlq65.png"
                    alt="ollez" height="50">
            </div>
            <h2 class="section-title wow fadeInUp">ULTIMAS CAMPAÑAS<a href="#!"
                    class="all-projects-link">Ver
                    todas las campañas</a></h2>
            <div class="landing-projects-carousel wow fadeIn">
                <div class="card landing-project-card">
                    <img src="assets/images/Banner/banner.jpg" class="card-img" alt="Project 1">
                    <div class="card-img-overlay">

                    </div>
                </div>
                <div class="card landing-project-card">
                    <img src="assets/images/Banner/banner_2.jpg" class="card-img" alt="Project 1">
                    <div class="card-img-overlay">

                    </div>
                </div>
                <div class="card landing-project-card">
                    <img src="assets/images/Banner/banner_3.jpg" class="card-img" alt="Project 1">
                    <div class="card-img-overlay">

                    </div>
                </div>

            </div>
            <div class="slick-navbtn-wrapper"></div>
        </div>
    </div>
</section>
<section class="oleez-landing-section oleez-landing-section-team">
    <div class="container">
        <div class="oleez-landing-section-content">
            <div class="oleez-landing-section-verticals wow fadeIn">
                <span class="number">03</span> <img
                    src="https://res.cloudinary.com/dxtlbsa62/image/upload/v1716337113/productos/vucidlclxjws1alnlq65.png"
                    alt="ollez" height="50">
            </div>
            <div class="row landing-team-content wow fadeInUp">
                <div class="col-md-6">
                    <h2 class="section-title">Descrubre tu<br> Estilo</h2>
                </div>
                <div class="col-md-6">
                    <p>Encuentra la prenda que define tu estilo.
                        Nuestras colección exclusivas te ofrece variedad de estilos
                        ideales a ti.
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 mb-5 mb-md-0 landing-team-card wow flipInY">
                    <img src="assets/images/Productos/1.jpg" alt="Team Member" class="team-card-img">
                    <h5 class="team-card-name">SUEDE JACKET</h5>
                    <p class="team-card-job">
                        Tiene un diseño minimalista y
                        elegante, con un cierre de
                        cremallera frontal y dos bolsillos
                        laterales con cremalleras.
                        El corte es ajustado y moderno,
                        adecuado para un estilo casual
                        y sofisticado.

                    </p>

                </div>
                <div class="col-md-4 mb-5 mb-md-0 landing-team-card wow flipInY">
                    <img src="assets/images/Productos/2.jpg" alt="Team Member" class="team-card-img">
                    <h5 class="team-card-name">BLUSA CAMPESINA</h5>
                    <p class="team-card-job">
                        Blusa blanca de estilo romántico,
                        confeccionada en una tela ligera
                        y delicada con detalles bordados
                        en patrones florales. Tiene mangas
                        cortas abullonadas y un escote
                        cuadrado amplio que le da un
                        toque femenino y vintage.

                    </p>

                </div>
                <div class="col-md-4 mb-5 mb-md-0 landing-team-card wow flipInY">
                    <img src="assets/images/Productos/3.jpg" alt="Team Member" class="team-card-img"
                        height="372">
                    <h5 class="team-card-name">CARGO PANTS</h5>
                    <p class="team-card-job">
                        Este modelo en particular tiene un
                        diseño ajustado en los tobillos,
                        lo que le da un toque moderno y
                        deportivo. Está confeccionado en un
                        color verde oliva, que es un tono
                        neutro y versátil.

                    </p>

                </div>
            </div>
        </div>
    </div>
</section>
<section class="oleez-landing-section oleez-landing-section-client" style="background-color: black;">
    <div class="container">
        <div class="oleez-landing-section-content">
            <div class="oleez-landing-section-verticalss wow fadeIn">
                <span class="number text-white">04</span> <img
                    src="https://res.cloudinary.com/dxtlbsa62/image/upload/v1716337113/productos/vucidlclxjws1alnlq65.png"
                    alt="ollez" height="50">
            </div>
            <h2 class="section-title mb-1 wow fadeInUp text-white">Marcas que ofrecemos</h2>
            <p class="client-section-subtitle wow fadeInUp text-white" data-wow-delay="0.2s">Estamos
                constantemente
                mejorando nuestros productos, añadiendo nuevas características y trabajando para ayudar al
                crecimiento de tu negocio.</p>

            <div class="row">
                <div class="col-md-4 client-logo-wrapper wow flipInX">
                    <div class="client-logo">
                        <img src="assets/images/Marcas/1.png" alt="client" height="50px">
                    </div>
                </div>
                <div class="col-md-4 client-logo-wrapper wow flipInX">
                    <div class="client-logo">
                        <img src="assets/images/Marcas/2.png" alt="client" height="50px">
                    </div>
                </div>
                <div class="col-md-4 client-logo-wrapper wow flipInX">
                    <div class="client-logo">
                        <img src="assets/images/Marcas/3.png" alt="client" height="50px">
                    </div>
                </div>
                <div class="col-md-4 client-logo-wrapper wow flipInX">
                    <div class="client-logo">
                        <img src="assets/images/Marcas/4.png" alt="client" height="50px">
                    </div>
                </div>
                <div class="col-md-4 client-logo-wrapper wow flipInX">
                    <div class="client-logo">
                        <img src="assets/images/Marcas/5.png" alt="client" height="50px">
                    </div>
                </div>
                <div class="col-md-4 client-logo-wrapper wow flipInX">
                    <div class="client-logo">
                        <img src="assets/images/Marcas/6.png" alt="client" height="50px">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="oleez-landing-section oleez-landing-section-news">
    <div class="container">
        <div class="oleez-landing-section-content">
            <div class="oleez-landing-section-verticals wow fadeIn">
                <span class="number">05</span> <img
                    src="https://res.cloudinary.com/dxtlbsa62/image/upload/v1716337113/productos/vucidlclxjws1alnlq65.png"
                    alt="ollez" height="50">
            </div>
            <h2 class="section-title wow fadeInUp">Testimonios</h2>
            <p class="news-section-subtitle wow fadeInUp" data-wow-delay="0.2s">Comparte tus historias con
                todos.</p>

            <div class="row">
                <div class="col-lg-4 mb-4 mb-lg-0">
                    <div class="news-card news-card-1 wow fadeInUp">
                        <div class="card-body">
                            <div class="author-info media">
                                <img src="assets/images/Client_1.jpg" alt="author" class="author-avatar">
                                <div class="media-body">
                                    <h6 class="author-name">Publicado por cliente</h6>
                                    <p class="news-post-date">5 de Julio, 2024</p>
                                </div>
                            </div>
                            <div class="post-meta">
                                <span class="post-category">Novedades</span> 4 min de lectura
                            </div>
                            <h5 class="post-title">¡Increíble experiencia de compra en Sebras! Encontré
                                exactamente lo que buscaba para una ocasión especial. El servicio al cliente fue
                                excepcional."</h5>

                        </div>
                    </div>
                </div>
                <div class="col-lg-4 mb-4 mb-lg-0">
                    <div class="news-card news-card-2 wow fadeInUp">
                        <div class="card-body">
                            <div class="author-info media">
                                <img src="assets/images/Client_1.jpg" alt="author" class="author-avatar">
                                <div class="media-body">
                                    <h6 class="author-name">Publicado por cliente</h6>
                                    <p class="news-post-date">5 de Julio, 2024</p>
                                </div>
                            </div>
                            <div class="post-meta">
                                <span class="post-category">Novedades</span> 4 min de lectura
                            </div>
                            <h5 class="post-title">¡Increíble experiencia de compra en Sebras! Encontré
                                exactamente lo que buscaba para una ocasión especial. El servicio al cliente fue
                                excepcional."</h5>

                        </div>
                    </div>
                </div>
                <div class="col-lg-4 mb-4 mb-lg-0">
                    <div class="news-card news-card-3 wow fadeInUp">
                        <div class="card-body">
                            <div class="author-info media">
                                <img src="assets/images/Client_1.jpg" alt="author" class="author-avatar">
                                <div class="media-body">
                                    <h6 class="author-name">Publicado por cliente</h6>
                                    <p class="news-post-date">5 de Julio, 2024</p>
                                </div>
                            </div>
                            <div class="post-meta">
                                <span class="post-category">Novedades</span> 4 min de lectura
                            </div>
                            <h5 class="post-title">¡Increíble experiencia de compra en Sebras! Encontré
                                exactamente lo que buscaba para una ocasión especial. El servicio al cliente fue
                                excepcional."</h5>

                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
</section>
@endsection