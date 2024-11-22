<?php

namespace App\Http\Controllers\Gondowangi\Frontend;

use App\Http\Controllers\Controller;
use App\Models\UserActivity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileSayaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    
    public function index()
    {
        $userId = Auth::id();
        
        $userActivities = UserActivity::where('user_credentials_id', $userId)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('gondowangi.frontend.profile.profilesaya.index', [
            'title' => 'Profile Saya',
            'userActivities' => $userActivities
        ]);
    }

    public function filterActivity(Request $request)
    {
        $userId = Auth::id();
        $date = $request->input('date');

        // Filter berdasarkan tanggal jika tersedia
        if ($date) {
            $userActivities = UserActivity::where('user_credentials_id', $userId)
                ->whereDate('created_at', $date)
                ->orderBy('created_at', 'desc')
                ->get();
        } else {
            $userActivities = UserActivity::where('user_credentials_id', $userId)
                ->orderBy('created_at', 'desc')
                ->get();
        }

        return view('gondowangi.frontend.profile.profilesaya.activity_list', [
            'userActivities' => $userActivities
        ]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
