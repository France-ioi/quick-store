<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\DataRecord;
use Hash;
use Validator;

class DataRecordController extends Controller
{


    public function read(Request $request) {
        $validator = $this->validatorRead($request);
        if($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->messages()->getMessages()
            ]);                    
        }                
        $user = User::where('prefix', $request->get('prefix'))->first();
        if(!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Prefix not found'
            ]);
        }
        $user->last_access = new \DateTime();
        $user->save();

        $rec = DataRecord::where('user_id', $user->id)->where('key', $request->get('key'))->first();
        if(!$rec) {
            return response()->json([
                'success' => false,
                'message' => 'Key not found'
            ]);
        }
        $rec->last_access = new \DateTime();
        $rec->save();
        return response()->json([
            'success' => true,
            'value' => $rec->value
        ]);        

    }


    private function validatorRead($request) {
        return Validator::make($request->all(), [
            'prefix' => 'required',
            'key' => 'required|max:'.config('data_record.key_max_length')
        ]);
    }        



    public function write(Request $request) {
        $validator = $this->validatorWrite($request);
        if($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->messages()->getMessages()
            ]);                    
        }        

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
        $user->last_access = new \DateTime();
        $user->save();

        $rec = DataRecord::updateOrCreate(
            [
                'user_id' => $user->id,
                'key' => $request->get('key')
            ],
            [
                'value' => $request->get('value'),
                'last_access' => new \DateTime()
            ]
        );

        return response()->json([
            'success' => true
        ]);        
    }    


    private function validatorWrite($request) {
        return Validator::make($request->all(), [
            'prefix' => 'required',
            'password' => 'required',
            'key' => 'required|max:'.config('data_record.key_max_length'),
            'value' => 'required|max:'.config('data_record.value_max_length'),
        ]);
    }    

}
