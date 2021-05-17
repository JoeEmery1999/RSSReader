<?php
    namespace App\Helpers;

	use Exception;
    use SimpleXMLElement;

    class RSSHelper
	{
        /**
         * This function will attempt to visit and parse the xml from a given string (url).
         *
         * @param string $url
         * @return SimpleXMLElement
         */
        public static function parseUrl(string $url): SimpleXMLElement
        {
            $feed_xml = new SimpleXMLElement($url, 0, true);

            return $feed_xml->channel;
        }

        public static function validateRSSSource(string $url): bool
        {
            try {
                $xml = new SimpleXMLElement($url, 0, true);
                if (
                isset($xml->channel->item)
                )
                {
                    return true;
                }
            }
            catch(Exception $e)
            {
                //If we're in here, we don't have valid XML
                return false;
            }
            return false;
        }
	}
