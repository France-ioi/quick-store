<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\DataRecord;
use Hash;

class DataRecordController extends Controller
{


    public function read(Request $request) {
        $user = User::where('prefix', $request->get('prefix'))->first();
        if(!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Prefix not found'
            ]);
        }
        $rec = DataRecord::where('user_id', $user->id)->where('key', $request->get('key'))->first();
        if(!$rec) {
            return response()->json([
                'success' => false,
                'message' => 'Key not found'
            ]);
        }
        return response()->json([
            'success' => true,
            'value' => $rec->value
        ]);        

    }



    public function write(Request $request) {
        $user = User::where('prefix', $request->get('prefix'))->first();
        if(!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Prefix not found'
            ]);
        }        
        if(!Hash::check($request->password, $user->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Wrong password'
            ]);            
        }

        $rec = DataRecord::updateOrCreate(
            [
                'user_id' => $user->id,
                'key' => $request->get('key')
            ],
            [
                'value' => $request->get('value')
            ]
        );
        return response()->json([
            'success' => true
        ]);        
    }    

}
