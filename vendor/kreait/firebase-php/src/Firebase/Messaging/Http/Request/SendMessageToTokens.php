<?php

declare(strict_types=1);

namespace Kreait\Firebase\Messaging\Http\Request;

use Kreait\Firebase\Exception\Messaging\InvalidArgument;
use Kreait\Firebase\Http\HasSubRequests;
use Kreait\Firebase\Http\WrappedPsr7Request;
use Kreait\Firebase\Messaging\Message;
use Kreait\Firebase\Messaging\Messages;
use Kreait\Firebase\Messaging\RawMessageFromArray;
use Kreait\Firebase\Messaging\RegistrationTokens;
use Psr\Http\Message\RequestInterface;

/**
 * @internal
 */
final class SendMessageToTokens implements HasSubRequests, RequestInterface
{
    use WrappedPsr7Request;

    public const MAX_AMOUNT_OF_TOKENS = 500;

    public function __construct(string $projectId, Message $message, RegistrationTokens $registrationTokens, bool $validateOnly = false)
    {
        if ($registrationTokens->count() > self::MAX_AMOUNT_OF_TOKENS) {
            throw new InvalidArgument('A multicast message can be sent to a maximum amount of ' . self::MAX_AMOUNT_OF_TOKENS . ' tokens.');
        }

        $messageData = $message->jsonSerialize();
        unset($messageData['topic'], $messageData['condition']);

        $messages = [];

        foreach ($registrationTokens as $token) {
            $messageData['token'] = $token->value();

            $messages[] = new RawMessageFromArray($messageData);
        }

        $this->wrappedRequest = new SendMessages($projectId, new Messages(...$messages), $validateOnly);
    }
}
