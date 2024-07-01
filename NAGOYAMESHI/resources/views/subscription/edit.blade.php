@extends('layouts.app')

@section('content')
<a class="h5 ms-5" href="{{route('mypage')}}">＜戻る</a>
    <div class="container nagoyameshi-container pb-5">
        <div class="row justify-content-center">
            <div class="col-xl-5 col-lg-6 col-md-8">

                <h1 class="mb-3 text-center" id="test">お支払い方法</h1>

                <div class="container mb-4">
                    <div class="row pb-2 mb-2 border-bottom">
                        <div class="col-3">
                            <span class="fw-bold">カード種別</span>
                        </div>

                        <div class="col">
                            <span>{{ $user->pm_type }}</span>
                        </div>
                    </div>

                    <div class="row pb-2 mb-2 border-bottom">
                        <div class="col-3">
                            <span class="fw-bold">カード名義人</span>
                        </div>

                        <div class="col">
                            <span>{{ $user->defaultPaymentMethod()->billing_details->name  }}</span>
                        </div>
                    </div>

                    <div class="row pb-2 mb-2 border-bottom">
                        <div class="col-3">
                            <span class="fw-bold">カード番号</span>
                        </div>

                        <div class="col">
                            <span>**** **** **** {{ $user->pm_last_four }}</span>
                        </div>
                    </div>
                </div>

                <div class="alert alert-danger nagoyameshi-card-error" id="card-error" role="alert">
                    <ul class="mb-0" id="error-list"></ul>
                </div>

                <form id="card-form" action="{{ route('subscription.update') }}" method="post">
                    @csrf
                    @method('put')
                    <input type="text" class="nagoyameshi-card-holder-name mb-3" id="card-holder-name" placeholder="カード名義人" required>
                    <div class="nagoyameshi-card-element mb-4" id="card-element"></div>
                </form>
                <div class="d-flex justify-content-center">
                    <button class="btn text-white shadow-sm w-50 nagoyameshi-btn" id="card-button" data-secret="{{ $intent->client_secret }}">変更</button>
                </div>
            </div>
        </div>
    </div>
    <script src="https://js.stripe.com/v3/"></script>
    <script>
        const stripeKey = "pk_test_51PDeXIRuOREDwSLK4sa4NwOV3gRg5SdesIvRShe73CyHJhn0pL77GMkyCLFIuEEybyyXY0WTMejHzKhdhKwH8h8p00796YzZaX";
    </script>
    <script src="{{ asset('/js/stripe.js') }}"></script>
@endsection