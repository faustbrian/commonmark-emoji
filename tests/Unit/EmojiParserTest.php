<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace BaseCodeOy\CommonMarkEmoji\Tests;

use BaseCodeOy\CommonMarkEmoji\EmojiParser;
use BaseCodeOy\Emoji\Emoji;
use League\CommonMark\CommonMarkConverter;

it('should parse with valid emojis', function (string $actual, Emoji $expected): void {
    $input = \sprintf('Hello :%s: World', $actual);
    $expected = \sprintf('<p>Hello %s World</p>', $expected->value);

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
