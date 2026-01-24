<?php

namespace App\Http\Controllers;

use App\Models\BlogCategory;
use App\Models\BlogPost;
use App\Models\Contact;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function OurTeam()
    {
        return view('home.team.team_page');
    }

    public function AboutUs()
    {
        return view('home.about.about_us');
    }

    public function OurService()
    {
        return view('home.service.service');
    }

    public function BlogPage()
    {
        $blogcat = BlogCategory::latest()->withCount('posts')->get();
        $post = BlogPost::latest()->limit(5)->get();
        $recentpost = BlogPost::latest()->limit(3)->get();
        return view('home.blog.list_blog', compact('blogcat', 'post', 'recentpost'));
    }

    public function BlogDetails($slug)
    {
        $blog = BlogPost::where('post_slug', $slug)->first();
        $blogcat = BlogCategory::latest()->withCount('posts')->get();
        $recentpost = BlogPost::latest()->limit(3)->get();
        return view('home.blog.blog_details', compact('blog', 'blogcat', 'recentpost'));
    }

    public function BlogCategory($id)
    {
        $blog = BlogPost::where('blogcat_id', $id)->get();
        $categoryname = BlogCategory::where('id', $id)->first();
        $blogcat = BlogCategory::latest()->withCount('posts')->get();
        $recentpost = BlogPost::latest()->limit(3)->get();
        return view('home.blog.blog_category', compact('blog', 'categoryname', 'blogcat', 'recentpost'));
    }

    public function ContactUs()
    {
        return view('home.contact.contact_us');
    }

    public function ContactMessage(Request $request)
    {
        Contact::create([
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message,
        ]);

        $notification = array(
            'message' => 'Your Message Sent Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function ContactAllMessage()
    {
        $message = Contact::latest()->get();
        return view('admin.backend.contact.all_message', compact('message'));
    }

    public function DeleteMessage($id)
    {
        Contact::find($id)->delete();

        $notification = array(
            'message' => 'Contact Message Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
}
