@extends('auth.layouts')
@section('content')

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header"><strong>Deposite Money</strong></div>
            <div class="card-body">
                <form method="POST" action="{{ route('deposite.amount') }}">
                    @csrf
                    <div class="form-group mb-3">
                        <input type="number" placeholder="Enter Amount To Deposite" id="deposit_amount"
                        class="form-control" name="deposit_amount"
                            required autofocus>
                        @if ($errors->has('deposit_amount'))
                        <span class="text-danger">{{ $errors->first('deposit_amount') }}</span>
                        @endif
                    </div>
                    <div class="d-grid mx-auto">
                        <button type="submit" class="btn btn-dark btn-block">Deposit</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

@endsection
