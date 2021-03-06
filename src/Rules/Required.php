<?php

namespace Rakit\Validation\Rules;

use Rakit\Validation\Rule;

class Required extends Rule
{
    protected $implicit = true;

    protected $message = "The :attribute is required";

    public function check($value, array $params)
    {
        $this->setAttributeAsRequired();

        if (UploadedFile::isUploadedFile($value)) {
            return $value['error'] != UPLOAD_ERR_NO_FILE;
        }
        if (is_string($value)) return strlen(trim($value)) > 0;
        if (is_array($value)) return count($value) > 0;
        return !is_null($value);
    }

    protected function setAttributeAsRequired()
    {
        if ($this->attribute) {
            $this->attribute->setRequired(true);
        }
    }

}
