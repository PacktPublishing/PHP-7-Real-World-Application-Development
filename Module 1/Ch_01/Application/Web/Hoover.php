<?php
// vacuuming a website
namespace Application\Web;

use DOMDocument;

/*
 * This app scans a website $url for an HTML tag $tag
 * Returns a multi-dimensional array of values for these tags
 * -- The array key = the line number where found
 * -- The value = an associative array
 * ---- Key/value pairs where key = the attribute
 * ---- The key "content" = what's between the open and close tags
 */

class Hoover
{

    // contents of website
    protected $content = NULL;
    
    /**
     * Populates $contents from $url
     * 
     * @param string $url = website to scan
     * @return DOMDocument $content
     */
    public function getContent($url)
    {
        if (stripos($url, 'http') !== 0) {
            $url = 'http://' . $url;
        }
        $this->content = new DOMDocument('1.0', 'utf-8');
        $this->content->preserveWhiteSpace = FALSE;
        // @ used to suppress warnings generated from improperly configured web pages
        @$this->content->loadHTMLFile($url);
        return $this->content;
    }
    
    /**
     * Returns an array of values for $tag from $url 
     * Tags with content == <tag>content</tag>
     * 
     * @param string $url = website to scan
     * @param string $tag = tag to extract
     * @return array $result
     */
    public function getTags($url, $tag)
    {
        $count    = 0;
        $result   = array();
        $elements = $this->getContent($url)->getElementsByTagName($tag);
        foreach ($elements as $node) {
            $result[$count]['value'] = trim(preg_replace('/\s+/', ' ', $node->nodeValue));
            if ($node->hasAttributes()) {
                foreach ($node->attributes as $name => $attrNode) {
                    $result[$count]['attributes'][$name] = $attrNode->value;
                }
            }
            $count++;
        }
        return $result;
    }

    /**
     * Returns an array of values for $attr from $url 
     * 
     * @param string $url    = website to scan
     * @param string $attr   = attribute to extract
     * @param string $domain = [optional] DNS domain to include in return array
     * @return array $result
     */
    public function getAttribute($url, $attr, $domain = NULL)
    {
        $result   = array();
        $elements = $this->getContent($url)->getElementsByTagName('*');
        foreach ($elements as $node) {
            if ($node->hasAttribute($attr)) {
                $value = $node->getAttribute($attr);
                if ($domain) {
                    if (stripos($value, $domain) !== FALSE) {
                        $result[] = trim($value);
                    }
                } else {
                    $result[] = trim($value);
                }
            }
        }
        return $result;
    }
}
