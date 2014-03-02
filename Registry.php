<?php

namespace Flyer\Components\Foundation;

class Registry
{

	/**
	 * Holds all of the registry items
	 *
	 * @var  array Registry items
	 */

	protected static $items = array();

	/**
	 * Set a registry item
	 *
	 * @var  string Registry item key
	 * @var  mixed Registry item value
	 *
	 * @return  void
	 */

	public static function set($key, $value)
	{
		if (!self::exists($key))
		{
			self::$items[$key] = $value;	
		}
		
		throw new \Exception("Registry: Key " . $key . " already exists!");
	}

	/**
	 * Get a registry item
	 *
	 * @var  string Registry item key
	 *
	 * @return  mixed Registry item value
	 */

	public static function get($key)
	{
		if (self::exists($key))
		{
			return self::$items[$key];
		}

		throw new \Exception("Registry: Key " . $key . " is not found in the registry, please initialize it by the set() function!");
		return;
	}

	/**
	 * Update a registry item
	 *
	 * @var  string The registry key to be updated
	 * @var  mixed The new value
	 * @return  void
	 */

	public static function update($key, $toValue)
	{
		if (self::exists($key))
		{
			self::delete($key);
			self::set($key, $toValue);
			return;
		}

		throw new \Exception("Registry: key " . $key . " does not exists, so the key cannot been updated!");
	}

	/**
	 * Delete a registry item by his id
	 *
	 * @var  string Registry key
	 */

	public static function delete($key)
	{
		if (self::exists($key)) unset(self::$items[$key]);
	}

	/**
	 * Check if a registry item exists by his id
	 *
	 * @var  string Registry key
	 */

	public static function exists($key)
	{
		if (isset(self::$items[$key]))
		{
			return true;
		}
		return false;
	}
}