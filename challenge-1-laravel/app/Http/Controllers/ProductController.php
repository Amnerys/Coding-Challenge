<?php

namespace App\Http\Controllers;

use App\Exports\ProductsExport;
use App\Imports\ProductsImport;
use App\Models\Product;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ProductController extends Controller
{
    public function __construct()
    {
    }

    public function pruebas(){
        echo 'Soy una prueba';
    }

    public function index(){
        //Paginate data
        $data = Product::latest()->paginate(10);
        return view('csv_file_pagination', compact('data'))
            ->with('i', (request()->input('page', 1)-1)*10);
    }

    public function home(){
        ini_set('memory_limit', '-1');
        ini_set('max_execution_time', '300');
        Excel::import(new ProductsImport(), 'Artikel.csv', null, \Maatwebsite\Excel\Excel::CSV);
    }

    public function fileImportExport()
    {
        return view('file-import');
    }

    public function importPreview(Request $request){
        Excel::import(new ProductsImport, $request->file('file')->store('local'));
        return back();
    }

    public function fileImport(Request $request)
    {
        $csvFile = file($request->file('file'));
        $data = [];
        $collection = collect();
        //Read de the CSV passed and store it into an array with each line read
        foreach ($csvFile as $line) {
            $data[] = str_getcsv($line);
        }
        while (($filedata = fgetcsv($file, 1000, ",")) !== FALSE) {
            $num = count($filedata);
// Skip first row (Remove below comment if you want to skip the first row)
            if ($i == 0) {
                $i++;
                continue;
            }
            for ($c = 0; $c < $num; $c++) {
                $importData_arr[$i][] = $filedata[$c];
            }
            $i++;
        }


        $fieldsArray = [];
        foreach ($data as $row){
            //We need create a string of each row
            $rowToString = implode(", ", $row);
            //This method will divide a string into various strings to get each field
            $fieldsArray = explode(";", $rowToString);
            //$collection->push($fieldsArray);
        }
        $collection->push($data);
        echo $collection;

        /*
        $row0 = $data[0];
        $rowString = implode(", ", $row0);
        $field = explode(";", $rowString);
        $porcion1 = $field[3];
        echo $porcion1;*/
    }

    public function fileExport()
    {
        return Excel::download(new ProductsExport(), 'products-collection.csv');
    }

    public function commandSync(){
        Excel::import(new ProductsImport(), 'Artikel.csv', null, \Maatwebsite\Excel\Excel::CSV);
    }

    public function pruebas2(Request $request){
        $file = $request->file('uploaded_file');
        if ($file) {
            $filename = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension(); //Get extension of uploaded file
            $tempPath = $file->getRealPath();
            $fileSize = $file->getSize(); //Get size of uploaded file in bytes
//Check for file extension and size
            $this->checkUploadedFileProperties($extension, $fileSize);
//Where uploaded file will be stored on the server
            $location = 'uploads'; //Created an "uploads" folder for that
// Upload file
            $file->move($location, $filename);
// In case the uploaded file path is to be stored in the database
            $filepath = public_path($location . "/" . $filename);
// Reading file
            $file = fopen($filepath, "r");
            $importData_arr = array(); // Read through the file and store the contents as an array
            $i = 0;

            //Read de the CSV passed and store it into an array with each line read
            foreach ($csvFile as $line) {
                $data[] = str_getcsv($line);
            }

//Read the contents of the uploaded file
            while (($filedata = fgetcsv($file, 1000, ",")) !== FALSE) {
                $num = count($filedata);
// Skip first row (Remove below comment if you want to skip the first row)
                if ($i == 0) {
                    $i++;
                    continue;
                }
                for ($c = 0; $c < $num; $c++) {
                    $importData_arr[$i][] = $filedata[$c];
                }
                $i++;
            }
            fclose($file); //Close after reading
            $j = 0;
            foreach ($importData_arr as $importData) {
                $name = $importData[1]; //Get user names
                $email = $importData[3]; //Get the user emails
                $j++;
                try {
                    DB::beginTransaction();
                    Player::create([
                        'name' => $importData[1],
                        'club' => $importData[2],
                        'email' => $importData[3],
                        'position' => $importData[4],
                        'age' => $importData[5],
                        'salary' => $importData[6]
                    ]);
//Send Email
                    $this->sendEmail($email, $name);
                    DB::commit();
                } catch (\Exception $e) {
//throw $th;
                    DB::rollBack();
                }
            }
            return response()->json([
                'message' => "$j records successfully uploaded"
            ]);
        } else {
//no file was uploaded
            throw new \Exception('No file was uploaded', Response::HTTP_BAD_REQUEST);
        }
    }
    public function checkUploadedFileProperties($extension, $fileSize)
    {
        $valid_extension = array("csv", "xlsx"); //Only want csv and excel files
        $maxFileSize = 2097152; // Uploaded file size limit is 2mb
        if (in_array(strtolower($extension), $valid_extension)) {
            if ($fileSize <= $maxFileSize) {
            } else {
                throw new \Exception('No file was uploaded', Response::HTTP_REQUEST_ENTITY_TOO_LARGE); //413 error
            }
        } else {
            throw new \Exception('Invalid file extension', Response::HTTP_UNSUPPORTED_MEDIA_TYPE); //415 error
        }
    }
    public function sendEmail($email, $name)
    {
        $data = array(
            'email' => $email,
            'name' => $name,
            'subject' => 'Welcome Message',
        );
        Mail::send('welcomeEmail', $data, function ($message) use ($data) {
            $message->from('welcome@myapp.com');
            $message->to($data['email']);
            $message->subject($data['subject']);
        });

    }

}
