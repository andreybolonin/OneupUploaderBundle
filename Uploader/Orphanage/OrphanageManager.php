<?php

namespace Oneup\UploaderBundle\Uploader\Orphanage;

use Symfony\Component\Finder\Finder;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\DependencyInjection\ContainerInterface;

class OrphanageManager
{
    protected $config;
    protected $container;
    
    public function __construct(ContainerInterface $container, array $config)
    {
        $this->container = $container;
        $this->config = $config;
    }
    
    public function get($key)
    {
        return $this->container->get(sprintf('oneup_uploader.orphanage.%s', $key));
    }
    
    public function clear()
    {
        $system = new Filesystem();
        $finder = new Finder();
        
        try
        {
            $finder->in($this->config['directory'])->date('<=' . -1 * (int) $this->config['maxage'] . 'seconds')->files();
        }
        catch(\InvalidArgumentException $e)
        {
            // the finder will throw an exception of type InvalidArgumentException
            // if the directory he should search in does not exist
            // in that case we don't have anything to clean
            return;
        }
        
        foreach($finder as $file)
        {
            $system->remove($file);
        }
    }
}