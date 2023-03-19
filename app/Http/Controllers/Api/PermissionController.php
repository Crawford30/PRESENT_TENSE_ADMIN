<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\CreateAudioDVDPermissionRequest;
use App\Http\Requests\User\CreateVideoDVDPermissionRequest;
use Illuminate\Http\Request;

class PermissionController extends Controller
{


    public function createAudioDVDPermission(CreateAudioDVDPermissionRequest $request)
    {
        return $request->save();
    }


    public function createVideoDVDPermission(CreateVideoDVDPermissionRequest $request)
    {
        return $request->save();
    }
}
