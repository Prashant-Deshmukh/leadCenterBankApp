@extends('auth.layouts')
@section('content')

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header"><strong>Withdraw Money</strong></div>
            <div class="card-body">
                <form method="POST" action="{{ route('withdraw.amount') }}">
                    @csrf
                    <div class="form-group mb-3">
                        <input type="number" placeholder="Enter Amount To Withdraw" id="withdraw_amount"
                        class="form-control" name="withdraw_amount"
                            required autofocus>
                        @if ($errors->has('withdraw_amount'))
                        <span class="text-danger">{{ $errors->first('withdraw_amount') }}</span>
                        @endif
                    </div>
                    <div class="d-grid mx-auto">
                        <button type="submit" class="btn btn-dark btn-block">Withdraw</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

@endsection
