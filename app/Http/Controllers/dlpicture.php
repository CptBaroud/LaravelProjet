<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use ZipArchive;

class dlpicture extends Controller
{
	/**public function Download(){
		$file = DB::table('image')->select('url_image')->get();
		foreach ($file as $key) {
			$file = $file[0]->url_image;
			$file = 'images/'.$file;
			if (file_exists($file)) {
				header('Content-Description: File Transfer');
				header('Content-Type: application/octet-stream');
				header('Content-Disposition: attachment; filename="'.basename($file).'"');
				header('Expires: 0');
				header('Cache-Control: must-revalidate');
				header('Pragma: public');
				header('Content-Length: ' . filesize($file));
				readfile($file);
				exit;
			} 
		}
		return back();
	}**/
	public function Download(){
		try{
//------------------------------------------------------------------------------------------------------
//If you are passing the file names to thae array directly use the following method
			$file_names = array();
			$i=0;

			$file  = DB::table('image')->get();
			foreach ($file as $key) {
				$file_names[] = $file[$i]->url_image;
				$i++;
			}
//Archive name
			$archive_file_name='AllPicture'.date("Ymd").'.zip';
//Download Files path
			$file_path='images/';

			$zip = new ZipArchive();
    //create the file and throw the error if unsuccessful

			if ($zip->open($archive_file_name, ZIPARCHIVE::CREATE )!==TRUE) {
				exit("cannot open <$archive_file_name>\n");
			}
    //add each files of $file_name array to archive
			foreach($file_names as $files)
			{	
				$zip->addFile($file_path.$files, 'pictures' . DIRECTORY_SEPARATOR . pathinfo($files)['basename']);
        //echo $file_path.$files,$files."<br />";
			}
			$zip->close();
    //then send the headers to foce download the zip file
			header("Content-type: application/zip"); 
			header("Content-Disposition: attachment; filename=$archive_file_name"); 
			header("Pragma: no-cache"); 
			header("Expires: 0"); 
			readfile("$archive_file_name");
			exit;
			Toastr::success('Image downloaded', 'SUCCESS', ["positionClass" => "toast-top-center"]);
			return back();
		}
		
		catch(Exception $e){
			echo $e->getMessage();
		}

	}
}
