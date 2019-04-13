<?php
/**
 * Created by PhpStorm.
 * User: Alintan
 * Date: 12/21/2018
 * Time: 1:53 PM
 */

namespace App\Http\Controllers;


use App\Blog;

class BlogData
{
    private $blog_data;
    function __construct($blog_id) {
        $blog=Blog::findOrFail($blog_id);
        $this->blog_data=$this->set_blog_data($blog);
    }

    private function set_blog_data($blog){
        $blog_data=array();
        $blog_data['id']=$blog->id;
        $blog_data['photo']=$blog->photo;
        $blog_data['photo_url']=RenoMyanmar::$domain_url."upload/blog/".$blog->photo;
        $blog_data['title']=$blog->title;
        $blog_data['description']=$blog->description;
        $blog_data['date']=$blog->created_at;

        return $blog_data;
    }

    public function get_blog_data(){
        return $this->blog_data;
    }

    public static function get_latest_new($num){
        $admin_blog=Blog::orderBy('id','desc')->take($num)->get();
        $blogs=[];
        foreach($admin_blog as $data){
            $blog_data=new BlogData($data->id);
            array_push($blogs,$blog_data->get_blog_data());
        }
        return $blogs;
    }

}