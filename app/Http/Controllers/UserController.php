<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RegistrationRequest;
use Hash;
use Session;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\UserBalance;

class UserController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }
    public function customLogin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            //Fetch account balance
            $user_balance = UserBalance::find(auth()->user()->id);
            // dd($user_balance);
            return view('auth.dashboard')->with(['user_balance' => $user_balance,'auth_user' => auth()->user()]);
        }
        return redirect("login")->withSuccess('Login details are not valid');
    }
    public function registration()
    {
        return view('auth.register');
    }
    public function customRegistration(RegistrationRequest $request)
    {
        $data = $request->validated();
        $check = $this->create($data);
        $userBalance = $this->createUserBalance($check);
        return redirect("dashboard")->withSuccess('You have signed-in');
    }
    public function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password'])
        ]);
    }

    public function createUserBalance(User $user)
    {
        return UserBalance::create([
            'user_id' => $user->id,
            'balance' => 0, // defaul 0 will added in account when user is registered
        ]);
    }
    public function dashboard()
    {
        if (Auth::check()) {
            $user_balance = UserBalance::find(auth()->user()->id);
            return view('auth.dashboard')->with(['user_balance' => $user_balance,'auth_user' => auth()->user()]);
        }
        return redirect("login")->withSuccess('You are not allowed to access');
    }
    public function signOut()
    {
        Session::flush();
        Auth::logout();
        return Redirect('login');
    }

    public function deposite()
    {
        return view('auth.deposite');
    }

    public function depositeAmount(Request $request)
    {
        $request->validate([
            'deposit_amount' => 'required',
        ]);
        $user_balance = UserBalance::where('id', auth()->user()->id)->first();

        $user_balance->balance = $user_balance->balance + $request->deposit_amount;
        $user_balance->save();
        return redirect()->route('deposite');

    }

    public function withdraw()
    {
        return view('auth.withdraw');
    }

    public function withdrawAmount(Request $request)
    {
        $request->validate([
            'withdraw_amount' => 'required',
        ]);

        $user_balance = UserBalance::where('id', auth()->user()->id)->first();

        if ($user_balance < $request->withdraw_amount) {
            return redirect()->back()->with('error', 'Something went wrong!');
        }
        $user_balance->balance = $user_balance->balance - $request->withdraw_amount;
        $user_balance->save();
        return redirect()->route('withdraw');
    }

    public function transfer()
    {
        return view('auth.transfer');
    }

    public function transferAmount(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'transfer_amount' => 'required|numeric',
        ]);
        $user = User::where('email', $request->email)->first();
        if (is_null($user)) {
            return redirect()->back()->with('error', 'Something went wrong!');
        }
        $receiver_user = UserBalance::where('user_id', $user->user_id)->first();
        $transfer_user = UserBalance::where('id', auth()->user()->id)->first();

        if ($transfer_user->balance < $request->transfer_amount) {
            return redirect()->back()->with('error', 'Something went wrong!');
        }

        $receiver_user->balance = $receiver_user->balance + $request->transfer_amount;
        $receiver_user->save();

        $transfer_user->balance = $transfer_user->balance - $request->withdraw_amount;
        $transfer_user->save();

        return redirect()->route('transfer');
    }
}
