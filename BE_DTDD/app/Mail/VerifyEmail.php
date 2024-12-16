<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Carbon;

class VerifyEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public $user;

    /**
     * Tạo một instance mới của thông điệp.
     *
     *
     */
    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Xác thực tài khoản KT Mobile',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        // Tạo một URL xác thực có chữ ký tạm thời (temporary signed URL)
        $verificationUrl = URL::temporarySignedRoute(
            'verify.email',  // Route name để xác thực
            Carbon::now()->addMinutes(60),  // Link sẽ hết hạn sau 60 phút
            ['token' => $this->user->verification_token]  // Truyền ID của người dùng vào URL để xác định người dùng cần xác thực
        );

        // Trả về nội dung email, sử dụng view 'emails.verify'
        return new Content(
            view: 'emails.verify',  // View email, phải tạo file này trong resources/views/emails
            with: [
                'user' => $this->user,  // Truyền thông tin người dùng vào view
                'verificationUrl' => $verificationUrl,  // Truyền URL xác thực vào view
            ]
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
