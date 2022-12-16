<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Log;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function list(){

        $userList = User::get();

        return $userList;
    }

    public function insert(Request $request){

        $request->validate([
            'name' => 'required|unique:users|max:15',
            'age' => 'required',
        ]);
        // dd($data);
        $newUser = new User();
        $newUser->name = $request->name;
        $newUser->age = $request->age;
        if($newUser->save()){
            return "Kaydedildi";
        }
        return "Kaydedilmedi";
    }

    public function update($user, Request $request){

        $updateUser = User::where('id' , $user)->first();

        // return $updateUser;
        $updateUser->name = $request->name;
        $updateUser->age = $request->age;
        if($updateUser->save()){
            return "Kaydedildi";
        }
        return "Kaydedilmedi";
    }

    public function delete($user, Request $request){

        if(User::where('id', $user)->delete()){
            return "Silindi";
        }
        return "Silinmedi";
    }

    public function destroy($user){

        if(User::destroy($user)){
            return "Silindi";
        }
        return "Silinmedi";
    }

    public function restartCounter(){

        $attempts = Log::where('attempts', '<', 30)->get();
        foreach($attempts as $setZero){
            // dd($setZero->attempts);
            $setZero->attempts = 0;
            $setZero->save();
        }
    }
}
