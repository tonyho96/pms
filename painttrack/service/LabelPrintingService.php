<?php
class LabelPrintingService {
	public static function getItems() {
		try {
			$items = Item::all();
			return $items;
		}
		catch (Exception $e) {
			die($e->getMessage());
		}
	}
}