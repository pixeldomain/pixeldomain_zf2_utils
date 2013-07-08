<?php

namespace PixelDomain\Mail;

use Zend\Mail\Message;
use Zend\Mail\Transport\Smtp as SmtpTransport;
use Zend\Mail\Transport\SmtpOptions;
use Zend\Mime\Message as MimeMessage;
use Zend\Mime\Part as MimePart;


class Sendgrid
{

    /**
     * @var Zend\Mail\Transport\Smtp The SMTP transport
     */
    protected $transport;

    /**
     * @var string The from name
     */
    protected $fromName;

    /**
     * @var string The from email
     */
    protected $fromEmail;

    /**
     * @var string The recipient address
     */
    protected $toAddress;

    /**
     * @var string The subject line
     */
    protected $subjectLine;

    /**
     * @var string The HTML content
     */
    protected $htmlContent;

    /**
     * @var string The text content
     */
    protected $textContent;

    /**
     * Set up the Zend SMTP transport.
     *
     * @param string $sgUsername
     * @param string $sgPassword
     */
    public function __construct($sgUsername, $sgPassword)
    {
        $this->transport = new SmtpTransport();
        $options   = new SmtpOptions(
            array(
                'host'              => "smtp.sendgrid.net",
                'port'              => 587,
                'connection_class'  => "plain",
                'connection_config' => array(
                    'username' => $sgUsername,
                    'password' => $sgPassword,
                ),
            )
        );
        $this->transport->setOptions($options);
    }

    /**
     * Set the from name.
     *
     * @param string $fromName
     */
    public function setFromName($fromName)
    {
        $this->fromName = $fromName;
    }

    /**
     * Set the from email.
     *
     * @param string $fromEmail
     */
    public function setFromEmail($fromEmail)
    {
        $this->fromEmail = $fromEmail;
    }

    /**
     * Set the recipient.
     *
     * @param string $toAddress
     */
    public function setRecipient($toAddress)
    {
        $this->toAddress = $toAddress;
    }

    /**
     * Set the subject line.
     *
     * @param string $subjectLine
     */
    public function setSubject($subjectLine)
    {
        $this->subjectLine = $subjectLine;
    }

    /**
     * Set the HTML content.
     *
     * @param string $html
     */
    public function setHtmlContent($html)
    {
        $this->htmlContent = $html;
    }

    /**
     * Set the text content.
     *
     * @param string $text
     */
    public function setTextContent($text)
    {
        $this->textContent = $text;
    }

    /**
     * Send the email.
     *
     */
    public function send()
    {
        $message = new Message();
        $message->addFrom($this->fromEmail, $this->fromName);
        $message->addTo($this->toAddress);
        $message->setSubject($this->subjectLine);

        $html = new MimePart($this->htmlContent);
        $html->type = "text/html";

        $text = new MimePart($this->textContent);
        $text->type = "text/plain";

        $body = new MimeMessage();
        if (($this->htmlContent) && ($this->textContent)) {
            $body->setParts(array($text, $html));
        } else if ($this->textContent) {
            $body->setParts(array($text));
        } else {
            $body->setParts(array($html));
        }

        $message->setBody($body);

        $this->transport->send($message);
    }
}
