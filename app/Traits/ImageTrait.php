<?php

namespace App\Traits;

use Illuminate\Http\Request;


Trait ImageTrait{
    
    public function verifyAndUpload(Request $request, $fieldName = 'img', $directory = 'images'){
        if($request->hasFile($fieldName)){
            if(!$request->file($fieldName)->isValid()){
                flash('Invalid Image!')->error()->important();
                return redirect()->back()->withInput();
            }
            $path = $request->file('img')->store('temp');
            $file = $request->file('img');
            $fileName = $file->getClientOriginalName();
            // $fileName = strval($request->username) .  $fileName;
            $file->move(public_path('images'), $fileName);
            // return $request->file($fieldName)->store($directory,'public');
            return $fileName;
        }
        return null;
    }
}