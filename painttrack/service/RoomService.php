<?php
class RoomService {
	public static function create($data) {
		try {
			$room = Room::create($data);
			return $room;
		}
		catch (Exception $e) {
			die($e->getMessage());
		}
	}
}