<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AboutSection;

class AboutSectionController extends Controller
{
    public function edit($section)
    {
        $aboutSection = AboutSection::where('section', $section)->first();
        $baseUrl = asset('');
        return view('admin.about_sections.edit', compact('aboutSection', 'section', 'baseUrl'));
    }

    public function update(Request $request, $section)
    {
        $request->validate(['content' => 'required']);
        $aboutSection = AboutSection::updateOrCreate(
            ['section' => $section],
            ['content' => $request->input('content')]
        );
        return redirect()->back()->with('success', 'Section updated!');
    }
}