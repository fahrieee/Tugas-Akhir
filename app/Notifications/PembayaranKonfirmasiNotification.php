<?php

namespace App\Notifications;

use App\Channels\WhacenterChannel;
use App\Services\WhacenterService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PembayaranKonfirmasiNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    private $pembayaran;
    public function __construct($pembayaran)
    {
        $this->pembayaran = $pembayaran;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database', WhacenterChannel::class];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'pembayaran_id' => $this->pembayaran->id,
            'title' => 'Konfirmasi Pembayaran',
            'messages' => 'Pembayaran Tagihan atas nama' . $this->pembayaran->tagihan->mandor->nama . ' telah dikonfirmasi.',
            'url' => route('pengawas.pembayaran.show', $this->pembayaran->id),
        ];
    }

    public function toWhacenter($notifiable)
    {
        $bulanTagihan = $this->pembayaran->tagihan->tanggal_tagihan->translatedFormat('F Y');
        return (new WhacenterService())
        ->to($notifiable->nohp)
        ->line("Assalamualikum Bapak Semoga dalam keadaan sehat selalu")
        ->line("Terima kasih sudah melakukan pembayaran atas nama" . $this->pembayaran->tagihan->mandor->nama . 
        formatRupiah($this->pembayaran->jumlah_bayar));
    }
}
