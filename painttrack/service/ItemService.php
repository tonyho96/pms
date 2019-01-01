<?php

class ItemService {
	public static function uploadImage( $file ) {
		$targetDir    = PMS_UPLOAD_PATH;
		$targetFile   = md5(uniqid(rand(), true)) . basename( $file["name"] );
		$fullPath     = $targetDir . $targetFile;
		if ( move_uploaded_file( $file["tmp_name"], $fullPath ) ) {
			return "/uploads/$targetFile";
		}
		return "";
	}
}