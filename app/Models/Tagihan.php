<?php

namespace App\Models;

use App\Traits\HasFormatRupiah;
use Auth;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Nicolaslopezj\Searchable\SearchableTrait;

class Tagihan extends Model
{
    use HasFactory;
    use HasFormatRupiah;
    use SearchableTrait;

    protected $guarded = [];
    protected $dates = ['tanggal_tagihan', 'tanggal_jatuh_tempo', 'tanggal_lunas'];
    protected $with = ['user', 'mandor', 'tagihanDetails'];
    protected $append = ['total_tagihan', 'total_pembayaran',];

    
    public function getStatusStyleAttribute()
    {
        if ($this->status == 'lunas') {
            return 'success';
        }

        if ($this->status == 'angsur') {
            return 'warning';
        }

        if ($this->status == 'baru') {
            return 'primary';
        }
        
    }

    protected $searchable = [
        'columns' => [
            'mandors.nama' => 10,
        ],
        'joins' => [
            'mandors' => ['mandors.id','tagihans.mandor_id'],
        ],
    ];

    public function totalPembayaran(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $this->pembayaran()->sum('jumlah_bayar'),
        );
    }

    public function totalTagihan(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $this->tagihanDetails()->sum('jumlah_hutang'),
        );
    }

    /**
     * Get the user that owns the Tagihan
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the user that owns the Tagihan
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function mandor(): BelongsTo
    {
        return $this->belongsTo(Mandor::class, 'mandor_id')->withDefault([
            'nama' => 'Belum ada Mandor'
        ]);
    }

    /**
     * Get all of the comments for the Tagihan
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tagihanDetails(): HasMany
    {
        return $this->hasMany(TagihanDetail::class);
    }

/**
     * Get all of the comments for the Tagihan
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pembayaran(): HasMany
    {
        return $this->hasMany(Pembayaran::class);
    }
 

    public function getStatusTagihanPengawas()
    {
        if ($this->status == 'baru') {
            return 'Belum dibayar';
        }
        if ($this->status == 'lunas'){
            return 'Sudah dibayar';
        }
        return $this->status;
    }

    public function scopePengawasMandor($q)
    {
        return $q->whereIn('mandor_id', Auth::user()->getAllMandorId());
    }

    public function updateStatus()
    {
        if ($this->total_pembayaran >= $this->total_tagihan) {
            $tanggalBayar = $this->pembayaran()
                ->orderBy('tanggal_bayar', 'desc')
                ->first()
                ->tanggal_bayar;
            $this->update([
                'status'=> 'lunas',
                'tanggal_lunas' => $tanggalBayar,
            ]);
        }

        if ($this->total_pembayaran > 0 && $this->total_pembayaran < $this->total_tagihan) {
            $this->update(['status' => 'angsur', 'tanggal_lunas' => null]);
        }

        if ($this->total_pembayaran <= 0) {
            $this->update(['status' => 'baru', 'tanggal_lunas' => null]);
        }
    }


    protected static function booted(): void
    {   
        static::creating(function ($tagihan) {
            $tagihan->user_id = auth()->user()->id;
        });

        static::updating(function ($tagihan) {
            $tagihan->user_id = auth()->user()->id;
        });
    }
}
