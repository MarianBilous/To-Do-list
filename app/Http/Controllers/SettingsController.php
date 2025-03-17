<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SettingsController
{
    public function index()
    {
        return view('settings.index');
    }

    public function createApiToken(Request $request)
    {
        $user = $request->user();
        $token = $user->createToken('TaskApp', ['*'], now()->addWeek())->plainTextToken;

        return redirect()->route('settings.index')->with('token', $token);
    }
}
