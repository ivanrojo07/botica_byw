<?php namespace App\Http\Controllers;


use App\Product;
use App\ProductComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductCommentController extends Controller {

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getIndex($product_id)
    {
        $product = Product::find($product_id);

        if (!$product) {
            return redirect()->back();
        }

        return view('products.comment', compact('product'));
    }

    public function storeComment(Request $request)
    {
        $messages = [
            'comment.required' => 'El comentario es requerido',
            'comment.max'      => 'El comentario debe ser de máximo 300 caracteres'
        ];

        $this->validate($request, [
            'comment' => 'required|max:300'
        ], $messages);

        $data = $request->all();

        $product_comment = new ProductComment();
        $product_comment->user_id = Auth::user()->id;
        $product_comment->product_id = $data['id'];
        $product_comment->comment = $data['comment'];
        $product_comment->save();

        return redirect($data['back_url'])->with(
            [
                'feedback'   => 'Comentario guardado correctamente!',
                'alert_type' => 'alert-success'
            ]
        );
    }
}