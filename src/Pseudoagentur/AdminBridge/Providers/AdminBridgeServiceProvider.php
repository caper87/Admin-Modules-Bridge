<?php namespace Pseudoagentur\AdminBridge\Providers;

use Illuminate\Support\ServiceProvider;
use Symfony\Component\Finder\Finder as SymfonyFinder;


class AdminBridgeServiceProvider extends ServiceProvider {

	const BOOTSRAP_FILE = 'bootstrap.php';

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Bootstrap the application events.
	 *
	 * @return void
	 */
	public function register()
    {
        $this->directory = config('modules.paths.modules');
        if ( ! is_dir($this->directory))
        {
            return;
        }
        $files = $this->getAllFiles();
        foreach ($files as $file)
        {
            require $file;
        }
    }

    protected function getAllFiles()
    {
    	$files = new SymfonyFinder();
		$files->files()->name('admin.php')->in($this->directory);

        $files->sort(function ($a)
        {
            return $a->getFilename() !== static::BOOTSRAP_FILE;
        });
        return $files;
    }

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return [];
	}

}
