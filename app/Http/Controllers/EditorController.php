<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\DataRecord;

class EditorController extends Controller
{
    
    public function index(Request $request) {
        $user = $this->getUser($request);
        return view('editor.index', [
            'prefix' => $user->prefix,
            'rows' => $this->getRecords($user)
        ]);
    }

    public function update(Request $request) {
        $user = $this->getUser($request);
        $records = $this->getRecords($user);

        $values = $request->get('values');

        foreach($records as $rec) {
            if(isset($values[$rec->id])) {
                $rec->value = $values[$rec->id];
                if(trim($rec->value) !== '') {
                    $rec->save();
                }
            } else {
                $rec->delete();
            }
        }

        $new_values = $request->get('new_values');
        $new_keys = $request->get('new_keys');
        if(is_array($new_values)) {
            for($i=0; $i<count($new_values); $i++) {
                if(trim($new_values[$i]) != '' && trim($new_keys[$i]) != '') {
                    DataRecord::create([
                        'user_id' => $user->id,
                        'key' => $new_keys[$i],
                        'value' => $new_values[$i]
                    ]);
                }
            }
        }
        return redirect()->back()->with([
            'success' => true
        ]);
    }


    private function getUser($request) {
        $user = $request->session()->get('user');
        if($user) {
            return User::find($user['id']);
        }
        abort(403);
    }


    private function getRecords($user) {
        return $user->dataRecords()->orderBy('created_at')->get();
    }
    
}