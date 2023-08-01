<?php

namespace Illuminate\Contracts\Mail;

interface Attachable
{
    /**
     * Get an attachment instance for this Entities.
     *
     * @return \Illuminate\Mail\Attachment
     */
    public function toMailAttachment();
}
