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
                if(trim($rec->value) != '') {
                    $rec->last_access = new \DateTime();
                    $rec->save();
                }
            } else {
                $rec->delete();
            }
        }

        $new_values = $request->get('new_values');
        $new_keys = $request->get('new_keys');
        $keys_created = [];
        if(is_array($new_values)) {
            for($i=0; $i<count($new_values); $i++) {
                if(trim($new_values[$i]) == '' || trim($new_keys[$i]) == '' || isset($keys_created[$new_keys[$i]])) {
                    continue;
                }
                $keys_created[$new_keys[$i]] = true;
                DataRecord::create([
                    'user_id' => $user->id,
                    'key' => $new_keys[$i],
                    'value' => $new_values[$i],
                    'last_access' => new \DateTime()
                ]);
            }
        }
        return redirect()->back()->with([
            'success' => true
        ]);
    }


    private function getUser($request) {
        $user = $request->session()->get('user');
        $user = User::find($user['id']);
        if($user) {
            $user->last_access = new \DateTime();
            $user->save();            
            return $user;
        }
        abort(403);
    }


    private function getRecords($user) {
        return $user->dataRecords()->orderBy('last_access')->get();
    }
    
}