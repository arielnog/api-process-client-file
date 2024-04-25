<?php

namespace App\ValueObjects;

use App\Exceptions\InvalidArgumentException;
use Exception;

final class Resource
{
    /**
     * @throws Exception
     */
    public function __construct(
        private $content
    ) {
        $this->validate();
    }

    /**
     * @throws InvalidArgumentException
     */
    private function validate(): void
    {
        if (!is_resource($this->content)) {
            throw new InvalidArgumentException(
                message: 'Invalid Type.'
            );
        }

        if (get_resource_type($this->content) !== 'stream') {
            throw new InvalidArgumentException(
                message: 'Invalid Type.'
            );
        }
    }

    public function getContent()
    {
        return $this->content;
    }
}
