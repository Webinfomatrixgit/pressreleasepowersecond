@extends('frontend.layouts.user.app')
@push('style')
    <style>
        .wallet-container {
            background-color: #007bff; /* Solid color for simplicity */
            border-radius: 8px; /* Slightly softer corners */
            padding: 12px 16px; /* Compact padding */
            font-size: 14px; /* Small, readable text */
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05); /* Subtle shadow */
        }

        .wallet-container .fa-wallet {
            color: #fff; /* Keep icon matching the text */
        }

        .wallet-text {
            font-size: 14px;
        }

        .wallet-amount {
            font-size: 18px;
            color: #ffeb3b; /* Highlight the balance */
        }

        /* Responsiveness */
        @media (max-width: 576px) {
            .wallet-container {
                flex-direction: column;
                text-align: center;
            }
            .wallet-amount {
                margin-top: 8px;
                font-size: 16px;
            }
        }
    </style>
@endpush
@section('user-content')
    <div class="card">
        <div class="row g-0">
            <div class="col-12 col-md-3 border-end">
                <div class="card-body">


                    <p class="wallet-container mb-0 d-flex justify-content-between align-items-center fw-bold text-uppercase bg-primary text-white rounded p-3 shadow-sm">
                        <i class="fa fa-wallet me-1 fs-5"></i>
                        <span class="wallet-text">{{ __('Balance') }} :</span>
                        <span class="wallet-amount ms-auto fw-bold">
                            {{ setting('currency_symbol') }}{{ number_format(auth()->user()->balance, 2) }}
                        </span>
                    </p>


                    <div class="list-group list-group-transparent">
                        <a href="{{ route('user.profile.index') }}"
                           class="list-group-item list-group-item-action d-flex align-items-center {{ isActive('user.profile.index') }}">
                            <i class="fa-light fa-address-card me-2"></i>
                            {{ __('My Profile') }}
                        </a>
                        <a href="{{ route('user.profile.security') }}"
                           class="list-group-item list-group-item-action d-flex align-items-center {{ isActive('user.profile.security') }}">
                            <i class="fa-regular fa-shield-check me-2"></i>
                            {{ __('Security') }}
                        </a>
                        <a href="{{ route('user.profile.change-password') }}"
                           class="list-group-item list-group-item-action d-flex align-items-center {{ isActive('user.profile.change-password') }}">
                            <i class="fa-regular fa-lock me-2"></i>
                            {{ __('Change Password') }}
                        </a>
                        <a href="{{ route('user.notifications.index') }}"
                           class="list-group-item list-group-item-action d-flex align-items-center {{ isActive('user.notifications.index') }}">
                            <i class="fa-regular fa-bells me-2"></i>
                            {{ __('My Notifications') }}
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-9 d-flex flex-column">
                @yield('user-setting-content')
            </div>
        </div>
    </div>
@endsection
