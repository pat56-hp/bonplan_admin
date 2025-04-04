<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Etablissement extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'libelle', 'ville', 'adresse', 'email', 'phone', 'image', 'client_id', 'category_id', 'facebook', 'instagram', 'status', 'description', 'longitude', 'latitude', 'validate', 'created_by'
    ];

    protected $appends = ['open', 'note'];

    protected $hidden = [
        'updated_at'
    ];

    public function client(){
        return $this->belongsTo(Client::class, 'client_id', 'id');
    }

    public function category(){
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function galleries(){
        return $this->morphMany(Gallery::class, 'galleryable');
    }

    public function commodites(){
        return $this->belongsToMany(Commodite::class, 'etablissement_commodites', 'etablissement_id', 'commodite_id');
    }

    public function jours(){
        return $this->belongsToMany(Jour::class, 'horaires', 'etablissement_id', 'jour_id')->withPivot(['ouverture', 'fermeture']);
    }

    /**
     * Renvoie le nom du proprietaire de l'etablissement
     */
    public function getClientNameAttribute(){
        return ucwords(($this->client->name ?? 'Introuvable').' '.($this->client->lastname ?? ''));
    }

    /**
     * Renvoie le libelle de la categorie
     */
    public function getCategoryLabelAttribute(){
        return ucfirst($this->category->libelle ?? 'Introuvable');
    }

    /**
     * Verifie si l'etablissement est ouvert ou non
     */
    public function getOpenAttribute(){
        $now = Carbon::now();
        $jours = $this->jours;

        $dayOfWeek = $now->dayOfWeek;
        //return $dayOfWeek;

        //Verifie si le jour fait parti des horaires
        if (in_array($dayOfWeek, $jours->pluck('id')->toArray())) {
            $jour = $jours->where('id', $dayOfWeek)->first();

            if (!empty($jour)) {
                $horaire = $jour->pivot;
                $currentHour = $now->format('H:i:s');

                if($horaire['ouverture'] == '00:00:00' && $horaire['fermeture'] == '00:00:00') {
                    return true;
                }elseif ($horaire['ouverture'] <= $currentHour && $horaire['fermeture'] >= $currentHour) {
                    return true;
                } elseif ($horaire['ouverture'] <= $currentHour && $horaire['fermeture'] < $horaire['ouverture']) {
                    return true;
                } elseif ($horaire['ouverture'] > $horaire['fermeture'] && ($currentHour >= $horaire['ouverture'] || $currentHour <= $horaire['fermeture'])) {
                    return true;
                }
            }
        }

        return false;
    }

    public function getNoteAttribute(): int{
        $note = 0;
        $totalCommentaire = $this->commentaires->count();
        $totalNote = $this->commentaires->sum('note');

        if ($totalCommentaire > 0) {
            $note =  $totalNote / (float) $totalCommentaire;
            $note = number_format($note, 2, '.', ' ');
        }

        return $note;
    }

    //Renvoie l'heure d'ouverture pour le jour donné
    public function getOuverture(string $jourId){
        return $this->jours()->where('jour_id', $jourId)->first()?->pivot?->ouverture;
    }

    //Renvoie l'heure de fermeture pour le jour donné
    public function getFermeture(string $jourId){
        return $this->jours()->where('jour_id', $jourId)->first()?->pivot?->fermeture;
    }
}
