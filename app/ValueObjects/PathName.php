<?php

namespace App\ValueObjects;

use App\Exceptions\InvalidArgumentException;

final class PathName
{
    protected string $pathName;

    protected const CSV_TYPE = '.csv';

    public function __construct(
        private array $data
    ) {
        $this->build();
    }

    private function build(): void
    {
        if (empty($this->data)) {
            throw new InvalidArgumentException(
               message: "Invalid parameter"
            );
        }

        $this->pathName = implode(DIRECTORY_SEPARATOR, $this->data);
    }

    public function generateToCsv(): string
    {
        return DIRECTORY_SEPARATOR . $this->pathName . self::CSV_TYPE;
    }

    public function asString(): string
    {
        return $this->pathName;
    }
}
