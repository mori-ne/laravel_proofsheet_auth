<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Address;

class PostUserEditPasswordMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $project_name;
    protected $email;
    protected $uuid;

    public function __construct($project_name, $email, $uuid)
    {
        $this->project_name = $project_name;
        $this->uuid = $uuid;
        $this->email = $email;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address('postmaster@proofsheet.jp', 'Proofsheet管理者'),
            subject: 'パスワード変更完了のお知らせ | ' . $this->project_name,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'postuser.mail.account.passwordComplete',
            with: [
                'email' => $this->email,
                'uuid' => $this->uuid,
                'project_name' => $this->project_name,
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
