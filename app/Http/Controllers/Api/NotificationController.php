<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\User\UserEventsResource;
use App\Models\UserEvanet;
use App\MyHellepr\Hellper;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function GetNotification()
    {
        $user_events = UserEvanet::query()
            ->whereIn('user_id', [Hellper::apiAuth()->id, Hellper::companyId()])
            ->paginate(10);
        return [
            'notify' => UserEventsResource::collection($user_events),
            'paginate' => $user_events->total(),
        ];
    }
}
