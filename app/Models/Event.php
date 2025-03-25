<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'user_id',
        'category_id',
        'country_id',
        'whatsapp_country_id',
        'title',
        'organisateur',
        'ville',
        'commune',
        'adresse',
        'map',
        'site',
        'debut',
        'fin',
        'heure_debut',
        'heure_fin',
        'phone',
        'email',
        'whatsapp',
        'description',
        'phone_country_id',
        'facebook',
        'instagram',
        'tweeter',
        'status',
        'validated',
        'created_by',
        'validated_by',
    ];

    use HasFactory;

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function categorie(){
        return $this->belongsTo(EventCategory::class, 'category_id');
    }


    public function galleries(){
        return $this->morphMany(Gallery::class, 'galleryable');
    }
}
