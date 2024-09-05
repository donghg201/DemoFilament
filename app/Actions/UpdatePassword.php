<?php

namespace App\Actions;

use App\Models\User;
use Illuminate\Support\Facades\Request;
use Lorisleiva\Actions\Concerns\AsAction;

class UpdatePassword
{
    use AsAction;
    public function handle(User $user, string $password)
    {
        $user->password = bcrypt($password);
        $user->save();

        return $user;
    }

    public function asController(Request $request)
    {
        $user = User::find(2);

        $this->handle($user, 'myPassword');
        return $user;
    }

    public function htmlResponse()
    {
        return redirect()->back();
    }

    public function jsonResponse(User $user, Request $request)
    {
        return response()->json([
            'user' => $user,
            'success' => 'true'
        ], 201);
    }
}
