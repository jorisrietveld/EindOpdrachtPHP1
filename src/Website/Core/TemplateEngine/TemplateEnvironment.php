<?php
/**
 * Author: Joris Rietveld <jorisrietveld@gmail.com>
 * Created: 03-10-2016 14:27
 */
declare(strict_types = 1);

namespace JorisRietveld\Website\Core\TemplateEngine;


use JorisRietveld\Website\Exceptions\DirectoryNotFoundException;

class TemplateEnvironment
{
    /**
     * The template directories that contain the templates.
     * @var
     */
    protected $sourceDirectories;

    /**
     * The file names of all the templates.
     * @var
     */
    protected $templatesFiles;

    /**
     * The variables used in the templates.
     * @var
     */
    protected $environmentVariables;

    /**
     * The rendered page.
     * @var
     */
    protected $renderedPage;

    /**
     * TemplateEnvironment constructor.
     * @param array $sourceDirs
     * @param array $environmentVars
     */
    public function __construct( $sourceDirectories = [], $environmentVars = [] )
    {
        $this->setSourceDirectories( $sourceDirectories );
        $this->setEnvironmentVariables( $environmentVars );
        $this->templatesFiles = [];
        $this->renderedPage = null;
    }

    /**
     * Set new source directories that contain templates.
     *
     * @param array $newSourceDirectories
     * @return $this
     */
    public function setSourceDirectories( array $newSourceDirectories = [] )
    {
        $this->sourceDirectories = $newSourceDirectories;
        $this->loadTemplates();
        return $this;
    }

    /**
     * Add source directories to the environment, if an key exists in the old array and is also defined in the new one
     * it will be replaced by the new directory.
     *
     * @param array $sourceDirectories
     * @return $this
     */
    public function addSourceDirectories( array $sourceDirectories = [] )
    {
        $this->sourceDirectories = array_replace( $this->sourceDirectories, $sourceDirectories );
        $this->loadTemplates();
        return $this;
    }

    /**
     * Return all the defined sourceDirectories.
     *
     * @return array
     */
    public function getSourceDirectories() : array
    {
        return $this->sourceDirectories;
    }

    /**
     * Get all the files stored in an template directory.
     *
     * @param $templateDirectory
     * @return array
     */
    protected function loadTemplates()
    {
        /**
         * Check if the directories exist.
         */
        foreach ( $this->sourceDirectories as $sourceDirectory )
        {
            if( !is_dir( $sourceDirectory ) )
            {
                throw new DirectoryNotFoundException(
                    'The template directory: ' . $sourceDirectory . ' Does not exist or is not an directory'
                );
            }
        }

        /**
         * Recursively load all the templates from the given source directories.
         */
        foreach ( $this->sourceDirectories as $sourceDirectory )
        {

            // Get an directory iterator for recursively iterating thu the files in given directory.
            $directoryIterator = new \RecursiveDirectoryIterator( $sourceDirectory, \FilesystemIterator::SKIP_DOTS );

            /**
             * This callback filter will alter the passed directory iterator and filters the found files by the anonymous
             * function below. The function will delete all files that are not template files
             */
            $files = new \RecursiveCallbackFilterIterator( $directoryIterator, function ( $current, $key, $iterator ) {

                // Enable recursion
                if ($iterator->hasChildren()) {
                    return true;
                }

                // Check if it is an template file.
                return ( strpos( $current->getFileName(), '.html.temp' ) !== false ) ? true : false;
            });

            /**
             * Get all the file names
             */
            foreach ( new \RecursiveIteratorIterator($files) as $file )
            {
                $this->templatesFiles[] = $file->getPathname();
            }
        }
        return $this;
    }

    /**
     * Return the currently defined environment variabels.
     *
     * @return mixed
     */
    public function getEnvironmentVariables()
    {
        return $this->environmentVariables;
    }

    /**
     * Set new environment variables.
     * 
     * @param array $environmentVariables
     * @return $this
     */
    public function setEnvironmentVariables( array $environmentVariables )
    {
        $this->environmentVariables = $environmentVariables;
        return $this;
    }

    /**
     * Add net environment variables.
     *
     * @param array $environmentVariables
     * @return $this
     */
    public function addEnvironmentVariables( array $environmentVariables )
    {
        $this->environmentVariables = array_replace( $this->environmentVariables, $environmentVariables );
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTemplatesFiles()
    {
        return $this->templatesFiles;
    }
}