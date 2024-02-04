<?php

/*
 *
 *  ____            _        _   __  __ _                  __  __ ____
 * |  _ \ ___   ___| | _____| |_|  \/  (_)_ __   ___      |  \/  |  _ \
 * | |_) / _ \ / __| |/ / _ \ __| |\/| | | '_ \ / _ \_____| |\/| | |_) |
 * |  __/ (_) | (__|   <  __/ |_| |  | | | | | |  __/_____| |  | |  __/
 * |_|   \___/ \___|_|\_\___|\__|_|  |_|_|_| |_|\___|     |_|  |_|_|
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * @author PocketMine Team
 * @link http://www.pocketmine.net/
 *
 *
 */

declare(strict_types=1);

namespace dungeonlands\border;

use dungeonlands\border\block\Border;
use pocketmine\block\Block;
use pocketmine\block\BlockBreakInfo;
use pocketmine\block\BlockIdentifier;
use pocketmine\block\BlockTypeIds;
use pocketmine\block\BlockTypeInfo;
use pocketmine\utils\CloningRegistryTrait;

/**
 * This doc-block is generated automatically, do not modify it manually.
 * This must be regenerated whenever registry members are added, removed or changed.
 * @see build/generate-registry-annotations.php
 * @generate-registry-docblock
 *
 * @method static Border BORDER_BLOCK()
 */
final class ExtraVanillaBlocks{
    use CloningRegistryTrait;

    private function __construct(){
        //NOOP
    }

    protected static function register(string $name, Block $block) : void{
        self::_registryRegister($name, $block);
    }

    /**
     * @return Block[]
     * @phpstan-return array<string, Block>
     */
    public static function getAll() : array{
        //phpstan doesn't support generic traits yet :(
        /** @var Block[] $result */
        $result = self::_registryGetAll();
        return $result;
    }

    protected static function setup() : void{
        self::register("border_block", new Border(new BlockIdentifier(BlockTypeIds::newId()), "Border", new BlockTypeInfo(BlockBreakInfo::indestructible())));
    }
}