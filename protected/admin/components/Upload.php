<?php
class Upload extends CUploadedFile
{
    public function __toString()
    {
        return 'upload/' . $this->_name;
    }
}
?>