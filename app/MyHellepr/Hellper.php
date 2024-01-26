<?php


namespace App\MyHellepr;


use App\Events\MailProcessed;
use App\Events\SendMailEvent;
use App\Http\Resources\User\UserResource;
use App\Jobs\UserEventJob;
use App\Mail\UserEventMail;
use App\Models\User;
use App\Models\UserEvanet;
use Carbon\Carbon;
use Event;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use phpDocumentor\Reflection\Types\Self_;

class Hellper
{
    public static function upload($file, $path)
    {
        if (!$file) {
            return null;
        }
        $extension = $file->getClientOriginalExtension();
        $name = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $data_name = md5($name.microtime());
        $data = $data_name.'.'.$extension;
        $res = $file->move($path, $data);

        if (!$res) {
            return null;
        }

        return $data;
    }

    public static function uploadUrlAndSave($file, $userId)
    {

        //todo path@ choraca
        if (!$file) {
            return null;
        }
        $f = finfo_open();
        $mime_type = finfo_buffer($f, file_get_contents($file), FILEINFO_MIME_TYPE);
        $type = array_reverse(explode('/',$mime_type))[0];

        $random = Str::random(40);

//
        if (!is_dir(storage_path("/app/public/users/" . $userId . "/product/zip"))) {
            if(!is_dir(storage_path("/app/public/users"))) {
                File::makeDirectory(storage_path("app/public/users"));
            }
            if (!is_dir(storage_path("app/public/users/" . $userId))) {
                File::makeDirectory(storage_path("app/public/users/" . $userId));
            }
            if (!is_dir(storage_path("app/public/users/" . $userId . '/product'))) {
                File::makeDirectory(storage_path("app/public/users/" . $userId . '/product'));
            }
            File::makeDirectory(storage_path("app/public/users/" . $userId . "/product/zip"));
        }
        $path = 'storage/users/'.$userId.'/product/zip/'.$random.'.'.$type;
        $res = file_put_contents($path, file_get_contents($file));

        if (!$res) {
            return null;
        }

        return $path;
    }

    public static function base64($base64fileString, $path, $typeFile, $userId = null)
    {
        if (!$userId){
            $userId = self::companyId();
        }

        if (!$base64fileString) {
            return null;
        }
        $random = Str::random(40);
        $f = finfo_open();

        $fileKay = 1;
        if ($typeFile === 'image'){
            $mime_type = finfo_buffer($f, base64_decode(explode(',',$base64fileString)[1]), FILEINFO_MIME_TYPE);
        }elseif ($typeFile === 'zip'){
            $mime_type = finfo_buffer($f, base64_decode($base64fileString), FILEINFO_MIME_TYPE);
        }elseif ($typeFile === 'pdf'){
            $fileKay = 0;
            $mime_type = finfo_buffer($f, base64_decode(explode(',',$base64fileString)[$fileKay]), FILEINFO_MIME_TYPE);
        }

        $type = explode('/',$mime_type);

        if (!is_dir(storage_path("/app/public/users/" . $userId . "/" . $path))) {
            if(!is_dir(storage_path("/app/public/users"))) {
                File::makeDirectory(storage_path("app/public/users"));
            }
            if (!is_dir(storage_path("app/public/users/" . $userId))) {
                File::makeDirectory(storage_path("app/public/users/" . $userId));
            }
            File::makeDirectory(storage_path("app/public/users/" . $userId . "/" . $path));
        }

        file_put_contents(storage_path('app/public/users/'.$userId.'/'.$path.'/'.$random.'.'.$type[1]),print_r(base64_decode(explode(',',$base64fileString)[$fileKay]),true));
        $req = 'storage/users/'.$userId.'/'.$path.'/'.$random.'.'.$type[1];

        if (!$req) {
            return null;
        }

        return $req;
    }

    public static function apiAuth($company = false)
    {
        if ($company){
            $user = User::query()->findOrFail(self::companyId());
        }else{
            $user = \Auth::guard('api')->user();
        }
        return $user;
    }

    public static function userWithId($id)
    {
        $user = User::query()->findOrFail($id);

        $data = [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'path' => $user->path ?? 'assets/custom/img/default-avatar.png',
        ];

        return $data;
    }



    public static function filterUser($user){

        if (!$user){
            return "oops no user";
        }
        if (is_numeric($user)){
            $user = User::findOrFail($user);
        }
//        $output = [
//          'id' => $user->id,
//          'name' => $user->name,
//          'email' => $user->email,
//          'path' => $user->path ?? 'assets/custom/img/default-avatar.png',
//          'company' => $user->company,
//          'blocked' => $user->blocked,
//          'info' => $user->info,
//          'rating' => self::rating($user->id),
//        ];

        $output = self::filterUserResource($user->id);

        return $output;
    }



    public static function companyId(){
        $authUser = Hellper::apiAuth();
//        $authUser = User::findOrFail(3);

        if ($authUser->company != 0 && ($authUser->company_id == null || $authUser->company_id == 0)){
            $company_id = $authUser->id;
        }else{
            $company_id =  $authUser->company_id;
        }
        return $company_id;
    }

    public static function filterUserResource($id){

        $user = User::query()->findOrFail($id)->load('ratingCompany');
        $count = $user->ratingCompany->count();
        $positiveFeedback = 0;
        if ($count){
            $rating_payment_process = $user->ratingCompany->sum('rating_payment_process') / $count;
            $rating_overall_experience = $user->ratingCompany->sum('rating_overall_experience') / $count;
            $rating_communication = $user->ratingCompany->sum('rating_communication') / $count;

            $positiveSum = ($rating_payment_process + $rating_overall_experience + $rating_communication) / 3;

            $positiveFeedback = ($positiveSum * 100) / 5;
        }

        $output = [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'path' => $user->path  ?? 'assets/custom/img/default-avatar.png',
            'percent_feedback' => $positiveFeedback,
            'company' => $user->company,
            'blocked' => $user->blocked,
            'info' => $user->info,
            'created_at' => Carbon::parse($user->created_at)->format('Y'),
            'rating' => self::rating($user->id, true)['rating'],
        ];

        return $output;
    }



    public static function userEvent($senEmail = true, $user_id, $type, $additional, $action, $long_text = null, $dataMail = null, $button = 0, $status = null)
    {
//        dd($senEmail, $user_id, $type, $additional_id, $action, $long_text, $status);
        if (!in_array(null, [$user_id, $type, $additional, $action])){
            $eventUser = new UserEvanet();
            $eventUser->user_id = $user_id;
            $eventUser->type = $type;
            $eventUser->additional = get_class($additional); // what is the model
            $eventUser->additional_id = $additional->id; // what is the model id
            $eventUser->action = $action; // small text notification
            $eventUser->long_text = null; //$long_text long text or json
            $eventUser->send_mail = $senEmail;
            $eventUser->is_read = 0;
            $eventUser->status = $status;
            $eventUser->save();
        }


        if ($senEmail){
            $userEmail = User::query()->findOrFail($user_id);
            $data = [
                'type' => $eventUser->type,
                'company_name' => $userEmail->name,
                'data' => $dataMail,
                'button' => $button,
                'action' => $action,
                'email' => $userEmail->email,
//                'email' => 'david656558a@gmail.com',
            ];



//            \Artisan::call('queue:work --once');
//            dispatch(new UserEventJob($data)); // todo esika 05.06.2023

//            UserEventJob::dispatch($data);
//            \Artisan::call('queue:work --once');


//            Event::dispatch(new SendMailEvent($data));
//            event(new SendMailEvent($data));
//            dispatch(new UserEventJob($data)); //->delay(5)
//            Mail::queue(HellperMail::sendMailEventUser($data,'User Event Mail'));
            $model = new UserEventMail($data);
            Mail::to($data['email'])->send($model);
        }
    }


    public static function rating($id = null, $ratingData = null)
    {
        if ($id){
            $user =  $user = User::findOrFail($id)->load('ratingCompany');
        }else{
            $user =  $user = User::findOrFail(Hellper::companyId())->load('ratingCompany');
        }

        if (!empty($user->ratingCompany->toArray())){
            $count = $user->ratingCompany->count();
            $feed_back = $user->ratingCompany->map(function ($q){
                $out = [
                    'user_name' => User::findOrFail($q->user_id)->name,
                    'feed_back' => $q->feed_back,
                    'rating_payment_process' => $q->rating_payment_process,
                    'rating_overall_experience' => $q->rating_overall_experience,
                    'rating_communication' => $q->rating_communication,
                    'created_at' => $q->created_at,
                ];
                return $out;
            })->toArray();
            $rating_payment_process = $user->ratingCompany->sum('rating_payment_process') / $count;
            $rating_overall_experience = $user->ratingCompany->sum('rating_overall_experience') / $count;
            $rating_communication = $user->ratingCompany->sum('rating_communication') / $count;

            $positiveSum = ($rating_payment_process + $rating_overall_experience + $rating_communication) / 3;

            $positiveFeedback = ($positiveSum * 100) / 5;

            if ($ratingData){
                $output = [
                    'rating_percent_feedback' => number_format($positiveFeedback, 3, '.', ""),
                    'rating_payment_process' => $rating_payment_process,
                    'rating_overall_experience' => $rating_overall_experience,
                    'rating_communication' => $rating_communication,
                    'rating' => number_format(($rating_communication + $rating_payment_process + $rating_overall_experience) / 3, 3, '.', ""),
                    'feedback' => $feed_back,
                ];
            }else{
                $output = [
                    'rating_percent_feedback' => number_format($positiveFeedback, 3, '.', ""),
                    'rating_payment_process' => $rating_payment_process,
                    'rating_overall_experience' => $rating_overall_experience,
                    'rating_communication' => $rating_communication,
                    'rating' => number_format(($rating_communication + $rating_payment_process + $rating_overall_experience) / 3, 3, '.', ""),
                    'company' => new UserResource($user),
                    'feedback' => $feed_back,
                ];
            }

            return [
              'status' => true,
              'rating' => $output,
            ];
        }

        return [
            'status' => false,
            'rating' => [],
        ];



    }


}




//------------------------------------------------ file save ------------------------------------------------

//crete
//


//$path = storage_path('app' . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR . 'logo' . DIRECTORY_SEPARATOR);
//$ss =  Hellper::upload($request->logo, $path);
//$image = "/storage/logo/" . $ss;


//

// edit
//if (isset($request['portfolio']) || isset($request['articles']) || isset($request['cv'])){
//
//    $path = storage_path('app' . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR . 'logo' . DIRECTORY_SEPARATOR);
//
//
//		$fileRequest = [
//        'portfolio' => isset($request['portfolio']) ? $request['portfolio'] : null,
//        'articles' => isset($request['articles']) ? $request['articles'] : null,
//        'cv' => isset($request['cv']) ? $request['cv'] : null,
//    ];
//
//    foreach ($fileRequest as $key => $item){
//        if ($item != null){
//            $fileQuery = $cv->file->where('status', $key)->first();
//
//            $productImage = str_replace('/storage', '', $fileQuery->path);
//            Storage::delete('/public' . $productImage);
//
//            StudentCvFiles::findOrFail($fileQuery->id)->delete();
//
//            $name = Hellper::fileName($item);
//            $nameMD5 =  Hellper::upload($item, $path);
//            $file = "/storage/logo/" . $nameMD5;
//
//            $cvFile = new StudentCvFiles();
//            $cvFile->student_cv_id = $cv->id;
//            $cvFile->path = $file;
//            $cvFile->name = (string)$name;
//            $cvFile->status = $key;
//            $cvFile->save();
//        }
//    }
//}
