@extends('auth.layouts')
@section('content')

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header"><strong>Welcome {{$auth_user->name}}</strong></div>
            <div class="card-body">
                    @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        {{ $message }}
                    </div>
                    @else
                    {{-- <div class="alert alert-success">
                        Hello, Admin, You are logged in!
                    </div> --}}
                @endif
                <div class="table-responsive">
                    <table class="table table-vcenter">
                      <thead>
                      </thead>
                      <tbody>
                        <tr>
                            <td>Your ID</td>
                            <td class="text-secondary">
                                {{$auth_user->email }}
                            </td>
                        </tr>
                        <tr>
                            <td>Your BALANCE</td>
                            <td class="text-secondary">
                                {{$user_balance->balance }}
                            </td>
                          </tr>
                      </tbody>
                    </table>
                  </div>

            </div>
        </div>
    </div>
</div>

@endsection
