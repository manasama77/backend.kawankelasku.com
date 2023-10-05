<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class DashboardController extends Controller
{
    public function index()
    {
        $bungkus = [
            'title' => 'Dashboard',
        ];
        return view('pages.dashboard.main', $bungkus);
    }

    public function profile()
    {
        $bungkus = [
            'title' => 'Profile',
        ];
        return view('pages.profile.main', $bungkus);
    }

    public function profile_edit(Request $request)
    {
        try {

            // throw new Exception(session('token'));
            $request->validate([
                'full_name' => 'required|min:4',
            ]);

            $full_name = $request->full_name;

            $response = Http::withoutVerifying()
                ->withHeaders([
                    'Accept'        => 'application/json',
                    'Authorization' => 'Bearer ' . session('token'),
                ])->post(env('API_URL') . '/admin/profile/edit', [
                    'full_name' => $full_name,
                ]);

            $data = $response->object();

            if ($data->success === false) {
                throw new Exception($data->message, 400);
            }

            session(['full_name' => $request->full_name]);

            return response()->json([
                'success' => true,
                'message' => 'Edit profile success'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }
}
