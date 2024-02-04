<?php

declare(strict_types=1);

namespace dungeonlands\border;

use dungeonlands\border\block\Border;
use pocketmine\block\Block;
use pocketmine\block\RuntimeBlockStateRegistry;
use pocketmine\block\Wall;
use pocketmine\data\bedrock\block\BlockTypeNames;
use pocketmine\data\bedrock\block\convert\BlockStateDeserializerHelper;
use pocketmine\data\bedrock\block\convert\BlockStateReader;
use pocketmine\data\bedrock\block\convert\BlockStateSerializerHelper;
use pocketmine\data\bedrock\block\convert\BlockStateWriter;
use pocketmine\event\Listener;
use pocketmine\item\StringToItemParser;
use pocketmine\plugin\PluginBase;
use pocketmine\scheduler\AsyncTask;
use pocketmine\world\format\io\GlobalBlockStateHandlers;

class BorderLoader extends PluginBase implements Listener {

    public function onEnable() : void{
        self::registerBlocks();

        $this->getServer()->getAsyncPool()->addWorkerStartHook(function(int $worker) : void{
            $this->getServer()->getAsyncPool()->submitTaskToWorker(new class extends AsyncTask{
                public function onRun() : void{
                    BorderLoader::registerBlocks();
                }
            }, $worker);
        });

        $this->getServer()->getPluginManager()->registerEvents($this, $this);
    }

    public static function registerBlocks() : void{
        self::registerSimpleBlock(BlockTypeNames::BORDER_BLOCK, ExtraVanillaBlocks::BORDER_BLOCK(), ["border_block"]);
    }

    /**
     * @param string[] $stringToItemParserNames
     */
    private static function registerSimpleBlock(string $id, Block|Wall $block, array $stringToItemParserNames) : void{
        RuntimeBlockStateRegistry::getInstance()->register($block);

        GlobalBlockStateHandlers::getSerializer()->map($block, fn(Border $block) => BlockStateSerializerHelper::encodeWall($block, new BlockStateWriter($id)));
        GlobalBlockStateHandlers::getDeserializer()->map($id, fn(BlockStateReader $in) => BlockStateDeserializerHelper::decodeWall($block, $in));

        foreach($stringToItemParserNames as $name){
            StringToItemParser::getInstance()->registerBlock($name, fn() => clone $block);
        }
    }
}