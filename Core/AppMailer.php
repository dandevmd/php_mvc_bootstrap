<?php

namespace app\Core;

use Symfony\Component\Mailer\Transport\TransportInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mailer\Transport;
use Symfony\Component\Mailer\MailerInterface;


class AppMailer
{
  private Mailer $mailer;
  private TransportInterface $transport;
  private string $senderEmail;
  private string $subject;
  private string $body;
  private string|array $toAddresses;


  public function __construct(
    string $subject,
    string $body,
    string|array $toAddresses
  ) {
    $this->transport = Transport::fromDsn('smtp://localhost:1025');
    $this->mailer = new Mailer($this->transport);
    $this->senderEmail = 'lCqzQ@example.com';
    $this->subject = $subject;
    $this->body = $body;
    $this->toAddresses = $toAddresses;
  }

  public function sendEmail(): void
  {
    $message = (new Email())
      ->from($this->senderEmail)
      ->to($this->toAddresses)
      ->subject($this->subject)
      ->text($this->body);

    $this->mailer->send($message);
  }
}