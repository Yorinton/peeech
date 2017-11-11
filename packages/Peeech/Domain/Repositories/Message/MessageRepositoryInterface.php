<?php

namespace Peeech\Domain\Repositories\Message;

interface MessageRepositoryInterface
{
    function changeStatus(int $room_id,int $recipient_id);
}