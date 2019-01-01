<?php
class UnitService {
	public static function create($data) {
		try {
			$unit = Unit::create($data);
			return $unit;
		}
		catch (Exception $e) {
			die($e->getMessage());
		}
	}
}