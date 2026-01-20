@php
$get_all = App\Models\GetAll::find(1);    
@endphp

<div class="lonyo-section-padding4 position-relative">
    <div class="container">
      <div class="row">
        <div class="col-lg-5 order-lg-2">
          <div class="lonyo-content-thumb" data-aos="fade-up" data-aos-duration="700">
            <img src="{{ asset($get_all->image) }}" alt="">
          </div>
        </div>
        <div class="col-lg-7 d-flex align-items-center">
          <div class="lonyo-default-content pr-50" data-aos="fade-right" data-aos-duration="700">
            <h2>{{ $get_all->title }}</h2>
            <p class="data">{{ $get_all->description }}</p>
            <div class="mt-50">
              <ul class="tabs">
                <li class="active-tab">
                  <img src="{{ asset('frontend/assets/images/v1/tv.svg') }}" alt="">
                  <h4>Unified Dashboard</h4>
                </li>
                <li>
                  <img src="{{ asset('frontend/assets/images/v1/alerm.svg') }}" alt="">
                  <h4>Real-Time Updates</h4>
                </li>
              </ul>
              <ul class="tabs-content">
                <li>
                  {{ $get_all->unified }}
                </li>
                <li>
                  {{ $get_all->real_time }}
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="lonyo-content-shape2"></div>
  </div>