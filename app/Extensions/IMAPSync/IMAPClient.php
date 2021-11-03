<?php

namespace App\Extensions\IMAPSync;


use App\Extensions\IMAPSync\Models\FetchedEmail;
use Illuminate\Support\Facades\Storage;
use Webklex\IMAP\Facades\Client;

class IMAPClient
{
    public $oClient;

    public function __construct()
    {
        $this->oClient = Client::account('default'); // defined in config/imap.php
        $this->oClient->connect();

    }

    public function decodeSenderToClass($sender)
    {
        $q = imap_mime_header_decode($sender);
        if (sizeof($q) > 1) {
            $y = new \stdClass();
            $y->text = $q[0]->text . $q[1]->text;
            $w[] = $y;
        } else {
            $w = $q[0];
        }

        $from = (imap_rfc822_parse_headers('From: ' . $w[0]->text))->from[0];
        $o = new \stdClass();

        $o->name = $from->personal;
        $o->address = sprintf('%s@%s', $from->mailbox, $from->host);
        return $o;
    }

    public function fetchMails()
    {
        $f = $this->oClient->getFolder('support');
        $k = [];
        foreach ($f->messages()->unseen()->get() as $m) {
            $from = $this->decodeSenderToClass($m->get('fromaddress')->first());
            $attachments = $m->getAttachments();
            $attachmentCount = $attachments->count();
            $attachFNs = [];
            if ($attachmentCount > 0) {
                foreach ($attachments->all() as $fnfrommail => $attment) {
                    $fn = $fnfrommail . '.' . $attment->getExtension();
                    $data = $attment->content;
                    $attachFNs[] = $fn;
                    Storage::put('public/attachments/' . $fn, $data);
                }
            }
            $k[] = new FetchedEmail([
                'sender' => $from,
                'subject' => imap_mime_header_decode($m->getSubject()->first())[0]->text,
                'attachments' => $attachFNs,
                'body' => strip_tags($m->getHTMLBody())
            ]);
            $m->setFlag('Seen');


        }
        $this->oClient->expunge();
        return ($k);
    }

    public function processMail(FetchedEmail $m)
    {
        $m->createTicket();
    }

}
