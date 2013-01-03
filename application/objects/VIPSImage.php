<?php
/**
 * Created by Brad Walker on 11/16/12 at 1:31 AM
*/ 
class VIPSImage {
	
	protected $filePath;
	protected $fileType;
	
	
	public function __construct($path) {
		$dotStart = strpos($path, '.');
		if ($dotStart !== FALSE) {
			$extension = strtolower(substr($path, $dotStart + 1));
			
			switch ($extension) {
				case 'png':
					$this->fileType = 'png';
					break;
				case 'jpg';
				case 'jpeg';
					$this->fileType = 'jpg';
					break;
				default:
					throw new Exception("Extension on image path '{$path}' does not match allowed filetypes (png, jpg/jpeg)");
					break;
			}
			
			$this->filePath = $path;
			
		}
		else {
			throw new Exception("Extension on image path '{$path}' does not exist");
		}

		return $this;
	}
	
	public function crop($x, $y, $width, $height) {
		
	}
}
