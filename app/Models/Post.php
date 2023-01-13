<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Carbon;

class Post extends Model
{
    // use HasFactory;
    /**
     * モデルに関連付けるテーブル
     *
     * @var string
     */
    protected $table = 'posts';

    /**
     * 複数代入可能な属性
     *
     * @var array
     */

    protected $fillable = [
        'user_id',
        'category_id',
        'title',
        'body',
        'publish_flg',
        'view_counter',
        'favorite_counter',
        'delete_flg',
        'created_at',
        'updated_at'
    ];

    /**
     * Userモデルとリレーション
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    /**
     * Categoryモデルとリレーション
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * 投稿データを全て取得し、最新更新日時順にソート。総合トップ画面に表示する記事はステータス「公開」(publish_flg=1)のみ
     */
    public function getPostsSortByLatestUpdate()
    {
        $result = $this->where('publish_flg', 1)
            ->orderBy('updated_at', 'DESC')
            ->with('user')
            ->with('category')
            ->get();
        return $result;
    }

    /**
     * カテゴリーごとの記事を全て取得
     *
     * @param int $category_id カテゴリーID
     */
    public function getPostByCategoryId($category_id)
    {
        $result = $this->where('category_id', $category_id)
            ->get();
        return $result;
    }

    /**
     * ユーザーIDに紐づいた投稿リストを全て取得する
     *
     * @param int $user_id ユーザーID
     * @return Post
     */
    public function getAllPostsByUserId($user_id)
    {
        $result = $this->where('user_id', $user_id)->with('category')->get();
        return $result;
    }

    /**
     * 下書き保存=>publish_flg=0
     * リクエストされたデータをpostsテーブルにinsertする
     *
     * @param int $user_id ログインユーザーID
     * @param array $request リクエストデータ
     * @return object $result App\Models\Post
     */
    public function insertPostToSaveDraft($user_id, $request)
    {
        $result = $this->create([
            'user_id'          => $user_id,
            'category_id'      => $request->category,
            'title'            => $request->title,
            'body'             => $request->body,
            'publish_flg'      => 0,
            'view_counter'     => 0,
            'favorite_counter' => 0,
            'delete_flg'       => 0,
        ]);
        return $result;
    }

    /**
     * 公開=>publish_flg=1
     * リクエストされたデータをpostsテーブルにinsertする
     *
     * @param int $user_id ログインユーザーID
     * @param array $request リクエストデータ
     * @return object $result App\Models\Post
     */
    public function insertPostToRelease($user_id, $request)
    {
        $result = $this->create([
            'user_id'          => $user_id,
            'category_id'      => $request->category,
            'title'            => $request->title,
            'body'             => $request->body,
            'publish_flg'      => 1,
            'view_counter'     => 0,
            'favorite_counter' => 0,
            'delete_flg'       => 0,
        ]);
        return $result;
    }

    /**
     * 予約公開=>publish_flg=2
     * リクエストされたデータをpostsテーブルにinsertする
     *
     * @param int $user_id ログインユーザーID
     * @param array $request リクエストデータ
     * @return object $result App\Models\Post
     */
    public function insertPostToReservationRelease($user_id, $request)
    {
        $result = $this->create([
            'user_id'          => $user_id,
            'category_id'      => $request->category,
            'title'            => $request->title,
            'body'             => $request->body,
            'publish_flg'      => 2,
            'view_counter'     => 0,
            'favorite_counter' => 0,
            'delete_flg'       => 0,
        ]);
        return $result;
    }

    /**
     * 投稿IDをもとにpostsテーブルから一意の投稿データを取得
     *
     * @param int $post_id 投稿ID
     * @return object $result App\Models\Post
     */
    public function feachPostDateByPostId($post_id)
    {
        $result = $this->find($post_id);
        return $result;
    }
}
