<?php

namespace App\Mail;

use App\Models\Employee;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class EmployeeCreateMail extends Mailable
{
    use Queueable, SerializesModels;


    public $employee;
    public $companyEmail;

    /**
     * Create a new message instance.
     */
    public function __construct(Employee $employee, string $companyEmail )
    {
        //
        $this->employee=$employee;
        $this->companyEmail= $companyEmail;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from:$this->companyEmail,
            subject: 'Welcome to Company',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.employee-create',
            with: [
                'employee'=> $this->employee
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
