<div id="desktop">
    <div class="position-fixed bottom-0 start-0 p-3">
        <div class="row">
            <div class="col-12" style="margin-left: 34px">
                <div class="text-start">
                    <audio id="myAudio" controls>
                        <source src="{{ url('music/dia-dinanti.mp3') }}" type="audio/mpeg">
                        Your browser does not support the audio element.
                    </audio>
                </div>

            </div>
            <div class="col-12">
                <div class="text-start">
                    <a href="https://api.whatsapp.com/send?phone={{ $siteSettings['whatsapp'] }}" target="_blank"
                        id="whatsapp-icon">
                        <img src="{{ url('donasi.svg') }}" alt="WhatsApp Icon">
                    </a>
                </div>

            </div>
        </div>

    </div>
    <div class="position-fixed bottom-0 end-0 p-3">
        <a href="https://api.whatsapp.com/send?phone={{ $siteSettings['whatsapp'] }}" target="_blank"
            id="whatsapp-icon">
            <img src="{{ url('assets/icon/whatsapp_floating.svg') }}" alt="WhatsApp Icon">
        </a>
    </div>
</div>

<div id="mobile">
    <div class="floating-icon">
        <div class="text-end">
            <a href="https://api.whatsapp.com/send?phone={{ $siteSettings['whatsapp'] }}" target="_blank"
                style="padding: 0px;">
                <img src="{{ url('ic_wa_mobile.png') }}" alt="WhatsApp Icon" class="img-fluid"
                    style="margin-right: 30px;">
            </a>
            <a href="https://api.whatsapp.com/send?phone={{ $siteSettings['whatsapp'] }}" target="_blank"
                style="padding: 0px;">
                <img src="{{ url('ic_donasi_mobile.png') }}" alt="WhatsApp Icon" class="img-fluid">
            </a>
        </div>
    </div>
</div>

<div class="footer">
    <div class="container mt-3 mb-3">

        <div class="row">
            <div class="col-md-4 mb-4 d-flex align-items-center">
                <div class="text-14-red text-md-start text-center" style="font-size: 13px;">
                    Copyright © Jangkar Baja. All rights reserved.
                </div>
            </div>
            <div class="col-md-3 mb-4 d-flex align-items-center">

                <div class="text-14-red text-md-start text-center" style="font-size: 13px;">
                    Total Visitors: <span style="font-size: 24px;">{{ $totalPageViews }}</span>
                </div>
            </div>
            <div class="col-md-5 mb-4 d-flex align-items-center">
                <div class="text-md-end text-center" style="font-size: 13px;">
                    Ikuti Kami
                    <span>
                        <a href="https://tiktok.com/{{ $siteSettings['tiktok'] }}"
                            style="text-decoration: none; color: black;">
                            <span><img src="{{ url('assets/tiktok.svg') }}" alt="" class="img-fluid">
                            </span>
                            {{ $siteSettings['tiktok'] }}
                        </a>
                    </span>
                    <span>
                        <a href="https://instagram.com/{{ $siteSettings['instagram'] }}"
                            style="text-decoration: none; color: black;">
                            <span><img src="{{ url('assets/instagram.svg') }}" alt="" class="img-fluid">
                            </span>
                            {{ $siteSettings['instagram'] }}
                        </a>
                    </span>
                </div>
            </div>
        </div>

    </div>
</div>
