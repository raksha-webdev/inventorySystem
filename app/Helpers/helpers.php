<?php
 use Illuminate\Support\Facades\Http;
 

 function callApi($method, $apiname, $data = [])
{
    $url = env('API_BASE_URL') . '/' . ltrim($apiname, '/');

    $request = Http::acceptJson()
        ->timeout(30)
        ->connectTimeout(5);

    foreach ($data as $key => $value) {

        if ($value instanceof UploadedFile) {
            $request = $request->attach(
                $key,
                fopen($value->getRealPath(), 'r'),
                $value->getClientOriginalName()
            );

            unset($data[$key]);
        }
    }

    switch (strtoupper($method)) {

        case 'POST':
            return $request->post($url, $data);

        case 'GET':
            return $request->get($url, $data);

        case 'PUT':
            return $request->put($url, $data);

        case 'DELETE':
            return $request->delete($url, $data);

        default:
            throw new Exception("Invalid HTTP method: $method");
    }
}
 
  

   function saveImgFile($file, $path)
  {
      if (!$file || !$file->isValid()) {
          return "";
      }
  
      // Create folder if it doesn't exist
      $folderPath = public_path($path);
  
      if (!file_exists($folderPath)) {
          mkdir($folderPath, 0755, true);
      }
  
      // Generate unique filename
      $fileName = time() . '_' . uniqid() . '_' . $file->getClientOriginalName();
  
      // Move file
      $file->move($folderPath, $fileName);
  
      return $fileName;
  }



 function commonDelete($tableName, $columnName, $value)
{
    $allowedTables = [
        'product',
        'category',
        'suppliers',
        'brand',
    ];

    if (!in_array($tableName, $allowedTables)) {
        return redirect()->back()
            ->with('error', 'Invalid Table Name');
    }

    $deleted = DB::table($tableName)
        ->where($columnName, $value)
        ->delete();

    if ($deleted) {
        return redirect()->back()
            ->with('success', 'Deleted Successfully');
    }

    return redirect()->back()
        ->with('error', 'Record Not Found');
}


?>