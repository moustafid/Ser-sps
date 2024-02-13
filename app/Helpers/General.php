<?php

use App\LycSituation;
use App\MoySituation;
use Illuminate\Support\Facades\Config;
use app\Receptions;
use app\Situation;
use Spatie\Permission\Models\Role;


function get_languages(){

    return \App\Models\Language::active() -> Selection() -> get();
}

function get_default_lang(){
  return   Config::get('app.locale');
}
function getBeginAttribute($id)
{
    $receptions = Receptions::where('id', $id)->first();
    return Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $receptions->reception_date)->locale('ar_DZ')->isoFormat('LLLL');
}
function getTimeAttribute()
{
    return Carbon\Carbon::now()->toDateString();
}
function getRoleName($id){
    $role = Role::find($id);
    return $role->name;
}

function SituationSumValue($column){
    $sum = Situation::sum($column);
    return $sum;
}

function SituationMoySumValue($column){
    $sum = MoySituation::sum($column);
    return $sum;
}

function SituationLycSumValue($column){
    $sum = LycSituation::sum($column);
    return $sum;
}
function setPhoneMobileAttribute($phone)
{
    // Strip all but numbers
    /* $this->attributes['phone_mobile'] =  */echo trim(preg_replace('/^1|\D/', "", $phone));
}

function getPhoneMobileAttribute($phoneNumber)
{
    if ($phoneNumber) {
        $output = substr($phoneNumber, 0, 3) . '-' . substr($phoneNumber, 3, 2) . '-' . substr($phoneNumber, 5, 2) . '-' . substr($phoneNumber, 7, 2);

        return $output;
    }
}

function uploadImage($folder, $image)
{
    $image->store('/', $folder);
    $filename = $image->hashName();
    $path = 'images/' . $folder . '/' . $filename;
    return $path;
}



function uploadVideo($folder, $video)
{
    $video->store('/', $folder);
    $filename = $video->hashName();
    $path = 'video/' . $folder . '/' . $filename;
    return $path;
}


