<?php

namespace App\Factories\Entities;

use App\Entities\ContentEntity;
use App\Traits\Iterator;
use App\ValueObjects\Email;
use Carbon\Carbon;
use DateTime;
use Ramsey\Uuid\Uuid;

class ContentFactory
{
    use Iterator;

    public static function fromArray(array $data): ContentEntity
    {
        $debtDueDate = self::getData($data, 'debtDueDate', 'debt_due_date');
        $email = self::getData($data, 'email');
        $createdAt = self::getData($data, 'created_at');
        $updatedAt = self::getData($data, 'updated_at');

        return new ContentEntity(
            uuid: isset($data['uuid']) ?
                self::getData($data, 'uuid') :
                Uuid::uuid4()->toString(),
            name: self::getData($data, 'name'),
            governmentId: (int) self::getData($data, 'governmentId', 'government_id'),
            email: Email::fromString($email),
            debtDueDate: DateTime::createFromFormat('Y-m-d', $debtDueDate),
            debtAmount: (float) self::getData($data, 'debtAmount', 'debt_amount'),
            debtId:  self::getData($data, 'debtId', 'debt_id'),
            id: self::getData($data, 'id'),
            createdAt: !is_null($createdAt) ? new Carbon($createdAt) : null,
            updatedAt: !is_null($updatedAt) ? new Carbon($updatedAt) : null,
        );
    }

    public static function fromModel(ContentEntity $content): ContentEntity
    {
        $data = $content->toArray();

        return self::fromArray($data);
    }
}
