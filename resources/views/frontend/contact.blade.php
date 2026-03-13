@extends('layouts.frontend')

@php
    $title = 'Contact Us - Layla School';
@endphp

@section('content')
    @if(isset($contactData) && is_array($contactData))
    <section class="text-center my-5">
        <h1>{{ $contactData['page_title'] ?? 'Contact Us' }}</h1>
        <p>{{ $contactData['page_subtitle'] ?? 'Get in touch with us' }}</p>
    </section>

    <section class="container my-5">
        <div class="row">
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">Contact Information</h5>
                        <div class="mb-3">
                            <strong>Email:</strong> 
                            <a href="mailto:{{ $contactData['contact_email'] ?? 'info@laylaschool.edu' }}">
                                {{ $contactData['contact_email'] ?? 'info@laylaschool.edu' }}
                            </a>
                        </div>

                        @if(!empty($contactData['contact_phone']))
                            <div class="mb-3">
                                <strong>Phone:</strong> 
                                <a href="tel:{{ $contactData['contact_phone'] }}">
                                    {{ $contactData['contact_phone'] }}
                                </a>
                            </div>
                        @endif

                        <div class="mb-3">
                            <strong>Address:</strong><br>
                            {{ nl2br($contactData['contact_address'] ?? '123 School Street, Education City, EC 12345') }}
                        </div>
                    </div>
                </div>

                <h5 class="mb-3">{{ $contactData['form_title'] ?? 'Send us a message' }}</h5>

                <form action="{{ route('contact.submit') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>

                    <div class="mb-3">
                        <label for="subject" class="form-label">Subject</label>
                        <input type="text" class="form-control" id="subject" name="subject" required>
                    </div>

                    <div class="mb-3">
                        <label for="message" class="form-label">Message</label>
                        <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary">
                        {{ $contactData['form_submit_text'] ?? 'Send Message' }}
                    </button>
                </form>
            </div>

            <div class="col-md-6">
                <div class="card h-100">
                    <div class="card-body">
                        <h5>Find Us</h5>
                        <p>You can visit our school at the following location.</p>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <!-- MAP FULL WIDTH -->
    <div class="map-container mt-5" style="width:100%; height:500px; margin-bottom:100px;">
        <iframe
            src="{{ $contactData['map_embed_url'] ?? 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3029.572623436288!2d49.66165917533707!3d40.59518807141149!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x403097425d5bb533%3A0xe468933010cbe590!2zTGF5bGEgU2Nob29sIC0gVMmZbGltIFTJmWRyaXMgTcmZcmvJmXpp!5e0!3m2!1sen!2sid!4v1769477779694!5m2!1sen!2sid' }}"
            width="100%"
            height="100%"
            style="border:0;"
            allowfullscreen=""
            loading="lazy">
        </iframe>
    </div>

    @elseif(isset($page) && $page && $pageContent)

        {!! $pageContent !!}

    @else

    <section class="text-center my-5">
        <h1>Contact Us</h1>
        <p>Get in touch with us</p>
    </section>

    <section class="container my-5">
        <form>
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" placeholder="Your Name">
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" placeholder="Your Email">
            </div>

            <div class="mb-3">
                <label for="message" class="form-label">Message</label>
                <textarea class="form-control" id="message" rows="5" placeholder="Your Message"></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Send Message</button>
        </form>
    </section>

  

    <br>
    <br>

    @endif
@endsection