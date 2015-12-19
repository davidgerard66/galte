<?php
/**
 * Created by PhpStorm.
 * User: CREATIVE
 * Date: 17/11/2015
 * Time: 00:05
 */

namespace Pages\PagesBundle\Services;


class CurlUrl
{

    public function checkUrl($site) // fonction avec du curl pour savoir si une url existe TODO se renseigner sur curl
    {
        $site = curl_init($site);
        curl_setopt($site, CURLOPT_FAILONERROR, true);
        curl_setopt($site, CURLOPT_NOBODY, true);
        // ncecessite davoir lextension, curl activé

        IF (curl_exec($site)===false)
            $curl = false;
        else
            $curl =true;

        curl_close($site);

        return $curl;

    }

    public function findUrl($value)  // value = contenu du champd u formulaire
    {

        $urls = preg_match_all('/<a href="(.*)">/',$value, $url); //TODO se renseigner sur preg_match_all
        $violation = false;
        foreach(array_unique($url[1]) as $site)
        {
            if ($this->checkUrl($site)===false) $violation = true;
            //echo $site;
        }

        return $violation;

    }

}