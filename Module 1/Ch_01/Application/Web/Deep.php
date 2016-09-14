<?php
// deep scan a website
namespace Application\Web;

/*
 * This app does a deep scan of a website $url for an HTML tag $tag
 * Follows links within the same domain
 * 
 */

class Deep
{

    protected $domain;
    
    /**
     * Returns the DNS domain from a URL
     * 
     * @param string $url = website to scan
     * @return string $dns = DNS domain
     */
    public function getDomain($url)
    {
        if (!$this->domain) {
            $this->domain = parse_url($url, PHP_URL_HOST);
        }
        return $this->domain;
    }
    
    /**
     * Returns an array of values for $tag from $url 
     * PHP 7 delegating generator
     * 
     * @param string $url = website to scan
     * @param string $tag = tag to extract
     * @return an iteration
     */
    public function scan($url, $tag)
    {
        $vac    = new Hoover();
        $scan   = $vac->getAttribute($url, 'href', $this->getDomain($url));
        $result = array();
        foreach ($scan as $subSite) {
            yield from $vac->getTags($subSite, $tag);
        }
        // returns total number of sub-sites scanned
        return count($scan);
    }

}
