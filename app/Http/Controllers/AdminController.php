<?php

namespace App\Http\Controllers;

use App\Models\Professor;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    
    public function showLoginForm()
    {
        return view('auth.admin.login');
    }

    
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        
        if ($credentials['username'] === 'admin' && $credentials['password'] === 'emsi1') {
            Auth::guard('admin')->loginUsingId(1); 
            return redirect()->route('admin.home');
        }


        return back()->withErrors(['username' => 'Invalid credentials']);
    }

   
    public function home()
    {
        $professors = Professor::with('courses')->get();
        return view('auth.admin.professors_and_classes', compact('professors'));
    }


    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }


    public function indexProfessors()
    {
        $professors = Professor::all();
       
        return view('auth.admin.professors_and_classes', compact('professors')); 
    }

    public function createProfessor()
    {
        return view('admin.professors.create');
    }

    public function storeProfessor(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:professors,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        Professor::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        
        return redirect()->route('admin.professors.index')->with('success', 'Professor added successfully!');
    }

    public function editProfessor(Professor $professor)
    {
        return view('admin.professors.edit', compact('professor'));
    }

    public function updateProfessor(Request $request, Professor $professor)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:professors,email,' . $professor->id,
        ]);

        
        $professor->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            
            'password' => $request->filled('password') ? Hash::make($request->input('password')) : $professor->password,
        ]);

       
        return redirect()->route('admin.professors.index')->with('success', 'Professor updated successfully!');
    }

    
    public function destroyProfessor(Professor $professor)
    {
        $professor->delete();

        return redirect()->route('admin.professors.index')->with('success', 'Professor deleted successfully!');
    }

    // wwwwwwww
    public function indexCourses()
    {
        $courses = Course::all();
        return view('admin.courses.index', compact('courses'));
    }

    public function createCourse()
    {
        $professors = Professor::all(); 
        return view('admin.courses.create', compact('professors'));
    }

    public function storeCourse(Request $request)
    {
        $validated = $request->validate([
            'date' => 'required|date',
            'groupe' => 'required|string|max:255',
            'course_name' => 'required|string|max:255',
            'details' => 'required|string',
            'professor_id' => 'required|exists:professors,id', 
        ]);

        Course::create([
            'date' => $validated['date'],
            'groupe' => $validated['groupe'],
            'course_name' => $validated['course_name'],
            'details' => $validated['details'],
            'professor_id' => $validated['professor_id'],
        ]);

        return redirect()->route('admin.courses.index')->with('success', 'Course added successfully!');
    }

    public function editCourse(Course $course)
    {
        $professors = Professor::all(); 
        return view('admin.courses.edit', compact('course', 'professors'));
    }

    public function updateCourse(Request $request, Course $course)
    {
        $validated = $request->validate([
            'date' => 'required|date',
            'groupe' => 'required|string|max:255',
            'course_name' => 'required|string|max:255',
            'details' => 'required|string',
            'professor_id' => 'required|exists:professors,id', 
        ]);

        $course->update($validated);

        return redirect()->route('admin.courses.index')->with('success', 'Course updated successfully!');
    }

    public function destroyCourse(Course $course)
    {
        $course->delete();
        return redirect()->back()->with('success', 'Course deleted successfully!');
    }
}
