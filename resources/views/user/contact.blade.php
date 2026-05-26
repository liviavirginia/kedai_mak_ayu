@extends('layouts.user')

@section('title', 'Kontak Kami')

@section('content')
<section class="page-header">
    <div class="container text-center">
        <h1 class="display-4 fw-bold">HUBUNGI KAMI</h1>
        <p class="lead">Kami siap melayani Anda 24 jam</p>
    </div>
</section>

<section class="py-5">
    <div class="container">
        <div class="row g-4">
            <div class="col-md-4">
                <div class="contact-card">
                    <div class="contact-icon">
                        <i class="fas fa-map-marker-alt"></i>
                    </div>
                    <h4>Alamat Toko</h4>
                    <p class="text-muted">Jl. Cengkeh 5 No.1<br>Perumnas Simalingkar, Kec. Medan Tuntungan</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="contact-card">
                    <div class="contact-icon">
                        <i class="fas fa-phone-alt"></i>
                    </div>
                    <h4>Telepon</h4>
                    <p class="text-muted">+62 822-1530-9714</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="contact-card">
                    <div class="contact-icon">
                        <i class="fab fa-whatsapp"></i>
                    </div>
                    <h4>WhatsApp</h4>
                    <p class="text-muted">+62 822-1530-9714<br>Chat kami untuk pesan cepat</p>
                </div>
            </div>
        </div>

        <div class="row mt-5 g-4">
            <div class="col-md-6">
                <div class="card border-0 shadow-sm rounded-4 h-100">
                    <div class="card-body p-4">
                        <h3 class="mb-4"><i class="fas fa-envelope me-2" style="color: #800000;"></i> Kirim Pesan</h3>
                        <form>
                            @csrf
                            <div class="mb-3">
                                <input type="text" class="form-control" placeholder="Nama Anda" style="border: 2px solid #eee; border-radius: 12px; padding: 12px;">
                            </div>
                            <div class="mb-3">
                                <input type="email" class="form-control" placeholder="Email Anda" style="border: 2px solid #eee; border-radius: 12px; padding: 12px;">
                            </div>
                            <div class="mb-3">
                                <textarea class="form-control" rows="5" placeholder="Pesan Anda" style="border: 2px solid #eee; border-radius: 12px; padding: 12px;"></textarea>
                            </div>
                            <button type="submit" class="btn btn-maroon w-100">Kirim Pesan <i class="fas fa-paper-plane ms-2"></i></button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card border-0 shadow-sm rounded-4 h-100 overflow-hidden">
                    <iframe 
                        src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d253840.4913303858!2d106.6647009!3d-6.2297209!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30312513b36f1023%3A0xe339e297f9db2214!2sJl.%20Cengkeh%205%20No.1%2C%20Mangga%2C%20Kec.%20Medan%20Tuntungan%2C%20Kota%20Medan%2C%20Sumatera%20Utara%2020135!5e0!3m2!1sen!2sid!4v1779202255879!5m2!1sen!2sid" 
                        width="100%" 
                        height="350" 
                        style="border:0;" 
                        allowfullscreen="" 
                        loading="lazy">
                    </iframe>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection