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
		if (in_array($provider, $this->serviceProviders) && !$overwrite)
		{
			throw new \Exception("Cannot create service provider, provider already exists!");

			return false;
		}

		if (is_object($provider) || is_string($provider))
		{
			if (is_string($provider) && class_exists($provider))
			{
				$this->triggerProviderRegister(new $provider);
			} else if (is_object($provider)) {
				$this->triggerProviderRegister($provider);
			} else {
				throw new \Exception("Cannot create service provider, $provider has to be a instance or a string!");

				return false;
			}
			
			$this->serviceProviders[] = $provider;

			return true;
		}

		throw new \Exception("Cannot create service provider, please check your code");

		return false;
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