<?php

namespace App\Http\Controllers;

use App\Http\Requests\NoteRequest;
use App\Models\Note;
use Illuminate\Http\Request;
use Inertia\Inertia;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $featured_notes = Note::whereUserId(auth()->id())->whereFeatured(1)->orderBy('updated_at', 'desc')->get();
        $all_notes = Note::whereUserId(auth()->id())->whereFeatured(0)->orderBy('updated_at', 'desc')->get();

        $new_note = new Note();
        $new_note->bg_color = "#ffffff";

        return Inertia::render("Home", compact("featured_notes", "all_notes", "new_note"));
    }
}
