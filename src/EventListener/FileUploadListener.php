<?php

namespace App\EventListener;

use App\Services\FileUploader;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use App\Entity\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * A doctrine listener for call automatically the upload service
 * when doctrine persist an object in the database
 * @author remyb
 *
 */
class FileUploadListener
{
    /**
     * The FileUploader service
     * @var FileUploader
     */
    private $uploader;

    public function __construct(FileUploader $uploader)
    {
        $this->uploader = $uploader;
    }
    
    /**
     * Get the entity tagerted before a push in database and return
     * it in the service
     * @param LifecycleEventArgs $args
     */
    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();
        
        $this->uploadFile($entity);
    }
    
    /**
     * Get the entity targeted before an update in database and
     * return in the service
     * @param PreUpdateEventArgs $args
     */
    public function preUpdate(PreUpdateEventArgs $args)
    {
        $entity = $args->getEntity();
        
        $this->uploadFile($entity);
    }
    
    /**
     * Check if the entity is a file
     * If it's right check if the file is update or no
     * and call the right service for manage it
     * @param Object $entity
     */
    private function uploadFile(Object $entity)
    {
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
