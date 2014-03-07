<?php namespace Flyer\Components\Foundation;

use Flyer\Components\Foundation\ServiceProviders;

class App
{

	/**
	 * The service providers
	 */
	
	protected $serviceProviders = array();

	/**
	 * The booted service providers
	 */
	
	protected $booted = array();

	/**
	 * Boot all of the registered service providers
	 */

	public function boot()
	{
		foreach ($this->serviceProviders as $provider)
		{
			$this->triggerProviderBoot($provider);
			$this->booted[] = $provider;
		}
	}

	/**
	 * Register a service provider in the application
	 */

	public function register($provider, $overwrite = false)
	{
		if (isset($this->serviceProviders[$provider]) && !$overwrite) return $provider;

		if (is_string($provider))
		{
			$provider = $this->resolveProviderClass($provider);
		}

		$provider->register();

		if ($this->booted) $provider->boot();

		return $provider;
	}

	/**
	 * Bind the install paths to the application
	 *
	 * @param  $paths The paths specified in the paths.php file
	 */
	
	public function bindInstallPaths(array $paths = array())
	{
		foreach ($paths as $id => $value)
		{
			$this['path.' . $key] = $value;
		}
	}

	/**
	 * Register the core class aliases in the container
	 *
	 * @return  void
	 */
	
	public function registerCoreContainerAliases()
	{
		$aliases = array(
			'app' => 'Flyer\Components\Foundation\App',
			'router' => 'Flyer\Components\Routing\Router',
		);

		foreach ($aliases as $key => $alias)
		{
			$this->alias($key, $alias);
		}
	}

	/**
	 * Resolves the provider's class
	 *
	 * @param $provider The Service Provider
	 * @return $provider The resolved Service Provider object
	 */
	
	protected function resolveProviderClass($provider)
	{

	}

	protected function triggerProviderRegister($provider)
	{
		return (is_object($provider)) ? $provider->register() : false;
	}

	protected function triggerProviderBoot($provider)
	{
		return (is_object($provider)) ? $provider->boot() : false;
	}
}