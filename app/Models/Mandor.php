<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Nicolaslopezj\Searchable\SearchableTrait;
use Spatie\ModelStatus\HasStatuses;

class Mandor extends Model
{
    use HasFactory;
    use SearchableTrait;
    use HasStatuses;
    protected $guarded = [];
    protected $searchable = [
        'columns' => [
            'nama' => 10,
            'kategori' => 10,
            'periode' => 10,
            
        ],
    ];


    /**
     * Get all of the comments for the Mandor
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function hutang(): BelongsTo
    {
        return $this->belongsTo(Hutang::class);
    }

 

    /**
     * Get the user that owns the Proyek
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    
    public function pengawas(): BelongsTo
    {
        return $this->belongsTo(User::class, 'pengawas_id');
    }

    /**
     * Get all of the comments for the Mandor
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tagihan(): HasMany
    {
        return $this->hasMany(Tagihan::class, 'mandor_id');
    }

     /**
     * The "booted" method of the model.
     */
    protected static function booted(): void
    {   
        static::creating(function ($mandor) {
            $mandor->user_id = auth()->user()->id;
        });

        static::created(function ($mandor) {
            $mandor->setStatus('aktif');
        });

        static::updating(function ($mandor) {
            $mandor->user_id = auth()->user()->id;
        });
    }
}
