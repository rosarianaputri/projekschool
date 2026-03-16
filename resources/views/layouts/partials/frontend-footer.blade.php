@php
    $footer = $footerData ?? \App\Models\SiteSetting::getFooterData();
    $copyright = str_replace('{year}', date('Y'), $footer['bottom_copyright'] ?? '');
@endphp

<footer class="bg-gradient-dark text-white pt-5 pb-3">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="footer-brand">
                    <h4 class="mb-3 fw-bold text-primary">{{ $footer['brand_name'] }}</h4>
                    <p class="mb-3 text-light">{{ $footer['brand_description'] }}</p>

                    <div class="contact-info">
                        <div class="d-flex align-items-start mb-2">
                            <i class="fas fa-map-marker-alt text-primary me-3 mt-1"></i>
                            <span class="text-light">{!! nl2br(e($footer['address'])) !!}</span>
                        </div>

                        <div class="d-flex align-items-center mb-2">
                            <i class="fas fa-envelope text-primary me-3"></i>
                            <a href="mailto:{{ $footer['email'] }}" class="text-light text-decoration-none hover-primary">
                                {{ $footer['email'] }}
                            </a>
                        </div>

                        <div class="d-flex align-items-center mb-3">
                            <i class="fas fa-phone text-primary me-3"></i>
                            <a href="tel:{{ preg_replace('/\s+/', '', $footer['phone']) }}" class="text-light text-decoration-none hover-primary">
                                {{ $footer['phone'] }}
                            </a>
                        </div>

                        <div class="mt-3">
                            <iframe
                                src="{{ $footer['map_embed_url'] }}"
                                width="100%"
                                height="150"
                                style="border:0;border-radius:8px;"
                                loading="lazy">
                            </iframe>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 mb-4">
                <h5 class="mb-4 fw-bold">{{ $footer['quick_links_title'] }}</h5>
                <ul class="list-unstyled footer-links">
                    @foreach($footer['quick_links'] as $item)
                        <li class="mb-2">
                            <a href="{{ $item['url'] ?: '#' }}" class="text-light text-decoration-none d-flex align-items-center">
                                <i class="fas fa-chevron-right text-primary me-2 fs-6"></i>
                                {{ $item['label'] }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>

            <div class="col-lg-2 col-md-6 mb-4">
                <h5 class="mb-4 fw-bold">{{ $footer['programs_title'] }}</h5>
                <ul class="list-unstyled footer-links">
                    @foreach($footer['programs'] as $item)
                        <li class="mb-2">
                            <a href="{{ $item['url'] ?: '#' }}" class="text-light text-decoration-none d-flex align-items-center">
                                <i class="{{ $item['icon'] ?: 'fas fa-circle' }} text-primary me-2 fs-6"></i>
                                {{ $item['label'] }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>

            <div class="col-lg-3 col-md-6 mb-4">
                <h5 class="mb-4 fw-bold">{{ $footer['social_title'] }}</h5>
                <p class="text-light mb-3">{{ $footer['social_description'] }}</p>

                <div class="social-links">
                    @foreach($footer['social_links'] as $item)
                        <a href="{{ $item['url'] ?: '#' }}" class="btn btn-outline-primary btn-sm me-2 mb-2 d-inline-flex align-items-center justify-content-center" style="width:40px;height:40px;" aria-label="{{ $item['platform'] }}">
                            <i class="{{ $item['icon'] ?: 'fab fa-linkedin-in' }}"></i>
                        </a>
                    @endforeach
                </div>

                @if(($footer['newsletter_enabled'] ?? '1') === '1')
                    <div class="newsletter mt-4">
                        <h6 class="mb-3 fw-bold">{{ $footer['newsletter_title'] }}</h6>

                        <form class="d-flex" onsubmit="return false;">
                            <input type="email" class="form-control me-2" placeholder="{{ $footer['newsletter_placeholder'] }}" style="height:38px;">
                            <button type="submit" class="btn btn-primary btn-sm">
                                {{ $footer['newsletter_button_text'] }}
                            </button>
                        </form>
                    </div>
                @endif
            </div>
        </div>

        <div class="border-top border-secondary mt-4 pt-3">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <p class="mb-0 text-light">{{ $copyright }}</p>
                </div>

                <div class="col-md-6 text-md-end">
                    @foreach($footer['bottom_links'] as $item)
                        <a href="{{ $item['url'] ?: '#' }}" class="text-light text-decoration-none {{ !$loop->last ? 'me-3' : '' }}">
                            {{ $item['label'] }}
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</footer>