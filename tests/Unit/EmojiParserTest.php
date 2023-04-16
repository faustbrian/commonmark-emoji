<?php

declare(strict_types=1);

namespace PreemStudio\CommonMarkEmoji\Tests;

use League\CommonMark\CommonMarkConverter;
use PreemStudio\CommonMarkEmoji\Emoji;
use PreemStudio\CommonMarkEmoji\EmojiParser;

it('should parse with valid emojis', function (string $actual, string $expected): void {
    $input = \sprintf('Hello :%s: World', $actual);
    $expected = \sprintf('<p>Hello %s World</p>', $expected);

    $converter = new CommonMarkConverter();
    $converter->getEnvironment()->addInlineParser(new EmojiParser());

    expect($expected)->toBe(\trim($converter->convert($input)->getContent()));
})->with(Emoji::dataset());

it('should fail to parse with invalid emojis', function (): void {
    $input = 'Hello :smile smile: World';
    $expected = '<p>Hello :smile smile: World</p>';

    $converter = new CommonMarkConverter();
    $converter->getEnvironment()->addInlineParser(new EmojiParser());

    expect($expected)->toBe(\trim($converter->convert($input)->getContent()));
});
