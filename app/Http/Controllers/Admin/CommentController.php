<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index(Request $request)
    {
        $query = Comment::with(['user', 'product']);

        // Lọc theo trạng thái
        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        // Lọc theo sản phẩm
        if ($request->has('product_id')) {
            $query->where('product_id', $request->product_id);
        }

        $comments = $query->latest()->paginate(10);
        return view('admin.comments.index', compact('comments'));
    }

    public function approve(Comment $comment)
    {
        $comment->update(['status' => 'approved']);
        return redirect()->back()->with('success', 'Đã duyệt bình luận!');
    }

    public function reject(Comment $comment)
    {
        $comment->update(['status' => 'rejected']);
        return redirect()->back()->with('success', 'Đã từ chối bình luận!');
    }

    public function destroy(Comment $comment)
    {
        $comment->delete();
        return redirect()->back()->with('success', 'Đã xóa bình luận!');
    }
}