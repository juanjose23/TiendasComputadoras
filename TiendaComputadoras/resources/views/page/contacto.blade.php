@extends('layout.app')
@section('title', 'Contacto')
@section('content')
<div class="container">
    <h1 class="oleez-page-title wow fadeInUp">Contacto</h1>
    <div class="row">
        <div class="col-md-6 mb-5 mb-md-0 pr-lg-5 wow fadeInLeft">
            <div class="embed-responsive embed-responsive-1by1">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1950.3564234290384!2d-86.27239396907747!3d12.131789248915435!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8f7155e45947c2c5%3A0x8eaf963e036e7444!2sUniversidad%20Nacional%20de%20Ingenier%C3%ADa%20(UNI)!5e0!3m2!1ses-419!2sni!4v1719000334765!5m2!1ses-419!2sni"
                    width="600" height="450" frameborder="0" style="border:0;" allowfullscreen=""
                    aria-hidden="false" tabindex="0"></iframe>
            </div>
        </div>
        <div class="col-md-6 pl-lg-5 wow fadeInRight">
            <form action="POST" class="oleez-contact-form">
                <div class="form-group">
                    <input type="text" class="oleez-input" id="fullName" name="fullName" required>
                    <label for="fullName">*Nombre completo</label>
                </div>
                <div class="form-group">
                    <input type="email" class="oleez-input" id="fullName" name="email" required>
                    <label for="email">*Correo</label>
                </div>
                <div class="form-group">
                    <label for="message">*Mensaje</label>
                    <textarea name="message" id="message" rows="10" class="oleez-textarea" required></textarea>
                </div>
                <button type="submit" class="btn btn-submit">Enviar mensaje</button>
            </form>
        </div>
    </div>
</div>
<br>
@endsection