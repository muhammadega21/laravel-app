<div class="col-xxl-4 col-md-4">
    <div class="card info-card sales-card">
        <div class="card-body">
            <h5 class="card-title">{{ $cardTitle }}<span> | <a href="{{ url('' . strtolower($cardTitle)) }}">Data
                        {{ $cardTitle }}</a></span></h5>

            <div class="d-flex align-items-center ">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi {{ $icon }}"></i>
                </div>
                <div class="ms-3">
                    <h6>{{ $slot }}</h6>
                </div>
            </div>
        </div>

    </div>
</div><!-- End Sales Card -->
