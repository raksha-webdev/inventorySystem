<?php
 use Iluminate\Support\Facades\Http;

  function saveImgFile($file, $path)
  {
    $fileName = time() . '_' . $file->getClientOriginalName();
    $file->move(public_path($path), $fileName);
    return $fileName;
  }


?>