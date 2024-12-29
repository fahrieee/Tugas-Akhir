<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Casts\Attribute;


class Pembayaran extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $dates = ['tanggal_bayar', 'tanggal_konfirmasi'];
    protected $with = ['user', 'tagihan'];
    protected $append = ['status_konfirmasi'];


    public function tagihan(): BelongsTo
    {
        return $this->belongsTo(Tagihan::class);
    }


    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    
    protected function statusKonfirmasi(): Attribute
        {
            return Attribute::make(
                get: fn ($value) => ($this->tanggal_konfirmasi == null) ? 
                'Belum Dikonfirmasi' : 'Sudah Dikonfirmasi');

        }

        public function getStatusStyleAttribute()
        {
            if ($this->tanggal_konfirmasi == null) {
                return 'secondary';
            }
            return 'success';
        }

    protected static function booted(): void
    {   
        static::created(function ($pembayaran) {
            $pembayaran->tagihan->updateStatus();
        });

        static::updated(function ($pembayaran) {
            $pembayaran->tagihan->updateStatus();
        });

        static::deleted(function ($pembayaran) {
            $pembayaran->tagihan->updateStatus();
        });

        static::creating(function ($tagihan) {
            $tagihan->user_id = auth()->user()->id;
        });

        static::updating(function ($tagihan) {
            $tagihan->user_id = auth()->user()->id;
        });
    }

    /**
     * Get the user that owns the Pembayaran
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function pengawas(): BelongsTo
    {
        return $this->belongsTo(User::class, 'pengawas_id');
    }

    /**
     * Get the user that owns the Pembayaran
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function bankPerusahaan(): BelongsTo
    {
        return $this->belongsTo(BankPerusahaan::class);
    }

    
    /**
     * Get the user that owns the Pembayaran
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function pengawasBank(): BelongsTo
    {
        return $this->belongsTo(PengawasBank::class);
    }
}
