<?php

namespace App\DataTransferObjects;

class TransactionDTO
{

    public int $from_id;
    public int $to_id;
    public int $amount;
    public string $type;
    public ?string $hash;

    public function __construct(
        int $from_id,
        int $to_id,
        int $amount,
        string $type,
        ?string $hash = null,
    )
    {
        $this->from_id = $from_id;
        $this->to_id = $to_id;
        $this->amount = $amount;
        $this->type = $type;
        $this->hash = $hash;
    }

    public function toArray()
    {
        return get_object_vars($this);
    }

}
