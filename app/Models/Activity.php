<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Activity extends Model
{
    use HasFactory;

    protected $fillable = [
        'admin_id','module','action','ip','navigator','pays','codepays','url',
    ];

    public function admin() {
        return $this->belongsTo(Admin::class, 'admin_id');
    }

    public static function saveActivity($module, $action){
        $activity['admin_id'] 	= Auth::user()->id;
        $activity['ip']		 	= (isset($_SERVER['REMOTE_ADDR'])) ? $_SERVER['REMOTE_ADDR'] : '' ;

        $agent = (isset($_SERVER['HTTP_USER_AGENT'])) ? $_SERVER['HTTP_USER_AGENT'] : '';

        // Detect Device/Operating System
        if(preg_match('/Linux/i',$agent)) $os = 'Linux';
        elseif(preg_match('/Mac/i',$agent)) $os = 'Mac'; 
        elseif(preg_match('/iPhone/i',$agent)) $os = 'iPhone'; 
        elseif(preg_match('/iPad/i',$agent)) $os = 'iPad'; 
        elseif(preg_match('/Droid/i',$agent)) $os = 'Droid'; 
        elseif(preg_match('/Unix/i',$agent)) $os = 'Unix'; 
        elseif(preg_match('/Windows/i',$agent)) $os = 'Windows';
        else $os = 'Unknown';

        // Browser Detection
        if(preg_match('/Firefox/i',$agent)) $br = 'Firefox'; 
        elseif(preg_match('/Mac/i',$agent)) $br = 'Mac';
        elseif(preg_match('/Chrome/i',$agent)) $br = 'Chrome'; 
        elseif(preg_match('/Opera/i',$agent)) $br = 'Opera'; 
        elseif(preg_match('/MSIE/i',$agent)) $br = 'IE'; 
        else $br = 'Unknown';
        setlocale(LC_TIME, 'fr_FR.utf8','fra');
        $activity['navigator']  = $br.'/'.$os;
        $activity['module']		= $module;
        $activity['action']		= $action;
        $activity['pays']		= (isset($_SERVER['GEOIP_COUNTRY_NAME'])) ? $_SERVER['GEOIP_COUNTRY_NAME'] : '' ;
        $activity['codepays']	= (isset($_SERVER['GEOIP_COUNTRY_CODE'])) ? $_SERVER['GEOIP_COUNTRY_CODE'] : '' ;
        $activity['url']		= (isset($_SERVER['SCRIPT_URI'])) ? $_SERVER['SCRIPT_URI'] : '' ;
                
        self::create($activity);
    }
}
