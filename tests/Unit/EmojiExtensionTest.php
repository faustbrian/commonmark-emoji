<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace Tests\Unit;

use BaseCodeOy\CommonMarkEmoji\EmojiExtension;
use BaseCodeOy\CommonMarkEmoji\EmojiParser;
use League\CommonMark\Environment\Environment;

it('should register the extension', function (): void {
    $environment = new Environment();
    $environment->addExtension($extension = new EmojiExtension());

    expect($environment->getExtensions())->toContain($extension);
});

it('should register the parser', function (): void {
    $environment = new Environment();
    $environment->addInlineParser($parser = new EmojiParser());

    expect($environment->getInlineParsers())->toContain($parser);
});
