<?php

namespace Illuminate\Contracts\Queue;

interface QueueableEntity
{
    /**
     * Get the queueable identity for the Entities.
     *
     * @return mixed
     */
    public function getQueueableId();

    /**
     * Get the relationships for the Entities.
     *
     * @return array
     */
    public function getQueueableRelations();

    /**
     * Get the connection of the Entities.
     *
     * @return string|null
     */
    public function getQueueableConnection();
}
