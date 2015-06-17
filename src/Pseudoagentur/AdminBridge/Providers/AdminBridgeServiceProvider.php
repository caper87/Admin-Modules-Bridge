<?php namespace Pseudoagentur\AdminBridge\Providers;

use Illuminate\Support\ServiceProvider;
use Symfony\Component\Finder\Finder as SymfonyFinder;
use Pingpong\Modules\Facades\Module;

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
		$this->modules = Module::enabled();
	
		if ( count($this->modules) == 0 ) {
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
		
		foreach($this->modules as $module) {			
			$files->files()->name('admin.php')->in(Module::getModulePath($module->name));
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
