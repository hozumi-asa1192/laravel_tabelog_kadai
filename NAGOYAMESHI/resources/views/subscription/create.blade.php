@extends('layouts.app')

@section('content')
<a class="h5 ms-5" href="{{route('mypage')}}">＜戻る</a>
    <div class="container nagoyameshi-container pb-5">
        <div class="row justify-content-center">
            <div class="col-xl-5 col-lg-6 col-md-8">

                <h1 class="mb-3 text-center">有料プラン登録</h1>

                @if (session('subscription_message'))
                    <div class="alert alert-info" role="alert">
                        <p class="mb-0">{{ session('subscription_message') }}</p>
                    </div>
                @endif

                <div class="card mb-4">
                    <div class="card-header text-center">
                        有料プランの内容
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">・当日の2時間前までならいつでも予約可能</li>
                        <li class="list-group-item">・店舗をお好きなだけお気に入りに追加可能</li>
                        <li class="list-group-item">・レビューを全件閲覧可能</li>
                        <li class="list-group-item">・レビューを投稿可能</li>
                        <li class="list-group-item">・月額たったの300円</li>
                    </ul>
                </div>

                <hr class="mb-4">

                <div class="alert alert-danger nagoyameshi-card-error" id="card-error" role="alert">
                    <ul class="mb-0" id="error-list"></ul>
                </div>

                <form id="card-form" action="{{ route('subscription.store') }}" method="post">
                    @csrf
                    <input class="nagoyameshi-card-holder-name mb-3" id="card-holder-name" type="text" placeholder="カード名義人" required>
                    <div class="nagoyameshi-card-element mb-4" id="card-element"></div>

                </form>
                <div class="d-flex justify-content-center">
                    <button class="btn text-white shadow-sm w-50 nagoyameshi-btn" id="card-button" data-secret="{{ $intent->client_secret }}">登録</button>
                </div>
            </div>
        </div>
    </div>
    <script src="https://js.stripe.com/v3/"></script>
    <script>
        const stripeKey = "pk_test_51PDeXIRuOREDwSLK4sa4NwOV3gRg5SdesIvRShe73CyHJhn0pL77GMkyCLFIuEEybyyXY0WTMejHzKhdhKwH8h8p00796YzZaX"; 
        console.log(stripeKey);
    </script>
    <script src="{{ asset('/js/stripe.js') }}"></script>
@endsection