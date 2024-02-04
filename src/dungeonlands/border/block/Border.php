<?php

declare(strict_types=1);

namespace dungeonlands\border\block;

use pocketmine\block\Wall;
use pocketmine\item\Item;
use pocketmine\math\AxisAlignedBB;
use pocketmine\world\World;

class Border extends Wall
{
    public function ticksRandomly(): bool
    {
        return true;
    }

    public function onRandomTick(): void
    {
        $pos = $this->getPosition();
        $pos->getWorld()->setBlock($pos->asVector3(), $this, true);
    }

    public function onScheduledUpdate(): void
    {
        $pos = $this->getPosition();
        $pos->getWorld()->setBlock($pos->asVector3(), $this, true);
    }

    public function hasEntityCollision() : bool{
        return true;
    }

    public function getDrops(Item $item): array
    {
        return [];
    }

    protected function recalculateCollisionBoxes(): array
    {
        $aabb = (new AxisAlignedBB(0, World::Y_MIN, 0, 0, World::Y_MAX, 0));
        return [$aabb];
    }
}