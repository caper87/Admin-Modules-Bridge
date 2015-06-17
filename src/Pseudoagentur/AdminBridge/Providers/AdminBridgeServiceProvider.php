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
		$this->vendor = base_path('vendor/' . config('modules.composer.vendor'));
		
		$this->moduleDirectory = is_dir($this->directory);
		$this->vendorDirecotry = is_dir($this->vendor) && config('modules.scan.enabled');
		
		if ( !$this->moduleDirectory && !$this->vendorDirecotry) {
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
		
		if ( $this->moduleDirectory ) {
			$files->files()->name('admin.php')->in($this->directory);
		} 
		
		if ( $this->vendorDirecotry ) {
			$files->files()->name('admin.php')->in($this->vendor);
		}

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