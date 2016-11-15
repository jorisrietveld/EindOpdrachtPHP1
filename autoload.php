<?php
/**
 * Author: Joris Rietveld <jorisrietveld@gmail.com>
 * Created: 04-11-2016 09:08
 * Licence: GNU General Public licence version 3 <https://www.gnu.org/licenses/quick-guide-gplv3.html>
 */

spl_autoload_register( function( $className ){
    $vendorPrefix = 'JorisRietveld\\';

    if( strpos( $className, $vendorPrefix ))
    {
        return;
    }

    $baseDir = __DIR__ . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR;

    $includePath = str_replace( [ $vendorPrefix, '\\' ], [ $baseDir, DIRECTORY_SEPARATOR ], $className );

    require $includePath;
});