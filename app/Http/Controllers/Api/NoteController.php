<?php

namespace App\Http\Controllers\Api;

use App\Filters\NoteFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreNoteRequest;
use App\Http\Requests\UpdateNoteRequest;
use App\Http\Resources\NoteCollection;
use App\Http\Resources\NoteResource;
use App\Models\Note;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    public function index(Request $request)
    {
        $size = 15;
        if ($request->filled('size')) {
            $size = $request->size;
        }

        $filter = new NoteFilter();
        $filterItems = $filter->transform($request);

        if (count($filterItems) == 0) {
            $notes = Note::orderBy('updated_at', 'desc')->paginate($size);
            return new NoteCollection($notes->appends($request->query()));
        } else {
            $notes = Note::where($filterItems)->orderBy('updated_at', 'desc')->paginate($size);
            return new NoteCollection($notes->appends($request->query()));
        }

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreNoteRequest $request)
    {
        return Note::create($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show(Note $note)
    {
        return new NoteResource($note);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateNoteRequest $request, Note $note)
    {
        return $note->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return Note::destroy($id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function search(string $searchKey)
    {
        return new NoteCollection(Note::where('title', 'like', "%{$searchKey}%")->orWhere('content', 'like', "%{$searchKey}%")->orderBy('updated_at', 'desc')->paginate());
    }
}