<?php

namespace App\DataTransferObjects;

use App\Traits\Iterator;

final class ProcessFileDTO
{
    use Iterator;

    public function __construct(
        private array $pathNames
    ) {
    }

    public static function fromArray(array $data): ProcessFileDTO
    {
        return new self(
            pathNames: self::getData($data,'pathName','path_name')
        );
    }

    public function getPathNames(): array
    {
        return $this->pathNames;
    }
}
