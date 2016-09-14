<?php

class Application_MiddleWare_ServerRequest
        extends Application_MiddleWare_Request
        implements Psr_Http_Message_ServerRequestInterface
{

    var $serverParams;
    var $cookies;
    var $queryParams;
    var $contentType;
    var $parsedBody;
    var $attributes;
    var $method;
    var $uploadedFileInfo;        // typically $_FILES
    var $uploadedFileObjs;        // UploadFileInterface instances

    function initialize()
    {
        $params = $this->getServerParams();
        $this->getCookieParams();
        $this->getQueryParams();
        $this->getUploadedFiles;
        $this->getRequestMethod();
        $this->getContentType();
        $this->getParsedBody();
        return $this->withRequestTarget($params['REQUEST_URI']);
    }

    function getServerParams()
    {
        if (!$this->serverParams) {
            $this->serverParams = $_SERVER;
        }
        return $this->serverParams;
    }

    function getCookieParams()
    {
        if (!$this->cookies) {
            $this->cookies = $_COOKIE;
        }
        return $this->cookies;
    }

    function withCookieParams(array $cookies)
    {
        array_merge($this->getCookieParams(), $cookies);
        return $this;
    }

    function getQueryParams()
    {
        if (!$this->queryParams) {
            $this->queryParams = $_GET;
        }
        return $this->queryParams;
    }

    function withQueryParams(array $query)
    {
        array_merge($this->getQueryParams(), $query);
        return $this;
    }

    function getUploadedFileInfo()
    {
        if (!$this->uploadedFileInfo) {
            $this->uploadedFileInfo = isset($_FILES) ? $_FILES : array();
        }
        return $this->uploadedFileInfo;
    }

    function getUploadedFiles()
    {
        if (!$this->uploadedFileObjs) {
            foreach ($this->getUploadedFileInfo() as $field => $value) {
                $this->uploadedFileObjs[$field] = new UploadedFile($field, $value);
            }
        }
        return $this->uploadedFileObjs;
    }

    function withUploadedFiles(array $uploadedFiles)
    {
        if (!count($uploadedFiles)) {
            throw new Exception(Constant::ERROR_NO_UPLOADED_FILES);
        }
        foreach ($uploadedFiles as $fileObj) {
            if (!$fileObj instanceof UploadedFileInterface) {
                throw new Exception(Constant::ERROR_INVALID_UPLOADED);
            }
        }
        $this->uploadedFileObjs = $uploadedFiles;
    }

    function getRequestMethod()
    {
        $params = $this->getServerParams();
        $method = isset($params['REQUEST_METHOD']) ? $params['REQUEST_METHOD'] : '';
        $this->method = strtolower($method);
        return $this->method;
    }

    function getContentType()
    {
        if (!$this->contentType) {
            $params = $this->getServerParams();
            $this->contentType = isset($params['CONTENT_TYPE']) ? $params['CONTENT_TYPE'] : '';
            $this->contentType = strtolower($this->contentType);
        }
        return $this->contentType;
    }

    function getParsedBody()
    {
        if (!$this->parsedBody) {
            if (($this->getContentType() == Constants::CONTENT_TYPE_FORM_ENCODED
                || $this->getContentType() == Constants::CONTENT_TYPE_MULTI_FORM)
                && $this->getRequestMethod() == Constants::METHOD_POST)
            {
                $this->parsedBody = $_POST;
            } elseif ($this->getContentType() == Constants::CONTENT_TYPE_JSON
                      || $this->getContentType() == Constants::CONTENT_TYPE_HAL_JSON)
            {
                ini_set("allow_url_fopen", true);
                $this->parsedBody = unserialize(file_get_contents('php://stdin'));
            } elseif (!empty($_REQUEST)) {
                $this->parsedBody = $_REQUEST;
            } else {
                ini_set("allow_url_fopen", true);
                $this->parsedBody = file_get_contents('php://stdin');
            }
        }
        return $this->parsedBody;
    }

    function withParsedBody($data)
    {
        $this->parsedBody = $data;
        return $this;
    }

    function getAttributes()
    {
        return $this->attributes;
    }

    function getAttribute($name, $default = NULL)
    {
        return isset($this->attributes[$name]) ? $this->attributes[$name] : $default;
    }

    function withAttribute($name, $value)
    {
        $this->attributes[$name] = $value;
        return $this;
    }

    function withoutAttribute($name)
    {
        if (isset($this->attributes[$name])) {
            unset($this->attributes[$name]);
        }
        return $this;
    }

}
