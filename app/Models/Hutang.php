<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Hutang extends Model
{
    use HasFactory;

    // Kolom yang dijaga
    protected $guarded = [];
    protected $append = ['nama_hutang_full', 'total_tagihan'];

    // Relasi dengan model User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi dengan model Hutang lainnya (biaya_id)
    public function children(): HasMany
    {
        return $this->hasMany(Hutang::class, 'biaya_id');
    }

    public function mandor()
    {
        return $this->belongsTo(Mandor::class);
    }

    // Method untuk menggabungkan nama dan jumlah dalam satu format
    protected function namaHutangFull(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $this->nama . ' - ' . $this->formatRupiah('jumlah'),
        );
    }

    // Method untuk menghitung total tagihan
    public function totalTagihan(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $this->children()->sum('jumlah'),
        );
    }

    

    // Menambahkan method search()
    public function scopeSearch($query, $searchTerm)
    {
        return $query->where('nama', 'like', '%' . $searchTerm . '%')
                     ->orWhere('jumlah', 'like', '%' . $searchTerm . '%')
                     ->orWhereHas('user', function($q) use ($searchTerm) {
                         $q->where('name', 'like', '%' . $searchTerm . '%');
                     });
    }

    // Boot method untuk menetapkan user saat membuat atau mengupdate
    protected static function booted(): void
    {
        static::creating(function ($hutang) {
            $hutang->user_id = auth()->user()->id;
        });

        static::updating(function ($hutang) {
            $hutang->user_id = auth()->user()->id;
        });
    }
}