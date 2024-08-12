<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Address;

class PrePostUserTokenMail extends Mailable
{

    use Queueable, SerializesModels;


    protected $email;
    protected $uuid;
    protected $token;
    protected $project_name;

    public function __construct($email, $uuid, $token, $project_name)
    {
        $this->email = $email;
        $this->uuid = $uuid;
        $this->token = $token;
        $this->project_name = $project_name;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address('postmaster@proofsheet.jp', 'Proofsheet管理者'),
            subject: 'メールアドレスの確認 | ' . $this->project_name,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'postuser.mail.verifymail',
            with: [
                'email' => $this->email,
                'uuid' => $this->uuid,
                'token' => $this->token,
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
