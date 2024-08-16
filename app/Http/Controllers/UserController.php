<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function bockUser(string|int $id){
        $user = User::find($id);

        if($user){
            $user->blocked_at = now();
            $user->save();

            return response()->json(['message' => "Utilisateur bloqué avec succès"]);
            }
        return response()->json(['message' => "Utilisateur non trouvé"], 404);
    }
    public function unbockUser(string|int $id){
        $user = User::find($id);

        if($user){
            $user->blocked_at = null;
            $user->save();

            return response()->json(['message' => "Utilisateur debloqué avec succès"]);
            }
        return response()->json(['message' => "Utilisateur non trouvé"], 404);
    }
}
