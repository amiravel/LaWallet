<?php

namespace App\DataTransferObjects;

use App\DataTransferObjects\Contracts\DtoInterface;

class OfferDto extends Dto implements DtoInterface
{

    public int $wallet_id;
    public string $code;
    public int $amount_per_scan;
    public int $max_scan;
    public $starts_at;
    public $ends_at;
    public int $budget_amount;
    public ?int $scan_count;
    public ?int $id;

    public function __construct(
        int $wallet_id,
        string $code,
        int $budget_amount,
        int $amount_per_scan,
        int $max_scan,
        $starts_at,
        $ends_at,
        ?int $id = null,
        ?int $scan_count = null
    )
    {
        $this->wallet_id = $wallet_id;
        $this->code = $code;
        $this->amount_per_scan = $amount_per_scan;
        $this->max_scan = $max_scan;
        $this->starts_at = $starts_at;
        $this->ends_at = $ends_at;
        $this->budget_amount = $budget_amount;
        $this->scan_count = $scan_count;
        $this->id = $id;
    }

}
