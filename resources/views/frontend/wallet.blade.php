@extends('frontend.common.app')
@section('title','Wallet')
@section('content')
<section class="py-5">
  <div class="container container-custom">
        <!-- Wallet Card -->
    <div class="wallet-card mb-4">
        <div class="wallet-title">Total GM Coins</div>

        <div class="wallet-amount">
            <div class="coin-icon">🪙</div>
            200
        </div>

        <div class="coin-bg">🪙</div>
    </div>

    <!-- Transactions -->
    <div class="transaction-card">
        <div class="transaction-header">
            <span style="color:#ff6b00;">⬇</span>
            Recent Transactions
        </div>

        <hr>

        <div class="transaction-item d-flex justify-content-between align-items-start">
            <div>
                <div class="transaction-title">
                    Wallet credits for campaign :NEW_USER_SIGNUP
                </div>
                <div class="transaction-date">
                    Feb 23, 3:53 PM
                </div>
            </div>

            <div class="transaction-amount">
                + 200 Coins
            </div>
        </div>
    </div>

</div>
  </div>
</section>
@endsection