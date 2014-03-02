<?php

namespace Flyer\Foundation;

abstract class ServiceProvider
{	

	/**
	 * The application instance
	 *
	 * @var  object The application instance
	 */

	protected static $app;

	/**
	 * Service Provider boot method
	 *
	 * @return  void
	 */

	public function boot() {}

	/**
	 * Register the Service Provider
	 *
	 * @return  void
	 */

	abstract public function register();

	/**
	 * Set the application instance
	 *
	 * @param  $app The application
	 * @return  void
	 */

	public static function setApp($app)
	{
		self::$app = $app;
	}

	/**
	 * Return the instance of the application
	 *
	 * @return object The application instance
	 */

	public function app()
	{
		return self::$app;
	}
}