<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace BaseCodeOy\CommonMarkEmoji;

use BaseCodeOy\Emoji\Emoji;
use League\CommonMark\Node\Inline\Text;
use League\CommonMark\Parser\Inline\InlineParserInterface;
use League\CommonMark\Parser\Inline\InlineParserMatch;
use League\CommonMark\Parser\InlineParserContext;

final class EmojiParser implements InlineParserInterface
{
    public function getMatchDefinition(): InlineParserMatch
    {
        return InlineParserMatch::join(
            InlineParserMatch::string(':'),
            InlineParserMatch::regex('[\w\-+]+'),
            InlineParserMatch::string(':'),
        );
    }

    public function parse(InlineParserContext $inlineContext): bool
    {
        $cursor = $inlineContext->getCursor();

        $previousChar = $cursor->peek(-1);

        if ($previousChar !== null && $previousChar !== ' ') {
            return false;
        }

        $previousState = $cursor->saveState();

        $cursor->advance();

        $identifier = $cursor->match('/^[\\w\\-\\+]+\\:/i');

        if ($identifier === null) {
            $cursor->restoreState($previousState);

            return false;
        }

        $emoji = Emoji::fromString(\mb_substr($identifier, 0, -1));

        $inlineContext->getContainer()->appendChild(new Text($emoji->value));

        return true;
    }
}
