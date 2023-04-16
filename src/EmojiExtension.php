<?php

declare(strict_types=1);

namespace PreemStudio\CommonMarkEmoji;

use League\CommonMark\Environment\EnvironmentBuilderInterface;
use League\CommonMark\Extension\ExtensionInterface;

final class EmojiExtension implements ExtensionInterface
{
    public function register(EnvironmentBuilderInterface $environment): void
    {
        $environment->addInlineParser(new EmojiParser());
    }
}
