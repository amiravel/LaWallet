<?php

namespace App\Shields\Contracts;

use App\DataTransferObjects\Dto;

interface ShieldApplyInterface
{

    public function apply(Dto $dto);

}
