<?php

namespace App\Entities;

use App\ValueObjects\Email;
use Carbon\Carbon;
use DateTime;

class ContentEntity extends BaseEntity
{

    public function __construct(
        string           $uuid,
        private string   $name,
        private int      $governmentId,
        private Email    $email,
        private DateTime $debtDueDate,
        private float    $debtAmount,
        private string   $debtId,
        ?int             $id = null,
        ?Carbon          $createdAt = null,
        ?Carbon          $updatedAt = null,
    )
    {
        parent::__construct(
            uuid: $uuid,
            id: $id,
            createdAt: $createdAt,
            updatedAt: $updatedAt
        );
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getEmail(): Email
    {
        return $this->email;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->getId(),
            'uuid' => $this->getUuid(),
            'government_id' => $this->governmentId,
            'email' => $this->email->toString(),
            'name' => $this->name,
            'debt_amount' => $this->debtAmount,
            'debt_id' => $this->debtId,
            'debt_due_date' => $this->debtDueDate?->format('Y-m-d'),
            'createdAt' => $this->getCreatedAt()?->toDateTimeString(),
            'updatedAt' => $this->getUpdatedAt()?->toDateTimeString(),
        ];
    }
}
