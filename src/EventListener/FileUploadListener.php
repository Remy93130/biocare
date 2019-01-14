<?php

namespace App\EventListener;

use App\Services\FileUploader;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use App\Entity\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class FileUploadListener
{
    private $uploader;

    public function __construct(FileUploader $uploader)
    {
        $this->uploader = $uploader;
    }
    
    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();
        
        $this->UploadFile($entity); 
    }
    
    public function preUpdate(PreUpdateEventArgs $args)
    {
        $entity = $args->getEntity();
        
        $this->UploadFile($entity);
    }
    
    private function UploadFile($entity) {
        if (!$entity instanceof File) {
            return;
        }
        
        $file = $entity->getFile();
        
        if ($file instanceof UploadedFile) {
            $fileName = $this->uploader->upload($file);
            $entity->setFile($fileName);
        } elseif ($file instanceof \Symfony\Component\HttpFoundation\File\File) {
            $entity->setFile($file->getFilename());
        }
    }
}

