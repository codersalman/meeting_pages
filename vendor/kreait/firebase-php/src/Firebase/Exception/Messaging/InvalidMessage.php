<?php

declare(strict_types=1);

namespace Kreait\Firebase\Exception\Messaging;

use Kreait\Firebase\Exception\HasErrors;
use Kreait\Firebase\Exception\MessagingException;
use RuntimeException;

final class InvalidMessage extends RuntimeException implements MessagingException
{
    use HasErrors;

    /**
     * @param string[] $errors
     * @internal
     *
     */
    public function withErrors(array $errors): self
    {
        $new = new self($this->getMessage(), $this->getCode(), $this->getPrevious());
        $new->errors = $errors;

        return $new;
    }
}
