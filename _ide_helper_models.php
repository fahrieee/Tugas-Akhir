<?php

// @formatter:off
// phpcs:ignoreFile
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * Bank Model.
 *
 * @property int $id
 * @property string $sandi_bank
 * @property string $nama_bank
 * @method static \Illuminate\Database\Eloquent\Builder|Bank newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Bank newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Bank query()
 * @method static \Illuminate\Database\Eloquent\Builder|Bank whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bank whereNamaBank($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bank whereSandiBank($value)
 */
	class Bank extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\BankPerusahaan
 *
 * @property int $id
 * @property string $kode
 * @property string $nama_bank
 * @property string $nama_rekening
 * @property string $nomor_rekening
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\BankPerusahaanFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|BankPerusahaan newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BankPerusahaan newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BankPerusahaan query()
 * @method static \Illuminate\Database\Eloquent\Builder|BankPerusahaan whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BankPerusahaan whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BankPerusahaan whereKode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BankPerusahaan whereNamaBank($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BankPerusahaan whereNamaRekening($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BankPerusahaan whereNomorRekening($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BankPerusahaan whereUpdatedAt($value)
 */
	class BankPerusahaan extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Hutang
 *
 * @property int $id
 * @property int|null $biaya_id
 * @property string $nama
 * @property int $jumlah
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Hutang> $children
 * @property-read int|null $children_count
 * @property-read mixed $nama_hutang_full
 * @property-read mixed $total_tagihan
 * @property-read \App\Models\User|null $user
 * @method static \Database\Factories\HutangFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Hutang newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Hutang newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Hutang query()
 * @method static \Illuminate\Database\Eloquent\Builder|Hutang search($searchTerm)
 * @method static \Illuminate\Database\Eloquent\Builder|Hutang whereBiayaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Hutang whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Hutang whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Hutang whereJumlah($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Hutang whereNama($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Hutang whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Hutang whereUserId($value)
 */
	class Hutang extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Mandor
 *
 * @property int $id
 * @property int|null $pengawas_id
 * @property string|null $pengawas_status
 * @property string $nama
 * @property string $kategori
 * @property int $periode
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $hutang_id
 * @property-read \App\Models\Hutang|null $hutang
 * @property-read \App\Models\User|null $pengawas
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\ModelStatus\Status> $statuses
 * @property-read int|null $statuses_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Tagihan> $tagihan
 * @property-read int|null $tagihan_count
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|Mandor currentStatus(...$names)
 * @method static \Database\Factories\MandorFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Mandor newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Mandor newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Mandor otherCurrentStatus(...$names)
 * @method static \Illuminate\Database\Eloquent\Builder|Mandor query()
 * @method static \Illuminate\Database\Eloquent\Builder|Mandor search($search, $threshold = null, $entireText = false, $entireTextOnly = false)
 * @method static \Illuminate\Database\Eloquent\Builder|Mandor searchRestricted($search, $restriction, $threshold = null, $entireText = false, $entireTextOnly = false)
 * @method static \Illuminate\Database\Eloquent\Builder|Mandor whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Mandor whereHutangId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Mandor whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Mandor whereKategori($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Mandor whereNama($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Mandor wherePengawasId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Mandor wherePengawasStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Mandor wherePeriode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Mandor whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Mandor whereUserId($value)
 */
	class Mandor extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Pembayaran
 *
 * @property int $id
 * @property int|null $bank_perusahaan_id
 * @property int|null $pengawas_bank_id
 * @property int $tagihan_id
 * @property int $pengawas_id
 * @property \Illuminate\Support\Carbon $tanggal_bayar
 * @property \Illuminate\Support\Carbon|null $tanggal_konfirmasi
 * @property float $jumlah_bayar
 * @property string|null $bukti_bayar
 * @property string $metode_pembayaran
 * @property int|null $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\BankPerusahaan|null $bankPerusahaan
 * @property-read mixed $status_style
 * @property-read \App\Models\User|null $pengawas
 * @property-read \App\Models\PengawasBank|null $pengawasBank
 * @property-read mixed $status_konfirmasi
 * @property-read \App\Models\Tagihan|null $tagihan
 * @property-read \App\Models\User|null $user
 * @method static \Database\Factories\PembayaranFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Pembayaran newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Pembayaran newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Pembayaran query()
 * @method static \Illuminate\Database\Eloquent\Builder|Pembayaran whereBankPerusahaanId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pembayaran whereBuktiBayar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pembayaran whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pembayaran whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pembayaran whereJumlahBayar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pembayaran whereMetodePembayaran($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pembayaran wherePengawasBankId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pembayaran wherePengawasId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pembayaran whereTagihanId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pembayaran whereTanggalBayar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pembayaran whereTanggalKonfirmasi($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pembayaran whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pembayaran whereUserId($value)
 */
	class Pembayaran extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\PengawasBank
 *
 * @property int $id
 * @property int $pengawas_id pengawas id adalah primary key di userid
 * @property string $kode
 * @property string $nama_bank
 * @property string $nama_rekening
 * @property string $nomor_rekening
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $nama_bank_full
 * @method static \Database\Factories\PengawasBankFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|PengawasBank newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PengawasBank newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PengawasBank query()
 * @method static \Illuminate\Database\Eloquent\Builder|PengawasBank whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PengawasBank whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PengawasBank whereKode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PengawasBank whereNamaBank($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PengawasBank whereNamaRekening($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PengawasBank whereNomorRekening($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PengawasBank wherePengawasId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PengawasBank whereUpdatedAt($value)
 */
	class PengawasBank extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Tagihan
 *
 * @property int $id
 * @property int $mandor_id
 * @property int $user_id
 * @property int|null $periode
 * @property string|null $kategori
 * @property \Illuminate\Support\Carbon $tanggal_tagihan
 * @property \Illuminate\Support\Carbon|null $tanggal_lunas
 * @property \Illuminate\Support\Carbon $tanggal_jatuh_tempo
 * @property string|null $keterangan
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $status_style
 * @property-read \App\Models\Mandor|null $mandor
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Pembayaran> $pembayaran
 * @property-read int|null $pembayaran_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\TagihanDetail> $tagihanDetails
 * @property-read int|null $tagihan_details_count
 * @property-read mixed $total_pembayaran
 * @property-read mixed $total_tagihan
 * @property-read \App\Models\User|null $user
 * @method static \Database\Factories\TagihanFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Tagihan newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Tagihan newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Tagihan pengawasMandor()
 * @method static \Illuminate\Database\Eloquent\Builder|Tagihan query()
 * @method static \Illuminate\Database\Eloquent\Builder|Tagihan search($search, $threshold = null, $entireText = false, $entireTextOnly = false)
 * @method static \Illuminate\Database\Eloquent\Builder|Tagihan searchRestricted($search, $restriction, $threshold = null, $entireText = false, $entireTextOnly = false)
 * @method static \Illuminate\Database\Eloquent\Builder|Tagihan whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tagihan whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tagihan whereKategori($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tagihan whereKeterangan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tagihan whereMandorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tagihan wherePeriode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tagihan whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tagihan whereTanggalJatuhTempo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tagihan whereTanggalLunas($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tagihan whereTanggalTagihan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tagihan whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tagihan whereUserId($value)
 */
	class Tagihan extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\TagihanDetail
 *
 * @property int $id
 * @property int $tagihan_id
 * @property string $nama_hutang
 * @property int $jumlah_hutang
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\TagihanDetailFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|TagihanDetail newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TagihanDetail newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TagihanDetail query()
 * @method static \Illuminate\Database\Eloquent\Builder|TagihanDetail whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TagihanDetail whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TagihanDetail whereJumlahHutang($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TagihanDetail whereNamaHutang($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TagihanDetail whereTagihanId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TagihanDetail whereUpdatedAt($value)
 */
	class TagihanDetail extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @property int $id
 * @property string $akses
 * @property string $name
 * @property string|null $nohp
 * @property string|null $nohp_verified_at
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Mandor> $mandor
 * @property-read int|null $mandor_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Sanctum\PersonalAccessToken> $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User pengawas()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User search($searchTerm)
 * @method static \Illuminate\Database\Eloquent\Builder|User searchRestricted($search, $restriction, $threshold = null, $entireText = false, $entireTextOnly = false)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereAkses($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereNohp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereNohpVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}

