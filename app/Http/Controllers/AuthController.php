<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Http;

class AuthController extends Controller
{
    public function index()
    {
        return view('layouts.login');
    }

    public function auth(Request $request)
    {
        try {
            $response = Http::withoutVerifying()
                ->withHeaders([
                    'Accept' => 'application/json',
                ])->post(env('API_URL') . '/admin/login', [
                    'email'    => $request->email,
                    'password' => $request->password,
                ]);

            $results = $response->json();
            $success = $results['success'];
            $message = $results['message'];
            $data    = $results['data'];

            if ($success === false) {
                throw new Exception($message);
            }

            $expired = Carbon::now()->addHours(2)->format('Y-m-d H:i:s');

            session(['id' => $data['id']]);
            session(['email' => $data['email']]);
            session(['full_name' => $data['full_name']]);
            session(['token' => $data['token']]);
            session(['admin_time_expired' => $expired]);

            return redirect()->route('admin.dashboard');
        } catch (Exception $e) {
            return back()
                ->withInput()
                ->withErrors($e->getMessage());
        }
    }

    public function logout(Request $request)
    {
        $request->session()->flush();
        return redirect()->route('login');
    }

    public function change_password(Request $request)
    {
        try {
            $request->validate([
                'current_password' => 'required',
                'new_password'     => 'required|confirmed',
            ]);

            $current_password = $request->current_password;
            $new_password     = $request->new_password;

            $response = Http::withoutVerifying()
                ->withHeaders([
                    'Accept'        => 'application/json',
                    'Authorization' => 'Bearer ' . session('token'),
                ])->post(env('API_URL') . '/admin/change_password', [
                    'current_password' => $current_password,
                    'password'         => $new_password,
                ]);

            return response()->json($response->json());
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }
}
