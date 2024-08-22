<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Address;

class PostUserRegisterCompliteMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $email;
    protected $uuid;
    protected $project_name;
    protected $name;

    public function __construct($email, $uuid, $project_name, $name)
    {
        $this->email = $email;
        $this->uuid = $uuid;
        $this->project_name = $project_name;
        $this->name = $name;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address('postmaster@proofsheet.jp', 'Proofsheet管理者'),
            subject: 'アカウント登録完了のお知らせ | ' . $this->project_name,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'postuser.mail.account.editComplete',
            with: [
                'email' => $this->email,
                'uuid' => $this->uuid,
                'project_name' => $this->project_name,
                'name' => $this->name,
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
