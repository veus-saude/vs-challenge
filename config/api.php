<?php
/**
 * API configuration file
 *
 * @author Mike Alvarez <mike@hallohallo.ph>
 */

return [
    /**
     * API Version: Current Api default Version
     */
    'version' => '0.1a',

    /**
     * version control Accept header pattern
     * to fetch version
     */
    'accept_header_pattern' => 'application\/vnd\.api\-v([\d]+(?:\.[\d]+)*(?:a|b)?)\+json',

    /**
     * version control fallback version
     * if requested version does not match the pattern
     */
    'fallback_version' => 1,
];
