<?php

namespace App\Observers;

use App\Models\Entity;
use App\Repositories\FileStorage;

class EntityObserver
{
    public function deleted(Entity $entity)
    {
        if ($entity->links()->exists()) {
            $entity->links()->delete();
        }
        if ($entity->sectors()->exists()) {
            $entity->sectors()->detach();
        }
        $storage = new FileStorage();
        $storage->destroy($entity->image);
        $entity->users()->detach();
    }
}
