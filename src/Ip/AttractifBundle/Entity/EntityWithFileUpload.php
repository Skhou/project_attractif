<?php

namespace Ip\AttractifBundle\Entity;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class EntityWithFileUpload {

    /**
     * @var UploadedFile
     */
    protected $file;

    public function getFile()
    {
        return $this->file;
    }

    public function setFile(UploadedFile $file = null)
    {
        $this->file = $file;
    }

    public function upload()
    {
        if (null === $this->file) {
            return;
        }

        $name = $this->file->getClientOriginalName();

        $this->file->move($this->getUploadRootDir(), $name);
        $this->base64Convert($this->getUploadRootDir() . "/" . $name);
        unlink($this->getUploadRootDir() . "/" . $name);

    }

    public function getUploadDir()
    {
        return 'uploads/img';
    }

    protected function getUploadRootDir()
    {
        return __DIR__.'/../../../../web/'.$this->getUploadDir();
    }

    protected function base64Convert($file)
    {
        if($fp = fopen($file,"rb", 0))
        {
            $img = fread($fp,filesize($file));
            fclose($fp);
            $base64 = chunk_split(base64_encode($img));
            $this->image = "data:image/jpg/png/gif;base64," . $base64;
        }
    }

} 