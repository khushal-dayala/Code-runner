<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\Code;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function categories()
    {
        $categories = Category::with('code_listing')->latest()->get();
        return json_encode($categories);
    }
    
    public function execute(Request $request)
    {
        $code = $request->input('code');

        $filePath = storage_path('app/tmp_code.php');
        file_put_contents($filePath, "<?php\n" . $code);

        ob_start();
        try {
            include $filePath;
            $output = ob_get_clean();
        } catch (\Throwable $e) {
            $output = $e->getMessage();
        }

        return response()->json(['output' => $output]);
    }
}
