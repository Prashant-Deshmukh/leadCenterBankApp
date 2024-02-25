@extends('auth.layouts')
@section('content')

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header"><strong>Transfer Money</strong></div>
            <div class="card-body">
                <form action="{{ route('transfer.amount') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Email Address</label>
                        <input type="text" placeholder="Enter Email" id="email" class="form-control" name="email"
                        required autofocus />
                        @if ($errors->has('email'))
                            <span class="text-danger">{{ $errors->first('email') }}</span>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Amount</label>
                        <input type="number" placeholder="Enter Amount To Transfer" id="transfer_amount" class="form-control"
                        name="transfer_amount" required autofocus />
                        @if ($errors->has('email'))
                            <span class="text-danger">{{ $errors->first('email') }}</span>
                        @endif
                    </div>
                    <div class="d-grid mx-auto">
                        <button type="submit" class="btn btn-dark btn-block" >Transfer</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

@endsection
