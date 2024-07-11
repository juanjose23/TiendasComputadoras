@extends('layout.app')
@section('title', 'Nosotros')
@section('content')
<div class="container">
    <h1 class="oleez-page-title wow fadeInUp">¿Cuál es nuestro proposito?</h1>
    <p class="oleez-page-header-content wow fadeInUp">Nuestro propósito es ser tu destino favorito para comprar
        ropa en línea. Ofrecemos una amplia selección de prendas y accesorios de moda, garantizando una
        experiencia de compra fácil, segura y satisfactoria desde cualquier lugar.
        <br> Explora nuestras colecciones
        y encuentra lo último en tendencias, todo con envío rápido y atención al cliente excepcional.
    </p>
    <img src="assets/images/About/about.jpg" alt="about" class="w-100 wow fadeInUp" height="380">
    <section class="oleez-about-features">
        <div class="row">
            <div class="col-md-4 mb-5 mb-md-0 feature-card wow fadeInUp">
                <h5 class="feature-card-title">Historia</h4>
                    <p class="feature-card-content">Sed ut perspiciatis unde omnis iste natus error sit
                        voluptatem accusantium doloremque laudantium, totam rem aperiam, </p>
            </div>
            <div class="col-md-4 mb-5 mb-md-0 feature-card wow fadeInUp">
                <h5 class="feature-card-title">Mision</h4>
                    <p class="feature-card-content">Facilitar a nuestros clientes la experiencia de compra de
                        moda más satisfactoria y conveniente posible, ofreciendo una amplia gama de productos de
                        alta calidad y última tendencia. Nos comprometemos a proporcionar un servicio al cliente
                        excepcional y a crear relaciones duraderas basadas en la confianza y la satisfacción.
                    </p>
            </div>
            <div class="col-md-4 mb-5 mb-md-0 feature-card wow fadeInUp">
                <h5 class="feature-card-title">Vision</h4>
                    <p class="feature-card-content">Convertirnos en el ecommerce líder en moda reconocido por
                        nuestra excelencia en servicio al cliente, innovación en tendencias y compromiso con la
                        calidad. Nos esforzamos por inspirar a nuestros clientes a través de una experiencia de
                        compra única que refleje nuestra pasión por la moda y el estilo </p>
            </div>
        </div>
    </section>
    <section class="oleez-what-we-do">
        <div class="row">
            <div class="col-lg-10 offset-lg-1">
                <h2 class="section-title wow fadeInUp">Acerca de nosotros</h2>
                <h4 class="section-subtitle wow fadeInUp">Transforma tu vestuario, transforma tu vida</h4>
                <div class="row">
                    <div class="col-md-4 mb-5 mb-md-0 wow fadeInUp">
                        <h5 class="what-we-do-list-title">NOVEDADES DIARIAS</h5>
                        <ul class="what-we-do-list">
                            Todas las mañanas publicamos
                            más de 100 prendas ÚNICAS!
                            Ropa, accesorios para mujeres
                            y hombres con descuentos
                            hasta el 50%.
                        </ul>
                    </div>
                    <div class="col-md-4 mb-5 mb-md-0 wow fadeInUp">
                        <h5 class="what-we-do-list-title">ENTREGA RAPIDA</h5>
                        <ul class="what-we-do-list">
                            En 1-2 días laborables tendrás tu pedido
                            en casa o en el punto que solicites.
                            ¡No te haremos esperar para estrenarlo!
                        </ul>
                    </div>
                    <div class="col-md-4 mb-5 mb-md-0 wow fadeInUp">
                        <h5 class="what-we-do-list-title">DEVOLUCIONES GRATUITAS</h5>
                        <ul class="what-we-do-list">
                            Si no te convence tu compra tendrás
                            un plazo de 15 días para devolverlo
                            de forma sencilla y GRATIS.¡Queremos que te guste y que lo
                            uses mucho!
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="oleez-about-work-with-us wow fadeInUp">
        <div class="container">
            <div class="row position-relative">
                <div class="col-lg-3 offset-lg-1 d-flex align-items-center">
                    <a href="contact.html" class="btn work-with-us-btn btn-lg btn-block">Contactanos</a>
                </div>
                <style>
                    .position-relative {
                        position: relative;
                    }

                    .linea-gris {
                        position: absolute;
                        top: 30%;
                        left: 0;
                        right: 0;
                        height: 110px;
                        width: 934px;
                        background-color: #D9D9D9;
                        z-index: 0;
                    }

                    .imagenes {
                        width: 231px;
                        height: 233px;
                        gap: 0px;
                    }

                    .align-images-right {
                        margin-left: auto;
                    }
                </style>
                <div class="col-lg-8 position-relative align-images-right">
                    <!-- Contenido del div gris -->
                    <div class="linea-gris"></div>
                    <div class="row position-relative" style="z-index: 1;">
                        <div class="col-lg-1 pr-0">
                        </div>
                        <div class="col-lg-11">
                            <div class="row">
                                <div class="col-md-4 pr-0">
                                    <img src="assets/images/About/4421568c46438f7a6045a50c7345248b.jpg"
                                        class="img-fluid imagenes" alt="Imagen 1">
                                </div>
                                <div class="col-md-4 pr-0">
                                    <img src="assets/images/About/4f39c37f415e34a3d78c35fcdf55f611.jpg"
                                        class="img-fluid imagenes" alt="Imagen 2">
                                </div>
                                <div class="col-md-4 pr-0">
                                    <img src="assets/images/About/e9047a00c4321fcd5719cef71bd51a2c.jpg"
                                        class="img-fluid imagenes" alt="Imagen 3">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection