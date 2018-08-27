@extends('layouts.default')

@section('content')

    <div class="content mt-3">
        <div class="animated fadeIn">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header col-md-12">
                        <strong class="card-title">@lang('payment.status')</strong>
                    </div>
                    <div class="card-body col-md-12">
                        @if($payment->isPaid())
                            <div class="alert alert-success">
                                Uw betaling is geslaagd
                            </div>
                        @elseif($payment->isCanceled())
                            <div class="alert alert-danger">
                                Uw betaling is geannuleerd. Neem contact op.
                            </div>
                        @else
                            <div class="alert alert-info">
                                De betaalstatus is onbekend.
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
