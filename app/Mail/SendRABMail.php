<?php

namespace App\Mail;

use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendRABMail extends Mailable
{
    use Queueable, SerializesModels;

    public array $rabContent;
    public ?User $user;
    protected $pdfData;

    public function __construct(array $rabContent, ?User $user = null)
    {
        $this->rabContent = $rabContent;
        $this->user = $user;

        // Render terlebih dahulu untuk menghitung jumlah halaman
        $pdf = Pdf::loadView('PDF.rab', [
            'rab' => $this->rabContent,
            'user' => $this->user,
            'jumlah_halaman' => null // dummy dulu
        ]);

        $pdf->getDomPDF()->render();
        $jumlah_halaman = $pdf->getDomPDF()->get_canvas()->get_page_count();

        // Buat ulang view PDF dengan jumlah halaman yang benar
        $this->pdfData = Pdf::loadView('PDF.rab', [
            'rab' => $this->rabContent,
            'user' => $this->user,
            'jumlah_halaman' => $jumlah_halaman
        ])->output();

        // $this->pdfData = Pdf::loadView('pdf.rab', ['rab' => $this->rabContent])->output();
    }
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Lampiran RAB',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'email.rab-message',
            with: ['rab' => $this->rabContent]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [
            Attachment::fromData(fn() => $this->pdfData, 'Simulasi RAB Rumahgue.pdf')->withMime('application/pdf'),
        ];
    }
}
