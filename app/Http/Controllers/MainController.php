<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cat;
Use App\Spending;
use Carbon\Carbon;
class MainController extends Controller
{

    function showSpendings()
    {
    	$spending = new Spending;
    	$cat = new Cat;
    	$allCats = $cat->all();

    //	$startWeek = Spending::setWeekStartsAt(Spending::SUNDAY);
    //	$endWeek = Spending::setWeekEndsAt(Spending::SATURDAY);

    	$spendingsAnd = $spending->whereBetween('spendings.created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->join('cats','spendings.category_id','=','cats.id')->where('name','=','Андрей')->get();

    	$spendingsKate = $spending->whereBetween('spendings.created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->join('cats','spendings.category_id','=','cats.id')->where('name','=','Катя')->get();
    	return view('welcome',['spendsAnd'=>$spendingsAnd,'spendsKate'=>$spendingsKate,'cats'=>$allCats]);
    }
    public function ajaxTime(Request $request)

    {
    	$spending = new Spending;
        $start = $request->start;
        $end = $request->end;
        $spendingsAnd = $spending->whereBetween('spendings.created_at', [$start, $end])->join('cats','spendings.category_id','=','cats.id')->where('name','=','Андрей')->get();
        $spendingsKate = $spending->whereBetween('spendings.created_at', [$start, $end])->join('cats','spendings.category_id','=','cats.id')->where('name','=','Катя')->get();

        $result['kate'] = $spendingsKate;
        $result['and'] = $spendingsAnd;
        return response()->json($result);

    }
     public function ajaxCategory(Request $request)

    {
    	$spending = new Spending;
        $start = $request->start;
        $end = $request->end;
        $category = $request->category;
        $spendingsAnd = $spending->whereBetween('spendings.created_at', [$start, $end])->join('cats','spendings.category_id','=','cats.id')->where('name','=','Андрей')->where('cats.id',$category)->get();
        $spendingsKate = $spending->whereBetween('spendings.created_at', [$start, $end])->join('cats','spendings.category_id','=','cats.id')->where('name','=','Катя')->where('cats.id',$category)->get();

        $result['kate'] = $spendingsKate;
        $result['and'] = $spendingsAnd;
        return response()->json($result);

    }
    public function ajaxAdd(Request $request)
    {
    	$item = $request->item;
    	$name = $request->name;
    	$price = $request->price;
    	$category = $request->category;
    	$comment = $request->comment;
    	$spending = new Spending;
    	$spends = $spending->insertGetId(
    		[
    			'name' => $name,
    			'item' => $item,
    			'money_count' => $price,
    			'category_id' => $category,
    			'comment' => $category,
    			'created_at' =>  \Carbon\Carbon::now(),
    		]
    	);
    	//var_dump($item);
    	return response()->json($request->all());
    }
}
