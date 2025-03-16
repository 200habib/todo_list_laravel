<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Post extends Model
{
    use HasFactory, SoftDeletes;

    // Campi che possono essere assegnati in massa
    protected $fillable = [
        "title",
        "slug",
        "content",
    ];

    // Campi da nascondere nelle serializzazioni
    protected $hidden = [
        'deleted_at'
    ];

    // Casting automatico dei campi
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Accessors: modifica come viene letto un campo
    public function getTitleAttribute($value)
    {
        return ucfirst($value); // Prima lettera maiuscola
    }

    // Mutators: modifica come viene salvato un campo
    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = strtolower($value);
        $this->attributes['slug'] = str_replace(' ', '-', strtolower($value));
    }

    // Scopes: query predefinite
    public function scopePublished($query)
    {
        return $query->where('created_at', '<=', Carbon::now());
    }

    // Relazioni con altri modelli
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Metodi personalizzati
    public function getExcerpt($length = 100)
    {
        return substr($this->content, 0, $length) . '...';
    }

    public function isNew()
    {
        return $this->created_at->diffInDays(Carbon::now()) < 7;
    }
}
